<?php include "nav.php" ?>
<?php 
session_start();
if(isset($_SESSION["account"]["login"])){
    $password=$_SESSION["account"]["password"];
    $login=$_SESSION["account"]["login"];
}

?>

<!-- Plugins css -->
<link href="../assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/libs/dropify/css/dropify.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />



<!-- Begin page -->
<div id="wrapper">

    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <?php
                        $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                        foreach ($pdo->query("select distinct name,password,email,date,bio from account left join account_bio on account.login = account_bio.login where account.login =  '".$login."' ") as $row) {
                            $name = $row['name'];
                            $password = $row['password'];
                            $email = $row['email'];
                            $date = $row['date'];
                            $bio = $row['bio'];
                          
                        }

                    ?>
                <div class="row mt-3">
                    <div class="col-lg-4 col-xl-4">
                        <div class="card-box text-center">
                            <?php 

                                foreach ($pdo->query("select photo, imgType from account_img where account_img.login =  '".$login."' ") as $row) {
                                    $img = $row['photo'];
                                    $imgType = $row['imgType'];
                                }

                                if(isset($img)){
                                    echo '<img src="data:'.$imgType.';base64,' . $img . '"   class="rounded-circle avatar-lg img-thumbnail"  />';
                                }else{
                                    echo '<img src="../assets/images/user.png"   class="rounded-circle avatar-lg img-thumbnail"  />'; 
                                }

                                ?>
                            <h4 class="mb-0"><?php echo $name ?> </h4>
                            <p class="text-muted">@ <?php echo $login ?> </p>

                            <div class="text-left mt-3">
                                <p class="text-muted mb-2 font-13"><strong>身份 :</strong>
                                    <span class="ml-2 ">
                                        <?php
                                        $pdo1 = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                        $query=$pdo1->query("SELECT status from account where login='".$login."'");
                                        $statuses=$query->fetchall();
                                        foreach($statuses as $status){
                                            print_r($status['status']);
                                            echo ' ';
                                        }
                                        ?></span>
                                </p>

                                <p class="text-muted mb-2 font-13"><strong>專長 :</strong>
                                    <span class="ml-2">
                                        <?php
                                        $pdo2 = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                        $query=$pdo2->query("SELECT distinct f_name from account_field where login='".$login."'");
                                        $datalist=$query->fetchall();
                                        foreach($datalist as $datadetail){
                                            print_r($datadetail['f_name']);
                                            echo ' ';
                                        }
                                        ?>
                                    </span>
                                </p>
                                <p class="text-muted mb-2 font-13"><strong>Email :</strong>
                                    <span class="ml-2 "><?php echo $email ?> </span>
                                </p>

                                <strong class="text-muted font-13 ">簡介 :</strong>
                                <p class="text-muted font-13 mt-1 mb-2">
                                    <?php echo $bio ?>
                                </p>
                            </div>

                        </div> <!-- end card-box -->


                    </div> <!-- end col-->

                    <div class="col-lg-8 col-xl-8">
                        <div class="card-box">
                            <ul class="nav nav-pills navtab-bg nav-justified">
                                <li class="nav-item">
                                    <a href="#aboutme" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                        個人簡歷
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#settings" data-toggle="tab" aria-expanded="false" class="nav-link">
                                        基本資料
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#img" data-toggle="tab" aria-expanded="false" class="nav-link">
                                        個人頭像
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane show active" id="aboutme">
                                    <div class="row">
                                        <h5 class="mb-4 text-uppercase col-6"><i class="mdi mdi-briefcase mr-1"></i>
                                            學經歷
                                        </h5>
                                    </div>

                                    <ul class="list-unstyled timeline-sm">
                                        <?php
                                                $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                                foreach ($pdo->query("SELECT school, department, degree, DATE_FORMAT(start_year,'%Y') as start_year, DATE_FORMAT(end_year,'%Y') as end_year, login from account_resume where login =  '".$login."'  ORDER by start_year ") as $row) {
                                                    $school = $row['school'];
                                                    $department = $row['department'];
                                                    $degree = $row['degree'];
                                                    $start_year = $row['start_year'];
                                                    $end_year = $row['end_year'];
                                                
                                                ?>
                                        <li class="timeline-sm-item">
                                            <span class="timeline-sm-date"><?php echo $start_year ?> -
                                                <?php echo $end_year ?></span>
                                            <h5 class="mt-0 mb-1"><?php echo $school ?> <?php echo $department ?></h5>
                                            <p><?php echo $degree ?></p>
                                            <div class="text-sm-right col">
                                                <a href='deleteprofile.php?login=<?php echo "$login" ?> && school=<?php echo "$school" ?>  && department=<?php echo "$department" ?>  && degree=<?php echo "$degree" ?> '
                                                    class="text-sm-right action-icon"> <i
                                                        class="mdi mdi-delete"></i></a>
                                            </div>
                                        </li>

                                        <?php 
                                                }
                                                ?>
                                    </ul>
                                    <div class="text-right">
                                        <button type="button" class="btn  btn-blue waves-effect mb-2"
                                            data-toggle="modal" data-target="#addProfile_modal">新增</button>
                                    </div>

                                </div> <!-- end tab-pane -->
                                <!-- end about me section content -->


                                <div class="tab-pane" id="img">
                                    <form action="img-output.php" method=Post enctype="multipart/form-data">
                                        <div class="row mb-2" style="height: 30%">
                                            <input type="file" data-plugins="dropify" id="file" name="file"
                                                data-default-file="../assets/images/user.png" />
                                        </div>
                                        <div class="row">
                                            <div class="col-6"><a href="profile.php"><button type="button"
                                                        class="form-control btn btn-primary waves-effect waves-light mt-2">取消</button></a>
                                            </div>
                                            <div class="col-6"><button type="submit"
                                                    class="form-control btn btn-warning waves-effect waves-light mt-2">更新</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="settings">
                                    <form action="change-profile-output.php" method=Post enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="firstname">姓名</label>
                                                    <input type="text" class="form-control" id="firstname" name='name_'
                                                        value="<?php echo $name ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="lastname">帳號</label>
                                                    <input type="text" style="color:darkblue" class="form-control"
                                                        id="lastname" name='account' value="<?php echo $login?>"
                                                        readonly>
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->



                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="userpassword">密碼</label>
                                                    <input type="text" class="form-control" id="userpassword"
                                                        name="password" value="<?php echo $password ?>">
                                                </div>
                                            </div> <!-- end col -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="useremail">Email</label>
                                                    <input type="email" class="form-control" id="useremail" name="email"
                                                        value="<?php echo $email ?>">
                                                </div>
                                            </div>
                                        </div> <!-- end row -->
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div>
                                                        <div style="margin-top: 3px;">
                                                            <?php
                                                                    
                                                                    $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                                                    $subject=['人力資源管理','數量方法','資訊管理','會計','財務管理','審計','管理與政策','國際企業','行銷管理','國際貿易','生產與作業管理','統計'];
                                                                    $query=$pdo->query("SELECT f_name from account_field where login='".$login."'");
                                                                    $datalist=$query->fetchall();
                                                                    foreach($datalist as $datadetail){
                                                                        $arr[]=$datadetail['f_name'];
                                                                    }
                                                                    if(empty($arr)){
                                                                        $arr = [];
                                                                    }
                                                                    ?>
                                                        </div>
                                                    </div>
                                                    <label>領域</label>
                                                    <div style="background-color: whitesmoke; padding: 1px;">

                                                        <div class="mt-2">
                                                            <div class="col-6 float-right" style="padding-right: 0px">
                                                                <div class="checkbox mb-2">
                                                                    <input type="checkbox" id="f1" name="field[]"
                                                                        value="<?php echo "管理與政策"?>"
                                                                        <?php if(in_array('管理與政策',$arr)) echo 'checked'?>>
                                                                    <label for="f1"> 管理與政策 </label>
                                                                </div>
                                                                <div class="checkbox mb-2">
                                                                    <input type="checkbox" id="f2" name="field[]"
                                                                        value="<?php echo "國際企業"?>"
                                                                        <?php if(in_array('國際企業',$arr)) echo 'checked'?>>
                                                                    <label for="f2"> 國際企業 </label>
                                                                </div>
                                                                <div class="checkbox mb-2">
                                                                    <input type="checkbox" id="f3" name="field[]"
                                                                        value="<?php echo "行銷管理"?>"
                                                                        <?php if(in_array('行銷管理',$arr)) echo 'checked'?>>
                                                                    <label for="f3"> 行銷管理 </label>
                                                                </div>
                                                                <div class="checkbox mb-2">
                                                                    <input type="checkbox" id="f4" name="field[]"
                                                                        value="<?php echo "國際貿易"?>"
                                                                        <?php if(in_array('國際貿易',$arr)) echo 'checked'?>>
                                                                    <label for="f4"> 國際貿易 </label>
                                                                </div>
                                                                <div class="checkbox mb-2">
                                                                    <input type="checkbox" id="f3" name="field[]"
                                                                        value="<?php echo "生產與作業管理"?>"
                                                                        <?php if(in_array('生產與作業管理',$arr)) echo 'checked'?>>
                                                                    <label for="f3"> 生產與作業管理 </label>
                                                                </div>
                                                                <div class="checkbox mb-2">
                                                                    <input type="checkbox" id="f6" name="field[]"
                                                                        value="<?php echo "統計"?>"
                                                                        <?php if(in_array('統計',$arr)) echo 'checked'?>>
                                                                    <label for="f6"> 統計 </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-6" style="padding-right: 0px">
                                                                <div class="checkbox mb-2">
                                                                    <input type="checkbox" id="f7" name="field[]"
                                                                        value="<?php echo "人力資源管理"?>"
                                                                        <?php if(in_array('人力資源管理',$arr)) echo 'checked'?>>
                                                                    <label for="f7"> 人力資源管理 </label>
                                                                </div>
                                                                <div class="checkbox mb-2">
                                                                    <input type="checkbox" id="f8" name="field[]"
                                                                        value="<?php echo "數量方法"?>"
                                                                        <?php if(in_array('數量方法',$arr)) echo 'checked'?>>
                                                                    <label for="f8"> 數量方法 </label>
                                                                </div>
                                                                <div class="checkbox mb-2">
                                                                    <input type="checkbox" id="f9" name="field[]"
                                                                        value="<?php echo "資訊管理"?>"
                                                                        <?php if(in_array('資訊管理',$arr)) echo 'checked'?>>
                                                                    <label for="f9"> 資訊管理 </label>
                                                                </div>
                                                                <div class="checkbox mb-2">
                                                                    <input type="checkbox" id="f10" name="field[]"
                                                                        value="<?php echo "會計"?>"
                                                                        <?php if(in_array('會計',$arr)) echo 'checked'?>>
                                                                    <label for="f10"> 會計 </label>
                                                                </div>
                                                                <div class="checkbox mb-2">
                                                                    <input type="checkbox" id="f11" name="field[]"
                                                                        value="<?php echo "財務管理"?>"
                                                                        <?php if(in_array('財務管理',$arr)) echo 'checked'?>>
                                                                    <label for="f11"> 財務管理 </label>
                                                                </div>
                                                                <div class="checkbox mb-2">
                                                                    <input type="checkbox" id="f12" name="field[]"
                                                                        value="<?php echo "審計"?>"
                                                                        <?php if(in_array('審計',$arr)) echo 'checked'?>>
                                                                    <label for="f12"> 審計 </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="userbio">簡介（300字以內）</label>
                                                    <textarea class="form-control" id="userbio" rows="4" name="bio"
                                                        style="height:100px"><?php echo $bio ?></textarea>
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->
                                        <div class="row">
                                            <div class="col-6"><a href="profile.php"><button type="button"
                                                        class="form-control btn btn-primary waves-effect waves-light mt-2">取消</button></a>
                                            </div>
                                            <div class="col-6"><button type="submit"
                                                    class="form-control btn btn-warning waves-effect waves-light mt-2">更新</button>
                                            </div>


                                        </div>



                                    </form>
                                </div>
                                <!-- end settings content-->

                            </div> <!-- end tab-content -->
                        </div> <!-- end card-box-->

                    </div> <!-- end col -->
                </div>
                <!-- end row-->
            </div> <!-- container -->
        </div> <!-- content -->
    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->
