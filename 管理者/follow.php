<?php
$login=$_GET["login"];

$pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');
foreach ($pdo->query("select * from account where login='".$login."'") as $row) {
    $name=$row['name'];
    $email=$row['email'];
    $status=$row['status'];
}
$query=$pdo->query("SELECT name from follow");
$datalist=$query->fetchall();
foreach($datalist as $datadetail){
    $arr[]=$datadetail['name'];
}

if(isset($arr) and in_array($name,$arr)){
    echo "<script> {window.alert('已追蹤此帳號');location.href='accounts.php'} </script>";
}else{
    $sql=$pdo->prepare('insert into follow (name,login,email,status) VALUES(?,?,?,?)');
    if($sql->execute([$name,$login,$email,$status])){
        echo "<script> {window.alert('追蹤成功');location.href='accounts.php'} </script>";
    };
}

?>