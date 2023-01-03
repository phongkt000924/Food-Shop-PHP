<?php
        require_once('api/dataprocessing.php');
        require_once('api/config.php');
        session_start();
        if(isset($_SESSION['dn'])){
            header('location:giohang.php');
        }


    //     if(isset($_POST['dangnhap']) && ($_POST['dangnhap'])){
    //             $email=$_POST['emaildn'];
    //             $matkhau=$_POST['matkhaudn'];
    //             $alert1='';
    //          //var_dump($email);
    //         $sql='select * from khachhang where matkhau=\''.$matkhau.'\' and email=\''.$email.'\'';
    //         //var_dump($sql);
    //         $result=executeSingleResult($sql);
    //         //var_dump($result);
    //         if($result == NULL){
    //             $alert1="Email hoặc mật khẩu của bạn đã sai !";
    //         }
    //         else{
    //             $_SESSION['dn']=true;
    //             $_SESSION['email']=$email;
    //             $_SESSION['matkhau']=$matkhau;
    //             //var_dump($email);
    //             header('location:giohang.php');
    //         }
    //     }
        
        
        
        
        
        
        
        
        
        
        
    //     if(isset($_POST['dangky']) && ($_POST['dangky'])){
    //         $hoten=$_POST['hoten'];
    //         $tencty=$_POST['tencongty'];
    //         $sdt=$_POST['sodienthoai'];
    //         $sf=$_POST['sofax'];
    //         $email=$_POST['emaildk'];
    //         $matkhau=$_POST['matkhaudk'];
    //         $alert='';
    //         //var_dump($email);
    //         $sql='select * from khachhang where email=\''.$email.'\'';
    //         //var_dump($sql);
    //         $result=executeSingleResult($sql);
    //         //var_dump($result);
    //         if($result == NULL){
    //             //var_dump($hoten);
    //             $gmkh = executeSingleResult('select max(mskh) from khachhang');
    //             if($gmkh['max(mskh)'] == NULL){
    //                 $mskh = 1;
    //             }
    //             else{
    //                 $mskh = $gmkh['max(mskh)'] + 1;
    //             }
    //             $dangky='insert into khachhang(mskh,hotenkh,tencongty,sodienthoai,sofax,email,matkhau) values('.$mskh.',\''.$hoten.'\',\''.$tencty.'\',\''.$sdt.'\',\''.$sf.'\',\''.$email.'\',\''.$matkhau.'\')';
    //             //var_dump($dangky);
    //             execute($dangky);
    //             $alert="Chúc mừng bạn đã đăng ký thành công !";
    //             unset($_POST['dangky']);
    //             unset($hoten);
    //             unset($tencty);
    //             unset($sdt);
    //             unset($sf);
    //             unset($email);
    //             unset($matkhau);
    //             //var_dump($hoten);
    //         }
    //         else{
    //             $alert="Email của bạn đã được đăng ký ! Vui lòng chọn email khác !";
    //         }
    // }
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
</head>
<body>
    <?php
        include("nav.php");
    ?>
    <div class="nav-introduce">
        <div class="nav-review slogan">
           <!----> <div class="icon"><img src="./img/buildings.png" alt=""></div>
            <div class="mota">
                <strong>BaoPoo Food</strong>
                <p>Thực phẩm sạch cho mỗi nhà</p>
            </div>
        </div>
        <div class="nav-review slogan1">
          <!---->  <div class="icon"><img src="./img/car.png" alt=""></div>
            <div class="mota">
                <strong>Miễn phí vận chuyển</strong>
                <p>Phạm vi trên toàn quốc</p>
            </div>
        </div>
        <div class="nav-review slogan2">
           <!----> <div class="icon"><img src="./img/letter.png" alt=""></div>
            <div class="mota">
                <strong>Hỗ trợ 24/7</strong>
                <p>Hotline: <strong>19112000</strong></p>
            </div>
        </div>
        <div class="nav-review slogan3">
            <div class="icon"><img src="./img/clock.png" alt=""></div>
            <div class="mota">
                <strong>Giờ làm việc</strong>
                <p>Các ngày trong tuần</p>
            </div>
        </div>
    </div>
    <div class="header">
        <ul class="header-nav">
            <li><a href="index.php">Trang Chủ</a></li>
            <li><a href="sanpham.php">Sản Phẩm </a></li>
        </ul>

    </div>

    <div class="container">
        <div class="account">
            <div class="form-login">
                <form action="" method="POST" class="login">
                    <h2>Đăng nhập</h2>
                    <p>Khách hàng đăng nhập vào mẫu bên dưới !</p>
                    <input type="text" class="form-login-email" name="emaildn" placeholder="Email của bạn..." required title="Email không được trống !">
                    <br>
                    <input type="password" class="form-login-matkhau" name="matkhaudn" placeholder="Mật khẩu của bạn..." required title="Mật khẩu không được trống !">
                    <br>
                    <input type="button" class="account-sumit" onclick="thaotac('dangnhap')" name="dangnhap" value="Đăng nhập">
                    <p class="error error-dangnhap">
                       
                    </p>
                </form>
            </div>


            

            <div class="form-register">
                <form action="" method="post" class="register" >
                    <h2>Đăng ký tài khoản</h2>
                    <p>Khách hàng đăng ký theo mẫu bên dưới !</p>
                    <input type="text" class="form-register-hoten" name="hoten"  placeholder="Họ tên của bạn" required title="Họ tên không được trống !">
                    <input type="text" class="form-register-tencty" name="tencongty" placeholder="Tên công ty bạn đang làm...">
                    <input type="text" class="form-register-sdt" name="sodienthoai" pattern="(\+84|0)\d{9,10}" placeholder="Số điện thoại của bạn..." required title="Số điện thoại phải có bắt đầu bằng +84 hoặc 0 !">
                    <input type="text" class="form-register-sf" name="sofax" placeholder="Số Fax của bạn...">
                    <input type="text" class="form-register-email" name="emaildk" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Email của bạn..." required title="Email đăng ký phải có đuôi @gmail.com !">
                    <input type="password" class="form-register-matkhau" name="matkhaudk" placeholder="Mật khẩu của bạn..." required title="Mật khẩu không được trống !">             
                    <br>
                    <input type="button" class="account-sumit" onclick="thaotac('dangky')" name="dangky" value="Đăng ký">
                    <p class="error error-dangky">
                        
                    </p>
                </form>
                    
            </div>
        </div>
    </div>



    <div class="footer">
        <div class="footer-trangtri">
            <img src="./img/ft1.png" alt="">
            <img src="./img/ft2.png" alt="">
            <img src="./img/ft1.png" alt="">
            <img src="./img/ft2.png" alt="">
            <img src="./img/ft1.png" alt="">
            <img src="./img/ft2.png" alt="">
        </div>
        <div class="footer-body">
            <div class="footer-contact">
                <span class="footer-name">Liên hệ</span>
                <p>Chúng tôi chuyên cung cấp các sản phẩm thực phẩm sạch an toàn cho sức khỏe con người</p>
                <p><i class="footer-icon ti-home"></i> Thời Đông, Cờ Đỏ, Thành phố Cần Thơ, Việt Nam</p>
                <p><i class="footer-icon ti-timer"></i> Thứ 2 - Chủ nhật: 7:30 - 17:00</p>
                <p><i class="footer-icon ti-user"></i> 0385832071</p>
                <p><i class="footer-icon ti-email"></i> baopoofood@gmail.com</p>
            </div>
            <div class="footer-support">
                <span class="footer-name">Hỗ trợ khách hàng</span>
                <ul class="footer-support-list">
                    <li><a href="index.php">Trang chủ</a></li>
                    <li><a href="sanpham.php">Sản phẩm</a></li>
                </ul>

            </div>
            <div class="footer-link">
                <span class="ti-facebook"> <a href="">Kết nối với BaopooFood</a></span>
                
            </div>
        </div>

    </div>
    <script>
        function thaotac(thaotac) {
            // console.log(thaotac);
            if(thaotac == 'dangky'){
                const hoten = document.querySelector(".form-register-hoten").value
                const tencty = document.querySelector(".form-register-tencty").value
                const sodienthoai = document.querySelector(".form-register-sdt").value
                const sofax = document.querySelector(".form-register-sf").value
                const email = document.querySelector(".form-register-email").value
                const matkhau = document.querySelector(".form-register-matkhau").value
                if(hoten != '' && sodienthoai != '' && email != '' && email != ''){
                    fetch('api/api-thaotac.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                'hoten': hoten,
                                'tencongty' : tencty,
                                'sodienthoai' : sodienthoai,
                                'sofax' : sofax,
                                'emaildk' : email,
                                'matkhaudk' : matkhau,
                                'thaotac' : thaotac
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            // console.log(data);
                            if(data == 0){
                                document.querySelector(".error-dangky").innerText = 'Đăng ký thành công !'
                            }
                            else {
                                document.querySelector(".error-dangky").innerText = 'Email đã được sử dụng, vui lòng chọn email khác !'
                            }
    
                        })
                }
                else {
                    alert('Vui lòng nhập đầy đủ thông tin !');
                }
            }
            else {
                const email = document.querySelector(".form-login-email").value
                const matkhau = document.querySelector(".form-login-matkhau").value
                if(email != '' && matkhau != ''){
                    fetch('api/api-thaotac.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                'emaildn' : email,
                                'matkhaudn' : matkhau,
                                'thaotac' : thaotac
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            // console.log(data);
                            if(data == 0){
                                window.location.href="giohang.php";
                            }
                            else {
                                document.querySelector(".error-dangnhap").innerText = 'Email hoặc mật khẩu đã sai , vui lòng kiểm tra lại !'
                            }
                        })
                }
                else {
                    alert('Vui lòng nhập email và mật khẩu !');
                }
                
            }
        }
    </script>
</body>
</html>