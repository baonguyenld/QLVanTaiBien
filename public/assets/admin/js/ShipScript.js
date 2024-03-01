$(document).ready(function() {
    var urlSearch = $("#ship").data("ship");
    $.ajax({
        type: 'POST',
        url: urlSearch,
        success:  function(response)
        {
            let data = JSON.parse(response);
            var arrayShipId= [];
            let flag =false;
            data.forEach(element => {
                arrayShipId.push(element.matau);
            });
            $("#search_ship").on("focus",function() {
                if ($("#search_ship").val().length==0) {
                    $("#suggestionsShipSearch").prop("hidden", false);
                    count=arrayShipId.length;
                    if (count>=6) {
                        $("#suggestionsShipSearch").height(250);
                    }else  $("#suggestionsShipSearch").height(count*45);
                    arrayShipId.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#search_ship").val(element);
                            flag=false;
                            $("#suggestionsShipSearch").prop("hidden", true)
                        })
                    $("#suggestionsShipSearch").append(child);
                    });
                }else {
                    $("#suggestionsShipSearch").prop("hidden", false);
                    let inputValue =$("#search_ship").val().toLowerCase();
                    let filterArray =[];
                    arrayShipId.forEach(element => {
                                if(element.toLowerCase().includes(inputValue))
                                filterArray.push(element);
                        });
                    $("#suggestionsShipSearch").empty();
                    countFilter=filterArray.length;
                    if (countFilter>=6) {
                        $("#suggestionsShipSearch").height(250);
                    }else  $("#suggestionsShipSearch").height(countFilter*45);
                    filterArray.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#search_ship").val(element);
                            flag=false;
                            $("#suggestionsShipSearch").prop("hidden", true)
                        })
                    $("#suggestionsShipSearch").append(child);
                    });
                }
            })
            $("#search_ship").on("blur",function () {
                if (flag!=true) {
                    $("#suggestionsShipSearch").prop("hidden", true);
                  }
            })
            $("#search_ship").on("input",function () {
                let inputValue =$("#search_ship").val().toLowerCase();
                let filterArray =[];
                arrayShipId.forEach(element => {
                            if(element.toLowerCase().includes(inputValue))
                            filterArray.push(element);
                    });
                $("#suggestionsShipSearch").empty();
                countFilter=filterArray.length;
                if (countFilter>=6) {
                    $("#suggestionsShipSearch").height(250);
                }else  $("#suggestionsShipSearch").height(countFilter*45);
                filterArray.forEach(element => {   
                    let child = $("<div></div>");
                    child.text(element);
                    child.addClass("suggestion_item");
                    child.addClass("text-truncate");
                    child.on("click",function() {
                        $("#search_ship").val(element);
                        flag=false;
                        $("#suggestionsShipSearch").prop("hidden", true)
                    })
                $("#suggestionsShipSearch").append(child);
                });
            })
             $("#suggestionsShipSearch").mousedown(function() {
                flag=true;
            });
        }
    });
    $(document).on('click','.btn_change', function() {
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
                $('input[name="shipChangeId"]').val(data.matau);
                $('input[name="shipChangeName"]').val(data.tentau);
                $('input[name="shipChangeMaxWeight"]').val(data.trongluongtoida);
                $('input[name="shipChangeCurrentWeight"]').val(data.trongluonghienchua);
                $('input[name="shipChangeMaxVolume"]').val(data.thetichtoida);
                $('input[name="shipChangeCurrentVolume"]').val(data.thetichhienchua);
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
                $('input[name="shipDeleteId"]').val(data.matau);
                $('input[name="shipDeleteName"]').val(data.tentau);
                $('input[name="shipDeleteMaxWeight"]').val(data.trongluongtoida);
                $('input[name="shipDeleteCurrentWeight"]').val(data.trongluonghienchua);
                $('input[name="shipDeleteMaxVolume"]').val(data.thetichtoida);
                $('input[name="shipDeleteCurrentVolume"]').val(data.thetichhienchua);
            }
        });
    });
    $(document).on('click','button[name="submitChange"]', function() {
        var postData = {
            matau: $('input[name="shipChangeId"]').val(),
            tentau: $('input[name="shipChangeName"]').val(),
            trongluongtoida:  $('input[name="shipChangeMaxWeight"]').val(),
            trongluonghienchua:  $('input[name="shipChangeCurrentWeight"]').val(),
            thetichtoida:  $('input[name="shipChangeMaxVolume"]').val(),
            thetichhienchua:  $('input[name="shipChangeCurrentVolume"]').val(),
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
            matau: $('input[name="shipAddId"]').val(),
            tentau: $('input[name="shipAddName"]').val(),
            trongluongtoida:  $('input[name="shipAddMaxWeight"]').val(),
            trongluonghienchua:  $('input[name="shipAddCurrentWeight"]').val(),
            thetichtoida:  $('input[name="shipAddMaxVolume"]').val(),
            thetichhienchua:  $('input[name="shipAddCurrentVolume"]').val(),
            action: "insert"
        };
        var dataUrl = $(this).data('api-link');
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData,
        });
        
    });
    $(document).on('click','button[name="submitDelete"]', function() {
        var postData = {
            matau: $('input[name="shipDeleteId"]').val(),
            action: "delete"
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
        currentURL.searchParams.set('search', $("#search_ship").val().toUpperCase());
        currentURL.searchParams.set('page', '1');
        window.location.href = currentURL;
    });
    $("#ship_option_report").on("click",function () {
        let dataUrl=$("#ship_option_report").data('weight');
        $.ajax({
            type: 'POST',
            url: dataUrl,
            success:  function(response)
            {
                let data = JSON.parse(response);
                var arrayShipWeight= [];
                let flag =false;
                data.forEach(element => {
                    if(!arrayShipWeight.includes(element.trongluongtoida))
                        arrayShipWeight.push(element.trongluongtoida);
                });
                $("#shipReportMaxWeight").on("focus",function() {
                    if ($("#shipReportMaxWeight").val().length==0) {
                        $("#suggestionsShipReportMaxWeight").prop("hidden", false);
                        count=arrayShipWeight.length;
                        if (count>=6) {
                            $("#suggestionsShipReportMaxWeight").height(250);
                        }else  $("#suggestionsShipReportMaxWeight").height(count*45);
                        arrayShipWeight.forEach(element => {   
                            let child = $("<div></div>");
                            child.text(element);
                            child.addClass("suggestion_item");
                            child.addClass("text-truncate");
                            child.on("click",function() {
                                $("#shipReportMaxWeight").val(element);
                                flag=false;
                                $("#suggestionsShipReportMaxWeight").prop("hidden", true)
                            })
                            $("#suggestionsShipReportMaxWeight").append(child);
                        });     
                    } else {
                        $("#suggestionsShipReportMaxWeight").prop("hidden", false);
                        let inputValue =$("#shipReportMaxWeight").val().toLowerCase();
                        let filterArray =[];
                        arrayShipWeight.forEach(element => {
                                    if(element.toLowerCase().includes(inputValue))
                                    filterArray.push(element);
                            });
                        $("#suggestionsShipReportMaxWeight").empty();
                        countFilter=filterArray.length;
                        if (countFilter>=6) {
                            $("#suggestionsShipReportMaxWeight").height(250);
                        }else  $("#suggestionsShipReportMaxWeight").height(countFilter*45);
                        filterArray.forEach(element => {   
                            let child = $("<div></div>");
                            child.text(element);
                            child.addClass("suggestion_item");
                            child.addClass("text-truncate");
                            child.on("click",function() {
                                $("#shipReportMaxWeight").val(element);
                                flag=false;
                                $("#suggestionsShipReportMaxWeight").prop("hidden", true)
                            })
                        $("#suggestionsShipReportMaxWeight").append(child);
                        });
                    }
                })
                $("#shipReportMaxWeight").on("blur",function () {
                    if (flag!=true) {
                        $("#suggestionsShipReportMaxWeight").prop("hidden", true);
                      }
                })
                $("#shipReportMaxWeight").on("input",function () {
                    let inputValue =$("#shipReportMaxWeight").val().toLowerCase();
                    let filterArray =[];
                    arrayShipWeight.forEach(element => {
                                if(element.toLowerCase().includes(inputValue))
                                filterArray.push(element);
                        });
                    $("#suggestionsShipReportMaxWeight").empty();
                    countFilter=filterArray.length;
                    if (countFilter>=6) {
                        $("#suggestionsShipReportMaxWeight").height(250);
                    }else  $("#suggestionsShipReportMaxWeight").height(countFilter*45);
                    filterArray.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#shipReportMaxWeight").val(element);
                            flag=false;
                            $("#suggestionsShipReportMaxWeight").prop("hidden", true)
                        })
                    $("#suggestionsShipReportMaxWeight").append(child);
                    });
                })
                $("#suggestionsShipReportMaxWeight").mousedown(function() {
                    flag=true;
                });
    
            }
        });

        dataUrl=$("#ship_option_report").data('volume');
        $.ajax({
            type: 'POST',
            url: dataUrl,
            success:  function(response)
            {
                let data = JSON.parse(response);
                var arrayShipVolume= [];
                let flag =false;
                data.forEach(element => {
                    if(!arrayShipVolume.includes(element.thetichtoida))
                        arrayShipVolume.push(element.thetichtoida);
                });
                $("#shipReportMaxVolume").on("focus",function() {
                    if ($("#shipReportMaxVolume").val().length==0) {
                        $("#suggestionsShipReportMaxVolume").prop("hidden", false);
                        count=arrayShipVolume.length;
                        if (count>=6) {
                            $("#suggestionsShipReportMaxVolume").height(250);
                        }else  $("#suggestionsShipReportMaxVolume").height(count*45);
                        arrayShipVolume.forEach(element => {   
                            let child = $("<div></div>");
                            child.text(element);
                            child.addClass("suggestion_item");
                            child.addClass("text-truncate");
                            child.on("click",function() {
                                $("#shipReportMaxVolume").val(element);
                                flag=false;
                                $("#suggestionsShipReportMaxVolume").prop("hidden", true)
                            })
                            $("#suggestionsShipReportMaxVolume").append(child);
                        });     
                    } else {
                        $("#suggestionsShipReportMaxVolume").prop("hidden", false);
                        let inputValue =$("#shipReportMaxVolume").val().toLowerCase();
                        let filterArray =[];
                        arrayShipVolume.forEach(element => {
                                    if(element.toLowerCase().includes(inputValue))
                                    filterArray.push(element);
                            });
                        $("#suggestionsShipReportMaxVolume").empty();
                        countFilter=filterArray.length;
                        if (countFilter>=6) {
                            $("#suggestionsShipReportMaxVolume").height(250);
                        }else  $("#suggestionsShipReportMaxVolume").height(countFilter*45);
                        filterArray.forEach(element => {   
                            let child = $("<div></div>");
                            child.text(element);
                            child.addClass("suggestion_item");
                            child.addClass("text-truncate");
                            child.on("click",function() {
                                $("#shipReportMaxVolume").val(element);
                                flag=false;
                                $("#suggestionsShipReportMaxVolume").prop("hidden", true)
                            })
                        $("#suggestionsShipReportMaxVolume").append(child);
                        });
                    }
                })
                $("#shipReportMaxVolume").on("blur",function () {
                    if (flag!=true) {
                        $("#suggestionsShipReportMaxVolume").prop("hidden", true);
                      }
                })
                $("#shipReportMaxVolume").on("input",function () {
                    let inputValue =$("#shipReportMaxVolume").val().toLowerCase();
                    let filterArray =[];
                    arrayShipVolume.forEach(element => {
                                if(element.toLowerCase().includes(inputValue))
                                filterArray.push(element);
                        });
                    $("#suggestionsShipReportMaxVolume").empty();
                    countFilter=filterArray.length;
                    if (countFilter>=6) {
                        $("#suggestionsShipReportMaxVolume").height(250);
                    }else  $("#suggestionsShipReportMaxVolume").height(countFilter*45);
                    filterArray.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#shipReportMaxWeight").val(element);
                            flag=false;
                            $("#suggestionsShipReportMaxVolume").prop("hidden", true)
                        })
                    $("#suggestionsShipReportMaxVolume").append(child);
                    });
                })
                $("#suggestionsShipReportMaxVolume").mousedown(function() {
                    flag=true;
                });
    
            }
        });
    })  
});
