<?php 
session_start();
if(isset($_SESSION["account"]["login"])){
    $password=$_SESSION["account"]["password"];
    $login=$_SESSION["account"]["login"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>投稿者</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/images/logo/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/logo/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/logo/favicon-16x16.png">
    <link rel="icon" href="../assets/images/logo/logo.ico" type="image/x-icon">

    <link href="../assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/summernote/summernote-bs4.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="../assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="../assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="loading">

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        <div class="navbar-custom">
            <div class="container-fluid">
                <ul class="list-unstyled topnav-menu float-right mb-0">


                    <li class="dropdown d-lg-inline-block ">
                        <form>
                            <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light"
                                data-toggle="fullscreen" href="#">
                                <i class="fe-maximize noti-icon"></i>
                            </a>
                        </form>
                    </li>

                    <li class="dropdown  d-lg-inline-block topbar-dropdown">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="fe-grid noti-icon"></i>
                        </a>
                        <div class="dropdown-menu dropdown-lg dropdown-menu-right">

                            <div class="p-lg-1">
                                <div class="row no-gutters">
                                    <div class="col">
                                        <a class="dropdown-icon-item"
                                            href="http://www.management.fju.edu.tw/zh-tw/research/journal.php"
                                            target="blank">
                                            <i class="fas fa-graduation-cap"></i>
                                            <span>輔仁管理評論</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="http://www.management.fju.edu.tw/"
                                            target="blank">
                                            <img src="../assets/images/logo-fju-sm.png" alt="輔仁管院">
                                            <span>輔仁管理學院</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="https://www.fju.edu.tw/" target="blank">
                                            <img src="../assets/images/brands/fju.jpg" alt="輔仁大學">
                                            <span>輔仁大學</span>
                                        </a>
                                    </div>
                                </div>

                                <div class="row no-gutters">
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="https://www.dropbox.com/zh_TW/"
                                            target="blank">
                                            <img src="../assets/images/brands/dropbox.png" alt="dropbox">
                                            <span>Dropbox</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item"
                                            href="https://workspace.google.com/intl/zh-TW/?utm_source=google&utm_medium=cpc&utm_campaign=1009153-Workspace-APAC-TW-zh-BKWS-EXA-Golden&utm_content=CMPGN_1009153+%7C+Workspace+%7C+DR+%7C+ESS01+%7C+APAC+%7C+TW+%7C+zh+%7C+Hybrid+%7C+AW+SEM+%7C+BKWS+~+Exact+%7C+Golden-ADGP_58700006377646730-KWID_43700057629356506-TERM_g+suite&gclid=CjwKCAjwz6_8BRBkEiwA3p02VfMkZNDDDvPhmMl_W3t-3fCRDaxNHViYX9t84m7kGndt3JP23BwqLRoCJmgQAvD_BwE&gclsrc=aw.ds"
                                            target="blank">
                                            <img src="../assets/images/brands/g-suite.png" alt="G Suite">
                                            <span>Google workspace</span>
                                        </a>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </li>



                    <li class="dropdown notification-list topbar-dropdown">
                        <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light"
                            data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <span>
                                <?php echo $login ?><i class="mdi mdi-chevron-down"></i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                            <?php 
                        $pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');
                        $sql=$pdo->query("select status from account where login='".$login."'");
                        foreach($sql as $row){
                            $status=$row["status"];
                        
                            if($status=="投稿者"){
                            ?>
                            <a class="dropdown-item" href="../投稿者/format.php" style="font-size: small;">
                                <i class="fe-user"></i>
                                投稿者系統
                            </a>
                            <?php
                            }elseif($status=="審稿者"){
                            ?>
                            <a class="dropdown-item" href="../審稿者/dashboard.php" style="font-size: small;">
                                <i class="fe-user"></i>
                                審稿者系統
                            </a>
                            <?php
                            }else{
                            ?>
                            <a class="dropdown-item" href="../管理者/index.php?method=maildistribution"
                                style="font-size: small;">
                                <i class="fe-user"></i>
                                管理者系統
                            </a>
                            <?php
                            }
                        }
                        ?>
                            <div class="dropdown-divider"></div>

                            <a href="profile.php" class="dropdown-item notify-item">
                                <i class="mdi mdi-account-details-outline"></i>
                                <span>我的帳號</span>
                            </a>



                            <a href="tour.php" class="dropdown-item notify-item">
                                <i class="mdi mdi-alert-circle-outline"></i>
                                <span>常見問題</span>
                            </a>

                            <!-- item-->
                            <a href="../login/logout-output.php" class="dropdown-item notify-item">
                                <i class="fe-log-out"></i>
                                <span>登出</span>
                            </a>

                        </div>
                    </li>

                    <li class="dropdown notification-list">
                        <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                            <i class="fe-settings noti-icon"></i>
                        </a>
                    </li>

                </ul>

                <!-- LOGO -->
                <div class="logo-box">
                    <a href="../home/home.php" class="logo logo-dark text-center">
                        <span class="logo-sm">
                            <img src="../assets/images/logo-fju-sm.png" alt="" height="42">
                            <!-- <span class="logo-lg-text-light">UBold</span> -->
                        </span>
                        <span class="logo-lg">
                            <img src="../assets/images/logo-fju-contributor.png" alt="" height="50">
                            <!-- <span class="logo-lg-text-light">U</span> -->
                        </span>
                    </a>

                    <a href="../home/home.php" class="logo logo-light text-center">
                        <span class="logo-sm">
                            <img src="../assets/images/logo-fju-sm.png" alt="" height="42">
                        </span>
                        <span class="logo-lg">
                            <img src="../assets/images/logo-fju-contributor.png" alt="" height="50">
                        </span>
                    </a>
                </div>

                <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li>
                        <button class="button-menu-mobile waves-effect waves-light">
                            <i class="fe-menu"></i>
                        </button>
                    </li>
                </ul>


                <div class="clearfix"></div>
            </div>
        </div>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left-side-menu">

            <div class="h-100" data-simplebar>
                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <ul id="side-menu">
                        <li>
                            <a href="#sidebarwrite" data-toggle="collapse">
                                <i data-feather="edit"></i>
                                <span>投稿</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarwrite">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="add.php">新增投稿</a>
                                    </li>
                                    <li>
                                        <a href="seereply.php">回覆修正檔 </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="format.php">
                                <i data-feather="clipboard"></i>
                                <span> 稿約格式 </span>
                            </a>
                        </li>
                        <li>
                            <a href="history.php">
                                <i data-feather="clock"></i>
                                <span> 歷史稿件 </span>
                            </a>
                        </li>

                    </ul>
                </div>
                <!-- End Sidebar -->

                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">
                    <div class="row mt-3">
                        <div class="col-xl-6">
                            <div class="card-box">
                                <h4 class="header-title mb-4 ">中文版格式</h4>

                                <ul class="nav nav-tabs nav-bordered">
                                    <li class="nav-item">
                                        <a href="#ch-1" data-toggle="tab" aria-expanded="false" class="nav-link">
                                            段落標明方式
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#ch-2" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                            字體
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#ch-3" data-toggle="tab" aria-expanded="false" class="nav-link">
                                            注釋
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#ch-4" data-toggle="tab" aria-expanded="false" class="nav-link">
                                            文獻引用
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#ch-5" data-toggle="tab" aria-expanded="false" class="nav-link">
                                            圖表
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane" id="ch-1">
                                        <pre class="panel-body" style='background-color: #FFFFFF'>

壹、導論

一、研究設計

（一）設計量表

    1. 可信度

    （1）
        a………
            （a）………</pre>
                                        <p>第一層標題：中黑體17pt，粗體，置中。<br>
                                            第二層標題：中黑體16pt，粗體，左右對齊。<br>
                                            第三層標題：中黑體13pt，粗體，左右對齊。<br>
                                            第四層標題：細明體11pt，粗體，左右對齊。</p>
                                    </div>
                                    <div class="tab-pane show active" id="ch-2">
                                        <p>
                                            <br>
                                            1. 題目：粗黑體22pt，置中。<br>
                                            2. 作者姓名：細明體14pt，粗體，置中。<br>
                                            3. 摘要標題：中黑體12pt，靠左；摘要內容：細明體9pt。<br>
                                            4. 關鍵字：標楷體9pt。<br>
                                            5. 內文：細明體11pt，分段落，左右對齊。<br>
                                            6. 行距：最小行高18pt。
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="ch-3">
                                        <p>
                                            <br>
                                            附註於頁底。如下例：
                                            <br>
                                            <br>
                                            出現超常報酬的期間與出現成交量殘差為正值的期間無關。2 <br>
                                            <br>
                                            2在Crouch（1970）及（1980）的實證研究發現，資訊不對稱期間的交易量異常大時，成交量殘差與報酬率殘差值將成正值。此現象為Crouch（1970）及Morse（1980）的實證研究所發現。
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="ch-4">
                                        <p><br> 例: 近年來有關這方面的探討逐漸受到重視，尤其在有關組織行為與人事管理研究領域中「組織承諾」（Organization
                                            Commitment）是常被學者們提及的重要概念之一（Steers, 1997；Mowday,et.al., 1982；O’Reilly &
                                            Chatman, 1986；黃國隆，1986）。</p>
                                    </div>
                                    <div class="tab-pane" id="ch-5">
                                        <p>
                                            <br>
                                            1. 圖表置正文內。<br>
                                            2. 表的名稱置於表上方（表頭），圖的名稱置於圖下方（圖尾），並以國字區分不同之圖、表。（例如：圖一、表二）<br>
                                            3. 對圖表內容（如表中之符號）作簡要說明時，請置於圖表下方。<br>
                                            4. 中文：置中，內容細明體9號字，標題標楷體11號字
                                        </p>
                                    </div>
                                </div>
                            </div> <!-- end card-box-->
                        </div><!-- end 中文版格式 -->

                        <div class="col-xl-6">
                            <div class="card-box">
                                <h4 class="header-title mb-4 ">英文版格式</h4>

                                <ul class="nav nav-tabs nav-bordered">
                                    <li class="nav-item">
                                        <a href="#E-1" data-toggle="tab" aria-expanded="false" class="nav-link">
                                            段落標明方式
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#E-2" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                            字體
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#E-3" data-toggle="tab" aria-expanded="false" class="nav-link">
                                            注釋
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#E-4" data-toggle="tab" aria-expanded="false" class="nav-link">
                                            文獻引用
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#E-5" data-toggle="tab" aria-expanded="false" class="nav-link">
                                            圖表
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane" id="E-1">
                                        <pre class="panel-body" style='background-color: #FFFFFF'>

INTRODUCTION

1.   Research Design
1.1  Instrument（置左）</pre>
                                        <p>第一層標題：Arial字型17pt，粗體，置中。<br>
                                            第二層標題：全真中黑體16pt，粗體，左右對齊。</p>
                                    </div>
                                    <div class="tab-pane show active" id="E-2">
                                        <p><br>
                                            1. 題目：Arial字型18pt，粗體，置中，每字的第一字母為大寫，其餘小寫，置中。<br>
                                            2. 作者姓名：Arial字型13pt，粗體，置中。<br>
                                            3. 英文摘要（標題）<br>
                                            （1） 英文摘要：Times New Roman字型11pt，粗體，靠左。<br>
                                            （2 ）摘要內容：Times New Roman字型7pt，粗體，左右對齊。<br>
                                            <br>
                                            4. 關鍵字：Arial字型9pt，靠左。<br>
                                            5. 內文：Times New Roman字型11pt，分段落，左右對齊。<br>
                                            6. 行距：最小行高18pt。.
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="E-3">
                                        <p>
                                            <br>
                                            附註於頁底。如下例：<br>
                                            <br>
                                            …However, it is easy to see that from the model setting, mathematically,
                                            when both inequalities in (13)hold strictly, it merely means that an
                                            investor is not allowed to hold an asset long and short simultaneously.7<br>
                                            <br>
                                            7 Stulz（1981, pp.927）states that “From first order conditions, it follows
                                            that both inequalities can hold strictly only if the investor does not hold
                                            that asset,…
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="E-4">
                                        <p><br>例: Olson（1977）suggested that people are more likely to use price to infer
                                            product quality when judging an expensive product.</p>
                                    </div>
                                    <div class="tab-pane" id="E-5">
                                        <p>
                                            <br>
                                            1. 圖表置正文內。<br>
                                            2. 表的名稱置於表上方（表頭），圖的名稱置於圖下方（圖尾），並以國字區分不同之圖、表。（例如：圖一、表二）<br>
                                            3. 對圖表內容（如表中之符號）作簡要說明時，請置於圖表下方。<br>
                                            4. 英文：置中，內容Arial字型9pt，標題Times New Roman字型11pt。.
                                        </p>
                                    </div>
                                </div>
                            </div> <!-- end card-box-->
                        </div><!-- end 英文版格式 -->




                        <div class="col-xl-12">
                            <div class="card-box">
                                <h4 class="header-title mb-4">參考文獻(中、英文)</h4>

                                <pre style="font-size: 14px">

文獻部份請將中文（細明體9pt，左右對齊）列於前，英文（Times New Roman字型9pt，左右對齊）列於後，按姓氏筆劃或字母順序排列。

1. 書籍
        例1. 徐立忠，「老人問題與對策」，台北：桂冠圖書公司，1985年。
        例2. Rokeach, M., “The Nature of Human Values”, New York：Free Press, 1973.
        例3. Siegel, J.J., "Stocks for the Long Run", 2nd ed., New York ：McGraw-Hill,1998.

2. 期刊
        例1. 方世榮、江淑娟、方世杰，「夥伴關係整合模型的實證研究－以中小企業為對象」，管理學報，第19卷第4期，2002年8月，頁615-645。
        例2. Shleifer, A. “Do Demand Curves for Stocks Slope Down?” Journal of finance., July 1986, pp.579-590.
        例3. Rousseau, D. M., Sitkin, S. B., Burt, R. S. & C. Camerer, "Not so Different After All: A Cross-Discipline View of Trust", Academy of Management Review, 23(3), 1998, pp. 393-404.

3. 編輯書
        例1. 林清玉，「實驗設計基本原則」，收錄於社會及行為科學研究法，上冊，楊國樞等（編），台北：東華書局，1978年，頁87-130。
        例2. Cohen, P.R. & Feigenbaum, E.A., The Handbook of Artificial Intelligence, Vo.l3, Pitman, 1982.

4. 博、碩士論文
        例1. 賴文彬，「製造業生產過琵成本與效率之分析」，中山大學企業管理研究所碩士論文，1982年。
        例2. Doren, D. “Stock Dividends, Stock Splites and Future Earnings：Acounting Relevence and Equity Market Response”, Ph.D. dissertation, University of Pittsburgh, 1985.

5. 學術研討會論文
        例1. 黃英忠，「從前程發展的理念探討中老年人力的運用」，中老年人力運用與企業發展研討會，高雄：國立中山大學管理學院主辦，1990年6月30日，頁117-125。
        例2. 胡國強，吳欽杉，「企業推廣教育學員參與琵度及成效評估之分析」，中華民國管理教育研討論文集，1988年10月4日，頁45-50。
        例3. Hsu, George J.Y. “A New Algorithm of Multiobjective Programming Integrating the Constraint and NISE Methods”, paper presented at the 8th International Conference on Multiple Criteria Decision Making.    Manchester.  England, 1988, August29-30.
        例4. Lin, T. & Liou, L., “A Comparative Analysis of the Dkill Requirement of MIS Personnel.”  Proceedings of the Fifth International Conference on Comparative Management.  Kaohsiung, National Sun Yat-sen University, 1992, pp.331-337.

6.討論稿（Working Paper，Manuscript）
        例1. 陳月霞，「台灣共同基金之投資期限及風險係數」，討論稿，國立中山大學管理學院，1992年，no.C9201。
        例2. Lin, N. P. & Krajewski L., “A Model for Mater Production Scheduling in Uncertain Environments, “Working paper, National Taiwan University, 1990.

7. 英文中譯書
        例1. 盧淵源譯，杉本辰夫著，「事業、營業、服務品質產制」，中興管理顧問公司，1986年。

8. 網頁
        例1. 王順民，「限播預借現金廣告的社會行銷意涵」，國政評論，2003年，
        http://www.npf.org.tw/publication/ss/092/ss-c-092-011.htm。
        例2. 林惠君，「台新銀行點燃現金卡新戰火」，新新聞，周報850期，
        http://www.new7.com.tw/weekly/old/850/850-085.html。

9. 其他：無作者或缺一作者
        例1. _________,「動腦323輯」，台北：動腦雜誌，2003年。
        例2. _______, H.B. Gregersen & M.E. Mendenhall, "Toward a Theoretical Framework of Repatriation Adjustment", Journal of International Business, 23(4), 1992, pp.737-760.</pre>
                            </div>
                        </div>
                    </div>



                    <!-- end row -->

                </div> <!-- container -->

            </div> <!-- content -->
        </div>
    </div>
    <!-- END wrapper -->

    <!-- Right Sidebar -->
    <div class="right-bar">
        <div data-simplebar class="h-100">


            <!-- Tab panes -->
            <div class="tab-content pt-0">
                <div class="tab-pane active" id="settings-tab" role="tabpanel">
                    <h6 class="font-weight-medium px-3 m-0 py-2 font-13 text-uppercase bg-light">
                        <span class="d-block py-1">主題設定</span>
                    </h6>

                    <div class="p-3">
                        <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">背景顏色</h6>
                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="color-scheme-mode" value="light"
                                id="light-mode-check" checked />
                            <label class="custom-control-label" for="light-mode-check">淺色</label>
                        </div>

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="color-scheme-mode" value="dark"
                                id="dark-mode-check" />
                            <label class="custom-control-label" for="dark-mode-check">深色</label>
                        </div>

                        <!-- Width -->
                        <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">側邊欄</h6>
                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="width" value="fluid" id="fluid-check"
                                checked />
                            <label class="custom-control-label" for="fluid-check">打開</label>
                        </div>
                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="width" value="boxed"
                                id="boxed-check" />
                            <label class="custom-control-label" for="boxed-check">收起</label>
                        </div>

                        <!-- Left Sidebar-->
                        <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">側邊欄顏色</h6>

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="leftsidebar-color" value="light"
                                id="light-check" checked />
                            <label class="custom-control-label" for="light-check">淺色</label>
                        </div>

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="leftsidebar-color" value="dark"
                                id="dark-check" />
                            <label class="custom-control-label" for="dark-check">深色</label>
                        </div>

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="leftsidebar-color" value="brand"
                                id="brand-check" />
                            <label class="custom-control-label" for="brand-check">天藍色</label>
                        </div>

                        <div class="custom-control custom-switch mb-3">
                            <input type="radio" class="custom-control-input" name="leftsidebar-color" value="gradient"
                                id="gradient-check" />
                            <label class="custom-control-label" for="gradient-check">亮紫色</label>
                        </div>

                        <!-- size -->
                        <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">側邊欄大小</h6>

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="leftsidebar-size" value="default"
                                id="default-size-check" checked />
                            <label class="custom-control-label" for="default-size-check">預設</label>
                        </div>

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="leftsidebar-size" value="condensed"
                                id="condensed-check" />
                            <label class="custom-control-label" for="condensed-check">最小化</label>
                        </div>

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="leftsidebar-size" value="compact"
                                id="compact-check" />
                            <label class="custom-control-label" for="compact-check">中等</label>
                        </div>

                        <!-- Topbar -->
                        <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">頂欄</h6>

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="topbar-color" value="dark"
                                id="darktopbar-check" checked />
                            <label class="custom-control-label" for="darktopbar-check">深色</label>
                        </div>

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="topbar-color" value="light"
                                id="lighttopbar-check" />
                            <label class="custom-control-label" for="lighttopbar-check">淺色</label>
                        </div>


                        <button class="btn btn-primary btn-block mt-4" id="resetBtn">重置為默認</button>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /Right-bar -->



    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- Vendor js -->
    <script src="../assets/js/vendor.min.js"></script>

    <!-- Plugins js -->
    <script src="../assets/libs/quill/quill.min.js"></script>

    <!-- Init js-->
    <script src="../assets/js/pages/form-quilljs.init.js"></script>

    <!-- App js -->
    <script src="../assets/js/app.min.js"></script>

    <!--Todo app js-->
    <script scr="../assets/pages/jquery.todo.js"></script>

</body>

</html>