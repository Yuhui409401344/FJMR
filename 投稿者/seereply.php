<?php include "nav.php"?>
<?php 
session_start();
$password=$_SESSION["account"]["password"];
$login=$_SESSION["account"]["login"];
?>
<div class="content-page">
<div class="content">

    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
            <?php
            $pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');
            // foreach ($pdo->query("select title, level, filename, replycount, replytime, message from totalreply where auth1=(select  distinct name from account where login='".$login."')
            //  or auth2=(select distinct name from account where login='".$login."') 
            //  or auth3=(select distinct name from account where login='".$login."') 
            //  or auth4=(select distinct name from account where login='".$login."')
            //  or auth5=(select distinct name from account where login='".$login."')
            // ") as $row) {
                foreach ($pdo->query("select title, level, filename, replycount, replytime, message, have_reply from totalreply where uploader='".$login."' order by replytime DESC") as $row) {
                    $title=$row['title'];
                    $level=$row['level'];
                    $filename=$row['filename'];
                    $replycount=$row['replycount'];
                    $replytime=$row['replytime'];
                    $message=$row['message'];
                    $have_reply=$row['have_reply'];
                ?>
            <div>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="border border-light p-2 mb-3">

                                    <div class="font-16 text-left  text-dark" >
                                        <label style="font-size: 20px;"><font color="#8E8E8E"><?php echo $title ?></font></label></br>
                                        <label style="font-size: 8px;"><font color="#8E8E8E">第<?php echo  $replycount+1 ?>次回覆</font></label>
                                        <label style="font-size: 8px;"><font color="#8E8E8E"><?php echo  $replytime?></font></label>
                                    </div>
                                    <div>
                                        <font size="5">
                                            <?php if ($level=="接受") echo "<span class='badge badge-soft-success'>接受</span>";
                                                elseif ($level=="小幅修改") echo "<span class='badge badge-soft-primary'>小幅修改</span>";
                                                elseif ($level=="大幅修改") echo "<span class='badge badge-soft-warning'>大幅修改</span>";
                                                else echo "<span class='badge badge-soft-danger'>拒絕</span>";
                                            ?>
                                        </font></br></br>
                                    
                                    <label style="font-size: 14px;"><?php echo $message ?></label>
                                    </div>
                                                      
                                    <?php
                                    if($have_reply == '1'){ 
                                    if ($level =='小幅修改' or $level =='大幅修改'){
                                    ?>
                                        <div class="mt-2">
                                            <a href="../管理者/upload/<?php echo $filename ?>"  target="blank" download="<?php echo $filename ?>"  class="text-muted  mt-2"><i class="mdi mdi-download"></i>下載回覆檔</a>
                                            &nbsp;&nbsp;
                                            <a href="reply.php?title=<?php echo $title?>" class="text-muted  mt-2"><i class="mdi mdi-reply"></i>上傳修正檔</a>
                                        </div>
                                    <?php 
                                    }}else{
                                    ?>
                                        <div class="mt-2">
                                            <a href="../管理者/upload/<?php echo $filename ?>"  target="blank" download="<?php echo $filename ?>"  class="text-muted  mt-2"><i class="mdi mdi-download"></i>下載回覆檔</a>
                                        </div>
                                    <?php
                                    }
                                    ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
                
            
        </div> <!-- container -->
    </div> <!-- content -->
</div>