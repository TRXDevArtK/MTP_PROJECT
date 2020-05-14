<?php

    include('database.php');
    
    $nim = 1700018013;
    $u_mtk = "";
    $t_mtk = "";

    $u_mtk = "%_______mtk";
    $t_mtk = "idmtk";
    $c_mtk = "_mtk";
    
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
    
    echo $datas[0]['id'];
?>

