<?php
    ob_start();
    include_once "database.php";
    
    if(isset($_POST['submit']) && $_POST['nim'] != ''){ //check if form was submitted
        
        $nim = $_POST['nim'];

        $query = "SELECT nim FROM kader where nim = ? ";
        $sql_run = mysqli_prepare($conn2, $query);
        mysqli_stmt_bind_param($sql_run, "i", $nim);
        mysqli_stmt_execute($sql_run);
        $result = mysqli_stmt_get_result($sql_run);

        //Test untuk data apakah ada atau tidak
        if(mysqli_num_rows($result)==1){
            echo "Maaf NIM yang anda inputkan, sudah ada silahkan coba lagi";
        }
        else{
            $namafull = $_POST['namafull'];
            $namapanggil = $_POST['namapanggil'];
            $notelp = $_POST['notelp'];
            $tempat = $_POST['tempat'];
            $tanggal = $_POST['tanggal'];
            $jk = $_POST['jk'];
            $fakultas = $_POST['fakultas'];
            $universitas = $_POST['universitas'];
            $alamat = $_POST['alamat'];
            
            $query = "INSERT INTO `kader_presensi` (`nim`, `sakit`, `izin`, `tanpa_ket`) VALUES (?, NULL, NULL, NULL)";
            $sql_run = mysqli_prepare($conn2, $query);
            mysqli_stmt_bind_param($sql_run, "i", $nim);
            mysqli_stmt_execute($sql_run);
            
            $query = "INSERT INTO `kader_catatan` (`nim`, `deskripsi`) VALUES (?, 'NULL')";
            $sql_run = mysqli_prepare($conn2, $query);
            mysqli_stmt_bind_param($sql_run, "i", $nim);
            mysqli_stmt_execute($sql_run);

            $query = "INSERT INTO `kader` (`nim`, `namafull`, `namapanggil`, `notelp`, `tempat`, `tanggal`, `jk`, `fakultas`, "
                    . "`universitas`, `alamat`, `nama_ayah`, `nama_ibu`, `kerja_ayah`, `kerja_ibu`, `essai`, `periode`) "
                    . "VALUES ('$nim', '$namafull', '$namapanggil', '$notelp', '$tempat', '$tanggal', '$jk', '$fakultas', "
                    . "'$universitas', '$alamat', '$nama_ayah', '$nama_ibu', '$kerja_ayah', '$kerja_ibu', '$essai', '$periode')";
            $sql_run = mysqli_query($conn2, $query);

            //Test untuk sql berjalan
            if($sql_run){
                header("location:kader.php");
                exit();
            }
            else{
                echo "Maaf ada kesalahan data, silahkan coba lagi";
            }
        }
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
                <h3>Input Profil Kader</h3>      
            </div>
              
            <br></br>
            <form action="kader_add.php" method="post">
                
                <div class="row">
                    <div class="col-xs-6 form-group">
                        <label>Masukkan NIM (JANGAN SAMPAI SALAH !) :</label>
                        <input type="number" class="form-control" name="nim" placeholder="e.g : 1700018012" 
                                                oninvalid="this.setCustomValidity('Silahkan Masukkan NIM Kader')"
                                                accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>

                    <div class="col-xs-6 form-group">
                        <label>Masukkan Nama Kader :</label>
                        <input type="text" class="form-control" name="namafull" placeholder="e.g : Fulan Fulan">
                    </div>

                    <div class="col-xs-6 form-group">
                        <label>Masukkan Nama Panggil :</label>
                        <input type="text" class="form-control" name="namapanggil" placeholder="e.g : Fulan">
                    </div>

                    <div class="col-xs-6 form-group">
                        <label>Masukkan Nomor Telepon : </label>
                        <input type="number" class="form-control" name="notelp" placeholder="e.g : 085212413135">
                    </div>

                    <div class="col-xs-6 form-group">
                        <label>Masukkan Tempat Lahir : </label>
                        <input type="text" class="form-control" name="tempat" placeholder="e.g : Jl. Fulan belakang">
                    </div>

                    <div class="col-xs-6 form-group">
                        <label>Masukkan Tanggal Lahir (FORMAT : DD-MM-YYYY) : </label>
                        <input type="date" class="form-control" name="tanggal" placeholder="e.g : 08-07-2020">
                    </div>

                    <div class="col-xs-6 form-group">
                        <label>Masukkan Fakultas : </label>
                        <input type="text" class="form-control" name="fakultas" placeholder="e.g : Farmasi">
                    </div>

                    <div class="col-xs-6 form-group">
                        <label>Masukkan Universitas : </label>
                        <input type="text" class="form-control" name="universitas" placeholder="e.g : Universitas Ahmad Dahlan">
                    </div>

                    <div class="col-xs-6 form-group">
                        <label>Masukkan Alamat : </label>
                        <input type="text" class="form-control" name="alamat" placeholder="e.g : Jl. Taman Sari">
                    </div>
                    
                    <div class="col-xs-6 form-group">
                        <label>Pilih Jenis Kelamin : </label>
                        <label class="radio-inline"><input type="radio" name="jk" value="L" checked>Laki-Laki</label>
                        <label class="radio-inline"><input type="radio" name="jk" value="P">Perempuan</label>
                    </div>
                </div>
               
                <div class="page-header text-center">
                    <h3>Data Orang Tua</h3>      
                </div>
                
                <div class="row">
                    <div class="col-xs-6 form-group">
                        <label>Masukkan Nama Ayah : </label>
                        <input type="text" class="form-control" name="nama_ayah" placeholder="e.g : Fulan">
                    </div>

                    <div class="col-xs-6 form-group">
                        <label>Masukkan Nama Ibu : </label>
                        <input type="text" class="form-control" name="nama_ibu" placeholder="e.g : Fulan">
                    </div>

                    <div class="col-xs-6 form-group">
                        <label>Masukkan Kerja Ayah : </label>
                        <input type="text" class="form-control" name="kerja_ayah" placeholder="e.g : Bisnis . . .">
                    </div>

                    <div class="col-xs-6 form-group">
                        <label>Masukkan Kerja Ibu : </label>
                        <input type="text" class="form-control" name="kerja_ibu" placeholder="e.g : IRT">
                    </div>
                </div>
                
                <div class="page-header text-center">
                    <h3>Data Akademik</h3>      
                </div>
                
                <div class="row">
                    <div class="col-xs-6 form-group">
                        <label>Masukkan Nama Essai (Jika belum ada, bisa di edit nanti): </label>
                        <input type="text" class="form-control" name="essai" placeholder="e.g : Ibu Rumah Tangga, etc">
                    </div>

                    <div class="col-xs-6 form-group">
                        <label>Masukkan Periode : </label>
                        <input type="text" class="form-control" name="periode" placeholder="e.g : 2019/2020">
                    </div>
                </div>
                
                <input type="submit" name="submit" class="btn btn-primary center-block" value="Tambahkan / Submit">
                
            </form>
        </div>
    </body>
</html>



