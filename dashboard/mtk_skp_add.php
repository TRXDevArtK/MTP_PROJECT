<?php
    ob_start();
    include_once "database.php";

    if(isset($_POST['submit']) && !empty($_POST['nama'])){ //check if form was submitted
        $nama       = $_POST['nama'];

        $desca = $_POST['desca'];
        $descb = $_POST['descb'];
        $descc = $_POST['descc'];
        $descd = $_POST['descd'];

        $id = mt_rand(1000000, 9999999);

        $val = mysqli_query($conn2, "select 1 from idmtk where id = $id LIMIT 1");
        $val = mysqli_fetch_assoc($val);
        if($val[1] == 1){
            //mysqli_query($conn2, "DELETE FROM idmtk WHERE idmtk.id = $id");
            echo    "<script type='text/javascript'>
                        alert('Kesalahan sistem silahkan coba lagi');
                    </script>";
        }
        else{
            //untuk tabel idmtk
            $query = "INSERT INTO `idmtk_skp` (`id`, `nama`) VALUES ('$id', '$nama')";
            mysqli_query($conn2, $query);

            //untuk tabel matakuliah
            $id_t = $id."_mtk_skp";
            $query = "CREATE TABLE $id_t (id INT(7) NULL, "
                    . "nim INT(11) PRIMARY KEY, "
                    . "nilai CHAR(1) NULL, "
                    . "tanggal_nilai VARCHAR(30) NULL)";
            mysqli_query($conn2, $query);

            //untuk tabel descmtk
            $query = "INSERT INTO `descmtk` (`id`, `A`, `B`, `C`, `D`) VALUES ('$id', '$desca', '$descb', '$descc', '$descd')";
            mysqli_query($conn2, $query);
        }
        
        header("location:mtk_skp.php");
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
                <h3>Data Matkul Sikap</h3>      
            </div>
              
            <br>
            <form action="#" method="post">
                
                <div class="form-group">
                    <label>Nama Matkul (Wajib) :</label>
                    <input type="text" class="form-control" name="nama" placeholder="e.g : SIKAP SOSIAL" required="require">
                </div>
                
                <div class="form-group">
                    <label>Deskripsi Nilai A :</label>
                    <textarea type="text" class="form-control" name="desca" placeholder="e.g : NILAI SANGAT BAGUS . ."></textarea>
                </div>
                
                <div class="form-group">
                    <label>Deskripsi Nilai B :</label>
                    <textarea type="text" class="form-control" name="descb" placeholder="e.g : NILAI BAGUS . ."></textarea>
                </div>
                
                <div class="form-group">
                    <label>Deskripsi Nilai C :</label>
                    <textarea type="text" class="form-control" name="descc" placeholder="e.g : NILAI KURANG BAGUS . ."></textarea>
                </div>
                
                <div class="form-group">
                    <label>Deskripsi Nilai D :</label>
                    <textarea type="text" class="form-control" name="descd" placeholder="e.g : PERLU LATIHAN LAGI . ."></textarea>
                </div>
                
                <input type="submit" name="submit" class="btn btn-primary center-block" value="Tambah / Submit">
                
            </form>
        </div>
    </body>
</html>


