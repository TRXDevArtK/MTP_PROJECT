<?php
session_start();

include('database.php');
    
    $nim = $_POST['nim'];
    $nilai = $_POST['nilai'];
    $idmatkul = $_POST['idmatkul'];
    
    $_SESSION['nim'] = $nim;
    $_SESSION['nilai'] = $nilai;
    $_SESSION['idmatkul'] = $idmatkul;
    
    $date = date('d-m-Y');
    
    for($i = 0; $i < count($nim); $i++){
        $query = "UPDATE `$idmatkul` SET `nilai` = '$nilai[$i]', `tanggal_nilai` = '$date' WHERE `$idmatkul`.`nim` = $nim[$i]";
        mysqli_query($conn2, $query);
    }

?>
