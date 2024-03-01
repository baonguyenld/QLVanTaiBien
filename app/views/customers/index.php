<link rel="stylesheet" type="text/css" href="<?php echo __WEB_ROOT ?>public/assets/admin/css/admin_Customer.css">
<div class="scroll  customer" id="customer" style="width:85.5%">
    <div class="customer_option ms-5 mt-5 d-flex flex-row align-items-end">
        <button class="customer_option_add me-3  rounded-4 " data-bs-toggle="modal" data-bs-target=".customer_add">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-plus-circle option_img mt-1" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>
            <div class ="option_content fw-normal mt-2 fs-5" >Tạo mới</div>
        </button>
        <div id="api_getlistcustomer" class='d-none' data-api-getlist="<?php echo __WEB_ROOT ?>admin/Customer/getListCustomer"></div>
        <button class="customer_option_report me-3 rounded-4" data-bs-toggle="modal" data-bs-target=".customer_report">
            <img src="<?php echo __WEB_ROOT ?>public/assets/admin/images/reporticon.png"  class ="choice_img mt-2">
            <div class ="option_content fw-normal  fs-5 mt-1" >Thống kê</div>
        </button>
    </div>
    <div class=" customer_search ms-5 mt-4">
    <table>
        <tr>
          <td>
          <input type="text" <?php  if(isset($_GET['search'])) {echo "value='".$_GET['search']."'";}  ?> name="input-search" class="search_customer rounded-4 ps-3" id="search_customer" placeholder=<?php echo (isset($_GET['search'])&&strlen($_GET['search'])!=0) ? "" : "Nhập&nbsp;mã&nbsp;khách&nbsp;hàng" ?>>
            <img src="../image/search-interface-symbol 1.png" class="search_img " alt="">
            <input data-api-link="<?php echo __WEB_ROOT ?>admin/customer/post_customer" type="submit" name="searchSubmit" class="submit_Search_customer rounded-4 ms-3 " value="Tìm kiếm">
          </td>
        </tr>
        <tr>
          <td>
            <div class="suggestionsCustomerSearch" hidden  id="suggestionsCustomerSearch"> </div>
          </td>
        </tr>
      </table>        
    </form>
    </div>
    <div class=" customer_view mt-3 ms-5 mb-0">
        <table class="table table-hover table-striped table-borderless rounded-3 mb-0 " style="table-layout: fixed">
        <thead>
            <tr class="border-bottom border-dark">
                <th colspan="9" class="text-center fs-2 fw-normal rounded-top-4 ">Quản lý khách hàng</th>
            </tr>
            <tr >
                <th class="text-center " style="width:150px  " >Mã </th>
                <th class="text-center" style="width:200px " >Họ tên</th>
                <th class="text-center"  style="width:200px ">Địa chỉ</th>
                <th class="text-center"  style="width:250px ">SĐT</th>
                <th class="text-center" style="width:200px ">Email</th>
                <th class="text-center" style="width:200px ">Loại</th>
                <th class="text-center" style="width:200px ">CCCD</th>
                <th class="text-center" style="width:200px ">Mã công ty</th>
                <th class="text-center" style="width:200px ">Thao tác</th>
            </tr>
        </thead>
        <tbody id="search-data">
        <?php
          $fillterArray =$customerList;
          if(isset($_GET['search']))
          {
            $fillterArray=[];
             $inputSearch= $_GET['search'];
            foreach ($customerList as $key => $value) {
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
                  <td class='text-center text-truncate' >".$fillterArray[$i]['makhachhang']."</td>
                  <td class='text-center text-truncate' >".$fillterArray[$i]['tenkhachhang']."</td>
                  <td class='text-center text-truncate' >".$fillterArray[$i]['diachi']."</td>
                  <td class='text-center text-truncate' >".$fillterArray[$i]['sdt']."</td>
                  <td class='text-center text-truncate' >".$fillterArray[$i]['email']."</td>
                  <td class='text-center text-truncate' >".($fillterArray[$i]['type']==1?"Khách hàng sỉ":"Khách hàng lẻ")."</td>
                  <td class='text-center text-truncate' >".(empty($fillterArray[$i]['cmnd'])?"":$fillterArray[$i]['cmnd'])."</td>
                  <td class='text-center text-truncate' >".(empty($fillterArray[$i]['macongty'])?"":$fillterArray[$i]['macongty'])."</td>                  
                  <td class='text-center text-truncate' >                                                                                           
                    <button class='border-0 btn_change' data-change-id='".$fillterArray[$i]['makhachhang']."' data-api-link='".__WEB_ROOT."admin/customer/post_customer"."' data-bs-toggle='modal' data-bs-target='.customer_change'><img src='".__WEB_ROOT."public/assets/admin/images/pencil_2280532 1.png"."'/></button>
                    <button class='border-0 btn_delete' data-delete-id='".$fillterArray[$i]['makhachhang']."' data-api-link='".__WEB_ROOT."admin/customer/post_customer"."' data-bs-toggle='modal' data-bs-target='.customer_delete'> <img src='".__WEB_ROOT."public/assets/admin/images/close.png"."'/></button>
                  </td>
              </tr>";
            }
            ?>
          </tbody>
          <tfoot>
            <tr >
                <th colspan="9" class="change_page rounded-bottom-4 ">
                  <ul class="pagination m-auto justify-content-end me-5">
                  <?php 
                    $link="?";
                    if (isset($_GET['search'])) {
                      $link="?search=".$_GET['search']."&";
                    } ?>
                    <li class="page-item"><a class="page-link"  <?php echo"href='".$link."page=1'" ?>><<</a></li>
                    <li class="page-item"><a class="page-link"  <?php echo ($currentpage==1) ? "href='".$link."page=1'": "href='".$link."page=".($currentpage-1)."'" ?>><</a></li>
                      <?php
                      if($currentpage==1)
                      {
                        ?>
                          <li class="page-item"><a  <?php echo 'class="page-link active"'  ?>  <?php echo "href='".$link."page=".$currentpage."'"?>><?php echo $currentpage; ?></a></li>
                          <li class="page-item"><a  <?php echo 'class="page-link "' ?>  <?php echo  "href='".$link."page=".($currentpage+1)."'"?>><?php echo ($currentpage+1); ?></a></li>
                          <li class="page-item"><a  <?php echo 'class="page-link "' ?>  <?php echo "href='".$link."page=".($currentpage+2)."'"?>><?php echo ($currentpage+2); ?></a></li>
                          <?php
                      }else if($currentpage==$totalPages&&$totalPages>=3)
                      {
                        ?>
                          <li class="page-item"><a  <?php echo 'class="page-link "' ?>  <?php echo  "href='".$link."page=".($currentpage-2).'"'?>><?php echo ($currentpage-2); ?></a></li>
                          <li class="page-item"><a  <?php echo 'class="page-link "' ?>  <?php echo  "href='".$link."page=".($currentpage-1).'"'?>><?php echo ($currentpage-1); ?></a></li>
                          <li class="page-item"><a  <?php echo 'class="page-link active"' ?>  <?php echo "href='".$link."page=".$currentpage."'"?>><?php echo $currentpage; ?></a></li>
                          <?php
                      }else 
                      {
                        ?>
                          <li class="page-item"><a  <?php echo 'class="page-link "' ?>  <?php echo  "href='".$link."page=".($currentpage-1)."'"?>><?php echo ($currentpage-1); ?></a></li>
                          <li class="page-item"><a  <?php echo 'class="page-link active"' ?>  <?php echo "href='".$link."page=".$currentpage."'"?>><?php echo $currentpage; ?></a></li>
                          <li class="page-item"><a  <?php echo 'class="page-link "' ?>  <?php echo  "href='".$link."page=".($currentpage+1)."'"?>><?php echo ($currentpage+1); ?></a></li>
                          <?php
                      }
                      ?>
                      <li class="page-item"><a class="page-link"  <?php echo ($currentpage==$totalPages) ? "href='".$link."page=".$totalPages."'":"href='".$link."page=".($currentpage-1)."'"?>>></a></li>
                      <li class="page-item"><a class="page-link" <?php echo "href='".$link."page=".$totalPages."'"?>>>></a></li>
                    </ul>
                </th>
                </tfoot>   
            </tr>
          </tbody>
        </table>
    </div>
</div>

<!-- The Modal  thêm-->
<div class="modal customer_add mt-5 fade">
  <div class="modal-dialog modal_add modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Thêm mới khách hàng</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
          <table class=" fs-4 table_add_customer d-flex justify-content-center">
            <tr >
                <td style="width:130px">
                  Họ tên:
                </td>
                <td>
                  <input type="text" name="customerAddName" class="customer_add_Name rounded-2 " autocomplete="off">
                </td>
            </tr>
            <tr >
                <td>Loại:</td>
                <td>
                  <input type="radio" class="me-2" id="customerAddState_1" name="customerAddState" value="1" checked><label class="me-2" for="customerAddState_1">Công ty</label>
                  <input type="radio" class="me-2" id="customerAddState_2" name="customerAddState" value="0"><label class="me-2" for="customerAddState_2">Cá nhân</label>
              </td>
            </tr>

            <tr >
                <td>Địa chỉ:</td>
                <td>
                  <input type="text" name="customerAddAddress" class="customer_add_address rounded-2"  autocomplete="off"/>
                </td>
            </tr>
            <tr >
                <td>SĐT:</td>
                <td>
                  <input type="text" name="customerAddPhone" class="customer_add_phone rounded-2    "autocomplete="off" />
              </td>
            </tr>
            <tr >
                <td>Email:</td>
                <td>
                  <input type="text" name="customerAddEmail" class="customer_add_email rounded-2    "autocomplete="off" />
              </td>
            </tr>
            <tr class="customerAddCccd d-none">
                <td>CCCD:</td>
                <td>
                  <input type="text" name="customerAddCccd" class="customer_add_email rounded-2    " autocomplete="off" />
              </td>
            </tr>
            <tr class="customerAddMaCongTy">
                <td>Mã công ty:</td>
                <td>
                  <input type="text" name="customerAddMacongty" class="customer_add_email rounded-2    " autocomplete="off" />
              </td>
            </tr>
          </table>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button  type="submit" data-api-link="<?php echo __WEB_ROOT ?>admin/customer/post_customer" name="submitAdd" id="submitAdd" class="btn btn-primary form_add_submit me-3 " data-bs-dismiss="modal">Xác nhận</button>
        <button type="button" class="btn btn-danger form_add_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
    </div>
  </div>
</div>

<!-- The Modal  tiêu chí báo cáo-->
<div class="modal customer_report mt-5 fade">
  <div class="modal-dialog modal-lg  modal-dialog-centered  ">
    <div class="modal-content ">
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <h4 class="modal-title fw-bold mx-auto">Thống kê khách hàng</h4>
        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
      <form action="" class="form_report_customer">
          <table class=" fs-4 table_report_customer d-flex justify-content-center">
            <tr >
                <td>Loại:</td>
                <td>
                  <input type="radio" class="me-2" id="customerReportState_1" name="customerState" value="Công ty" checked><label class="me-2" for="customerReportState_1">Công ty</label>
                  <input type="radio" class="me-2" id="customerReportState_2" name="customerState" value="Cá nhân"><label class="me-2" for="customerReportState_2">Cá nhân</label>
              </td>
            </tr>
          </table>

      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" name="submitReport" class="btn btn-primary form_report_submit me-3 " data-bs-toggle="modal" data-bs-target=".customer_export">Xác nhận</button>
        <button type="button" class="btn btn-danger form_report_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- The Modal  xuất bảng báo cáo-->
<div class="modal customer_export mt-5 fade">
  <div class="modal-dialog modal-xl  modal-dialog-centered  ">
    <div class="modal-content ">
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <h4 class="modal-title fw-bold mx-auto">Bảng thống kê</h4>
        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
      <table class="  fs-4 table_export_customer w-100 h-75">
          <tr>
            <td  class="w-25">
              Loại:
            </td>
              <td class="w-75">
                <input type="text" name="customer_export_state"  class="customer_export_state rounded-2  border-0" disabled>
              </td>
          </tr>
          <tr>
            <td  class="w-25">
              SL khách hàng:
            </td>
              <td class="w-75">
                <input type="text" name="customer_export_count"  class="customer_export_count rounded-2  border-0" disabled>
              </td>
          </tr>
      </table>
      <div class="overflow-scroll structure" style="height:400px">
      <table class="table table-bordered  table-striped fs-4 table_export_customer w-100 " >
        <thead class="thead-light text-light">
          <tr>
          <th class="text-center  bg-dark text-light" style="width:250px">Mã </td>
          <th class="text-center  bg-dark text-light" style="width:250px">Tên</td>
          <th class="text-center  bg-dark text-light"  style="width:250px">Địa chỉ</td>
          <th class="text-center  bg-dark text-light"  style="width:250px">SĐT</td>
          <th class="text-center  bg-dark text-light"  style="width:250px">email</td>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
      </div>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="btn btn-danger form_export_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
    
    </div>
  </div>
</div>

<!-- The Modal  cập nhật-->
<div class="modal customer_change mt-5 fade">
  <div class="modal-dialog modal_change modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Cập nhật khách hàng</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_change_customer">
          <table class=" fs-4 table_change_customer d-flex justify-content-center">
            <tr >
                <td>
                  Họ tên:
                </td>
                <td>
                  <input type="text" name="customerChangeName" class="customer_change_Name rounded-2 " >
                </td>
            </tr>
            <tr >
                <td>Loại:</td>
                <td>
                  <input type="radio" class="me-2" id="customerChangeState_1" name="customerChangeState" value="1" disabled><label class="me-2" for="customerChangeState_1" >Công ty</label>
                  <input type="radio" class="me-2" id="customerChangeState_2" name="customerChangeState" value="0" disabled><label class="me-2" for="customerChangeState_2">Cá nhân</label>
              </td>
            </tr>
            <tr >
                <td >
                  Mã khách hàng:
                </td>
                <td >
                  <input type="text" name="customerChangeId" list="list_change_data" class="customer_change_id rounded-2  " readonly>
                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td>Địa chỉ:</td>
                <td>
                  <input type="text" name="customerChangeAddress" class="customer_change_address rounded-2"  />
                </td>
            </tr>
            <tr >
                <td>SĐT:</td>
                <td>
                  <input type="text" name="customerChangePhone" class="customer_change_phone rounded-2    " >
              </td>
            </tr>
            <tr >
                <td>Email:</td>
                <td>
                  <input type="email" name="customerChangeEmail" class="customer_change_email rounded-2" disabled >
              </td>
            </tr>
            <tr class="customerChangeCccd d-none">
                <td >CCCD:</td>
                <td>
                  <input type="text" name="customerChangeCccd" class="customer_change_email rounded-2    " >
              </td>
            </tr>
            <tr class="customerChangeMacongty d-none">
                <td >Mã công ty:</td>
                <td>
                  <input type="text" name="customerChangeMacongty" class="customer_change_email rounded-2    " >
              </td>
            </tr>
          </table>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" data-api-link="<?php echo __WEB_ROOT ?>admin/customer/post_customer" name="submitChange" class="btn btn-primary form_change_submit me-3 ">Xác nhận</button>
        <button type="button" class="btn btn-danger form_change_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- The Modal  xóa-->
<div class="modal customer_delete mt-5 fade">
  <div class="modal-dialog modal_delete modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Xóa khách hàng</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_delete_customer">
          <table class="fs-4 table_delete_customer d-flex justify-content-center">
          <tr >
                <td>
                  Họ tên:
                </td>
                <td>
                  <input type="text" name="customerDeleteName" class="customer_delete_name rounded-2 " readonly>
                </td>
            </tr>
            <tr >
                <td>Loại:</td>
                <td>
                  <input type="radio" class="me-2" id="customerDeleteState_1" name="customerDeleteState" value="1" disabled><label class="me-2" for="customerDeleteState_1">Công ty</label>
                  <input type="radio" class="me-2" id="customerDeleteState_2" name="customerDeleteState" value="0"  disabled><label class="me-2" for="customerDeleteState_2">Cá nhân</label>
              </td>
            </tr>
            <tr >
                <td >
                  Mã khách hàng:
                </td>
                <td >
                  <input type="text" name="customerDeleteId" list="list_delete_data" class="customer_delete_id rounded-2 " readonly>
                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td>Địa chỉ:</td>
                <td>
                  <input type="text" name="customerDeleteAddress" class="customer_delete_address rounded-2"  readonly/>
                </td>
            </tr>
            <tr >
                <td>SĐT:</td>
                <td>
                  <input type="text" name="customerDeletePhone" class="customer_delete_phone rounded-2 " readonly>
              </td>
            </tr>
            <tr >
                <td>Email:</td>
                <td>
                  <input type="text" name="customerDeleteEmail" class="customer_delete_email rounded-2 " readonly>
              </td>
            </tr>
            <tr class="customerDeleteCccd d-none">
                <td >CCCD:</td>
                <td>
                  <input type="text" name="customerDeleteCccd" class="customer_delete_email rounded-2    " >
              </td>
            </tr>
            <tr class="customerDeleteMacongty d-none">
                <td >Mã công ty:</td>
                <td>
                  <input type="text" name="customerDeleteMacongty" class="customer_delete_email rounded-2    " >
              </td>
            </tr>
          </table>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" data-api-link="<?php echo __WEB_ROOT ?>admin/customer/post_customer" name="submitDelete" class="btn btn-primary form_delete_submit me-3 ">Xác nhận</button>
        <button type="button" class="btn btn-danger form_delete_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script src="<?php echo __WEB_ROOT ?>public/assets/admin/js/CustomerScript.js"></script>
