<?php
    ob_start();
    session_start();
    
    //CEK LOGIN (selalu dipanggil di awal page dashboard dan childnya
    //HAPUS INI KALAU MAU DEBUG DI POSTMAN
    if(!isset($_SESSION['status']) && !isset($_SESSION['login_id'])){
        //Kalau status gk ada, balik ke index
        header("location:../index");
        exit();
    }
    else{
        
        //login
        $now = time();

        //kalau loginnya sudah kadaluarsa maka
        //session destroy dan kembali ke halaman login
        if ($now > $_SESSION['expire']) {
            session_destroy();
            header("location:../index");
            exit();
        }
    }
    
    //ambil database.php untuk keperluan manajemen (user,nilai,etc)
    $conn2 = new mysqli('localhost','root','','mtk');
?>



