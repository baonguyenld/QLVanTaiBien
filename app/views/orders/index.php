<link rel="stylesheet" type="text/css" href="<?php echo __WEB_ROOT ?>public/assets/admin/css/admin_Order.css">
<div class="scroll  order" id="order"  data-order="<?php echo __WEB_ROOT ?>/admin/Order/getListOrder" style="width:85.5%">
    <div class="order_option ms-5 mt-5 d-flex flex-row align-items-end">
        <button class="order_option_add me-3  rounded-4 " id="order_option_add" data-trip="<?php echo __WEB_ROOT ?>/admin/Trip/getListTrip" data-contract="<?php echo __WEB_ROOT ?>/admin/Contract/getListContract" data-bs-toggle="modal" data-bs-target=".order_add">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-plus-circle option_img mt-1" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>
            <div class ="option_content fw-normal mt-2 fs-5" >Tạo mới</div>
        </button>
        <button class="order_option_report me-3 rounded-4" data-bs-toggle="modal" data-bs-target=".order_report">
            <img src="<?php echo __WEB_ROOT ?>public/assets/admin/images/reporticon.png"  class ="choice_img mt-1">
            <div class ="option_content fw-normal  fs-5 mt-1" >Thống kê</div>
        </button>
    </div>
    <div class=" order_search ms-5 mt-4">
    <table>
        <tr>
          <td>
          <input type="text" <?php  if(isset($_GET['search'])) {echo "value='".$_GET['search']."'";}  ?> class="search_order rounded-4 ps-3" id="search_order" placeholder=<?php echo (isset($_GET['search'])&&strlen($_GET['search'])!=0) ? "" : "Nhập&nbsp;mã&nbsp;vận&nbsp;đơn" ?>>
            <img src="../image/search-interface-symbol 1.png" class="search_img " alt="">
            <input type="submit" class="submit_Search_order rounded-4 ms-3 " name="searchSubmit" id="searchSubmit" value="Tìm kiếm">
          </td>
        </tr>
        <tr>
          <td>
            <div class="suggestionsOrderSearch" hidden id="suggestionsOrderSearch"> </div>
          </td>
        </tr>
      </table>
    </div>
    <div class=" order_view mt-3 ms-5 mb-0">
        <table class="table table-hover table-striped table-borderless rounded-3 mb-0 " style="table-layout: fixed">
        <thead>
            <tr class="border-bottom border-dark">
                <th colspan="8" class="text-center fs-2 fw-normal rounded-top-4 ">Quản lý vận đơn</th>
            </tr>
            <tr >
                <th class="text-center " style="width:150px  " >Mã</th>
                <th class="text-center" style="width:200px " >Ngày lập</th>
                <th class="text-center"  style="width:200px ">Tên người nhận</th>
                <th class="text-center"  style="width:250px ">Địa chỉ</th>
                <th class="text-center" style="width:200px ">Tổng container</th>
                <th class="text-center" style="width:200px ">Cảng đi</th>
                <th class="text-center" style="width:200px ">Cảng đến</th>
                <th class="text-center" style="width:200px ">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php
              $fillterArray =$orderList;
              if(isset($_GET['search']))
              {  
                  $fillterArray=[];
                  $inputSearch= $_GET['search'];
                  foreach ($orderList as $key => $value) {
                      if(strpos($value['mavandon'], $inputSearch) !== false)
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
                  <td class='text-center text-truncate' >".$fillterArray[$i]['mavandon']."</td>
                  <td class='text-center text-truncate' >".$fillterArray[$i]['ngaylap']."</td>
                  <td class='text-center text-truncate' >".$fillterArray[$i]['tennguoinhan']."</td>
                  <td class='text-center text-truncate' >".$fillterArray[$i]['diachinhan']."</td>
                  <td class='text-center text-truncate' >".$fillterArray[$i]['tongcontainer']."</td>
                  <td class='text-center text-truncate' >".$fillterArray[$i]['tencangdi']."</td>
                  <td class='text-center text-truncate' >".$fillterArray[$i]['tencangden']."</td>
                  <td class='text-center text-truncate' >                                                                                           
                    <button class='border-0 btn_change' data-change-id='".$fillterArray[$i]['mavandon']."' data-trip='".__WEB_ROOT."admin/Trip/getListTrip"."' data-api-link='".__WEB_ROOT."admin/order/post_order"."' data-bs-toggle='modal' data-bs-target='.order_change' data-change-id='".$fillterArray[$i]['mavandon']."'><img src='".__WEB_ROOT."public/assets/admin/images/pencil_2280532 1.png"."'/></button>
                    <button class='border-0 btn_delete' data-delete-id='".$fillterArray[$i]['mavandon']."' data-api-link='".__WEB_ROOT."admin/order/post_order"."'  data-bs-toggle='modal' data-bs-target='.order_delete'> <img src='".__WEB_ROOT."public/assets/admin/images/close.png"."'/></button>
                  </td>
              </tr>";
            }
          ?>
          </tbody>
          <tfoot>
            <tr >
                <th colspan="8" class="change_page rounded-bottom-4 ">
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
<div class="modal order_add mt-5 fade">
  <div class="modal-dialog modal_add modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Tạo mới vận đơn</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_add_order">
          <table class=" fs-4 table_add_order d-flex justify-content-center">
            <tr >
                <td >
                  Mã hợp đồng:
                </td>
                <td >
                  <input type="text" id="orderAddContract" name="orderAddContract" class="order_add_contract rounded-2 ">
                  <div class="suggestionsOrderAddContract" hidden   id="suggestionsOrderAddContract">
                </td>
            </tr>
          
            <tr >
                <td>Tên người nhận:</td>
                <td>
                  <input type="text" id="orderAddReceiver" name="orderAddReceiver" class="order_add_receiver rounded-2" >
              </td>
            </tr>
            <tr >
                <td>Địa chỉ:</td>
                <td>
                  <input type="text" id="orderAddAddress" name="orderAddAddress" class="order_add_address rounded-2 " >
                </td>
            </tr>
            <tr >
                <td>Mã chuyến tàu</td>
                <td>
                  <input type="text" id="orderAddTrip" name="orderAddTrip" class="order_add_receiver rounded-2" >
                  <div class="suggestionsOrderAddTrip" hidden   id="suggestionsOrderAddTrip">
              </td>
            </tr>
            <tr >
                <td>Số container:</td>
                <td>
                  <input type="text" value="0"  name="orderAddQuantity" class="order_add_quantity rounded-2 w-25" readonly>
                  <button data-api-link="<?php echo __WEB_ROOT ?>admin/order/post_order" id="btn_add_container" type="button" name="confirm" class="btn btn-secondary form_add_quantity ms-1 mb-2 w-25" data-bs-toggle="modal" data-bs-target="#order_add_container">...</button>
                </td>
                <td >
                  
                </td>
            </tr>
          </table>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" data-api-link="<?php echo __WEB_ROOT ?>admin/order/post_order" id="submitAddOrder" name="submitAdd" class="btn btn-primary form_add_submit me-3 " >Xác nhận</button>
        <button type="button" id="btn_close_add_order" class="btn btn-danger form_add_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- The Modal  tiêu chí báo cáo-->
<div class="modal order_report mt-5 fade">
  <div class="modal-dialog modal-lg  modal-dialog-centered  ">
    <div class="modal-content ">
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <h4 class="modal-title fw-bold mx-auto">Thống kê vận đơn</h4>
        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
      <form action="" class="form_report_order">
          <table class=" ms-5 me-3 mt-3 fs-4 table_report_order w-100">
            <tr >
                <td>Ngày lập:</td>
                <td >
                  <label  >từ ngày</label>
                  <input type="date" name="orderReportDate_1" class="order_report_date_1 form-control w-25 d-inline"  />
                  <label  >đến</label>
                  <input type="date" name="orderReportDate_2" class="order_report_date_2 form-control w-25 d-inline"  /> 
                </td>
            </tr>
            <tr >
                <td>Cảng đi:</td>
                <td>
                <select name="selectOrderDepart" id="selectOrderDepart" class=" order_report_depart form-control w-50">
                        <option value="1" selected>1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        </select>
              </td>
            </tr>
            <tr >
                <td>Cảng đến:</td>
                <td>
                <select name="selectOrderDes" id="selectOrderDes" class=" order_report_des form-control w-50">
                        <option value="1" selected>1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        </select>
              </td>
            </tr>
          </table>

      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" name="submitReport" class="btn btn-primary form_report_submit me-3 " data-bs-toggle="modal" data-bs-target=".order_export">Xác nhận</button>
        <button type="button" class="btn btn-danger form_report_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- The Modal  xuất bảng báo cáo-->
<div class="modal order_export mt-5 fade">
  <div class="modal-dialog modal-lg  modal-dialog-centered  ">
    <div class="modal-content ">
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <h4 class="modal-title fw-bold mx-auto">Bảng thống kê</h4>
        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
      <table class="  fs-4 table_export_order w-100 h-75">
          <tr style="height:50px">
            <td  class="w-25 h-25">
              Cảng đi:
            </td>
              <td class="w-75">
                <input type="text" name="order_export_depart"  class="order_export_depart rounded-2  border-0" disabled>
              </td>
          </tr>
          <tr style="height:50px">
            <td  class="w-25 h-25">
              Cảng đến:
            </td>
              <td class="w-75">
                <input type="text" name="order_export_des"  class="order_export_des rounded-2  border-0" disabled>
              </td>
          </tr>
          <tr style="height:50px">
            <td class="w-25">
              Thời gian:
            </td>
              <td class="w-75">
                  <label >từ ngày</label>
                  <input type="text" name="order_export_date_1" class="border-0 w-25"  disabled/>
                  <label >đến</label>
                  <input type="text" name="order_export_date_2" class="border-0 w-25"  disabled/> 
              </td>
          </tr>
          <tr style="height:50px">
            <td  class="w-25">
              SL vận đơn:
            </td>
              <td class="w-75">
                <input type="text" name="order_export_count_order"  class="order_export_count_order rounded-2  border-0" disabled>
              </td>
          </tr>
          <tr style="height:50px">
            <td  class="w-25">
              SL container:
            </td>
              <td class="w-75">
                <input type="text" name="order_export_count_order"  class="order_export_count_order rounded-2  border-0" disabled>
              </td>
          </tr>
      </table>
      <div class="overflow-scroll structure" style="height:400px">
      <table class="table table-bordered  table-striped fs-4 table_export_order w-100 " >
        <thead class="thead-light text-light">
          <tr>
          <th class="text-center  bg-dark text-light" style="width:250px">Mã</td>
          <th class="text-center  bg-dark text-light" style="width:250px">Tên </td>
          <th class="text-center  bg-dark text-light"  style="width:250px">Ngày lập</td>
          <th class="text-center  bg-dark text-light"  style="width:250px">Số order</td>
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
<div class="modal order_change mt-5 fade">
  <div class="modal-dialog modal_change modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Cập nhật vận đơn</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_change_order">
          <table class=" fs-4 table_change_order d-flex justify-content-center">
            <tr >
                <td >
                  Mã hợp đồng:
                </td>
                <td >
                  <!-- Xóa readonly -->
                  <input type="text"  name="orderChangeContract" id="orderChangeContract"  class="order_change_name rounded-2 " readonly>
                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td>
                  Mã vận đơn:
                </td>
                <td>
                  <!--  đổi orderChangeId thành orderChangeId -->
                  <input type="text" id="orderChangeId" name="orderChangeId" class="order_change_id rounded-2 " readonly>
                </td>
            </tr>
            <tr >
                <td>Ngày lập:</td>
                <td>
                  <input type="text" id="orderChangeDate" name="orderChangeDate" class="order_change_date form-control w-50" readonly/>
                </td>
            </tr>
            <tr >
                <td>Tên người nhận:</td>
                <td>
                  <input type="text" id="orderChangeReceiver" name="orderChangeReceiver" class="order_change_receiver rounded-2 " >
              </td>
            </tr>
            <tr >
                <td>Mã chuyến tàu:</td>
                <td>
                  <input type="text" id="orderChangeTrip" name="orderChangeTrip" class="order_change_receiver rounded-2 " >
                  <div class="suggestionsOrderChangeTrip" hidden   id="suggestionsOrderChangeTrip">
              </td>
            </tr>
            <tr >
                <td>Địa chỉ:</td>
                <td>
                  <input type="text" id="orderChangeAddress" name="orderChangeAddress" class="order_change_address rounded-2 " >
                </td>
            </tr>
            <tr >
                <td>Số container:</td>
                <td>
                  <input type="text" id="orderChangeQuantity" name="orderChangeQuantity" class="order_change_quantity rounded-2 w-25" readonly>
                  <button type="button" name="confirm" class="btn btn-secondary form_change_quantity ms-1 mb-2 w-25" data-bs-toggle="modal" data-bs-target=".order_change_container">...</button>
              </td>
            </tr>
          </table>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" data-api-link="<?php echo __WEB_ROOT ?>admin/order/post_order" id="submitChangeOrder" name="submitChange" class="btn btn-primary form_change_submit me-3 ">Xác nhận</button>
        <button type="button" class="btn btn-danger form_change_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- The Modal  xóa-->
<div class="modal order_delete mt-5 fade">
  <div class="modal-dialog modal_delete modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Xóa vận đơn</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_delete_order">
          <table class=" fs-4 table_delete_order d-flex justify-content-center">
            <tr >
                <td >
                  Mã hợp đồng:
                </td>
                <td >
                  <input type="text" name="orderDeleteContract" class="order_delete_order rounded-2 " readonly>
                </td>
            </tr>
            <tr >
                <td>
                  Mã vận đơn:
                </td>
                <td>
                  <input type="text" name="orderDeleteId" class="order_delete_id rounded-2 " readonly>
                </td>
            </tr>
            <tr >
                <td>Ngày lập:</td>
                <td>
                  <input type="text" name="orderDeleteDate" class="order_delete_date form-control w-50"  disabled/>
                </td>
            </tr>
            <tr >
                <td>Tên người nhận:</td>
                <td>
                  <input type="text" name="orderDeleteReceiver" class="order_delete_receiver rounded-2 " readonly>
                </td>
            </tr>
            <tr >
                <td>Địa chỉ:</td>
                <td>
                  <input type="text" name="orderDeleteAddress" class="order_delete_address rounded-2 "readonly >
              </td>
            </tr>

            <tr >
                <td>Số container:</td>
                <td>
                  <input type="text" name="orderDeleteQuantity" class="order_delete_quantity rounded-2 w-25" readonly>
                  <button type="button" name="confirm" class="btn btn-secondary form_delete_quantity ms-1 mb-2 w-25"data-bs-toggle="modal" data-bs-target="#order_delete_container">...</button>
              </td>
            </tr>
          </table>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" data-api-link="<?php echo __WEB_ROOT ?>admin/order/post_order" name="submitDelete" class="btn btn-primary form_delete_submit me-3 ">Xác nhận</button>
        <button type="button" class="btn btn-danger form_delete_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- The Modal  thêm container-->
<div class="modal order_add_container mt-5 fade" id="order_add_container">
  <div class="modal-dialog modal_add_order modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Chọn container</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_add_order_order">
          <div class="overflow-scroll structure" style="height:400px">
            <table class="table table-bordered  table-striped fs-4 table_add_order_order w-100 " >
              <thead class="thead-light text-light">
                <tr>
                  <th class="text-center  bg-dark text-light" >Mã container</td>
                  <th class="text-center  bg-dark text-light" ></td>
                </tr>
              </thead>
              <tbody id="container-add-data">
            
              </tbody>
            </table>
          </div>

      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" id="add_container_to_order" name="submitAdd" class="btn btn-primary form_add_order_submit me-3 " data-bs-toggle="modal" data-bs-target=".order_add">Xác nhận</button>
        <button type="button" class="btn btn-danger form_add_order_close ms-3 " data-bs-toggle="modal" data-bs-target=".order_add">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- The Modal  thay đổi container-->
<div class="modal order_change_container mt-5 fade" id="order_change_container">
  <div class="modal-dialog modal_change_order modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Chọn container</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_change_order_order">
          <div class="overflow-scroll structure" style="height:400px">
            <table class="table table-bordered  table-striped fs-4 table_change_order_order w-100 " >
              <thead class="thead-light text-light">
                <tr>
                  <th class="text-center  bg-dark text-light" >Mã container</td>
                  <th class="text-center  bg-dark text-light" ></td>
                </tr>
              </thead>
              <tbody id="orderChangeContainer">
            
              </tbody>
            </table>
          </div>

      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" id="change_container_order" name="submitChange" class="btn btn-primary form_change_order_submit me-3 " data-bs-toggle="modal" data-bs-target=".order_change">Xác nhận</button>
        <button type="button" class="btn btn-danger form_change_order_close ms-3 " data-bs-toggle="modal" data-bs-target=".order_change">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- The Modal  xóa container-->
<div class="modal order_delete_container mt-5 fade" id="order_delete_container">
  <div class="modal-dialog modal_delete_order modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Chọn container</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_delete_order_order">
          <div class="overflow-scroll structure" style="height:400px">
            <table class="table table-bordered  table-striped fs-4 table_delete_order_order w-100 " >
              <thead class="thead-light text-light">
                <tr>
                  <th class="text-center  bg-dark text-light" >Mã container</td>
                  <th class="text-center  bg-dark text-light" ></td>
                </tr>
              </thead>
              <tbody id="orderDeleteContainer">
  
              </tbody>
            </table>
          </div>

      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" name="submitDelete" class="btn btn-primary form_delete_order_submit me-3 " data-bs-toggle="modal" data-bs-target=".order_delete">Xác nhận</button>
        <button type="button" class="btn btn-danger form_delete_order_close ms-3 " data-bs-toggle="modal" data-bs-target=".order_delete">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script src="<?php echo __WEB_ROOT ?>public/assets/admin/js/OrderScript.js"></script>