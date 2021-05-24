<?php
    session_start();
    if(isset($_SESSION["account"]["login"])){
        $password=$_SESSION["account"]["password"];
        $login=$_SESSION["account"]["login"];
    }
    
    $school=$_POST["school"];
    $department=$_POST["department"];
    $degree=$_POST["degree"];
    $start_year=date($_POST["start_year"]);
    $end_year=date($_POST['end_year']);


    $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
   
   
    $sql=$pdo->prepare('INSERT INTO account_resume (login,school,department, degree,start_year,end_year) VALUES(?,?,?,?,?,?)');
    if($sql->execute([$login,$school,$department,$degree,$start_year,$end_year])){
        echo "<script> {window.alert('加入成功');location.href='profile.php'} </script>";
    }else{
        echo "加入失敗";
    }
?>