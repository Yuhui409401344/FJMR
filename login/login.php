<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Log In</title>
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

    <style>
    button:hover {
        opacity: 0.8;
    }
    </style>



</head>

<body class="loading   authentication-bg authentication-bg-pattern">

    <form action="login-output.php" method="post">
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
                                </div>

                                <form action="#">

                                    <div class="col-xl-20">
                                        <div class="card-box">
                                            <div class="form-group mb-3">

                                                <i class="fa fa-user prefix grey-text"></i>
                                                <label for="materialFormCardNameEx" class="font-weight-light">??????</label>
                                                <input type="text" name="login" class="form-control"
                                                    placeholder="???????????????">
                                            </div>
                                            <div class="form-group mb-3">
                                                <i class="fa fa-lock prefix grey-text"></i>
                                                <label for="materialFormCardPasswordEx"
                                                    class="font-weight-light">??????</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="password" name="password" class="form-control"
                                                        placeholder="???????????????">

                                                    <div class="input-group-append" data-password="false">
                                                        <div class="input-group-text">
                                                            <span class="password-eye"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="p-sm-3">
                                                <div class="radio form-check-inline">
                                                    <input type="radio" id="writer" value="?????????" name="status"
                                                        checked="">
                                                    <label for="writer" style="font-size: large;">?????????</label>
                                                </div>
                                                <div class="radio form-check-inline">
                                                    <input type="radio" id="professor" value="?????????" name="status">
                                                    <label for="professor" style="font-size: large;">????????? </label>
                                                </div>
                                                <div class="radio form-check-inline">
                                                    <input type="radio" id="manager" value="?????????" name="status">
                                                    <label for="manager" style="font-size: large;">????????? </label>
                                                </div>
                                            </div>


                                            <div class="form-group mb-0 text-center">
                                                <button class="btn button btn-block"
                                                    style="color: #ffffff; background-color: #045aaa;" type="submit"> ??????
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <!-- <div class="text-center">
                                    <h5 class="mt-1 text-muted">????????????</h5>
                                    <ul class="social-list list-inline mt-3 mb-0">
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github"></i></a>
                                        </li>
                                    </ul>
                                </div> -->

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p> <a href="pwrecover.php" class="text-white ml-1">????????????</a></p>
                                <p class="text-white-50">???????????????? <a href="register.php"
                                        class="text-white ml-1"><b>??????</b></a></p>
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

    </form>
    <!-- Vendor js -->
    <script src="../assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="../assets/js/app.min.js"></script>

</body>

</html>