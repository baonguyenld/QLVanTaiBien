$(document).ready(function() {
    var currentDate = new Date();
    var formattedDate = currentDate.toISOString().slice(0, 10);
    $("#scheduleAddDate").val(formattedDate);
    listSeaport=[]
    var urlSearch = $("#schedule").data("schedule");
    $.ajax({
        type: 'POST',
        url: urlSearch,
        success:  function(response)
        {
            let data = JSON.parse(response);
            var arrayScheduleId= [];
            let flag =false;
            data.forEach(element => {
                arrayScheduleId.push(element.malichtrinh);
            });
            $("#search_schedule").on("focus",function() {
                if ($("#search_schedule").val().length==0) {
                    $("#suggestionsScheduleSearch").prop("hidden", false);
                    count=arrayScheduleId.length;
                    if (count>=6) {
                        $("#suggestionsScheduleSearch").height(250);
                    }else  $("#suggestionsScheduleSearch").height(count*45);
                    arrayScheduleId.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#search_schedule").val(element);
                            flag=false;
                            $("#suggestionsScheduleSearch").prop("hidden", true)
                        })
                    $("#suggestionsScheduleSearch").append(child);
                    });
                }else {
                    $("#suggestionsScheduleSearch").prop("hidden", false);
                    let inputValue =$("#search_schedule").val().toLowerCase();
                    let filterArray =[];
                    arrayScheduleId.forEach(element => {
                                if(element.toLowerCase().includes(inputValue))
                                filterArray.push(element);
                        });
                    $("#suggestionsScheduleSearch").empty();
                    countFilter=filterArray.length;
                    if (countFilter>=6) {
                        $("#suggestionsScheduleSearch").height(250);
                    }else  $("#suggestionsScheduleSearch").height(countFilter*45);
                    filterArray.forEach(element => {   
                        let child = $("<div></div>");
                        child.text(element);
                        child.addClass("suggestion_item");
                        child.addClass("text-truncate");
                        child.on("click",function() {
                            $("#search_schedule").val(element);
                            flag=false;
                            $("#suggestionsScheduleSearch").prop("hidden", true)
                        })
                    $("#suggestionsScheduleSearch").append(child);
                    });
                }
            })
            $("#search_schedule").on("blur",function () {
                if (flag!=true) {
                    $("#suggestionsScheduleSearch").prop("hidden", true);
                  }
            })
            $("#search_schedule").on("input",function () {
                let inputValue =$("#search_schedule").val().toLowerCase();
                let filterArray =[];
                arrayScheduleId.forEach(element => {
                            if(element.toLowerCase().includes(inputValue))
                            filterArray.push(element);
                    });
                $("#suggestionsScheduleSearch").empty();
                countFilter=filterArray.length;
                if (countFilter>=6) {
                    $("#suggestionsScheduleSearch").height(250);
                }else  $("#suggestionsScheduleSearch").height(countFilter*45);
                filterArray.forEach(element => {   
                    let child = $("<div></div>");
                    child.text(element);
                    child.addClass("suggestion_item");
                    child.addClass("text-truncate");
                    child.on("click",function() {
                        $("#search_schedule").val(element);
                        flag=false;
                        $("#suggestionsScheduleSearch").prop("hidden", true)
                    })
                $("#suggestionsScheduleSearch").append(child);
                });
            })
             $("#suggestionsScheduleSearch").mousedown(function() {
                flag=true;
            });
        }
    });
    $(document).on('click',"#searchSubmit", function() {

        var currentURL = new URL(window.location.href);
        currentURL.searchParams.delete('page');
        currentURL.searchParams.set('search', $("#search_schedule").val().toUpperCase());
        currentURL.searchParams.set('page', '1');
        window.location.href = currentURL;
    });

    $(document).on('click',".addSeaportToSchedule", function() {
        seaport = $(this).val();
        if($(this).is(':checked'))
        {
            listSeaport.push(seaport);
        }
        else {
            listSeaport.splice(listSeaport.indexOf(seaport), 1);
        }
        text = '';
        if(listSeaport.length > 0)
        {
            listSeaport.forEach(function(phanTu) {
                text += phanTu + " - ";
            });
        }
        // value =  $("#schedule_add_seaport").val();
        $("#schedule_add_seaport").val( text)

    });
    $(document).on('click',"#close_add_seaport", function() {
        $(".addSeaportToSchedule:checked").prop("checked",false);
        listSeaport=[]
        $("#schedule_add_seaport").val("")
    });
    $(document).on('click',"#submitAddSchedule", function() {
        var dataUrl = $(this).data('api-link');
        var tenlichtrinh = '';
        if(listSeaport.length>0)
        {
            tenlichtrinh = listSeaport[0]+" - "+listSeaport[listSeaport.length-1]

        }
        var postData = {
            tenlichtrinh: tenlichtrinh,
            ngayxuatphat: $("#scheduleAddDate").val(),
            listseaport: listSeaport,
            action: "insert"
        };
        listSeaport=[]
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData,
        });
    });
    $(document).on('click',"#btn_close_change_schedule", function() {
        $(".changeSeaportToSchedule").prop("checked",false);
        listSeaport=[]
        $("#schedule_change_seaport").val("")
    })
    $(document).on('click',".schedule_change_seaprt", function() {
        $(".changeSeaportToSchedule").prop("checked",false);
        listSeaport=[]
        $("#schedule_change_seaport").val("")

    })
    $(document).on('click',".modal-content", function(event) {
        event.stopPropagation();
    })
     
    $(document).on('click',".btn_change", function() {
        var dataUrl = $(this).data('api-link');
        var id = $(this).data('change-id');
        var postData = {
            id: id,
            typeGetData: "change"
        };

        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData,
            success: function(response) {
                var data = JSON.parse(response);
                $("#scheduleChangeId").val(data['malichtrinh']);
                $("#scheduleChangeName").val(data['tenlichtrinh']);
                var currentDate = new Date(data['ngayxuatphat']);
                var formattedDate = currentDate.toISOString().slice(0, 10);
                $("#scheduleChangeDate").val(formattedDate);
                text = ''
                data['listSeaport'].forEach(element => {
                    $(".changeSeaportToSchedule[value='"+element['macang']+"']").prop("checked",true);
                    text += element['macang'] + " - ";
                    listSeaport.push( element['macang'])
                })
                
                $("#schedule_change_seaport").val(text)
               
            }
        });
        return false;
    });
    $(document).on('click',".btn_delete", function() {
        var dataUrl = $(this).data('api-link');
        var id = $(this).data('delete-id');
        var postData = {
            id: id,
            typeGetData: "delete"
        };

        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData,
            success: function(response) {
                var data = JSON.parse(response);
                $("#scheduleDeleteId").val(data['malichtrinh']);
                $("#scheduleDeleteName").val(data['tenlichtrinh']);
                var currentDate = new Date(data['ngayxuatphat']);
                var formattedDate = currentDate.toISOString().slice(0, 10);
                $("#scheduleDeleteDate").val(formattedDate);
                text = ''
                data['listSeaport'].forEach(element => {
                    text += element['macang'] + " - ";
                })
                let modifiedString = text.replace(/ - +$/, '');
                $("#scheduleDeleteListPort").val(modifiedString)
               
            }
        });
        return false;
    });
    $(document).on('click',"#submitChangeSeaport", function() {
        var tenlichtrinh = '';
        if(listSeaport.length>0)
        {
            tenlichtrinh = listSeaport[0]+" - "+listSeaport[listSeaport.length-1]

        }
        $("#scheduleChangeName").val(tenlichtrinh);
    });
    $(document).on('click',"#submitChangeSchedule", function() {
        var dataUrl = $(this).data('api-link');
   
        var postData = {
            malichtrinh:  $("#scheduleChangeId").val(),
            tenlichtrinh: $("#scheduleChangeName").val(),
            ngayxuatphat: $("#scheduleChangeDate").val(),
            listseaport: listSeaport,
            action: "update"
        };
        console.log(postData);
        listSeaport=[]
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData,
        });
    });
    $(document).on('click',".changeSeaportToSchedule", function() {
        seaport = $(this).val();
        if($(this).is(':checked'))
        {
            listSeaport.push(seaport);
        }
        else {
            listSeaport.splice(listSeaport.indexOf(seaport), 1);
        }
        text = '';
        if(listSeaport.length > 0)
        {
            listSeaport.forEach(function(phanTu) {
                text += phanTu + " - ";
            });
        }
        // value =  $("#schedule_add_seaport").val();
        $("#schedule_change_seaport").val( text)

    });
    $(document).on('click',"#submitDeleteSchedule", function() {
        var dataUrl = $(this).data('api-link');
   
        var postData = {
            malichtrinh:  $("#scheduleDeleteId").val(),
            action: "delete"
        };
        console.log(postData)
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData,
        });
    });
    
});