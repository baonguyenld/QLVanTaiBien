<link rel="stylesheet" type="text/css" href="<?php echo __WEB_ROOT ?>public/assets/admin/css/admin_Ship.css">
<div class="scroll  ship" id="ship"  data-ship="<?php echo __WEB_ROOT ?>/admin/Ship/getListShip"style="width:85.5%">
    <div class="ship_option ms-5 mt-5 d-flex flex-row align-items-end">
        <button class="ship_option_add me-3  rounded-4 " data-bs-toggle="modal" data-bs-target=".ship_add">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-plus-circle option_img mt-1" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>
            <div class ="option_content fw-normal mt-2 fs-5" >Tạo mới</div>
        </button>
        <button class="ship_option_report me-3 rounded-4" id="ship_option_report" data-weight="<?php echo __WEB_ROOT ?>/admin/Ship/getListMaxWeight" data-volume="<?php echo __WEB_ROOT ?>/admin/Ship/getListMaxVolumn" data-bs-toggle="modal" data-bs-target=".ship_report">
            <img src="<?php echo __WEB_ROOT ?>public/assets/admin/images/reporticon.png"  class ="choice_img mt-1">
            <div class ="option_content fw-normal  fs-5 mt-1" >Thống kê</div>
        </button>
    </div>
    <div class=" ship_search ms-5 mt-4">
    <table>
        <tr>
          <td>
          <input type="text"<?php  if(isset($_GET['search'])) {echo "value='".$_GET['search']."'";}  ?> name="input-search" class="search_ship rounded-4 ps-3" id="search_ship" placeholder=<?php echo (isset($_GET['search'])&&strlen($_GET['search'])!=0) ? "" : "Nhập&nbsp;mã&nbsp;tàu" ?>>
            <img src="../image/search-interface-symbol 1.png" class="search_img " alt="">
            <input type="submit" data-api-link="<?php echo __WEB_ROOT ?>admin/ship/post_ship" class="submit_Search_ship rounded-4 ms-3 " name="searchSubmit" value="Tìm kiếm">
          </td>
        </tr>
        <tr>
          <td>
            <div class="suggestionsShipSearch" hidden id="suggestionsShipSearch"> </div>
          </td>
        </tr>
      </table>
    </div>
    <div class=" ship_view mt-3 ms-5 mb-0">
        <table class="table table-hover table-sshiped table-borderless rounded-3 mb-0 " style="table-layout: fixed">
        <thead>
            <tr class="border-bottom border-dark">
                <th colspan="7" class="text-center fs-2 fw-normal rounded-top-4 ">Quản lý  tàu</th>
            </tr>
            <tr >
                <th class="text-center " style="width:150px  " >Số hiệu</th>
                <th class="text-center" style="width:200px " >tên tàu</th>
                <th class="text-center"  style="width:200px ">Trọng tải tối đa</th>
                <th class="text-center"  style="width:250px ">Trọng tải hiện tại</th>
                <th class="text-center"  style="width:200px ">Thể tích tối đa</th>
                <th class="text-center"  style="width:250px ">Thể tích hiện chứa</th>
                <th class="text-center" style="width:200px ">Thao tác</th>
            </tr>
        </thead>
        <tbody id="search-data">
        <?php
        $fillterArray =$shipList;
        if(isset($_GET['search']))
        {
          $fillterArray=[];
          $inputSearch= $_GET['search'];
          foreach ($shipList as $key => $value) {
            if(strpos($value['matau'], $inputSearch) !== false)
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
                  <td class='text-center text-truncate' data-name='matau-".$fillterArray[$i]['matau']."' >".$fillterArray[$i]['matau']."</td>
                  <td class='text-center text-truncate' data-name='tentau-".$fillterArray[$i]['matau']."'>".$fillterArray[$i]['tentau']."</td>
                  <td class='text-center text-truncate' data-name='trongluongtoida-".$fillterArray[$i]['matau']."'>".$fillterArray[$i]['trongluongtoida']."</td>
                  <td class='text-center text-truncate' data-name='trongluonghienchua-".$fillterArray[$i]['matau']."'>".$fillterArray[$i]['trongluonghienchua']."</td>
                  <td class='text-center text-truncate' data-name='thetichtoida-".$fillterArray[$i]['matau']."'>".$fillterArray[$i]['thetichtoida']."</td>
                  <td class='text-center text-truncate' data-name='thetichhienchua-".$fillterArray[$i]['matau']."'>".$fillterArray[$i]['thetichhienchua']."</td>
                  <td class='text-center text-truncate' >                                                                                           
                    <button class='border-0 btn_change' data-change-id='".$fillterArray[$i]['matau']."' data-api-link='".__WEB_ROOT."admin/ship/post_ship"."' data-bs-toggle='modal' data-bs-target='.ship_change'><img src='".__WEB_ROOT."public/assets/admin/images/pencil_2280532 1.png"."'/></button>
                    <button class='border-0 btn_delete' data-delete-id='".$fillterArray[$i]['matau']."' data-api-link='".__WEB_ROOT."admin/ship/post_ship"."'  data-bs-toggle='modal' data-bs-target='.ship_delete'> <img src='".__WEB_ROOT."public/assets/admin/images/close.png"."'/></button>
                  </td>
              </tr>";
            }
            ?>
          </tbody>
          <tfoot>
            <tr >
                <th colspan="7" class="change_page rounded-bottom-4 ">
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
<div class="modal ship_add mt-5 fade">
  <div class="modal-dialog modal_add modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Tạo mới tàu</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_add_ship">
          <table class="fs-4 table_add_ship d-flex justify-content-center">
            <tr >
                <td >
                  Mã tàu:
                </td>
                <td >
                  <input type="text" name="shipAddId"  class="ship_add_id rounded-2 " >
                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td >
                  Tên tàu:
                </td>
                <td >
                  <input type="text" name="shipAddName"  class="ship_add_name rounded-2 ">
                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td >
                  Trọng lượng tối đa:
                </td>
                <td >
                  <input type="text" name="shipAddMaxWeight"  class="ship_add_max_weight rounded-2 ">
                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td >
                  Trọng lượng hiện chứa:
                </td>
                <td >
                  <input type="text" name="shipAddCurrentWeight"  class="ship_add_current_weight rounded-2 ">
                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td >
                  Thể tích tối đa:
                </td>
                <td >
                  <input type="text" name="shipAddMaxVolume"  class="ship_add_max_volume rounded-2 ">
                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td >
                  Thể tích hiện chứa:
                </td>
                <td >
                  <input type="text" name="shipAddCurrentVolume" class="ship_add_current_volume rounded-2 ">
                </td>
                <td >
                </td>
            </tr>
          </table>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" data-api-link="<?php echo __WEB_ROOT ?>admin/ship/post_ship" name="submitAdd" class="btn btn-primary form_add_submit me-3 ">Xác nhận</button>
        <button type="button" class="btn btn-danger form_add_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- The Modal  tiêu chí báo cáo-->
<div class="modal ship_report mt-5 fade">
  <div class="modal-dialog modal-lg  modal-dialog-centered  ">
    <div class="modal-content ">
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <h4 class="modal-title fw-bold mx-auto">Thống kê tàu</h4>
        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
      <form action="" class="form_report_ship">
          <table class="fs-4 table_report_ship d-flex justify-content-center">
            <tr >
                <td >
                  Trọng lượng tối đa:
                </td>
                <td >
                  <input type="text" name="shipReportMaxWeight" id="shipReportMaxWeight" class="ship_report_max_weight rounded-2 ">
                  <div class="suggestionsShipReportMaxWeight" hidden   id="suggestionsShipReportMaxWeight">
                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td >
                  Thể tích tối đa:
                </td>
                <td >
                  <input type="text" name="shipReportMaxVolume" id="shipReportMaxVolume" class="ship_report_volume_weight rounded-2 ">
                  <div class="suggestionsShipReportMaxVolume" hidden   id="suggestionsShipReportMaxVolume">
                </td>
                <td >
                </td>
            </tr>
          </table>

      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" data-api-link="<?php echo __WEB_ROOT ?>admin/ship/post_ship" name="submitReport" class="btn btn-primary form_report_submit me-3 " data-bs-toggle="modal" data-bs-target=".ship_export">Xác nhận</button>
        <button type="button" class="btn btn-danger form_report_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- The Modal  xuất bảng báo cáo-->
<div class="modal ship_export mt-5 fade">
  <div class="modal-dialog modal-xl  modal-dialog-centered  ">
    <div class="modal-content ">
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <h4 class="modal-title fw-bold mx-auto">Bảng thống kê</h4>
        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
      <table class="  fs-4 table_export_ship w-100 h-75">
          <tr>
            <td  class="w-25">
              Trọng tải tối đa:
            </td>
              <td class="w-75">
                <input type="text" name="ship_export_max_weight"  class="ship_export_max_weight rounded-2  border-0" disabled>
              </td>
          </tr>
          <tr>
            <td  class="w-25">
              Thể tích tối đa:
            </td>
              <td class="w-75">
                <input type="text" name="ship_export_max_volume"  class="ship_export_max_volume rounded-2  border-0" disabled>
              </td>
          </tr>
          <tr>
            <td  class="w-25">
              Số lượng tàu:
            </td>
              <td class="w-75">
                <input type="text" name="ship_export_count"  class="ship_export_count rounded-2  border-0" disabled>
              </td>
          </tr>
      </table>
      <div class="overflow-scroll structure" style="height:400px">
      <table class="table table-bordered  table-sshiped fs-4 table_export_ship w-100 " >
        <thead class="thead-light text-light">
          <tr>
          <th class="text-center  bg-dark text-light" style="width:250px">Mã tàu</td>
          <th class="text-center  bg-dark text-light" style="width:250px">tên tàu</td>
          <th class="text-center  bg-dark text-light"  style="width:250px">Trọng tải tối đa</td>
          <th class="text-center  bg-dark text-light" style="width:250px">Trọng tải hiện chứa</td>
          <th class="text-center  bg-dark text-light" style="width:250px">Thể tích tối đa</td>
          <th class="text-center  bg-dark text-light"  style="width:250px">Thể tích hiện chứa</td>
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
<div class="modal ship_change mt-5 fade">
  <div class="modal-dialog modal_change modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Cập nhật tàu</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_change_ship">
          <table class="fs-4 table_change_ship d-flex justify-content-center">
          <tr >
                <td >
                  Mã tàu:
                </td>
                <td >
                  <input type="text" name="shipChangeId"  class="ship_change_id rounded-2 " readonly>
                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td >
                  Tên tàu:
                </td>
                <td >
                  <input type="text" name="shipChangeName"  class="ship_change_name rounded-2 ">
                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td >
                  Trọng lượng tối đa:
                </td>
                <td >
                  <input type="text" name="shipChangeMaxWeight"  class="ship_change_max_weight rounded-2 ">
                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td >
                  Trọng lượng hiện chứa:
                </td>
                <td >
                  <input type="text" name="shipChangeCurrentWeight"  class="ship_change_current_weight rounded-2 ">
                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td >
                  Thể tích tối đa:
                </td>
                <td >
                  <input type="text" name="shipChangeMaxVolume"  class="ship_change_max_volume rounded-2 ">
                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td >
                  Thể tích hiện chứa:
                </td>
                <td >
                  <input type="text" name="shipChangeCurrentVolume" class="ship_change_current_volume rounded-2 ">
                </td>
                <td >
                </td>
            </tr>
          </table>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" data-api-link="<?php echo __WEB_ROOT ?>admin/ship/post_ship" name="submitChange" class="btn btn-primary form_change_submit me-3 ">Xác nhận</button>
        <button type="button" class="btn btn-danger form_change_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- The Modal  xóa-->
<div class="modal ship_delete mt-5 fade">
  <div class="modal-dialog modal_delete modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Xóa tàu</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_delete_ship">
          <table class=" fs-4 table_delete_ship d-flex justify-content-center ">
          <tr >
                <td >
                  Mã tàu:
                </td>
                <td >
                  <input type="text" name="shipDeleteId"  class="ship_delete_id rounded-2 " readonly>
                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td >
                  Tên tàu:
                </td>
                <td >
                  <input type="text" name="shipDeleteName"  class="ship_delete_name rounded-2 " readonly>
                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td >
                  Trọng lượng tối đa:
                </td>
                <td >
                  <input type="text" name="shipDeleteMaxWeight"  class="ship_delete_max_weight rounded-2 " readonly>
                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td >
                  Trọng lượng hiện chứa:
                </td>
                <td >
                  <input type="text" name="shipDeleteCurrentWeight"  class="ship_delete_current_weight rounded-2 " readonly>
                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td >
                  Thể tích tối đa:
                </td>
                <td >
                  <input type="text" name="shipDeleteMaxVolume"  class="ship_delete_max_volume rounded-2 " readonly>
                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td >
                  Thể tích hiện chứa:
                </td>
                <td >
                  <input type="text" name="shipDeleteCurrentVolume" class="ship_delete_current_volume rounded-2 " readonly>
                </td>
                <td >
                </td>
            </tr>
          </table>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" data-api-link="<?php echo __WEB_ROOT ?>admin/ship/post_ship" name="submitDelete" class="btn btn-primary form_delete_submit me-3 ">Xác nhận</button>
        <button type="button" class="btn btn-danger form_delete_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div><script src="<?php echo __WEB_ROOT ?>public/assets/admin/js/ShipScript.js"></script>
