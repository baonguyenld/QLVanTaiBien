$(document).ready(function() {
    $.ajax({
        type: 'POST',
        url: $("#api_getlistcustomer").data('api-getlist'),
        success:  function(response)
        {
            let data = JSON.parse(response);
            var arrayCustomerId= [];
            let flag =false;
            data.forEach(element => {
                arrayCustomerId.push(element.makhachhang);
            });
    
            $("#search_customer").on("focus",function() {
                if ($("#search_customer").val().length==0) {
                    $("#suggestionsCustomerSearch").prop("hidden", false);
                    count=arrayCustomerId.length;
                    if (count>=6) {
                        $("#suggestionsCustomerSearch").height(250);
                    }else  $("#suggestionsCustomerSearch").height(count*45);
                    arrayCustomerId.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#search_customer").val(element);
                            flag=false;
                            $("#suggestionsCustomerSearch").prop("hidden", true)
                        })
                    $("#suggestionsCustomerSearch").append(child);
                    });
                }
                else {
                    $("#suggestionsCustomerSearch").prop("hidden", false);
                    let inputValue =$("#search_customer").val().toLowerCase();
                    let filterArray =[];
                    arrayCustomerId.forEach(element => {
                                if(element.toLowerCase().includes(inputValue))
                                filterArray.push(element);
                        });
                    $("#suggestionsCustomerSearch").empty();
                    countFilter=filterArray.length;
                    if (countFilter>=6) {
                        $("#suggestionsCustomerSearch").height(250);
                    }else  $("#suggestionsCustomerSearch").height(countFilter*45);
                    filterArray.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#search_customer").val(element);
                            flag=false;
                            $("#suggestionsCustomerSearch").prop("hidden", true)
                        })
                    $("#suggestionsCustomerSearch").append(child);
                    });
                }
            })
            $("#search_customer").on("blur",function () {
                if (flag!=true) {
                    $("#suggestionsCustomerSearch").prop("hidden", true);
                  }
            })
            $("#search_customer").on("input",function () {
                let inputValue =$("#search_customer").val().toLowerCase();
                let filterArray =[];
                arrayCustomerId.forEach(element => {
                            if(element.toLowerCase().includes(inputValue))
                            filterArray.push(element);
                    });
                $("#suggestionsCustomerSearch").empty();
                countFilter=filterArray.length;
                if (countFilter>=6) {
                    $("#suggestionsCustomerSearch").height(250);
                }else  $("#suggestionsCustomerSearch").height(countFilter*45);
                filterArray.forEach(element => {   
                    let child = $("<div></div>");
                    child.text(element);
                    child.addClass("suggestion_item");
                    child.addClass("text-truncate");
                    child.on("click",function() {
                        $("#search_customer").val(element);
                        flag=false;
                        $("#suggestionsCustomerSearch").prop("hidden", true)
                    })
                $("#suggestionsCustomerSearch").append(child);
                });
            })
             $("#suggestionsCustomerSearch").mousedown(function() {
                flag=true;
            });
        }
    });
    $(document).on('click','#customerAddState_1', function() {
        $(".customerAddCccd").addClass('d-none');
        $(".customerAddMaCongTy").removeClass('d-none');
        $(".customerChangeCccd").addClass('d-none');
        $(".customerChangeMacongty").removeClass('d-none');
    });
    $(document).on('click','#customerAddState_2', function() {
        $(".customerAddCccd").removeClass('d-none');
        $(".customerAddMaCongTy").addClass('d-none');
        $(".customerChangeCccd").removeClass('d-none');
        $(".customerChangeMacongty").addClass('d-none');
    });
    $(document).on('click','#customerChangeState_1', function() {
        $(".customerChangeCccd").addClass('d-none');
        $(".customerChangeMacongty").removeClass('d-none');
    });
    $(document).on('click','#customerChangeState_2', function() {
        $(".customerChangeCccd").removeClass('d-none');
        $(".customerChangeMacongty").addClass('d-none');
    });


    var oldEmail = "";
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
                $('input[name="customerChangeName"]').val(data.tenkhachhang);
                $('input[name="customerChangeId"]').val(data.makhachhang);
                $('input[name="customerChangePhone"]').val(data.sdt);
                $('input[name="customerChangeEmail"]').val(data.email);
                oldEmail = data.email;
                $('input[name="customerChangeAddress"]').val(data.diachi);
                if(data.cmnd)
                {
                    $('.customerChangeCccd').removeClass('d-none');
                    $('.customerChangeMacongty').addClass('d-none');
                    $('input[name="customerChangeCccd"]').val(data.cmnd);
                }
                else {
                    $('.customerChangeCccd').addClass('d-none');
                    $('.customerChangeMacongty').removeClass('d-none');
                    $('input[name="customerChangeMacongty"]').val(data.macongty);
                }
               
                $('input[name="customerChangeState"]').filter('[value="' + data.type + '"]').prop('checked', true);
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
                $('input[name="customerDeleteName"]').val(data.tenkhachhang);
                $('input[name="customerDeleteId"]').val(data.makhachhang);
                $('input[name="customerDeletePhone"]').val(data.sdt);
                $('input[name="customerDeleteEmail"]').val(data.email);
                $('input[name="customerDeleteAddress"]').val(data.diachi);
                $('input[name="customerDeleteState"]').filter('[value="' + data.type + '"]').prop('checked', true);
                if(data.cmnd){
                    $('.customerDeleteCccd').removeClass('d-none');
                    $('.customerDeleteMacongty').addClass('d-none');
                    $('input[name="customerDeleteCccd"]').val(data.cmnd);
                }else{
                    $('.customerDeleteCccd').addClass('d-none');
                    $('.customerDeleteMacongty').removeClass('d-none');
                    $('input[name="customerDeleteMacongty"]').val(data.macongty);
                }
            }
        });
    });
    $(document).on('click','button[name="submitChange"]', function() {
        var postData = {
            tenkhachhang: $('input[name="customerChangeName"]').val(),
            makhachhang: $('input[name="customerChangeId"]').val(),
            sdt:  $('input[name="customerChangePhone"]').val(),
            email:  $('input[name="customerChangeEmail"]').val(),
            type:   $('input[name="customerChangeState"]:checked').val(),
            diachi: $('input[name="customerChangeAddress"]').val(),
            cccd:   $('input[name="customerChangeCccd"]').val(),
            macongty:   $('input[name="customerChangeMacongty"]').val(),
            oldEmail: oldEmail,
            action: "update"
        };
        var dataUrl = $(this).data('api-link');
        console.log(postData);
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData,
        });
    });
    $(document).on('click','button[name="submitDelete"]', function() {
        var postData = {
            makhachhang: $('input[name="customerDeleteId"]').val(),
            email: $('input[name="customerDeleteEmail"]').val(),
            action: "delete"
        };
        var dataUrl = $(this).data('api-link');
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData,
        });  
    });

    $(document).on('click',"#submitAdd", function() {
        var postData = {
            tenkhachhang: $('input[name="customerAddName"]').val(),
            sdt:  $('input[name="customerAddPhone"]').val(),
            email:  $('input[name="customerAddEmail"]').val(),
            type:   $('input[name="customerAddState"]:checked').val(),
            diachi: $('input[name="customerAddAddress"]').val(),
            macongty: $('input[name="customerAddMacongty"]').val(),
            cccd: $('input[name="customerAddCccd"]').val(),
            action: "insert"
        };
        var dataUrl = $(this).data('api-link');
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData,
            success: function() {
                location.reload();
            }
        });
    });
    $(document).on('click','input[name="searchSubmit"]', function() {

        var currentURL = new URL(window.location.href);
        currentURL.searchParams.delete('page');
        currentURL.searchParams.set('search', $("#search_customer").val().toUpperCase());
        currentURL.searchParams.set('page', '1');
        window.location.href = currentURL;
    });
});

