<?php
    require_once('dataprocessing.php');
    $data = json_decode(file_get_contents('php://input'), true);
    $sql = 'select * from  loaihanghoa where maloaihang = "'.$data['maloaihang'].'"';
    $rs = executeSingleResult($sql);
    echo json_encode($rs);
?>