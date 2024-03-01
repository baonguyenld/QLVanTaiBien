$(document).ready(function() {
    $(document).on('click','#validateCode', function() {
        postData = {
            code: $("input[name='inputAuthentication']").val(),
        };
        var dataUrl = $(this).data('api-link');
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData,
            success: function(response){
                var data = JSON.parse(response);
                if(data['code']!= postData['code'] )
                {
                    $("#error_mail_code").removeClass("d-none");
                }
                else
                {
                    $("#error_mail_code").addClass("d-none");
                    window.location.href = data['url'];
                }
            }
        });
        return false;  
    
    })
});


