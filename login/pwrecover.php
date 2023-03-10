<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>忘記密碼</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/images/logo/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/logo/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/logo/favicon-16x16.png">
    <link rel="icon" href="../assets/images/logo/logo.ico" type="image/x-icon">

    <!-- App css -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="../assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="../assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

    <!-- icons -->
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="loading authentication-bg authentication-bg-pattern">

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-pattern">

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <div class="auth-logo">
                                    <a href="../home/home.php" class="logo logo-dark text-center">
                                        <span class="logo-lg">
                                            <img src="../assets/images/logo-login.png" alt="" height="62">
                                        </span>
                                    </a>

                                    <a href="../home/home.php" class="logo logo-light text-center">
                                        <span class="logo-lg">
                                            <img src="../assets/images/logo-login.png" alt="" height="62">
                                        </span>
                                    </a>
                                </div>
                                <p class="text-muted mb-4 mt-3">別擔心,我們會將您的帳號與姓名通知管理者，當您送出後請耐心等候管理者的Email回覆，並遵照指示再次進行登入。
                                </p>
                            </div>

                            <form action="pwrecover-output.php" method="post">

                                <div class="form-group mb-3">
                                    <label for="login">帳號</label>
                                    <input class="form-control" type="text" id="login" name="login" required=""
                                        placeholder="請輸入您的登入帳號">
                                </div>

                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-blue btn-block" type="submit"> 送出 </button>
                                </div>

                            </form>

                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p class="text-white-50">返回 <a href="login.php" class="text-white ml-1"><b>登入</b></a></p>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->



    <!-- Vendor js -->
    <script src="../assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="../assets/js/app.min.js"></script>

</body>

</html>