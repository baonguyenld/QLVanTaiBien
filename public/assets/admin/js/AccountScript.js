$(document).ready(function() {
    var urlSearch = $("#account").data("account");
    $.ajax({
        type: 'POST',
        url: urlSearch,
        success:  function(response)
        {
            let data = JSON.parse(response);
            var arrayAccountId= [];
            let flag =false;
            data.forEach(element => {
                arrayAccountId.push(element.makhachhang);
            });
            $("#search_account").on("focus",function() {
                if ($("#search_account").val().length==0) {
                    $("#suggestionsAccountSearch").prop("hidden", false);
                    count=arrayAccountId.length;
                    if (count>=6) {
                        $("#suggestionsAccountSearch").height(250);
                    }else  $("#suggestionsAccountSearch").height(count*45);
                    arrayAccountId.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#search_account").val(element);
                            flag=false;
                            $("#suggestionsAccountSearch").prop("hidden", true)
                        })
                    $("#suggestionsAccountSearch").append(child);
                    });
                }else {
                    $("#suggestionsAccountSearch").prop("hidden", false);
                    let inputValue =$("#search_account").val().toLowerCase();
                    let filterArray =[];
                    arrayAccountId.forEach(element => {
                                if(element.toLowerCase().includes(inputValue))
                                filterArray.push(element);
                        });
                    $("#suggestionsAccountSearch").empty();
                    countFilter=filterArray.length;
                    if (countFilter>=6) {
                        $("#suggestionsAccountSearch").height(250);
                    }else  $("#suggestionsAccountSearch").height(countFilter*45);
                    filterArray.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#search_account").val(element);
                            flag=false;
                            $("#suggestionsAccountSearch").prop("hidden", true)
                        })
                    $("#suggestionsAccountSearch").append(child);
                    });
                }
            })
            $("#search_account").on("blur",function () {
                if (flag!=true) {
                    $("#suggestionsAccountSearch").prop("hidden", true);
                  }
            })
            $("#search_account").on("input",function () {
                let inputValue =$("#search_account").val().toLowerCase();
                let filterArray =[];
                arrayAccountId.forEach(element => {
                            if(element.toLowerCase().includes(inputValue))
                            filterArray.push(element);
                    });
                $("#suggestionsAccountSearch").empty();
                countFilter=filterArray.length;
                if (countFilter>=6) {
                    $("#suggestionsAccountSearch").height(250);
                }else  $("#suggestionsAccountSearch").height(countFilter*45);
                filterArray.forEach(element => {   
                    let child = $("<div></div>");
                    child.text(element);
                    child.addClass("suggestion_item");
                    child.addClass("text-truncate");
                    child.on("click",function() {
                        $("#search_account").val(element);
                        flag=false;
                        $("#suggestionsAccountSearch").prop("hidden", true)
                    })
                $("#suggestionsAccountSearch").append(child);
                });
            })
             $("#suggestionsAccountSearch").mousedown(function() {
                flag=true;
            });
        }
    });
    $(document).on('click','button[name="submitAdd"]', function() {
        var retrievedData = sessionStorage.getItem("accountInfo");
        var data = JSON.parse(retrievedData);
        var postData = {
            username: data["accountEmail"],
            makhachhang: data["accountId"],
            action: "insert"
        };
        var dataUrl = $(this).data('api-link');
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData,
            success: function(response)
            {
                var data = JSON.parse(response);
                if(data['result'])
                {
                    $(".confirmAccount[data-id='"+postData['makhachhang']+"']").addClass('d-none');
                    $(".confirmAccount[data-id='"+postData['makhachhang']+"']").prev('div').removeClass('d-none');
                    unbanBtn = 'button[name="unban-'+postData['makhachhang']+'"]';
                    banBtn = 'button[name="ban-'+postData['makhachhang']+'"]';
                   $(unbanBtn).addClass("d-none");
                   $(banBtn).removeClass("d-none");
                    $.ajax({
                        type: 'POST',
                        url: dataUrl,
                        data: data['result']
                    });
                }
                else{   
                    alert("Tài khoản đã tồn tại");
                }
            }
        });
        sessionStorage.removeItem("accountInfo");
        $('.modal').modal('hide');

    });
    $(document).on('click','.detail-account', function() {
        var id = $(this).data('id');
        var className = {
            email:".email-"+id,
            makhachhang:".makhachhang-"+id,
            tenkhachhang: ".tenkhachhang-"+id,
            loai:".loai-"+id,
            sdt:".sdt-"+id,
            cccd:".cccd-"+id,
            macongty: ".macongty-"+id,
        };

       $('#input_info_id').val($(className['makhachhang']).text());
       $('#input_info_name').val($(className['tenkhachhang']).text());
       $('#input_info_type').val($(className['loai']).text());
       $('#input_info_phone').val($(className['sdt']).text());
       $('#input_info_mail').val($(className['email']).text());
       if($(className['cccd']).text()!='')
       {
        $('#input_info_cccd').val($(className['cccd']).text());
        $('.info_title_cccd').prop('hidden',false);
        $('.info_title_macongty').prop('hidden',true);
       }
       else
       {
            $('#input_info_company').val($(className['macongty']).text());
            $('.info_title_cccd').prop('hidden',true);
            $('.info_title_macongty').prop('hidden',false);
       }
    });
    $(document).on('click','.confirmAccount', function() {
        var id = $(this).data('id');
        var className = ".email-"+id; 
        var email = $(className).text();
        var dataToSave = { 
            accountEmail: email,
            accountId: id
        };
        var jsonData = JSON.stringify(dataToSave);
        sessionStorage.setItem("accountInfo", jsonData);
    });
    var emailBan;
    var idBan;
    $(document).on('click','.btn_ban_account', function() {
        idBan = $(this).data('id');
        var className = ".email-"+idBan; 
        emailBan = $(className).text();
    });
    $(document).on('click','.btn_unban_account', function() {
        idBan = $(this).data('id');
        var className = ".email-"+idBan; 
        emailBan = $(className).text();
    });
    $(document).on('click','.delete-account', function() {
        idBan = $(this).data('id');
        var className = ".email-"+idBan; 
        emailBan = $(className).text();
    });
    $(document).on('click','button[name="submitBan"]', function() {
        var dataUrl = $(this).data('api-link');
        console.log(dataUrl);
        var dataToCheck = { 
            accountEmail: emailBan,
            action: "ban"
        };
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: dataToCheck,
            success: function(response)
            {
                var data = JSON.parse(response);
                if(data)
                {
                    
                    unbanBtn = 'button[name="unban-'+idBan+'"]';
                    banBtn = 'button[name="ban-'+idBan+'"]';
                   $(unbanBtn).removeClass("d-none");
                   $(banBtn).addClass("d-none");
                }
                else{   
                    unbanBtn = 'button[name="unban-'+idBan+'"]';
                    banBtn = 'button[name="ban-'+idBan+'"]';
                   $(unbanBtn).addClass("d-none");
                   $(banBtn).removeClass("d-none");
                }
            }
        });
    });
    $(document).on('click','button[name="submitUnban"]', function() {
        var dataUrl = $(this).data('api-link');
        var dataToCheck = { 
            accountEmail: emailBan,
            action: "unban"
        };
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: dataToCheck,
            success: function(response)
            {
                var data = JSON.parse(response);
                if(data)
                {
                    unbanBtn = 'button[name="unban-'+idBan+'"]';
                    banBtn = 'button[name="ban-'+idBan+'"]';
                   $(unbanBtn).addClass("d-none");
                   $(banBtn).removeClass("d-none");
                }
                else{   
                    unbanBtn = 'button[name="unban-'+idBan+'"]';
                    banBtn = 'button[name="ban-'+idBan+'"]';
                   $(unbanBtn).removeClass("d-none");
                   $(banBtn).addClass("d-none");
                }
            }
        });
    });
    $(document).on('click','#submitDeleteAccount', function() {
        var dataUrl = $(this).data('api-link');
        var statusClass= ".status-"+idBan;
        var status = 0;
        if(!$(statusClass).hasClass("d-none"))
        {
            status = 1;
        }
        var dataToCheck = { 
            accountEmail: emailBan,
            accountId: idBan,
            status: status,
            action: "delete"
        };
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: dataToCheck,
            success: function(response)
            {
                var data = JSON.parse(response);
                if(data)
                {
                    location.reload();
                }
            }
        });
    });
    $(document).on('click','input[name="searchSubmit"]', function() {

        var currentURL = new URL(window.location.href);
        currentURL.searchParams.delete('page');
        currentURL.searchParams.set('search', $("#search_account").val().toUpperCase());
        currentURL.searchParams.set('page', '1');
        window.location.href = currentURL;
    });
});
