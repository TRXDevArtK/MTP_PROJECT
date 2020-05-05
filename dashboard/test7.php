<?php
    include_once "database.php";
    
    $id = mt_rand(1000000, 9999999);
    $id = $id."_mtk";
    $query = "CREATE TABLE $id (id INT(7) NULL, "
            . "nim INT(11) PRIMARY KEY, "
            . "nilai CHAR(1) NULL, "
            . "tanggal_nilai VARCHAR(15) NULL)";
    $sql_run = mysqli_query($conn2, $query);
    
    if($sql_run){
        echo "berhasil";
    }
    else{
        echo "gagal";
    }
    
?>