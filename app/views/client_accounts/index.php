<link rel="stylesheet" type="text/css" href="<?php echo __WEB_ROOT ?>public/assets/client/css/client_Account.css">
<div class="body">
    <div class="title text-light d-flex justify-content-center pe-5 align-items-center fw-bolder">My SSC Acount</div>
    <div class="banner"></div>
    <div class="container-fluid mb-5">
        <div class="container" >
            <div class="container-fluid account d-flex flex-column justify-content-center  align-items-center">
            <form action="">
                   <table>
                    <tr style="height:65px" >
                        <td class="account_title ">Họ tên:&nbsp;</td>
                        <td class=""><input class="account_input form-control " type="text" name="input_name"></td>
                        <td>&emsp;&emsp;&emsp;</td>
                        <td class="account_title ">Email:&nbsp;</td>
                        <td><input  class="account_input form-control" type="email" name="input_email"></td>
                    </tr>
                    <tr style="height:65px">
                            <td class="account_title">Giới tính:</td>
                            <td>
                                <input  class="account_input form-check-input m-2"  type="radio" name="input_sex" id="input_sex_man" checked>
                                <label for="input_sex_man" class="account_title ">Nam</label>
                                <input  class="account_input form-check-input ms-4 m-2" type="radio" name="input_sex" id="input_sex_woman">
                                <label for="input_sex_woman" class="account_title">Nữ</label>
                            </td>
                            <td>&emsp;&emsp;&emsp;</td>
                            <td class="account_title">Loại:</td>
                            <td>
                                <input  class="account_input form-check-input m-2"  type="radio" name="input_type" id="input_type_personal" checked>
                                <label for="input_type_personal" class="account_title ">Cá nhân</label>
                                <input  class="account_input form-check-input ms-4 m-2" type="radio" name="input_type" id="input_type_company">
                                <label for="input_type_company" class="account_title">Công ty</label>
                            </td>
                    </tr>
                    <tr style="height:65px">
                        <td class="account_title">SĐT:&nbsp;</td>
                        
                        <td><input  class="account_input form-control" type="text" name="input_phone"></td>
                        <td></td>
                        <td class="account_title">Địa chỉ:&nbsp;</td>
                        <td><input  class="account_input form-control" type="text" name="input_address"></td>
                    </tr>
                    <tr style="height:65px">
                        <td class="account_title">CCCD:&nbsp;</td>
                        <td style="width:250px"><input  class="account_input form-control" type="text" name="input_cccd"></td>
                        <td></td>
                        <td class="account_title">Mã công ty:&nbsp;</td>
                        <td><input  class="account_input form-control" type="text" name="input_id_company"></td>
                    </tr>
                    <tr style="height:105px">
                        <td colspan="5" class="account_title text-center">
                            <input type="submit" class="button btn_account_change  rounded-3 h-75 " name="submit" value="Cập nhật">
                            <input type="submit" class="button btn_account_takepass  rounded-3 h-75  ms-5" name="submit" value="Đổi mật khẩu">
                        </td>
                    </tr>
                   </table>
                </form>
            </div>
        </div>
    </div>
</div>