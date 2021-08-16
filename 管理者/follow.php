<?php
$login=$_GET["login"];


session_start();
if(isset($_SESSION["account"]["login"])){
    $manager=$_SESSION["account"]["login"];
}


$pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');
foreach ($pdo->query("select * from account where login='".$login."'") as $row) {
    $name=$row['name'];
    $email=$row['email'];
    $status=$row['status'];
}
$query=$pdo->query("SELECT name from follow where manager='$manager'");
$datalist=$query->fetchall();
foreach($datalist as $datadetail){
    $arr[]=$datadetail['name'];
}

if(isset($arr) and in_array($name,$arr)){
    echo "<script> {window.alert('已追蹤此帳號');location.href='index.php?method=accounts'} </script>";
}else{
    $sql=$pdo->prepare('insert into follow (name,manager,login,email) VALUES(?,?,?,?)');
    if($sql->execute([$name,$manager,$login,$email])){
        echo "<script> {window.alert('追蹤成功');location.href='index.php?method=accounts'} </script>";
    };
}

?>
