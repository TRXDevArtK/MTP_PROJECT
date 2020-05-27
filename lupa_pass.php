<?php
    ob_start();
    session_start();
    #include sesuatu disini
    include_once "sql_connect.php";
    
    $warning = 0;
    if(isset($_POST['submit']) && !empty($_POST['email'])){
        $email = $_POST['email'];
        if(empty($email)){
            $warning = 1;
            //header("location:email_inp.php");
        }
        else{
            $query = "SELECT email FROM users WHERE email='$email'";
            $sql_run = mysqli_query($conn, $query);

            if(mysqli_num_rows($sql_run) <= 0) {
                $warning = 2;
            }
            else{
                /*Algoritma : cek email di user_reset, apabila ada maka update, apabila baru maka insert */
                $pin = bin2hex(random_bytes(20));
                $query2 = "SELECT email FROM users_reset WHERE email='$email'";
                $sql_run2 = mysqli_query($conn, $query2);
                $check = mysqli_num_rows($sql_run2);
                if($check > 0){
                    $query = "UPDATE users_reset SET email='$email', pin='$pin' where email='$email'";
                    $sql_run = mysqli_query($conn, $query);
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
                    $query = "INSERT INTO users_reset(email, pin) VALUES ('$email', '$pin')";
                    $sql_run = mysqli_query($conn, $query);
                    //UNTUK DEBUG SAJA
                    /*
                    if($sql_run){
                        echo "BERHASIL 2";
                    }
                    else{
                        echo "GAGAL 2";
                    }*/
                }

                // FILE EMAILNYA
                $to = $email;
                $subject = "RESET PASSWORD DJAZMAN";
                $msg = "Hi, untuk reset password kamu, klik link ini ".$_SERVER['HTTP_HOST']."/pass_baru.php?pin=" . $pin ."";
                $msg = wordwrap($msg,70);
                $headers = "From: androrobot1234567890@gmail.com";
                $mail_sent = mail($to, $subject, $msg, $headers);
                header('location:pending.php?email=' . $email);
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
                <a href="index.php"><div class="btn btn-warning">Kembali</div></a>
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


