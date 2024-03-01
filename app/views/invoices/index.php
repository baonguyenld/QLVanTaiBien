<link rel="stylesheet" type="text/css" href="<?php echo __WEB_ROOT ?>public/assets/admin/css/admin_Invoice.css">
<div class="scroll invoice" id="invoice" data-invoice="<?php echo __WEB_ROOT ?>/admin/Invoice/getListInvoice" style="width:85.5%">
    <div class="invoice_option ms-5 mt-5 d-flex flex-row align-items-end">
        <button class="invoice_option_add me-3  rounded-4 " data-order="<?php echo __WEB_ROOT ?>/admin/Order/getListOrder" id="invoice_option_add" data-bs-toggle="modal" data-bs-target=".invoice_add">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-plus-circle option_img mt-1" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>
            <div class ="option_content fw-normal mt-2 fs-5" >Tạo mới</div>
        </button>
        <button class="invoice_option_report me-3 rounded-4" data-bs-toggle="modal" data-bs-target=".invoice_report">
            <img src="<?php echo __WEB_ROOT ?>public/assets/admin/images/reporticon.png"  class ="choice_img mt-1">
            <div class ="option_content fw-normal  fs-5 mr-1" >Thống kê</div>
        </button>
    </div>
    <div class=" invoice_search ms-5 mt-4">
    <table>
        <tr>
          <td>
          <input type="text" <?php  if(isset($_GET['search'])) {echo "value='".$_GET['search']."'";}  ?> name="input-search" class="search_invoice rounded-4 ps-3" id="search_invoice" placeholder=<?php echo (isset($_GET['search'])&&strlen($_GET['search'])!=0) ? "" : "Nhập&nbsp;mã&nbsp;hóa&nbsp;đơn" ?>>
            <img src="../image/search-interface-symbol 1.png" class="search_img " alt="">
            <input type="submit" data-api-link="<?php echo __WEB_ROOT ?>admin/invoice/post_invoice" name="searchSubmit" class="submit_Search_invoice rounded-4 ms-3 " value="Tìm kiếm">
          </td>
        </tr>
        <tr>
          <td>
            <div class="suggestionsInvoiceSearch" hidden id="suggestionsInvoiceSearch"></div>
          </td>
        </tr>
      </table>
            

    </div>
    <div class=" invoice_view mt-3 ms-5 mb-0">
        <table class="table table-hover table-striped table-borderless rounded-3 mb-0 " style="table-layout: fixed">
        <thead>
            <tr class="border-bottom border-dark">
                <th colspan="6" class="text-center fs-2 fw-normal rounded-top-4 ">Quản lý hóa đơn</th>
            </tr>
            <tr >
                <th class="text-center " style="width:150px  " >Mã hóa đơn</th>
                <th class="text-center" style="width:200px " >Mã vận đơn</th>
                <th class="text-center"  style="width:200px ">Ngày lập</th>
                <th class="text-center" style="width:200px ">Tổng tiền</th>
                <th class="text-center"  style="width:250px ">Trạng thái</th>
                <th class="text-center" style="width:200px ">Thao tác</th>
            </tr>
        </thead>
        <tbody id="search-data">
        <?php
        $fillterArray =$invoiceList;
        if(isset($_GET['search']))
        {
          $fillterArray=[];
          $inputSearch= $_GET['search'];
          foreach ($invoiceList as $key => $value) {
            if(strpos($value['mahoadon'], $inputSearch) !== false)
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
                  <td class='text-center text-truncate' >".$fillterArray[$i]['mahoadon']."</td>
                  <td class='text-center text-truncate' >".$fillterArray[$i]['mavandon']."</td>
                  <td class='text-center text-truncate' >".$fillterArray[$i]['ngaylaphoadon']."</td>
                  <td class='text-center text-truncate' >".$fillterArray[$i]['tongtien']."</td>
                  <td class='text-center text-truncate' >".($fillterArray[$i]['trangthai']?"Đã xác nhận":"Chưa xác nhận")."</td>
                  <td class='text-center text-truncate' >                                                                                           
                    <button class='border-0 btn_change' data-change-id='".$fillterArray[$i]['mahoadon']."' data-api-link='".__WEB_ROOT."admin/invoice/post_invoice"."' data-bs-toggle='modal' data-bs-target='.invoice_change'><img src='".__WEB_ROOT."public/assets/admin/images/pencil_2280532 1.png"."'/></button>
                    <button class='border-0 btn_delete' data-delete-id='".$fillterArray[$i]['mahoadon']."' data-api-link='".__WEB_ROOT."admin/invoice/post_invoice"."'  data-bs-toggle='modal' data-bs-target='.invoice_delete'> <img src='".__WEB_ROOT."public/assets/admin/images/close.png"."'/></button>
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
<div class="modal invoice_add mt-5 fade">
  <div class="modal-dialog modal_add modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Tạo mới hóa đơn</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_add_invoice">
          <table class=" fs-4 table_add_invoice d-flex justify-content-center">
            <tr >
                <td >
                  Mã vận đơn:
                </td>
                <td >
                  <input type="text" name="invoiceAddOrder" id="invoiceAddOrder" class="invoice_add_order rounded-2 w-75" autocomplete="off">
                  <div class="suggestionsInvoiceAdd" hidden   id="suggestionsInvoiceAdd">
                </td>
                <td ></td>
            </tr>
            <tr >
                <td>Thanh toán:</td>
                <td>
                  <input type="radio" class="me-2" id="invoiceAddState_1" name="invoiceAddState" value="Xác nhận" checked><label class="me-2" for="invoiceAddState_1">Xác nhận</label>
                  <input type="radio" class="me-2" id="invoiceAddState_2" name="invoiceAddState" value="Chưa xác nhận"><label class="me-2" for="invoiceAddState_2">Chưa xác nhận</label>
              </td>
            </tr>
          </table>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" data-api-link="<?php echo __WEB_ROOT ?>admin/invoice/post_invoice" name="submitAdd" class="btn btn-primary form_add_submit me-3 ">Xác nhận</button>
        <button type="button" class="btn btn-danger form_add_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- The Modal  tiêu chí báo cáo-->
<div class="modal invoice_report mt-5 fade">
  <div class="modal-dialog modal-lg  modal-dialog-centered  ">
    <div class="modal-content ">
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <h4 class="modal-title fw-bold mx-auto">Thống kê hóa đơn</h4>
        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
      <form action="" class="form_report_invoice">
          <table class=" ms-5 me-3 mt-3 fs-4 table_report_invoice w-100">
            <tr >
                <td>Ngày lập:</td>
                <td >
                  <label  >từ ngày</label>
                  <input type="date" name="invoiceReportDate_1" class="invoice_report_date_1 form-control w-25 d-inline"  />
                  <label  >đến</label>
                  <input type="date" name="invoiceReportDate_2" class="invoice_report_date_2 form-control w-25 d-inline"  /> 
                </td>
            </tr>

            <tr >
                <td>Trạng thái:</td>
                <td>
                  <input type="radio" class="me-2" id="invoiceReportState_1" name="invoiceState" value="Xác nhận" checked><label class="me-2" for="invoiceReportState_1">Xác nhận</label>
                  <input type="radio" class="me-2" id="invoiceReportState_2" name="invoiceState" value="Chưa xác nhận"><label class="me-2" for="invoiceReportState_2">Chưa xác nhận</label>
              </td>
            </tr>
          </table>

      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" name="submitReport" class="btn btn-primary form_report_submit me-3 " data-bs-toggle="modal" data-bs-target=".invoice_export">Xác nhận</button>
        <button type="button" class="btn btn-danger form_report_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- The Modal  xuất bảng báo cáo-->
<div class="modal invoice_export mt-5 fade">
  <div class="modal-dialog modal-lg  modal-dialog-centered  ">
    <div class="modal-content ">
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <h4 class="modal-title fw-bold mx-auto">Bảng thống kê</h4>
        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
      <table class="  fs-4 table_export_invoice w-100 h-75">
          <tr style="height:50px">
            <td class="w-25">
              Thời gian:
            </td>
            <td class="w-75">
                <label >từ ngày</label>
                <input type="text" name="invoice_export_date_1" class="border-0 w-25"  disabled/>
                <label >đến</label>
                <input type="text" name="invoice_export_date_2" class="border-0 w-25"  disabled/> 
            </td>
          </tr>
          <tr>
            <td  class="w-25">
              Trạng thái:
            </td>
              <td class="w-75">
                <input type="text" name="invoice_export_state"  class="invoice_export_state rounded-2  border-0" disabled>
              </td>
          </tr>
          <tr>
            <td  class="w-25">
              Tổng hóa đơn:
            </td>
              <td class="w-75">
                <input type="text" name="invoice_export_count"  class="invoice_export_count rounded-2  border-0" disabled>
              </td>
          </tr>
          <tr>
            <td  class="w-25">
              Tổng tiền:
            </td>
              <td class="w-75">
                <input type="text" name="invoice_export_money"  class="invoice_export_money rounded-2  border-0" disabled>
              </td>
          </tr>
      </table>
      <div class="overflow-scroll structure" style="height:400px">
      <table class="table table-bordered  table-striped fs-4 table_export_invoice w-100 " >
        <thead class="thead-light text-light">
          <tr>
          <th class="text-center  bg-dark text-light" style="width:250px">Mã vận đơn</td>
          <th class="text-center  bg-dark text-light" style="width:250px">Mã hóa đơn</td>
          <th class="text-center  bg-dark text-light"  style="width:250px">Ngày lập</td>
          <th class="text-center  bg-dark text-light"  style="width:250px">tổng tiền</td>
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
<div class="modal invoice_change mt-5 fade">
  <div class="modal-dialog modal_change modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Cập nhật hóa đơn</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_change_invoice">
          <table class=" fs-4 table_change_invoice d-flex justify-content-center">
            <tr >
                <td >
                  Mã vận đơn:
                </td>
                <td >
                  <input type="text" name="invoiceChangeOrder" id="invoiceChangeOrder"  class="invoice_change_order rounded-2 "readonly>
                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td>
                  Mã hóa đơn:
                </td>
                <td>
                  <input type="text" name="invoiceChangeId" class="invoice_change_id rounded-2 " readonly>
                </td>
            </tr>
            <tr >
                <td>Ngày lập:</td>
                <td>
                  <input type="text" name="invoiceChangeDate" readonly class="invoice_change_date form-control w-50"/>
                </td>
            </tr>
            <tr >
                <td>Tổng tiền:</td>
                <td>
                  <input type="text" name="invoiceChangeMoney" class="invoice_change_money rounded-2 " readonly>
              </td>
            </tr>
            <tr >
                <td>Thanh toán:</td>
                <td>
                  <input type="radio" class="me-2" id="invoiceChangeState_1" name="invoiceChangeState" value="Xác nhận"><label class="me-2" for="invoiceChangeState_1">Xác nhận</label>
                  <input type="radio" class="me-2" id="invoiceChangeState_2" name="invoiceChangeState" value="Chưa xác nhận"><label class="me-2" for="invoiceChangeState_2">Chưa xác nhận</label>
              </td>
            </tr>
          </table>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" data-api-link="<?php echo __WEB_ROOT ?>admin/invoice/post_invoice" name="submitChange" class="btn btn-primary form_change_submit me-3 ">Xác nhận</button>
        <button type="button" class="btn btn-danger form_change_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- The Modal  xóa-->
<div class="modal invoice_delete mt-5 fade">
  <div class="modal-dialog modal_delete modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Xóa hóa đơn</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_delete_invoice">
          <table class=" fs-4 table_delete_invoice d-flex justify-content-center">
          <tr >
                <td >
                  Mã vận đơn:
                </td>
                <td >
                  <input type="text" name="invoiceDeleteOrder"  class="invoice_delete_order rounded-2 " readonly>

                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td>
                  Mã hóa đơn:
                </td>
                <td>
                  <input type="text" name="invoiceDeleteId" class="invoice_delete_id rounded-2 " readonly>
                </td>
            </tr>
            <tr >
                <td>Ngày lập:</td>
                <td>
                  <input type="text" name="invoiceDeleteDate" class="invoice_delete_date form-control w-50"  disabled/>
                </td>
            </tr>
            <tr >
                <td>Tổng tiền:</td>
                <td>
                  <input type="text" name="invoiceDeleteMoney" class="invoice_delete_money rounded-2 " readonly>
              </td>
            </tr>
            <tr >
                <td>Thanh toán:</td>
                <td>
                  <input type="radio" class="me-2" id="invoiceDeleteState_1" name="invoiceDeleteState" value="Xác nhận" disabled><label class="me-2" for="invoiceDeleteState_1">Xác nhận</label>
                  <input type="radio" class="me-2" id="invoiceDeleteState_2" name="invoiceDeleteState" value="Chưa xác nhận" disabled><label class="me-2" for="invoiceDeleteState_2">Chưa xác nhận</label>
              </td>
            </tr>
          </table>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" data-api-link="<?php echo __WEB_ROOT ?>admin/invoice/post_invoice" name="submitDelete" class="btn btn-primary form_delete_submit me-3 ">Xác nhận</button>
        <button type="button" class="btn btn-danger form_delete_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
    
  </div>
</div>
<script src="<?php echo __WEB_ROOT ?>public/assets/admin/js/InvoiceScript.js"></script>