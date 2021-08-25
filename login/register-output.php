<?php
$name=$_POST["name"];
$login=$_POST["login"];
$password=$_POST["password"];
$email=$_POST["email"];
$school=$_POST["school"];
$tel=$_POST["tel"];


$pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');
$sql=$pdo->prepare('insert into account (name,login,password,email,status,school) VALUES(?,?,?,?,?,?)');
$sql->execute([$name,$login,$password,$email,"投稿者",$school]);
$sql2=$pdo ->prepare('INSERT INTO account_field (login, f_name) VALUES (?,?)');
$sql2->execute([$login,""]);
$sql3=$pdo ->prepare('INSERT INTO account_tel (login, tel) VALUES (?,?)');
$sql3->execute([$login,$tel]);


$rs=$pdo->query("SELECT login FROM account where status='投稿者'");
if($login!=$rs)
{
    header('location:success.php');
}

else
{
    header('location:fail.php');
}

                                   
                            
?>