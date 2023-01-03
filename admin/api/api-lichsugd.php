<?php
    require_once('dataprocessing.php');
    $arr = [];
    $data = json_decode(file_get_contents('php://input'), true);
    // $sql = 'select * from dathang where mskh = '.$data['mskh'];
    $sql = 'select * from dathang d join chitietdathang c on d.sodondh = c.sodondh where d.mskh = ' .$data['mskh'];
    $result = executeResult($sql);
    foreach ($result as $rs){
        // $sqli = 'select *,(select tenhinh from hinhhanghoa where mshh = c.mshh limit 1) as tenhinh from chitietdathang c JOIN hanghoa h on c.mshh = h.mshh WHERE c.sodondh = '.$rs['sodondh'].'';
        $sqli = 'select * from dathang d JOIN chitietdathang c on d.sodondh=c.sodondh join hanghoa h on c.mshh = h.mshh join hinhhanghoa hh on c.mshh=hh.mshh where d.mskh='.$data['mskh'].' and d.sodondh = '.$rs['sodondh'].' and h.mshh = '.$rs['mshh'].' limit 1';
        $items = executeResult($sqli);
        // $array = array('hoadon' => $rs,'chitiethoadon' => $item);
        // $array = array('chitiethoadon' => $items);
        // echo json_encode($rs);
        foreach ($items as $item){
            $array = array('chitiethoadon' => $item);
            array_push($arr,$array);
        }
        // array_push($arr,$array);
    }
    echo json_encode($arr);
    
?>