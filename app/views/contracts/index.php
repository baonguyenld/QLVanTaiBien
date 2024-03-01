
<link rel="stylesheet" type="text/css" href="<?php echo __WEB_ROOT ?>public/assets/admin/css/admin_Contract.css">
<div class="scroll   contract" id="contract" data-contract="<?php echo __WEB_ROOT ?>/admin/Contract/getListContract" style="width:85.5%">
    <div class="contract_option ms-5 mt-5 d-flex flex-row align-items-end">
        <button class="contract_option_add me-3  rounded-4 " data-seaport="<?php echo __WEB_ROOT ?>/admin/Seaport/getListSeaport"  data-customer="<?php echo __WEB_ROOT ?>/admin/Customer/getListCustomer" id="contract_option_add" data-bs-toggle="modal" data-bs-target=".contract_add">
             <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-plus-circle option_img mt-1" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>
            <div class ="option_content fw-normal mt-2 fs-5" >Tạo mới</div>
        </button>
        <button  class="contract_option_report me-3 rounded-4" data-customer="<?php echo __WEB_ROOT ?>/admin/Customer/getListCustomer" id="contract_option_report" data-bs-toggle="modal" data-bs-target=".contract_report">
            <img src="<?php echo __WEB_ROOT ?>public/assets/admin/images/reporticon.png"  class ="choice_img mt-2">
            <div class ="option_content fw-normal  fs-5 mt-1"  >Thống kê</div>
        </button>
    </div>
    <div class=" contract_search ms-5 mt-4">
      <table>
        <tr>
          <td>
          <input type="text" <?php  if(isset($_GET['search'])) {echo "value='".$_GET['search']."'";}  ?>name="input-search" class="search_contract rounded-4 ps-3" id="search_contract" placeholder=<?php echo (isset($_GET['search'])&&strlen($_GET['search'])!=0) ? "" : "Nhập&nbsp;mã&nbsp;hợp&nbsp;đồng" ?> >
            <img src="../image/search-interface-symbol 1.png" class="search_img " alt="">
            <input  type="submit" data-api-link='<?php echo __WEB_ROOT ?>admin/contract/post_contract' class="submit_Search_contract rounded-4 ms-3 " name="searchSubmit" id="searchSubmit" value="Tìm kiếm">
          </td>
        </tr>
        <tr>
          <td>
            <div class="suggestionsContractSearch" hidden id="suggestionsContractSearch"> </div>
          </td>
        </tr>
      </table>

    </div>
    <div class=" contract_view mt-3 ms-5 mb-0">
        <table class="table table-hover table-striped table-borderless rounded-3 mb-0 " style="table-layout: fixed">
        <thead>
            <tr class="border-bottom border-dark">
                <th colspan="8" class="text-center fs-2 fw-normal rounded-top-4 ">Quản lý hợp đồng</th>
            </tr>
            <tr >
                <th class="text-center " style="width:150px  " >Mã hợp đồng</th>
                <th class="text-center" >Mã khách hàng</th>
                <th class="text-center" style="width:200px " >Ngày lập</th>
                <th class="text-center"  style="width:200px ">SĐT</th>
                <th class="text-center"  style="width:250px ">Email</th>
                <th class="text-center" style="width:200px ">Trạng thái</th>
                <th class="text-center" style="width:200px ">Nội dung</th>
                <th class="text-center" style="width:200px ">Thao tác</th>
            </tr>
        </thead>
        <tbody id="search-data">
        <?php
            $fillterArray =$contractList;
            if(isset($_GET['search']))
            {
              $fillterArray=[];
              $inputSearch= $_GET['search'];
              foreach ($contractList as $key => $value) {
                if(strpos($value['mahopdong'], $inputSearch) !== false)
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
            // print_r($contractList[0]['mahopdong']);
            // đặt giới hạn cho số trang tránh trường hợp lỗi
            $currentpage = max(1, min($currentpage, $totalPages));
            // Tính toán vị trí bắt đầu của dữ liệu
            $start = ($currentpage - 1) * $itemsPerPage;
            for ($i=$start; $i < min($start + $itemsPerPage, $totalItems) ; $i++) { 

              echo
                "<tr>
                  <td class='text-center text-truncate' >".$fillterArray[$i]['mahopdong']."</td>
                  <td class='text-center text-truncate' >".$fillterArray[$i]['tenkhachhang']."</td>
                  <td class='text-center text-truncate' >".$fillterArray[$i]['ngaylap']."</td>
                  <td class='text-center text-truncate' >".$fillterArray[$i]['sdt']."</td>
                  <td class='text-center text-truncate' >".$fillterArray[$i]['email']."</td>
                  <td class='text-center text-truncate' ".($fillterArray[$i]['status']?"":"style='color: red'")." >".($fillterArray[$i]['status']?"Đã xác nhận":"Chưa xác nhận")."</td>
                  <td class='text-center text-truncate' >".(($fillterArray[$i]['noidung']!=null)?$fillterArray[$i]['noidung']:"")."</td>
                  <td class='text-center text-truncate' >                                                                                           
                    <button class='border-0 btn_change' data-customer='".__WEB_ROOT."admin/Customer/getListCustomer' "."data-api-link='".__WEB_ROOT."admin/contract/post_contract"."' data-bs-toggle='modal' data-bs-target='.contract_change' data-change-id='".$fillterArray[$i]['mahopdong']."'><img src='".__WEB_ROOT."public/assets/admin/images/pencil_2280532 1.png"."'/></button>
                    <button class='border-0 btn_delete' data-api-link='".__WEB_ROOT."admin/contract/post_contract"."' data-delete-id='".$fillterArray[$i]['mahopdong']."'  data-bs-toggle='modal' data-bs-target='.contract_delete'> <img src='".__WEB_ROOT."public/assets/admin/images/close.png"."'/></button>
                  </td>
              </tr>";
            }

          ?>
          </tbody>
          <tfoot>
            <tr >
                <th colspan="8" class="change_page rounded-bottom-4 ">
                  <ul class="pagination m-auto justify-content-end me-5" id="pagination">
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
<div class="modal contract_add mt-5 fade">
  <div class="modal-dialog modal_add modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Tạo mới hợp đồng</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_add_contract">
          <table class=" ms-5 me-3 mt-3 fs-4 table_add_contract">
            <tr >
                <td >
                  Mã khách hàng:
                </td>
                <td >
                  <input type="text" name="contractAddName" id="contractAddName"  class="contract_add_name rounded-2 " autocomplete="off">
                  <div class="suggestionsContractAdd" hidden   id="suggestionsContractAdd">
                </td>
            </tr>
            <tr >
                <td >
                  Tên hàng hóa:
                </td>
                <td >
                  <input type="text" name="contractAddCargo" id="contractAddCargo"  class="contract_add_cargo rounded-2 " autocomplete="off">
                </td>
            </tr>
            <tr >
                <td >
                  Cảng đi:
                </td>
                <td >
                  <select name="contractAddDepart" id="contractAddDepart" class="form-control w-75">
           
                  </select>
                </td>
            </tr>
            <tr >
                <td >
                  Cảng đến:
                </td>
                <td >
                  <select name="contractAddDes" id="contractAddDes" class="form-control w-75">
                  </select>
                </td>
            </tr>
            <tr >
                <td >
                  Container:
                </td>
                <td >
                  <select name="contractAddContainer" id="contractAddContainer" class="form-control w-75">
                        <option value="Có" selected>Đã có container</option>
                        <option value="Chưa có">Thuê container từ công ty</option>
                  </select>
                </td>
            </tr>
   
               <td><label for="myTextarea">Nội dung:</label></td>
            <tr>
              <td colspan=2>
                  <textarea id="contractTextarea" name="contractTextarea" rows="4" cols="50" onclick="moveCursorToStart()">
                  </textarea>
              </td>
            </tr>
            <tr class="d-none column_error_add_contract" >
                <td colspan="2">
                      <p id="error_add_contract" style="color: red; font-style: italic"></p>
                </td>
            </tr>
          </table>
      </div>    

      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" data-api-link="<?php echo __WEB_ROOT ?>admin/contract/post_contract" name="submitAdd" class="btn btn-primary form_add_submit me-3 ">Xác nhận</button>
        <button type="button" class="btn btn-danger form_add_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- The Modal  tiêu chí báo cáo-->
<div class="modal contract_report mt-5 fade">
  <div class="modal-dialog modal-lg  modal-dialog-centered  ">
    <div class="modal-content ">
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <h4 class="modal-title fw-bold mx-auto">Thống kê hợp đồng</h4>
        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
      <form action="" class="form_report_contract">
          <table class=" ms-5 me-3 mt-3 fs-4 table_report_contract w-100">
            <tr >
                <td >
                  Mã khách hàng:
                </td>
                <td >
                  <input type="text" name="contractReportName" id="contractReportName" class="contract_report_name rounded-2 " autocomplete="off">
                  <div class="suggestionsContractReport" hidden   id="suggestionsContractReport">
                </td>
            </tr>
            <tr >
                <td>Ngày lập:</td>
                <td >
                  <label  >từ ngày</label>
                  <input type="date" name="contractReportDateFrom" class="contract_report_date form-control w-25 d-inline"  />
                  <label  >đến</label>
                  <input type="date" name="contractReportDateTo" class="contract_report_date form-control w-25 d-inline"  /> 
                </td>
            </tr>

            <tr >
                <td>Trạng thái:</td>
                <td>
                  <input type="radio" class="me-2" id="contractReportState_1" name="contractReportState" value="Xác nhận" checked><label class="me-2" for="contractReportState_1">Xác nhận</label>
                  <input type="radio" class="me-2" id="contractReportState_2" name="contractReportState" value="Chưa xác nhận"><label class="me-2" for="contractReportState_2">Chưa xác nhận</label>
              </td>
            </tr>
          </table>

      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" data-api-link="<?php echo __WEB_ROOT ?>admin/contract/post_contract" name="submitReport" class="btn btn-primary form_report_submit me-3 " data-bs-toggle="modal" data-bs-target=".contract_export">Xác nhận</button>
        <button type="button" class="btn btn-danger form_report_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- The Modal  xuất bảng báo cáo-->
<div class="modal contract_export mt-5 fade">
  <div class="modal-dialog modal-lg  modal-dialog-centered  ">
    <div class="modal-content ">
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <h4 class="modal-title fw-bold mx-auto">Bảng thống kê</h4>
        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
      <table class="  fs-4 table_export_contract w-100 h-75">
          <tr style="height:50px">
            <td  class="w-25 h-25">
              Mã khách hàng:
            </td>
              <td class="w-75">
                <input type="text" name="contractExportMame"  class="contract_export_name rounded-2  border-0" disabled>
              </td>
          </tr>
          <tr style="height:50px">
            <td class="w-25">
              Thời gian:
            </td>
              <td class="w-75">
                  <label >từ ngày</label>
                  <input type="text" name="contractExportDate1" class="order_report_date_1 border-0 w-25"  disabled/>
                  <label >đến</label>
                  <input type="text" name="contractExportDate2" class="order_report_date_2 border-0 w-25"  disabled/> 
              </td>
          </tr>
          <tr style="height:50px">
            <td  class="w-25">
              Số lượng:
            </td>
              <td class="w-75">
                <input type="text" name="contract_export_count"  class="contract_export_count rounded-2  border-0" disabled>
              </td>
          </tr>
          <tr style="height:50px">
            <td  class="w-25">
              Trạng thái:
            </td>
              <td class="w-75">
                <input type="text" name="contract_export_state"  class="contract_export_state rounded-2  border-0" disabled>
              </td>
          </tr>
      </table>
      <div class="overflow-scroll structure" style="height:400px">
      <table class="table table-bordered  table-striped fs-4 table_export_contract w-100 " >
        <thead class="thead-light text-light">
          <tr>
          <th class="text-center  bg-dark text-light" style="width:250px">Mã hợp đồng</td>
          <th class="text-center  bg-dark text-light" style="width:250px">Mã khách hàng</td>
          <th class="text-center  bg-dark text-light"  style="width:250px">Ngày lập</td>
          <th class="text-center  bg-dark text-light"  style="width:250px">Trạng thái</td>
          </tr>
        </thead>
        <tbody id="report-data">
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
<div class="modal contract_change fade">
  <div class="modal-dialog modal_change modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Cập nhật hợp đồng</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_change_contract">
          <table class="  fs-4 table_change_contract">
            <tr style="height:55px" >
                <td >
                  Mã khách hàng:
                </td>
                <td >
                  <input type="text" name="contractChangeName" id="contractChangeName" list="list-data" class="contract_change_name rounded-2" readonly>
                </td>
            </tr>
            <tr style="height:55px">
                <td>
                  Mã hợp đồng:
                </td>
                <td>
                  <input type="text" name="contractChangeId" id="contractChangeId" class="contract_change_id rounded-2 " readonly>
                </td>
            </tr>
            <tr style="height:55px">
                <td >
                  Tên hàng hóa:
                </td>
                <td >
                  <input type="text" name="contractChangeCargo" id="contractChangeCargo"  class="contract_change_cargo rounded-2 " autocomplete="off">
                </td>
            </tr>
            <tr style="height:55px">
                <td >
                  Cảng đi:
                </td>
                <td >
                  <select name="contractChangeDepart" id="contractChangeDepart" class="form-control w-75">
              
                        <?php
                          foreach($seaportList as $seaport)
                          {
                              echo "<option value='".$seaport['macang']."'>".$seaport['macang']."</option>";
                          }
                        ?>
                  </select>
                </td>
            </tr>
            <tr style="height:55px">
                <td >
                  Cảng đến:
                </td>
                <td >
                  <select name="contractChangeDes" id="contractChangeDes" class="form-control w-75">
                  <?php
                          foreach($seaportList as $seaport)
                          {
                              echo "<option value='".$seaport['macang']."'>".$seaport['macang']."</option>";
                          }
                        ?>
                  </select>
                </td>
            </tr>
            <tr style="height:55px">
                <td >
                  Container:
                </td>
                <td >
                  <select name="contractChangeContainer" id="contractChangeContainer" class="form-control w-75">
                        <option value="Có">Đã có container</option>
                        <option value="Chưa có">Thuê container của công ty</option>
                  </select>
                </td>
            </tr>
            <tr style="height:55px">
                <td>Ngày lập:</td>
                <td>
                  <input type="text" name="contractChangeDate" class="contract_change_date form-control w-50" disabled/>
                </td>
            </tr>
            <tr style="height:55px">
                <td>Trạng thái:</td>
                <td>
                  <input type="radio" class="me-2" id="contractChangeState_1" name="contractChangeState" value="Xác nhận"><label class="me-2" for="contractChangeState_1">Xác nhận</label>
                  <input type="radio" class="me-2" id="contractChangeState_2" name="contractChangeState" value="Chưa xác nhận"><label class="me-2" for="contractChangeState_2">Chưa xác nhận</label>
              </td>
            </tr>
            <td><label for="myTextarea">Nội dung:</label></td>
            <tr style="height:55px">
              <td colspan=2>
                  <textarea id="contractChangeTextarea" name="contractChangeTextarea" rows="4" cols="50"  onclick="moveCursorToStart()">
                  </textarea>
              </td>
            </tr>
            <tr class="d-none column_error_change_contract" >
                <td colspan="2">
                      <p id="error_change_contract" style="color: red; font-style: italic"></p>
                </td>
            </tr>
          </table>
      </div>   
   
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" data-api-link="<?php echo __WEB_ROOT ?>admin/contract/post_contract" name="submitChange" class="btn btn-primary form_change_submit me-3 ">Xác nhận</button>
        <button type="button" class="btn btn-danger form_change_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form> 
    </div>
  </div>
</div>

<!-- The Modal  xóa-->
<div class="modal contract_delete fade">
  <div class="modal-dialog modal_delete modal-lg  modal-dialog-centered  ">
    <div class="modal-content " >
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <div class="modal-title fw-bold mx-auto">Xóa hợp đồng</div>
        <button type="button" class="btn-close ms-0 " data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" class="form_delete_contract">
          <table class=" fs-4 table_delete_contract">
            <tr >
                <td >
                  Mã Khách hàng:
                </td>
                <td >
                  <input type="text" name="contractDeleteName" list="list-data" class="contract_delete_name rounded-2 " readonly>
                </td>
                <td >
                </td>
            </tr>
            <tr >
                <td>
                  Mã hợp đồng:
                </td>
                <td>
                  <input type="text" name="contractDeleteId" class="contract_delete_id rounded-2 " readonly>
                </td>
            </tr>
            <tr >
                <td >
                  Tên hàng hóa:
                </td>
                <td >
                  <input type="text" name="contractDeleteCargo" id="contractDeleteCargo"  class="contract_delete_cargo rounded-2 " readonly>
                </td>
            </tr>
            <tr >
                <td >
                  Cảng đi:
                </td>
                <td >
                  <select name="contractDeleteDepart" id="contractDeleteDepart" class="form-control w-75" disabled>
                  <?php
                          foreach($seaportList as $seaport)
                          {
                              echo "<option value='".$seaport['macang']."'>".$seaport['macang']."</option>";
                          }
                        ?>
                  </select>
                </td>
            </tr>
            <tr >
                <td >
                  Cảng đến:
                </td>
                <td >
                  <select name="contractDeleteDes" id="contractDeleteDes" class="form-control w-75" disabled>
                  <?php
                          foreach($seaportList as $seaport)
                          {
                              echo "<option value='".$seaport['macang']."'>".$seaport['macang']."</option>";
                          }
                        ?>
                  </select>
                </td>
            </tr>
            <tr >
                <td >
                  Container:
                </td>
                <td >
                  <select name="contractDeleteContainer" id="contractDeleteContainer" class="form-control w-75" disabled>
                      <option value="Có">Đã có container</option>
                        <option value="Chưa có">Thuê container của công ty</option>
                  </select>
                </td>
            </tr>
            <tr >
                <td>Ngày lập:</td>
                <td>
                  <input type="text" name="contractDeleteDate" id="contractDeleteDate" class="contract_delete_date form-control  w-50"  disabled/>
                </td>
            </tr>
            <tr >
                <td>Trạng thái:</td>
                <td>
                  <input type="radio" class="me-2" id="contractDeleteState_1" name="contractDeleteState" value="Xác nhận" disabled><label class="me-2" for="contractDeleteState_1">Xác nhận</label>
                  <input type="radio" class="me-2" id="contractDeleteState_2" name="contractDeleteState" value="Chưa xác nhận" disabled><label class="me-2" for="contractDeleteState_2">Chưa xác nhận</label>
              </td>
            </tr>
            <tr>
              <td colspan=2>
                  <textarea id="contractDeleteTextarea" name="contractDeleteTextarea" rows="4" cols="50" readonly>
                  </textarea>
              </td>
            </tr>
          </table>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" data-api-link="<?php echo __WEB_ROOT ?>admin/contract/post_contract" name="submitDelete" class="btn btn-primary form_delete_submit me-3 ">Xác nhận</button>
        <button type="button" class="btn btn-danger form_delete_close ms-3 " data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script src="<?php echo __WEB_ROOT ?>public/assets/admin/js/ContractScript.js"></script>
