<?php
session_start();

$title=$_POST["title"];
$field=$_POST["field"];

$pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');
$sql=$pdo ->prepare("delete from newpaper_field where title=?");
$sql->execute([$title]);

foreach($field as $v){
    $sql3=$pdo ->prepare('INSERT INTO newpaper_field (title,f_name) VALUES (?,?)');
    $sql3->execute([$title,$v]);
}

$sql1=$pdo->query("select id from newpaper where title='".$title."'");
foreach($sql1 as $row){
    $id = $row['id'];
}
echo "<script> {window.alert('修改領域成功');location.href='distri.php?id=$id'} </script>"
?>