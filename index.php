<?php
    // Memulai ob start untuk caching web
    ob_start();
    #mulai sesi untuk fungsi login
    session_start();
    #include sesuatu disini
    
    //cek status apabila login atau belum
    if(isset($_SESSION['status'])){
        header("location:dashboard/index.php");
        exit();
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
            <form action="login.php" method="post">
                <?php if(isset($_SESSION['loginsalah'])){ ?>
                    <p style="color:red" class="text-center"> Notifikasi : <?= $_SESSION['loginsalah']; ?></p>
                <?php unset($_SESSION['loginsalah']); } 
                else if(isset($_SESSION['pass_notf'])){ ?>
                    <p style="color:orange" class="text-center"> Notifikasi : <?= $_SESSION['pass_notf']; ?></p>
                <?php unset ($_SESSION['pass_notf']); } ?>
                <h2 class="text-center">Djazman WEB Login</h2>   
                <hr>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username" name="username" required="required">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name="password" required="required">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Masuk / Submit</button>
                </div>
                <div class="clearfix">
                    <label class="pull-left checkbox-inline"><input type="checkbox" name="save"> Ingat Saya 24 Jam</label>
                    <a href="lupa_pass.php" class="pull-right">Lupa Password ?</a>
                </div>        
            </form>
        </div>
        
    </body>
</html>
