<?php
session_start();
if (isset($_SESSION["account"]["login"])) {
    $password = $_SESSION["account"]["password"];
    $login = $_SESSION["account"]["login"];
}

?>

<head>
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/images/logo/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/logo/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/logo/favicon-16x16.png">
    <link rel="icon" href="../assets/images/logo/logo.ico" type="image/x-icon">
    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico">

    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="css/mdb.min.css">

    <!-- App css -->

    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <!-- icons -->
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>
<style type="text/css">
    .navbar .dropdown-menu {
        background-color: #2e3951;
        border-top: 0px;
    }

    #change {
        color: #fff;
        ;
    }

    #change:hover {
        color: black
    }
</style>
<header style="margin-bottom:55px">
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark mdb-color darken-2  fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">FJMR</a>
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
                            <span>About<i class="mdi mdi-chevron-down"></i> </span>
                        </a>
                        <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                            <a id="change" class="dropdown-item" href="purpose.php">Aim and Scope</a>
                            <a id="change" class="dropdown-item" href="editors.php">Editorial Board</a>
                            <a id="change" class="dropdown-item" href="subscribe.php">Subscription</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a data-toggle="dropdown" class="nav-link w-100" aria-haspopup="true" aria-expanded="false">Submission<i class="mdi mdi-chevron-down"></i> </a>
                        <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                            <a id="change" class="dropdown-item" href="papersubmission.php">Guideline & Process</a>
                            <a id="change" class="dropdown-item" href="format.php">Format</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link waves-effect waves-light" href="All.php">Articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link waves-effect waves-light" href="contact.php">Contact Us</a>
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
                                            Author System
                                        </a>
                                    <?php
                                    } elseif ($status == "審稿者") {
                                    ?>
                                        <a id="change" class="dropdown-item" href="../審稿者/dashboard.php" style="font-size:14px;">
                                            Reviewer System
                                        </a>
                                    <?php
                                    } else {
                                    ?>
                                        <a id="change" class="dropdown-item" href="../管理者/index.php?method=maildistribution" style="font-size:14px;">
                                            Manager System
                                        </a>
                                <?php
                                    }
                                }
                                ?>
                                <a id="change" href="../login/logout-output.php" class="dropdown-item notify-item" style="font-size:14px;">
                                    <span>Log Out</span>
                                </a>
                            </div>
                        <?php

                        } else {
                        ?>
                            <a class="nav-link" href="../login/login.php" style="font-size:14px;">
                                <i class="fas fa-sign-in-alt"></i> LogIn
                            </a>
                        <?php
                        }
                        ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://www.management.fju.edu.tw/" target="blank" style="font-size: 14px;">
                            <i class="fas fa-graduation-cap"></i> FJUM
                        </a>
                    </li>
                    </li>
                    <a class="nav-link waves-effect waves-light" style="font-size: small;" href="../home/home.php">中文</a>
                    </li>
                </ul>
            </div>
        </div>

    </nav>
    <!-- Navbar -->
</header>