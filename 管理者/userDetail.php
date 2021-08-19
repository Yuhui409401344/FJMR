<?php 
if(isset($_POST["login"]))
{
    $login = $_POST["login"];

    $output = '';
    $pdo = new PDO('mysql:host=localhost;dbname=fjup;charset=utf8', 'root', '');
    $query1=$pdo->query("SELECT status from account where login='$login' ");
    $datalist1=$query1->fetchall();
    $status=[];
    foreach($datalist1 as $datadetail1){
        array_push($status, $datadetail1["status"]);
    };

    $query2=$pdo->query("SELECT distinct f_name from account_field where login='$login'");
    $datalist2=$query2->fetchall();
    $field=[];
    foreach($datalist2 as $datadetail2){
        array_push($field, $datadetail2["f_name"]);
    }

    foreach($pdo->query("SELECT tel_1,tel_2 from account_tel where login ='$login'") as $row){
        $tel_1=$row["tel_1"];
        $tel_2=$row["tel_2"];
    }

    if(!isset($tel_1,$tel_2)){
        $tel_1='';
        $tel_2='';
    }

    
    foreach ($pdo->query("select distinct name,email,date,bio,photo,imgType from account left join account_bio on account.login = account_bio.login left join account_img ON account_img.login=account.login where account.login =  '".$login."' ") as $row) {
        $name=$row['name'];
        $email=$row['email'];
        $date=$row['date'];
        $bio=$row['bio'];
        $photo=$row['photo'];
        $imgType=$row['imgType'];

        if(isset($photo)){

            $output .= '
        <div class="card-box text-center">
        <img src="data:'.$imgType.';base64,' . $photo . '"   class="rounded-circle avatar-lg img-thumbnail"  />

        <h4 class="mb-0" type="text" name="user" id="user">'.$name.'</h4>
        <p class="text-muted" type="text" name="login" id="login">@ '.$login.'</p> 
        <div class="text-left mt-3">
        <p class="text-muted mb-2 font-13"><strong>身份 :</strong>
        <span class="ml-2 " type="text">'.implode('  ', $status).'</span>
        </p>
        <p class="text-muted mb-2 font-13"><strong>領域 :</strong>
        <span class="ml-2 " type="text" name="field" id="field">'.implode('  ', $field).'</span>
        </p>
        <p class="text-muted mb-2 font-13"><strong>Email :</strong>
        <span class="ml-2 " type="text" name="email" id="email">'.$email.'</span>
        </p>
        <p class="text-muted mb-2 font-13"><strong>連絡電話 :</strong>
        <span class="ml-2 " type="text" name="tel_1" id="tel_1">'.$tel_1.'</span>
        <span class="ml-2 " type="text" name="tel_2" id="tel_2">'.$tel_2.'</span>
        </p>
        <p class="text-muted mb-2 font-13"><strong>開始日期 :</strong>
        <span class="ml-2 " type="text" name="date" id="date">'.$date.'</span>
        </p>
        <p class="text-muted mb-2 font-13"><strong>簡介 :</strong>
        <span class="ml-2 " type="text" name="bio" id="bio">'.$bio.'</span>
        </p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Close</button>
            <a href="mailto:'.$email.'"><button type="button" class="btn btn-primary btn-sm waves-effect waves-light">傳送訊息</button></a>
        </div>
        ';
            
        }else{

            $output .= '
        <div class="card-box text-center">
        <img src="../assets/images/user.png"   class="rounded-circle avatar-lg img-thumbnail"  />

        <h4 class="mb-0" type="text" name="user" id="user">'.$name.'</h4>
        <p class="text-muted" type="text" name="login" id="login">@ '.$login.'</p> 
        <div class="text-left mt-3">
        <p class="text-muted mb-2 font-13"><strong>身份 :</strong>
        <span class="ml-2 " type="text">'.implode('  ', $status).'</span>
        </p>
        <p class="text-muted mb-2 font-13"><strong>領域 :</strong>
        <span class="ml-2 " type="text" name="field" id="field">'.implode('  ', $field).'</span>
        </p>
        <p class="text-muted mb-2 font-13"><strong>Email :</strong>
        <span class="ml-2 " type="text" name="email" id="email">'.$email.'</span>
        </p>
        <p class="text-muted mb-2 font-13"><strong>連絡電話 :</strong>
        <span class="ml-2 " type="text" name="tel_1" id="tel_1">'.$tel_1.'</span>
        <span class="ml-2 " type="text" name="tel_2" id="tel_2">'.$tel_2.'</span>
        </p>
        <p class="text-muted mb-2 font-13"><strong>開始日期 :</strong>
        <span class="ml-2 " type="text" name="date" id="date">'.$date.'</span>
        </p>
        <p class="text-muted mb-2 font-13"><strong>簡介 :</strong>
        <span class="ml-2 " type="text" name="bio" id="bio">'.$bio.'</span>
        </p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Close</button>
            <a href="mailto:'.$email.'"><button type="button" class="btn btn-primary btn-sm waves-effect waves-light">傳送訊息</button></a>
        </div>
        ';
            
        }

        
    }
    $output .= "</table></div>";
    echo $output;

    
}
    
?>