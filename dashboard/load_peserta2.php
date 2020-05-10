<?php
    //select.php

    session_start();

    include('database.php');
    
    $nim = $_POST['nim'];
   
    $query = "SELECT count(*) AS number_table from INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME LIKE '%_______mtk'";
    $sql_run = mysqli_query($conn2, $query);
    $row = mysqli_fetch_assoc($sql_run);
    $number_table = $row['number_table'];
    
    $query = "select *from pes_mtk where nim = $nim";
    $sql_run = mysqli_query($conn2, $query);
    $rowcount = mysqli_num_fields($sql_run);
    
    while($row = mysqli_fetch_array($sql_run)){
        $data[] = $row;
    }
    
    $datas = array();
    for($i=1;$i < $rowcount;$i++){
        $query = "SELECT ".$data[0][$i]."_mtk.id, idmtk.nama, ".$data[0][$i]."_mtk.nilai, ".$data[0][$i]."_mtk.tanggal_nilai FROM ".$data[0][$i]."_mtk,idmtk WHERE ".$data[0][$i]."_mtk.id = idmtk.id AND nim = $nim";
        $sql_run = mysqli_query($conn2, $query);
        
        //Kalau data = NULL, ABAIKAN.
        if (!$sql_run){
            //NULL / 0
        }
        else{
            while($row = mysqli_fetch_assoc($sql_run)){
                $datas[] = $row;
            }
        }
    }
    
    echo json_encode($datas);
?>