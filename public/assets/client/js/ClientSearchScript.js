$(document).ready(function() {
    var urlSearch = $("#client_search").data("contract");
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
            $("#search_input").on("focus",function() {
                if ($("#search_input").val().length==0) {
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
                            $("#search_input").val(element);
                            flag=false;
                            $("#suggestionsContractSearch").prop("hidden", true)
                        })
                    $("#suggestionsContractSearch").append(child);
                    });
                }else {
                    $("#suggestionsContractSearch").prop("hidden", false);
                    let inputValue =$("#search_input").val().toLowerCase();
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
                            $("#search_input").val(element);
                            flag=false;
                            $("#suggestionsContractSearch").prop("hidden", true)
                        })
                    $("#suggestionsContractSearch").append(child);
                    });
                }
            })
            $("#search_input").on("blur",function () {
                if (flag!=true) {
                    $("#suggestionsContractSearch").prop("hidden", true);
                  }
            })
            $("#search_input").on("input",function () {
                let inputValue =$("#search_input").val().toLowerCase();
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
                        $("#search_input").val(element);
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
        currentURL.searchParams.set('search', $("#search_input").val().toUpperCase());
        currentURL.searchParams.set('page', '1');
        window.location.href = currentURL;
    });
});