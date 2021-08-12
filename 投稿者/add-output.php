<?php include "nav.php"?>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card-box">
                    <?php
                        $title=$_POST["title"];
                        $field=$_POST["field"];
                        $summary=$_POST["summary"];
                        $auth1=$_POST["auth1"];
                        $auth2=$_POST["auth2"];
                        $auth3=$_POST["auth3"];
                        $auth4=$_POST["auth4"];
                        $auth5=$_POST["auth5"];
                        $uploadtime="";
                        
                    
                        $pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');
                        $sql7=$pdo->query("select title,level,uploader from totalreply where title= '".$title."' AND replycount=(SELECT MAX(replycount) from totalreply where title='".$title."')");
                        foreach($sql7 as $s7){
                            $level = $s7['level'];
                            $uploader = $s7['uploader'];
                            $stitle = $s7['title'];
                        }

                        if( isset($stitle) && $level == '接受' && $uploader == $login){
                            echo "<script> {window.alert('稿件標題已接受，請去歷史稿件中查詢結果');location.href='history.php'} </script>";
                        }else if( isset($stitle) && ($level == '大幅修改' || $level == '小幅修改') && $uploader == $login){
                            echo "<script> {window.alert('請到回覆修正檔的介面上傳回覆');location.href='seereply.php'} </script>";
                        }else if( isset($stitle) && $stitle == $title && $uploader != $login){
                            echo "<script> {window.alert('稿件標題已重複，請更改稿件名稱');location.href='add.php'} </script>";
                        }else{
                        $sql1="select count(*) as count from newpaper_history where title='".$title."'";
                        $result=$pdo->query($sql1);
                        foreach($result as $row){
                            $row["count"];
                        }
                        $filename=$_FILES["file"]["name"];
                        $name= explode('.',$filename);
                        $newname=$title.'r'.$row["count"].'.'.$name[1];

                        $sql2=$pdo->prepare('insert into newpaper (title,uploader,summary,auth1,auth2,auth3,auth4,auth5,uploadname) VALUES(?,?,?,?,?,?,?,?,?)');
                        $sql2->execute([$title,$login,$summary,$auth1,$auth2,$auth3,$auth4,$auth5,$newname]);
                        
                        $sql6=$pdo->query("select f_name from newpaper_field where title='".$title."'");
                        foreach($sql6 as $f){
                            $f_name[]=$f["f_name"];
                        }
                        
                        if(isset($f_name) && (implode(',',$f_name) != implode(',',$field))){
                            $sql8=$pdo ->prepare("delete from newpaper_field where title=?");
                            $sql8->execute([$title]);

                            foreach($field as $v){
                                $sql3=$pdo ->prepare('INSERT INTO newpaper_field (title, f_name) VALUES (?,?)');
                                $sql3->execute([$title,$v]);
                            }
                        }else{
                            foreach($field as $v){
                                $sql3=$pdo ->prepare('INSERT INTO newpaper_field (title, f_name) VALUES (?,?)');
                                $sql3->execute([$title,$v]);
                            }
                        }
                        
                        $id="select id from newpaper where title='".$title."' and uploadname='".$newname."' ";
                        $paper_id=$pdo->query($id);
                        foreach($paper_id as $pid){
                            $pid["id"];
                        }

                        $sql4=$pdo->prepare('insert into newpaper_history (id,title,uploader,summary,auth1,auth2,auth3,auth4,auth5,uploadname) VALUES(?,?,?,?,?,?,?,?,?,?)');
                        $sql4->execute([$pid["id"],$title,$login,$summary,$auth1,$auth2,$auth3,$auth4,$auth5,$newname]);
                        
                        
                    ?>
                            <div class="form-group mb-3">
                                <label for="product-name" style="font-size: 20px;"><?php echo "新增成功!";?></label>
                            </div>
                            <div class="form-group mb-3">
                                <div class="card-header border-0 font-weight-bold d-flex justify-content-between">標題</div><br>
                                <td><?php echo $_REQUEST['title']?></td>
                            </div>
                            <div class="form-group mb-3">
                                <div class="card-header border-0 font-weight-bold d-flex justify-content-between">作者</div><br>
                                <div style="font-family:Microsoft JhengHei;color: #1c2a48; margin-bottom: 0px;font-weight: 520">
                                <td>
                                    <?php echo $_REQUEST['auth1']?>
                                    <?php echo $_REQUEST['auth2']?>
                                    <?php echo $_REQUEST['auth3']?>
                                    <?php echo $_REQUEST['auth4']?>
                                    <?php echo $_REQUEST['auth5']?>
                                </td>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="card-header border-0 font-weight-bold d-flex justify-content-between">摘要</div><br>
                                <td><?php $Summary=nl2br($summary); echo $Summary; ?></td>
                            </div>
                            <div class="form-group mb-3">
                                <div class="card-header border-0 font-weight-bold d-flex justify-content-between">領域</div><br>
                                <td><font color=navy><?php echo implode(',',$field) ?></font></td>
                            </div>
                        <?php
                            
                            // $odlname=$_FILES["file"]["tmp_name"];

                            if ($_FILES["file"]["error"] > 0){
                                "Error: " . $_FILES["file"]["error"];
                            }else{
                                "檔案名稱: " . $newname."<br/>";
                                "檔案類型: " . $_FILES["file"]["type"]."<br/>";
                                "檔案大小: " . ($_FILES["file"]["size"] / 1024)." Kb<br />";
                                "暫存名稱: " . $_FILES["file"]["tmp_name"];
                                move_uploaded_file($_FILES["file"]["tmp_name"],"upload/".$newname);
                            }

                            $sql5 = $pdo->query("select email from account where status='管理者'");
                            foreach($sql5 as $row){

                                $to_email = $row['email'];
                                $subject = '新上傳的投稿文章:'.$title;
                                $message = '請盡速到管理平台分配稿件。';
                                $headers = 'From: 408402511@gapp.fju.edu.tw';

                                mail($to_email,$subject,$message,$headers);
                            }
                        }
                        ?>
                    </div> <!-- end card-box -->
                </div> <!-- end col -->
            </div><!-- end row -->                
        </div> <!-- container -->
    </div> <!-- content -->
</div>        