<?php
    ob_start();
?>
<html lang="en">
    <head>
	<!--Metadata-->
        <meta charset="UTF-8">
        <script src="js/jquery.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css" />  
        <script src="js/bootstrap.min.js"></script>  
        <title></title>
        <style type="text/css">
            .notif {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width:45%;
            }
        </style>
    </head>
    <body style="background: skyblue;" class="notif text-center">
        <?php if(isset($_GET['email'])){ ?>
	<div style="text-align: center;">
            <p>
                Email konfirmasi sudah dikirim ke  <b><?php echo $_GET['email'] ?></b> agar password akun bisa diubah. 
            </p>
            <p>
                Tolong login ke email anda dan klik link yang sudah kami kirim.
            </p>
            <a href="index.php"><button class="btn btn-warning"> Klik disini untuk kembali ke halaman awal </button></a>
	</div>
        <?php 
        
        } 
        else{
            header('location:index.php');
            exit();
        }
        ?>
        
    </body>
</html>