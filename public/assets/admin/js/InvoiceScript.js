$(document).ready(function() {
    var urlSearch = $("#invoice").data("invoice");
    $.ajax({
        type: 'POST',
        url: urlSearch,
        success:  function(response)
        {
            let data = JSON.parse(response);
            var arrayInvoiceId= [];
            let flag =false;
            data.forEach(element => {
                arrayInvoiceId.push(element.mahoadon);
            });
            $("#search_invoice").on("focus",function() {
                if ($("#search_invoice").val().length==0) {
                    $("#suggestionsInvoiceSearch").prop("hidden", false);
                    count=arrayInvoiceId.length;
                    if (count>=6) {
                        $("#suggestionsInvoiceSearch").height(250);
                    }else  $("#suggestionsInvoiceSearch").height(count*45);
                    arrayInvoiceId.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#search_invoice").val(element);
                            flag=false;
                            $("#suggestionsInvoiceSearch").prop("hidden", true)
                        })
                    $("#suggestionsInvoiceSearch").append(child);
                    });
                }else {
                    $("#suggestionsInvoiceSearch").prop("hidden", false);
                    let inputValue =$("#search_invoice").val().toLowerCase();
                    let filterArray =[];
                    arrayInvoiceId.forEach(element => {
                                if(element.toLowerCase().includes(inputValue))
                                filterArray.push(element);
                        });
                    $("#suggestionsInvoiceSearch").empty();
                    countFilter=filterArray.length;
                    if (countFilter>=6) {
                        $("#suggestionsInvoiceSearch").height(250);
                    }else  $("#suggestionsInvoiceSearch").height(countFilter*45);
                    filterArray.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#search_invoice").val(element);
                            flag=false;
                            $("#suggestionsInvoiceSearch").prop("hidden", true)
                        })
                    $("#suggestionsInvoiceSearch").append(child);
                    });
                }
            })
            $("#search_invoice").on("blur",function () {
                if (flag!=true) {
                    $("#suggestionsInvoiceSearch").prop("hidden", true);
                  }
            })
            $("#search_invoice").on("input",function () {
                let inputValue =$("#search_invoice").val().toLowerCase();
                let filterArray =[];
                arrayInvoiceId.forEach(element => {
                            if(element.toLowerCase().includes(inputValue))
                            filterArray.push(element);
                    });
                $("#suggestionsInvoiceSearch").empty();
                countFilter=filterArray.length;
                if (countFilter>=6) {
                    $("#suggestionsInvoiceSearch").height(250);
                }else  $("#suggestionsInvoiceSearch").height(countFilter*45);
                filterArray.forEach(element => {   
                    let child = $("<div></div>");
                    child.text(element);
                    child.addClass("suggestion_item");
                    child.addClass("text-truncate");
                    child.on("click",function() {
                        $("#search_invoice").val(element);
                        flag=false;
                        $("#suggestionsInvoiceSearch").prop("hidden", true)
                    })
                $("#suggestionsInvoiceSearch").append(child);
                });
            })
             $("#suggestionsInvoiceSearch").mousedown(function() {
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
                $('input[name="invoiceChangeOrder"]').val(data.mavandon);
                $('input[name="invoiceChangeId"]').val(data.mahoadon);
                $('input[name="invoiceChangeDate"]').val(data.ngaylaphoadon);
                $('input[name="invoiceChangeMoney"]').val(data.tongtien);
                $('input[name="invoiceChangeState"]').filter('[value="' + ((data.trangthai==1)?'Xác nhận':'Chưa xác nhận') + '"]').prop('checked', true);
            }
        });
    });
    $(document).on('click','button[name="submitChange"]', function() {
        var postData = {
            mahoadon: $('input[name="invoiceChangeId"]').val(),
            trangthai: ($("input[name='invoiceChangeState']:checked").val()=="Xác nhận"?'1':'0'),
            tongtien:  $('input[name="invoiceChangeMoney"]').val(),
            mavandon:  $('input[name="invoiceChangeOrder"]').val(),
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
        currentURL.searchParams.set('search', $("#search_invoice").val().toUpperCase());
        currentURL.searchParams.set('page', '1');
        window.location.href = currentURL;
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
                $('input[name="invoiceDeleteOrder"]').val(data.mavandon);
                $('input[name="invoiceDeleteId"]').val(data.mahoadon);
                $('input[name="invoiceDeleteDate"]').val(data.ngaylaphoadon);
                $('input[name="invoiceDeleteMoney"]').val(data.tongtien);
                $('input[name="invoiceDeleteState"]').filter('[value="' + ((data.trangthai==1)?'Xác nhận':'Chưa xác nhận') + '"]').prop('checked', true);
            }
        });
        return false;
    });
    $(document).on('click','button[name="submitDelete"]', function() {
        var postData = {
            mahoadon: $('input[name="invoiceDeleteId"]').val(),
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
        
        var currentDate = new Date();
        var formattedDate = currentDate.getFullYear() + '-' + (currentDate.getMonth() + 1) + '-' + currentDate.getDate();
        var postData = {
            trangthai: ($("input[name='invoiceAddState']:checked").val()=="Xác nhận"?'1':'0'),
            ngaylaphoadon: formattedDate,
            mavandon:  $('input[name="invoiceAddOrder"]').val(),
            action: "insert"
        };
        var dataUrl = $(this).data('api-link');
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData,
            // success: function(response) {
            //     console.log(JSON.parse(response));
            // }

        });

    });
    $("#invoice_option_add").on("click",function () {
        let dataUrl=$("#invoice_option_add").data('order');
        $.ajax({
            type: 'POST',
            url: dataUrl,
            success:  function(response)
            {
                let data = JSON.parse(response);
                var arrayOrderId= [];
                let flag =false;
                data.forEach(element => {
                    arrayOrderId.push(element.mavandon);
                });
                $("#invoiceAddOrder").on("focus",function() {
                    if ($("#invoiceAddOrder").val().length==0) {
                        $("#suggestionsInvoiceAdd").prop("hidden", false);
                        count=arrayOrderId.length;
                        if (count>=6) {
                            $("#suggestionsInvoiceAdd").height(250);
                        }else  $("#suggestionsInvoiceAdd").height(count*45);
                        arrayOrderId.forEach(element => {   
                            let child = $("<div></div>");
                            child.text(element);
                            child.addClass("suggestion_item");
                            child.addClass("text-truncate");
                            child.on("click",function() {
                                $("#invoiceAddOrder").val(element);
                                flag=false;
                                $("#suggestionsInvoiceAdd").prop("hidden", true)
                            })
                            $("#suggestionsInvoiceAdd").append(child);
                        });     
                    } else {
                        $("#suggestionsInvoiceAdd").prop("hidden", false);
                        let inputValue =$("#invoiceAddOrder").val().toLowerCase();
                        let filterArray =[];
                        arrayOrderId.forEach(element => {
                                    if(element.toLowerCase().includes(inputValue))
                                    filterArray.push(element);
                            });
                        $("#suggestionsInvoiceAdd").empty();
                        countFilter=filterArray.length;
                        if (countFilter>=6) {
                            $("#suggestionsInvoiceAdd").height(250);
                        }else  $("#suggestionsInvoiceAdd").height(countFilter*45);
                        filterArray.forEach(element => {   
                            let child = $("<div></div>");
                            child.text(element);
                            child.addClass("suggestion_item");
                            child.addClass("text-truncate");
                            child.on("click",function() {
                                $("#invoiceAddOrder").val(element);
                                flag=false;
                                $("#suggestionsInvoiceAdd").prop("hidden", true)
                            })
                        $("#suggestionsInvoiceAdd").append(child);
                        });
                    }
                })
                $("#invoiceAddOrder").on("blur",function () {
                    if (flag!=true) {
                        $("#suggestionsInvoiceAdd").prop("hidden", true);
                      }
                })
                $("#invoiceAddOrder").on("input",function () {
                    let inputValue =$("#invoiceAddOrder").val().toLowerCase();
                    let filterArray =[];
                    arrayOrderId.forEach(element => {
                                if(element.toLowerCase().includes(inputValue))
                                filterArray.push(element);
                        });
                    $("#suggestionsInvoiceAdd").empty();
                    countFilter=filterArray.length;
                    if (countFilter>=6) {
                        $("#suggestionsInvoiceAdd").height(250);
                    }else  $("#suggestionsInvoiceAdd").height(countFilter*45);
                    filterArray.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#invoiceAddOrder").val(element);
                            flag=false;
                            $("#suggestionsInvoiceAdd").prop("hidden", true)
                        })
                    $("#suggestionsInvoiceAdd").append(child);
                    });
                })
                $("#suggestionsInvoiceAdd").mousedown(function() {
                    flag=true;
                });
    
            }
        });
    })
});
