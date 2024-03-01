$(document).ready(function() {
    var urlSearch = $("#price").data("price");
    $.ajax({
        type: 'POST',
        url: urlSearch,
        success:  function(response)
        {
            let data = JSON.parse(response);
            var arrayPriceId= [];
            let flag =false;
            data.forEach(element => {
                arrayPriceId.push(element.mabanggia);
            });
            $("#search_price").on("focus",function() {
                if ($("#search_price").val().length==0) {
                    $("#suggestionsPriceSearch").prop("hidden", false);
                    count=arrayPriceId.length;
                    if (count>=6) {
                        $("#suggestionsPriceSearch").height(250);
                    }else  $("#suggestionsPriceSearch").height(count*45);
                    arrayPriceId.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#search_price").val(element);
                            flag=false;
                            $("#suggestionsPriceSearch").prop("hidden", true)
                        })
                    $("#suggestionsPriceSearch").append(child);
                    });
                }else {
                    $("#suggestionsPriceSearch").prop("hidden", false);
                    let inputValue =$("#search_price").val().toLowerCase();
                    let filterArray =[];
                    arrayPriceId.forEach(element => {
                                if(element.toLowerCase().includes(inputValue))
                                filterArray.push(element);
                        });
                    $("#suggestionsPriceSearch").empty();
                    countFilter=filterArray.length;
                    if (countFilter>=6) {
                        $("#suggestionsPriceSearch").height(250);
                    }else  $("#suggestionsPriceSearch").height(countFilter*45);
                    filterArray.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#search_price").val(element);
                            flag=false;
                            $("#suggestionsPriceSearch").prop("hidden", true)
                        })
                    $("#suggestionsPriceSearch").append(child);
                    });
                }
            })
            $("#search_price").on("blur",function () {
                if (flag!=true) {
                    $("#suggestionsPriceSearch").prop("hidden", true);
                  }
            })
            $("#search_price").on("input",function () {

                let inputValue =$("#search_price").val().toLowerCase();
                let filterArray =[];
                arrayPriceId.forEach(element => {
                        console.log(element);
                            if((element+"").toLowerCase().includes(inputValue))
                            filterArray.push(element);
                    });
                $("#suggestionsPriceSearch").empty();
                countFilter=filterArray.length;
                if (countFilter>=6) {
                    $("#suggestionsPriceSearch").height(250);
                }else  $("#suggestionsPriceSearch").height(countFilter*45);
                filterArray.forEach(element => {   
                    let child = $("<div></div>");
                    child.text(element);
                    child.addClass("suggestion_item");
                    child.addClass("text-truncate");
                    child.on("click",function() {
                        $("#search_price").val(element);
                        flag=false;
                        $("#suggestionsPriceSearch").prop("hidden", true)
                    })
                $("#suggestionsPriceSearch").append(child);
                });
            })
             $("#suggestionsPriceSearch").mousedown(function() {
                flag=true;
            });
        }
    });
    $(document).on('click','input[name="searchSubmit"]', function() {

        var currentURL = new URL(window.location.href);
        currentURL.searchParams.delete('page');
        currentURL.searchParams.set('search', $("#search_price").val().toUpperCase());
        currentURL.searchParams.set('page', '1');
        window.location.href = currentURL;
    });
    $(document).on('click',"#submitAddPrice", function() {
        var dataUrl = $(this).data('api-link');
        var khoangcach = $("#priceAddSeaportA").val() + " - "+ $("#priceAddSeaportB").val();
        var postData = {
            maloai: $("#priceAddTypeContainer").val(),
            manhomhang: $("#priceAddTypeCargo").val(),
            khoangcach: khoangcach,
            gia: $("#priceAddValue").val(),
            action: "insert"
        };
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData,
        });
        
    });
    $(document).on('click',"#submitChangePrice", function() {
        var dataUrl = $(this).data('api-link');
        var khoangcach = $("#pricechangeSeaportA").val() + " - "+ $("#pricechangeSeaportB").val();
        var postData = {
            mabanggia: $("#priceChangeId").val(),
            maloai: $("#priceChangeTypeContainer").val(),
            manhomhang: $("#priceChangeTypeCargo").val(),
            khoangcach: khoangcach,
            gia: $("#priceChangeValue").val(),
            action: "update"
        };
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData,
        });
        
    });
    $(document).on('click',"#submitDeletePrice", function() {
        var dataUrl = $(this).data('api-link');
        var postData = {
            mabanggia: $("#priceDeleteId").val(),
            action: "delete"
        };
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData,
        });
        
    });
    $(document).on('click',".btn_change", function() {
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
                $("#priceChangeId").val(data['mabanggia']);
                $("#priceChangeTypeContainer").val(data['maloai']);
                $("#priceChangeTypeCargo").val(data['manhomhang']);
                let cang = data['khoangcach'].split(" - ");
                console.log(cang)
                $("#pricechangeSeaportA").val(cang[0]);
                $("#pricechangeSeaportB").val(cang[1]);
                $("#priceChangeValue").val(data['gia']);
            }
        });
    });
    $(document).on('click',".btn_delete", function() {
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
                $("#priceDeleteId").val(data['mabanggia']);
                $("#priceDeleteTypeContainer").val(data['maloai']);
                $("#priceDeleteTypeCargo").val(data['manhomhang']);
                $("#priceDeleteRange").val(data['khoangcach']);
                $("#priceDeleteValue").val(data['gia']);
            }
        });
    });
});