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
                                    $sql1="select count(*) as count from newpaper_history where title='".$title."'";
                                    $result=$pdo->query($sql1);
                                    foreach($result as $row){
                                        $row["count"];
                                    }

                                    $sql2=$pdo->prepare('insert into newpaper (title,summary,auth1,auth2,auth3,auth4,auth5,uploadname) VALUES(?,?,?,?,?,?,?,?)');
                                    $sql2->execute([$title,$summary,$auth1,$auth2,$auth3,$auth4,$auth5,$row["count"].$_FILES["file"]["name"]]);
                                    foreach($field as $v){
                                        $sql3=$pdo ->prepare('INSERT INTO newpaper_field (title, f_name) VALUES (?,?)');
                                        $sql3->execute([$title,$v]);
                                    }
                                    $id="select id from newpaper where title='".$title."' and uploadname='".$row["count"].$_FILES["file"]["name"]."' ";
                                    $paper_id=$pdo->query($id);
                                    foreach($paper_id as $pid){
                                        $pid["id"];
                                    }

                                    $sql4=$pdo->prepare('insert into newpaper_history (id,title,summary,auth1,auth2,auth3,auth4,auth5,uploadname) VALUES(?,?,?,?,?,?,?,?,?)');
                                    $sql4->execute([$pid["id"],$title,$summary,$auth1,$auth2,$auth3,$auth4,$auth5,$row["count"].$_FILES["file"]["name"]]);
                                    
                                    
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
                                        $filename=$_FILES["file"]["name"];
                                        $name= explode('.',$filename);
                                        $newname=$title.'r'.$row["count"].'.'.$name[1];
                                        $odlname=$_FILES["file"]["tmp_name"];

                                        if ($_FILES["file"]["error"] > 0){
                                            echo "Error: " . $_FILES["file"]["error"];
                                        }else{
                                            echo "檔案名稱: " . $newname."<br/>";
                                            echo "檔案類型: " . $_FILES["file"]["type"]."<br/>";
                                            echo "檔案大小: " . ($_FILES["file"]["size"] / 1024)." Kb<br />";
                                            echo "暫存名稱: " . $_FILES["file"]["tmp_name"];
                                            move_uploaded_file($_FILES["file"]["tmp_name"],"upload/".$newname);
                                        }
                                    ?> 

                                
                                </div> <!-- end card-box -->
                            </div> <!-- end col -->
                        </div><!-- end row -->                
                    </div> <!-- container -->
    </div> <!-- content -->
</div>        