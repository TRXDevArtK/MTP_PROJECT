<?php
    session_start();
    #include sesuatu disini
    include_once "sql_connect.php";
?>

<?php
    #ambil get/post dan olah disini
    #untuk pemberithuan / notifikasi dari post php
    $errors = [];
    if (isset($_SESSION['error1'])){
        echo $_SESSION['error1'];
        #hapus method loginsalah yang tidak digunakan setelah refresh page
        unset ($_SESSION['error1']);
    }
    if (isset($_SESSION['error2'])){
        echo $_SESSION['error2'];
        #hapus method loginsalah yang tidak digunakan setelah refresh page
        unset ($_SESSION['error2']);
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
	<meta charset="UTF-8">
	<title>Password Reset</title>
	<link rel="stylesheet" href="main.css">
    </head>
    <body>
        <?php 
        $pin = $_GET['pin'];
        $_SESSION['pin'] = $pin;
        $query = "SELECT pin FROM users_reset where pin = '$pin'";
        
        if(isset($pin))
        { 
        ?>
        <form class="pass_baru" method="post" action="pass_conf.php">
            <h2 class="form-title">New password</h2>
            <div class="form-group">
                    <label>Masukkan Password</label>
                    <input type="password" name="pass_baru">
            </div>
            <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="pass_baru_c">
            </div>
            <div class="form-group">
                    <button type="submit" name="new_password" class="login-btn">Submit</button>
            </div>
        </form>
        
        <?php
        }
        else{
            header("location:index.php");
        }
        ?>
    </body>
</html>