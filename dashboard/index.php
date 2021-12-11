<?php

    //ambil database.php untuk keperluan manajemen
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
        <a href="logout"><button class="button button1">Logout</button></a>
        <!-- PAGESHOW (START) -->
        <div id="pageshow">
            <div class="page-header">
                <h3> Selamat Datang di WEB IMM Djazman </h3>
            </div>
          <p class="section-lead"></p>
            <div class="services-grid">
                <div class="service service2">
                    <h4>Data Kader</h4>
                    <p>Tempat untuk melihat data dan nilai serta download raportnya</p>
                    <a href="kader" class="cta">Klik Disini</a>
                </div>

                <div class="service service2">
                    <h4>Data Materi</h4>
                    <p>Tempat untuk melihat,mengedit materi dan list kadernya</p>
                    <a href="mtk" class="cta">Klik Disini</a>
                </div>

                <div class="service service2">
                    <h4>Data Materi Sikap</h4>
                    <p>Tempat untuk melihat,mengedit materi SIKAP dan list kadernya</p>
                    <a href="mtk_skp" class="cta">Klik Disini<span class="ti-angle-right"></a>
                </div>
            </div>

            <div class="services-grid">
                <div class="service service2">
                    <h4>Data DAD</h4>
                    <p>Tempat untuk melihat dan mengedit data pengelolaan DAD</p>
                    <a href="dad" class="cta">Klik Disini</a>
                </div>
            </div>
        </div>
        <!-- PAGESHOW (END) -->
    </body>
</html>