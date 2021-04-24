<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>管理者</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="../assets/images/favicon.ico">

        <!-- third party css -->
        <link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- third party css end -->

		<!-- App css -->
		<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
		<link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

		<link href="../assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
		<link href="../assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

		<!-- icons -->
		<link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    </head>
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
                                <div class="card">
                                        <!--form group -->
                                        <form action="addaccount-output.php" method="post" class="mt-3">
                                            <div style="margin: 25px 120px 120px">
                                                <!--input -->
                                                <div class="form-group">
                                                    <label for="name">姓名</label>
                                                    <input type="text" class="form-control" name="name" placeholder="請輸入真實姓名">
                                                </div>
                                                <!--input -->
                                                <div class="form-group">
                                                    <label for="email">email</label>
                                                    <input type="text" class="form-control" name="email">
                                                </div>
                                                <div class="form-group">
                                                    <label for="login">帳號</label>
                                                    <input type="text" class="form-control" name="login">
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">密碼</label>
                                                    <input type="text" class="form-control" name="password" >
                                                </div>
                                                <div class="p-sm-3">
                                                    <div class="checkbox checkbox-blue checkbox-circle form-check-inline">
                                                        <input type="checkbox" id="writer" value="投稿者" name="status[]" checked="">
                                                        <label for="writer" style="font-size: large;">投稿者</label>
                                                    </div>
                                                    <div class="checkbox checkbox-blue checkbox-circle form-check-inline">
                                                        <input type="checkbox" id="professor" value="審稿者" name="status[]">
                                                        <label for="professor" style="font-size: large;">審稿者 </label>
                                                    </div>
                                                    <div class="checkbox checkbox-blue checkbox-circle form-check-inline">
                                                        <input type="checkbox" id="manager" value="管理者" name="status[]">
                                                        <label for="manager" style="font-size: large;">管理者 </label>
                                                    </div>
                                                </div>
                                                <div  style="background-color: whitesmoke; padding: 1px;">
                                                
                                                <div style="margin-top: 3px;">
                                                    <div class="col-6 float-right">
                                                        <div class="checkbox mb-2">  
                                                            <input type="checkbox" id="f1" value='管理與政策' name="field[]">
                                                            <label for="f1"> 管理與政策 </label>
                                                        </div>
                                                        <div class="checkbox mb-2">
                                                            <input type="checkbox" id="f2" value='國際企業' name="field[]">
                                                            <label for="f2"> 國際企業 </label>
                                                        </div>
                                                        <div class="checkbox mb-2">
                                                            <input type="checkbox" id="f3" value='行銷管理' name="field[]">
                                                            <label for="f3"> 行銷管理 </label>
                                                        </div>
                                                        <div class="checkbox mb-2">
                                                            <input type="checkbox" id="f4" value='國際貿易' name="field[]">
                                                            <label for="f4"> 國際貿易 </label>
                                                        </div>
                                                        <div class="checkbox mb-2">
                                                            <input type="checkbox" id="f5" value='生產與作業管理' name="field[]">
                                                            <label for="f5"> 生產與作業管理 </label>
                                                        </div>
                                                        <div class="checkbox mb-2">
                                                            <input type="checkbox" id="f6" value="統計" name="field[]">
                                                            <label for="f6"> 統計 </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="checkbox mb-2">
                                                            <input type="checkbox" id="f7" value="人力資源管理" name="field[]">
                                                            <label for="f7"> 人力資源管理 </label>
                                                        </div>
                                                        <div class="checkbox mb-2">
                                                            <input type="checkbox" id="f8" value="數量方法" name="field[]">
                                                            <label for="f8"> 數量方法 </label>
                                                        </div>
                                                        <div class="checkbox mb-2">
                                                            <input type="checkbox" id="f9" value="資訊管理" name="field[]">
                                                            <label for="f9"> 資訊管理 </label>
                                                        </div>
                                                        <div class="checkbox mb-2">
                                                            <input type="checkbox" id="f10" value="會計" name="field[]">
                                                            <label for="f10"> 會計 </label>
                                                        </div>
                                                        <div class="checkbox mb-2">
                                                            <input type="checkbox" id="f11" value="財務管理" name="field[]">
                                                            <label for="f11"> 財務管理 </label>
                                                        </div>
                                                        <div class="checkbox mb-2">
                                                            <input type="checkbox" id="f12" value="審計" name="field[]">
                                                            <label for="f12"> 審計 </label>
                                                        </div>
                                                    </div> 
                                                </div>
                                                   
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="date">創建日期：</label>
                                                    <?php $date=date("Y/m/d"); echo $date; ?>
                                                </div>
                                                
                                                <div class="form-group mt-5 float-right">
                                                    <input class="form-control" type="submit" placeholder="submit" style="background-color:#e0f2f1">
                                                </div>
                                            </div>
                                            
                                        </form>
                                        <!-- form group -->
                                </div> <!-- end card-->
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

        <!-- Todo app -->
        <script src="../assets/js/pages/jquery.todo.js"></script>

        <!-- third party js -->
        <script src="../assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="../assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="../assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
        <!-- third party js ends -->
        
        <!-- Tickets js -->
        <script src="../assets/js/pages/tickets.js"></script>

        <!-- App js -->
        <script src="../assets/js/app.min.js"></script>
        
    </body>
</html>