<?php

include('database.php');

//LOAD DATA
if(isset($_POST['key']) && $_POST['key'] == 'load'){
    $nim = $_POST['nim'];
    $u_mtk = "";
    $t_mtk = "";
    
    if(isset($_POST['mtk']) && $_POST['mtk'] == 'skp'){
        $u_mtk = "%_______skp_mtk";
        $t_mtk = "idmtk_skp";
        $c_mtk = "_skp_mtk";
    }
    else if(isset($_POST['mtk']) && $_POST['mtk'] == 'mtk'){
        $u_mtk = "%_______mtk";
        $t_mtk = "idmtk";
        $c_mtk = "_mtk";
    }
    
    $query = "SELECT count(*) AS number_table from INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME LIKE '$u_mtk'";
    $sql_run = mysqli_query($conn2, $query);
    $row = mysqli_fetch_assoc($sql_run);
    $number_table = $row['number_table'];
    
    $query = "SHOW TABLES LIKE '$u_mtk'";
    $sql_run = mysqli_query($conn2, $query);
    
    while($row = mysqli_fetch_array($sql_run)){
        $data[] = $row;
    }
    
    $datas = array();
    $datas2 = array();
    foreach($data as $single_data){
        $query = "SELECT $single_data[0].id, $t_mtk.nama, $single_data[0].nilai, $single_data[0].tanggal_nilai FROM $single_data[0],$t_mtk WHERE $single_data[0].id = $t_mtk.id AND nim = $nim";
        $sql_run = mysqli_query($conn2, $query);
        
        while($row = mysqli_fetch_assoc($sql_run)){
            $datas[] = $row;
        }
        
        
        $chpmtk = chop($single_data[0],$c_mtk);
        $query = "select A,B,C,D from descmtk,$t_mtk where descmtk.id = $t_mtk.id and $t_mtk.id = '$chpmtk'";
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
    
    if(isset($_POST['mtk']) && $_POST['mtk'] == 'skp'){
        $c_mtk = "_skp_mtk";
    }
    else if(isset($_POST['mtk']) && $_POST['mtk'] == 'mtk'){
        $c_mtk = "_mtk";
    }
    
    date_default_timezone_set('Asia/Jakarta');
    $date = date('G:i - d/M/Y');
    
    for($i = 0; $i < count($idmatkul); $i++){
        $query = "UPDATE `".$idmatkul[$i].$c_mtk."` SET `nilai` = '$nilai[$i]', `tanggal_nilai` = '$date' WHERE `".$idmatkul[$i].$c_mtk."`.`nim` = $nim";
        mysqli_query($conn2, $query);
        //echo $query;
    }
}

//DELETE
if(isset($_POST['key']) && $_POST['key'] == 'delete'){
    $idmatkul = $_POST['id'];
    $nim = $_POST['nim']; //STATIC
    
    if(isset($_POST['mtk']) && $_POST['mtk'] == 'skp'){
        $c_mtk = "_skp_mtk";
    }
    else if(isset($_POST['mtk']) && $_POST['mtk'] == 'mtk'){
        $c_mtk = "_mtk";
    }
    
    for($i = 0; $i < count($idmatkul); $i++){
        $query = "DELETE FROM `".$idmatkul[$i].$c_mtk."` WHERE `".$idmatkul[$i].$c_mtk."`.`nim` = $nim";
        mysqli_query($conn2, $query);
    }
}

//EDIT DATA PRESENSI
if(isset($_POST['key']) && $_POST['key'] == 'presensi_edit'){
    
    $nim = $_POST['nim']; //STATIC
    $sakit = $_POST['sakit'];
    $izin = $_POST['izin'];
    $tanpa_ket = $_POST['tanpa_ket'];
    
    $query = "UPDATE `presensi` SET `sakit` = '$sakit', `izin` = '$izin', `tanpa_ket` = '$tanpa_ket' WHERE `presensi`.`nim` = $nim";
    mysqli_query($conn2, $query);
}

//LOAD DATA PRESENSI
if(isset($_POST['key']) && $_POST['key'] == 'presensi_load'){
    
    $nim = $_POST['nim']; //STATIC

    $query = "SELECT sakit,izin,tanpa_ket FROM presensi WHERE nim = $nim";
    $sql_run = mysqli_query($conn2, $query);
    
    $row = mysqli_fetch_assoc($sql_run);
    
    $data = $row;
    
    echo json_encode($data);
}


