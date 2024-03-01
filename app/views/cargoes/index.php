<link rel="stylesheet" type="text/css" href="<?php echo __WEB_ROOT ?>public/assets/admin/css/admin_Cargo.css">
<div class="scroll  cargo" id="cargo" data-cargo="<?php echo __WEB_ROOT ?>/admin/Cargo/getListCargo" style="width:85.5%">
    <div class="cargo_option ms-5 mt-5 d-flex flex-row align-items-end">
        <button class="cargo_option_add me-3 cargo_insert rounded-4" data-contract="<?php echo __WEB_ROOT ?>/admin/Contract/getListContract" data-api-link="<?php echo __WEB_ROOT ?>admin/cargo/post_cargo" data-bs-toggle="modal" data-bs-target=".cargo_add">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-plus-circle option_img mt-1" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>
            <div class ="option_content fw-normal mt-2 fs-5" >Tạo mới</div>
        </button>
        <button class="cargo_option_report me-3  rounded-4" data-api-link="<?php echo __WEB_ROOT ?>admin/cargo/post_cargo" data-bs-toggle="modal" data-bs-target=".cargo_report">
            <img src="<?php echo __WEB_ROOT ?>public/assets/admin/images/reporticon.png"  class ="choice_img mt-1">
            <div class ="option_content fw-normal  fs-5 mt-1" >Thống kê</div>
        </button>
    </div>
    <div class=" cargo_search ms-5 mt-4">
    <table>
        <tr>
          <td>
          <input type="text" <?php  if(isset($_GET['search'])) {echo "value='".$_GET['search']."'";}  ?> name="input-search" class="search_cargo rounded-4 ps-3" id="search_cargo" placeholder=<?php echo (isset($_GET['search'])&&strlen($_GET['search'])!=0) ? "" : "Nhập&nbsp;mã&nbsp;hàng&nbsp;hóa" ?>>
            <img src="../image/search-interface-symbol 1.png" class="search_img " alt="">
            <input type="submit" data-api-link="<?php echo __WEB_ROOT ?>admin/cargo/post_cargo" class="submit_Search_cargo rounded-4 ms-3 " name="searchSubmit" value="Tìm kiếm">
          </td>
        </tr>
        <tr>
          <td>
            <div class="suggestionsCargoSearch" hidden id="suggestionsCargoSearch"> </div>
          </td>
        </tr>
      </table>

    </div>
    <div class=" cargo_view mt-3 ms-5 mb-0">
        <table class="table table-hover table-striped table-borderless rounded-3 mb-0 " style="table-layout: fixed">
        <thead>
            <tr class="border-bottom border-dark">
                <th colspan="5" class="text-center fs-2 fw-normal rounded-top-4 ">Quản lý hàng hóa</th>
            </tr>
            <tr >
                <th class="text-center " style="width:150px  " >Mã hàng hóa</th>
                <th class="text-center" >Tên hàng hóa</th>
                <th class="text-center"  style="width:200px ">Nhóm hàng hóa</th>
                <th class="text-center"  style="width:250px ">Mã hợp đồng</th>
                <th class="text-center"  style="width:250px ">Trọng lượng</th>
                <th class="text-center" style="width:200px ">Thao tác</th>
            </tr>
        </thead>
        <tbody id="search-data">
        <?php
         $fillterArray =$cargoList;
         if(isset($_GET['search']))
         {
          $fillterArray=[];
          $inputSearch= $_GET['search'];
          foreach ($cargoList as $key => $value) {
             if(strpos($value['mahanghoa'], $inputSearch) !== false)
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
                  <td class='text-center text-truncate' data-name='mahanghoa-".$fillterArray[$i]['mahanghoa']."'>".$fillterArray[$i]['mahanghoa']."</td>
                  <td class='text-center text-truncate' data-name='tenhanghoa-".$fillterArray[$i]['mahanghoa']."'>".$fillterArray[$i]['tenhanghoa']."</td>
                  <td class='text-center text-truncate' data-name='tennhomhang-".$fillterArray[$i]['mahanghoa']."'>".$fillterArray[$i]['tennhomhang']."</td>
                  <td class='text-center text-truncate' data-name='mahopdong-".$fillterArray[$i]['mahopdong']."'>".$fillterArray[$i]['mahopdong']."</td>
                  <td class='text-center text-truncate' data-name='trongluong-".$fillterArray[$i]['mahanghoa']."'>".$fillterArray[$i]['trongluong']." kg</td>
                  <td class='text-center text-truncate' >                                                                                           
                    <button class='border-0 btn_change' data-change-id='".$fillterArray[$i]['mahanghoa']."' data-api-link='".__WEB_ROOT."admin/cargo/post_cargo"."' data-bs-toggle='modal' data-bs-target='.cargo_change'><img src='".__WEB_ROOT."public/assets/admin/images/pencil_2280532 1.png"."'/></button>
                    <button class='border-0 btn_delete' data-delete-id='".$fillterArray[$i]['mahanghoa']."' data-api-link='".__WEB_ROOT."admin/cargo/post_cargo"."' data-bs-toggle='modal' data-bs-target='.cargo_delete'> <img src='".__WEB_ROOT."public/assets/admin/images/close.png"."'/></button>
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
<div class="modal cargo_add mt-5 fade">
  <div class="modal-dialog modal_add modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Tạo mới hàng hóa</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_add_cargo">
          <table class=" ms-5 me-3 mt-3 fs-4 table_add_cargo">
            <tr >
                <td>
                  Mã hợp đồng:
                </td>
                <td>
                  <input type="text" name="cargoAddContract" id="cargoAddContract" class="cargo_add_name rounded-2 " >
                  <div class="suggestionsCargoAddContract" hidden   id="suggestionsCargoAddContract">
                </td>
            </tr>
            <tr >
                <td>
                  Tên hàng hóa:
                </td>
                <td>
                  <input type="text" name="cargoAddName" class="cargo_add_name rounded-2 " >
                </td>
            </tr>
            <tr >
                <td >Nhóm hàng hóa:</td>
                <td style="width:250px">
                  <select name="cargoAddType" id="cargoAddType" class="cargo_add_type  rounded-2  w-100 ">
                  </select>
                </td>
                <td ></td>
            </tr>
            <tr >
                <td>Trọng lượng:</td>
                <td>
                  <input type="text" name="cargoAddWeight" class="cargo_add_weight rounded-2" >
              </td>
            </tr>

          </table>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" data-api-link="<?php echo __WEB_ROOT ?>admin/cargo/post_cargo" name="submitAdd" class="btn btn-primary form_add_submit me-3 ">Xác nhận</button>
        <button type="button" name="cancelAdd" class="btn btn-danger form_add_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- The Modal  tiêu chí báo cáo-->
<div class="modal cargo_report mt-5 fade">
  <div class="modal-dialog modal-lg  modal-dialog-centered  ">
    <div class="modal-content ">
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <h4 class="modal-title fw-bold mx-auto">Thống kê hàng hóa</h4>
        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
      <form action="" class="form_report_cargo">
          <table class="fs-4 table_report_cargo d-flex justify-content-center">
          <tr >
              <td style="width:250px">Nhóm hàng hóa:</td>
              <td style="width:250px">
                  <!-- Đổi thành select option -->
                  <select name="cargoReportType" id="cargoReportType" class="cargo_report_type  rounded-2  w-100 ">
                  </select>
              </td>
              <td ></td>
            </tr>
          </table>

      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" name="submitReport" class="btn btn-primary form_report_submit me-3 " data-bs-toggle="modal" data-bs-target=".cargo_export">Xác nhận</button>
        <button type="button" name="cancelReport" class="btn btn-danger form_report_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- The Modal  xuất bảng báo cáo-->
<div class="modal cargo_export mt-5 fade">
  <div class="modal-dialog modal-lg  modal-dialog-centered  ">
    <div class="modal-content ">
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <h4 class="modal-title fw-bold mx-auto">Bảng thống kê</h4>
        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
      <table class="  fs-4 table_export_cargo w-100 h-75">
          <<tr >
                <td>Nhóm hàng hóa:</td>
                <td>
                  <input type="text" name="cargoExportType"  list="list_export_type" class="cargo_export_type  rounded-2  w-50 border-0" disabled/>
 
                </td>
                <td >
                </td>
            </tr>
          <tr style="height:50px">
            <td  class="w-25">
              Số lượng hàng hóa:
            </td>
              <td class="w-75">
                <input type="text" name="cargo_export_count"  class="cargo_export_count rounded-2  border-0" disabled >
              </td>
          </tr>
      </table>
      <div class="overflow-scroll structure" style="height:400px">
      <table class="table table-bordered  table-striped fs-4 table_export_cargo w-100 " >
        <thead class="thead-light text-light">
          <tr>
          <th class="text-center  bg-dark text-light" style="width:250px">Mã</td>
          <th class="text-center  bg-dark text-light" style="width:250px">Tên</td>
          <th class="text-center  bg-dark text-light"  style="width:250px">Nhóm</td>
          <th class="text-center  bg-dark text-light"  style="width:250px">Trọng lượng</td>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
      </div>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="button"name="cancelExport" class="btn btn-danger form_export_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
    
    </div>
  </div>
</div>

<!-- The Modal  cập nhật-->
<div class="modal cargo_change mt-5 fade">
  <div class="modal-dialog modal_change modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Cập nhật hàng hóa</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_change_cargo">
          <table class="fs-4 table_change_cargo d-flex justify-content-center">
          <tr >
                <td >
                  Mã hàng hóa:
                </td>
                <td >
                  <input type="text" name="cargoChangeId"  class="cargo_change_id rounded-2 " readonly>
                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td>
                  Tên hàng hóa:
                </td>
                <td>
                  <input type="text" name="cargoChangeName" class="cargo_change_name rounded-2 " >
                </td>
            </tr>
            <tr >
                <td >Nhóm hàng hóa:</td>
                <td style="width:250px">
                  <select name="cargoChangeType" id="cargoChangeType" class="cargo_change_type  rounded-2  w-100 ">
                  </select>
                </td>
                <td ></td>
            </tr>
            <tr >
                <td >
                  Mã hợp đồng:
                </td>
                <td >
                  <input type="text" id="cargoChangeContract" name="cargoChangeContract"  class="cargo_change_contract rounded-2 " disabled>
                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td>Trọng lượng:</td>
                <td>
                  <input type="text" name="cargoChangeWeight" class="cargo_change_weight rounded-2" >
              </td>
            </tr>
          </table>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" name="submitChange" data-api-link="<?php echo __WEB_ROOT ?>admin/cargo/post_cargo"  class="btn btn-primary form_change_submit me-3 ">Xác nhận</button>
        <button type="button" name="cancelChange" class="btn btn-danger form_change_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- The Modal  xóa-->
<div class="modal cargo_delete mt-5 fade">
  <div class="modal-dialog modal_delete modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Xóa hàng hóa</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_delete_cargo">
          <table class="fs-4 table_delete_cargo d-flex justify-content-center">
          <tr >
                <td >
                  Mã hàng hóa:
                </td>
                <td >
                  <input type="text" name="cargoDeleteId"  class="cargo_delete_id rounded-2  " readonly>
                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td>
                  Tên hàng hóa:
                </td>
                <td>
                  <input type="text" name="cargoDeleteName" class="cargo_delete_name rounded-2 "  readonly>
                </td>
            </tr>
            <tr >
                <td>Nhóm hàng hóa:</td>
                <td>
                  <input type="text" name="cargoDeleteType"   class="cargo_delete_type  rounded-2  "  readonly/>

                </td>
                <td >

                </td>
            </tr>
            <tr >
                <td>Trọng lượng:</td>
                <td>
                  <input type="text" name="cargoDeleteWeight" class="cargo_delete_weight rounded-2 "  readonly>
              </td>
            </tr>
          </table>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" data-api-link="<?php echo __WEB_ROOT ?>admin/cargo/post_cargo" name="submitDelete" class="btn btn-primary form_delete_submit me-3 ">Xác nhận</button>
        <button type="button" name="cancelDelete" class="btn btn-danger form_delete_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script src="<?php echo __WEB_ROOT ?>public/assets/admin/js/CargoScript.js"></script>
