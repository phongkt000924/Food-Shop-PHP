<?php
    require_once('api/dataprocessing.php');
    require_once('api/config.php');
    session_start();


    if(isset($_GET['xoamlh'])){
        $maloaihang = $_GET['xoamlh'];
        // echo $maloaihang;
        $gethh = executeResult('select * from hanghoa where maloaihang ='.$maloaihang.'');
        foreach($gethh as $mshh){
            execute('delete from hinhhanghoa where mshh = '.$mshh['mshh'].'');
            // echo 'select * from hinhhanghoa where mshh='.$mshh['mshh'].'';s
            $getth = executeResult('select * from hinhhanghoa where mshh='.$mshh['mshh'].'');
            foreach($getth as $tenhinh){
                unlink('../anhsanpham/'.$tenhinh['tenhinh'].'');
                // echo '../anhsanpham/'.$tenhinh['tenhinh'].'';
            }
            $getdonhang = executeResult('select * from chitietdathang where mshh = '.$mshh['mshh'].'');
            // echo 'select * from chitietdathang where mshh = '.$mshh['mshh'].'';
            if($getdonhang != null){
                foreach($getdonhang as $getdh){
                    execute('delete from chitietdathang where sodondh = '.$getdh['sodondh'].'');
                    // echo 'delete from chitietdathang where sodondh = '.$getdonhang['sodondh'].'';
                    execute('delete from dathang where sodondh = '.$getdh['sodondh'].'');
                    // echo 'delete from dathang where sodondh = '.$getdonhang['sodondh'].'';
                }
            }
        }
        execute('delete from hanghoa where maloaihang = '.$maloaihang.'');
        execute('delete from loaihanghoa where maloaihang = '.$maloaihang.'');
        
        // foreach ($getth as $tenhinh){
        //     unlink('../anhsanpham/'.$tenhinh['tenhinh'].'');
        // }
        echo '
            <script>
                alert("Đã xóa loại hàng hóa '.$maloaihang.'");
            </script>
            ';
        unset($_SESSION['giohang']);
    }
    if(isset($_POST['updatelhh']) && $_POST['updatelhh']){
        $mlh =  $_POST['maloaihang'];
        $tlh = $_POST['tenloaihang'];
        // echo $mlh;
        $kiemtra = 'select * from loaihanghoa where tenloaihang =\''.$tlh.'\'';
        // echo $kiemtra;
        $check = executeSingleResult($kiemtra);
        // $mlh = $check['maloaihang'];
        if(trim($tlh) != ''){
            // echo $maloaihang;
            if($check == NULL) {
                $sql = 'update loaihanghoa set tenloaihang =\''.$tlh.'\' where maloaihang = '.$mlh.'';
                echo '
                <script>
                    alert("Cập nhật thành công !");
                </script>
                ';
                execute($sql);
            }
            else {
                echo '
                <script>
                    alert("Tên loại hàng hóa đã tồn tại !");
                </script>
                ';
            }
        }
    }
    if(isset($_POST['themlhh']) && $_POST['themlhh']){
        $tlh =  $_POST['tenloaihang'];
        // echo $tlh;
        $check = executeSingleResult('select * from loaihanghoa where tenloaihang =\''.$tlh.'\'');
        if(trim($tlh) != ''){
            $gmmaloaihang = executeSingleResult('select max(maloaihang) from loaihanghoa');
            if($gmmaloaihang['max(maloaihang)'] == NULL){
                $maloaihang = 1;
            }
            else{
                $maloaihang = $gmmaloaihang['max(maloaihang)'] + 1;
            }
            // echo $maloaihang;
            if($check == NULL) {
                $sql = 'insert into loaihanghoa(maloaihang,tenloaihang) values ('.$maloaihang.',\''.$tlh.'\')';
                echo '
                <script>
                    alert("Thêm thành công loại hàng hóa '.$tlh.' !");
                    </script>
                ';
                execute($sql);
            }
            else {
                echo '
                <script>
                    alert("Loại hàng hóa '.$tlh.' đã tồn tại !");
                    </script>
                ';
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./admin.css">
    <link rel="stylesheet" href="./fonts/themify-icons-font/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
</head>
<body>
    <div class="main">
        <?php include('nav.php'); ?>


        <div class="container">
            <div class="container-menu">
                <ul class="catalogy">
                    <li>
                        <a href="index.php" class="active" >
                            <i class="ti-shopping-cart"></i>
                            <p>Quản lý đơn đặt hàng</p>
                        </a>
                    </li>
                    <li>
                        <a href="quanlylhh.php" class="active" style="color: var(--main-color); background-color:#fff;">
                            <i class="ti-agenda"></i>
                            <p>Quản lý loại hàng hóa</p>
                        </a>
                    </li>
                    <li>
                        <a href="quanlyhanghoa.php" class="active">
                            <i class="ti-receipt"></i>
                            <p>Quản lý hàng hóa</p>
                        </a>
                    </li>
                    <li>
                        <a href="quanlykhachhang.php" class="active">
                            <i class="ti-user"></i>
                            <p>Quản lý khách hàng</p>
                        </a>
                    </li>
                    <?php
                        if($_SESSION['chucvu'] == 'Admin'){
                            echo '
                            <li>
                                <a href="quanlynhanvien.php" class="active">
                                    <i class="ti-view-list"></i>
                                    <p>Quản lý nhân viên</p>
                                </a>
                            </li>
                            ';
                        }
                    ?>
                </ul>
            </div>
            <div class="container-main">
                <div class="container-operation">
                    <div class="container-link">
                        <a href="">Trang chủ</a>
                        <i>></i>
                        <p>Quản lý loại hàng hóa</p>
                    </div>
                    <div class="container-loc">
                        <form action="" autocomplete="off" method="post">
                            <i>Lọc theo : </i>
                            <select id="label" placeholder="Tất cả" name="mucluc">
                                    <option value="Tất cả">Tất cả</option>
                                    <option value="maloaihang">Mã loại hàng</option>
                                    <option value="tenloaihang">Tên loại hàng</option>
                            </select>
                            <input type="input" list="giatri" placeholder="Giá trị" name="giatri">
                            <input type="submit" placeholder="Tất cả" class="inputsubmit" name="loc" value="Lọc">
                        </form>
                    </div>
                    <div class="container-addnew">
                        <input type="submit" value="Thêm" id="add" class="inputsubmit">
                    </div>
                </div>
                <div class="container-catalogy">
                    <div class="container-catalogy-title">
                        <div class="container-catalogy-code">
                            Mã loại hàng
                        </div>
                        <div class="container-catalogy-name">
                            Tên loại hàng
                        </div>
                        <div class="container-catalogy-button">
                            <!-- <a href=""><input type="submit" class="inputsubmit" value="xóa"></a> -->
                        </div>
                    </div>
                    <?php
                        if(isset($_POST['loc']) && ($_POST['loc'])){
                            $mucluc = $_POST['mucluc'];
                            // echo $mucluc;
                            $giatri = $_POST['giatri'];
                            // echo $giatri;
                            if($mucluc == 'Tất cả' || $mucluc == ''){
                                $sql = 'select * from loaihanghoa order by maloaihang ';
                            }
                            else{
                                $sql = 'select * from loaihanghoa where '.$mucluc.' like  \'%'.$giatri.'%\' order by maloaihang ';
                            }
                            // echo $sql;
                        }
                        else {
                            $sql = 'select * from loaihanghoa order by maloaihang ';
                        }
                        // echo $sql;
                        $ketqua = executeResult($sql);
                        foreach($ketqua as $item) {
                        echo '
                        <div class="container-catalogy-items">
                            <div class="container-catalogy-code">
                             '.$item['maloaihang'].'
                            </div>
                            <div class="container-catalogy-name">
                            '.$item['tenloaihang'].'
                            </div>
                            <div class="container-catalogy-button">
                                <input type="submit" name="capnhatlhh" onclick="capnhatlhh('.$item['maloaihang'].')" class="inputsubmit" value="Sửa">
                                <a href="quanlylhh.php?xoamlh= '.$item['maloaihang'].'"><input type="submit" class="inputsubmit" value="xóa"></a>
                            </div>
                        </div>
                        ';
                        }
                    ?>
                        <!-- <div class="container-catalogy-items">
                            <div class="container-catalogy-code">
                            <?php echo $item['maloaihang'] ?>
                            </div>
                            <div class="container-catalogy-name">
                            <?php echo $item['tenloaihang'] ?>
                            </div>
                            <div class="container-catalogy-button">
                                <input type="submit" name="capnhatlhh" onclick="capnhatlhh()" class="inputsubmit" value="Sửa"></a>
                                <a href="quanlylhh.php?xoamlh=<?php echo $item['maloaihang'] ?>"><input type="submit" class="inputsubmit" value="xóa"></a>
                            </div>
                        </div> -->
                    <!-- <div class="container-catalogy-items">
                        <div class="container-catalogy-code">
                            2
                        </div>
                        <div class="container-catalogy-name">
                            Rau củ
                        </div>
                        <div class="container-catalogy-button">
                            <a href=""><input type="submit" class="inputsubmit" value="xóa"></a>
                        </div>
                    </div> -->
                </div>


            </div>
        </div>
    </div>
    <?php
        // if(isset($_GET['']))
    ?>
    <div class="notifly-addnew">
        <div class="notifly-content">
            <h3>Thêm loại hàng hóa</h3>
            <form action="quanlylhh.php" method="post" autocomplete="off">
                <div class="form__group field field-notifly">
                    <input type="input" class="form__field" name="tenloaihang" placeholder="Tên loại hàng" value="" />
                    <label for="name" class="form__label">Tên loại hàng</label>
                </div>
                <div class="notifly-button">
                    <input type="submit" class="inputsubmit" name="themlhh" id="add-new" value="Thêm">
                    <input type="button" value="Đóng" class="inputsubmit" id="close" name="dongthemhh">
                </div>
            </form>
        </div>
    </div>
    <div class="notifly-update">
        <div class="notifly-content">
            <h3>Cập nhật loại hàng hóa</h3>
            <form action="quanlylhh.php" method="post" autocomplete="off">
                <div class="form__group field field-notifly">
                    <input type="input" class="form__field" name="tenloaihang" placeholder="Tên loại hàng" value="" />
                    <label for="name" class="form__label">Tên loại hàng</label>
                </div>
                <div class="notifly-button">
                    <input type="submit" class="inputsubmit" name="themlhh" id="update-lhh" value="Cập nhật">
                    <input type="button" value="Đóng" class="inputsubmit" id="dongcnlhh" name="dongthemhh">
                </div>
            </form>
        </div>
    </div>
    

    <script>
        const addnew = document.getElementById("add");
        const notifly = document.querySelector(".notifly-addnew");
        // const tbthemloaihanghoa = document.querySelector(".notifly")
        // setTimeout(() => {
        //     notifly.style.display = "none";
        //         // document.getElementById("hidden-add-cart").click();
        //     }, 2000);
        addnew.addEventListener("click",function(e) {
            notifly.style.display = "flex";
        });
        document.getElementById("close").addEventListener("click",function(e) {
            notifly.style.display = "none";
        })
        
    </script>
    <script>
       function capnhatlhh(maloaihang){
            // console.log(maloaihang);
            fetch('api/api-lhh.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            'maloaihang': maloaihang
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        // console.log(data);
                        // console.log(tenloaihang);
                        document.querySelector('.notifly-update').style.display = 'flex'
                        let output = `
                        <div class="notifly-content">
                            <h3>Thêm loại hàng hóa</h3>
                            <form action="quanlylhh.php" method="post" autocomplete="off">
                                <div class="form__group field field-notifly">
                                    <input type="input" hidden class="form__field" name="maloaihang" placeholder="Tên loại hàng" value="${data.maloaihang}" />
                                    <input type="input" class="form__field" name="tenloaihang" placeholder="Tên loại hàng" value="${data.tenloaihang}" />
                                    <label for="name" class="form__label">Tên loại hàng</label>
                                </div>
                                <div class="notifly-button">
                                    <input type="submit" class="inputsubmit" name="updatelhh" id="update-lhh" value="Cập nhật">
                                    <input type="button" value="Đóng" class="inputsubmit" id="dongcnlhh" name="dongthemhh">
                                </div>
                            </form>
                        </div>
                        `
                        document.querySelector('.notifly-update').innerHTML = output;

                        document.querySelector('#dongcnlhh').addEventListener("click",function(e) {
                            document.querySelector('.notifly-update').style.display = 'none';
                        })
                    })
                
       }
    </script>
</body>
</html>