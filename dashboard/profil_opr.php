<?php
    ob_start();
    
    include_once "database.php";
    include_once "../sql_connect.php";
    
    if(isset($_POST['gantiusername'])){
        $username = $_POST['username'];
        $username_conf = $_POST['username_conf'];
        $id = $_SESSION['login_id'];
        
        if($username === $username_conf){
            $query = "UPDATE `users` SET `username` = '$username' WHERE `users`.`id` = '$id'";
            $sql_run = mysqli_query($conn,$query);
            
            $_SESSION['warning'] = "Operasi ubah username berhasil";
            header('location:profil');
            exit();
        }
        else{
            $_SESSION['danger'] = "Operasi ubah username gagal (nama konfirmasi tidak sama)";
            header('location:profil');
            exit();
        }
    }
    
    else if(isset($_POST['gantipassword'])){
        $password = $_POST['password'];
        $password_conf = $_POST['password_conf'];
        $id = $_SESSION['login_id'];
        
        if($password === $password_conf){
            $password = password_hash($password, PASSWORD_DEFAULT);
            $query = "UPDATE `users` SET `password` = '$password' WHERE `users`.`id` = '$id'";
            $sql_run = mysqli_query($conn,$query);
            
            $_SESSION['warning'] = "Operasi ubah password berhasil";
            header('location:profil');
            exit();
        }
        else{
            $_SESSION['danger'] = "Operasi ubah password gagal (password konfirmasi tidak sama)";
            header('location:profil');
            exit();
        }
    }
    
    else if(isset($_POST['gantiemail'])){
        $email = $_POST['email'];
        $email_conf = $_POST['email_conf'];
        $id = $_SESSION['login_id'];
        
        if($email === $email_conf){
            $query = "UPDATE `users` SET `email` = '$email' WHERE `users`.`id` = '$id'";
            $sql_run = mysqli_query($conn,$query);
            
            $_SESSION['warning'] = "Operasi ubah email berhasil";
            header('location:profil');
            exit();
        }
        else{
            $_SESSION['danger'] = "Operasi ubah email gagal (email konfirmasi tidak sama)";
            header('location:profil');
            exit();
        }
    }
    
    else if(isset($_POST['akunbaru'])){
        $email = $_POST['email'];
        $email_conf = $_POST['email_conf'];
        $admin = "no";
        
        if(isset($_POST['admin_ck'])){
            $admin = 'yes';
        }
        
        $state = 0;
        $query = "SELECT 1 FROM users where email = '$email'";
        $sql_run = mysqli_query($conn,$query);
        if(mysqli_num_rows($sql_run)==1){
            $state = 1;
            $_SESSION['danger'] = "Operasi tambah user gagal (email sudah terdaftar)";
            header('location:profil');
            exit();
        }
        
        //INI CEK DULU EMAILNYA SAMA APA GK, PR. SAMA NOTIF BERHASIL PR.
        if(($email === $email_conf) && $state == 0){
            
            $seed = str_split('abcdefghijklmnopqrstuvwxyz'
                 .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                 .'0123456789!@#$%^&*()'); 
            shuffle($seed);
            $rand = '';
            foreach (array_rand($seed, 8) as $k){ 
                $rand .= $seed[$k];
            }
            
            //dapatkan username
            $username = $rand;
            
            foreach (array_rand($seed, 10) as $k){ 
                $rand .= $seed[$k];
            }
            
            //dapatkan password
            $password = $rand;
            $password_hash = password_hash($rand, PASSWORD_DEFAULT);
            
            $id = mt_rand(10000000000, 99999999999);
            
            $query = "INSERT INTO `users` (`id`, `username`, `password`, `email`, `admin`) VALUES ('$id', '$username', '$password_hash', '$email', '$admin')";
            $sql_run = mysqli_query($conn,$query);
            
            //TULIS EMAILNYA
            $to = $email;
            $subject = "AKUN BARU DARI DJAZMAN WEB";
            $msg = "Silahkan kunjungi djazman web di ".$_SERVER['HTTP_HOST']."\n"
                    . "Username : ".$username."\n"
                    . "Password : ".$password."\n"
                    . "ini adalah email penting, jangan sampai orang tahu";
            $msg = wordwrap($msg,70);
            $headers = "From: androrobot1234567890@gmail.com";
            $mail_sent = mail($to, $subject, $msg, $headers);
            
            if($mail_sent == true){
                $_SESSION['warning'] = "Operasi tambah user berhasil";
                header('location:profil');
                exit();
            }
            else{
                $_SESSION['danger'] = "Mail tidak terkirim untuk operasi tambah user";
                header('location:profil');
                exit();
            }
            
        }
        else{
            $_SESSION['danger'] = "Operasi tambah user gagal (email tidak sama)";
            header('location:profil');
            exit();
        }
    }
    else if(isset($_POST['form_conf'])){
        $judul = $_POST['judul'];
        $deskripsi = $_POST['deskripsi'];
        $link_baru = $_POST['link_baru'];
        $link_lama = $_POST['link_lama'];
        $id = 9765;
        
        if($link_baru === $link_lama){
            $_SESSION['danger'] = "Nama link masih sama dengan nama lama";
            header('location:profil');
            exit();
        }
        else{
            $renaming = rename("../".$link_lama.".php", "../".$link_baru.".php");
            if($renaming == true){
                $query = "UPDATE `form_data` SET `judul` = ?, `deskripsi` = ?, `link` = ?, `id` = ? WHERE `form_data`.`id` = ?";
                $sql_run = mysqli_prepare($conn2, $query);
                mysqli_stmt_bind_param($sql_run, "sssii", $judul, $deskripsi, $link_baru, $id, $id);
                if(mysqli_stmt_execute($sql_run)){
                    $_SESSION['warning'] = "Berhasil ganti nama link";
                    header('location:profil');
                    exit();
                }
                else{
                    $_SESSION['danger'] = "Gagal ganti nama link";
                    header('location:profil');
                    exit();
                }
            }
        }
        
        
    }
?>

