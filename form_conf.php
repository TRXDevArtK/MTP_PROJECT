<?php
    $jumlah_input = 28;
    if(isset($_POST['submit']) && $_POST['nim'] != '' && isset($_POST) && (count($_POST) == $jumlah_input)){
        $conn2 = new mysqli('localhost','root','','mtk');
        
        $nim = $_POST['nim'];

        $query = "SELECT nim FROM kader where nim = ? ";
        $sql_run = mysqli_prepare($conn2, $query);
        mysqli_stmt_bind_param($sql_run, "i", $nim);
        mysqli_stmt_execute($sql_run);
        $result = mysqli_stmt_get_result($sql_run);
        
        $warning = 0;
        $notf = "";

        //Test untuk data apakah ada atau tidak
        if(mysqli_num_rows($result)==1){
            $warning = 3;
            $notf = "Maaf NIM yang diinputkan sudah ter-registrasi";
        }
        else{
            $komsat = $_POST['komsat'];
            $namafull = $_POST['namafull'];
            $namapanggil = $_POST['namapanggil'];
            $notelp = $_POST['notelp'];
            $tempat = $_POST['tempat'];
            $email = $_POST['email'];
            $web = $_POST['web'];
            $hobi = $_POST['hobi'];
            $motto = $_POST['motto'];
            $motivasi = $_POST['motivasi'];
            $bacaan = $_POST['bacaan'];
            $jk = $_POST['jk'];
            $penyakit = $_POST['penyakit'];
            $darah = $_POST['darah'];
            $prodi = $_POST['prodi'];
            $fakultas = $_POST['fakultas'];
            $universitas = $_POST['universitas'];
            $alamat = $_POST['alamat'];
            $essai = $_POST['essai'];
            
            //Data Ortu
            $nama_ayah = $_POST['nama_ayah'];
            $nama_ibu = $_POST['nama_ibu'];
            $kerja_ayah = $_POST['kerja_ayah'];
            $kerja_ibu = $_POST['kerja_ibu'];
            
            //TGL
            $hari = $_POST['hari'];
            $bulan = $_POST['bulan'];
            $tahun = $_POST['tahun'];

            $tanggal = $tahun."-".$bulan."-".$hari;
            
            $periode = date('Y');
            
            $query = "INSERT INTO `kader` (`nim`, `komsat`, `namafull`, `namapanggil`, `notelp`, `tempat`, `email`, `web`, "
            . "`hobi`, `motto`, `motivasi`, `bacaan`, `tanggal`, `jk`, `penyakit`, `darah`, `prodi`, `fakultas`, "
            . "`universitas`, `alamat`, `nama_ayah`, `nama_ibu`, `kerja_ayah`, `kerja_ibu`, `essai`, `periode`) "
            . "VALUES ('$nim', '$komsat', '$namafull', '$namapanggil', '$notelp', '$tempat', '$email', '$web', "
            . "'$hobi', '$motto', '$motivasi', '$bacaan', '$tanggal', '$jk', '$penyakit', '$darah', '$prodi', '$fakultas', "
            . "'$universitas', '$alamat', '$nama_ayah', '$nama_ibu', '$kerja_ayah', '$kerja_ibu', '$essai', '$periode')";
            $sql_run = mysqli_query($conn2, $query);
            
            if($sql_run){
                $query = "INSERT INTO `kader_presensi` (`nim`, `sakit`, `izin`, `tanpa_ket`) VALUES (?, NULL, NULL, NULL)";
                $sql_run = mysqli_prepare($conn2, $query);
                mysqli_stmt_bind_param($sql_run, "i", $nim);
                mysqli_stmt_execute($sql_run);
                
                if($sql_run){
                    $query = "INSERT INTO `kader_catatan` (`nim`, `deskripsi`) VALUES (?, 'NULL')";
                    $sql_run = mysqli_prepare($conn2, $query);
                    mysqli_stmt_bind_param($sql_run, "i", $nim);
                    mysqli_stmt_execute($sql_run);
                    
                    //Test untuk sql berjalan
                    if($sql_run){
                        $warning = 1;
                        $notf = "Terima Kasih, Submitan anda sudah berhasil";
                        unset($_POST);
                    }
                    else{
                        $warning = 2;
                        $notf = "Maaf ada kesalahan data, silahkan coba lagi";
                        unset($_POST);
                    }
                }
            }
            else{
                $warning = 2;
                $notf = "Maaf ada kesalahan data, silahkan coba lagi";
                unset($_POST);
            }
        }
    }
?>

<html>
    <head>
        <script language="javascript" type="text/javascript">
        function windowClose() {
            window.close();
        }
        </script>
        <!--Metadata-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="js/jquery.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css" /> 
        <link rel="stylesheet" href="css/loading.css" />  
        <link rel="stylesheet" href="css/form.css" />  
        <script src="js/bootstrap.min.js"></script>  
        <title></title>
    </head>
    <body>
        <div class="container">  
            <div class="form-conf">
                <p class="back-css" 
                     <?php if($warning === 1){ ?>
                     style="background-color: #66ff66;">
                     <?php }
                     else if($warning === 2){ ?>
                     style="background-color: #ff6666;">
                     <?php } ?><?php echo $notf ?></p>
            </div>
        </div>
    </body>
</html>

