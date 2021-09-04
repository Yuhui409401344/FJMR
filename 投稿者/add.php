<!DOCTYPE html>
<html lang="en">
    <body class="loading">

        <!-- Begin page -->
        <div id="wrapper">
            <?php include "nav.php" ?>
            <div class="content-page">
                <div class="content">
                <div class="container-fluid">
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <form method="post" action="add-output.php" enctype="multipart/form-data">
                            <div class="card-box">
                                <div class="form-group mb-3 mr-4 ml-4">
                                    <label for="product-name" style="font-size: 20px;">標題<span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" placeholder="請輸入標題" required>
                                </div>
                                <div class="div1 form-group mb-3 mr-4 ml-4">
                                    <label for="product-name" style="font-size: 20px;">作者<span class="text-danger">*</span></label> 
                                    <!-- <input type="button" value="新增作者" onclick="add()"> -->
                                    <input type="text" name="auth1" class="form-control" style="weight:5px;" placeholder="請輸入作者1" required>
                                    <div class="row mt-1"></div>
                                    
                                    <input type="text" name="auth2" class="form-control" placeholder="請輸入作者2">
                                    <div class="row mt-1"></div>
                                    <input type="text" name="auth3" class="form-control" placeholder="請輸入作者3">
                                    <div class="row mt-1"></div>
                                    <input type="text" name="auth4" class="form-control" placeholder="請輸入作者4">
                                    <div class="row mt-1"></div>
                                    <input type="text" name="auth5" class="form-control" placeholder="請輸入作者5">
                                </div>
                                <div class="form-group mb-3 mr-4 ml-4">
                                    <label for="product-summary"  style="font-size: 20px;">摘要<span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="summary" rows="10" style="height:160px" placeholder="請輸入文章摘要" required></textarea>
                                </div>
                                <div class="form-group mb-3 mr-4 ml-4">
                                    <label class="mb-2"  style="font-size: 20px;">領域<span class="text-danger">*</span></label>
                                    <br/>
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="f1" name="field[]" value="管理與政策">
                                    <label class="custom-control-label" for="f1">管理與政策</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="f2" name="field[]" value="國際企業">
                                    <label class="custom-control-label" for="f2">國際企業</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="f3" name="field[]" value="行銷管理">
                                    <label class="custom-control-label" for="f3">行銷管理</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="f4" name="field[]" value="國際貿易">
                                    <label class="custom-control-label" for="f4">國際貿易</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="f5" name="field[]" value="生產與作業管理">
                                    <label class="custom-control-label" for="f5">生產與作業管理</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="f6" name="field[]" value="統計">
                                    <label class="custom-control-label" for="f6">統計</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="f7" name="field[]" value="人力資源管理">
                                    <label class="custom-control-label" for="f7">人力資源管理</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="f8" name="field[]" value="數量方法">
                                    <label class="custom-control-label" for="f8">數量方法</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="f9" name="field[]" value="資訊管理">
                                    <label class="custom-control-label" for="f9">資訊管理</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="f10" name="field[]" value="會計">
                                    <label class="custom-control-label" for="f10">會計</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="f11" name="field[]" value="財務管理">
                                    <label class="custom-control-label" for="f11">財務管理</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="f12" name="field[]" value="審計">
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