<<<<<<< HEAD
=======

>>>>>>> 3782ebd8be763b8c54c1fe401dbec69e46ee9201

</div>
<!-- END wrapper -->

</div>
<!-- END wrapper -->




<script src="../assets/js/pages/inbox.js"></script>

<!-- picker -->
<script src="../assets/libs/flatpickr/flatpickr.min.js"></script>
<script src="../assets/js/pages/form-pickers.init.js"></script>
<script src="../assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<!-- Plugins js -->
<script src="../assets/libs/dropzone/min/dropzone.min.js"></script>
<script src="../assets/libs/dropify/js/dropify.min.js"></script>

<!-- Init js-->
<script src="../assets/js/pages/form-fileuploads.init.js"></script>

<!-- <script>
           $(document).ready(function(){
               $('.view_data').click(function(){
                   var login = $(this).attr("id");
                   console.log(login);

                   $.ajax({
                       url:"addProfile.php",
                       method:"POST",
                       data:{
                            login: login,
                            school: school,
                            department: department,
                            degree: degree,
                           },
                       success:function(data){
                            $('#addProfile').html(data);
                            $('#addProfile_modal').modal("show");
                       }
                   })
                    $('#addProfile_modal').modal("show");
               });
           });
        </script> -->


<!-- Modal -->
<div class="modal fade" id="addProfile_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title" id="myCenterModalLabel">新增學歷</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body p-4">
                <form action="addProfile.php" method="post">
                    <div class="form-group">
                        <label for="school">學校</label>
                        <input type="text" class="form-control" id="school" name="school">
                    </div>
                    <div class="form-group">
                        <label for="department">系所</label>
                        <input type="text" class="form-control" id="department" name="department">
                    </div>
                    <div class="form-group">
                        <label for="degree">學位</label>
                        <input type="text" class="form-control" id="degree" name="degree" placeholder="學士\碩士\博士">
                    </div>
                    <div class="form-group">
                        <label>起始時間</label>
                        <input type="text" class="form-control" name="start_year" data-provide="datepicker"
                            data-date-format="yyyy-mm-dd">
                    </div>
                    <div class="form-group">
                        <label>結束時間</label>
                        <input type="text" class="form-control" name="end_year" data-provide="datepicker"
                            data-date-format="yyyy-mm-dd">
                    </div>

                    <div class="text-right">
                        <button type="button" class="btn btn-primary waves-effect waves-light m-l-10"
                            onclick=" $('#addProfile_modal').modal('hide')">取消</button>
                        <button type="submit" class="btn btn-warning waves-effect waves-light">送出</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->