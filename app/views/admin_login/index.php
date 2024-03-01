<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
   
</head>
<body>
<link rel="stylesheet" type="text/css" href="<?php echo __WEB_ROOT ?>public/assets/admin/css/home_Admin_login.css">
    <div class="main d-flex align-items-center justify-content-center ">
            <div class="modal_signin  rounded-5">
                <div class="signin_header fw-bolder rounded-top-5 fs-1 text-center pt-1 ">
                    Admin
                </div>
                <form method="post" action="<?php echo __WEB_ROOT ?>home/admin_login" class="container-fluid d-flex align-items-center justify-content-center">
                    <table class="table table-borderless   mt-5  w-75">
                        <tr class="" style="height:75px">
                            <td class="signup_title " >Tài khoản:</td>
                            <td><input class="signup_input form-control w-100" type="text" name="input_username"></td>
                        </tr>
                        <tr style="height:75px">
                            <td class="signup_title" >Mật khẩu:</td>
                            <td><input  class="signup_input form-control w-100" type="password" name="input_password"></td>
                        </tr>
                        <?php if(!empty($error)) echo  "<tr><td colspan=2 style='font-size: 10px; color: red; font-style: italic'  class='signup_title' >".$error['admin_login']."</td></tr>" ?>
                  
                        <tr>
                            <td colspan="2" class="signup_title text-center ">
                            <input type="submit" class="button btn_signin border-0 fs-4  rounded-3 h-75  p-2" name="adminLoginSubmit" value="Đăng nhập">
                            </td>
                        </tr>
                        <input type="text" name="loai" value ="nv" hidden>
                    </table>
                </form>

            </div>
    </div>
</body>
</html>