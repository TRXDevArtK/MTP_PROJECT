<!DOCTYPE html>
<html lang="en">
    <head>
	<meta charset="UTF-8">
	<title>Password Reset</title>
	<link rel="stylesheet" href="main.css">
    </head>
    <body>
        <?php if(isset($_GET['email'])){ ?>
	<form class="pending" action="index.php" method="post" style="text-align: center;">
            <p>
                We sent an email to  <b><?php echo $_GET['email'] ?></b> to help you recover your account. 
            </p>
            <p>
                Please login into your email account and click on the link we sent to reset your password
            </p>
            <a href="index.php"><p> Klik disini untuk kembali ke halaman awal <p></a>
	</form>
        <?php 
        
        } 
        else{
            header('location:index.php');
        }
        ?>
        
    </body>
</html>