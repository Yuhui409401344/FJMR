<?php require "nav.php" ?>
<?php
$title=$_GET["title"];
$pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
$sql=$pdo->prepare("DELETE * from newpaper_history  where newpaper_history.title=?");
if ($sql->execute([$title])) {
    echo "<script> {window.alert('刪除成功');location.href='history.php'} </script>";
} else {
    echo '刪除失敗。';
}
?>
      