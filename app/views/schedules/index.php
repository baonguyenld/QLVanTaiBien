<link rel="stylesheet" type="text/css" href="<?php echo __WEB_ROOT ?>public/assets/admin/css/admin_Schedule.css">
<div class="  schedule" id="schedule" data-schedule="<?php echo __WEB_ROOT ?>/admin/Schedule/getListScheduleId" style="width:85.5%">
    <div class="schedule_option ms-5 mt-5 d-flex flex-row align-items-end">
        <button class="schedule_option_add me-3  rounded-4 " data-bs-toggle="modal" data-bs-target=".schedule_add">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-plus-circle option_img mt-1" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>
            <div   class ="option_content fw-normal mt-2 fs-5" >Tạo mới</div>
        </button>
        <button class="schedule_option_report me-3 rounded-4" data-bs-toggle="modal" data-bs-target=".schedule_report">
            <img src="<?php echo __WEB_ROOT ?>public/assets/admin/images/reporticon.png"  class ="choice_img mt-1">
            <div class ="option_content fw-normal  fs-5 mt-1" >Thống kê</div>
        </button>
    </div>
    <div class=" schedule_search ms-5 mt-4">
    <table>
        <tr>
          <td>
          <input type="text" <?php  if(isset($_GET['search'])) {echo "value='".$_GET['search']."'";}  ?> class="search_schedule rounded-4 ps-3" id="search_schedule" placeholder=<?php echo (isset($_GET['search'])&&strlen($_GET['search'])!=0) ? "" : "Nhập&nbsp;mã&nbsp;lịch&nbsp;trình" ?>>
            <img src="../image/search-interface-symbol 1.png" class="search_img " alt="">
            <input type="submit" data-api-link='<?php echo __WEB_ROOT ?>admin/schedule/post_schedule' class="submit_Search_schedule rounded-4 ms-3 " id="searchSubmit" name="searchSubmit" value="Tìm kiếm">
          </td>
        </tr>
        <tr>
          <td>
            <div class="suggestionsScheduleSearch" hidden id="suggestionsScheduleSearch"> </div>
          </td>
        </tr>
      </table>
    </div>
    <div class=" schedule_view mt-3 ms-5 mb-0">
        <table class="table table-hover table-striped table-borderless rounded-3 mb-0 " style="table-layout: fixed">
        <thead>
            <tr class="border-bottom border-dark">
                <th colspan="6" class="text-center fs-2 fw-normal rounded-top-4 ">Quản lý lịch trình</th>
            </tr>
            <tr >
                <th class="text-center " style="width:150px  " >Mã lịch trình</th>
                <th class="text-center" style="width:200px " >Tên lịch trình</th>
                <th class="text-center" style="width:200px ">Ngày xuất phát</th>
                <th colspan="2" class="text-center"  style="width:200px ">Danh sách cảng đi qua</th>
                <th class="text-center" style="width:200px ">Thao tác</th>
            </tr>
        </thead>
        <tbody>
        <?php
              $fillterArray =$scheduleList;
              if(isset($_GET['search']))
              {
                $fillterArray=[];
                $inputSearch= $_GET['search'];
                foreach ($scheduleList as $key => $value) {
                  if(strpos($value['malichtrinh'], $inputSearch) !== false)
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
                  <td class='text-center text-truncate' >".$fillterArray[$i]['malichtrinh']."</td>
                  <td class='text-center text-truncate' >".$fillterArray[$i]['tenlichtrinh']."</td>
                  <td class='text-center text-truncate' >".$fillterArray[$i]['ngayxuatphat']."</td>
                  <td colspan=2 class='text-center text-truncate' >".$fillterArray[$i]['danhsachcang']."</td>
                  <td class='text-center text-truncate' >                                                                                           
                    <button class='border-0 btn_change' data-change-id='".$fillterArray[$i]['malichtrinh']."' data-api-link='".__WEB_ROOT."admin/schedule/post_schedule"."' data-bs-toggle='modal' data-bs-target='.schedule_change' data-change-id='".$fillterArray[$i]['malichtrinh']."'><img src='".__WEB_ROOT."public/assets/admin/images/pencil_2280532 1.png"."'/></button>
                    <button class='border-0 btn_delete' data-api-link='".__WEB_ROOT."admin/schedule/post_schedule"."' data-delete-id='".$fillterArray[$i]['malichtrinh']."'  data-bs-toggle='modal' data-bs-target='.schedule_delete'> <img src='".__WEB_ROOT."public/assets/admin/images/close.png"."'/></button>
                  </td>
              </tr>";
            }
          ?>
          </tbody>
          <tfoot>
            <tr >
                <th colspan="6" class="change_page rounded-bottom-4 ">
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
<div class="modal schedule_add mt-5 fade">
  <div class="modal-dialog modal_add modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <!-- Thay thành cảng -->
        <div class="modal-title fw-bold mx-auto">Tạo mới lịch trình</div>
        <!-- <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button> -->
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_add_schedule">
          <table class=" fs-4 table_add_schedule d-flex justify-content-center">
            </tr>
                <td>Ngày xuất phát:</td>
                <td>
                  <input type="date" id="scheduleAddDate" name="scheduleAddDate" class="schedule_add_date form-control rounded-2 w-75" >
              </td>
            </tr>
            <tr >
              <!-- Thay mới -->
                <td >Chọn cảng:</td>
                <td >
                <button type="button" id="add_seaport_to_schedule" name="confirm" class="btn btn-secondary form_add_seaport w-25" data-bs-toggle="modal" data-bs-target=".schedule_add_seaprt">...</button>
                </td>
              <!-- Thay mới -->
              </tr >
          </table>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" id="submitAddSchedule" data-api-link="<?php echo __WEB_ROOT ?>admin/schedule/post_schedule" name="submitAdd" class="btn btn-primary form_add_submit me-3 ">Xác nhận</button>
        <button type="button" id="close_add_seaport" class="btn btn-danger form_add_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- The Modal  tiêu chí báo cáo-->
<div class="modal schedule_report mt-5 fade">
  <div class="modal-dialog modal-lg  modal-dialog-centered  ">
    <div class="modal-content ">
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <!-- Thay thành cảng -->
        <h4 class="modal-title fw-bold mx-auto">Thống kê lịch trình</h4>
        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
      <form action="" class="form_report_schedule">
          <table class=" fs-4 table_report_schedule d-flex justify-content-center">
            <tr >
                <td>Ngày xuất phát:</td>
                <td class="d-flex mt-1">
                  <input type="date" class="me-2 form-control" id="scheduleReportDateFirst" name="scheduleReportDateFirst" >đến&nbsp; 
                   <input type="date" class="me-2 form-control" id="scheduleReportDateLast" name="scheduleReportDateLast" >
              </td>
          </table>

      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" name="submitReport" class="btn btn-primary form_report_submit me-3 " data-bs-toggle="modal" data-bs-target=".schedule_export">Xác nhận</button>
        <button type="button"  class="btn btn-danger form_report_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- The Modal  xuất bảng báo cáo-->
<div class="modal schedule_export mt-5 fade">
  <div class="modal-dialog modal-xl  modal-dialog-centered  ">
    <div class="modal-content ">
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <h4 class="modal-title fw-bold mx-auto">Bảng thống kê</h4>
        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
      <table class="  fs-4 table_export_schedule w-100 h-75">
          <tr style="height:50px">
            <td class="w-25">
              Cảng xuất phát:
            </td>
            <td class="w-75">
                <input type="text" name="schedule_export_nation" class="border-0 w-25"  disabled/>
            </td>
          </tr>
          <tr>
            <td  class="w-25">
              Cảng kết thúc:
            </td>
              <td class="w-75">
                <input type="text" name="schedule_export_state"  class="schedule_export_state rounded-2  border-0" disabled>
              </td>
          </tr>
          <tr>
            <td  class="w-25">
              Ngày xuất phát:
            </td>
            <td class="d-flex mt-1 w-50">
                  <input type="text" class="me-2 border-0 " id="scheduleReportDateFirst" name="scheduleReportDateFirst" readonly disabled>đến&nbsp; 
                   <input type="text" class="me-2 border-0 " id="scheduleReportDateLast" name="scheduleReportDateLast" readonly disabled>
            </td>
          </tr>
          <tr>
            <td  class="w-25">
              SL lịch trình:
            </td>
              <td class="w-75">
                <input type="text" name="schedule_export_count"  class="schedule_export_count rounded-2  border-0" disabled>
              </td>
          </tr>
      </table>
      <div class="overflow-scroll structure" style="height:400px">
        <table class="table table-bordered  table-striped fs-4 table_export_schedule w-100 " >
        <thead class="thead-light text-light">
          <tr>
          <th class="text-center  bg-dark text-light" style="width:250px">Mã lịch trình</td>
          <th class="text-center  bg-dark text-light" style="width:250px">Tên lịch trình</td>
          <th class="text-center  bg-dark text-light"  style="width:250px">Cảng xuất phát</td>
          <th class="text-center  bg-dark text-light"  style="width:250px">Cảng kết thúc</td>
          <th class="text-center  bg-dark text-light"  style="width:250px">Ngày xuất phát</td>
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
<div class="modal schedule_change mt-5 fade">
  <div class="modal-dialog modal_change modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <!-- Thay đổi thành cảng -->
        <div class="modal-title fw-bold mx-auto">Cập nhật lịch trình</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_change_schedule">
          <table class="fs-4 table_change_schedule d-flex justify-content-center">
          <tr >
                <td >
                  Mã lịch trình:
                </td>
                <td >
                  <input type="text" id="scheduleChangeId" name="scheduleChangeId" class="schedule_change_id rounded-2 " disabled>
                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td>
                  Tên lịch trình:
                </td>
                <td>
                  <input type="text" id="scheduleChangeName" name="scheduleChangeName" class="schedule_change_name rounded-2 "  disabled>
                </td>
            </tr>
                <td>Ngày xuất phát:</td>
                <td>
                <input type="date" id="scheduleChangeDate" name="scheduleChangeDate" class="schedule_change_date form-control rounded-2 w-75" >
              </td>
            </tr>
            <tr >
              <!-- Thay mới -->
                <td >Chọn cảng:</td>
                <td >
                <button type="button" name="confirm" class="btn btn-secondary form_change_seaport w-25" data-bs-toggle="modal" data-bs-target=".schedule_change_seaprt">...</button>
                </td>
              <!-- Thay mới -->
              </tr >
          </table>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" id="submitChangeSchedule" data-api-link="<?php echo __WEB_ROOT ?>admin/schedule/post_schedule" name="submitChange" class="btn btn-primary form_change_submit me-3 ">Xác nhận</button>
        <button type="button" id="btn_close_change_schedule" class="btn btn-danger form_change_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- The Modal  xóa-->
<div class="modal schedule_delete mt-5 fade">
  <div class="modal-dialog modal_delete modal-lg modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header ">
        <!-- Thay đổi thành cảng -->
        <div class="modal-title mx-auto fw-bold">Xóa lịch trình</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_delete_schedule ">
          <table class="fs-4 table_delete_schedule d-flex justify-content-center">
          <tr >
                <td >
                  Mã lịch trình:
                </td>
                <td >
                  <input type="text" id="scheduleDeleteId" name="scheduleDeleteId" class="schedule_delete_id rounded-2" readonly>
                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td>
                  Tên lịch trình:
                </td>
                <td>
                  <input type="text" id="scheduleDeleteName" name="scheduleDeleteName" class="schedule_delete_name rounded-2 "readonly >
                </td>
            </tr>
            <tr >
                <td>Ngày xuất phát:</td>
                <td>
                  <input type="date" id="scheduleDeleteDate" name="scheduleDeleteDate" class="schedule_delete_date form-control rounded-2 w-75" readonly disabled>
              </td>
            </tr>
            <tr >
                <td colspan="2">Danh sách cảng đi :</td>
                
            </tr>
            <tr>
              <td colspan="2">
                <textarea style="height:100px; resize: none;" name="scheduleDeleteListPort" id="scheduleDeleteListPort" class="schedule_delete_list_port rounded-2 w-100" cols="30" rows="10" readonly></textarea>

                </td>
            </tr>
          </table>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" id="submitDeleteSchedule" data-api-link="<?php echo __WEB_ROOT ?>admin/schedule/post_schedule" name="submitDelete" class="btn btn-primary form_delete_submit me-3 ">Xác nhận</button>
        <button type="button" class="btn btn-danger form_delete_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- The Modal  thêm cảng-->
<div class="modal schedule_add_seaprt mt-5 fade">
  <div class="modal-dialog modal_add_seaprt modal-lg modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header ">
        <!-- Thay đổi thành cảng -->
        <div class="modal-title mx-auto fw-bold">Chọn cảng</div>
        <!-- <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button> -->
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <div class="overflow-scroll structure" style="height:400px">
        <div>
          <label class="fs-4 mb-2">Thứ tự cảng đi:</label>
          <input type="text" id="schedule_add_seaport" name="schedule_add_seaport" class="border-0 fs-4 w-75" value=""  disabled/>
        </div>
          <table class="table table-bordered  table-striped fs-4 table_export_schedule w-100 " >
            <thead class="thead-light text-light">
              <tr>
              <th class="text-center  bg-dark text-light" style="width:250px">Mã cảng</td>
              <th class="text-center  bg-dark text-light" style="width:250px">Tên cảng</td>
              <th class="text-center  bg-dark text-light"  style="width:250px"></td>

              </tr>
            </thead>
            <tbody>
              <?php
                foreach($seaportList as $seaport)
                {
                  echo "<tr><th class='text-center ' style='width:250px'>".$seaport['macang']."</td>
                    <th class='text-center ' style='width:250px'>".$seaport['tencang']."</td>
                    <td class='text-center' >
                    <input class='addSeaportToSchedule' type='checkbox' name='addSeaportToSchedule' value='".$seaport['macang']."' style='width: 25px;height: 25px;'>
                  </td> </tr>";
                }
              
              ?>
    
              
            </tbody>
          </table>
        </div>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" id="scheduleAddSeaport"  name="submitAddSeaport" class="btn btn-primary form_add_seaprt_submit me-3 "data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target=".schedule_add" >Xác nhận</button>
        <!-- <button type="button"  class="btn btn-danger form_add_seaprt_close ms-3 " data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target=".schedule_add">Hủy</button> -->
      </div>
      </form>
    </div>
  </div>
</div>
<!-- The Modal  cập nhật cảng-->
<div class="modal schedule_change_seaprt mt-5 fade">
  <div class="modal-dialog modal_change_seaprt modal-lg modal-dialog-centered  ">
    <div  class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header ">
        <!-- Thay đổi thành cảng -->
        <div class="modal-title mx-auto fw-bold">Chọn cảng</div>
        <!-- <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button> -->
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <div class="overflow-scroll structure" style="height:400px">
        <div>
          <label class="fs-4 mb-2">Thứ tự cảng đi:</label>
          <input type="text" id="schedule_change_seaport" name="schedule_change_seaport" class="border-0 fs-4 w-75" value=""  disabled/>
        </div>
          <table class="table table-bordered  table-striped fs-4 table_export_schedule w-100 " >
            <thead class="thead-light text-light">
              <tr>
              <th class="text-center  bg-dark text-light" style="width:250px">Mã cảng</td>
              <th class="text-center  bg-dark text-light" style="width:250px">Tên cảng</td>
              <th class="text-center  bg-dark text-light"  style="width:250px"></td>

              </tr>
            </thead>
            <tbody>
            <?php
                foreach($seaportList as $seaport)
                {
                  echo "<tr><th class='text-center ' style='width:250px'>".$seaport['macang']."</td>
                    <th class='text-center ' style='width:250px'>".$seaport['tencang']."</td>
                    <td class='text-center' >
                    <input class='changeSeaportToSchedule' type='checkbox' name='changeSeaportToSchedule' value='".$seaport['macang']."' style='width: 25px;height: 25px;'>
                  </td> </tr>";
                }
              
              ?>
              
            </tbody>
          </table>
        </div>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" id="submitChangeSeaport" name="submitChangeSeaport" class="btn btn-primary form_change_seaprt_submit me-3 " data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target=".schedule_change">Xác nhận</button>
        <!-- <button type="button" class="btn btn-danger form_change_seaprt_close ms-3 " data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target=".schedule_change">Hủy</button> -->
      </div>
      </form>
    </div>
  </div>
</div>
<script src="<?php echo __WEB_ROOT ?>public/assets/admin/js/ScheduleScript.js"></script>