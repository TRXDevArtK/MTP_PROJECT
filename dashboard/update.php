<?php
session_start();

include('database.php');
    
    $nim = $_POST['nim'];
    $nilai = $_POST['nilai'];
    $idmatkul = $_POST['idmatkul'];
    
    $_SESSION['nim'] = $nim;
    $_SESSION['nilai'] = $nilai;
    $_SESSION['idmatkul'] = $idmatkul;
    
    //TINGGAALLL QUERY LAGI
    
    for($i = 0; $i < count($nim); $i++){
        mysqli_query($conn2, "UPDATE nilaimtk SET `$idmatkul` = '$nilai[$i]' WHERE nilaimtk.nim = $nim[$i]");
    }

?>
