<?php
    require_once('api/dataprocessing.php');
    require_once('api/config.php');
    session_start();

    $vuadathang = -1;

    if(!isset($_SESSION['dn'])){
        header('location:dangnhap.php');
    }
    if(!isset($_SESSION['giohang']) || empty($_SESSION['giohang'])){
        header('location:giohang.php');
    }
    $getmskh= 'select * from khachhang where email =\''.$_SESSION['email'].'\'';
    $kq = executeSingleResult($getmskh);
    $mskh=$kq['mskh'];
    //echo $mskh;
    if(isset($_POST['dathang']) && $_POST['dathang']){
        $gmsodondh = executeSingleResult('select max(sodondh) from dathang');
        if($gmsodondh['max(sodondh)'] == NULL){
            $sodondh = 1;
        }
        else{
            $sodondh = $gmsodondh['max(sodondh)'] + 1;
        }
        // $sodondh = mt_rand(100000,999999);
        //echo $masodh;
        $diachi=$_POST['diachi'];
        $timdc = 'select * from diachikh where mskh = '.$mskh.' and diachi = \''.$diachi.'\'';
        $rs = executeSingleResult($timdc);
        if($rs == NULL){
            $setdc= 'insert into diachikh(diachi,mskh) values(\''.$diachi.'\','.$mskh.')';
            //echo $setdc;
            execute($setdc);
        }
        $dh = 'insert into dathang(sodondh,mskh,ngaydh,trangthaidh) values('.$sodondh.','.$mskh.',\''.date("Y-m-d").'\',\'chua duyet\')';
        // echo $dh;
        execute($dh);
        $gg=0;
        if(isset($_SESSION['giohang']) && (is_array($_SESSION['giohang'])) && !empty($_SESSION['giohang'])){
            for($i = 0 ; $i < sizeof($_SESSION['giohang']) ; $i++){
                $tt = $_SESSION['giohang'][$i][3] * $_SESSION['giohang'][$i][4];
                if($_SESSION['giohang'][$i][4] > 5){
                    $gg=$_SESSION['giohang'][$i][3] * 10 / 100;
                }
                $chitietdathang = 'insert into chitietdathang(sodondh,mshh,soluong,giadathang,giamgia) values('.$sodondh.','.$_SESSION['giohang'][$i][0].','.$_SESSION['giohang'][$i][4].','.$tt.','.$gg.')';
                // echo $chitietdathang;
                execute($chitietdathang);
                $cnsl=executeSingleResult('select * from hanghoa where mshh = '.$_SESSION['giohang'][$i][0].'');
                // echo $cnsl['soluonghang'];
                $soluong=$cnsl['soluonghang'] - $_SESSION['giohang'][$i][4];
                // echo $soluong;
                $updatesoluong = 'update hanghoa set soluonghang='.$soluong.' where mshh = '.$_SESSION['giohang'][$i][0].'';
                // echo $updatesoluong;
                execute($updatesoluong);
            }
        }
        sleep(1);
        echo'
            <div class="notifly" style="display:flex;">
                <div class="custom-alert alert-dathang">
                    <i class="ti-check"></i>
                    <p>?????t h??ng th??nh c??ng</p>
                    <a href="thongtincanhan.php">Xem l???ch s??? giao d???ch</a>
                    <a href="sanpham.php">Ti???p t???c mua h??ng</a>
                </div>
            </div>
            ';
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./main.css">
    <link rel="stylesheet" href="./fonts/themify-icons-font/themify-icons/themify-icons.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>
<body>
<div class="container-order">
        <div class="order-infor">
            <form action="" method="post" autocomplete = "off">
            <div class="order-info-heading">
                <a href="">BaoPoo</a>
                <div class="order-info-link">
                    <a href="giohang.php">Gi??? h??ng</a>
                    <i>></i>
                    <p>Th??ng tin ?????t h??ng</p>
                </div>
            </div>
            <div class="order-info-content">
                <div class="order-infor-title">Th??ng tin kh??ch h??ng</div>
                <?php
                    $sql= 'select * from khachhang where email =\''.$_SESSION['email'].'\'';
                    $result=executeSingleResult($sql);
                ?>
                

                    <div class="form__group field">
                        <input type="input" class="form__field" style="width: 100%;" placeholder="T??n kh??ch h??ng" value="<?php echo $result['hotenkh']?>" readonly />
                        <label for="name" class="form__label">H??? v?? t??n</label>
                    </div>
                    <div class="form__group field">
                        <input type="input" class="form__field" style="width: 100%;" placeholder="T??n c??ng ty" value="<?php echo $result['tencongty']?>" readonly />
                        <label for="name" class="form__label">T??n C??ng Ty</label>
                    </div>
                    <div class="form-contact">
                        <div class="form__group field">
                            <input type="input" class="form__field" style="width: 90%;" placeholder="S??? ??i???n tho???i" value="<?php echo $result['sodienthoai']?>" readonly />
                            <label for="name" class="form__label">S??? ??i???n tho???i</label>
                        </div>
                        <div class="form__group field">
                            <input type="input" class="form__field" style="width: 100%;" placeholder="S??? fax" value="<?php echo $result['sofax']?>" readonly />
                            <label for="name" class="form__label">S??? fax</label>
                        </div>
                    </div>
                    <div class="form__group field">
                        <input type="input" class="form__field" list="diachi" style="width: 100%;" placeholder="?????a ch??? kh??ch h??ng" name="diachi"  required />
                        <label for="name" class="form__label">?????a ch??? giao h??ng</label>
                        <datalist id="diachi">
                            <?php
                            $getdiachi=executeResult('select * from diachikh where mskh = '.$mskh.'');
                            foreach ($getdiachi as $key) {
                                echo'
                                <option value="'.$key['diachi'].'">
                                ';
                            }
                            
                            ?>
                        </datalist>
                    </div>
                    <!-- <div class="old-address">
                        <p class="old-address-item">C??? ?????</p>
                        <p class="old-address-item">Red flat</p>
                    </div> -->

                
            </div>
            <div class="order-info-footer">
                <a href="giohang.php">Quay l???i gi??? h??ng</a>
                <input type="submit" value="Ho??n t???t ????n h??ng" id="dathang" name="dathang" class="order-info-button">
                <input type="submit" value="Ho??n t???t ????n h??ng" hidden id="hidden-dathang" name="dathang" class="order-info-button">
            </div>
            </form>

        </div>
    



        <div class="order-product">
            <div class="order-product-list">
            <?php
                if(isset($_SESSION['giohang']) && (is_array($_SESSION['giohang'])) && !empty($_SESSION['giohang'])){
                    $thanhtien=0;
                    $giamgia=0;
                    $gg=0;
                    for($i = 0 ; $i < sizeof($_SESSION['giohang']) ; $i++){
                        $tt = $_SESSION['giohang'][$i][3] * $_SESSION['giohang'][$i][4];
                        if($_SESSION['giohang'][$i][4] > 5){
                            $gg=$_SESSION['giohang'][$i][3] * 10 / 100;
                        }
                        $giamgia += $gg;
                        $thanhtien += $tt;
                        echo'
                        <div class="order-product-item">
                            <div class="order-product-info">
                                <div class="order-product-img" style="background-image: url(../anhsanpham/'.$_SESSION['giohang'][$i][1].');"></div>
                            </div>
                            <div class="order-product-name">
                                <p>'.$_SESSION['giohang'][$i][2].'</p>
                            </div>
                            <p class="order-product-soluong">'.$_SESSION['giohang'][$i][4].'</p>
                            
                            <div class="order-product-price">
                                <p>'.number_format($tt).'<i>???</i></p>
                            </div>
                        </div>
                        ';

                    }
                }

            ?>
                <!-- <div class="order-product-item">
                    <div class="order-product-info">
                        <div class="order-product-img" style="background-image: url(https://madefresh.com.vn/wp-content/uploads/2020/06/Chom-chom-ho-tro-tieu-hoa.jpg);"></div>
                    </div>
                    <div class="order-product-name">
                        <p>Ch??m Ch??m</p>
                    </div>
                    <p class="order-product-soluong">2</p>
                    
                    <div class="order-product-price">
                        <p>100000<i>???</i></p>
                    </div>
                </div> -->
                <!-- <div class="order-product-item">
                    <div class="order-product-info">
                        <div class="order-product-img" style="background-image: url(https://madefresh.com.vn/wp-content/uploads/2020/06/Chom-chom-ho-tro-tieu-hoa.jpg);"></div>
                    </div>
                    <div class="order-product-name">
                        <p>Ch??m Ch??m</p>
                    </div>
                    <p class="order-product-soluong">2</p>
                    
                    <div class="order-product-price">
                        <p>100000<i>???</i></p>
                    </div>
                </div> -->
            </div>
            <div class="order-product-tinhtien">
                <div class="order-product-tamtinh">
                    <div class="order-product-title">
                        T???m t??nh
                    </div>
                    <div class="order-product-sotien">
                        <p><?php echo number_format($thanhtien) ?><i>???</i></p>
                    </div>
                </div>
                <div class="order-product-tamtinh">
                    <div class="order-product-title">
                        Ph?? v???n chuy???n
                    </div>
                    <div class="order-product-sotien">
                        <p><i>Mi???n ph??</i></p>
                    </div>
                </div>
                <div class="order-product-tamtinh">
                    <div class="order-product-title">
                        Gi???m gi??
                    </div>
                    <div class="order-product-sotien">
                        <p><?php echo number_format($giamgia )?><i>???</i></p>
                    </div>
                </div>
            </div>
            <div class="order-product-total">
                <div class="order-product-total-title">
                    T???ng c???ng
                </div>
                <div class="order-product-total-price">
                    <p><?php echo number_format($thanhtien - $giamgia) ?><i>???</i></p>
                </div>
            </div>
        </div>
</div>

    <!-- <div class="notifly">
        <div class="custom-alert alert-dathang">
            <i class="ti-check"></i>
            <p>?????t h??ng th??nh c??ng</p>
            <a href="thongtincanhan.php">Xem l???ch s??? giao d???ch</a>
            <a href="sanpham.php">Ti???p t???c mua h??ng</a>
        </div>
    </div> -->

    

    <!-- <script>
        var themgiohang = document.querySelector("#dathang");
        var xemlichsu= document.querySelector("#close-viewhistory");
        var muahang= document.querySelector("#close-conbuy");
        var thongbao = document.querySelector(".notifly");
        let hienthi = -1;
        console.log(hienthi);
        if(hienthi == 1){
            thongbao.style.display="flex";
        }
        // xemlichsu.addEventListener('click',function(){
        //     document.getElementById("hidden-dathang").click();
        //     setTimeout(() => {
        //         window.location.href='thongtincanhan.php';
        //     }, 2000);
            
        // });
        // muahang.querySelector(".conbuy").addEventListener('click',function(){
        //     document.getElementById("hidden-dathang").click();
        //     setTimeout(() => {
        //         window.location.href='sanpham.php';
        //     }, 2000);
        // });
    </script> -->
</body>
</html>