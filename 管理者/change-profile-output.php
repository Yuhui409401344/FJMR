<?php include "nav.php"?>
<?php 
session_start();
if(isset($_SESSION["account"]["login"])){
    $login=$_SESSION["account"]["login"];
}

?>
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

                                    $pdo1 = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                    $query=$pdo1->query("SELECT status from account where login='".$login."'");
                                    $statuses=$query->fetchall();
                                    foreach($statuses as $status){
                                        $array[]=$status['status'];
                                    }
                                    
                                    
                                    $pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');
                                    $sql=$pdo ->prepare("update account set name=?, email=?, password=?  where login='".$login."'");
                                    $sql->execute([$name,$email,$password]);

                                    $sql1=$pdo ->prepare("update account_bio set bio=? where login='".$login."'");
                                    $sql1->execute([$bio]);
                                 
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