<link rel="stylesheet" type="text/css" href="<?php echo __WEB_ROOT ?>public/assets/admin/css/admin_Trip.css">
<div class="scroll trip" id="trip" data-trip="<?php echo __WEB_ROOT ?>/admin/Trip/getListTrip" style="width:85.5%">
    <div class="trip_option ms-5 mt-5  d-flex flex-row align-items-end">
        <button class="trip_option_add me-3  rounded-4 " data-schedule="<?php echo __WEB_ROOT ?>/admin/Schedule/getListScheduleId" data-ship="<?php echo __WEB_ROOT ?>/admin/Ship/getListShip" id="trip_option_add" data-bs-toggle="modal" data-bs-target=".trip_add">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-plus-circle option_img mt-1" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>
            <div class ="option_content fw-normal mt-2 fs-5" >Tạo mới</div>
        </button>
        <button class="trip_option_report me-3 rounded-4" data-schedule="<?php echo __WEB_ROOT ?>/admin/Schedule/getListScheduleId" id="trip_option_report" data-bs-toggle="modal" data-bs-target=".trip_report">
            <img src="<?php echo __WEB_ROOT ?>public/assets/admin/images/reporticon.png"  class ="choice_img mt-1">
            <div class ="option_content fw-normal  fs-5 mt-1" >Thống kê</div>
        </button>
    </div>
    <div class=" trip_search ms-5 mt-4">
    <table>
        <tr>
          <td>
          <input type="text" <?php  if(isset($_GET['search'])) {echo "value='".$_GET['search']."'";}?> class="search_trip rounded-4 ps-3" id="search_trip" name="input-search" placeholder=<?php echo (isset($_GET['search'])&&strlen($_GET['search'])!=0) ? "" : "Nhập&nbsp;mã&nbsp;chuyến&nbsp;tàu" ?>>
            <img src="../image/search-interface-symbol 1.png" class="search_img " alt="">
            <input type="submit" data-api-link='<?php echo __WEB_ROOT ?>admin/trip/post_trip'  class="submit_Search_trip rounded-4 ms-3 " name="searchSubmit" value="Tìm kiếm">
          </td>
        </tr>
        <tr>
          <td>
            <div class="suggestionsTripSearch" hidden id="suggestionsTripSearch"> </div>
          </td>
        </tr>
      </table>

    </div>
    <div class=" trip_view mt-3 ms-5 mb-0">
        <table class="table table-hover table-striped table-borderless rounded-3 mb-0 " style="table-layout: fixed;">
        <thead>
            <tr class="border-bottom border-dark">
                <th colspan="5" class="text-center fs-2 fw-normal rounded-top-4 ">Quản lý chuyến tàu</th>
            </tr>
            <tr >
                <th class="text-center " style="width:150px  " >Mã chuyến tàu</th>
                <th class="text-center"  style="width:250px ">Thời gian trì hoãn</th>
                <th class="text-center" style="width:200px " >Mã tàu</th>
                <th class="text-center"  style="width:200px ">Mã lịch trình</th>
                <th class="text-center" style="width:200px ">Thao tác</th>
            </tr>
        </thead>
        <tbody id="search-data">
        <?php
            $fillterArray =$tripList;
            if(isset($_GET['search']))
            {
              $fillterArray=[];
              $inputSearch= $_GET['search'];
              foreach ($tripList as $key => $value) {
                if(strpos($value['machuyentau'], $inputSearch) !== false)
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
                  <td class='text-center text-truncate' data-name='machuyentau-".$fillterArray[$i]['machuyentau']."' >".$fillterArray[$i]['machuyentau']."</td>
                  <td class='text-center text-truncate' data-name='thoigiantrihoan-".$fillterArray[$i]['machuyentau']."'>".(($fillterArray[$i]['thoigiantrihoan']!=null)?$fillterArray[$i]['thoigiantrihoan']:0)."</td>
                  <td class='text-center text-truncate' data-name='matau-".$fillterArray[$i]['machuyentau']."'>".$fillterArray[$i]['matau']."</td>
                  <td class='text-center text-truncate' data-name='malichtrinh-".$fillterArray[$i]['machuyentau']."'>".(($fillterArray[$i]['malichtrinh']!=null)?$fillterArray[$i]['malichtrinh']:"")."</td>
                  <td class='text-center text-truncate' >                                                                                           
                    <button class='border-0 btn_change' data-change-id='".$fillterArray[$i]['machuyentau']."' data-schedule='".__WEB_ROOT."admin/Schedule/getListScheduleId"."' data-ship='".__WEB_ROOT."admin/Ship/getListShip"."' data-api-link='".__WEB_ROOT."admin/trip/post_trip"."' id='trip_option_change' data-bs-toggle='modal' data-bs-target='.trip_change'><img src='".__WEB_ROOT."public/assets/admin/images/pencil_2280532 1.png"."'/></button>
                    <button class='border-0 btn_delete' data-delete-id='".$fillterArray[$i]['machuyentau']."' data-api-link='".__WEB_ROOT."admin/trip/post_trip"."' data-bs-toggle='modal' data-bs-target='.trip_delete'> <img src='".__WEB_ROOT."public/assets/admin/images/close.png"."'/></button>
                  </td>
              </tr>";
            }
            ?>
          </tbody>
          <tfoot>
            <tr >
                <th colspan="5" class="change_page rounded-bottom-4 ">
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
<div class="modal trip_add mt-5 fade">
  <div class="modal-dialog modal_add modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Tạo mới chuyến tàu</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_add_trip">
          <table class=" fs-4 table_add_trip d-flex justify-content-center">
            <tr >
                <td >
                  Mã lịch trình:
                </td>
                <td >
                  <input type="text" name="tripAddSchedule" id="tripAddSchedule" class="trip_add_schedule rounded-2 ">
                  <div class="suggestionsTripAddSchedule" hidden   id="suggestionsTripAddSchedule">
                </td>
                <td ></td>
            </tr>
            <tr >
                <td >
                  Mã  tàu:
                </td>
                <td >
                  <input type="text" name="tripAddShip" id="tripAddShip"  class="trip_add_ship rounded-2 ">
                  <div class="suggestionsTripAddShip" hidden   id="suggestionsTripAddShip">
                </td>
                <td ></td>
            </tr>
            <tr >
                <td>Thời gian trì hoãn:</td>
                <td>
                  <input type="text" name="tripAddTime" class="trip_add_time rounded-2 w-50" >
              </td>
            </tr>
          </table>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" data-api-link="<?php echo __WEB_ROOT ?>admin/trip/post_trip" name="submitAdd" class="btn btn-primary form_add_submit me-3 ">Xác nhận</button>
        <button type="button" class="btn btn-danger form_add_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- The Modal  tiêu chí báo cáo-->
<div class="modal trip_report mt-5 fade">
  <div class="modal-dialog modal-lg  modal-dialog-centered  ">
    <div class="modal-content ">
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <h4 class="modal-title fw-bold mx-auto">Thống kê chuyến tàu</h4>
        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
      <form action="" class="form_report_trip">
          <table class=" fs-4 table_report_trip d-flex justify-content-center">
            <tr >
                <td >
                  Mã lịch trình:
                </td>
                <td >
                  <input type="text" name="tripReportSchedule" id="tripReportSchedule" class="trip_report_schedule rounded-2 ">
                  <div class="suggestionsTripReportSchedule" hidden   id="suggestionsTripReportSchedule">
                </td>
            </tr>
          </table>

      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" name="submitReport" class="btn btn-primary form_report_submit me-3 " data-bs-toggle="modal" data-bs-target=".trip_export">Xác nhận</button>
        <button type="button" class="btn btn-danger form_report_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- The Modal  xuất bảng báo cáo-->
<div class="modal trip_export mt-5 fade">
  <div class="modal-dialog modal-lg  modal-dialog-centered  ">
    <div class="modal-content ">
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <h4 class="modal-title fw-bold mx-auto">Bảng thống kê</h4>
        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
      <table class="  fs-4 table_export_trip w-100 h-75">
          <tr>
            <td  class="w-25">
              Mã lịch trình:
            </td>
              <td class="w-75">
                <input type="text" name="trip_export_schedule"  class="trip_export_schedule rounded-2  border-0" disabled>
              </td>
          </tr>
          <tr>
            <td  class="w-25">
              Số lượng chuyến tàu:
            </td>
              <td class="w-75">
                <input type="text" name="trip_export_count"  class="trip_export_count rounded-2  border-0" disabled>
              </td>
          </tr>
      </table>
      <div class="overflow-scroll structure" style="height:400px">
      <table class="table table-bordered  table-striped fs-4 table_export_trip w-100 " >
        <thead class="thead-light text-light">
          <tr>
          <th class="text-center  bg-dark text-light" style="width:250px">Mã chuyến tàu</td>
          <th class="text-center  bg-dark text-light" style="width:250px">Mã tàu</td>
          <th class="text-center  bg-dark text-light"  style="width:250px">thời gian trì hoãn</td>
          </tr>
          <tr>
          <th class="text-center  bg-dark text-light" style="width:250px">Mã chuyến tàu</td>
          <th class="text-center  bg-dark text-light" style="width:250px">Mã tàu</td>
          <th class="text-center  bg-dark text-light"  style="width:250px">thời gian trì hoãn</td>
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
<div class="modal trip_change mt-5 fade">
  <div class="modal-dialog modal_change modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Cập nhật chuyến tàu</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_change_trip">
          <table class=" fs-4 table_change_trip d-flex justify-content-center">
          <tr >
                <td >
                  Mã lịch trình:
                </td>
                <td >
                  <input type="text" name="tripChangeSchedule" id="tripChangeSchedule" class="trip_change_schedule rounded-2 ">
                  <div class="suggestionsTripChangeSchedule" hidden   id="suggestionsTripChangeSchedule">
                </td>
                <td ></td>
            </tr>
            <tr >
                <td >
                  Mã chuyến tàu:
                </td>
                <td >
                  <input type="text" name="tripChangeId" class="trip_change_id rounded-2 " readonly>
                  
                </td>
                <td >
                </td>
            </tr>
            <tr >
            <td >
                  Mã  tàu:
                </td>
                <td >
                  <input type="text" name="tripChangeShip" id="tripChangeShip" class="trip_change_ship rounded-2 ">
                  <div class="suggestionsTripChangeShip" hidden   id="suggestionsTripChangeShip">
                </td>
                <td ></td>
            </tr>
            <tr >
                <td>Thời gian trì hoãn:</td>
                <td>
                  <input type="text" name="tripChangeTime" class="trip_change_time rounded-2 w-50" >
              </td>
            </tr>
          </table>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" data-api-link="<?php echo __WEB_ROOT ?>admin/trip/post_trip" name="submitChange" class="btn btn-primary form_change_submit me-3">Xác nhận</button>
        <button type="button" class="btn btn-danger form_change_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- The Modal  xóa-->
<div class="modal trip_delete mt-5 fade">
  <div class="modal-dialog modal_delete modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Xóa chuyến tàu</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_delete_trip">
          <table class=" fs-4 table_delete_trip d-flex justify-content-center">
          <tr >
                <td >
                  Mã lịch trình:
                </td>
                <td >
                  <input type="text" name="tripDeleteSchedule" class="trip_delete_schedule rounded-2 " readonly>

                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td >
                  Mã chuyến tàu:
                </td>
                <td >
                  <input type="text" name="tripDeleteId" class="trip_delete_id rounded-2 " readonly>
                </td>
                <td >
                </td>
            </tr>
            <tr >
            <td >
                  Mã  tàu:
                </td>
                <td >
                  <input type="text" name="tripDeleteShip"  class="trip_delete_ship rounded-2 " readonly>

                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td>Thời gian trì hoãn:</td>
                <td>
                  <input type="text" name="tripDeleteTime" class="trip_delete_time rounded-2 w-50" readonly>
              </td>
            </tr>
            <tr class="column_error_delete_trip d-none">
                <td colspan=2>
                  <h5 class="error_delete_trip" style="color: red; font-style: italic"></h5>
              </td>
            </tr>
          </table>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" data-api-link="<?php echo __WEB_ROOT ?>admin/trip/post_trip" name="submitDelete" class="btn btn-primary form_delete_submit me-3 ">Xác nhận</button>
        <button type="button" class="btn btn-danger form_delete_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script src="<?php echo __WEB_ROOT ?>public/assets/admin/js/TripScript.js"></script>
