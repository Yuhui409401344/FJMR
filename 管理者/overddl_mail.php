<?php
$email = $_REQUEST['mail'];
$pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');

if(! is_array($email)){
    $email= explode(' ', $email);
};

foreach ($email as $email) {
    $sql = $pdo->query("select DISTINCT name,email from account where email = '" . $email . "'");
    foreach ($sql as $row) {
        $to_email = $row['email'];
        $name = $row['name'];

        $subject = '新上傳的投稿文章:' . $title;
        $message = '稿件已超過審稿日期請盡速到管理平台審理稿件。';
        $headers = 'From: fjmreview@gmail.com';

        require_once '../PHPMailer/PHPMailerAutoload.php';

        $mail = new PHPMailer;
        $mail->Charset = 'UTF-8';

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'fjmreview@gmail.com';
        $mail->Password = 'umpkxmlgguzfowqa';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('fjmreview@gmail.com', 'FJMR');
        $mail->addAddress($to_email, $name);
        $mail->isHTML(true);

        $mail->Subject = "=?utf-8?B?" . base64_encode("輔仁管理評論有超過審稿日期的稿件，請盡速審稿。") . "?=";
        $mail->Body    =  require "mail-late.php";
        $mail->AltBody = '親愛的審稿者者您好，輔仁管理評論中，您有一篇稿件超過審稿期限，請盡速審稿。';
    };

    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        'Message has been sent';
        echo "<script> {window.alert('發送成功');location.href='index.php?method=deadline'} </script>";
    };
};
?>