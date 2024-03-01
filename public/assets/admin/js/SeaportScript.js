$(document).ready(function() {
    var urlSearch = $("#seaport").data("seaport");
    $.ajax({
        type: 'POST',
        url: urlSearch,
        success:  function(response)
        {
            let data = JSON.parse(response);
            var arraySeaportId= [];
            let flag =false;
            data.forEach(element => {
                arraySeaportId.push(element.macang);
            });
            $("#search_seaport").on("focus",function() {
                if ($("#search_seaport").val().length==0) {
                    $("#suggestionsSeaportSearch").prop("hidden", false);
                    count=arraySeaportId.length;
                    if (count>=6) {
                        $("#suggestionsSeaportSearch").height(250);
                    }else  $("#suggestionsSeaportSearch").height(count*45);
                    arraySeaportId.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#search_seaport").val(element);
                            flag=false;
                            $("#suggestionsSeaportSearch").prop("hidden", true)
                        })
                    $("#suggestionsSeaportSearch").append(child);
                    });
                }else {
                    $("#suggestionsSeaportSearch").prop("hidden", false);
                    let inputValue =$("#search_seaport").val().toLowerCase();
                    let filterArray =[];
                    arraySeaportId.forEach(element => {
                                if(element.toLowerCase().includes(inputValue))
                                filterArray.push(element);
                        });
                    $("#suggestionsSeaportSearch").empty();
                    countFilter=filterArray.length;
                    if (countFilter>=6) {
                        $("#suggestionsSeaportSearch").height(250);
                    }else  $("#suggestionsSeaportSearch").height(countFilter*45);
                    filterArray.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#search_seaport").val(element);
                            flag=false;
                            $("#suggestionsSeaportSearch").prop("hidden", true)
                        })
                    $("#suggestionsSeaportSearch").append(child);
                    });
                }
            })
            $("#search_seaport").on("blur",function () {
                if (flag!=true) {
                    $("#suggestionsSeaportSearch").prop("hidden", true);
                  }
            })
            $("#search_seaport").on("input",function () {
                let inputValue =$("#search_seaport").val().toLowerCase();
                let filterArray =[];
                arraySeaportId.forEach(element => {
                            if(element.toLowerCase().includes(inputValue))
                            filterArray.push(element);
                    });
                $("#suggestionsSeaportSearch").empty();
                countFilter=filterArray.length;
                if (countFilter>=6) {
                    $("#suggestionsSeaportSearch").height(250);
                }else  $("#suggestionsSeaportSearch").height(countFilter*45);
                filterArray.forEach(element => {   
                    let child = $("<div></div>");
                    child.text(element);
                    child.addClass("suggestion_item");
                    child.addClass("text-truncate");
                    child.on("click",function() {
                        $("#search_seaport").val(element);
                        flag=false;
                        $("#suggestionsSeaportSearch").prop("hidden", true)
                    })
                $("#suggestionsSeaportSearch").append(child);
                });
            })
             $("#suggestionsSeaportSearch").mousedown(function() {
                flag=true;
            });
        }
    });
    $(document).on('click','.btn_change', function() {
        $('.column_error_change_seaport').addClass("d-none")

        var dataId = $(this).data('change-id');
        var dataUrl = $(this).data('api-link');
        var postData = {
            id: dataId
        };
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData,
            success: function(response) {
                var data = JSON.parse(response);
                $('input[name="seaportChangeName"]').val(data.tencang);
                $('input[name="seaportChangeId"]').val(data.macang);
                $('input[name="seaportChangeNation"]').val(data.quocgia);
                $('input[name="seaportChangeMaxVolume"]').val(data.thetichtoida);
                $('input[name="seaportChangeCurrentVolume"]').val(data.thetichhienchua);
                $('input[name="seaportChangeState"]').filter('[value="' + data.trangthai + '"]').prop('checked', true);
            }
        });
    });
    $(document).on('click','.btn_delete', function() {
        var dataId = $(this).data('delete-id');
        var dataUrl = $(this).data('api-link');
        var postData = {
            id: dataId
        };
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData,
            success: function(response) {
                var data = JSON.parse(response);
                $('input[name="seaportDeleteName"]').val(data.tencang);
                $('input[name="seaportDeleteId"]').val(data.macang);
                $('input[name="seaportDeleteNation"]').val(data.quocgia);
                $('input[name="seaportDeleteMaxVolume"]').val(data.thetichtoida);
                $('input[name="seaportDeleteCurrentVolume"]').val(data.thetichhienchua);
                $('input[name="seaportDeleteState"]').filter('[value="' + data.trangthai + '"]').prop('checked', true);
            }
        });
    });
    $(document).on('click','button[name="submitChange"]', function() {
        var postData = {
            tencang: $('input[name="seaportChangeName"]').val(),
            macang: $('input[name="seaportChangeId"]').val(),
            quocgia:  $('input[name="seaportChangeNation"]').val(),
            thetichtoida:  $('input[name="seaportChangeMaxVolume"]').val(),
            thetichhienchua:  $('input[name="seaportChangeCurrentVolume"]').val(),
            trangthai:  $('input[name="seaportChangeState"]:checked').val(),
            action: "update"
        };
        $('.column_error_change_seaport').addClass("d-none")

        if(parseInt(postData['thetichhienchua']) > parseInt(postData['thetichtoida']))
        {
            $('#error_change_seaport').text("Thể tích hiện tại không thể vượt qua thể tích tối đa")
            $('.column_error_change_seaport').removeClass("d-none")
            return false;
        }
        var dataUrl = $(this).data('api-link');
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData,
        });
    });
    $(document).on('click','button[name="submitDelete"]', function() {
        var postData = {
            macang: $('input[name="seaportDeleteId"]').val(),
            action: "delete"
        };
       
        var dataUrl = $(this).data('api-link');
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData,
        });  
    });
    $(document).on('click','button[name="submitAdd"]', function() {
 
        var postData = {
            tencang: $('input[name="seaportAddName"]').val(),
            macang: $('input[name="seaportAddId"]').val(),
            quocgia:  $('input[name="seaportAddNation"]').val(),
            thetichtoida:  $('input[name="seaportAddMaxVolume"]').val(),
            thetichhienchua:  $('input[name="seaportAddCurrentVolume"]').val(),
            trangthai:  $('input[name="seaportAddState"]:checked').val(),
            action: "insert"
        };
        $('.column_error_add_seaport').addClass("d-none")

        if(parseInt(postData['thetichhienchua']) > parseInt(postData['thetichtoida']))
        {
            $('#error_add_seaport').text("Thể tích hiện tại không thể vượt qua thể tích tối đa")
            $('.column_error_add_seaport').removeClass("d-none")
            return false;
        }
        var dataUrl = $(this).data('api-link');
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData,
        });
    });
    $(document).on('click','input[name="searchSubmit"]', function() {
        var currentURL = new URL(window.location.href);
        currentURL.searchParams.delete('page');
        currentURL.searchParams.set('search', $("#search_seaport").val().toUpperCase());
        currentURL.searchParams.set('page', '1');
        window.location.href = currentURL;
  });
});
