<?php

include('database.php');
    
    $idmatkul = $_POST['id'];
    $nim = $_POST['nim']; //STATIC
    $nilai = $_POST['nilai'];
    $tanggal_nilai = $_POST['tanggal_nilai'];
    
    for($i = 0; $i < count($idmatkul); $i++){
        $query = "UPDATE `$idmatkul[$i]_mtk` SET `nilai` = '$nilai[$i]', `tanggal_nilai` = '$tanggal_nilai[$i]' WHERE `$idmatkul[$i]_mtk`.`nim` = $nim";
        mysqli_query($conn2, $query);
    }

?>
