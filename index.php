<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    #mulai sesi untuk fungsi login
    session_start();
    #include sesuatu disini
    include_once "sql_connect.php";
?>

<?php
    #ambil get/post dan olah disini
    if (isset($_SESSION['loginsalah'])){
        echo $_SESSION['loginsalah'];
        #hapus method loginsalah yang tidak digunakan setelah refresh page
        unset ($_SESSION['loginsalah']);
    }
    
    if (isset($_SESSION['pass_notf'])){
        echo $_SESSION['pass_notf'];
        #hapus method loginsalah yang tidak digunakan setelah refresh page
        unset ($_SESSION['pass_notf']);
    }
?>

<html>
    <head>
        <!--Metadata-->
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php if(isset($_SESSION['status'])){
            header("location:dashboard/index.php");
        }
        else{
        ?>
        <form class="login" method="POST" action="login.php">
            <label for="username"><b>Username</b></label>
            <input type="text" placeholder="Masukkan Username" name="username" required>

            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Masukkan Password" name="password" required>

            <button type="submit" name="login">Login</button>
            <label>
                  <input type="checkbox" checked="checked" name="remember"> Remember Me
            </label>
        </form>
        
        <p><a href="lupa_pass.php">Lupa Password ?</a></p>
        
        <?php
        }
        ?>
        
    </body>
</html>
