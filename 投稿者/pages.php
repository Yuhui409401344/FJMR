<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>審稿者</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="../assets/images/favicon.ico">

	    <!-- App css -->
	    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
	    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

	    <link href="../assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
	    <link href="../assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

	    <!-- icons -->
	    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body class="loading">

        <div id="wrapper">
                <?php include "nav.php" ?>
            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <br>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card-box">
                                    <div class="row">
                                        <div class="container-fluid">
                                         <?php $title=$_REQUEST["title"] ;
                                            $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                            foreach ($pdo->query("select * from reply where title='".$title."'") as $row) {
                                                $senter=$row['senter'];
                                                $recipient=$row['recipient'];
                                                $author1=$row['auth1'];
                                                $author2=$row['auth2'];
                                                $author3=$row['auth3'];
                                                $author4=$row['auth4'];
                                                $author5=$row['auth5'];
                                                $level=$row['level'];
                                                $time=$row['time'];
                                                $replytime=$row['replytime'];
                                                $uploadname=$row['uploadname'];
                                                $comment=$row['comment'];
                                        ?>
                                            <div style=" display: flex;
                                                        justify-content: right;
                                                        align-items: center;
                                                        height: 70px;
                                                        border-bottom: 0;">
                                            <h3 style="font-weight: bolder;font-family:Microsoft JhengHei;margin-left: 60px;margin-top: 20px;">國際交換生選擇學校之關鍵因素-使用層級分析法</h3>
                                            </div>
                                            <div class="container">
                                                <div class="row justify-content-start">
                                                  <div class="col-3">
                                                    期數：第27卷 / 第3期
                                                  </div>
                                                  <div class="col-3">
                                                    全文下載：<a href="download/tw_books_caty01601373662.pdf">1.16MB</a>
                                                  </div>
                                                  <div class="col-3">
                                                    發布時間：109 年 09 月 29 日
                                                  </div>
                                                </div>
                                              </div>
                                            <div class="row">
                                                <div class="container mt-0" >
                                                <section class="mt-3">

                                                <!-- Card header -->
                                                <div class="card-header border-0 font-weight-bold d-flex justify-content-between">
                                                <p class="mr-4 mb-0">作者</p>
                                                </div>

                                                <div class="media my-2 px-1">
                                                    <div class="media-body" style="font-family:Microsoft JhengHei">
                                                        <div>
                                                          <p class=" mb-0;" style="color: #1c2a48; margin-bottom: 0px;font-weight: 520">李智明   東吳大學企業管理學系教授（通訊作者）</p>
                                                          <p class=" mb-0;" style="color: #1c2a48; margin-bottom: 0px;font-weight: 520">陳怡伶   東吳大學企業管理學系研究生</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                </section>
                                                </div>
                                                <div class="container">
                                                <section class="mt-3">

                                                <!-- Card header -->
                                                <div class="card-header border-0 font-weight-bold d-flex justify-content-between">
                                                <p class="mr-4 mb-0">摘要</p>
                                                </div>

                                                <div class="media mt-3 px-1">
                                                <div class="media-body" style="text-align: justify; padding-right: 30px;font-family:Microsoft JhengHei">
                                                    <p>隨著教育的普及，現今大學國際交換生體制之發展也逐漸成熟。除了以往的留學方式外，學生可以選擇以短期交換方式，體驗國外的生活。不僅選擇方式較為多元，學費也較以往便宜，使得國際交換人數逐年攀升。本文以AHP(Analytic Hierarchy Process)法探討國際交換生選擇學校之關鍵因素，先經由文獻探討建構AHP層級架構，共有4個關鍵構面及21個因素。接著設計問卷，調查了臺灣至國外交換、陸生來臺交換以及外國來臺交換三個群體的交換生，並比較此三群交換生問卷結果之差異。本研究發現對全體填答交換生而言，最重要之構面為交換國構面。而「文化、語言、宗教、習慣」、「友善安全的住所」、「旅遊考量」、「國際人脈」為前四個重要因素；最後一名因素為「打工收入」。最後，本文依研究結果提出建議，供相關部門制定交換生發展策略之參考，以促進國際交流及發展。</p>
                                                </div>
                                                </div>

                                                </section>
                                                </div>

                                                <div class="container">
                                                    <section class="my-5">

                                                    <!-- Card header -->
                                                    <div class="card-header border-0 font-weight-bold d-flex justify-content-between">
                                                    <p class="mr-4 mb-0">關鍵字</p>
                                                    </div>

                                                    <div class="media mt-4 px-1">
                                                    <div class="media-body">
                                                        <a href="">關鍵因素，國際交換生，層級分析法</a>
                                                    </div>
                                                    </div>

                                                    </section>
                                                    </div>
                                            </div>
                                        <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <center>
                                        <button type="button" class="btn btn-success waves-effect waves-light">
                                            <a href="#reply-modal;" data-toggle="modal" data-target="#reply-modal" style="color: white"><span class="btn-label"><i class="fas mdi mdi-email-send-outline fa-lg"></i></span>回覆</a>
                                        </button>
                                    </center>
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row-->
                        
                    </div> <!-- container -->

                </div> <!-- content -->
            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->
        <div class="modal fade" id="reply-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  
                    <div class="modal-body">
                        <div class="card-box">
                            <div class="form-group">
                                <label for="papername" class="control-label">標題<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="papername" placeholder="請輸入回覆文章之標題">
                            </div>

                            <div class="form-group mb-3">
                                <label for="product-summary">回覆意見<span class="text-danger">*</span></label>
                                <textarea class="form-control" id="product-summary" rows="3" placeholder=""></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="statuslist">回覆評級<span class="text-danger">*</span></label>
                                <div id="statuslist ml-4">
                                    <div class="radio radio-success form-check-inline">
                                        <input type="radio" id="status1" value="option1" name="radioInline">
                                        <label for="status1"> 接受 </label>
                                    </div>
                                    <div class="radio radio-info form-check-inline">
                                        <input type="radio" id="status2" value="option1" name="radioInline">
                                        <label for="status2"> 小幅修改 </label>
                                    </div>
                                    <div class="radio radio-warning form-check-inline">
                                        <input type="radio" id="status3" value="option1" name="radioInline">
                                        <label for="status3"> 大幅修改 </label>
                                    </div>
                                    <div class="radio radio-danger form-check-inline">
                                        <input type="radio" id="status4" value="option1" name="radioInline">
                                        <label for="status4"> 拒絕 </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="fileinput">上傳回覆檔案<span class="text-danger">*</span></label>
                                <input type="file" id="fileinput" class="form-control-file">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer mr-2">
                        <div class="form-group" style="text-align: right;">
                            第 <script>document.getElementById('demo-custom-toolbar').getAttribute('times');</script> &copy;  次回覆
                        </div>
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-info waves-effect waves-light">送出</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->



        <!-- Todo app -->
        <script src="../assets/js/pages/jquery.todo.js"></script>

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="../assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="../assets/js/app.min.js"></script>
        
    </body>
</html>
                                            