<link rel="stylesheet" type="text/css" href="<?php echo __WEB_ROOT ?>public/assets/admin/css/admin_account.css">
<div class=" account" id="account" data-account="<?php echo __WEB_ROOT ?>/admin/Customer/getListCustomer" style="width:85.5%">

    <div class=" account_search ms-5 mt-5">
    <table>
        <tr>
          <td>
          <input type="text" <?php  if(isset($_GET['search'])) {echo "value='".$_GET['search']."'";}  ?> class="search_account rounded-4 ps-3" id="search_account" placeholder=<?php echo (isset($_GET['search'])&&strlen($_GET['search'])!=0) ? "" : "Nhập&nbsp;mã&nbsp;khách&nbsp;hàng" ?>>
            <img src="../image/search-interface-symbol 1.png" class="search_img " alt="">
            <input type="submit" class="submit_Search_account rounded-4 ms-3 " name="searchSubmit" id="searchSubmit" value="Tìm kiếm">
          </td>
        </tr>
        <tr>
          <td>
            <div class="suggestionsAccountSearch" hidden id="suggestionsAccountSearch"> </div>
          </td>
        </tr>
      </table>
    </div>
    <div class=" account_view mt-3 ms-5 mb-0">
        <table class="table table-hover table-striped table-borderless rounded-3 mb-0 " style="table-layout: fixed">
        <thead>
            <tr class="border-bottom border-dark">
                <th colspan="9" class="text-center fs-2 fw-normal rounded-top-4 ">Quản lý xác thực tài khoản</th>
            </tr>
            <tr>
                <th class="text-center column_title">Mã khách hàng</th>
                <th class="text-center column_title">Tên khách hàng</th>
                <th class="text-center column_title">Loại</th>
                <th class="text-center column_title">SĐT</th>
                <th class="text-center column_title">Email</th>
                <th class="text-center column_title">CCCD</th>
                <th class="text-center column_title">Mã công ty</th>
                <th class="text-center column_title">Xác thực</th>
                <th class="text-center column_title">Thao tác</th>

            </tr>
        </thead>
        <tbody>
            <?php
              $fillterArray =$accountList;
              if(isset($_GET['search']))
              {
                $fillterArray=[];
                $inputSearch= $_GET['search'];
                foreach ($accountList as $key => $value) {
                  if(strpos($value['makhachhang'], $inputSearch) !== false)
                      $fillterArray[]=$value;
                }
              }          
            // số dòng mỗi trang
            $itemsPerPage = 10;
            // tổng số lượng dòng
            $totalItems = count($fillterArray);
            // Tính toán tổng số trang cần, làm tròn lên
            $totalPages = ceil($totalItems / $itemsPerPage);
            // lấy giá trị trang hiện tại
            $currentpage = isset($_GET['page']) ? $_GET['page'] : 1;
            // đặt giới hạn cho số trang tránh trường hợp lỗi
            $currentpage = max(1, min($currentpage, $totalPages));
            // Tính toán vị trí bắt đầu của dữ liệu
            $start = ($currentpage - 1) * $itemsPerPage;

            for ($i=$start; $i < min($start + $itemsPerPage, $totalItems) ; $i++) { 
            echo
                "<tr>
                  <td class='text-center text-truncate makhachhang-".$fillterArray[$i]['makhachhang']."'>".$fillterArray[$i]['makhachhang']."</td>
                  <td class='text-center text-truncate tenkhachhang-".$fillterArray[$i]['makhachhang']."'>".$fillterArray[$i]['tenkhachhang']."</td>
                  <td class='text-center text-truncate loai-".$fillterArray[$i]['makhachhang']."'>".($fillterArray[$i]['type']?"Khách hàng sỉ":"Khách hàng lẻ")."</td>
                  <td class='text-center text-truncate sdt-".$fillterArray[$i]['makhachhang']."'>".$fillterArray[$i]['sdt']."</td>
                  <td class='text-center text-truncate email-".$fillterArray[$i]['makhachhang']."' >".$fillterArray[$i]['email']."</td>
                  <td class='text-center text-truncate cccd-".$fillterArray[$i]['makhachhang']."'>".$fillterArray[$i]['cmnd']."</td>
                  <td class='text-center text-truncate macongty-".$fillterArray[$i]['makhachhang']."'>".$fillterArray[$i]['macongty']."</td>
                  <td class='text-center text-truncate' >
                      <div class='".(empty($fillterArray[$i]['username'])?"d-none":"")." border-0 status-".$fillterArray[$i]['makhachhang']." btn_confirm'>
                          <svg xmlns='http://www.w3.org/2000/svg' width='28' height='28' fill='currentColor' class='bi bi-check-circle text-success' viewBox='0 0 16 16'>
                            <path d='M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16'/>
                            <path d='M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05'/>
                          </svg>
                      </div>
                      <button data-id='".$fillterArray[$i]['makhachhang']."' class='confirmAccount ".(empty($fillterArray[$i]['username'])?"":"d-none")." border-0 btn_confirm' data-bs-toggle='modal' data-bs-target='.account_add'>
                          <svg xmlns='http://www.w3.org/2000/svg' width='28' height='28' fill='currentColor' class='bi bi-exclamation-circle text-danger' viewBox='0 0 16 16'>
                            <path d='M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16'/>
                            <path d='M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z'/>
                          </svg>
                      </button>
                  </td>
                  <td class='text-center text-truncate' >
                    <button data-id='".$fillterArray[$i]['makhachhang']."'  class='detail-account border-0 btn_info' data-bs-toggle='modal' data-bs-target='.account_info'> 
                      <svg xmlns='http://www.w3.org/2000/svg' width='28' height='28' fill='currentColor' class='bi bi-info-circle text-success' viewBox='0 0 16 16'>
                        <path d='M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16'/>
                        <path d='m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0'/>
                      </svg>
                    </button>
                    <button data-id='".$fillterArray[$i]['makhachhang']."' class='delete-account border-0 btn_info' data-bs-toggle='modal' data-bs-target='.account_delete'> 
                      <svg xmlns='http://www.w3.org/2000/svg' width='28' height='28' fill='currentColor' class='bi bi-x-octagon text-danger' viewBox='0 0 16 16'>
                        <path d='M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1z'/>
                        <path d='M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708'/>
                      </svg>
                    </button>
                    <button  data-id='".$fillterArray[$i]['makhachhang']."' name='ban-".$fillterArray[$i]['makhachhang']."' class='".($fillterArray[$i]['trangthai']==0?"d-none":"")." btn_ban_account border-0 btn_info' data-bs-toggle='modal' data-bs-target='.account_ban'> 
                      <svg xmlns='http://www.w3.org/2000/svg' width='28' height='28' fill='red' class='bi bi-ban text-warning' viewBox='0 0 16 16'>
                        <path d='M15 8a6.973 6.973 0 0 0-1.71-4.584l-9.874 9.875A7 7 0 0 0 15 8M2.71 12.584l9.874-9.875a7 7 0 0 0-9.874 9.874ZM16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0'/>
                      </svg>
                    </button>
                    <button  data-id='".$fillterArray[$i]['makhachhang']."' name='unban-".$fillterArray[$i]['makhachhang']."' class='".($fillterArray[$i]['trangthai']==1?"d-none":"")."  btn_unban_account border-0 btn_info' data-bs-toggle='modal' data-bs-target='.account_unban'> 
                    <svg xmlns='http://www.w3.org/2000/svg' width='28' height='28' fill='gray' class='bi bi-ban text-warning' viewBox='0 0 16 16'>
                      <path d='M15 8a6.973 6.973 0 0 0-1.71-4.584l-9.874 9.875A7 7 0 0 0 15 8M2.71 12.584l9.874-9.875a7 7 0 0 0-9.874 9.874ZM16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0'/>
                    </svg>
                  </button>
                  </td>
               </tr>";
            }
            ?>
          </tbody>
          <tfoot>
            <tr >
                <th colspan="9" class="change_page rounded-bottom-4 ">
                  <ul class="pagination m-auto justify-content-end me-5">
                  <li class="page-item"><a class="page-link"  <?php echo 'href="?page=1"'?>><<</a></li>
                    <li class="page-item"><a class="page-link"  <?php echo ($currentpage==1) ? 'href="?page=1"':'href="?page=' . ($currentpage-1).'"'?>><</a></li>
                      <?php
                      if($currentpage==1)
                      {
                        ?>
                          <li class="page-item"><a  <?php echo 'class="page-link active"'  ?>  <?php echo 'href="?page=' . $currentpage.'"'?>><?php echo $currentpage; ?></a></li>
                          <li class="page-item"><a  <?php echo 'class="page-link "' ?>  <?php echo 'href="?page=' . ($currentpage+1).'"'?>><?php echo ($currentpage+1); ?></a></li>
                          <li class="page-item"><a  <?php echo 'class="page-link "' ?>  <?php echo 'href="?page=' . ($currentpage+2).'"'?>><?php echo ($currentpage+2); ?></a></li>
                          <?php
                      }else if($currentpage==$totalPages&&$totalPages>=3)
                      {
                        ?>
                          <li class="page-item"><a  <?php echo 'class="page-link "' ?>  <?php echo 'href="?page=' . ($currentpage-2).'"'?>><?php echo ($currentpage-2); ?></a></li>
                          <li class="page-item"><a  <?php echo 'class="page-link "' ?>  <?php echo 'href="?page=' . ($currentpage-1).'"'?>><?php echo ($currentpage-1); ?></a></li>
                          <li class="page-item"><a  <?php echo 'class="page-link active"' ?>  <?php echo 'href="?page=' . $currentpage.'"'?>><?php echo $currentpage; ?></a></li>
                          <?php
                      }else
                      {
                        ?>
                          <li class="page-item"><a  <?php echo 'class="page-link "' ?>  <?php echo 'href="?page=' . ($currentpage-1).'"'?>><?php echo ($currentpage-1); ?></a></li>
                          <li class="page-item"><a  <?php echo 'class="page-link active"' ?>  <?php echo 'href="?page=' . $currentpage.'"'?>><?php echo $currentpage; ?></a></li>
                          <li class="page-item"><a  <?php echo 'class="page-link "' ?>  <?php echo 'href="?page=' . ($currentpage+1).'"'?>><?php echo ($currentpage+1); ?></a></li>
                          <?php
                      }

                      ?>
                      <li class="page-item"><a class="page-link"  <?php echo ($currentpage==$totalPages) ? 'href="?page=' .$totalPages.'"' :'href="?page='.($currentpage+1).'"'?>>></a></li>
                      <li class="page-item"><a class="page-link" <?php echo 'href="?page=' .$totalPages.'"'?>>>></a></li>
                    </ul>
                    </ul>
                </th>
                </tfoot>   
            </tr>
          </tbody>
        </table>
    </div>
