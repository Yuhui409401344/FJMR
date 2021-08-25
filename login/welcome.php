<?php
session_start();
$password=$_SESSION["account"]["password"];
$login=$_SESSION["account"]["login"];

$pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');
$sql=$pdo->query("select status from account where login='".$login."'");
foreach($sql as $row){
    $status=$row["status"];
}



 if($status=="投稿者"){
     header("location:../投稿者/format.php?login=".$login."");
        
        
    }elseif($status=="審稿者"){
          header("location:../審稿者/dashboard.php?login=".$login."");

    }else{
          header("location:../管理者/index.php?method=maildistribution");

    }
    
?>