<?php

$accept = $_POST['accept'];
$id = $_POST['id'];
$reviewer = $_POST['reviewer'];

$pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');
$sql1=$pdo->prepare("insert into distri (accept) where id='".$id."' and pro='".$reviewer."' VALUES(?)");
$sql1->execute([$accept]);

$sql2=$pdo->prepare('insert into distri_history (accept) whereid='".$id."' and pro='".$reviewer."' VALUES(?)');
$sql2->execute([$accept]);

echo "<script> {window.alert('回覆成功');} </script>";

?>