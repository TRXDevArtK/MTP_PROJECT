<?php
    session_start();
    #include sesuatu disini
    include_once "sql_connect.php";
?>

<?php
    $email = $_POST['email'];
    if(empty($email)) {
        echo "Mohon Masukkan Emailnya";
        header("location:email_inp.php");
    }
    else{
        $query = "SELECT email FROM users WHERE email='$email'";
        $sql_run = mysqli_query($conn, $query);

        if(mysqli_num_rows($sql_run) <= 0) {
            echo "Maaf tidak ada user terdaftar dengan email tersebut";
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
            $subject = "RESET PASSWORD ADMIN WEB";
            $msg = "Hi, untuk reset password kamu, klik link ini http://localhost/MTP_PROJECT/pass_baru.php?pin=" . $pin ."";
            $msg = wordwrap($msg,70);
            $headers = "From: androrobot1234567890@gmail.com";
            $mail_sent = mail($to, $subject, $msg, $headers);
            echo "haloo ???";
            header('location:pending.php?email=' . $email);
        }
    }
?>


