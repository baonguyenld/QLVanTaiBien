$(document).ready(function() {
    $(document).on('click','input[name="signinSubmit"]', function() {
        postData = {
            username: $("input[name='client_input_username']").val(),
            password: $("input[name='client_input_password']").val(),
            type: "kh"
        };
        var dataUrl = $(this).data('api-link');
        $.ajax({
            type: 'POST',
            url: dataUrl,
            data: postData,
            success: function(response){
                var data = JSON.parse(response);
                var url = data['url'];
                console.log(data);
                if(url!=undefined)
                {
                    $(".error_login").css('display', 'none');
                    window.location.href = url;
                }
                else {
                    if(data['banned']!=undefined)
                    {
                        $(".error_login").text("Tài khoản đã bị khóa do vi phạm tiêu chuẩn công ty!");
                    }
                    else {
                        $(".error_login").text("Tài khoản hoặc mật khẩu không chính xác");
                    }
                    $(".error_login").css('display', 'block');
                }
            }
        });  
        return false;
  });
});
