<link rel="stylesheet" type="text/css" href="<?php echo __WEB_ROOT ?>public/assets/client/css/client_Contract.css">
<div class="body">
    <div class="title text-light d-flex justify-content-center pe-5 align-items-center fw-bolder">My SSC Acount</div>
    <div class="container-fluid mb-5">
        <div class="container" >
            <div style="border-top: 1px solid" class="signup-margin container-fluid contract d-flex flex-column justify-content-center  align-items-center" >
            <div class ="contract_title fs-1">Yêu cầu dịch vụ</div>
            <table class="w-75 mt-2">
                <tr style="height:50px">
                    <td style="width:170px"  class="contract_content fs-4 text-black-50 " >Tên hàng hóa:</td>
                    <td >
                        <input id="cargo_contract_name" type="text" class="form-control w-50">
                    </td>
                </tr>
                <tr style="height:50px">
                    <td class="contract_content fs-4 text-black-50" >Cảng đi:</td>
                    <td >
                        <select name="selectDepart" id="selectDepart" class="form-control w-50">
                                <?php 
                                    foreach($listCang as $cangdi)
                                    {
                                        echo "<option value='".$cangdi['macang']."'>".$cangdi['macang']."</option>";
                                    }
                                ?>
                        </select>
                    </td>
                </tr >
                <tr style="height:50px">
                    <td  class="contract_content fs-4 text-black-50 " >Cảng đến:</td>
                    <td >
                        <select name="selectDes" id="selectDes" class="form-control w-50">
                        <?php 
                                    foreach($listCang as $cangdi)
                                    {
                                        echo "<option value='".$cangdi['macang']."'>".$cangdi['macang']."</option>";
                                    }
                                ?>
                        </select>
                    </td>
                </tr>
                <tr style="height:50px">
                <td class="contract_content fs-4 text-black-50" >Container:</td>
                    <td style="height:50px">
                        <select name="selectService" id="selectService" class="form-control w-25">
                        <option value="Có" selected>Đã có container</option>
                        <option value="Chưa có">Thuê container</option>
                        </select>
                    </td>
                </tr>
            </table>
            <div class ="contract_content fs-4 text-black-50 mt-1 d-flex align-items-start w-75">
                Nội dung:
            </div>
            <textarea class="form-control input_contract " name="inputContract" id="contract_content_client" cols="30" rows="10" placeholder="Vui lòng nhập thông tin yêu cầu"></textarea>
            <input type="submit" data-api-link="<?php echo __WEB_ROOT ?>home/requestService" id="btn_contract_submit_client" class="btn_contract_submit  text-light text mt-4" name="submit" value="Xác nhận">
        </div>
    </div>
</div>
<script src="<?php echo __WEB_ROOT ?>public/assets/client/js/Contract.js"></script>
