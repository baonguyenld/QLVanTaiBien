<link rel="stylesheet" type="text/css" href="<?php echo __WEB_ROOT ?>public/assets/client/css/client_Header.css">
<div class="header" >
        <div class ="container-fluid">
            <div class="row">
                <div class="col-sm-1">
                    <img src="<?php echo __WEB_ROOT ?>public/assets/client/images/ssc-high-resolution-logo 1.png" class="rounded logo_img">
                </div>
                <div class="col-sm-3 col-xl-3 col-lg-2 d-flex align-items-center">
                    <div class ="logo_title ">
                        Công ty cổ phần vận tải biển sài gòn
                    </div>
                </div>
                <div class="col-xl-8 col-lg-9 ">
                    <div class="row header_option justify-content-end header_right" >
                        <div class="col d-flex align-items-center justify-content-center">
                        <button type="button" class="btn_overview rounded-pill border-0 mb-3 bg-light fw-bold "><a style="text-decoration: none; color: black" href="<?php echo __WEB_ROOT ?>Home">Giới thiệu</a></button>
                        </div>
                        <div class="col d-flex align-items-center justify-content-center">
                        <button type="button" class="btn_overview dropdown-toggle rounded-pill border-0 mb-3 bg-light fw-bold btn_service " data-bs-toggle="dropdown" aria-expanded="false">Dịnh vụ</button>
                        <ul class="dropdown-menu menu_service mt-2 ">
                            <li class="d-flex flex-row ">
                                <button class="dropdown-item p-0" >
                                    <a class="item_link dropdown-item fs-5 text-black-50 text-decoration-none p-0 ps-2" href="<?php echo __WEB_ROOT.(isset($_SESSION['user_client'])?"home/client_search":"home/signin"); ?>">Tra cứu</a>
                                 </button>
           
                            </li>
                            <li class="dropdown-divider"></li>
                            <li class="d-flex flex-row">
                                <button class="dropdown-item p-0">
                                    <a class="item_link dropdown-item fs-5 text-black-50 text-decoration-none p-0 ps-2" href="<?php echo __WEB_ROOT.(isset($_SESSION['user_client'])?"home/client_contract":"home/signin"); ?>">Lập hợp đồng</a>
                                </button>
           
                            </li>
                        </ul>
                        </div>
                        <div class="col  d-flex align-items-center justify-content-center">
                        <button type="button" class="btn_overview rounded-pill border-0 mb-3 bg-light fw-bold btn_news">Tin tức</button>
                        </div>
                        <div class="col d-flex align-items-center justify-content-center">
                        <button type="button" class="btn_overview rounded-pill border-0 mb-3 bg-light fw-bold btn_contact">Liên hệ</button>
                        </div>
                        <div class="col d-flex align-items-center justify-content-center">
                        <button type="button" class="btn_overview rounded-pill border-0 mb-3 bg-light fw-bold btn_support">Hỗ trợ</button>
                        </div>
                        <div class="col d-flex align-items-center justify-content-end mb-3">
                            <input type="text" class="search_input rounded-pill border-1">
                            <img src="<?php echo __WEB_ROOT ?>public/assets/client/images/search-interface-symbol 1.png" class="search_logo me-3">
                        </div>
                        <div class="col d-flex align-items-center ">
                            <button type="button"  class="<?php echo (isset($_SESSION['user_client']))?"d-none":"" ?> btn_sign_up rounded-pill border-0 mb-3 me-4 fw-bold "><a href="<?php echo __WEB_ROOT ?>Home/signup">Đăng ký</a> </button>
                            <button type="button" class="<?php echo (isset($_SESSION['user_client']))?"d-none":"" ?> btn_sign_in rounded-pill border-0 mb-3 me-4 fw-bold "><a href="<?php echo __WEB_ROOT ?>Home/signin">Đăng Nhập</a> </button>
                            <!-- Thêm mới -->
                            <button type="button" class="btn_account btn_sm rounded-pill border-0 mb-3 <?php echo (!isset($_SESSION['user_client']))?"d-none":"" ?> fw-bold " data-bs-toggle="dropdown" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                                </svg>
                                Tài khoản
                            </button>
                            <ul class="dropdown-menu menu_account mt-2 ">
                            <li class="d-flex flex-row " href="#">
                                <a href="#" class="text-decoration-none  text-center w-100 h-100" >Thông tin</a>
                            </li>
                            <li class="dropdown-divider"></li>

                            <li class="d-flex flex-row">
                               <a href="<?php echo __WEB_ROOT ?>home/logout" class="text-decoration-none  text-center w-100 h-100">Thoát</a>
                                
                            </li>
                            <!-- Thêm mới -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>