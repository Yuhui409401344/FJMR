<?php
$login=$_GET["login"];
$school=$_GET["school"];
$department=$_GET["department"];
$degree=$_GET['degree'];
$pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 
    'root', '');
$sql=$pdo->prepare("DELETE from account_resume where account_resume.login=? and account_resume.school=? and account_resume.department=? and account_resume.degree=? ");
if ($sql->execute([$login,$school, $department, $degree])) {
    echo "<script> {window.alert('刪除成功');location.href='profile.php'} </script>";
} else {
    echo '刪除失敗。';
}
?>
                    