<html>
<?php
$email = $_REQUEST['email'];
$pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');

if (is_array($email)) {
    foreach ($email as $email) {
        $sql = $pdo->query("select DISTINCT name,email from account where email = '" . $email . "'");
        foreach ($sql as $row) {
            $to_email = $row['email'];
            $name = $row['name'];

            $subject = '新上傳的投稿文章:' . $title;
            $message = '稿件回覆日期即將到期請盡速到管理平台審理稿件。';
            $headers = 'From: paggiechen8866@gmail.com';

            require_once '../PHPMailer/PHPMailerAutoload.php';

            $mail = new PHPMailer;
            $mail->Charset = 'UTF-8';

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'paggiechen8866@gmail.com';
            $mail->Password = 'vtqnavfijdkcjpln';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('paggiechen8866@gmail.com', 'FJMR');
            $mail->addAddress($to_email, $name);
            $mail->isHTML(true);

            $mail->Subject = "=?utf-8?B?" . base64_encode("輔仁管理評論有即將到期審稿的稿件，請盡速審稿。") . "?=";
            $mail->Body    =  file_get_contents('../mail.html', true);
            $mail->AltBody = '親愛的審稿者者您好，輔仁管理評論中，您有一篇稿件即將到審稿期限，請盡速審稿。';
        }

        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            'Message has been sent';
            echo "<script> {window.alert('發送成功');location.href='index.php?method=deadline'} </script>";
        }
    }
}else{
$sql = $pdo->query("select DISTINCT name,email from account where email = '" . $email . "'");
foreach ($sql as $row) {
    $to_email = $row['email'];
    $name = $row['name'];

    $subject = '新上傳的投稿文章:' . $title;
    $message = '稿件回覆日期即將到期請盡速到管理平台審理稿件。';
    $headers = 'From: paggiechen8866@gmail.com';

    require_once '../PHPMailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;
    $mail->Charset = 'UTF-8';

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'paggiechen8866@gmail.com';
    $mail->Password = 'vtqnavfijdkcjpln';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('paggiechen8866@gmail.com', 'FJMR');
    $mail->addAddress($to_email, $name);
    $mail->isHTML(true);

    $mail->Subject = "=?utf-8?B?" . base64_encode("輔仁管理評論有即將到期審稿的稿件，請盡速審稿。") . "?=";
    $mail->Body    =  file_get_contents('../mail.html', true);
    $mail->AltBody = '親愛的審稿者者您好，輔仁管理評論中，您有一篇稿件即將到審稿期限，請盡速審稿。';
}

if (!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    'Message has been sent';
    echo "<script> {window.alert('發送成功');location.href='index.php?method=deadline'} </script>";
}}
?>

</html>