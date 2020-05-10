<?php

session_start();

include('database.php');

//LOAD DATA
if(isset($_POST['key']) && $_POST['key'] == 'load'){
    $nim = $_POST['nim'];
   
    $query = "SELECT count(*) AS number_table from INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME LIKE '%_______mtk'";
    $sql_run = mysqli_query($conn2, $query);
    $row = mysqli_fetch_assoc($sql_run);
    $number_table = $row['number_table'];
    
    $query = "SHOW TABLES LIKE '%_______mtk'";
    $sql_run = mysqli_query($conn2, $query);
    
    while($row = mysqli_fetch_array($sql_run)){
        $data[] = $row;
    }

    foreach($data as $single_data){
        $query = "SELECT $single_data[0].id, idmtk.nama, $single_data[0].nilai, $single_data[0].tanggal_nilai FROM $single_data[0],idmtk WHERE $single_data[0].id = idmtk.id AND nim = $nim";
        $sql_run = mysqli_query($conn2, $query);
        
        while($row = mysqli_fetch_assoc($sql_run)){
            $datas[] = $row;
        }
        
        $chpmtk = chop($single_data[0],"_mtk");
        $query = "select A,B,C,D from descmtk,idmtk where descmtk.id = idmtk.id and idmtk.id = $chpmtk";
        $sql_run = mysqli_query($conn2, $query);
        
        while($row = mysqli_fetch_assoc($sql_run)){
            $datas2[] = $row;
        }
    }
    
    $jumlah = count($datas);
    
    for($i=0;$i<$jumlah;$i++){
        $datas[$i]['A'] = $datas2[$i]['A'];
        $datas[$i]['B'] = $datas2[$i]['B'];
        $datas[$i]['C'] = $datas2[$i]['C'];
        $datas[$i]['D'] = $datas2[$i]['D'];
    }
    
    echo json_encode($datas);
}

//UPDATE
if(isset($_POST['key']) && $_POST['key'] == 'update'){
    $idmatkul = $_POST['id'];
    $nim = $_POST['nim']; //STATIC
    $nilai = $_POST['nilai'];
    
    date_default_timezone_set('Asia/Jakarta');
    $date = date('G:i - d/M/Y');
    
    for($i = 0; $i < count($idmatkul); $i++){
        $query = "UPDATE `$idmatkul[$i]_mtk` SET `nilai` = '$nilai[$i]', `tanggal_nilai` = '$date' WHERE `$idmatkul[$i]_mtk`.`nim` = $nim";
        mysqli_query($conn2, $query);
    }
}

//DELETE
if(isset($_POST['key']) && $_POST['key'] == 'delete'){
    $idmatkul = $_POST['id'];
    $nim = $_POST['nim']; //STATIC
    
    for($i = 0; $i < count($idmatkul); $i++){
        $query = "DELETE FROM `$idmatkul[$i]_mtk` WHERE `$idmatkul[$i]_mtk`.`nim` = $nim";
        mysqli_query($conn2, $query);
    }
}

