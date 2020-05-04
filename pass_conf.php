<?php
session_start();
#include sesuatu disini
include_once "sql_connect.php";
?>

<?php   
    $pass_baru = $_POST['pass_baru'];
    $pass_baru_c = $_POST['pass_baru_c'];
    $pin = $_SESSION['pin'];
    unset ($_SESSION['pin']);

    $error = 0;
    if (empty($pass_baru) || empty($pass_baru_c)){
        $_SESSION['error1'] = "Password Kosong/Salah";
        $error = 1;
        header("location:pass_baru.php?pin=" . $pin ."");
    }
    if ($pass_baru !== $pass_baru_c){
        $_SESSION['error2'] = "Password Tidak Sama";
        $error = 1;
        header("location:pass_baru.php?pin=" . $pin ."");
    }
    
    if($error == 0){
        $query = "SELECT email FROM users_reset where pin ='$pin' LIMIT 1";
        $sql_run = mysqli_query($conn, $query);
        $email = mysqli_fetch_assoc($sql_run)['email'];

        if($email) {
            $pass_baru = password_hash($pass_baru, PASSWORD_DEFAULT);
            $query = "UPDATE users SET password='$pass_baru' WHERE email='$email'";
            $sql_run = mysqli_query($conn, $query);
            
            $_SESSION['pass_notf'] = "Ubah password berhasil, silahkan login kembali";
            header("location:index.php");
        }
    }
?>