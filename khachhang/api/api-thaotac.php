<?php
    require_once('dataprocessing.php');
    require_once('config.php');
    session_start();
    $data = json_decode(file_get_contents('php://input'), true);    
    $check ='';
    $thaotac = $data['thaotac'];
    if($thaotac == 'dangky'){
        $hoten=$data['hoten'];
        $tencty=$data['tencongty'];
        $sdt=$data['sodienthoai'];
        $sf=$data['sofax'];
        $email=$data['emaildk'];
        $matkhau=$data['matkhaudk'];
        //var_dump($email);
        $sql='select * from khachhang where email=\''.$email.'\'';
        //var_dump($sql);
        $result=executeSingleResult($sql);
        //var_dump($result);
        if($result == NULL){
            //var_dump($hoten);
            $gmkh = executeSingleResult('select max(mskh) from khachhang');
            if($gmkh['max(mskh)'] == NULL){
                $mskh = 1;
            }
            else{
                $mskh = $gmkh['max(mskh)'] + 1;
            }
            $dangky='insert into khachhang(mskh,hotenkh,tencongty,sodienthoai,sofax,email,matkhau) values('.$mskh.',\''.$hoten.'\',\''.$tencty.'\',\''.$sdt.'\',\''.$sf.'\',\''.$email.'\',\''.$matkhau.'\')';
            //var_dump($dangky);
            execute($dangky);
            unset($hoten);
            unset($tencty);
            unset($sdt);
            unset($sf);
            unset($email);
            unset($matkhau);
            //var_dump($hoten);
            $check = 0;
        }
        else{
            $check = 1;
        }
    }
    else {
        $email=$data['emaildn'];
        $matkhau=$data['matkhaudn'];
            //var_dump($email);
        $sql='select * from khachhang where matkhau=\''.$matkhau.'\' and email=\''.$email.'\'';
        //var_dump($sql);
        $result=executeSingleResult($sql);
        //var_dump($result);
        if($result == NULL){
            // $alert1="Email hoặc mật khẩu của bạn đã sai !";
            $check = 1;
        }
        else{
            $_SESSION['dn']=true;
            $_SESSION['email']=$email;
            $_SESSION['matkhau']=$matkhau;
            //var_dump($email);
            // header('location:giohang.php');
        }
    }
    echo json_encode($check);
?>