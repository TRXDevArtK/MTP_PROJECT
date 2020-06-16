<?php
    ob_start();
    include_once "database.php";

    if(isset($_POST['edit']) && !empty($_POST['id'])){ //check data post
    $id         = $_POST['id'];
    $nama       = $_POST['nama'];
    $semester   = $_POST['semester'];
    $thn        = $_POST['thn'];
    $kelas      = $_POST['kelas'];
    $kkm        = $_POST['kkm'];

    $val = mysqli_query($conn2, "select *from `descmtk` where `descmtk`.`id` = '$id'");
    $val = mysqli_fetch_assoc($val);

    $desca = $val['A'];
    $descb = $val['B'];
    $descc = $val['C'];
    $descd = $val['D'];

    }

    if(isset($_POST['submit']) && !empty($_POST['id'])){ //check if form was submitted

        $id         = $_POST['id'];
        $nama       = $_POST['nama'];
        $semester   = $_POST['semester'];
        $thn        = $_POST['thn'];
        $kelas      = $_POST['kelas'];
        $kkm        = $_POST['kkm'];

        $desca = $_POST['desca'];
        $descb = $_POST['descb'];
        $descc = $_POST['descc'];
        $descd = $_POST['descd'];

        //Update idmtk
        $query1 = "UPDATE `idmtk` SET `nama` = '$nama', `semester` = '$semester', `thn` = '$thn', `kelas` = '$kelas', `kkm` = '$kkm' WHERE `idmtk`.`id` = '$id'";
        $sql_run1 = mysqli_query($conn2, $query1);

        //Update descmtk
        $query2 = "UPDATE `descmtk` SET `A` = '$desca', `B` = '$descb', `C` = '$descc', `D` = '$descd' WHERE `descmtk`.`id` = $id";
        $sql_run2 = mysqli_query($conn2, $query2); // DEBUG // or trigger_error("Query Failed! SQL: $query2 - Error: ".mysqli_error($conn2), E_USER_ERROR);

        header("location:mtk.php");
        exit();
        //echo "DISUBMIT";
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
                <h3>Profil Matkul</h3>      
            </div>
              
            <br>
            <form action="#" method="post">
                <input type="hidden" class="form-control" name="id" value="<?= $id ?>" readonly>
                
                <div class="form-group">
                    <label>Masukkan Nama Matkul (Wajib) :</label>
                    <input type="text" class="form-control" name="nama" placeholder="e.g : Al-Quran" value="<?= $nama ?>" 
                                                        oninvalid="this.setCustomValidity('Silahkan Masukkan Nama Matkulnya')"
                                                          accept=""oninput="this.setCustomValidity('')" required="require">
                </div>
                
                <div class="form-group">
                    <label>Masukkan Semester : </label>
                    <input type="number" class="form-control" name="semester" placeholder="e.g : 1, 2, 3, etc" value="<?= $semester ?>">
                </div>
                
                <div class="form-group">
                    <label>Masukkan Tahun Ajar : </label>
                    <input type="text" class="form-control" name="thn" placeholder="e.g : 2019/2020" value="<?= $thn ?>">
                </div>
                
                <div class="form-group">
                    <label>Masukkan Kelas : </label>
                    <input type="text" class="form-control" name="kelas" placeholder="e.g : A, B, C, etc" value="<?= $kelas ?>">
                </div>
                
                <div class="form-group">
                    <label>Masukkan KKM : </label>
                    <input type="text" class="form-control" name="kkm" placeholder="" value="<?= $kkm ?>">
                </div>
                
                <div class="form-group">
                    <label>Deskripsi Nilai A :</label>
                    <textarea type="text" class="form-control" name="desca" placeholder="e.g : NILAI SANGAT BAGUS . ."><?= $desca ?></textarea>
                </div>
                
                <div class="form-group">
                    <label>Deskripsi Nilai B :</label>
                    <textarea type="text" class="form-control" name="descb" placeholder="e.g : NILAI BAGUS . ."><?= $descb ?></textarea>
                </div>
                
                <div class="form-group">
                    <label>Deskripsi Nilai C :</label>
                    <textarea type="text" class="form-control" name="descc" placeholder="e.g : NILAI KURANG BAGUS . ."><?= $descc ?></textarea>
                </div>
                
                <div class="form-group">
                    <label>Deskripsi Nilai D :</label>
                    <textarea type="text" class="form-control" name="descd" placeholder="e.g : PERLU LATIHAN LAGI . ."><?= $descd ?></textarea>
                </div>
                
                <input type="submit" name="submit" class="btn btn-primary center-block" value="Update / Submit">
                
            </form>
        </div>
    </body>
</html>