</div>

<!-- The Modal  xác thực-->
<div class="modal account_add mt-5 fade">
  <div class="modal-dialog modal_add modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Thông báo xác thực tài khoản</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <!-- Thay mới -->
      <div class="modal-body">
         <div class="fs-2 fw-bolder d-flex text-center">Bạn có chắc chắn muốn xác thực cho tài khoản</div>
      </div>
      <!-- Thay mới -->   
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button data-api-link="<?php echo __WEB_ROOT ?>admin/account/post_account" type="submit" name="submitAdd" class="btn btn-primary form_add_submit me-3 ">Xác nhận</button>
        <button type="button" name="cancelAdd" class="btn btn-danger form_add_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script src="<?php echo __WEB_ROOT ?>public/assets/admin/js/AccountScript.js"></script>

<!-- The Modal  thông tin-->
<div class="modal account_info mt-5 fade">  
  <div class="modal-dialog modal_info modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Thông tin tài khoản</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body d-flex justify-content-start ms-5 me-5 ps-5 pe-5">
          <table class="  fs-4">
            <tr style="height:55px">
                <td  class="info_title" >Mã khách hàng:</td>
                <td><input type="text" class="form-control input_info_id" name="input_info_id" id="input_info_id" disabled></td>
            </tr>
            <tr style="height:55px">
                <td class="info_title">Tên khách hàng:</td>
                <td><input type="text" class="form-control input_info_name" name="input_info_name" id="input_info_name" disabled></td>
            </tr>
            <tr style="height:55px">
                <td class="info_title">Loại:</td>
                <td><input type="text" class="form-control input_info_type" name="input_info_type" id="input_info_type" disabled></td>
            </tr>
            <tr style="height:55px">
                <td class="info_title">SĐT:</td>
                <td><input type="text" class="form-control input_info_phone" name="input_info_phone" id="input_info_phone" disabled></td>
            </tr>
            <tr style="height:55px">
                <td class="info_title">Email:</td>
                <td><input style="width: 300px" type="text" class="form-control input_info_mail" name="input_info_mail" id="input_info_mail" disabled></td>
            </tr>
            <tr style="height:55px">
                <td class="info_title_cccd">CCCD:</td>
                <td class="info_title_cccd"><input type="text" class="form-control input_info_cccd" name="input_info_cccd" id="input_info_cccd" disabled></td>
                <td class="info_title_macongty" hidden>Mã công ty:</td>
                <td class="info_title_macongty" hidden><input type="text" class="form-control input_info_company" name="input_info_company" id="input_info_company" disabled></td>
            </tr>
          </table>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" name="cancelInfo" class="btn btn-danger form_info_close ms-3 " data-bs-dismiss="modal">Thoát</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- The Modal  xóa-->
