<?php
     require_once('dataprocessing.php');
     require_once('config.php');
     session_start();
     $data = json_decode(file_get_contents('php://input'), true);
     $check = '';
    if(!isset($_SESSION['giohang'])){
        $_SESSION['giohang']=[];
    }
    if(isset($_SESSION['dn'])){
        $masp=$data['mshh'];
        $anhsp=$data['anhhh'];
        $tensp=$data['tenhh'];
        $giasp=$data['gia'];
        $soluongsp=$data['soluongmua'];
        $soluongsptk = $data['soluongtk'];
        $co=0;
        if($soluongsp <= $soluongsptk){
            for($i = 0 ; $i < sizeof($_SESSION['giohang']) ; $i++){
                if($_SESSION['giohang'][$i][0] == $masp){
                    $co = 1;
                    $soluongmoi=$soluongsp + $_SESSION['giohang'][$i][4];
                    $_SESSION['giohang'][$i][4]=$soluongmoi;
                    $check = 3;
                    break;
        
                }
            }
    
            if($co == 0){
                $sanpham=[$masp,$anhsp,$tensp,$giasp,$soluongsp];
                $_SESSION['giohang'][] = $sanpham;
                $check = 3;
    
            }
        }
        else {
            $check = 2;

        }
    }
    else {
        $check = 1;
    }
    echo json_encode($check);
?>