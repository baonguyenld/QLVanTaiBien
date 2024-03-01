$(document).ready(function() {
    var urlSearch = $("#contract").data("contract");
    $.ajax({
        type: 'POST',
        url: urlSearch,
        success:  function(response)
        {
            let data = JSON.parse(response);
            var arrayContractId= [];
            let flag =false;
            data.forEach(element => {
                arrayContractId.push(element.mahopdong);
            });
            $("#search_contract").on("focus",function() {
                if ($("#search_contract").val().length==0) {
                    $("#suggestionsContractSearch").prop("hidden", false);
                    count=arrayContractId.length;
                    if (count>=6) {
                        $("#suggestionsContractSearch").height(250);
                    }else  $("#suggestionsContractSearch").height(count*45);
                    arrayContractId.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#search_contract").val(element);
                            flag=false;
                            $("#suggestionsContractSearch").prop("hidden", true)
                        })
                    $("#suggestionsContractSearch").append(child);
                    });
                }else {
                    $("#suggestionsContractSearch").prop("hidden", false);
                    let inputValue =$("#search_contract").val().toLowerCase();
                    let filterArray =[];
                    arrayContractId.forEach(element => {
                                if(element.toLowerCase().includes(inputValue))
                                filterArray.push(element);
                        });
                    $("#suggestionsContractSearch").empty();
                    countFilter=filterArray.length;
                    if (countFilter>=6) {
                        $("#suggestionsContractSearch").height(250);
                    }else  $("#suggestionsContractSearch").height(countFilter*45);
                    filterArray.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#search_contract").val(element);
                            flag=false;
                            $("#suggestionsContractSearch").prop("hidden", true)
                        })
                    $("#suggestionsContractSearch").append(child);
                    });
                }
            })
            $("#search_contract").on("blur",function () {
                if (flag!=true) {
                    $("#suggestionsContractSearch").prop("hidden", true);
                  }
            })
            $("#search_contract").on("input",function () {
                let inputValue =$("#search_contract").val().toLowerCase();
                let filterArray =[];
                arrayContractId.forEach(element => {
                            if(element.toLowerCase().includes(inputValue))
                            filterArray.push(element);
                    });
                $("#suggestionsContractSearch").empty();
                countFilter=filterArray.length;
                if (countFilter>=6) {
                    $("#suggestionsContractSearch").height(250);
                }else  $("#suggestionsContractSearch").height(countFilter*45);
                filterArray.forEach(element => {   
                    let child = $("<div></div>");
                    child.text(element);
                    child.addClass("suggestion_item");
                    child.addClass("text-truncate");
                    child.on("click",function() {
                        $("#search_contract").val(element);
                        flag=false;
                        $("#suggestionsContractSearch").prop("hidden", true)
                    })
                $("#suggestionsContractSearch").append(child);
                });
            })
             $("#suggestionsContractSearch").mousedown(function() {
                flag=true;
            });
        }
    });
    $(document).on('click','input[name="searchSubmit"]', function() {

        var currentURL = new URL(window.location.href);
        currentURL.searchParams.delete('page');
        currentURL.searchParams.set('search', $("#search_contract").val().toUpperCase());
        currentURL.searchParams.set('page', '1');
        window.location.href = currentURL;
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
                $('input[name="contractChangeName"]').val(data.makhachhang);
                $('input[name="contractChangeId"]').val(data.mahopdong);
                var regex = /#(.*?)#/g;
                var matches = [];
                var match;

                while ((match = regex.exec( data.noidung)) !== null) {
                    matches.push(match[1]);
                }
                $("#contractChangeCargo").val(matches[0]);
                $("#contractChangeDepart").val(matches[1]);
                $("#contractChangeDes").val(matches[2]);
                $("#contractChangeTextarea").val( matches[4]);
                $('#contractChangeContainer').val(matches[3]);
                $('input[name="contractChangeDate"]').val(data.ngaylap);
                $('input[name="contractChangePhone"]').val(data.sdt);
                $('input[name="contractChangeEmail"]').val(data.email);
                $('input[name="contractChangeState"]').filter('[value="' + ((data.status==1)?'Xác nhận':'Chưa xác nhận') + '"]').prop('checked', true);
            }
        });

        dataUrl = $(".btn_change").data('customer');
        $.ajax({
            type: 'POST',
            url: dataUrl,
            success:  function(response)
            {
                let data = JSON.parse(response);
                var arrayCustomerId= [];
                let flag =false;
                data.forEach(element => {
                    arrayCustomerId.push(element.makhachhang);
                });
                $("#contractChangeName").on("focus",function() {
                    if ($("#contractChangeName").val().length==0) {
                        $("#suggestionsContractChange").prop("hidden", false);
                        count=arrayCustomerId.length;
                        if (count>=6) {
                            $("#suggestionsContractChange").height(250);
                        }else  $("#suggestionsContractChange").height(count*45);
                        arrayCustomerId.forEach(element => {   
                            let child = $("<div></div>");
                            child.text(element);
                            child.addClass("suggestion_item");
                            child.addClass("text-truncate");
                            child.on("click",function() {
                                $("#contractChangeName").val(element);
                                flag=false;
                                $("#suggestionsContractChange").prop("hidden", true)
                            })
                        $("#suggestionsContractChange").append(child);
                        });
                    }else {
                        $("#suggestionsContractChange").prop("hidden", false);
                        let inputValue =$("#contractChangeName").val().toLowerCase();
                        let filterArray =[];
                        arrayCustomerId.forEach(element => {
                                    if(element.toLowerCase().includes(inputValue))
                                    filterArray.push(element);
                            });
                        $("#suggestionsContractChange").empty();
                        countFilter=filterArray.length;
                        if (countFilter>=6) {
                            $("#suggestionsContractChange").height(250);
                        }else  $("#suggestionsContractChange").height(countFilter*45);
                        filterArray.forEach(element => {   
                            let child = $("<div></div>");
                            child.text(element);
                            child.addClass("suggestion_item");
                            child.addClass("text-truncate");
                            child.on("click",function() {
                                $("#contractChangeName").val(element);
                                flag=false;
                                $("#suggestionsContractChange").prop("hidden", true)
                            })
                        $("#suggestionsContractChange").append(child);
                        });
                    }
    
                })
                $("#contractChangeName").on("blur",function () {
                    if (flag!=true) {
                        $("#suggestionsContractChange").prop("hidden", true);
                      }
                })
                $("#contractChangeName").on("input",function () {
                    let inputValue =$("#contractChangeName").val().toLowerCase();
                    let filterArray =[];
                    arrayCustomerId.forEach(element => {
                                if(element.toLowerCase().includes(inputValue))
                                filterArray.push(element);
                        });
                    $("#suggestionsContractChange").empty();
                    countFilter=filterArray.length;
                    if (countFilter>=6) {
                        $("#suggestionsContractChange").height(250);
                    }else  $("#suggestionsContractChange").height(countFilter*45);
                    filterArray.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#contractChangeName").val(element);
                            flag=false;
                            $("#suggestionsContractChange").prop("hidden", true)
                        })
                    $("#suggestionsContractChange").append(child);
                    });
                })
                $("#suggestionsContractChange").mousedown(function() {
                    flag=true;
                });
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
                var regex = /#(.*?)#/g;
                var matches = [];
                var match;

                while ((match = regex.exec( data.noidung)) !== null) {
                    matches.push(match[1]);
                }
                $("#contractDeleteCargo").val(matches[0]);
                $("#contractDeleteDepart").val(matches[1]);
                $("#contractDeleteDes").val(matches[2]);
                $("#contractDeleteTextarea").val( matches[4]);
                $('#contractDeleteContainer').val(matches[3]);

                $('input[name="contractDeleteName"]').val(data.makhachhang);
                $('input[name="contractDeleteId"]').val(data.mahopdong);
                $('input[name="contractDeleteDate"]').val(data.ngaylap);
                $('input[name="contractDeletePhone"]').val(data.sdt);
                $('input[name="contractDeleteEmail"]').val(data.email);
                $('input[name="contractDeleteState"]').filter('[value="' + ((data.status==1)?'Xác nhận':'Chưa xác nhận') + '"]').prop('checked', true);
            }
        });
        return false;
    });
    $(document).on('click','#contract_option_add', function() {
 
        var dataUrl = $(this).data('seaport');
        $.ajax({
            type: 'POST',
            url: dataUrl,
            success: function(response) {
                var data = JSON.parse(response);
                var html ='';
              data.forEach(element => {
                html +=`<option value="${element['macang']}">${element['macang']}</option>`
              });
              $("#contractAddDepart").html(html);
              $("#contractAddDes").html(html);
            }
        });
        
        return false;
    });
    $(document).on('click','button[name="submitChange"]', function() {
        var tenhanghoa = $("#contractChangeCargo").val();
        var cangdi = $("#contractChangeDepart").val();
        var cangden = $("#contractChangeDes").val();
        var containerstatus = $("#contractChangeContainer").val();
        var contentcontract = $("#contractChangeTextarea").val().trim();
        if(cangdi == cangden)
        {
             $("#error_change_contract").text("Cảng đi và đến không được trùng nhau")
             $(".column_error_change_contract").removeClass("d-none")
             return false;
        }
        var noidung = 
        `Tên hàng hóa: #${tenhanghoa}#
        Cảng khởi hành: #${cangdi}#
        Cảng nhận hàng: #${cangden}#
        Đã có container: #${containerstatus}#
        Ghi chú: #${contentcontract}#`;
        var postData = {
            mahopdong: $('#contractChangeId').val(),
            status:  ($("input[name='contractChangeState']:checked").val()=="Xác nhận"?'1':'0'),
            noidung: noidung,
            action: "update"
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
            mahopdong: $('input[name="contractDeleteId"]').val(),
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
       var tenhanghoa = $("#contractAddCargo").val();
       var cangdi = $("#contractAddDepart").val();
       var cangden = $("#contractAddDes").val();
       var containerstatus = $("#contractAddContainer").val();
       var contentcontract = $("#contractTextarea").val().trim();
       $(".column_error_add_contract").addClass("d-none")
       if(cangdi == cangden)
       {
            $("#error_add_contract").text("Cảng đi và đến không được trùng nhau")
            $(".column_error_add_contract").removeClass("d-none")
            return false;
       }
       else if($("#contractAddName").val() == "")
       {

        $("#error_add_contract").text("Mã khách hàng không được để trống")
        $(".column_error_add_contract").removeClass("d-none")
        return false;
       }


        var noidung = 
`Tên hàng hóa: #${tenhanghoa}#
Cảng khởi hành: #${cangdi}#
Cảng nhận hàng: #${cangden}#
Đã có container: #${containerstatus}#
Ghi chú: #${contentcontract}#`
        var currentDate = new Date();
        var formattedDate = currentDate.getFullYear() + '/' + (currentDate.getMonth() + 1) + '/' + currentDate.getDate();
   
        var postData = {
            makhachhang: $('#contractAddName').val(),
            ngaylap:  formattedDate,
            status:  1,
            noidung: noidung,
            action: "insert"
        };
        var dataUrl = $(this).data('api-link');
   
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData,
        });  
    })
    $(document).on('click','button[name="submitReport"]', function() {
        var postData = {
            khachhang: $('input[name="contractReportName"]').val(),
            tungay: $('input[name="contractReportDateFrom"]').val(),
            denngay: $('input[name="contractReportDateTo"]').val(),
            trangthai:  ($("input[name='contractReportState']:checked").val()=="Xác nhận"?'1':'0'),
            action: "report"
        };
       
        var dataUrl = $(this).data('api-link');
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData,
            success: function(response) {
               
                var data = JSON.parse(response);
                console.log(data);
                $('input[name="contractExportMame"]').val($('input[name="contractReportName"]').val());
                $('input[name="contractExportDate1"]').val($('input[name="contractReportDateFrom"]').val());
                $('input[name="contractExportDate2"]').val($('input[name="contractReportDateTo"]').val());
                $('input[name="contract_export_count"]').val((data!=null && data['rowcount']!=null)?data['rowcount']:0);
                $('input[name="contract_export_state"]').val($('input[name="contractReportState"]:checked').val());
                if(data!= null)
                {
                    html = '';
                    data['record'].forEach(element => {
                        html += "<tr>"+
                        "<td class='text-center  bgtext-light'  style='width:250px'>"+element['mahopdong']+"</td>"+
                        "<td class='text-center  bgtext-light'  style='width:250px'>"+element['makhachhang']+"</td>"+
                        "<td class='text-center  bgtext-light'  style='width:250px'>"+element['ngaylap']+"</td>"+
                        "<td class='text-center  bgtext-light'  style='width:250px'>"+(element['status']==1?"Đã xác nhận":"Chưa xác nhận")+"</td></tr>";
                    });
                    $("#report-data").html(html);
                }

            }
        });  
        return false;
    
    })
    $(document).on('click','#contract_option_report', function() {
        var currentDate = new Date();
        var dateString = currentDate.toISOString().slice(0,10);
        $('input[name="contractReportDateFrom"]').val(dateString);
        $('input[name="contractReportDateTo"]').val(dateString);

        let dataUrl=$("#contract_option_add").data('customer');
        $.ajax({
            type: 'POST',
            url: dataUrl,
            success:  function(response)
            {
                let data = JSON.parse(response);
                var arrayCustomerId= [];
                let flag =false;
                data.forEach(element => {
                    arrayCustomerId.push(element.makhachhang);
                });
                $("#contractReportName").on("focus",function() {
                    if ($("#contractReportName").val().length==0) {
                        $("#suggestionsContractReport").prop("hidden", false);
                        count=arrayCustomerId.length;
                        if (count>=6) {
                            $("#suggestionsContractReport").height(250);
                        }else  $("#suggestionsContractReport").height(count*45);
                        arrayCustomerId.forEach(element => {   
                            let child = $("<div></div>");
                            child.text(element);
                            child.addClass("suggestion_item");
                            child.addClass("text-truncate");
                            child.on("click",function() {
                                $("#contractReportName").val(element);
                                flag=false;
                                $("#suggestionsContractReport").prop("hidden", true)
                            })
                        $("#suggestionsContractReport").append(child);
                        });
                    }else {
                        $("#suggestionsContractReport").prop("hidden", false);
                        let inputValue =$("#contractReportName").val().toLowerCase();
                        let filterArray =[];
                        arrayCustomerId.forEach(element => {
                                    if(element.toLowerCase().includes(inputValue))
                                    filterArray.push(element);
                            });
                        $("#suggestionsContractReport").empty();
                        countFilter=filterArray.length;
                        if (countFilter>=6) {
                            $("#suggestionsContractReport").height(250);
                        }else  $("#suggestionsContractReport").height(countFilter*45);
                        filterArray.forEach(element => {   
                            let child = $("<div></div>");
                            child.text(element);
                            child.addClass("suggestion_item");
                            child.addClass("text-truncate");
                            child.on("click",function() {
                                $("#contractReportName").val(element);
                                flag=false;
                                $("#suggestionsContractReport").prop("hidden", true)
                            })
                        $("#suggestionsContractReport").append(child);
                        });
                    }
                })
                $("#contractReportName").on("blur",function () {
                    if (flag!=true) {
                        $("#suggestionsContractReport").prop("hidden", true);
                    }
                })
                $("#contractReportName").on("input",function () {
                    let inputValue =$("#contractReportName").val().toLowerCase();
                    let filterArray =[];
                    arrayCustomerId.forEach(element => {
                                if(element.toLowerCase().includes(inputValue))
                                filterArray.push(element);
                        });
                    $("#suggestionsContractReport").empty();
                    countFilter=filterArray.length;
                    if (countFilter>=6) {
                        $("#suggestionsContractReport").height(250);
                    }else  $("#suggestionsContractReport").height(countFilter*45);
                    filterArray.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#contractReportName").val(element);
                            flag=false;
                            $("#suggestionsContractReport").prop("hidden", true)
                        })
                    $("#suggestionsContractReport").append(child);
                    });
                })
                $("#suggestionsContractReport").mousedown(function() {
                    flag=true;
                });
            }
        });
    
    })
    $(document).on('click','#contract_option_add', function() {
        let dataUrl=$("#contract_option_add").data('customer');
        $.ajax({
            type: 'POST',
            url: dataUrl,
            success:  function(response)
            {
                let data = JSON.parse(response);
                var arrayCustomerId= [];
                let flag =false;
                data.forEach(element => {
                    arrayCustomerId.push(element.makhachhang);
                });
                $("#contractAddName").on("focus",function() {
                    if ($("#contractAddName").val().length==0) {
                        $("#suggestionsContractAdd").prop("hidden", false);
                        count=arrayCustomerId.length;
                        if (count>=6) {
                            $("#suggestionsContractAdd").height(250);
                        }else  $("#suggestionsContractAdd").height(count*45);
                        arrayCustomerId.forEach(element => {   
                            let child = $("<div></div>");
                            child.text(element);
                            child.addClass("suggestion_item");
                            child.addClass("text-truncate");
                            child.on("click",function() {
                                $("#contractAddName").val(element);
                                flag=false;
                                $("#suggestionsContractAdd").prop("hidden", true)
                            })
                        $("#suggestionsContractAdd").append(child);
                        });     
                    } else {
                        $("#suggestionsContractAdd").prop("hidden", false);
                        let inputValue =$("#contractAddName").val().toLowerCase();
                        let filterArray =[];
                        arrayCustomerId.forEach(element => {
                                    if(element.toLowerCase().includes(inputValue))
                                    filterArray.push(element);
                            });
                        $("#suggestionsContractAdd").empty();
                        countFilter=filterArray.length;
                        if (countFilter>=6) {
                            $("#suggestionsContractAdd").height(250);
                        }else  $("#suggestionsContractAdd").height(countFilter*45);
                        filterArray.forEach(element => {   
                            let child = $("<div></div>");
                            child.text(element);
                            child.addClass("suggestion_item");
                            child.addClass("text-truncate");
                            child.on("click",function() {
                                $("#contractAddName").val(element);
                                flag=false;
                                $("#suggestionsContractAdd").prop("hidden", true)
                            })
                        $("#suggestionsContractAdd").append(child);
                        });
                    }
    
                })
                $("#contractAddName").on("blur",function () {
                    if (flag!=true) {
                        $("#suggestionsContractAdd").prop("hidden", true);
                      }
                })
                $("#contractAddName").on("input",function () {
                    let inputValue =$("#contractAddName").val().toLowerCase();
                    let filterArray =[];
                    arrayCustomerId.forEach(element => {
                                if(element.toLowerCase().includes(inputValue))
                                filterArray.push(element);
                        });
                    $("#suggestionsContractAdd").empty();
                    countFilter=filterArray.length;
                    if (countFilter>=6) {
                        $("#suggestionsContractAdd").height(250);
                    }else  $("#suggestionsContractAdd").height(countFilter*45);
                    filterArray.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#contractAddName").val(element);
                            flag=false;
                            $("#suggestionsContractAdd").prop("hidden", true)
                        })
                    $("#suggestionsContractAdd").append(child);
                    });
                })
                $("#suggestionsContractAdd").mousedown(function() {
                    flag=true;
                });
            }
        });
    });
});