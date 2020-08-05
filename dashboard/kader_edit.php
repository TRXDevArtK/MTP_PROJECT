<?php
    ob_start();
    include_once "database.php";

    if(isset($_POST['edit']) && !empty($_POST['nim'])){

        $nim = $_POST['nim'];
        $komsat = $_POST['komsat'];
        $namafull = $_POST['namafull'];
        $namapanggil = $_POST['namapanggil'];
        $notelp = $_POST['notelp'];
        $tempat = $_POST['tempat'];
        $tanggal = $_POST['tanggal'];
        $jk = $_POST['jk'];
        $fakultas = $_POST['fakultas'];
        $universitas = $_POST['universitas'];
        $alamat = $_POST['alamat'];
        $nama_ayah = $_POST['nama_ayah'];
        $nama_ibu = $_POST['nama_ibu'];
        $kerja_ayah = $_POST['kerja_ayah'];
        $kerja_ibu = $_POST['kerja_ibu'];
        $essai = $_POST['essai'];
        $periode = $_POST['periode'];

        if($jk == "Perempuan"){
            $jk = "P";
        }
        else if($jk == "Laki-laki"){
            $jk = "L";
        }

    }

    if(isset($_POST['submit'])){ //check if form was submitted
        $nim = $_POST['nim'];
        $komsat = $_POST['komsat'];
        $namafull = $_POST['namafull'];
        $namapanggil = $_POST['namapanggil'];
        $notelp = $_POST['notelp'];
        $tempat = $_POST['tempat'];
        $tanggal = $_POST['tanggal'];
        $jk = $_POST['jk'];
        $fakultas = $_POST['fakultas'];
        $universitas = $_POST['universitas'];
        $alamat = $_POST['alamat'];
        $nama_ayah = $_POST['nama_ayah'];
        $nama_ibu = $_POST['nama_ibu'];
        $kerja_ayah = $_POST['kerja_ayah'];
        $kerja_ibu = $_POST['kerja_ibu'];
        $essai = $_POST['essai'];
        $periode = $_POST['periode'];

        //Edit data kader
        $query = "UPDATE `kader` SET `komsat` = '$komsat', `namafull` = '$namafull', `namapanggil` = '$namapanggil', `notelp` = '$notelp', "
                . "`tempat` = '$tempat', `tanggal` = '$tanggal', `jk` = '$jk', `fakultas` = '$fakultas', "
                . "`universitas` = '$universitas', `alamat` = '$alamat', `nama_ayah` = '$nama_ayah', `nama_ibu` = '$nama_ibu', "
                . "`kerja_ayah` = '$kerja_ayah', `kerja_ibu` = '$kerja_ibu', `essai` = '$essai', `periode` = '$periode' WHERE `kader`.`nim` = $nim";
        mysqli_query($conn2, $query);

        $_SESSION['nim'] = $nim;
        header("location:kader_data.php");
        exit();

    }
?>

<html>
    <head>
        <!--Metadata-->
        <meta charset="UTF-8">
        <script src="../js/jquery.min.js"></script>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />  
        <script src="../js/bootstrap.min.js"></script>  
        <title></title>
    </head>
    <body>
        <?php include("nav.html"); ?>
        <div class="container">
            <div class="page-header text-center">
                <h3>Profil Kader</h3>      
            </div>
              
            <br></br>
            <form action="kader_edit.php" method="post">
                <!--Konten Hidden-->
                <input type="hidden" name="nim" value="<?php echo $nim;?>" readonly>
                <!-- -->
                
                <div class="form-group">
                    <label>Nama Kader :</label>
                    <input type="text" class="form-control" name="namafull" placeholder="e.g : Fulan Fulan" value="<?php echo $namafull;?>">
                </div>
                
                <div class="form-group">
                    <label>Nama Panggil :</label>
                    <input type="text" class="form-control" name="namapanggil" placeholder="e.g : Fulan" value="<?php echo $namapanggil;?>">
                </div>
                
                <div class="form-group">
                    <label>Asal Komsat :</label>
                    <input type="text" class="form-control" name="komsat" placeholder="e.g : FTI" value="<?php echo $komsat;?>">
                </div>
                
                <div class="form-group">
                    <label>Nomor Telepon : </label>
                    <input type="number" class="form-control" name="notelp" placeholder="e.g : 085212413135" value="<?php echo $notelp;?>">
                </div>
                
                <div class="form-group">
                    <label>Tempat Lahir : </label>
                    <input type="text" class="form-control" name="tempat" placeholder="e.g : Jl. Fulan belakang" value="<?php echo $tempat;?>">
                </div>
                
                <div class="form-group">
                    <label>Tanggal Lahir (FORMAT : DD-MM-YYYY) : </label>
                    <input type="date" class="form-control" name="tanggal" placeholder="e.g : 08-07-2020" value="<?php echo $tanggal;?>">
                </div>
                
                <div class="form-group">
                    <label>Jenis Kelamin : </label>
                    <label class="radio-inline"><input type="radio" name="jk" value="L" <?php if($jk = 'L'){echo "checked"; }?> >Laki-Laki</label>
                    <label class="radio-inline"><input type="radio" name="jk" value="P" <?php if($jk = 'P'){echo "checked"; }?> >Perempuan</label>
                </div>
                
                <div class="form-group">
                    <label>Fakultas : </label>
                    <input type="text" class="form-control" name="fakultas" placeholder="e.g : Farmasi" value="<?php echo $fakultas;?>">
                </div>
                
                <div class="form-group">
                    <label>Universitas : </label>
                    <input type="text" class="form-control" name="universitas" placeholder="e.g : Universitas Ahmad Dahlan" value="<?php echo $universitas;?>">
                </div>
                
                <div class="form-group">
                    <label>Alamat : </label>
                    <input type="text" class="form-control" name="alamat" placeholder="e.g : Jl. Taman Sari" value="<?php echo $alamat;?>">
                </div>
               
                <div class="page-header text-center">
                    <h3>Data Orang Tua</h3>      
                </div>
                
                <div class="form-group">
                    <label>Nama Ayah : </label>
                    <input type="text" class="form-control" name="nama_ayah" placeholder="e.g : Fulan" value="<?php echo $nama_ayah;?>">
                </div>
                
                <div class="form-group">
                    <label>Nama Ibu : </label>
                    <input type="text" class="form-control" name="nama_ibu" placeholder="e.g : Fulan" value="<?php echo $nama_ibu;?>">
                </div>
                
                <div class="form-group">
                    <label>Kerja Ayah : </label>
                    <input type="text" class="form-control" name="kerja_ayah" placeholder="e.g : Bisnis . . ." value="<?php echo $kerja_ayah;?>">
                </div>
                
                <div class="form-group">
                    <label>Kerja Ibu : </label>
                    <input type="text" class="form-control" name="kerja_ibu" placeholder="e.g : IRT" value="<?php echo $kerja_ibu;?>">
                </div>
                
                <div class="page-header text-center">
                    <h3>Data Akademik</h3>      
                </div>
                
                <div class="form-group">
                    <label>Nama Essai : </label>
                    <input type="text" class="form-control" name="essai" placeholder="e.g : Ibu Rumah Tangga, etc" value="<?php echo $essai;?>">
                </div>
                
                <div class="form-group">
                    <label>Periode : </label>
                    <input type="text" class="form-control" name="periode" placeholder="e.g : 2019/2020" value="<?php echo $periode;?>">
                </div>
                
                <input type="submit" name="submit" class="btn btn-primary center-block" value="Update / Submit">
                
            </form>
        </div>
    </body>
</html>



