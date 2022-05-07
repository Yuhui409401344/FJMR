<?php 
session_start();
if(isset($_SESSION["account"]["login"])){
    $login=$_SESSION["account"]["login"];
}

?>
<link rel="apple-touch-icon" sizes="180x180" href="../assets/images/logo/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="../assets/images/logo/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="../assets/images/logo/favicon-16x16.png">
<link rel="icon" href="../assets/images/logo/logo.ico" type="image/x-icon">
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Start project here-->
                            <div style="height: 100vh">
                                <?php
                                    $name=$_POST["name_"];
                                    $email=$_POST["email"];
                                    $password=$_POST["password"];
                                    $field=$_POST["field"];
                                    $bio=$_POST['bio'];
                                    $tel=$_POST['tel'];
                                    $school=$_POST['school'];
                                    
                                   
                                    $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                    $query=$pdo ->query("SELECT status from account where login='".$login."'");
                                    $statuses=$query->fetchall();
                                    foreach($statuses as $status){
                                        $array[]=$status['status'];
                                    }
                                    
                                   
                                
                                    //基本資料
                                    $sql=$pdo ->prepare("update account set name=?, email=?, password=?, school=?  where login='".$login."'");
                                    $sql->execute([$name,$email,$password,$school]);

                                    //基本資料
                                    $sqltel=$pdo ->prepare("update account_tel set tel=?  where login='".$login."'");
                                    $sqltel->execute([$tel]);

                                    //簡介
                                    $sql0=$pdo ->prepare("delete from  account_bio where login=?");
                                    $sql0->execute([$login]);
                                    $sql1=$pdo ->prepare("INSERT INTO account_bio (login,bio) VALUES(?,?)");
                                    $sql1->execute([$login,$bio]);
                                 
                                    //領域
                                    $sql2=$pdo ->prepare("delete from account_field where login=? and (status='審稿者' or status='投稿者' or status='管理者')");
                                    $sql2->execute([$login]);

                                    foreach($field as $v){
                                        foreach($array as $s){
                                            $sql3=$pdo ->prepare('INSERT INTO account_field (login, f_name, status) VALUES (?,?,?)');
                                        $sql3->execute([$login,$v,$s]);
                                        }
                                    }

                                  
                                    echo "<script> {window.alert('修改成功');location.href='profile.php'} </script>";
                                    
                                    
                                ?>
                            </div>


                            <!-- /Start your project here-->
                            <div>
                            </div>
                        </div>
                        <div>
                            <div>
                                <div>
                                    <div>