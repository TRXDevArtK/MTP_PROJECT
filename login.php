<?php

    ob_start();
    session_start();
    #include sesuatu disini
    include_once "sql_connect.php";
    
?>

<?php
    //ambil post username dan password
    $username = $_POST['username'];
    $password = $_POST['password'];
    //Jika perlu , untuk auth 2x nanti
    //$_SESSION['username'] = $username;
    //$_SESSION['password'] = $password;
    
    //ambil id,username,password dari database
    $query = "SELECT *FROM users where username= ?";
    $sql_run = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($sql_run, "s", $username);
    mysqli_stmt_execute($sql_run);
    $result = mysqli_stmt_get_result($sql_run);
    $row = mysqli_fetch_assoc($result);
    
    $id = $row["id"];
    $db_username = $row["username"];
    $db_password = $row["password"];
    
    //verifikasi post password dengan database password yang terenkripsi
    $conf_password = password_verify($password, $db_password);

    //jika username sama dengan database username
    //dan konfirmasi masi password benar, maka tambah session untuk login
    //dan redirect ke index.php (setelah itu ke dashboard index)
    if(($username == $db_username) && $conf_password == true){
        $_SESSION['login_id'] = $id;
        $_SESSION['status'] = "login";
        $_SESSION['start'] = time();
        if(isset($_POST['save'])){
            $_SESSION['expire'] = $_SESSION['start'] + (1 * 24 * 60 * 60 );
        }
        else{
            $_SESSION['expire'] = $_SESSION['start'] + (180 * 60);
        }
        header("location:index.php");
        exit();
        
    }
    
    //jika salah maka tambahkan session login salah
    //dan kembali lagi ke page login
    else{
        $_SESSION['loginsalah'] = "Login salah, silahkan coba lagi";  
        header("location:index.php");
        exit();
    }
    
?>

