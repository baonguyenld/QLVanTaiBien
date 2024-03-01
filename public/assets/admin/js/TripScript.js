$(document).ready(function() {
      var urlSearch = $("#trip").data("trip");
    $.ajax({
        type: 'POST',
        url: urlSearch,
        success:  function(response)
        {
            let data = JSON.parse(response);
            var arrayTripId= [];
            let flag =false;
            data.forEach(element => {
                arrayTripId.push(element.machuyentau);
            });
            $("#search_trip").on("focus",function() {
                if ($("#search_trip").val().length==0) {
                    $("#suggestionsTripSearch").prop("hidden", false);
                    count=arrayTripId.length;
                    if (count>=6) {
                        $("#suggestionsTripSearch").height(250);
                    }else  $("#suggestionsTripSearch").height(count*45);
                    arrayTripId.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#search_trip").val(element);
                            flag=false;
                            $("#suggestionsTripSearch").prop("hidden", true)
                        })
                    $("#suggestionsTripSearch").append(child);
                    });
                }else {
                    $("#suggestionsTripSearch").prop("hidden", false);
                    let inputValue =$("#search_trip").val().toLowerCase();
                    let filterArray =[];
                    arrayTripId.forEach(element => {
                                if(element.toLowerCase().includes(inputValue))
                                filterArray.push(element);
                        });
                    $("#suggestionsTripSearch").empty();
                    countFilter=filterArray.length;
                    if (countFilter>=6) {
                        $("#suggestionsTripSearch").height(250);
                    }else  $("#suggestionsTripSearch").height(countFilter*45);
                    filterArray.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#search_trip").val(element);
                            flag=false;
                            $("#suggestionsTripSearch").prop("hidden", true)
                        })
                    $("#suggestionsTripSearch").append(child);
                    });
                }
            })
            $("#search_trip").on("blur",function () {
                if (flag!=true) {
                    $("#suggestionsTripSearch").prop("hidden", true);
                  }
            })
            $("#search_trip").on("input",function () {
                let inputValue =$("#search_trip").val().toLowerCase();
                let filterArray =[];
                arrayTripId.forEach(element => {
                            if(element.toLowerCase().includes(inputValue))
                            filterArray.push(element);
                    });
                $("#suggestionsTripSearch").empty();
                countFilter=filterArray.length;
                if (countFilter>=6) {
                    $("#suggestionsTripSearch").height(250);
                }else  $("#suggestionsTripSearch").height(countFilter*45);
                filterArray.forEach(element => {   
                    let child = $("<div></div>");
                    child.text(element);
                    child.addClass("suggestion_item");
                    child.addClass("text-truncate");
                    child.on("click",function() {
                        $("#search_trip").val(element);
                        flag=false;
                        $("#suggestionsTripSearch").prop("hidden", true)
                    })
                $("#suggestionsTripSearch").append(child);
                });
            })
             $("#suggestionsTripSearch").mousedown(function() {
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
                $('input[name="tripChangeSchedule"]').val(data.malichtrinh);
                $('input[name="tripChangeId"]').val(data.machuyentau);
                $('input[name="tripChangeShip"]').val(data.matau);
                $('input[name="tripChangeTime"]').val(data.thoigiantrihoan);
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
                $('input[name="tripDeleteSchedule"]').val(data.malichtrinh);
                $('input[name="tripDeleteId"]').val(data.machuyentau);
                $('input[name="tripDeleteShip"]').val(data.matau);
                $('input[name="tripDeleteTime"]').val(data.thoigiantrihoan);
            }
        });
    });
    $(document).on('click','button[name="submitChange"]', function() {
        var postData = {
            malichtrinh: $('input[name="tripChangeSchedule"]').val(),
            machuyentau: $('input[name="tripChangeId"]').val(),
            matau:  $('input[name="tripChangeShip"]').val(),
            thoigiantrihoan:  $('input[name="tripChangeTime"]').val(),
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
            malichtrinh: $('input[name="tripAddSchedule"]').val(),
            matau:  $('input[name="tripAddShip"]').val(),
            thoigiantrihoan:  $('input[name="tripAddTime"]').val(),
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
            machuyentau: $('input[name="tripDeleteId"]').val(),
            action: "delete"
        };
       
        var dataUrl = $(this).data('api-link');
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData,
            success: function(response) {
                var data = JSON.parse(response);
                if(data)
                {
                    $(".error_delete_trip").text(`Chuyến tàu đang được liên kết với vận đơn ${data['message']}`)
                    $(".column_error_delete_trip").removeClass("d-none")
                    return false
                }        
                else {
                    $(".column_error_delete_trip").addClass("d-none")
                }    
            }
        });  

      });
      $(document).on('click','input[name="searchSubmit"]', function() {
            
        var currentURL = new URL(window.location.href);
        currentURL.searchParams.delete('page');
        currentURL.searchParams.set('search', $("#search_trip").val().toUpperCase());
        currentURL.searchParams.set('page', '1');
        window.location.href = currentURL;
      });
      $(document).on('click','#trip_option_add', function() {
        let dataUrl=$("#trip_option_add").data('schedule');
        $.ajax({
            type: 'POST',
            url: dataUrl,
            success:  function(response)
            {
                let data = JSON.parse(response);
                var arrayScheduleId= [];
                let flag =false;
                data.forEach(element => {
                    arrayScheduleId.push(element.malichtrinh);
                });
                $("#tripAddSchedule").on("focus",function() {
                    if ($("#tripAddSchedule").val().length==0) {
                        $("#suggestionsTripAddSchedule").prop("hidden", false);
                        count=arrayScheduleId.length;
                        if (count>=6) {
                            $("#suggestionsTripAddSchedule").height(250);
                        }else  $("#suggestionsTripAddSchedule").height(count*45);
                        arrayScheduleId.forEach(element => {   
                            let child = $("<div></div>");
                            child.text(element);
                            child.addClass("suggestion_item");
                            child.addClass("text-truncate");
                            child.on("click",function() {
                                $("#tripAddSchedule").val(element);
                                flag=false;
                                $("#suggestionsTripAddSchedule").prop("hidden", true)
                            })
                        $("#suggestionsTripAddSchedule").append(child);
                        });     
                    } else {
                        $("#suggestionsTripAddSchedule").prop("hidden", false);
                        let inputValue =$("#tripAddSchedule").val().toLowerCase();
                        let filterArray =[];
                        arrayScheduleId.forEach(element => {
                                    if(element.toLowerCase().includes(inputValue))
                                    filterArray.push(element);
                            });
                        $("#suggestionsTripAddSchedule").empty();
                        countFilter=filterArray.length;
                        if (countFilter>=6) {
                            $("#suggestionsTripAddSchedule").height(250);
                        }else  $("#suggestionsTripAddSchedule").height(countFilter*45);
                        filterArray.forEach(element => {   
                            let child = $("<div></div>");
                            child.text(element);
                            child.addClass("suggestion_item");
                            child.addClass("text-truncate");
                            child.on("click",function() {
                                $("#tripAddSchedule").val(element);
                                flag=false;
                                $("#suggestionsTripAddSchedule").prop("hidden", true)
                            })
                        $("#suggestionsTripAddSchedule").append(child);
                        });
                    }
    
                })
                $("#tripAddSchedule").on("blur",function () {
                    if (flag!=true) {
                        $("#suggestionsTripAddSchedule").prop("hidden", true);
                      }
                })
                $("#tripAddSchedule").on("input",function () {
                    let inputValue =$("#tripAddSchedule").val().toLowerCase();
                    let filterArray =[];
                    arrayScheduleId.forEach(element => {
                                if(element.toLowerCase().includes(inputValue))
                                filterArray.push(element);
                        });
                    $("#suggestionsTripAddSchedule").empty();
                    countFilter=filterArray.length;
                    if (countFilter>=6) {
                        $("#suggestionsTripAddSchedule").height(250);
                    }else  $("#suggestionsTripAddSchedule").height(countFilter*45);
                    filterArray.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#tripAddSchedule").val(element);
                            flag=false;
                            $("#suggestionsTripAddSchedule").prop("hidden", true)
                        })
                    $("#suggestionsTripAddSchedule").append(child);
                    });
                })
                $("#suggestionsTripAddSchedule").mousedown(function() {
                    flag=true;
                });
            }
        });

        dataUrl=$("#trip_option_add").data('ship');
        $.ajax({
            type: 'POST',
            url: dataUrl,
            success:  function(response)
            {
                let data = JSON.parse(response);
                var arrayShipId= [];
                let flag =false;
                data.forEach(element => {
                    arrayShipId.push(element.matau);
                });
                $("#tripAddShip").on("focus",function() {
                    if ($("#tripAddShip").val().length==0) {
                        $("#suggestionsTripAddShip").prop("hidden", false);
                        count=arrayShipId.length;
                        if (count>=6) {
                            $("#suggestionsTripAddShip").height(250);
                        }else  $("#suggestionsTripAddShip").height(count*45);
                        arrayShipId.forEach(element => {   
                            let child = $("<div></div>");
                            child.text(element);
                            child.addClass("suggestion_item");
                            child.addClass("text-truncate");
                            child.on("click",function() {
                                $("#tripAddShip").val(element);
                                flag=false;
                                $("#suggestionsTripAddShip").prop("hidden", true)
                            })
                        $("#suggestionsTripAddShip").append(child);
                        });     
                    } else {
                        $("#suggestionsTripAddShip").prop("hidden", false);
                        let inputValue =$("#tripAddShip").val().toLowerCase();
                        let filterArray =[];
                        arrayShipId.forEach(element => {
                                    if(element.toLowerCase().includes(inputValue))
                                    filterArray.push(element);
                            });
                        $("#suggestionsTripAddShip").empty();
                        countFilter=filterArray.length;
                        if (countFilter>=6) {
                            $("#suggestionsTripAddShip").height(250);
                        }else  $("#suggestionsTripAddShip").height(countFilter*45);
                        filterArray.forEach(element => {   
                            let child = $("<div></div>");
                            child.text(element);
                            child.addClass("suggestion_item");
                            child.addClass("text-truncate");
                            child.on("click",function() {
                                $("#tripAddShip").val(element);
                                flag=false;
                                $("#suggestionsTripAddShip").prop("hidden", true)
                            })
                        $("#suggestionsTripAddShip").append(child);
                        });
                    }
    
                })
                $("#tripAddShip").on("blur",function () {
                    if (flag!=true) {
                        $("#suggestionsTripAddShip").prop("hidden", true);
                      }
                })
                $("#tripAddShip").on("input",function () {
                    let inputValue =$("#tripAddShip").val().toLowerCase();
                    let filterArray =[];
                    arrayShipId.forEach(element => {
                                if(element.toLowerCase().includes(inputValue))
                                filterArray.push(element);
                        });
                    $("#suggestionsTripAddShip").empty();
                    countFilter=filterArray.length;
                    if (countFilter>=6) {
                        $("#suggestionsTripAddShip").height(250);
                    }else  $("#suggestionsTripAddShip").height(countFilter*45);
                    filterArray.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#tripAddShip").val(element);
                            flag=false;
                            $("#suggestionsTripAddShip").prop("hidden", true)
                        })
                    $("#suggestionsTripAddShip").append(child);
                    });
                })
                $("#suggestionsTripAddShip").mousedown(function() {
                    flag=true;
                });
            }
        });
        
    });
    $(document).on('click','#trip_option_report', function() {
        let dataUrl=$("#trip_option_report").data('schedule');
        $.ajax({
            type: 'POST',
            url: dataUrl,
            success:  function(response)
            {
                let data = JSON.parse(response);
                var arrayScheduleId= [];
                let flag =false;
                data.forEach(element => {
                    arrayScheduleId.push(element.malichtrinh);
                });
                $("#tripReportSchedule").on("focus",function() {
                    if ($("#tripReportSchedule").val().length==0) {
                        $("#suggestionsTripReportSchedule").prop("hidden", false);
                        count=arrayScheduleId.length;
                        if (count>=6) {
                            $("#suggestionsTripReportSchedule").height(250);
                        }else  $("#suggestionsTripReportSchedule").height(count*45);
                        arrayScheduleId.forEach(element => {   
                            let child = $("<div></div>");
                            child.text(element);
                            child.addClass("suggestion_item");
                            child.addClass("text-truncate");
                            child.on("click",function() {
                                $("#tripReportSchedule").val(element);
                                flag=false;
                                $("#suggestionsTripReportSchedule").prop("hidden", true)
                            })
                        $("#suggestionsTripReportSchedule").append(child);
                        });     
                    } else {
                        $("#suggestionsTripReportSchedule").prop("hidden", false);
                        let inputValue =$("#tripReportSchedule").val().toLowerCase();
                        let filterArray =[];
                        arrayScheduleId.forEach(element => {
                                    if(element.toLowerCase().includes(inputValue))
                                    filterArray.push(element);
                            });
                        $("#suggestionsTripReportSchedule").empty();
                        countFilter=filterArray.length;
                        if (countFilter>=6) {
                            $("#suggestionsTripReportSchedule").height(250);
                        }else  $("#suggestionsTripReportSchedule").height(countFilter*45);
                        filterArray.forEach(element => {   
                            let child = $("<div></div>");
                            child.text(element);
                            child.addClass("suggestion_item");
                            child.addClass("text-truncate");
                            child.on("click",function() {
                                $("#tripReportSchedule").val(element);
                                flag=false;
                                $("#suggestionsTripReportSchedule").prop("hidden", true)
                            })
                        $("#suggestionsTripReportSchedule").append(child);
                        });
                    }
    
                })
                $("#tripReportSchedule").on("blur",function () {
                    if (flag!=true) {
                        $("#suggestionsTripReportSchedule").prop("hidden", true);
                      }
                })
                $("#tripReportSchedule").on("input",function () {
                    let inputValue =$("#tripReportSchedule").val().toLowerCase();
                    let filterArray =[];
                    arrayScheduleId.forEach(element => {
                                if(element.toLowerCase().includes(inputValue))
                                filterArray.push(element);
                        });
                    $("#suggestionsTripReportSchedule").empty();
                    countFilter=filterArray.length;
                    if (countFilter>=6) {
                        $("#suggestionsTripReportSchedule").height(250);
                    }else  $("#suggestionsTripReportSchedule").height(countFilter*45);
                    filterArray.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#tripReportSchedule").val(element);
                            flag=false;
                            $("#suggestionsTripReportSchedule").prop("hidden", true)
                        })
                    $("#suggestionsTripReportSchedule").append(child);
                    });
                })
                $("#suggestionsTripReportSchedule").mousedown(function() {
                    flag=true;
                });
            }
        });

        
        
    });
    $(document).on('click','#trip_option_change', function() {
        let dataUrl=$("#trip_option_change").data('schedule');
        $.ajax({
            type: 'POST',
            url: dataUrl,
            success:  function(response)
            {
                let data = JSON.parse(response);
                var arrayScheduleId= [];
                let flag =false;
                data.forEach(element => {
                    arrayScheduleId.push(element.malichtrinh);
                });
                $("#tripChangeSchedule").on("focus",function() {
                    if ($("#tripChangeSchedule").val().length==0) {
                        $("#suggestionsTripChangeSchedule").prop("hidden", false);
                        count=arrayScheduleId.length;
                        if (count>=6) {
                            $("#suggestionsTripChangeSchedule").height(250);
                        }else  $("#suggestionsTripChangeSchedule").height(count*45);
                        arrayScheduleId.forEach(element => {   
                            let child = $("<div></div>");
                            child.text(element);
                            child.addClass("suggestion_item");
                            child.addClass("text-truncate");
                            child.on("click",function() {
                                $("#tripChangeSchedule").val(element);
                                flag=false;
                                $("#suggestionsTripChangeSchedule").prop("hidden", true)
                            })
                        $("#suggestionsTripChangeSchedule").append(child);
                        });     
                    } else {
                        $("#suggestionsTripChangeSchedule").prop("hidden", false);
                        let inputValue =$("#tripChangeSchedule").val().toLowerCase();
                        let filterArray =[];
                        arrayScheduleId.forEach(element => {
                                    if(element.toLowerCase().includes(inputValue))
                                    filterArray.push(element);
                            });
                        $("#suggestionsTripChangeSchedule").empty();
                        countFilter=filterArray.length;
                        if (countFilter>=6) {
                            $("#suggestionsTripChangeSchedule").height(250);
                        }else  $("#suggestionsTripChangeSchedule").height(countFilter*45);
                        filterArray.forEach(element => {   
                            let child = $("<div></div>");
                            child.text(element);
                            child.addClass("suggestion_item");
                            child.addClass("text-truncate");
                            child.on("click",function() {
                                $("#tripChangeSchedule").val(element);
                                flag=false;
                                $("#suggestionsTripChangeSchedule").prop("hidden", true)
                            })
                        $("#suggestionsTripChangeSchedule").append(child);
                        });
                    }
    
                })
                $("#tripChangeSchedule").on("blur",function () {
                    if (flag!=true) {
                        $("#suggestionsTripChangeSchedule").prop("hidden", true);
                      }
                })
                $("#tripChangeSchedule").on("input",function () {
                    let inputValue =$("#tripChangeSchedule").val().toLowerCase();
                    let filterArray =[];
                    arrayScheduleId.forEach(element => {
                                if(element.toLowerCase().includes(inputValue))
                                filterArray.push(element);
                        });
                    $("#suggestionsTripChangeSchedule").empty();
                    countFilter=filterArray.length;
                    if (countFilter>=6) {
                        $("#suggestionsTripChangeSchedule").height(250);
                    }else  $("#suggestionsTripChangeSchedule").height(countFilter*45);
                    filterArray.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#tripChangeSchedule").val(element);
                            flag=false;
                            $("#suggestionsTripChangeSchedule").prop("hidden", true)
                        })
                    $("#suggestionsTripChangeSchedule").append(child);
                    });
                })
                $("#suggestionsTripChangeSchedule").mousedown(function() {
                    flag=true;
                });
            }
        });

        dataUrl=$("#trip_option_change").data('ship');
        $.ajax({
            type: 'POST',
            url: dataUrl,
            success:  function(response)
            {
                let data = JSON.parse(response);
                var arrayShipId= [];
                let flag =false;
                data.forEach(element => {
                    arrayShipId.push(element.matau);
                });
                $("#tripChangeShip").on("focus",function() {
                    if ($("#tripChangeShip").val().length==0) {
                        $("#suggestionsTripChangeShip").prop("hidden", false);
                        count=arrayShipId.length;
                        if (count>=6) {
                            $("#suggestionsTripChangeShip").height(250);
                        }else  $("#suggestionsTripChangeShip").height(count*45);
                        arrayShipId.forEach(element => {   
                            let child = $("<div></div>");
                            child.text(element);
                            child.addClass("suggestion_item");
                            child.addClass("text-truncate");
                            child.on("click",function() {
                                $("#tripChangeShip").val(element);
                                flag=false;
                                $("#suggestionsTripChangeShip").prop("hidden", true)
                            })
                        $("#suggestionsTripChangeShip").append(child);
                        });     
                    } else {
                        $("#suggestionsTripChangeShip").prop("hidden", false);
                        let inputValue =$("#tripChangeShip").val().toLowerCase();
                        let filterArray =[];
                        arrayShipId.forEach(element => {
                                    if(element.toLowerCase().includes(inputValue))
                                    filterArray.push(element);
                            });
                        $("#suggestionsTripChangeShip").empty();
                        countFilter=filterArray.length;
                        if (countFilter>=6) {
                            $("#suggestionsTripChangeShip").height(250);
                        }else  $("#suggestionsTripChangeShip").height(countFilter*45);
                        filterArray.forEach(element => {   
                            let child = $("<div></div>");
                            child.text(element);
                            child.addClass("suggestion_item");
                            child.addClass("text-truncate");
                            child.on("click",function() {
                                $("#tripChangeShip").val(element);
                                flag=false;
                                $("#suggestionsTripChangeShip").prop("hidden", true)
                            })
                        $("#suggestionsTripChangeShip").append(child);
                        });
                    }
    
                })
                $("#tripChangeShip").on("blur",function () {
                    if (flag!=true) {
                        $("#suggestionsTripChangeShip").prop("hidden", true);
                      }
                })
                $("#tripChangeShip").on("input",function () {
                    let inputValue =$("#tripChangeShip").val().toLowerCase();
                    let filterArray =[];
                    arrayShipId.forEach(element => {
                                if(element.toLowerCase().includes(inputValue))
                                filterArray.push(element);
                        });
                    $("#suggestionsTripChangeShip").empty();
                    countFilter=filterArray.length;
                    if (countFilter>=6) {
                        $("#suggestionsTripChangeShip").height(250);
                    }else  $("#suggestionsTripChangeShip").height(countFilter*45);
                    filterArray.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#tripChangeShip").val(element);
                            flag=false;
                            $("#suggestionsTripChangeShip").prop("hidden", true)
                        })
                    $("#suggestionsTripChangeShip").append(child);
                    });
                })
                $("#suggestionsTripChangeShip").mousedown(function() {
                    flag=true;
                });
            }
        });
        
    });
});
