<?php
    session_start();
    include('database.php');
    
    if(isset($_SESSION['nim'])){
        $nim = $_SESSION['nim'];
        unset($_SESSION['nim']);
    }
    else{
        $nim = $_POST['nim'];
    }
    
    $query = "SELECT *FROM `peserta` where `peserta`.`nim` = $nim";
    $sql_run = mysqli_query($conn2, $query);
    $row = mysqli_fetch_assoc($sql_run);
    
    $nim = $row['nim'];
    $namafull = $row['namafull'];
    $namapanggil = $row['namapanggil'];
    $notelp = $row['notelp'];
    $tempat = $row['tempat'];
    $tanggal = $row['tanggal'];
    $jk = $row['jk'];
    
    if($jk == "P"){
        $jk = "Perempuan";
    }
    else if($jk == "L"){
        $jk = "Laki-laki";
    }
    
    $fakultas = $row['fakultas'];
    $universitas = $row['universitas'];
    $alamat = $row['alamat'];
    
    
?>

<html>
    <head>
         <!--Metadata-->
        <meta charset="UTF-8">
        <script src="../scripts/jquery-3.4.1.js"></script>
        <link rel="stylesheet" href="../css/bootstrap337.min.css" />  
        <script src="../scripts/bootstrap.js"></script>  
        <title></title>
    </head>
    <body>
        <div class="container">
            <div class="page-header text-center">
                <h3>Data Peserta</h3>      
            </div>\
            <form action="peserta_edit.php" method="post">
                
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <input type="submit" name="edit" class="btn btn-primary" value="Edit Data Peserta"><br>
                            <br>
                            <a class="list-group-item">Nama : <?php echo $namafull ?></a><input type="hidden" name="namafull" value="<?php echo $namafull ?>" readonly>
                            <a class="list-group-item">NIM : <?php echo $nim ?></a><input type="hidden" name="nim" value="<?php echo $nim ?>" readonly>
                            <br>
                            <button data-toggle="collapse" href="#collapse1" type="button" class="btn btn-info">Data Lebih Lanjut + </button>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse">
                        <a class="list-group-item">Nama Panggilan : <?php echo $namapanggil ?></a><input type="hidden" name="namapanggil" value="<?php echo $namapanggil ?>" readonly>
                        <a class="list-group-item">Nomor Telepon : <?php echo $notelp ?></a><input type="hidden" name="notelp" value="<?php echo $notelp ?>" readonly>
                        <a class="list-group-item">Tempat Lahir : <?php echo $tempat ?></a><input type="hidden" name="tempat" value="<?php echo $tempat ?>" readonly>
                        <a class="list-group-item">Tanggal Lahir : <?php echo $tanggal ?></a><input type="hidden" name="tanggal" value="<?php echo $tanggal ?>" readonly>
                        <a class="list-group-item">Jenis Kelamin : <?php echo $jk ?></a><input type="hidden" name="jk" value="<?php echo $jk ?>" readonly>
                        <a class="list-group-item">Fakultas : <?php echo $fakultas ?></a><input type="hidden" name="fakultas" value="<?php echo $fakultas ?>" readonly>
                        <a class="list-group-item">Universitas : <?php echo $universitas ?></a><input type="hidden" name="universitas" value="<?php echo $universitas ?>" readonly>
                        <a class="list-group-item">Alamat : <?php echo $alamat ?></a><input type="hidden" name="alamat" value="<?php echo $alamat ?>" readonly>
                    </div>
                </div>
            </div>
            </form>
            
            <hr style="color:black">
            <div class="page-header text-center">
                <h3>List Matkul Yang Di Ambil</h3>      
            </div>
            <br />
            <div align="left">
                <a href="peserta_mtk_add.php"><input type="button" class="btn btn-info" value="Tambah Matkul Peserta" /></a>
            </div>
            <form method="post" id="update_form">
                <br />
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th width="5%">No</th>
                            <th width="10%">Nama Matkul</th>
                            <th width="10%">Nilai</th>
                            <th width="10%">Menu</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </form>
	</div>
    </body>
</html>

</script>