$(document).ready(function() {
    var urlSearch = $("#cargo").data("cargo");
    $.ajax({
        type: 'POST',
        url: urlSearch,
        success:  function(response)
        {
            let data = JSON.parse(response);
            var arrayCargoId= [];
            let flag =false;
            data.forEach(element => {
                arrayCargoId.push(element.mahanghoa);
            });
            $("#search_cargo").on("focus",function() {
                if ($("#search_cargo").val().length==0) {
                    $("#suggestionsCargoSearch").prop("hidden", false);
                    count=arrayCargoId.length;
                    if (count>=6) {
                        $("#suggestionsCargoSearch").height(250);
                    }else  $("#suggestionsCargoSearch").height(count*45);
                    arrayCargoId.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#search_cargo").val(element);
                            flag=false;
                            $("#suggestionsCargoSearch").prop("hidden", true)
                        })
                    $("#suggestionsCargoSearch").append(child);
                    });
                }else {
                    $("#suggestionsCargoSearch").prop("hidden", false);
                    let inputValue =$("#search_cargo").val().toLowerCase();
                    let filterArray =[];
                    arrayCargoId.forEach(element => {
                                if(element.toLowerCase().includes(inputValue))
                                filterArray.push(element);
                        });
                    $("#suggestionsCargoSearch").empty();
                    countFilter=filterArray.length;
                    if (countFilter>=6) {
                        $("#suggestionsCargoSearch").height(250);
                    }else  $("#suggestionsCargoSearch").height(countFilter*45);
                    filterArray.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#search_cargo").val(element);
                            flag=false;
                            $("#suggestionsCargoSearch").prop("hidden", true)
                        })
                    $("#suggestionsCargoSearch").append(child);
                    });
                }
            })
            $("#search_cargo").on("blur",function () {
                if (flag!=true) {
                    $("#suggestionsCargoSearch").prop("hidden", true);
                  }
            })
            $("#search_cargo").on("input",function () {
                let inputValue =$("#search_cargo").val().toLowerCase();
                let filterArray =[];
                arrayCargoId.forEach(element => {
                            if(element.toLowerCase().includes(inputValue))
                            filterArray.push(element);
                    });
                $("#suggestionsCargoSearch").empty();
                countFilter=filterArray.length;
                if (countFilter>=6) {
                    $("#suggestionsCargoSearch").height(250);
                }else  $("#suggestionsCargoSearch").height(countFilter*45);
                filterArray.forEach(element => {   
                    let child = $("<div></div>");
                    child.text(element);
                    child.addClass("suggestion_item");
                    child.addClass("text-truncate");
                    child.on("click",function() {
                        $("#search_cargo").val(element);
                        flag=false;
                        $("#suggestionsCargoSearch").prop("hidden", true)
                    })
                $("#suggestionsCargoSearch").append(child);
                });
            })
             $("#suggestionsCargoSearch").mousedown(function() {
                flag=true;
            });
        }
    });
    $(document).on('click','.btn_change', function() {
        var dataId = $(this).data('change-id');
        var dataUrl = $(this).data('api-link');
        var postData = {
            id: dataId,
            typeGetData: 'change'
        };
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData,
            success: function(response) {
                var data = JSON.parse(response);
                $('input[name="cargoChangeName"]').val(data['cargo'].tenhanghoa);
                $('input[name="cargoChangeId"]').val(data['cargo'].mahanghoa);
                let html = '';
                data['typecargo'].forEach(element => {
                   html+= "<option value='"+ element['manhomhang']+"'>"+element['tennhomhang']+"</option>";
                });
                $('#cargoChangeType').html(html);
                $('#cargoChangeContract').val(data['cargo'].mahopdong);
                $('#cargoChangeType').val(data['cargo'].manhomhang);
                $('input[name="cargoChangeWeight"]').val(data['cargo'].trongluong);
              
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
                console.log(data);
                $('input[name="cargoDeleteName"]').val(data.tenhanghoa);
                $('input[name="cargoDeleteId"]').val(data.mahanghoa);
                $('input[name="cargoDeleteType"]').val(data.tennhomhang);
                $('input[name="cargoDeleteWeight"]').val(data.trongluong);
            }
        });
        return false;
    });
    $(document).on('click','button[name="submitDelete"]', function() {
        var postData = {
            mahanghoa: $('input[name="cargoDeleteId"]').val(),
            action: "delete"
        };
        var dataUrl = $(this).data('api-link');
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData, 
        });
      });
    $(document).on('click','button[name="submitChange"]', function() {
        var postData = {
            mahanghoa: $('input[name="cargoChangeId"]').val(),
            tenhanghoa: $('input[name="cargoChangeName"]').val(),
            tennhomhang:  $('input[name="cargoChangeType"]').val(),
            trongluong:  $('input[name="cargoChangeWeight"]').val(),
            action: "update"
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
            mahopdong: $('input[name="cargoAddContract"]').val(),
            tenhanghoa: $('input[name="cargoAddName"]').val(),
            manhomhang:  $('#cargoAddType').val(),
            trongluong:  $('input[name="cargoAddWeight"]').val(),
            action: "insert"
        };
        var dataUrl = $(this).data('api-link');

        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData,
        });
    });
    $(document).on('click','.cargo_insert', function(){
        var postData = {
            typeGetData: "insert"
        };
        var dataUrl = $(this).data('api-link');
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData,
            success: function(response){
                var data = JSON.parse(response);
                let html = '';
                data.forEach(element => {
                   html+= "<option value='"+ element['manhomhang']+"'>"+element['tennhomhang']+"</option>";
                });
                $('#cargoAddType').html(html);
            }
        });
        
        Url=$(".cargo_insert").data('contract');
        $.ajax({
            type: 'POST',
            url: Url,
            success:  function(response)
            {
                let data = JSON.parse(response);
                var arrayContractId= [];
                let flag =false;
                data.forEach(element => {
                    arrayContractId.push(element.mahopdong);
                });
                $("#cargoAddContract").on("focus",function() {
                    console.log("hello");
                    if ($("#cargoAddContract").val().length==0) {
                        $("#suggestionsCargoAddContract").prop("hidden", false);
                        count=arrayContractId.length;
                        if (count>=6) {
                            $("#suggestionsCargoAddContract").height(250);
                        }else  $("#suggestionsCargoAddContract").height(count*45);
                        arrayContractId.forEach(element => {   
                            let child = $("<div></div>");
                            child.text(element);
                            child.addClass("suggestion_item");
                            child.addClass("text-truncate");
                            child.on("click",function() {
                                $("#cargoAddContract").val(element);
                                flag=false;
                                $("#suggestionsCargoAddContract").prop("hidden", true)
                            })
                        $("#suggestionsCargoAddContract").append(child);
                        });     
                    } else {
                        $("#suggestionsCargoAddContract").prop("hidden", false);
                        let inputValue =$("#cargoAddContract").val().toLowerCase();
                        let filterArray =[];
                        arrayContractId.forEach(element => {
                                    if(element.toLowerCase().includes(inputValue))
                                    filterArray.push(element);
                            });
                        $("#suggestionsCargoAddContract").empty();
                        countFilter=filterArray.length;
                        if (countFilter>=6) {
                            $("#suggestionsCargoAddContract").height(250);
                        }else  $("#suggestionsCargoAddContract").height(countFilter*45);
                        filterArray.forEach(element => {   
                            let child = $("<div></div>");
                            child.text(element);
                            child.addClass("suggestion_item");
                            child.addClass("text-truncate");
                            child.on("click",function() {
                                $("#cargoAddContract").val(element);
                                flag=false;
                                $("#suggestionsCargoAddContract").prop("hidden", true)
                            })
                        $("#suggestionsCargoAddContract").append(child);
                        });
                    }
    
                })
                $("#cargoAddContract").on("blur",function () {
                    if (flag!=true) {
                        $("#suggestionsCargoAddContract").prop("hidden", true);
                      }
                })
                $("#cargoAddContract").on("input",function () {
                    let inputValue =$("#cargoAddContract").val().toLowerCase();
                    let filterArray =[];
                    arrayCustomerId.forEach(element => {
                                if(element.toLowerCase().includes(inputValue))
                                filterArray.push(element);
                        });
                    $("#suggestionsCargoAddContract").empty();
                    countFilter=filterArray.length;
                    if (countFilter>=6) {
                        $("#suggestionsCargoAddContract").height(250);
                    }else  $("#suggestionsCargoAddContract").height(countFilter*45);
                    filterArray.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#cargoAddContract").val(element);
                            flag=false;
                            $("#suggestionsCargoAddContract").prop("hidden", true)
                        })
                    $("#suggestionsCargoAddContract").append(child);
                    });
                })
                $("#suggestionsCargoAddContract").mousedown(function() {
                    flag=true;
                });
            }
        });

    });
    $(document).on('click','button[name="submitChange"]', function() {
        var postData = {
            mahanghoa: $('input[name="cargoChangeId"]').val(),
            tenhanghoa: $('input[name="cargoChangeName"]').val(),
            manhomhang:  $('#cargoChangeType').val(),
            trongluong:  $('input[name="cargoChangeWeight"]').val(),
            action: "update"
        };
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
        currentURL.searchParams.set('search', $("#search_cargo").val().toUpperCase());
        currentURL.searchParams.set('page', '1');
        window.location.href = currentURL;
  });
});
