<link rel="stylesheet" type="text/css" href="<?php echo __WEB_ROOT ?>public/assets/admin/css/admin_Price.css">
<div class="  price" id="price" data-price="<?php echo __WEB_ROOT ?>/admin/Price/getListPrice" style="width:85.5%">
    <div class="price_option ms-5 mt-5 d-flex flex-row align-items-end">
        <button class="price_option_add me-3  rounded-4 " data-bs-toggle="modal" data-bs-target=".price_add">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-plus-circle option_img mt-1" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>
            <div class ="option_content fw-normal mt-2 fs-5" >Tạo mới</div>
        </button>
        <button class="price_option_report me-3 rounded-4" data-bs-toggle="modal" data-bs-target=".price_report">
            <img src="<?php echo __WEB_ROOT ?>public/assets/admin/images/reporticon.png"  class ="choice_img mt-1">
            <div class ="option_content fw-normal  fs-5 mt-1" >Thống kê</div>
        </button>
    </div>
    <div class=" price_search ms-5 mt-4">
    <table>
        <tr>
          <td>
            <input type="text" <?php  if(isset($_GET['search'])) {echo "value='".$_GET['search']."'";}  ?> class="search_price rounded-4 ps-3" id="search_price" placeholder=<?php echo (isset($_GET['search'])&&strlen($_GET['search'])!=0) ? "" : "Nhập&nbsp;mã&nbsp;giá" ?>>
            <img src="../image/search-interface-symbol 1.png" class="search_img " alt="">
            <input type="submit" class="submit_Search_price rounded-4 ms-3 " name="searchSubmit" id="searchSubmit" value="Tìm kiếm">
          </td>
        </tr>
        <tr>
          <td>
            <div class="suggestionsPriceSearch" hidden id="suggestionsPriceSearch"> </div>
          </td>
        </tr>
      </table>
    </div>
    <div class=" price_view mt-3 ms-5 mb-0">
        <table class="table table-hover table-striped table-borderless rounded-3 mb-0 " style="table-layout: fixed">
        <thead>
            <tr class="border-bottom border-dark">
                <th colspan="6" class="text-center fs-2 fw-normal rounded-top-4 ">Quản lý bảng giá</th>
            </tr>
            <tr >
                <th class="text-center " style="width:150px  " >Mã giá</th>
                <th class="text-center"  style="width:200px ">Loại container</th>
                <th class="text-center"  style="width:250px ">Nhóm hàng</th>
                <th class="text-center" style="width:200px ">Khoảng cách</th>
                <th class="text-center" style="width:200px " >Giá </th>
                <th class="text-center" style="width:200px ">Thao tác</th>
            </tr>
        </thead>
        <tbody>
        <?php
             $fillterArray =$priceList;
             if(isset($_GET['search']))
             {
               $fillterArray=[];
               $inputSearch= $_GET['search'];
               foreach ($priceList as $key => $value) {
                 if(strpos($value['mabanggia'], $inputSearch) !== false)
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
                  <td class='text-center text-truncate' >".$fillterArray[$i]['mabanggia']."</td>
                  <td class='text-center text-truncate' >".$fillterArray[$i]['tenloai']." feet</td>
                  <td class='text-center text-truncate' >".$fillterArray[$i]['tennhomhang']."</td>
                  <td class='text-center text-truncate' >".$fillterArray[$i]['khoangcach']."</td>
                  <td class='text-center text-truncate' >".$fillterArray[$i]['gia']." USD</td>
                  <td class='text-center text-truncate' >                                                                                           
                    <button class='border-0 btn_change' data-change-id='".$fillterArray[$i]['mabanggia']."' data-api-link='".__WEB_ROOT."admin/price/post_price"."' data-bs-toggle='modal' data-bs-target='.price_change'><img src='".__WEB_ROOT."public/assets/admin/images/pencil_2280532 1.png"."'/></button>
                    <button class='border-0 btn_delete' data-delete-id='".$fillterArray[$i]['mabanggia']."' data-api-link='".__WEB_ROOT."admin/price/post_price"."'  data-bs-toggle='modal' data-bs-target='.price_delete'> <img src='".__WEB_ROOT."public/assets/admin/images/close.png"."'/></button>
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
<div class="modal price_add mt-5 fade">
  <div class="modal-dialog modal_add modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <!-- Thay thành cảng -->
        <div class="modal-title fw-bold mx-auto">Tạo mới giá</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_add_price">
          <table class="fs-4 table_add_price d-flex justify-content-center">
           
            <tr >
              <!-- Thay mới -->
                <td >Mã loại:</td>
                <td style="width:250px">
                  <!-- Đổi thành select option -->
                  <select name="priceAddTypeContainer" id="priceAddTypeContainer" class="price_add_type_container rounded-2 w-100" >
                  <?php
                      foreach($listLoaiContainer as $loaiContainer)
                      {
                        echo "<option value='".$loaiContainer['maloaicontainer']."'>".$loaiContainer['tenloai']." feet</option>";
                      }
                    ?>
                  </select>
                </td>
                <td ></td>
              <!-- Thay mới -->
            </tr>
            <tr >
                <td >Mã nhóm hàng:</td>
                <td style="width:250px">
                  <!-- Đổi thành select option -->
                  <select name="priceAddTypeCargo" id="priceAddTypeCargo" class="price_add_type_cargo    rounded-2 w-100" >
                    <?php
                      foreach($listNhomHang as $nhomhang)
                      {
                        echo "<option value='".$nhomhang['manhomhang']."'>".$nhomhang['tennhomhang']."</option>";
                      }
                    ?>
              
                  </select>
                </td>
                <td ></td>
            </tr>
            <tr>
              <td>Khoảng cách:</td>
              <td>
               <select name="priceAddSeaportA" id="priceAddSeaportA"  class="price_add_type_container rounded-2 w-100" >
                  <?php
                      foreach($listCang as $cang)
                      {
                        echo "<option value='".$cang['macang']."'>".$cang['macang']."</option>";
                      }
                    ?>
                  </select>
              </td>
            </tr>
            <tr >
              <td></td>
                <td>
                <select id="priceAddSeaportB" name="priceAddSeaportB"  class="price_add_type_container rounded-2 w-100" >
                  <?php
                      foreach($listCang as $cang)
                      {
                        echo "<option value='".$cang['macang']."'>".$cang['macang']."</option>";
                      }
                    ?>
                  </select>
              </td>
            </tr>
            <tr >
                <td>
                  Giá:
                </td>
                <td>
                  <input type="text" id="priceAddValue" name="priceAddValue" class="price_add_Value rounded-2" >
                </td>
            </tr>
          </table>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" data-api-link="<?php echo __WEB_ROOT ?>admin/price/post_price" id="submitAddPrice" name="submitAdd" class="btn btn-primary form_add_submit me-3 ">Xác nhận</button>
        <button type="button" class="btn btn-danger form_add_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- The Modal  tiêu chí báo cáo-->
<div class="modal price_report mt-5 fade">
  <div class="modal-dialog modal-lg  modal-dialog-centered  ">
    <div class="modal-content ">
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <!-- Thay thành cảng -->
        <h4 class="modal-title fw-bold mx-auto">Thống kê bảng giá</h4>
        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
      <form action="" class="form_report_price">
          <table class="fs-4 table_report_price d-flex justify-content-center">
          <tr >
              <!-- Thay mới -->
              <td style="width:200px">Mã loại:</td>
                <td style="width:250px">
                  <!-- Đổi thành select option -->
                  <select name="priceReportTypeContainer" id="priceReportTypeContainer" class="price_report_type_container rounded-2  w-100" >
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                </td>
                <td ></td>
              <!-- Thay mới -->
            </tr>
            <tr >
            <td style="width:200px">Nhóm hàng:</td>
                <td style="width:250px">
                  <!-- Đổi thành select option -->
                  <select name="priceReportTypeCargo" id="priceReportTypeCargo" class="price_report_Type_cargo rounded-2  w-100" >
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                </td>
                <td ></td>
          </table>

      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" name="submitReport" class="btn btn-primary form_report_submit me-3 " data-bs-toggle="modal" data-bs-target=".price_export">Xác nhận</button>
        <button type="button" class="btn btn-danger form_report_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- The Modal  xuất bảng báo cáo-->
<div class="modal price_export mt-5 fade">
  <div class="modal-dialog modal-xl  modal-dialog-centered  ">
    <div class="modal-content ">
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <h4 class="modal-title fw-bold mx-auto">Bảng thống kê</h4>
        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
      <table class="  fs-4 table_export_price w-100 h-75">
          <tr style="height:50px">
            <td class="w-25">
              Mã loại:
            </td>
            <td class="w-75">
                <input type="text" name="price_export_type_container" class="border-0 w-25"  disabled/>
            </td>
          </tr>
          <tr>
            <td  class="w-25">
              Nhóm hàng:
            </td>
              <td class="w-75">
                <input type="text" name="price_export_type_cargo"  class="price_export_state rounded-2  border-0" disabled>
              </td>
          </tr>
          <tr>
            <td  class="w-25">
              SL giá:
            </td>
              <td class="w-75">
                <input type="text" name="price_export_count"  class="price_export_count rounded-2  border-0" disabled>
              </td>
          </tr>
      </table>
      <div class="overflow-scroll structure" style="height:400px">
      <table class="table table-bordered  table-striped fs-4 table_export_price w-100 " >
        <thead class="thead-light text-light">
          <tr>
          <th class="text-center  bg-dark text-light" style="width:250px">Mã giá</td>
          <th class="text-center  bg-dark text-light" style="width:250px">Giá</td>
          <th class="text-center  bg-dark text-light"  style="width:250px">Mã loại</td>
          <th class="text-center  bg-dark text-light"  style="width:250px">Mã nhóm hàng</td>
          <th class="text-center  bg-dark text-light"  style="width:250px">Khoảng cách</td>
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
<div class="modal price_change mt-5 fade">
  <div class="modal-dialog modal_change modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Cập nhật giá</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_change_price">
          <table class="fs-4 table_change_price d-flex justify-content-center">
          <tr >
                <td >
                  Mã giá:
                </td>
                <td >
                  <input type="text" id="priceChangeId" name="priceChangeId" class="price_change_id rounded-2 " readonly>
                </td>
                <td >
                </td>
            </tr>

            <tr >
              <td style="width:200px">Mã loại:</td>
                <td style="width:250px">
                  <select name="priceChangeTypeContainer" id="priceChangeTypeContainer"  class="price_change_type_container rounded-2 w-100" >
                  <?php
                      foreach($listLoaiContainer as $loaiContainer)
                      {
                        echo "<option value='".$loaiContainer['maloaicontainer']."'>".$loaiContainer['tenloai']." feet</option>";
                      }
                    ?>
                  </select>
                  </select>
                </td>
                <td ></td>
            </tr>
            <tr >
            <td style="width:200px">Mã nhóm hàng:</td>
                <td style="width:250px">
                  <select name="priceChangeTypeCargo" id="priceChangeTypeCargo"  class="price_change_type_cargo rounded-2 w-100" >
                  <?php
                      foreach($listNhomHang as $nhomhang)
                      {
                        echo "<option value='".$nhomhang['manhomhang']."'>".$nhomhang['tennhomhang']."</option>";
                      }
                    ?>
                  </select>
                </td>
                <td ></td>
            <tr>
              <td>Khoảng cách:</td>
              <td>
               <select name="pricechangeSeaportA" id="pricechangeSeaportA"  class="price_change_type_container rounded-2 w-100" >
                  <?php
                      foreach($listCang as $cang)
                      {
                        echo "<option value='".$cang['macang']."'>".$cang['macang']."</option>";
                      }
                    ?>
                  </select>
              </td>
            </tr>
            <tr >
              <td></td>
                <td>
                <select id="pricechangeSeaportB" name="pricechangeSeaportB"  class="price_change_type_container rounded-2 w-100" >
                  <?php
                      foreach($listCang as $cang)
                      {
                        echo "<option value='".$cang['macang']."'>".$cang['macang']."</option>";
                      }
                    ?>
                  </select>
              </td>
            </tr>
            <tr >
                <td>
                  Giá:
                </td>
                <td>
                  <input type="text" id="priceChangeValue" name="priceChangeValue" class="price_change_value rounded-2" >
                </td>
            </tr>
          </table>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" data-api-link="<?php echo __WEB_ROOT ?>admin/price/post_price" id="submitChangePrice" name="submitChange" class="btn btn-primary form_change_submit me-3 ">Xác nhận</button>
        <button type="button" class="btn btn-danger form_change_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- The Modal  xóa-->
<div class="modal price_delete mt-5 fade">
  <div class="modal-dialog modal_delete modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <!-- Thay đổi thành cảng -->
        <div class="modal-title fw-bold mx-auto">Xóa giá</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_delete_price">
          <table class="fs-4 table_delete_price d-flex justify-content-center">
          <tr >
                <td >
                  Mã giá:
                </td>
                <td >
                  <input type="text" id="priceDeleteId" name="priceDeleteId" class="price_delete_id rounded-2" readonly>
                </td>
                <td >
                </td>
            </tr>

            <tr >
                <td>Mã loại:</td>
                <td>
                  <input type="text" id="priceDeleteTypeContainer" name="priceDeleteTypeContainer" class="price_delete_type_container rounded-2 "  readonly/>
                </td>
            </tr>
            <tr >
                <td>Mã nhóm hàng:</td>
                <td>
                    <input type="text" id="priceDeleteTypeCargo" name="priceDeleteTypeCargo" class="price_delete_type_cargo rounded-2 "  readonly/>
              </td>
            <tr >
                <td>Khoảng cách:</td>
                <td>
                  <input type="text" id="priceDeleteRange" name="priceDeleteRange" class="price_delete_range rounded-2" readonly>
              </td>
            </tr>
            <tr >
                <td>
                  Giá:
                </td>
                <td>
                  <input type="text" id="priceDeleteValue" name="priceDeleteValue" class="price_delete_value rounded-2"readonly >
                </td>
            </tr>
          </table>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" data-api-link="<?php echo __WEB_ROOT ?>admin/price/post_price" id="submitDeletePrice" name="submitDelete" class="btn btn-primary form_delete_submit me-3 ">Xác nhận</button>
        <button type="button" class="btn btn-danger form_delete_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script src="<?php echo __WEB_ROOT ?>public/assets/admin/js/PriceScript.js"></script>