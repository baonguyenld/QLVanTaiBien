<link rel="stylesheet" type="text/css" href="<?php echo __WEB_ROOT ?>public/assets/admin/css/admin_Seaport.css">
<div class="scroll  seaport" id="seaport" data-seaport="<?php echo __WEB_ROOT ?>/admin/Seaport/getListSeaport" style="width:85.5%">
    <div class="seaport_option ms-5 mt-5 d-flex flex-row align-items-end">
        <button class="seaport_option_add me-3  rounded-4 " data-bs-toggle="modal" data-bs-target=".seaport_add">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-plus-circle option_img mt-1" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>
            <div class ="option_content fw-normal mt-2 fs-5" >Tạo mới</div>
        </button>
        <button class="seaport_option_report me-3 rounded-4"  data-bs-toggle="modal" data-bs-target=".seaport_report">
            <img src="<?php echo __WEB_ROOT ?>public/assets/admin/images/reporticon.png"  class ="choice_img mt-1">
            <div class ="option_content fw-normal  fs-5 mt-1" >Thống kê</div>
        </button>
    </div>
    <div class=" seaport_search ms-5 mt-4">
    <table>
        <tr>
          <td>
          <input type="text" <?php  if(isset($_GET['search'])) {echo "value='".$_GET['search']."'";}  ?> name="input-search" class="search_seaport rounded-4 ps-3" id="search_seaport" placeholder=<?php echo (isset($_GET['search'])&&strlen($_GET['search'])!=0) ? "" : "Nhập&nbsp;mã&nbsp;cảng" ?>>
            <img src="../image/search-interface-symbol 1.png" class="search_img " alt="">
            <input type="submit" data-api-link="<?php echo __WEB_ROOT ?>admin/seaport/post_seaport" class="submit_Search_seaport rounded-4 ms-3 " name="searchSubmit" id="searchSubmit" value="Tìm kiếm">
          </td>
        </tr>
        <tr>
          <td>
            <div class="suggestionsSeaportSearch" hidden id="suggestionsSeaportSearch"> </div>
          </td>
        </tr>
      </table>
    </div>
    <div class=" seaport_view mt-3 ms-5 mb-0">
        <table class="table table-hover table-striped table-borderless rounded-3 mb-0 " style="table-layout: fixed">
        <thead>
            <tr class="border-bottom border-dark">
                <th colspan="7" class="text-center fs-2 fw-normal rounded-top-4 ">Quản lý cảng</th>
            </tr>
            <tr >
                <th class="text-center " style="width:150px  " >Mã cảng</th>
                <th class="text-center" style="width:200px " >Tên cảng</th>
                <th class="text-center"  style="width:200px ">Quốc gia</th>
                <th class="text-center"  style="width:250px ">Trạng thái</th>
                <th class="text-center" style="width:200px ">Thể tích tối đa</th>
                <th class="text-center" style="width:200px ">Thể tích hiện chứa</th>
                <th class="text-center" style="width:200px ">Thao tác</th>
            </tr>
        </thead>
        <tbody id="search-data">
            <?php
             $fillterArray =$seaportList;
            if(isset($_GET['search']))
            {
              $fillterArray=[];
              $inputSearch= $_GET['search'];
              foreach ($seaportList as $key => $value) {
                if(strpos($value['macang'], $inputSearch) !== false)
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
                  <td class='text-center text-truncate' >".$fillterArray[$i]['macang']."</td>
                  <td class='text-center text-truncate' >".$fillterArray[$i]['tencang']."</td>
                  <td class='text-center text-truncate' >".$fillterArray[$i]['quocgia']."</td>
                  <td class='text-center text-truncate' >".($fillterArray[$i]['trangthai']?"Trống":"Đầy")."</td>
                  <td class='text-center text-truncate' >".$fillterArray[$i]['thetichtoida']."</td>
                  <td class='text-center text-truncate' >".$fillterArray[$i]['thetichhienchua']."</td>
                  <td class='text-center text-truncate' >                                                                                           
                    <button class='border-0 btn_change' data-change-id='".$fillterArray[$i]['macang']."' data-api-link='".__WEB_ROOT."admin/seaport/post_seaport"."' data-bs-toggle='modal' data-bs-target='.seaport_change'><img src='".__WEB_ROOT."public/assets/admin/images/pencil_2280532 1.png"."'/></button>
                    <button class='border-0 btn_delete' data-delete-id='".$fillterArray[$i]['macang']."' data-api-link='".__WEB_ROOT."admin/seaport/post_seaport"."'  data-bs-toggle='modal' data-bs-target='.seaport_delete'> <img src='".__WEB_ROOT."public/assets/admin/images/close.png"."'/></button>
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
<div class="modal seaport_add mt-5 fade">
  <div class="modal-dialog modal_add modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Tạo mới cảng</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_add_seaport">
          <table class="fs-4 table_add_seaport d-flex justify-content-center">
          <tr >
                <td >
                  Mã cảng:
                </td>
                <td >
                  <input type="text" name="seaportAddId" class="seaport_add_id rounded-2 w-50">
                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td>
                  Tên cảng:
                </td>
                <td>
                  <input type="text" name="seaportAddName" class="seaport_add_name rounded-2 " >
                </td>
            </tr>
            <tr >
                <td >Quốc gia:</td>
                <td style="width:250px">
                  <input type="text" name="seaportAddNation"  id="seaportAddNation"  class="seaport_add_nation rounded-2 w-100" >
                </td>
                <td ></td>
            </tr>
            <tr >
                <td>Trạng thái:</td>
                <td>
                  <input type="radio" class="me-2" id="seaportAddState_1" name="seaportAddState" value="1" checked><label class="me-2" for="seaportAddState_1">Trống</label>
                  <input type="radio" class="me-2" id="seaportAddState_2" name="seaportAddState" value="0"><label class="me-2" for="seaportAddState_2">Đầy</label>
              </td>
            <tr >
                <td>Thể tích tối đa:</td>
                <td>
                  <input type="text" name="seaportAddMaxVolume" class="seaport_add_max_volume rounded-2 w-75" >
              </td>
            </tr>
            <tr >
                <td>Thể tích hiện chứa:</td>
                <td>
                  <input type="text" name="seaportAddCurrentVolume" class="seaport_add_curent_volume rounded-2 w-75" >
              </td>
            </tr>
            <tr class="d-none column_error_add_seaport">
                <td colspan="2">
                      <p style="color: red; font-style: italic" id="error_add_seaport"></p>
              </td>
            </tr>
          </table>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" data-api-link="<?php echo __WEB_ROOT ?>admin/seaport/post_seaport" name="submitAdd" class="btn btn-primary form_add_submit me-3 ">Xác nhận</button>
        <button type="button" class="btn btn-danger form_add_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- The Modal  tiêu chí báo cáo-->
<div class="modal seaport_report mt-5 fade">
  <div class="modal-dialog modal-lg  modal-dialog-centered  ">
    <div class="modal-content ">
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <h4 class="modal-title fw-bold mx-auto">Thống kê cảng</h4>
        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
      <form action="" class="form_report_seaport">
          <table class="fs-4 table_report_seaport d-flex justify-content-center">
          <tr >
                <td style="width:200px">Quốc gia:</td>
                <td style="width:250px">
                  <select name="seaportReportNation" id="seaportReportNation" class="seaport_report_nation rounded-2  w-100" >
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                </td>
                <td ></td>
            </tr>
            <tr >
                <td>Trạng thái:</td>
                <td>
                  <input type="radio" class="me-2" id="seaportReportState_1" name="seaportReportState" value="1" checked><label class="me-2" for="seaportReportState_1">Trống</label>
                  <input type="radio" class="me-2" id="seaportReportState_2" name="seaportReportState" value="0" ><label class="me-2" for="seaportReportState_2">Đầy</label>
              </td>
          </table>

      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" name="submitReport" class="btn btn-primary form_report_submit me-3 " data-bs-toggle="modal" data-bs-target=".seaport_export">Xác nhận</button>
        <button type="button" class="btn btn-danger form_report_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- The Modal  xuất bảng báo cáo-->
<div class="modal seaport_export mt-5 fade">
  <div class="modal-dialog modal-xl  modal-dialog-centered  ">
    <div class="modal-content ">
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <h4 class="modal-title fw-bold mx-auto">Bảng thống kê</h4>
        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
      <table class="  fs-4 table_export_seaport w-100 h-75">
          <tr style="height:50px">
            <td class="w-25">
              Quốc gia:
            </td>
            <td class="w-75">
                <input type="text" name="seaport_export_nation" class="border-0 w-25"  disabled/>
            </td>
          </tr>
          <tr>
            <td  class="w-25">
              Trạng thái:
            </td>
              <td class="w-75">
                <input type="text" name="seaport_export_state"  class="seaport_export_state rounded-2  border-0" disabled>
              </td>
          </tr>
          <tr>
            <td  class="w-25">
              SL cảng:
            </td>
              <td class="w-75">
                <input type="text" name="seaport_export_count"  class="seaport_export_count rounded-2  border-0" disabled>
              </td>
          </tr>
      </table>
      <div class="overflow-scroll structure" style="height:400px">
      <table class="table table-bordered  table-striped fs-4 table_export_seaport w-100 " >
        <thead class="thead-light text-light">
          <tr>
          <th class="text-center  bg-dark text-light" style="width:250px">Mã cảng</td>
          <th class="text-center  bg-dark text-light" style="width:250px">Tên cảng</td>
          <th class="text-center  bg-dark text-light"  style="width:250px">Quốc gia</td>
          <th class="text-center  bg-dark text-light"  style="width:250px">Thể tích tối đa</td>
          <th class="text-center  bg-dark text-light"  style="width:250px">Thể tích hiện tại</td>
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
<div class="modal seaport_change mt-5 fade">
  <div class="modal-dialog modal_change modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Cập nhật cảng</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_change_seaport">
          <table class="fs-4 table_change_seaport d-flex justify-content-center">
          <tr >
                <td >
                  Mã cảng:
                </td>
                <td >
                  <input type="text" name="seaportChangeId" class="seaport_change_id rounded-2 " readonly>
                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td>
                  Tên cảng:
                </td>
                <td>
                  <input type="text" name="seaportChangeName" class="seaport_change_name rounded-2 " >
                </td>
            </tr>
            <tr >
                <td style="width:200px">Quốc gia:</td>
                <td style="width:250px">
                  <input type="text" name="seaportChangeNation" id="seaportChangeNation" class="seaport_change_nation rounded-2 w-100" >
                </td>
                <td ></td>
            </tr>
            <tr >
                <td>Trạng thái:</td>
                <td>
                  <input type="radio" class="me-2" id="seaportChangeState_1" name="seaportChangeState" value="1"><label class="me-2" for="seaportChangeState_1">Trống</label>
                  <input type="radio" class="me-2" id="seaportChangeState_2" name="seaportChangeState" value="0"><label class="me-2" for="seaportChangeState_2">Đầy</label>
              </td>
            <tr >
                <td>Thể tích tối đa:</td>
                <td>
                  <input type="text" name="seaportChangeMaxVolume" class="seaport_change_max_volume rounded-2 w-75" >
              </td>
            </tr>
            <tr >
                <td>Thể tích hiện chứa:</td>
                <td>
                  <input type="text" name="seaportChangeCurrentVolume" class="seaport_change_curent_volume rounded-2 w-75" >
              </td>
            </tr>
            <tr class="d-none column_error_change_seaport">
                <td colspan="2">
                      <p style="color: red; font-style: italic" id="error_change_seaport"></p>
              </td>
            </tr>
          </table>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" data-api-link="<?php echo __WEB_ROOT ?>admin/seaport/post_seaport" name="submitChange" class="btn btn-primary form_change_submit me-3 ">Xác nhận</button>
        <button type="button" class="btn btn-danger form_change_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- The Modal  xóa-->
<div class="modal seaport_delete mt-5 fade">
  <div class="modal-dialog modal_delete modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Xóa cảng</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_delete_seaport">
          <table class="fs-4 table_delete_seaport d-flex justify-content-center">
          <tr >
                <td >
                  Mã cảng:
                </td>
                <td >
                  <input type="text" name="seaportDeleteId" class="seaport_delete_id rounded-2 " readonly>
                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td>
                  Tên cảng:
                </td>
                <td>
                  <input type="text" name="seaportDeleteName" class="seaport_delete_name rounded-2 "readonly >
                </td>
            </tr>
            <tr >
                <td>Quốc gia:</td>
                <td>
                  <input type="text" name="seaportDeleteNation" class="seaport_delete_nation rounded-2 "  readonly/>
                </td>
            </tr>
            <tr >
                <td>Trạng thái:</td>
                <td>
                  <input type="radio" class="me-2" id="seaportDeleteState_1" name="seaportDeleteState" value="1" disabled><label class="me-2" for="seaportDeleteState_1">Trống</label>
                  <input type="radio" class="me-2" id="seaportDeleteState_2" name="seaportDeleteState" value="0" disabled><label class="me-2" for="seaportDeleteState_2">Đầy</label>
              </td>
            <tr >
                <td>Thể tích tối đa:</td>
                <td>
                  <input type="text" name="seaportDeleteMaxVolume" class="seaport_delete_max_volume rounded-2 w-75" readonly>
              </td>
            </tr>
            <tr >
                <td>Thể tích hiện chứa:</td>
                <td>
                  <input type="text" name="seaportDeleteCurrentVolume" class="seaport_delete_curent_volume rounded-2 w-75" readonly>
              </td>
            </tr>
          </table>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" data-api-link="<?php echo __WEB_ROOT ?>admin/seaport/post_seaport" name="submitDelete" class="btn btn-primary form_delete_submit me-3 ">Xác nhận</button>
        <button type="button" class="btn btn-danger form_delete_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script src="<?php echo __WEB_ROOT ?>public/assets/admin/js/SeaportScript.js"></script>