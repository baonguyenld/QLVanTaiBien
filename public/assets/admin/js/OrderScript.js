$(document).ready(function() {
    var urlSearch = $("#order").data("order");
    $.ajax({
        type: 'POST',
        url: urlSearch,
        success:  function(response)
        {
            let data = JSON.parse(response);
            var arrayOrderId= [];
            let flag =false;
            data.forEach(element => {
                arrayOrderId.push(element.mavandon);
            });
            $("#search_order").on("focus",function() {
                if ($("#search_order").val().length==0) {
                    $("#suggestionsOrderSearch").prop("hidden", false);
                    count=arrayOrderId.length;
                    if (count>=6) {
                        $("#suggestionsOrderSearch").height(250);
                    }else  $("#suggestionsOrderSearch").height(count*45);
                    arrayOrderId.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#search_order").val(element);
                            flag=false;
                            $("#suggestionsOrderSearch").prop("hidden", true)
                        })
                    $("#suggestionsOrderSearch").append(child);
                    });
                }else {
                    $("#suggestionsOrderSearch").prop("hidden", false);
                    let inputValue =$("#search_order").val().toLowerCase();
                    let filterArray =[];
                    arrayOrderId.forEach(element => {
                                if(element.toLowerCase().includes(inputValue))
                                filterArray.push(element);
                        });
                    $("#suggestionsOrderSearch").empty();
                    countFilter=filterArray.length;
                    if (countFilter>=6) {
                        $("#suggestionsOrderSearch").height(250);
                    }else  $("#suggestionsOrderSearch").height(countFilter*45);
                    filterArray.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#search_order").val(element);
                            flag=false;
                            $("#suggestionsOrderSearch").prop("hidden", true)
                        })
                    $("#suggestionsOrderSearch").append(child);
                    });
                }
            })
            $("#search_order").on("blur",function () {
                if (flag!=true) {
                    $("#suggestionsOrderSearch").prop("hidden", true);
                  }
            })
            $("#search_order").on("input",function () {
                let inputValue =$("#search_order").val().toLowerCase();
                let filterArray =[];
                arrayOrderId.forEach(element => {
                            if(element.toLowerCase().includes(inputValue))
                            filterArray.push(element);
                    });
                $("#suggestionsOrderSearch").empty();
                countFilter=filterArray.length;
                if (countFilter>=6) {
                    $("#suggestionsOrderSearch").height(250);
                }else  $("#suggestionsOrderSearch").height(countFilter*45);
                filterArray.forEach(element => {   
                    let child = $("<div></div>");
                    child.text(element);
                    child.addClass("suggestion_item");
                    child.addClass("text-truncate");
                    child.on("click",function() {
                        $("#search_order").val(element);
                        flag=false;
                        $("#suggestionsOrderSearch").prop("hidden", true)
                    })
                $("#suggestionsOrderSearch").append(child);
                });
            })
             $("#suggestionsOrderSearch").mousedown(function() {
                flag=true;
            });
        }
    });
    checkedValues = [];
    soluong = 0;
    $(document).on('click','#order_option_add', function() {
        checkedValues = [];
        soluong = 0;
        let dataUrl=$("#order_option_add").data('contract');
        $.ajax({
            type: 'POST',
            url: dataUrl,
            success:  function(response)
            {
                let data = JSON.parse(response);
                var arrayContractId= [];
                let flag =false;
                data.forEach(element => {
                    arrayContractId.push(element.mahopdong);
                });
                $("#orderAddContract").on("focus",function() {
                    if ($("#orderAddContract").val().length==0) {
                        $("#suggestionsOrderAddContract").prop("hidden", false);
                        count=arrayContractId.length;
                        if (count>=6) {
                            $("#suggestionsOrderAddContract").height(250);
                        }else  $("#suggestionsOrderAddContract").height(count*45);
                        arrayContractId.forEach(element => {   
                            let child = $("<div></div>");
                            child.text(element);
                            child.addClass("suggestion_item");
                            child.addClass("text-truncate");
                            child.on("click",function() {
                                $("#orderAddContract").val(element);
                                flag=false;
                                $("#suggestionsOrderAddContract").prop("hidden", true)
                            })
                        $("#suggestionsOrderAddContract").append(child);
                        });     
                    } else {
                        $("#suggestionsOrderAddContract").prop("hidden", false);
                        let inputValue =$("#orderAddContract").val().toLowerCase();
                        let filterArray =[];
                        arrayContractId.forEach(element => {
                                    if(element.toLowerCase().includes(inputValue))
                                    filterArray.push(element);
                            });
                        $("#suggestionsOrderAddContract").empty();
                        countFilter=filterArray.length;
                        if (countFilter>=6) {
                            $("#suggestionsOrderAddContract").height(250);
                        }else  $("#suggestionsOrderAddContract").height(countFilter*45);
                        filterArray.forEach(element => {   
                            let child = $("<div></div>");
                            child.text(element);
                            child.addClass("suggestion_item");
                            child.addClass("text-truncate");
                            child.on("click",function() {
                                $("#orderAddContract").val(element);
                                flag=false;
                                $("#suggestionsOrderAddContract").prop("hidden", true)
                            })
                        $("#suggestionsOrderAddContract").append(child);
                        });
                    }
    
                })
                $("#orderAddContract").on("blur",function () {
                    if (flag!=true) {
                        $("#suggestionsOrderAddContract").prop("hidden", true);
                      }
                })
                $("#orderAddContract").on("input",function () {
                    let inputValue =$("#orderAddContract").val().toLowerCase();
                    let filterArray =[];
                    arrayContractId.forEach(element => {
                                if(element.toLowerCase().includes(inputValue))
                                filterArray.push(element);
                        });
                    $("#suggestionsOrderAddContract").empty();
                    countFilter=filterArray.length;
                    if (countFilter>=6) {
                        $("#suggestionsOrderAddContract").height(250);
                    }else  $("#suggestionsOrderAddContract").height(countFilter*45);
                    filterArray.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#orderAddContract").val(element);
                            flag=false;
                            $("#suggestionsOrderAddContract").prop("hidden", true)
                        })
                    $("#suggestionsOrderAddContract").append(child);
                    });
                })
                $("#suggestionsOrderAddContract").mousedown(function() {
                    flag=true;
                });
            }
        });

        dataUrl=$("#order_option_add").data('trip');
        $.ajax({
            type: 'POST',
            url: dataUrl,
            success:  function(response)
            {
                let data = JSON.parse(response);
                var arrayTripId= [];
                let flag =false;
                data.forEach(element => {
                    arrayTripId.push(element.machuyentau);
                });
                $("#orderAddTrip").on("focus",function() {
                    if ($("#orderAddTrip").val().length==0) {
                        $("#suggestionsOrderAddTrip").prop("hidden", false);
                        count=arrayTripId.length;
                        if (count>=6) {
                            $("#suggestionsOrderAddTrip").height(250);
                        }else  $("#suggestionsOrderAddTrip").height(count*45);
                        arrayTripId.forEach(element => {   
                            let child = $("<div></div>");
                            child.text(element);
                            child.addClass("suggestion_item");
                            child.addClass("text-truncate");
                            child.on("click",function() {
                                $("#orderAddTrip").val(element);
                                flag=false;
                                $("#suggestionsOrderAddTrip").prop("hidden", true)
                            })
                        $("#suggestionsOrderAddTrip").append(child);
                        });     
                    } else {
                        $("#suggestionsOrderAddTrip").prop("hidden", false);
                        let inputValue =$("#orderAddTrip").val().toLowerCase();
                        let filterArray =[];
                        arrayTripId.forEach(element => {
                                    if(element.toLowerCase().includes(inputValue))
                                    filterArray.push(element);
                            });
                        $("#suggestionsOrderAddTrip").empty();
                        countFilter=filterArray.length;
                        if (countFilter>=6) {
                            $("#suggestionsOrderAddTrip").height(250);
                        }else  $("#suggestionsOrderAddTrip").height(countFilter*45);
                        filterArray.forEach(element => {   
                            let child = $("<div></div>");
                            child.text(element);
                            child.addClass("suggestion_item");
                            child.addClass("text-truncate");
                            child.on("click",function() {
                                $("#orderAddTrip").val(element);
                                flag=false;
                                $("#suggestionsOrderAddTrip").prop("hidden", true)
                            })
                        $("#suggestionsOrderAddTrip").append(child);
                        });
                    }
    
                })
                $("#orderAddTrip").on("blur",function () {
                    if (flag!=true) {
                        $("#suggestionsOrderAddTrip").prop("hidden", true);
                      }
                })
                $("#orderAddTrip").on("input",function () {
                    let inputValue =$("#orderAddTrip").val().toLowerCase();
                    let filterArray =[];
                    arrayTripId.forEach(element => {
                                if(element.toLowerCase().includes(inputValue))
                                filterArray.push(element);
                        });
                    $("#suggestionsOrderAddTrip").empty();
                    countFilter=filterArray.length;
                    if (countFilter>=6) {
                        $("#suggestionsOrderAddTrip").height(250);
                    }else  $("#suggestionsOrderAddTrip").height(countFilter*45);
                    filterArray.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#orderAddTrip").val(element);
                            flag=false;
                            $("#suggestionsOrderAddTrip").prop("hidden", true)
                        })
                    $("#suggestionsOrderAddTrip").append(child);
                    });
                })
                $("#suggestionsOrderAddTrip").mousedown(function() {
                    flag=true;
                });
            }
        });
    });
    $(document).on('click','#btn_add_container', function() {

        var postData = {
            typeGetData: 'containerData'
        };
        var dataUrl = $(this).data('api-link');
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData,
            success: function(response)
            {
                var data = JSON.parse(response);
                var html = "";
                data.forEach(element => {
                    html+=`<tr><td class='text-center' >${element['macontainer']}</td>`+
                    `<td class='text-center' ><input type='checkbox' name='listAddContainer' `+ (checkedValues.indexOf(element['macontainer'])!=-1?"checked":"")+`  value='${element['macontainer']}' `+
                    `style='width: 25px;height: 25px;'></td></tr>`;
                })
               
                $("#container-add-data").html(html);
                
                
            }
        });
    });
    $(document).on('click','#add_container_to_order', function() {
        soluong = 0
        checkedValues =[];
        $('input[name="listAddContainer"]:checked').each(function () {
            var macontainer = $(this).val();
            checkedValues.push(macontainer);
            soluong++;
        });
        $('input[name="orderAddQuantity"]').val(soluong);
    });
    $(document).on('click','#btn_close_add_order', function() {
        checkedValues = [];
        soluong = 0;
        $('input[name="orderAddQuantity"]').val(0);
    });
    $(document).on('click','#submitAddOrder', function() {
        var postData = {
            mahopdong:  $('#orderAddContract').val(),
            tennguoinhan:   $('#orderAddReceiver').val(),
            diachinhan:  $('#orderAddAddress').val(),
            machuyentau: $("#orderAddTrip").val(),
            tongcontainer:  soluong,
            arrcontainer: checkedValues, 
            action: "insert"
        };
        var dataUrl = $(this).data("api-link");
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData,
        });

    });
    $(document).on('click','.btn_change', function() {
        var dataId = $(this).data('change-id');
        var dataUrl = $(this).data('api-link');
        var postData = {
            id: dataId,
            typeGetData: "changeContainerData"
        };
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData,
            success: function(response) {
                var data = JSON.parse(response);
                $('#orderChangeContract').val(data.mahopdong);
                $('#orderChangeId').val(data.mavandon);
                $('#orderChangeDate').val(data.ngaylap);
                $('#orderChangeReceiver').val(data.tennguoinhan);
                $('#orderChangeTrip').val(data.machuyentau);
                $('#orderChangeAddress').val(data.diachinhan);
                $('#orderChangeQuantity').val(data.tongcontainer);
                let html = '';
                data['listContainer'].forEach(element => {
                   html+= `<tr><td class="text-center" >${element['macontainer']}</td>`+
                   `<td class="text-center" ><input type="checkbox" name="listChangeContainer" `+
                   `value="${element['macontainer']}" `+(element['mavandon']==null?"":"checked") +` style="width: 25px;height: 25px;"></td></tr>`;

                   ;
                });
                $('#orderChangeContainer').html(html);
            }
            
         }); 
         
        url=$(".btn_change").data('trip');
         $.ajax({
             type: 'POST',
             url: url,
             success:  function(response)
             {
                 let data = JSON.parse(response);
                 var arrayTripId= [];
                 let flag =false;
                 data.forEach(element => {
                    arrayTripId.push(element.machuyentau);
                 });
                 $("#orderChangeTrip").on("focus",function() {
                     if ($("#orderChangeTrip").val().length==0) {
                         $("#suggestionsOrderChangeTrip").prop("hidden", false);
                         count=arrayTripId.length;
                         if (count>=6) {
                             $("#suggestionsOrderChangeTrip").height(250);
                         }else  $("#suggestionsOrderChangeTrip").height(count*45);
                         arrayTripId.forEach(element => {   
                             let child = $("<div></div>");
                             child.text(element);
                             child.addClass("suggestion_item");
                             child.addClass("text-truncate");
                             child.on("click",function() {
                                 $("#orderChangeTrip").val(element);
                                 flag=false;
                                 $("#suggestionsOrderChangeTrip").prop("hidden", true)
                             })
                         $("#suggestionsOrderChangeTrip").append(child);
                         });     
                     } else {
                         $("#suggestionsOrderChangeTrip").prop("hidden", false);
                         let inputValue =$("#orderChangeTrip").val().toLowerCase();
                         let filterArray =[];
                         arrayTripId.forEach(element => {
                                     if(element.toLowerCase().includes(inputValue))
                                     filterArray.push(element);
                             });
                         $("#suggestionsOrderChangeTrip").empty();
                         countFilter=filterArray.length;
                         if (countFilter>=6) {
                             $("#suggestionsOrderChangeTrip").height(250);
                         }else  $("#suggestionsOrderChangeTrip").height(countFilter*45);
                         filterArray.forEach(element => {   
                             let child = $("<div></div>");
                             child.text(element);
                             child.addClass("suggestion_item");
                             child.addClass("text-truncate");
                             child.on("click",function() {
                                 $("#orderChangeTrip").val(element);
                                 flag=false;
                                 $("#suggestionsOrderChangeTrip").prop("hidden", true)
                             })
                         $("#suggestionsOrderChangeTrip").append(child);
                         });
                     }
     
                 })
                 $("#orderChangeTrip").on("blur",function () {
                     if (flag!=true) {
                         $("#suggestionsOrderChangeTrip").prop("hidden", true);
                       }
                 })
                 $("#orderChangeTrip").on("input",function () {
                     let inputValue =$("#orderChangeTrip").val().toLowerCase();
                     let filterArray =[];
                     arrayTripId.forEach(element => {
                                 if(element.toLowerCase().includes(inputValue))
                                 filterArray.push(element);
                         });
                     $("#suggestionsOrderChangeTrip").empty();
                     countFilter=filterArray.length;
                     if (countFilter>=6) {
                         $("#suggestionsOrderChangeTrip").height(250);
                     }else  $("#suggestionsOrderChangeTrip").height(countFilter*45);
                     filterArray.forEach(element => {   
                         let child = $("<div></div>");
                         child.text(element);
                         child.addClass("suggestion_item");
                         child.addClass("text-truncate");
                         child.on("click",function() {
                             $("#orderChangeTrip").val(element);
                             flag=false;
                             $("#suggestionsOrderChangeTrip").prop("hidden", true)
                         })
                     $("#suggestionsOrderChangeTrip").append(child);
                     });
                 })
                 $("#suggestionsOrderChangeTrip").mousedown(function() {
                     flag=true;
                 });
             }
         });

        
    });

    $(document).on('click','.container_insert', function(){
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
                $('#orderChangeContract').val(data.mahopdong);
                $('#orderChangeId').val(data.mavandon);
                $('#orderChangeDate').val(data.ngaylap);
                $('#orderChangeReceiver').val(data.tennguoinhan);
                $('#orderChangeTrip').val(data.machuyentau);
                $('#orderChangeAddress').val(data.diachinhan);
                $('#orderChangeQuantity').val(data.tongcontainer);
                let html = '';
                data['listContainer'].forEach(element => {
                   html+= `<tr><td class="text-center" >${element['macontainer']}</td>`+
                   `<td class="text-center" ><input type="checkbox" name="listChangeContainer" `+
                   `value="${element['macontainer']}" `+(element['mavandon']==null?"":"checked") +` style="width: 25px;height: 25px;"></td></tr>`;
                   
                   ;
                });
                $('#orderChangeContainer').html(html);
            }
        });
        return false;
    });
    $(document).on('click','#submitChangeOrder', function() {
        var postData = {
            mahopdong: $('#orderChangeContract').val(),
            mavandon: $('#orderChangeId').val(),
            tennguoinhan:   $('#orderChangeReceiver').val(),
            diachinhan:  $('#orderChangeAddress').val(),
            machuyentau: $("#orderChangeTrip").val(),
            tongcontainer:  soluong,
            arrcontainer: checkedValues, 
            action: "update"
        };
        var dataUrl = $(this).data("api-link");
        console.log(postData)
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData,
        });
 
    });
    $(document).on('click','#change_container_order', function() {
        soluong = 0
        checkedValues =[];
        $('input[name="listChangeContainer"]:checked').each(function () {
            var macontainer = $(this).val();
            checkedValues.push(macontainer);
            soluong++;
        });
        console.log(checkedValues)
        console.log(soluong)
        $('input[name="orderChangeQuantity"]').val(soluong);
    });
    $(document).on('click','.btn_delete', function() {   
        var dataId = $(this).data('delete-id');
        var dataUrl = $(this).data('api-link');
        var postData = {
            id: dataId,
            typeGetData: "deleteContainerData"
        };
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData,
            success: function(response) {
                var data = JSON.parse(response);
                $('input[name="orderDeleteContract"]').val(data.mahopdong);
                $('input[name="orderDeleteId"]').val(data.mavandon);
                $('input[name="orderDeleteDate"]').val(data.ngaylap);
                $('input[name="orderDeleteReceiver"]').val(data.tennguoinhan);
                $('input[name="orderDeleteAddress"]').val(data.diachinhan);
                $('input[name="orderDeleteQuantity"]').val(data.tongcontainer);
                let html = '';
                data['listContainer'].forEach(element => {
                   html+= `<tr><td class="text-center" >${element['macontainer']}</td>`+
                   `<td class="text-center" ><input disabled type="checkbox" name="listChangeContainer" `+
                   `value="${element['macontainer']}" checked  style="width: 25px;height: 25px;"></td></tr>`;
                   
                   ;
                });
                $('#orderDeleteContainer').html(html);

            }
        });
        return false;
    });

    $(document).on('click','button[name="submitDelete"]', function() {
        var postData = {
            mavandon: $('input[name="orderDeleteId"]').val(),
            action: "delete"
        };

        var dataUrl = $(this).data('api-link');
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData, 
        });
      });

    $("#searchSubmit").on("click",function () {
                
        var currentURL = new URL(window.location.href);
        currentURL.searchParams.delete('page');
        currentURL.searchParams.set('search', $("#search_order").val().toUpperCase());
        currentURL.searchParams.set('page', '1');
        window.location.href = currentURL;
    })


});
