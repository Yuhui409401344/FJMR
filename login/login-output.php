<?php
session_start();
$status1=$_POST["status"];
$login=$_POST['login'];
$password=$_POST['password'];
unset($_SESSION['account']);


$pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');
$sql=$pdo->prepare('select * from account where login=? and password=? and status=?');
$sql->execute([$login,$password,$status1]);
foreach ($sql->fetchAll() as $row) {
	$_SESSION['account']=[
		 'login'=>$row['login'], 
		'password'=>$row['password'],
        'status'=>$row['status']
    ];
}


if (isset($_SESSION['account'])) {
     if($status1 == "投稿者"){
          header("location:../投稿者/format.php"); 
     }elseif($status1 == "審稿者"){
          header("location:../審稿者/dashboard.php");
     }else{
          header("location:../管理者/index.php?method=maildistribution");
    }
}else{
     echo "<script> {window.alert('登入錯誤');location.href='login.php'} </script>";
}
	

?>

   
