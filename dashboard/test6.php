<?php
    //select.php

    session_start();

    include('database.php');
   
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
        $query = "SELECT $single_data[0].nim, idmtk.nama, $single_data[0].nilai FROM $single_data[0],idmtk WHERE $single_data[0].id = idmtk.id AND nim = 1700018014";
        $sql_run = mysqli_query($conn2, $query);
        
        while($row = mysqli_fetch_assoc($sql_run)){
            $datas[] = $row;
        }
    }
    
    echo json_encode($datas);
?>