<div class="modal account_delete mt-5 fade">
  <div class="modal-dialog modal_delete modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Thông báo xóa tài khoản</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <!-- Thay mới -->
      <div class="modal-body">
         <div class="fs-2 fw-bolder d-flex text-center justify-content-center">Bạn có chắc chắn muốn xóa tài khoản</div>
      </div>
      <!-- Thay mới -->   
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" data-api-link='<?php echo __WEB_ROOT?>admin/account/post_account' data-bs-dismiss="modal" id="submitDeleteAccount" name="submitDelete" class="btn btn-primary form_delete_submit me-3 ">Xác nhận</button>
        <button type="button" name="cancelDelete" class="btn btn-danger form_delete_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- The Modal  ban-->
<div class="modal account_ban mt-5 fade">
  <div class="modal-dialog modal_ban modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Thông báo ban tài khoản</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <!-- Thay mới -->
      <div class="modal-body">
         <div class="fs-2 fw-bolder d-flex text-center justify-content-center">Bạn có chắc chắn muốn ban tài khoản</div>
      </div>
      <!-- Thay mới -->   
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" data-api-link='<?php echo __WEB_ROOT?>admin/account/post_account' data-bs-dismiss="modal" name="submitBan" class="btn btn-primary form_ban_submit me-3 ">Xác nhận</button>
        <button type="button" name="cancelBan" class="btn btn-danger form_ban_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>
<div class="modal account_unban mt-5 fade">
  <div class="modal-dialog modal_ban modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Thông báo ban tài khoản</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <!-- Thay mới -->
      <div class="modal-body">
         <div class="fs-2 fw-bolder d-flex text-center justify-content-center">Bạn có chắc chắn muốn gỡ ban tài khoản</div>
      </div>
      <!-- Thay mới -->   
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" data-api-link='<?php echo __WEB_ROOT?>admin/account/post_account' data-bs-dismiss="modal" name="submitUnban" class="btn btn-primary form_ban_submit me-3 ">Xác nhận</button>
        <button type="button" name="cancelBan" class="btn btn-danger form_ban_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>

