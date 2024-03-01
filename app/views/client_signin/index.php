<link rel="stylesheet" type="text/css" href="<?php echo __WEB_ROOT ?>public/assets/client/css/client_Signin.css">

<div class="body">
    <div class="title text-light d-flex justify-content-center pe-5 align-items-center fw-bolder">My SSC Acount</div>
    <div class="container-fluid mb-5">
        <div class="container" >
            <div  class="container-fluid signin d-flex flex-column justify-content-center  align-items-center">
            <form method="post" action="">
                    <table class="table table-borderless ">
                        <tr >
                            <td colspan="2" class="signin_title  " >
                            </td> 
                        </tr>
                        <tr style="height:75px">
                            <td class="signin_title ">Tài khoản:</td>
                            <td><input class="signin_input form-control" type="text" name="client_input_username"></td>
                        </tr>
                        <tr >
                            <td colspan="2" class="signin_title  ">
                            </td> 
                        </tr>
                            <td class="signin_title">Mật khẩu:</td>
                            <td><input  class="signin_input form-control" type="password" name="client_input_password"></td>         
                        </tr>
                        <tr>
                             <td colspan=2><p class="error_login" style="color: red; font-style: italic; font-size: 14px">Tài khoản hoặc mật khẩu không chính xác</p></td>
                        </tr>
                        </form>
                        <tr style="height:75px">
                            <td colspan="2" class="signin_title text-center ">
                                <input data-api-link="<?php echo __WEB_ROOT ?>home/validate_login_client" type="button"  class="button btn_signin border-0 rounded-3 h-50" name="signinSubmit" value="Đăng nhập">
                            </td> 
                        </tr>
                    </table>
                    <div class="signin_title mt-4 " style ="border-top:1px solid rgb(187, 187, 187) ">
                            <a href="" class="text-decoration-none text-dark">Quyên mật khẩu</a>
                            /
                            <a href="<?php echo __WEB_ROOT ?>home/signup" class="text-decoration-none text-dark">Đăng ký</a>
                    </div>

            </div>
        </div>
    </div>
</div>
<script src="<?php echo __WEB_ROOT ?>public/assets/client/js/SigninScript.js"></script>
