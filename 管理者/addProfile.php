<?php
                                      
    $login=$_POST["login"];
    $school=$_POST["school"];
    $department=$_POST["department"];
    $degree=$_POST["degree"];


    $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
   
   
    $sql=$pdo->prepare('INSERT INTO account_resume (login,school,department, degree) VALUES(?,?,?,?)');
    if($sql->execute([$login,$school,$department,$degree])){
        echo "<script> {window.alert('加入成功');location.href='profile.php'} </script>";
    }else{
        echo "加入失敗"
    }
?>