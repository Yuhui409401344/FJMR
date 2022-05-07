<?php 
$login=$_POST['login'];
$pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
foreach ($pdo->query("SELECT name from account where login='".$login."'") as $row) {
    $userName=$row['name'];
}

if(!isset($userName)){
    echo "<script> {window.alert('您的帳號輸入錯誤或不存在');location.href='pwrecover.php'} </script>";
}else{
    
    $sql = $pdo->query("select name,email from account where status='管理者' ");

    foreach($sql as $row){
        $to_email = $row['email']; //管理者信箱
        $name = $row['name']; //管理者姓名
        require_once '../PHPMailer/PHPMailerAutoload.php';

        $mail = new PHPMailer;

        //$mail->SMTPDebug = 3;                               // Enable verbose debug output

        $mail->isSMTP();  
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'paggiechen8866@gmail.com';                 // SMTP username
        $mail->Password = 'vtqnavfijdkcjpln';                         // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom('paggiechen8866@gmail.com', 'FJMR');
        $mail->addAddress($to_email, $name);     

        $mail->isHTML(true);                                  // Set email format to HTML

        
        $mail->Subject = "=?utf-8?B?" . base64_encode("輔仁管理評論的用戶要求修復密碼") . "?=";
        $mail->Body    =  "輔仁管理評論的用戶".$login."".$userName."忘記密碼，請您回信連絡他！";
        $mail->AltBody =  "輔仁管理評論的用戶".$login."".$userName."忘記密碼，請您回信連絡他！";
    }

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo "<script> {window.alert('信件已寄出，請等待管理者聯繫您！');location.href='../home/home.php'} </script>"; 
        }
}
                            


?>