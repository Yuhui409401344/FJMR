<?php
session_start();
if (isset($_SESSION["account"]["login"])) {
    $password = $_SESSION["account"]["password"];
    $login = $_SESSION["account"]["login"];
}

?>
<style type="text/css">
    .navbar .dropdown-menu {
        background-color: #2e3951;
        border-top: 0px;
    }
    #change{
        color: #fff;;
    }
    #change:hover{
        color:black
    }
</style>

<head>
    <link rel="icon" href="img/logo-FJMR.ico" type="image/x-icon">
    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico">

    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="css/mdb.min.css">

    <!-- App css -->

    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <!-- icons -->
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>

<header style="margin-bottom:55px">
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark mdb-color darken-2  fixed-top">

        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">輔仁管理評論</a>
            <!-- Collapse button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Collapsible content -->
            <div class="collapse navbar-collapse" id="basicExampleNav">
                <!-- Links -->
                <ul class="navbar-nav mr-auto" style="font-size:initial">
                    <li class="nav-item dropdown">
                        <a data-toggle="dropdown" class="nav-link w-100" aria-haspopup="true" aria-expanded="false">
                            <span>關於<i class="mdi mdi-chevron-down"></i> </span>
                        </a>
                        <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                            <a id="change" class="dropdown-item" href="purpose.php">成立宗旨</a>
                            <a id="change" class="dropdown-item" href="editors.php">編輯群</a>
                            <a id="change" class="dropdown-item" href="subscribe.php">訂閱方式</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a data-toggle="dropdown" class="nav-link w-100" aria-haspopup="true" aria-expanded="false">投稿<i class="mdi mdi-chevron-down"></i> </a>
                        <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                            <a id="change" class="dropdown-item" href="papersubmission.php">徵稿說明</a>
                            <a id="change" class="dropdown-item" href="format.php">稿約格式</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link waves-effect waves-light" href="All.php">所有刊物</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link waves-effect waves-light" href="contact.php">聯繫我們</a>
                    </li>
                </ul>


                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <?php
                        if (isset($_SESSION["account"]["login"]) && $login != "") {
                        ?>
                            <a data-toggle="dropdown" class="nav-link " aria-haspopup="true" aria-expanded="false" style="font-size:14px;"><i class="fas fa-user-alt"></i><?php echo $login ?><i class="mdi mdi-chevron-down"></i> </a>
                            <div class="dropdown-menu dropdown-primary">
                                <?php
                                $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                $sql = $pdo->query("select status from account where login='" . $login . "'");
                                foreach ($sql as $row) {
                                    $status = $row["status"];

                                    if ($status == "投稿者") {
                                ?>
                                        <a id="change" class="dropdown-item" href="../投稿者/format.php" style="font-size:14px;">
                                            投稿者系統
                                        </a>
                                    <?php
                                    } elseif ($status == "審稿者") {
                                    ?>
                                        <a id="change" class="dropdown-item" href="../審稿者/dashboard.php" style="font-size:14px;">
                                            審稿者系統
                                        </a>
                                    <?php
                                    } else {
                                    ?>
                                        <a id="change" class="dropdown-item" href="../管理者/index.php?method=maildistribution" style="font-size:14px;">
                                            管理者系統
                                        </a>
                                <?php
                                    }
                                }
                                ?>
                                <a id="change" href="../login/logout-output.php" class="dropdown-item notify-item" style="font-size:14px;">
                                    <span>登出</span>
                                </a>
                            </div>
                        <?php

                        } else {
                        ?>
                            <a class="nav-link" href="../login/login.php" style="font-size:14px;">
                                <i class="fas fa-sign-in-alt"></i> 登入
                            </a>
                        <?php
                        }
                        ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://www.management.fju.edu.tw/" target="blank" style="font-size: 14px;">
                            <i class="fas fa-graduation-cap"></i> 輔大管理學院
                        </a>
                    </li>
                    </li>
                    <a class="nav-link waves-effect waves-light" style="font-size: small;" href="../home(en)/home.php">English</a>
                    </li>
                </ul>
            </div>
        </div>

    </nav>
    <!-- Navbar -->
</header>