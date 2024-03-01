<?php

// require 'PHPMailer/src/Exception.php';
// require 'PHPMailer/src/PHPMailer.php';
// require 'PHPMailer/src/SMTP.php';

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// $mail = new PHPMailer(true);

// try {
//     //hiển thị thông tin khi gửi

//     // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
//     $mail->isSMTP();                                            //Send using SMTP
//     $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
//     $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
//     $mail->Username   = 'baonguyen.ld1220@gmail.com';                     //SMTP username
//     $mail->Password   = 'pirulvxwuaevfxzw';                               //SMTP password
//     $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
//     $mail->Port       = 465;                                      
    
//     //tên và mail  nhận
//     $address =$info['email'];
//     $name = $info['tenkhachhang'];

//     // cài đặt mail gửi
//     $mail->setFrom('baonguyen.ld1220@gmail.com', 'SaiGonShip');
//     //cài đặt mail nhận
//     $mail->addAddress($address,$name);  
    
//     //random mã
//     $randomNumber = mt_rand(1000, 9999);
//     //Content
//     $mail->isHTML(true);                                  
//     $mail->Subject = 'CAPTCHA';
//     $mail->Body    = 'Mã xác nhận của bạn là: '.$randomNumber;

 
//     $mail->send();
//     echo 'Message has been sent';
// } catch (Exception $e) {
//     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
// }


// Số lượng mục dữ liệu mỗi trang
// $itemsPerPage = 10;

// // Tổng số mục dữ liệu (giả sử lấy từ cơ sở dữ liệu)
// $totalItems = 100;

// // Tính toán tổng số trang
// $totalPages = ceil($totalItems / $itemsPerPage);

// // Lấy số trang hiện tại từ tham số truyền vào
// $currentpage = isset($_GET['page']) ? $_GET['page'] : 1;

// // Giới hạn giá trị của trang hiện tại để tránh giá trị không hợp lệ
// $currentpage = max(1, min($currentpage, $totalPages));

// // Tính toán vị trí bắt đầu của dữ liệu
// $start = ($currentpage - 1) * $itemsPerPage;

// // Hiển thị dữ liệu tương ứng với trang hiện tại (giả sử lấy từ cơ sở dữ liệu)
// $data = range($start + 1, min($start + $itemsPerPage, $totalItems));

// // Hiển thị dữ liệu
// foreach ($data as $item) {
//     echo "Item $item<br>";
// }

// // Hiển thị nút phân trang
// echo '<div class="pagination">';
// for ($page = 1; $page <= $totalPages; $page++) {
//     echo '<a href="?page=' . $page . '">' . $page . '</a>';
// }
// echo '</div>';

    

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailSender
{
    private $mail;
    public $randomNumber = 0;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
    }

    public function sendEmail($info)
    {
        try {
            $this->configureSMTP();
            $this->configureMailContent($info);

            $this->mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }
    public function sendAccountEmail($info)
    {
        try {
            $this->configureSMTP();
            $this->configureMailContentAccount($info);

            $this->mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }
    private function configureSMTP()
    {
        $this->mail->isSMTP();
        $this->mail->Host       = 'smtp.gmail.com';
        $this->mail->SMTPAuth   = true;
        $this->mail->Username   = 'baonguyen.ld1220@gmail.com';
        $this->mail->Password   = 'pirulvxwuaevfxzw';
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mail->Port       = 465;
    }
    private function configureMailContent($info)
    {
        $address = $info['email'];
        $name = $info['tenkhachhang'];

        $this->mail->setFrom('baonguyen.ld1220@gmail.com', 'SaiGonShip');
        $this->mail->addAddress($address, $name);

        $this->randomNumber = mt_rand(1000, 9999);

        $this->mail->isHTML(true);
        $this->mail->Subject = 'CAPTCHA';
        $this->mail->Body = 'Mã xác nhận của bạn là: ' .  $this->randomNumber;
    }
    private function configureMailContentAccount($info)
    {
        $address = $info['email'];
        $this->mail->setFrom('baonguyen.ld1220@gmail.com', 'SaiGonShip');
        $this->mail->addAddress($address);

        $this->mail->isHTML(true);
        $this->mail->Subject = 'SIGNUP ACCOUNT SUCCESS';
        $this->mail->Body = 'Tài khoản của bạn: ' .  $info['username']."<br>
            Mật khẩu: ".$info['password'];
    }
}

?>

    