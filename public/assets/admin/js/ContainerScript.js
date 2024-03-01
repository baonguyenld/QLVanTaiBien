$(document).ready(function() {
    var urlSearch = $("#container").data("container");

    $.ajax({
        type: 'POST',
        url: urlSearch,
        success:  function(response)
        {
            let data = JSON.parse(response);
            var arrayContainerId= [];
            let flag =false;
            data.forEach(element => {
                arrayContainerId.push(element.macontainer);
            });
            $("#search_container").on("focus",function() {
                if ($("#search_container").val().length==0) {
                    $("#suggestionsContainerSearch").prop("hidden", false);
                    count=arrayContainerId.length;
                    if (count>=6) {
                        $("#suggestionsContainerSearch").height(250);
                    }else  $("#suggestionsContainerSearch").height(count*45);
                    arrayContainerId.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#search_container").val(element);
                            flag=false;
                            $("#suggestionsContainerSearch").prop("hidden", true)
                        })
                    $("#suggestionsContainerSearch").append(child);
                    });
                }else {
                    $("#suggestionsContainerSearch").prop("hidden", false);
                    let inputValue =$("#search_container").val().toLowerCase();
                    let filterArray =[];
                    arrayContainerId.forEach(element => {
                                if(element.toLowerCase().includes(inputValue))
                                filterArray.push(element);
                        });
                    $("#suggestionsContainerSearch").empty();
                    countFilter=filterArray.length;
                    if (countFilter>=6) {
                        $("#suggestionsContainerSearch").height(250);
                    }else  $("#suggestionsContainerSearch").height(countFilter*45);
                    filterArray.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#search_container").val(element);
                            flag=false;
                            $("#suggestionsContainerSearch").prop("hidden", true)
                        })
                    $("#suggestionsContainerSearch").append(child);
                    });
                }
            })
            $("#search_container").on("blur",function () {
                if (flag!=true) {
                    $("#suggestionsContainerSearch").prop("hidden", true);
                  }
            })
            $("#search_container").on("input",function () {
                let inputValue =$("#search_container").val().toLowerCase();
                let filterArray =[];
                arrayContainerId.forEach(element => {
                            if(element.toLowerCase().includes(inputValue))
                            filterArray.push(element);
                    });
                $("#suggestionsContainerSearch").empty();
                countFilter=filterArray.length;
                if (countFilter>=6) {
                    $("#suggestionsContainerSearch").height(250);
                }else  $("#suggestionsContainerSearch").height(countFilter*45);
                filterArray.forEach(element => {   
                    let child = $("<div></div>");
                    child.text(element);
                    child.addClass("suggestion_item");
                    child.addClass("text-truncate");
                    child.on("click",function() {
                        $("#search_container").val(element);
                        flag=false;
                        $("#suggestionsContainerSearch").prop("hidden", true)
                    })
                $("#suggestionsContainerSearch").append(child);
                });
            })
             $("#suggestionsContainerSearch").mousedown(function() {
                flag=true;
            });
        }
    });

    var tongtrongluong = 0;
    var checkedValues = [];
    $("#containerAddType").change(function(){
        var selectedValue = $(this).val();
        if(selectedValue==1)
        {
            $('input[name="containerAddMaxVolume"]').val(33);
        }
        else {
            $('input[name="containerAddMaxVolume"]').val(67);
        }
      });
      $("#containerChangeType").change(function(){
        var selectedValue = $(this).val();
        if(selectedValue==1)
        {
            $('#containerChangeMaxVolume').val(33);
        }
        else {
            $('#containerChangeMaxVolume').val(67);
        }
      });
    $(document).on('click','.btn_change', function() {
        $('.column_error_change_container').addClass("d-none")
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
                $('input[name="containerChangeId"]').val(data['container'].macontainer);
                let html = '';
                data['typecontainer'].forEach(element => {
                   html+= "<option value='"+ element['maloaicontainer']+"'>"+element['tenloai']+"</option>";
                });
                $('#containerChangeType').html(html);
                $('#containerChangeType').val(data['container'].maloaicontainer);
                $('input[name="containerChangeWeight"]').val(data['container'].trongluonghientai);
                $('input[name="containerChangeMaxVolume"]').val(data['container'].thetichtoida);
                $('input[name="containerChangeCurrentVolume"]').val(data['container'].thetichhienchua);
            }
        });
    });
    $(document).on('click','button[name="submitChange"]', function() {
        var postData = {
            maloaicontainer:  $('#containerChangeType').val(),
            macontainer:   $('input[name="containerChangeId"]').val(),
            thetichtoida:  $('input[name="containerChangeMaxVolume"]').val(),
            trongluonghientai:  $('input[name="containerChangeWeight"]').val(),
            thetichhienchua:  $('input[name="containerChangeCurrentVolume"]').val(),
            arrmahanghoa: checkedValues, 
            action: "update"
        };
        $('.column_error_change_container').addClass("d-none")

        if(parseInt(postData['thetichhienchua']) > parseInt(postData['thetichtoida']))
        {
            $('#error_change_container').text("Thể tích hiện tại không thể vượt qua thể tích tối đa")
            $('.column_error_change_container').removeClass("d-none")
            return false;
        }
        else if(parseInt(postData['trongluonghientai']) > 28000)
        {
            $('#error_change_container').text("Trọng lượng vượt quá mức trọng tải của container")
            $('.column_error_change_container').removeClass("d-none")
            return false;
        }
        var dataUrl = $(this).data('api-link');
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData,
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
                let html = '';
                data.forEach(element => {
                   html+= "<option value='"+ element['maloaicontainer']+"'>"+element['tenloai']+" feet</option>";
                });
                $('#containerAddType').html(html);
                if($('#containerAddType').val()==1)
                {
                    $('input[name="containerAddMaxVolume"]').val(33);
                }  else {
                    $('input[name="containerAddMaxVolume"]').val(67);
                }
            }
        });
        return false;
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
                $('input[name="containerDeleteId"]').val(data.macontainer);
                $('input[name="containerDeleteType"]').val(data.tenloai);
                $('input[name="containerDeleteQuantity"]').val(data.trongluonghientai);
                $('input[name="containerDeleteMaxVolume"]').val(data.thetichtoida);
                $('input[name="containerDeleteCurrentVolume"]').val(data.thetichhienchua);
            }
        });
        return false;
    });
    $(document).on('click','button[name="submitDelete"]', function() {
        var postData = {
            macontainer: $('input[name="containerDeleteId"]').val(),
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
            maloaicontainer:  $('#containerAddType').val(),
            macontainer:   $('input[name="containerAddId"]').val(),
            thetichtoida:  $('input[name="containerAddMaxVolume"]').val(),
            trongluonghientai:  tongtrongluong,
            thetichhienchua:  $('input[name="containerAddCurrentVolume"]').val(),
            arrmahanghoa: checkedValues, 
            action: "insert"
        };
        $('.column_error_add_container').addClass("d-none")

        if(parseInt(postData['thetichhienchua']) > parseInt(postData['thetichtoida']))
        {
            $('#error_add_container').text("Thể tích hiện tại không thể vượt qua thể tích tối đa")
            $('.column_error_add_container').removeClass("d-none")
            return false;
        }
        else if(parseInt(postData['trongluonghientai']) > 28000)
        {
            $('#error_add_container').text("Trọng lượng vượt quá mức trọng tải của container")
            $('.column_error_add_container').removeClass("d-none")
            return false;
        }
        var dataUrl = $(this).data('api-link');
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData
        });
    });
    $(document).on('click','#assign-cargo', function(){
        var postData = {
            macontainer:  $('input[name="containerChangeId"]').val(),
            typeGetData: 'cargoData'
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
                    html+=" <tr> <td class='text-center'>"+element['mahanghoa']+"</td><td class='text-center'>"+element['tennhomhang']+"</td>"+
                    "<td class='text-center'>"+element['trongluong']+"</td><td class='text-center' ><input type='checkbox' name='listCargo' "+ (element['macontainer']== $('input[name="containerChangeId"]').val()||checkedValues.indexOf(element['mahanghoa'])!=-1?"checked":"")+"  value='"+element['mahanghoa']+"|"+element['trongluong']+"' style='width: 25px;height: 25px;'></td></tr>";
                })
              $("#cargo-change-data").html(html);
            }
        });
    });

    $(document).on('click','#btn_close_add_container', function(){
         tongtrongluong = 0;
         checkedValues = [];
        $('input[name="containerAddQuantity"]').val(0);
    });
    $(document).on('click','#btn_close_change_container', function(){
        tongtrongluong = 0;
        checkedValues = [];
       $('input[name="containerChangeQuantity"]').val(0);
   });
    
    $(document).on('click','button[name="confirmChangeCargo"]', function(){
        var tongtrongluong = 0;
        $('input[name="listCargo"]:checked').each(function () {
            var arr = $(this).val().split('|');
            checkedValues.push(arr[0]);
            tongtrongluong += parseInt(arr[1]);
        });
        $('input[name="containerChangeWeight"]').val(tongtrongluong);
    });
    $(document).on('click','#assign-add-cargo', function(){
        var postData = {
            typeGetData: 'cargoData'
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
                    html+=" <tr> <td class='text-center'>"+element['mahanghoa']+"</td><td class='text-center'>"+element['tennhomhang']+"</td>"+
                    "<td class='text-center'>"+element['trongluong']+"</td><td class='text-center' ><input type='checkbox' name='listAddCargo' "+(checkedValues.indexOf(element['mahanghoa'])!=-1?"checked":"")+"  value='"+element['mahanghoa']+"|"+element['trongluong']+"' style='width: 25px;height: 25px;'></td></tr>";
                })
                $("#cargo-add-data").html(html);
            }
        });
        
    });
    $(document).on('click','#assign-delete-cargo', function(){
        var postData = {
            flag: 'delete',
            macontainer: $('input[name="containerDeleteId"]').val(),
            typeGetData: 'cargoData'
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
                    html+=" <tr> <td class='text-center'>"+element['mahanghoa']+"</td><td class='text-center'>"+element['tennhomhang']+"</td>"+
                    "<td class='text-center'>"+element['trongluong']+"</td><td class='text-center' ><input type='checkbox' name='listDeleteCargo' checked disabled  value='"+element['mahanghoa']+"|"+element['trongluong']+"' style='width: 25px;height: 25px;'></td></tr>";
                })
                $("#cargo-delete-data").html(html);
                checkedValues = [];
                tongtrongluong = 0;
            }
        });
        
    });
    $(document).on('click','button[name="confirmAddCargo"]', function(){
        $('input[name="listAddCargo"]:checked').each(function () {
            var arr = $(this).val().split('|');
            checkedValues.push(arr[0]);
            tongtrongluong += parseInt(arr[1]);
        });
        $('input[name="containerAddQuantity"]').val(tongtrongluong);
    });
    $(document).on('click','input[name="searchSubmit"]', function() {
        var currentURL = new URL(window.location.href);
        currentURL.searchParams.delete('page');
        currentURL.searchParams.set('search', $("#search_container").val().toUpperCase());
        currentURL.searchParams.set('page', '1');
        window.location.href = currentURL;
  });
    
});
