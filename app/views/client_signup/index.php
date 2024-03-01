<link rel="stylesheet" type="text/css" href="<?php echo __WEB_ROOT ?>public/assets/client/css/client_Signup.css">
<div class="signup-margin body ">
    <div class="title text-light d-flex justify-content-center pe-5 align-items-center fw-bolder">My SSC Acount</div>
    <div class="container-fluid mb-5">
        <div class="container" >
            <div class=" container-fluid signup d-flex flex-column justify-content-center  align-items-center" >
            <form method="post" action="<?php echo __WEB_ROOT ?>Home/authen">
                    <table class="table table-borderless ">
                    <tr style="height:55px">
                            <td class="signup_title ">Họ tên:</td>
                            <td><input class="signup_input form-control" type="text" name="input_name"></td>
                        </tr>
                        <tr style="height:55px">
                            <td class="signup_title">Email:</td>
                            <td><input  class="signup_input form-control" type="email" name="input_email"></td>
                           
                        </tr>
                        <tr id="empty_mail" class="d-none" style="height:55px">
                            <td class="signup_title"></td>
                            <td><p style="font-style: italic; color: red">Email không được để trống</p></td>
                           
                        </tr>
                        <tr style="height:55px">
                            <td class="signup_title">SĐT:</td>
                            <td><input  class="signup_input form-control" type="text" name="input_phone"></td>
                        </tr>
                        <tr style="height:55px">
                            <td class="signup_title">Địa chỉ:</td>
                            <td><input  class="signup_input form-control" type="text" name="input_address"></td>
                        </tr>
                        <tr style="height:55px">
                            <td class="signup_title">Loại:</td>
                            <td>
                                <input  class="signup_input form-check-input m-2"  type="radio" name="input_type" value="0" id="input_type_personal" checked>
                                <label for="input_type_personal" class="signup_title ">Cá nhân</label>
                                <input  class="signup_input form-check-input ms-4 m-2" type="radio" name="input_type" value="1" id="input_type_company">
                                <label for="input_type_company" class="signup_title">Công ty</label>
                            </td>
                        </tr>
                        <tr style="height:55px">
                            <td class="signup_title">CCCD:</td>
                            <td><input class="signup_input form-control" type="text" name="input_cccd"></td>
                        </tr>
                        <tr style="height:55px">
                            <td class="signup_title">Mã công ty:</td>
                            <td><input  class="signup_input form-control" type="text" name="input_id_company"></td>
                        </tr>
                        <tr style="height:55px">
                            <td colspan="2" class="signup_title text-center ">
                                <input type="submit"  class="button btn_signup border-0 rounded-3 h-75 w-25" name="signupSubmit" value="Đăng ký">
                            </td> 
                        </tr>
                    </table>
                    <div class="signup_title mt-4 " style ="border-top:1px solid rgb(187, 187, 187) ">
                            <a  href="" class="btn_takePass  ">Quên mật khẩu</a>
                            /
                            <a  href="" class="btn_login ">Đăng nhập</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo __WEB_ROOT ?>public/assets/client/js/SignupScript.js"></script>