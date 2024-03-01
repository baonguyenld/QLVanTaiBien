<link rel="stylesheet" type="text/css" href="<?php echo __WEB_ROOT ?>public/assets/admin/css/admin_Container.css">
<div class="scroll  container" id="container" data-container="<?php echo __WEB_ROOT ?>/admin/Container/getListContainerId" style="width:85.5%">
    <div class="container_option ms-5 mt-5 d-flex flex-row align-items-end">
        <button data-api-link="<?php echo __WEB_ROOT ?>admin/container/post_container" class="container_option_add me-3 container_insert  rounded-4 " data-bs-toggle="modal" data-bs-target=".container_add">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-plus-circle option_img mt-1" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>
            <div class ="option_content fw-normal mt-2 fs-5" >Tạo mới</div>
        </button>
        <button class="container_option_report me-3 rounded-4" data-bs-toggle="modal" data-bs-target=".container_report">
            <img src="<?php echo __WEB_ROOT ?>public/assets/admin/images/reporticon.png"  class ="choice_img mt-1">
            <div class ="option_content fw-normal  fs-5 mt-1" >Thống kê</div>
        </button>
    </div>
    <div class=" container_search ms-5 mt-4">
    <table>
        <tr>
          <td>
          <input type="text" <?php  if(isset($_GET['search'])) {echo "value='".$_GET['search']."'";}  ?> name="input-search" class="search_container rounded-4 ps-3" id="search_container" placeholder=<?php echo (isset($_GET['search'])&&strlen($_GET['search'])!=0) ? "" : "Nhập&nbsp;mã&nbsp;container" ?>>
            <img src="../image/search-interface-symbol 1.png" class="search_img " alt="">
            <input type="submit" data-api-link="<?php echo __WEB_ROOT ?>admin/container/post_container" class="submit_Search_container rounded-4 ms-3 " name="searchSubmit" id="searchSubmit" value="Tìm kiếm">
          </td>
        </tr>
        <tr>
          <td>
            <div class="suggestionsContainerSearch" hidden id="suggestionsContainerSearch"> </div>
          </td>
        </tr>
      </table>
    </div>
    <div class=" container_view mt-3 ms-5 mb-0">
        <table class="table table-hover table-striped table-bcontainerless rounded-3 mb-0 " style="table-layout: fixed">
        <thead>
            <tr class="bcontainer-bottom bcontainer-dark">
                <th colspan="6" class="text-center fs-2 fw-normal rounded-top-4 ">Quản lý container</th>
            </tr>
            <tr >
                <th class="text-center " style="width:150px  " >Mã</th>
                <th class="text-center" style="width:200px " >Loại</th>
                <th class="text-center"  style="width:200px ">Thể tích tối đa</th>
                <th class="text-center"  style="width:250px ">Thể tích hiện chứa</th>
                <th class="text-center" style="width:200px ">Trọng lượng hiện tại</th>
                <th class="text-center" style="width:200px ">Thao tác</th>
            </tr>
        </thead>
        <tbody id="search-data">
        <?php
        $fillterArray =$containerList;
        if(isset($_GET['search']))
        {
          $fillterArray=[];
          $inputSearch= $_GET['search'];
          foreach ($containerList as $key => $value) {
            if(strpos($value['macontainer'], $inputSearch) !== false)
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
                  <td class='text-center text-truncate' data-name='macontainer-".$fillterArray[$i]['macontainer']."' >".$fillterArray[$i]['macontainer']."</td>
                  <td class='text-center text-truncate' data-name='tenloai-".$fillterArray[$i]['macontainer']."'>".$fillterArray[$i]['tenloai']." feet</td>
                  <td class='text-center text-truncate' data-name='thetichtoida-".$fillterArray[$i]['macontainer']."'>".$fillterArray[$i]['thetichtoida']." CBM</td>
                  <td class='text-center text-truncate' data-name='thetichhienchua-".$fillterArray[$i]['macontainer']."'>".$fillterArray[$i]['thetichhienchua']." CBM</td>
                  <td class='text-center text-truncate' data-name='trongluonghientai-".$fillterArray[$i]['macontainer']."'>".$fillterArray[$i]['trongluonghientai']." kg</td>
                  <td class='text-center text-truncate' >                                                                                           
                    <button class='border-0 btn_change' data-change-id='".$fillterArray[$i]['macontainer']."' data-api-link='".__WEB_ROOT."admin/container/post_container"."' data-api-link='".__WEB_ROOT."admin/contract/post_contract"."' data-bs-toggle='modal' data-bs-target='.container_change'><img src='".__WEB_ROOT."public/assets/admin/images/pencil_2280532 1.png"."'/></button>
                    <button class='border-0 btn_delete' data-delete-id='".$fillterArray[$i]['macontainer']."' data-api-link='".__WEB_ROOT."admin/container/post_container"."'  data-bs-toggle='modal' data-bs-target='.container_delete'> <img src='".__WEB_ROOT."public/assets/admin/images/close.png"."'/></button>
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
<div class="modal container_add mt-5 fade">
  <div class="modal-dialog modal_add modal-lg modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Tạo mới container</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_add_container">
          <table class="fs-4 table_add_container d-flex justify-content-center">
            <tr >
                <td >Loại container:</td>
                <td style="width:250px">
                  <select name="containerAddType" id="containerAddType" class="container_add_type rounded-2 w-100">
                  </select>
                </td>
                <td ></td>
            </tr>
            <tr >
                <td>
                  Thể tích tối đa:
                </td>
                <td>
                  <input type="text" name="containerAddMaxVolume" class="container_add_max_volume rounded-2 w-75 " disabled>CBM
                </td>
            </tr>
            <tr >
                <td>Thể tích hiện chứa:</td>
                <td>
                  <input type="number" name="containerAddCurrentVolume" class="container_add_current_volume rounded-2 w-75" >CBM
              </td>
            </tr>
            <tr >
                <td>Trọng lượng:</td>
                <td>
                  <input type="text" name="containerAddQuantity" class="container_add_quantity rounded-2 w-50" readonly>
                  <button type="button" data-api-link="<?php echo __WEB_ROOT ?>admin/container/post_container" id="assign-add-cargo" name="confirm" class="btn btn-secondary form_add_quantity ms-1 mb-2 w-25" data-bs-toggle="modal" data-bs-target=".container_add_cargo">...</button>
                </td>
                <td >
                  
                </td>
            </tr>
            <tr class="d-none column_error_add_container">
                <td colspan="2">
                      <p style="color: red; font-style: italic" id="error_add_container"></p>
              </td>
            </tr>
          </table>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" data-api-link="<?php echo __WEB_ROOT ?>admin/container/post_container" name="submitAdd" class="btn btn-primary form_add_submit me-3 " >Xác nhận</button>
        <button type="button" id="btn_close_add_container" name="cancelAdd" class="btn btn-danger form_add_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- The Modal  tiêu chí báo cáo-->
<div class="modal container_report mt-5 fade">
  <div class="modal-dialog modal-lg  modal-dialog-centered  ">
    <div class="modal-content ">
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <h4 class="modal-title fw-bold mx-auto">Thống kê container</h4>
        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
      <form action="" class="form_report_container">
          <table class="fs-4 table_report_container d-flex justify-content-center">
            <tr >
                <td style="width:200px">Loại container:</td>
                <td style="width:250px">
                  <select  class="container_add_type rounded-2 w-100">
                  </select>
                </td>
                <td ></td>
            </tr>
            
          </table>

      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" name="submitReport" class="btn btn-primary form_report_submit me-3 " data-bs-toggle="modal" data-bs-target=".container_export">Xác nhận</button>
        <button type="button" name="cancelReport" class="btn btn-danger form_report_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- The Modal  xuất bảng báo cáo-->
<div class="modal container_export mt-5 fade">
  <div class="modal-dialog modal-lg  modal-dialog-centered  ">
    <div class="modal-content ">
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <h4 class="modal-title fw-bold mx-auto">Bảng thống kê</h4>
        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
      <table class="  fs-4 table_export_container w-100 h-75">
          <tr style="height:50px">
            <td  class="w-25 h-25">
              Loại container:
            </td>
              <td class="w-75">
                <input type="text" name="container_export_type"  class="container_export_type rounded-2  border-0" disabled>
              </td>
          </tr>
          <tr style="height:50px">
            <td  class="w-25">
              SL container:
            </td>
              <td class="w-75">
                <input type="text" name="container_export_count_container"  class="container_export_count_container rounded-2  border-0" disabled>
              </td>
          </tr>
          <tr style="height:50px">
            <td  class="w-25">
              Tổng trọng lượng:
            </td>
              <td class="w-75">
                <input type="text" name="container_export_quantity_container"  class="container_export_quantity_container rounded-2  border-0" disabled>
              </td>
          </tr>
      </table>
      <div class="overflow-scroll structure" style="height:400px">
      <table class="table table-bcontainered  table-striped fs-4 table_export_container w-100 " >
        <thead class="thead-light text-light">
          <tr>
          <th class="text-center  bg-dark text-light" style="width:150px">Mã</th>
          <th class="text-center  bg-dark text-light" >Thể tích hiện chứa </th>
          <th class="text-center  bg-dark text-light"  >Thể tích tối đa</th>
          <th class="text-center  bg-dark text-light"  style="width:200px">trọng lượng</th>
          </tr>
        </thead>
        <tbody>
          <td class="text-center  " style="width:150px">Mã</td>
          <td class="text-center  " >Thể tích hiện chứa </td>
          <td class="text-center  "  >Thể tích tối đa</td>
          <td class="text-center  "  style="width:200px">trọng lượng</td>

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
<div class="modal container_change mt-5 fade">
  <div class="modal-dialog modal_change modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Cập nhật container</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_change_container">
          <table class="fs-4 table_change_container d-flex justify-content-center">
          <tr >
                <td >
                  Mã container:
                </td>
                <td >
                  <input type="text" name="containerChangeId"  class="container_change_id rounded-2 "readonly>

                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td style="width:200px">Loại container:</td>
                <td style="width:250px">
                  <select name="containerChangeType" id="containerChangeType" class="container_change_type rounded-2 w-100">
                  </select>
                </td>
                <td ></td>
            </tr>
            <tr >
                <td>
                  Thể tích tối đa:
                </td>
                <td>
                  <input type="text" id="containerChangeMaxVolume" name="containerChangeMaxVolume" class="container_change_max_volume rounded-2 w-75" disabled>CBM
                </td>
            </tr>
            <tr >
                <td>Thể tích hiện chứa:</td>
                <td>
                  <input type="number" name="containerChangeCurrentVolume" class="container_change_current_volume rounded-2 w-75" >CBM
              </td>
            </tr>
            <tr >
                <td>Trọng lượng:</td>
                <td>
                  <input type="text" name="containerChangeWeight" class="container_change_quantity rounded-2 w-50" readonly>
                  <button type="button" data-api-link="<?php echo __WEB_ROOT ?>admin/container/post_container" id="assign-cargo" name="confirm" class="btn btn-secondary form_change_quantity ms-1 mb-2 w-25" data-bs-toggle="modal" data-bs-target=".container_change_cargo">...</button>
                </td>
                <td >
                  
                </td>
            </tr>
            <tr class="d-none column_error_change_container">
                <td colspan="2">
                      <p style="color: red; font-style: italic" id="error_change_container"></p>
              </td>
            </tr>
          </table>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" data-api-link="<?php echo __WEB_ROOT ?>admin/container/post_container" name="submitChange" class="btn btn-primary form_change_submit me-3 ">Xác nhận</button>
        <button type="button" id="btn_close_change_container" name="cancelChange" class="btn btn-danger form_change_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- The Modal  xóa-->
<div class="modal container_delete mt-5 fade">
  <div class="modal-dialog modal_delete modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Xóa container</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_delete_container">
          <table class="fs-4 table_delete_container d-flex justify-content-center">
          <tr >
                <td >
                  Mã container:
                </td>
                <td >
                  <input type="text" name="containerDeleteId"  class="container_delete_id rounded-2 "readonly>

                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td >
                  Loại container:
                </td>
                <td >
                  <input type="text" name="containerDeleteType" list="list_delete_type" class="container_delete_type rounded-2" readonly>

                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td>
                  Thể tích tối đa:
                </td>
                <td>
                  <input type="text" name="containerDeleteMaxVolume" class="container_delete_max_volume rounded-2 w-75" readonly>
                </td>
            </tr>
            <tr >
                <td>Thể tích hiện chứa:</td>
                <td>
                  <input type="text" name="containerDeleteCurrentVolume" class="container_delete_current_volume rounded-2 w-75" readonly>
              </td>
            </tr>
            <tr >
                <td>Trọng lượng:</td>
                <td>
                  <input type="text" name="containerDeleteQuantity" class="container_delete_quantity rounded-2 w-50" readonly>
                  <button type="button" data-api-link="<?php echo __WEB_ROOT ?>admin/container/post_container" id="assign-delete-cargo" name="assign-delete-cargo" class="btn btn-secondary form_add_quantity ms-1 mb-2 w-25" data-bs-toggle="modal" data-bs-target=".container_delete_cargo">...</button>
                </td>
                <td >
                  
                </td>
            </tr>
          </table>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" data-api-link="<?php echo __WEB_ROOT ?>admin/container/post_container" name="submitDelete" class="btn btn-primary form_delete_submit me-3 ">Xác nhận</button>
        <button type="button" class="btn btn-danger form_delete_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- The Modal  thêm container-->
<div class="modal container_add_cargo mt-5 fade">
  <div class="modal-dialog modal_add_container modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Chọn hàng hóa</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_add_container_container">
          <div class="overflow-scroll structure" style="height:400px">
            <table class="table table-bcontainered  table-striped fs-4 table_add_container_container w-100 " >
              <thead class="thead-light text-light">
                <tr>
                  <th class="text-center  bg-dark text-light" >Mã hàng hóa</th>
                  <th class="text-center  bg-dark text-light" >Nhóm hàng</th>
                  <th class="text-center  bg-dark text-light" >Trọng lượng</th>
                  <th class="text-center  bg-dark text-light" ></th>
                </tr>
              </thead>
              <tbody id="cargo-add-data">

              </tbody>
            </table>
          </div>

      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" data-api-link="<?php echo __WEB_ROOT ?>admin/container/post_container" name="confirmAddCargo" class="btn btn-primary form_add_container_submit me-3 " data-bs-toggle="modal" data-bs-target=".container_add">Xác nhận</button>
        <button type="button" class="btn btn-danger form_add_container_close ms-3 " data-bs-toggle="modal" data-bs-target=".container_add">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- The Modal  thay đổi container-->
<div class="modal container_change_cargo mt-5 fade">
  <div class="modal-dialog modal_change_cargo modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Chọn hàng hóa</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_change_container_cargo">
          <div class="overflow-scroll structure" style="height:400px">
            <table class="table table-bordered  table-striped fs-4 table_change_container_cargo w-100 " >
            <thead class="thead-light text-light">
                <tr>
                  <th class="text-center  bg-dark text-light" >Mã hàng hóa</th>
                  <th class="text-center  bg-dark text-light" >Nhóm hàng</th>
                  <th class="text-center  bg-dark text-light" >Trọng lượng</th>
                  <th class="text-center  bg-dark text-light" ></th>
                </tr>
              </thead>
              <tbody id="cargo-change-data">
              <tr>
                  
              </tr>
              </tbody>
            </table>
          </div>

      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" name="confirmChangeCargo" class="btn btn-primary form_change_container_submit me-3 " data-bs-toggle="modal" data-bs-target=".container_change">Xác nhận</button>
        <button type="button" class="btn btn-danger form_change_container_close ms-3 " data-bs-toggle="modal" data-bs-target=".container_change">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- The Modal  xóa container-->
<div class="modal container_delete_cargo mt-5 fade">
  <div class="modal-dialog modal_delete_container modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Chọn hàng hóa</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_delete_container_cargo">
          <div class="overflow-scroll structure" style="height:400px">
            <table class="table table-bordered  table-striped fs-4 table_delete_container_cargo w-100 " >
            <thead class="thead-light text-light">
                <tr>
                  <th class="text-center  bg-dark text-light" >Mã hàng hóa</th>
                  <th class="text-center  bg-dark text-light" >Nhóm hàng</th>
                  <th class="text-center  bg-dark text-light" >Trọng lượng</th>
                  <th class="text-center  bg-dark text-light" ></th>
                </tr>
              </thead>
              <tbody id="cargo-delete-data">
         
              </tbody>
            </table>
          </div>

      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" data-api-link="<?php echo __WEB_ROOT ?>admin/container/post_container" name="confirmDeleteCargo" class="btn btn-primary form_delete_container_submit me-3 " data-bs-toggle="modal" data-bs-target=".container_delete">Xác nhận</button>
        <button type="button" class="btn btn-danger form_delete_container_close ms-3 " data-bs-toggle="modal" data-bs-target=".container_delete">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- The Modal sắp xếp hàng hóa -->


<script src="<?php echo __WEB_ROOT ?>public/assets/admin/js/ContainerScript.js"></script>
