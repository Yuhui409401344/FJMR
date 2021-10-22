<?php 

$slogan="Today's research, tomorrow's innovation. ";

foreach($pro as $a){
  $reviewer = $a;
};


$accept = isset($_POST['accept'])? $_POST['accept']: '';
$id = isset($_POST['id'])?  $_POST['id']: '';
$reviewer = isset($_POST['reviewer'])? $_POST['reviewer'] : '';


$pdo=new PDO('mysql:host=localhost;dbname=fjup;charset=utf8','root', '');
$sql1=$pdo->prepare("update distri set accept=? where pro=? and id=? ");
$sql1->execute([$accept,$reviewer,$id]);

$sql2=$pdo->prepare("update distri_history set accept=? where pro=? and id=? ");
$sql2->execute([$accept,$reviewer,$id]);

$emailContent = 
'<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="x-apple-disable-message-reformatting">
  <title>Email</title>
    <style type="text/css">
      table, td { color: #000000; } a { color: #0000ee; text-decoration: underline; } @media (max-width: 480px) { #u_content_image_1 .v-container-padding-padding { padding: 30px 10px 0px !important; } #u_content_image_1 .v-text-align { text-align: center !important; } #u_content_heading_3 .v-container-padding-padding { padding: 40px 10px 10px !important; } #u_content_heading_3 .v-text-align { text-align: center !important; } #u_content_text_1 .v-container-padding-padding { padding: 10px 1px 60px 10px !important; } #u_content_text_1 .v-text-align { text-align: center !important; } #u_content_heading_1 .v-container-padding-padding { padding: 40px 10px 10px !important; } #u_content_heading_1 .v-text-align { text-align: center !important; } #u_content_social_1 .v-container-padding-padding { padding: 30px 0px !important; } }
        @media only screen and (min-width: 570px) {
          .u-row {
            width: 550px !important;
          }
          .u-row .u-col {
            vertical-align: top;
          }

          .u-row .u-col-50 {
            width: 275px !important;
          }

          .u-row .u-col-100 {
            width: 550px !important;
          }

        }

        @media (max-width: 570px) {
          .u-row-container {
            max-width: 100% !important;
            padding-left: 0px !important;
            padding-right: 0px !important;
          }
          .u-row .u-col {
            min-width: 320px !important;
            max-width: 100% !important;
            display: block !important;
          }
          .u-row {
            width: calc(100% - 40px) !important;
          }
          .u-col {
            width: 100% !important;
          }
          .u-col > div {
            margin: 0 auto;
          }
        }
        body {
          margin: 0;
          padding: 0;
        }

        table,
        tr,
        td {
          vertical-align: top;
          border-collapse: collapse;
        }

        p {
          margin: 0;
        }

        .ie-container table,
        .mso-container table {
          table-layout: fixed;
        }

        * {
          line-height: inherit;
        }

        a[x-apple-data-detectors="true"] {
          color: inherit !important;
          text-decoration: none !important;
        }

    </style>

  <link href="https://fonts.googleapis.com/css?family=Cabin:400,700&display=swap" rel="stylesheet" type="text/css"><link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet" type="text/css"><!--<![endif]-->

</head>

<body class="clean-body" style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;color: #000000">
  <!--[if IE]><div class="ie-container"><![endif]-->
  <!--[if mso]><div class="mso-container"><![endif]-->
  <table style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;width:100%" cellpadding="0" cellspacing="0">
    <tbody>
      <tr style="vertical-align: top">
        <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
          <div class="u-row-container" style="padding: 0px;">
            <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
              <div style="border-collapse: collapse;display: table;width: 100%;background-repeat: no-repeat;background-position: center top;background: linear-gradient(to right, #283048, #859398);">
                <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-image: url("images/image-3.jpeg");background-repeat: no-repeat;background-position: center top;background-color: transparent;"><![endif]-->
                
                <!--[if (mso)|(IE)]><td align="center" width="550" style="width: 550px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                <div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
                  <div style="width: 100% !important;">
                  <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->

                    <table id="u_content_heading_3" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                      <tbody>
                        <tr>
                          <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:50px 10px 15px 30px;font-family:arial,helvetica,sans-serif;" align="left">
                            
                          <div class="v-text-align" style="color: #ffffff; line-height: 140%; text-align: left; word-wrap: break-word;">
                          <p style="font-size: 36px; line-height: 140%;">輔仁管理評論</p>
                        </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>

                    <table id="u_content_text_1" style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                      <tbody>
                        <tr>
                          <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px 20px 60px 30px;font-family:arial,helvetica,sans-serif;" align="left">
                            
                      <div class="v-text-align" style="color: #ffffff; line-height: 210%; text-align: left; word-wrap: break-word;">
                        <p style="font-size: 14px; line-height: 210%;"><span style="font-size: 18px; line-height: 37.8px;">'.$slogan.'</span></p>
                      </div>

                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="u-row-container" style="padding: 0px;background-color: transparent">
            <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
              <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                <div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
                  <div style="width: 100% !important;">
                    <table id="u_content_heading_1" style="font-family:arial,helvetica,sans-serif; background-color: #eceff1;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                      <tbody>
                        <tr>
                          <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:50px 44px 15px;font-family:arial,helvetica,sans-serif;" align="left">
                            
                     
                      <p style="font-family: "Open Sans",sans-serif; ">親愛的審稿者'.$reviewer.'您好：輔仁管理評論現有一封分配給您的稿件，待您審查，還請您決定是否接收！</p>

                          </td>
                        </tr>
                      </tbody>
                    </table>
                    
                    
                      <form method="post" action="">
                            <div class="v-text-align" align="left" stye="display:flex">
                              
                              <input type="radio" name="accept" value="0">No</input>
                              <input type="radio" name="accept" value="1">Yes</input>
                              <input type="hidden" name="id" value='.$id.'></input>
                              <input type="hidden" name="reviewer" value='.$reviewer.'></input>

                              <input type="submit" value="提交"></input>
                                
                            </div>
                      </form>

                          
                  </div>
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</body>

</html>

';

return $emailContent;


?>