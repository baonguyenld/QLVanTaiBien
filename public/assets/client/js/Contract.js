$(document).ready(function() {
    $(document).on('click','#btn_contract_submit_client', function() {
        tenhanghoa= $("#cargo_contract_name").val()
        cangdi= $("#selectDepart").val()
        cangden= $("#selectDes").val()
        containerstatus= ($("#selectService").val());
        contentcontract= $("#contract_content_client").val().trim();
        let content = 
`Tên hàng hóa: #${tenhanghoa}#
Cảng khởi hành: #${cangdi}#
Cảng nhận hàng: #${cangden}#
Đã có container: #${containerstatus}#
Ghi chú: #${contentcontract}#`
        let contentToSave = content.replace(/\n/g, "\\n");
        var postData = {
            content: contentToSave
        };
        // let contentToDisplay = contentToSave.replace(/\\n/g, "\n");
        var dataUrl = $(this).data('api-link');
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData,
            success: function(response){
                var data = JSON.parse(response);
                window.location.href = data['url'];
            }
        });   
    })
});


