<!DOCTYPE html>
<html lang="en">

<body class="loading">

    <!-- Begin page -->
    <div id="wrapper">
        <?php include "nav.php" ?>

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="card-box">
                            <div class=" mt-3 alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                回覆成功，請靜候回覆！
                            </div>
                                <?php
                                $title = $_POST["title"];
                                // $field=$_POST["field"];
                                $summary = $_POST["summary"];
                                $auth1 = $_POST["auth1"];
                                $auth2 = $_POST["auth2"];
                                $auth3 = $_POST["auth3"];
                                $auth4 = $_POST["auth4"];
                                $auth5 = $_POST["auth5"];
                                $uploadtime = "";



                                $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
                                $sql1 = "select count(*) as count from newpaper_history where title='" . $title . "'";
                                $result = $pdo->query($sql1);
                                foreach ($result as $row) {
                                    $row["count"];
                                }
                                $filename = $_FILES["file"]["name"];
                                $name = explode('.', $filename);
                                $newname = $title . 'r' . $row["count"] . '.' . $name[1];

                                $sql2 = $pdo->prepare('insert into newpaper (title,uploader,summary,auth1,auth2,auth3,auth4,auth5,uploadname) VALUES(?,?,?,?,?,?,?,?,?)');
                                $sql2->execute([$title, $login, $summary, $auth1, $auth2, $auth3, $auth4, $auth5, $newname]);

                                $id = "select id from newpaper where title='" . $title . "' and uploadname='" . $newname . "' ";
                                $paper_id = $pdo->query($id);
                                foreach ($paper_id as $pid) {
                                    $pid["id"];
                                }

                                $sql4 = $pdo->prepare('insert into newpaper_history (id,title,uploader,summary,auth1,auth2,auth3,auth4,auth5,uploadname) VALUES(?,?,?,?,?,?,?,?,?,?)');
                                $sql4->execute([$pid["id"], $title, $login, $summary, $auth1, $auth2, $auth3, $auth4, $auth5, $newname]);

                                $c = $row['count'] - 1;
                                $sql5 = $pdo->prepare("UPDATE totalreply SET have_reply=? WHERE replycount=? and title=?");
                                $sql5->execute(['0', $c, $title]);

                                // $odlname=$_FILES["file"]["tmp_name"];

                                if ($_FILES["file"]["error"] > 0) {
                                    echo "Error: " . $_FILES["file"]["error"];
                                } else {
                                    "檔案名稱: " . $newname . "<br/>";
                                    "檔案類型: " . $_FILES["file"]["type"] . "<br/>";
                                    "檔案大小: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
                                    "暫存名稱: " . $_FILES["file"]["tmp_name"];
                                    move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $newname);
                                    move_uploaded_file($_FILES["file_x"]["tmp_name"], "upload_x/" . $newname);
                                }
                                ?>


                            </div> <!-- end card-box -->
                        </div> <!-- end col -->
                    </div><!-- end row -->
                </div> <!-- container -->
            </div> <!-- content -->
        </div>
    </div>
    <!-- END wrapper -->
</body>

</html>