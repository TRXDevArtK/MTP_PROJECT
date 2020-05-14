<?php
    session_start();
    
    //CEK LOGIN
    //HAPUS INI KALAU MAU DEBUG DI POSTMAN
    /*if(!isset($_SESSION['status'])){
        header("location:../index.php");
    }*/
    
    $conn2 = new mysqli('localhost','root','','mtk');
?>



