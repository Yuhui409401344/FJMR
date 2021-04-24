<?php
$name=$_POST["name"];
$login=$_POST["login"];
$password=$_POST["password"];
$email=$_POST["email"];

$pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');
$sql=$pdo->prepare('insert into account (name,login,password,email,status) VALUES(?,?,?,?,?)');
$sql->execute([$name,$login,$password,$email,"投稿者"]);
$sql2=$pdo ->prepare('INSERT INTO account_field (login, f_name) VALUES (?,?)');
$sql2->execute([$login,""]);

$rs=$pdo->query('SELECT login FROM account');
if($login!=$rs)
{
    header('location:success.php');
}

else
{
    header('location:fail.php');
}

                                   
                            
?>