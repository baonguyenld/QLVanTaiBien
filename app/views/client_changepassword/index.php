<link rel="stylesheet" type="text/css" href="<?php echo __WEB_ROOT ?>public/assets/client/css/client_ChangePass.css">
<div class="body">
    <div class="title text-light d-flex justify-content-center pe-5 align-items-center fw-bolder">My SSC Acount</div>
    <div class="banner"></div>
    <div class="container-fluid mb-5">
        <div class="container" >
            <div class="container-fluid changePass d-flex flex-column justify-content-center  align-items-center" >
            <form action="">
                    <table class="table table-borderless ">
                        <tr style="height:100px">
                            <td class="changePass_title">Mật khẩu hiện tại:</td>
                            <td><input  class="changePass_input form-control" type="password" name="input_password_current"></td>
                        </tr>
                        <tr style="height:55px">
                            <td class="changePass_title">Mật khẩu mới:</td>
                            <td><input  class="changePass_input form-control" type="password" name="input_password_new"></td>
                        </tr>
                        <tr style="height:55px">
                            <td class="changePass_title">Xác nhận mật khẩu :</td>
                            <td><input  class="changePass_input form-control" type="password" name="input_repassword_new"></td>
                        </tr>
                        <tr style="height:55px">
                            <td colspan="2" class="signup_title text-center ">
                                <input type="submit" class="button btn_changePass_change fs-4 rounded-3 h-75 " name="submit" value="Đổi mật khẩu">
                            </td> 
                        </tr>
                    </table>
                    
                </form>
            </div>
        </div>
    </div>
</div>