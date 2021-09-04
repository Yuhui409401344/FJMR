<!DOCTYPE html>
<html lang="en">
    <body class="loading">

        <!-- Begin page -->
        <div id="wrapper">
            <?php include "nav.php" ?>
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
          <div class="content-page">
              <div class="content">
                <div class="container-fluid">
                    <div class="row mt-3">
                      <div class="col-lg-12">
                          <form method="post" action="reply-output.php" enctype="multipart/form-data">
                            <div class="card-box">
                            <?php
                            $title = $_GET['title'];

                            $pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');

                            $sql = $pdo->query("select * from newpaper_history where title = '".$title."'");
                            foreach($sql as $row){
                              $auth1 = $row['auth1'];
                              $auth2 = $row['auth2'];
                              $auth3 = $row['auth3'];
                              $auth4 = $row['auth4'];
                              $auth5 = $row['auth5'];
                              $summary = $row['summary'];
                            }
                            $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                            $subject=['人力資源管理','數量方法','資訊管理','會計','財務管理','審計','管理與政策','國際企業','行銷管理','國際貿易','生產與作業管理','統計'];
                            $query=$pdo->query("SELECT f_name from newpaper_field where title = '".$title."'");
                            $datalist=$query->fetchall();
                            foreach($datalist as $datadetail){
                            $arr[]=$datadetail['f_name'];
                            }
                            ?>
                                <div class="form-group mb-3 mr-4 ml-4">
                                    <label for="product-name" style="font-size: 20px;">標題<span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" value="<?php echo $title?>" required>
                                </div>
                                <div class="form-group mb-3 mr-4 ml-4">
                                    <label for="product-name" style="font-size: 20px;">作者<span class="text-danger">*</span></label>
                                    <input type="text" name="auth1" class="form-control" value="<?php echo $auth1?>" required>
                                    <div class="row mt-1"></div>
                                    <input type="text" name="auth2" class="form-control" value="<?php echo $auth2?>">
                                    <div class="row mt-1"></div>
                                    <input type="text" name="auth3" class="form-control" value="<?php echo $auth3?>">
                                    <div class="row mt-1"></div>
                                    <input type="text" name="auth4" class="form-control" value="<?php echo $auth4?>">
                                    <div class="row mt-1"></div>
                                    <input type="text" name="auth5" class="form-control" value="<?php echo $auth5?>">
                                </div>
                                <div class="form-group mb-3 mr-4 ml-4">
                                  <label for="product-summary"  style="font-size: 20px;">摘要<span class="text-danger">*</span></label>
                                  <textarea class="form-control" name="summary" rows="10" style="height:160px" value="<?php echo $summary?>" required></textarea>
                                </div>
                                <div class="form-group mb-3 mr-4 ml-4">
                                  <label class="mb-2"  style="font-size: 20px;">領域<span class="text-danger">*</span></label>
                                  <br/>
                                  <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="f1" name="field[]" value="<?php echo "管理與政策"?>"<?php if(in_array('管理與政策',$arr)) echo 'checked'?> disabled>
                                    <label class="custom-control-label" for="f1">管理與政策</label>
                                  </div>
                                  <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="f2" name="field[]" value="<?php echo "國際企業"?>"<?php if(in_array('國際企業',$arr)) echo 'checked'?> disabled>
                                    <label class="custom-control-label" for="f2">國際企業</label>
                                  </div>
                                  <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="f3" name="field[]" value="<?php echo "行銷管理"?>"<?php if(in_array('行銷管理',$arr)) echo 'checked'?> disabled>
                                    <label class="custom-control-label" for="f3">行銷管理</label>
                                  </div>
                                  <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="f4" name="field[]" value="<?php echo "國際貿易"?>"<?php if(in_array('國際貿易',$arr)) echo 'checked'?> disabled>
                                    <label class="custom-control-label" for="f4">國際貿易</label>
                                  </div>
                                  <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="f5" name="field[]" value="<?php echo "生產與作業管理"?>"<?php if(in_array('生產與作業管理',$arr)) echo 'checked'?> disabled>
                                    <label class="custom-control-label" for="f5">生產與作業管理</label>
                                  </div>
                                  <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="df6" name="field[]" value="<?php echo "統計"?>"<?php if(in_array('統計',$arr)) echo 'checked'?> disabled>
                                    <label class="custom-control-label" for="f6">統計</label>
                                  </div>
                                  <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="f7" name="field[]" value="<?php echo "人力資源管理"?>"<?php if(in_array('人力資源管理',$arr)) echo 'checked'?> disabled>
                                    <label class="custom-control-label" for="f7">人力資源管理</label>
                                  </div>
                                  <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="f8" name="field[]" value="<?php echo "數量方法"?>"<?php if(in_array('數量方法',$arr)) echo 'checked'?> disabled>
                                    <label class="custom-control-label" for="f8">數量方法</label>
                                  </div>
                                  <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="f9" name="field[]" value="<?php echo "資訊管理"?>"<?php if(in_array('資訊管理',$arr)) echo 'checked'?> disabled>
                                    <label class="custom-control-label" for="f9">資訊管理</label>
                                  </div>
                                  <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="f10" name="field[]" value="<?php echo "會計"?>"<?php if(in_array('會計',$arr)) echo 'checked'?> disabled>
                                    <label class="custom-control-label" for="f10">會計</label>
                                  </div>
                                  <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="f11" name="field[]" value="<?php echo "財務管理"?>"<?php if(in_array('財務管理',$arr)) echo 'checked'?> disabled>
                                    <label class="custom-control-label" for="f11">財務管理</label>
                                  </div>
                                  <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="f12" name="field[]" value="<?php echo "審計"?>"<?php if(in_array('審計',$arr)) echo 'checked'?> disabled>
                                    <label class="custom-control-label" for="f12">審計</label>
                                  </div>
                                </div>
                                <div class="form-group mb-3 mr-4 ml-4">
                                    <input type=file name="file" accept=".pdf,.doc" id="file">
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="text-center mb-3 mr-4 ml-4">
                                            <input type="submit"  class="btn w-sm btn-success waves-effect waves-light">
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </form>
                          
                      </div> <!-- end col -->
                    </div><!-- end row -->  
                </div> <!-- container -->
              </div> <!-- content -->
          </div>
          
        </div>
        <!-- END wrapper -->
    </body>
</html>
