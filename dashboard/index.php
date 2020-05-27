<?php
    include('database.php');
?>

<html>
    <head>
        <!--Metadata-->
        <meta charset="UTF-8">
        <script src="../js/jquery.min.js"></script>
        <link rel="stylesheet" href="../css/pageshow.css" />  
        <script src="../js/bootstrap.min.js"></script>  
        <title></title>
    </head>
    <body style="background: skyblue">
        <a href="logout.php"><button class="button button1">Logout</button></a>
        <!-- PAGESHOW (START) -->
        <div id="pageshow">
            <div class="page-header">
                <h3> Selamat Datang di WEB IMM Djazman </h3>
            </div>
          <p class="section-lead"></p>
            <div class="services-grid">
                <div class="service service2">
                    <h4>Data Peserta</h4>
                    <p>Tempat untuk melihat data dan nilai serta download raportnya</p>
                    <a href="peserta.php" class="cta">Klik Disini</a>
                </div>

                <div class="service service2">
                    <h4>Data Matkul</h4>
                    <p>Tempat untuk melihat,mengedit matkul dan list pesertanya</p>
                    <a href="mtk.php" class="cta">Klik Disini</a>
                </div>

                <div class="service service2">
                    <h4>Data Matkul Sikap</h4>
                    <p>Tempat untuk melihat,mengedit matkul SIKAP dan list pesertanya</p>
                    <a href="mtk_skp.php" class="cta">Read More <span class="ti-angle-right"></a>
                </div>
            </div>

            <div class="services-grid">
                <div class="service service2">
                    <h4>Data DAD</h4>
                    <p>Tempat untuk melihat dan mengedit data pengelolaan DAD</p>
                    <a href="dad.php" class="cta">Klik Disini</a>
                </div>
            </div>
        </div>
        <!-- PAGESHOW (END) -->
    </body>
</html>