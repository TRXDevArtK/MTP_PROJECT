<?php
    ob_start();
    session_start();
    #include sesuatu disini
    include_once "sql_connect.php";
    
    $warning = 0;
    
    //jika ada post submit dan post email ada dan tidak kosong maka
    if(isset($_POST['submit']) && !empty($_POST['email'])){
        $email = $_POST['email'];
        //jika email kosong
        if(empty($email)){
            $warning = 1;
            //header("location:email_inp");
        }
        //jika email ada
        else{
            
            //cek email di database apakah ada atau tidak
            $query = "SELECT email FROM users WHERE email=?";
            $sql_run = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($sql_run, "s", $email);
            mysqli_stmt_execute($sql_run);
            $result = mysqli_stmt_get_result($sql_run);

            //jika email tidak ada
            if(mysqli_num_rows($result) <= 0) {
                $warning = 2;
            }
            
            //jika email ada di database maka kirim email
            else{
                /*Algoritma : cek email di user_reset, apabila ada maka update, apabila baru maka insert */
                $pin = bin2hex(random_bytes(20));
                $query2 = "SELECT email FROM users_reset WHERE email = ?";
                $sql_run = mysqli_prepare($conn, $query2);
                mysqli_stmt_bind_param($sql_run, "s", $email);
                mysqli_stmt_execute($sql_run);
                $result = mysqli_stmt_get_result($sql_run);
                
                $check = mysqli_num_rows($result);
                if($check > 0){
                    $query = "UPDATE users_reset SET email=?, pin=? where email=?";
                    $sql_run = mysqli_prepare($conn, $query);
                    mysqli_stmt_bind_param($sql_run, "sss", $email,$email,$email);
                    mysqli_stmt_execute($sql_run);
                    $result = mysqli_stmt_get_result($sql_run);
                    //UNTUK DEBUG SAJA
                    /*
                    if($sql_run){
                        echo "BERHASIL 1";
                    }
                    else{
                        echo "GAGAL 1";
                    }*/
                }
                else{
                    $query = "INSERT INTO users_reset(email, pin) VALUES (?, ?)";
                    $sql_run = mysqli_prepare($conn, $query);
                    mysqli_stmt_bind_param($sql_run, "ss", $email,$pin);
                    mysqli_stmt_execute($sql_run);
                    $result = mysqli_stmt_get_result($sql_run);
                    //UNTUK DEBUG SAJA
                    /*
                    if($sql_run){
                        echo "BERHASIL 2";
                    }
                    else{
                        echo "GAGAL 2";
                    }*/
                }

                // FILE EMAILNYA & kirim
                $to = $email;
                $subject = "RESET PASSWORD DJAZMAN";
                $msg = "Hi, untuk reset password kamu, klik link ini ".$_SERVER['HTTP_HOST']."/pass_baru?pin=" . $pin ."";
                $msg = wordwrap($msg,70);
                $headers = "From: androrobot1234567890@gmail.com";
                $mail_sent = mail($to, $subject, $msg, $headers);
                header('location:pending?email=' . $email);
                exit();
            }
        }
    }
?>

<html>
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
    <body style="background:skyblue">
        <div class="login-form">
            <form class="lupa_pass" method="POST" action="#">
                <?php if($warning == 1){ ?>
                <p class="text-center" style="color:red"> Mohon Masukkan Emailnya </p>
                <br>
                <?php } 
                else if($warning == 2){ ?>
                <p class="text-center" style="color:red"> Maaf tidak ada user terdaftar dengan email tersebut </p>
                <br>
                <?php } ?>
                <a href="index"><div class="btn btn-warning">Kembali</div></a>
                <h3 class="text-center">Form Lupa Password</h3> 
                <br>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Masukkan Email" name="email" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" name="submit">Submit</button>
                </div>
            </form>
        </div>
        
    </body>
</html>


