<?php
    #mulai sesi untuk fungsi login
    session_start();
    #include sesuatu disini
    include_once "../sql_connect.php";
    include_once "database.php";
?>

<html>
    <head>
         <!--Metadata-->
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php if(isset($_SESSION['status'])){?>
        <div class="header">
            <div class="menu">
                <!--MENU DISINI-->
                <a href="logout.php">
                    <button>Logout</button>
                </a>
            </div>
        </div>
        
        <a href="mtk.php">
            <button>Menu Matkul</button>
        </a>
        <a href="peserta.php">
            <button>Data Peserta</button>
        </a>
        <a href="raport.php">
            <button>raport</button>
        </a>
        
        <div class="footer">
            BBBBBBBBB
        </div>
        <?php 
        }
        else{
            header("location:../index.php");
        }
        ?>
    </body>
</html>

