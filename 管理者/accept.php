<?php

$accept = $_GET['accept'];
$id = $_GET['id'];
$reviewer = $_GET['reviewer'];


$pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');
foreach($pdo->query("select accept,id,title,uploader,auth1,auth2,auth3,auth4,auth5,summary,filename from distri where id='".$id."' and pro='".$reviewer."'") as $row){
    $YesNoNull = $row['accept'];
    $id=$row['id'];
    $title=$row['title'];
    $uploader=$row['uploader'];
    $auth1=$row['auth1'];
    $auth2=$row['auth2'];
    $auth3=$row['auth3'];
    $auth4=$row['auth4'];
    $auth5=$row['auth5'];
    $summary=$row['summary'];
    $filename=$row['filename'];

    // 首先，確認是否曾經回覆過，如果沒有就錄入資料庫；反之如果之前回覆過，就不能再回覆。
    if($YesNoNull == null){
        
        switch($accept){

            case 0:  //審稿者拒絕

                //將distri_history的accept欄位update為0
                $sql1=$pdo->prepare("update distri_history set accept=? where pro=? and id=? ");
                $sql1->execute([$accept,$reviewer,$id]);

                //將distri中的該稿件刪除
                $sql2=$pdo ->prepare("DELETE from distri where distri.pro=? and distri.id=?");
                $sql2->execute([$reviewer,$id]);

                
                //先從newpaper_history找出該稿件的投稿日期
                foreach ($pdo->query("select uploadtime from newpaper_history where id='".$id."'") as $row) {
                    $uploadtime=$row['uploadtime'];
                };

                // 回頭新增一份到newpaper
                $sql3=$pdo ->prepare("INSERT INTO newpaper (id,title,uploader,auth1,auth2,auth3,auth4,auth5,summary,uploadtime,uploadname) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
                $sql3->execute([$id,$title,$uploader,$auth1,$auth2,$auth3,$auth4,$auth5,$summary,$uploadtime,$filename]);
 
                break;


            case 1: //審稿者接受
                $sql4=$pdo->prepare("update distri set accept=? where pro=? and id=? ");
                $sql4->execute([$accept,$reviewer,$id]);

                $sql5=$pdo->prepare("update distri_history set accept=? where pro=? and id=? ");
                $sql5->execute([$accept,$reviewer,$id]);      
                break;
        };
        // 如果資料庫確認有更新，要提示回覆成功；反之要提示回覆失敗
        if(isset($sql1,$sql2,$sql3)){
            if($sql1->execute([$accept,$reviewer,$id]) && $sql2->execute([$reviewer,$id]) && $sql3->execute([$id,$title,$uploader,$auth1,$auth2,$auth3,$auth4,$auth5,$summary,$uploadtime,$filename])){
                echo "<script> {window.alert('回覆成功，謝謝您的回覆！');location='http://fjmr.fju.edu.tw'} </script>";
            }else{
                echo "<script> {window.alert('回覆失敗，煩請email聯繫我們以回報問題！');location='http://fjmr.fju.edu.tw'} </script>";
            };
        }else{
            if($sql4->execute([$accept,$reviewer,$id]) && $sql5->execute([$accept,$reviewer,$id])){
                echo "<script> {window.alert('回覆成功，謝謝您的回覆！');location='http://fjmr.fju.edu.tw'} </script>";
            }else{
                echo "<script> {window.alert('回覆失敗，煩請email聯繫我們以回報問題！');location='http://fjmr.fju.edu.tw'} </script>";
            };
        };
        

        
        
    }else{ //已經回覆過yes or no，畫面跳轉到平台登入畫面
        echo "<script> {window.alert('您已經回覆過是否同意審稿，若您忘記還請上輔仁管理評論確認狀態！');location='http://fjmr.fju.edu.tw/login/login.php'} </script>";
    };
};
?>