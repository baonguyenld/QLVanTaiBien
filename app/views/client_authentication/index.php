
<link rel="stylesheet" type="text/css" href="<?php echo __WEB_ROOT ?>public/assets/client/css/client_Authentication.css">

<div class=" body">
    <div class="title text-light d-flex justify-content-center pe-5 align-items-center fw-bolder">My SSC Account</div>
    <div style="margin-top: 120px" class=" container-fluid mb-5">
        <div class="container"  >
            <div style= "border-top: 1px solid" class="container-fluid authentication d-flex flex-column justify-content-center  align-items-center" >
            <div class ="authentication_title fs-1">Xác thực</div>
            <div class ="authentication_content fs-4 text-black-50 mt-4">Vui lòng nhập mã xác thực được gửi qua email</div>
            <form method="post" class="d-flex flex-column align-items-center">
                <input type="text" class="form-control input_authentication mt-3"  name="inputAuthentication"  placeholder="Vui lòng nhập mã xác thực">
                 <div id="error_mail_code" class= "d-none"><p style="font-size: 12px;color: red">Mã xác thực không chính xác vui lòng kiểm tra lại</p></div>
                <input type="submit" data-api-link="<?php echo __WEB_ROOT ?>home/validate_mailcode" id="validateCode" class="btn_authentication_submit border-0 text-light text mt-4"  name="submitValidateCode" value="Xác nhận">
                <button class="border-0  btn_authentication_resend text mt-4">Gửi lại</button>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo __WEB_ROOT ?>public/assets/client/js/AuthenScript.js"></script>
