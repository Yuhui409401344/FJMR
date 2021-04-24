<!DOCTYPE html>
<html lang="en">

    
  <body class="loading">
      <!-- Begin page -->
      <div id="wrapper">
          <?php include "header.php" ?>

          <!-- ============================================================== -->
          <!-- Start Page Content here -->
          <!-- ============================================================== -->

          <div class="content-page">
              <div class="content">
                  <!-- Start Content-->
                  <div class="container-fluid">
                      <div class="row mt-3">
                          <div class="col-12">
                              <!-- Start project here-->

                              <div style="height: 100vh">
                              
                                  <?php
                                    
                                    $title=$_GET["title"];
                                    $pro=$_GET["pro"];
                                    $ddl=$_GET["ddl"];
                                    $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                    foreach ($pdo->query("select * from newpaper where title='".$title."'") as $row) {
                                        
                                        $auth1=$row['auth1'];
                                        $auth2=$row['auth2'];
                                        $auth3=$row['auth3'];
                                        $auth4=$row['auth4'];
                                        $auth5=$row['auth5'];
                                        $summary=$row['summary'];
                                        $uploadname=$row['uploadname'];

                                    }
                                    
                                    $pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');
                                    foreach($pro as $a){
                                      $sql=$pdo->prepare('INSERT INTO distri (title,summary,pro,ddl,auth1,auth2,auth3,auth4,filename,auth5) VALUES(?,?,?,?,?,?,?,?,?,?)');
                                    $sql->execute([$title,$summary,$a,$ddl,$auth1,$auth2,$auth3,$auth4,$uploadname,$auth5]);
                                      }
                                   
                                    if (empty($pro)) {
                                      echo '請輸入審稿者';
                                    }elseif(empty($ddl)){
                                      echo '請輸入繳交截止日期';
                                    }else{
                                      echo "<script> {window.alert('發送成功');location.href='maildistribution.php'} </script>";
                                      $sql3=$pdo ->prepare('delete newpaper,newpaper_field from newpaper left join newpaper_field on newpaper_field.title=newpaper.title where newpaper.title=?');
                                      $sql3->execute([$title]);
                                    }
                                  ?>
                              </div>
                              <!-- /Start your project here-->

                          </div> <!-- end col -->
                      </div> <!-- end row -->
                  </div> <!-- container -->
              </div> <!-- content -->
          </div> <!-- content page -->

          <!-- ============================================================== -->
          <!-- End Page content -->
          <!-- ============================================================== -->
      </div>
      <!-- END wrapper -->

      <!-- Vendor js -->
      <script src="../assets/js/vendor.min.js"></script>

      <script src="../assets/libs/selectize/js/standalone/selectize.min.js"></script>
      <script src="../assets/libs/mohithg-switchery/switchery.min.js"></script>
      <script src="../assets/libs/multiselect/js/jquery.multi-select.js"></script>
      <script src="../assets/libs/select2/js/select2.min.js"></script>
      <script src="../assets/libs/jquery-mockjax/jquery.mockjax.min.js"></script>
      <script src="../assets/libs/devbridge-autocomplete/jquery.autocomplete.min.js"></script>
      <script src="../assets/libs/bootstrap-select/js/bootstrap-select.min.js"></script>
      <script src="../assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
      <script src="../assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>

      <!-- Init js for modal select bar-->
      <script src="../assets/js/pages/form-advanced.init.js"></script>

      <!-- Todo app -->
      <script src="../assets/js/pages/jquery.todo.js"></script>

      <!-- Footable js -->
      <script src="../assets/libs/footable/footable.all.min.js"></script>

      <!-- Init js -->
      <script src="../assets/js/pages/foo-tables.init.js"></script>

      <!-- App js -->
      <script src="../assets/js/app.min.js"></script>

      <!-- Inbox init -->
      <script src="../assets/js/pages/inbox.js"></script>

      <!-- Plugins js-->
      <script src="../assets/libs/flatpickr/flatpickr.min.js"></script>
      <script src="../assets/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
      <script src="../assets/libs/clockpicker/bootstrap-clockpicker.min.js"></script>
      <script src="../assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

      <!-- Init js for time picker-->
      <script src="../assets/js/pages/form-pickers.init.js"></script>

      
  </body>
</html>