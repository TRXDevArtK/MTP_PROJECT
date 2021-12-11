<?php
    ob_start();
    session_start();
    #include sesuatu disini
    include_once "sql_connect.php";
    
?>

<?php
    //pada email yang ada maka klik link, otomatis akan GET pinnya dan ambil
    $pin = $_GET['pin'];
    //$_SESSION['pin'] = $pin;
    
    //cekp in jika ada di database
    $query = "SELECT 1 FROM users_reset where pin = '$pin'";
    $sql_run = mysqli_query($conn,$query);
    
    //jika pin tidak ada maka kembali ke login
    if(mysqli_num_rows($sql_run) != 1){
        header('location:index');
        exit();
    }
    
    //jika ada
    if(isset($_POST['new_password'])){
        
        //ambil pass & pass confirmasi
        $pass_baru = $_POST['pass_baru'];
        $pass_baru_c = $_POST['pass_baru_c'];
        $error = 0;
        
        //kalau passbaru kosong maka kirim notifikasi
        if (empty($pass_baru) || empty($pass_baru_c)){
            $_SESSION['error1'] = "Password Kosong/Salah";
            $error = 1;
        }
        //kalau passbaru tidak sama dengan password confirm maka kirim notifikasi
        if ($pass_baru !== $pass_baru_c){
            $_SESSION['error2'] = "Password Tidak Sama";
            $error = 1;
        }
        
        //apabila tidak ada error (masih 0 warningnya)
        if($error == 0){
            //cek pinnya & ambil email
            $query = "SELECT email FROM users_reset where pin = ? LIMIT 1";
            $sql_run = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($sql_run, "s", $pin);
            mysqli_stmt_execute($sql_run);
            $result = mysqli_stmt_get_result($sql_run);
            $email = mysqli_fetch_assoc($result)['email'];
            
            //jika pin ada dan emailnya : 
            if($email) {
                
                //hasing passwordbaru
                $pass_baru = password_hash($pass_baru, PASSWORD_DEFAULT);
                
                //jalankan querynya, simpan passbaru ke target user
                $query = "UPDATE users SET password= ? WHERE email= ? ";
                $sql_run = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($sql_run, "ss", $pass_baru, $email);
                mysqli_stmt_execute($sql_run);

                //kirim notofikasi dan redirect ke login
                $_SESSION['pass_notf'] = "Ubah password berhasil, silahkan login kembali";
                header("location:index");
                exit();
            }
        }
    }
    
    /*if (isset($_SESSION['error1'])){
        echo $_SESSION['error1'];
        #hapus method loginsalah yang tidak digunakan setelah refresh page
        unset ($_SESSION['error1']);
    }
    if (isset($_SESSION['error2'])){
        echo $_SESSION['error2'];
        #hapus method loginsalah yang tidak digunakan setelah refresh page
        unset ($_SESSION['error2']);
    }*/

?>

<!DOCTYPE html>
<html lang="en">
    <head>
	<!--Metadata-->
        <meta charset="UTF-8">
        <script src="js/jquery.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css" />  
        <script src="js/bootstrap.min.js"></script>  
        <title></title>
        <style type="text/css">
            .login-form {
                width: 340px;
                margin: 50px auto;
            }
            .login-form form {
                margin-bottom: 15px;
                background: #f7f7f7;
                box-shadow: 0px 9px 12px rgba(0, 0, 0, 0.41);
                padding: 65px;
                position: fixed;
                top: 50%;
                left: 50%;
                background-color: white;
                transform: translate(-50%, -50%);
                width:45%;
            }
            .login-form h2 {
                margin: 0 0 15px;
            }
            .form-control, .btn {
                min-height: 38px;
                border-radius: 2px;
            }
            .btn {        
                font-size: 15px;
                font-weight: bold;
            }
        </style>
    </head>
    <body style="background: skyblue">
        <div class="login-form">
            <form class="pass_baru" method="post" action="#">
               <?php if(isset($_SESSION['error1'])){ ?>
                    <p style="color:red" class="text-center"> Notifikasi : <?= $_SESSION['error1']; ?></p>
                <?php unset($_SESSION['error1']); } 
                else if(isset($_SESSION['error2'])){ ?>
                    <p style="color:red" class="text-center"> Notifikasi : <?= $_SESSION['error2']; ?></p>
                <?php unset ($_SESSION['error2']); } ?>
                <h3 class="text-center">Password Baru</h3> 
                <br>
                <div class="form-group">
                    <label>Masukkan Password</label>
                    <input class="form-control" type="password" name="pass_baru" required="require">
                </div>
                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input class="form-control" type="password" name="pass_baru_c" required="require">
                </div>
                <div class="form-group">
                    <button type="submit" name="new_password" class="btn btn-primary btn-block">Submit</button>
                </div>
            </form>
        </div>
    </body>
</html>