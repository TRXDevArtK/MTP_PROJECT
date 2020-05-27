<?php

    $nim = $_POST['nim'];

    ob_start();
    include 'laporan_xls.php';
    $string = ob_get_clean();
    
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=$nim"."_raport.xls");
    
    echo $string;
    
    $_SESSION['nim'] = $nim;
    header('Location:peserta_data.php');
    exit();
?>

