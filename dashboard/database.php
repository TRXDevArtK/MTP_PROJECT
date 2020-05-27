<?php
    ob_start();
    session_start();
    
    //CEK LOGIN
    //HAPUS INI KALAU MAU DEBUG DI POSTMAN
    if(!isset($_SESSION['status']) && !isset($_SESSION['login_id'])){
        //Kalau status gk ada, balik ke index
        header("location:../index.php");
        exit();
    }
    else{
        $now = time();

        if ($now > $_SESSION['expire']) {
            session_destroy();
            header("location:../index.php");
            exit();
        }
    }
    
    $conn2 = new mysqli('localhost','root','','mtk');
?>



