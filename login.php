<?php

    ob_start();
    session_start();
    #include sesuatu disini
    include_once "sql_connect.php";
    
?>

<?php
    $username = $_POST['username'];
    $password = $_POST['password'];
    //Jika perlu , untuk auth 2x nanti
    //$_SESSION['username'] = $username;
    //$_SESSION['password'] = $password;
    
    $query = "SELECT *FROM users where username='$username'";
    $sql_run = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($sql_run);
    
    $id = $row["id"];
    $db_username = $row["username"];
    $db_password = $row["password"];
    
    $conf_password = password_verify($password, $db_password);

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
    else{
        $_SESSION['loginsalah'] = "Login salah, silahkan coba lagi";  
        header("location:index.php");
        exit();
    }
    
?>

