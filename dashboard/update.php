<?php

include('database.php');
    
    $nim = $_POST['nim'];
    $nilai = $_POST['nilai'];
    $idmatkul = $_POST['idmatkul'];
    
    date_default_timezone_set('Asia/Jakarta');
    $date = date('G:i - d/M/Y');
    
    for($i = 0; $i < count($nim); $i++){
        $query = "UPDATE `$idmatkul` SET `nilai` = '$nilai[$i]', `tanggal_nilai` = '$date' WHERE `$idmatkul`.`nim` = $nim[$i]";
        mysqli_query($conn2, $query);
    }

?>
