<link rel="stylesheet" type="text/css" href="<?php echo __WEB_ROOT ?>public/assets/client/css/client_Search.css">
<div class="body">
    <div class="title text-light d-flex justify-content-center pe-5 align-items-center fw-bolder">My SSC Acount</div>
    <div class="container-fluid mb-5" >
        <div class="container client_search"  id="client_search" data-contract="<?php echo __WEB_ROOT ?>/home/getListContractOfCustomer">
            <div style="border-top: 1px solid" class="signup-margin container-fluid search d-flex flex-column justify-content-start   align-items-center">
                    <table class="table table-borderless mt-5 d-flex justify-content-center">
                        <tr style="height:65px">
                            <td class="search_title">Mã hợp đồng:</td>
                            <td>
                              <input class="search_input form-control  rounded-3 " id="search_input" type="text" name="input_id">
                              <div class="suggestionsContractSearch" hidden id="suggestionsContractSearch"> </div>
                          </td>
                        </tr>
                        <tr style="height:75px">
                            <td colspan="2" class="search_title text-center ">
                                <input type="submit" class="button btn_search border-0 rounded-3 h-50" name="searchSubmit" id="searchSubmit" value="Tìm kiếm">
                            </td> 
                        </tr>
                    </table>
                <div class="overflow-scroll structure w-100" style="height:400px ">
                    <table class="table">
                    <thead>
                        <tr>
                            <th  class="text-center" style="width:150px">Mã</th>
                            <th  class="text-center" style="width:140px">Ngày lập</th>
                            <th  class="text-center" style="width:130px">SĐT</th>
                            <th  class="text-center" >Email</th>
                            <th  class="text-center"style="width:140px">Trạng thái</th>
                            <th  class="text-center"style="width:150px">Địa chỉ nhận</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                      $fillterArray =$listContract;
                      if(isset($_GET['search']))
                      {
                        $fillterArray=[];
                        $inputSearch= $_GET['search'];
                        foreach ($listContract as $key => $value) {
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
                          echo "<tr>
                          <td  class='text-center text-truncate'>".$fillterArray[$i]['mahopdong']."</td>
                          <td  class='text-center text-truncate'>".$fillterArray[$i]['ngaylap']."</td>
                          <td  class='text-center text-truncate'>".$fillterArray[$i]['sdt']."</td>
                          <td  class='text-center text-truncate'>".$fillterArray[$i]['email']."</td>
                          <td  class='text-center text-truncate'>".($fillterArray[$i]['status']==1?"Đã xác nhận":"Đang chờ xác nhận")."</td>
                          <td  class='text-center text-truncate'>".$fillterArray[$i]['diachinhan']."</td>
                      </tr>";
                        }
                      ?>
                        
                    </tbody>
                    <tfoot>
                    <tr >
                      <th colspan="6" class="change_page rounded-bottom-4 border-none" style="border:none;">
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
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="modal contract_info mt-5 fade">
  <div class="modal-dialog modal-lg  modal-dialog-centered  ">
    <div class="modal-content ">
      <!-- Modal Header -->
      <div class="modal-header d-flex justify-content-center">
        <h4 class="modal-title fw-bold mx-auto">Thông tin chi tiết hợp đồng</h4>
        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
      <form action="" class="form_contract_info">
          <table class=" ms-5 me-3 mt-3 fs-4 table_contract_info w-100">
            <tr style="height:50px">
                <td >
                  Mã hợp đồng:
                </td>
                <td >
                  <input type="text" name="contractId" class="contract_info_id  rounded-2 w-25"  disabled>
                </td>
            </tr>
            <tr  style="height:50px">
                <td>Ngày lập:</td>
                <td >
                  <input type="text" name="contractInfoDate" class="contract_info_date rounded-2  w-50 " disabled/>
                </td>
            </tr>
            <tr style="height:50px">
                <td >
                    SĐT:
                </td>
                <td >
                  <input type="text" name="contractPhone" class="contract_info_phone  rounded-2 w-50"  disabled>
                </td>
            </tr>
            <tr style="height:50px">
                <td>Email:</td>
                <td >
                  <input type="text" name="contractInfoEmail" class="contract_info_email rounded-2  w-75 " disabled/>
                </td>
            </tr>
            <tr style="height:50px">
                <td >
                    Trạng thái:
                </td>
                <td >
                  <input type="text" name="contractState" class="contract_state  rounded-2 w-50"  disabled>
                </td>
            </tr>
            <tr style="height:50px">
                <td>Địa chỉ nhận:</td>
                <td >
                  <input type="text" name="contractInfoAddress" class="contract_info_address rounded-2  w-75 " disabled/>
                </td>
            </tr>

          </table>
      </div>    
      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="btn btn-danger form_info_close ms-3 fs-4 " style="width:125px" data-bs-dismiss="modal">Hủy</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script src="<?php echo __WEB_ROOT ?>public/assets/client/js/ClientSearchScript.js"></script>