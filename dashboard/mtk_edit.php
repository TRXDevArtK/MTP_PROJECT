<?php

include_once "database.php";

if(isset($_POST['edit']) && !empty($_POST['nama'])){ //check data post
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

if(isset($_POST['submit']) && !empty($_POST['nama'])){ //check if form was submitted
    
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
    //echo "DISUBMIT";
}

?>

<html>
    <head></head>
    <body>
        <form action="mtk_edit.php" method="post">
            <br><h4>PROFIL MATKUL</h4><br>
            
            <label>Masukkan nama matkul:</label><br>
            <input type="text" name="nama" placeholder="e.g : Al-Quran" value="<?php echo $nama;?>"><br>
            <input type="hidden" name="id" value="<?php echo $id;?>" readonly>
            <label>Masukkan semester : </label><br>
            <input type="text" name="semester" placeholder="e.g : 1, 2, 3, etc" value="<?php echo $semester;?>"><br>
            <label>Masukkan tahun ajar : </label><br>
            <input type="text" name="thn" placeholder="e.g : 2019/2020" value="<?php echo $thn;?>"><br>
            <label>Masukkan kelas : </label><br>
            <input type="text" name="kelas" placeholder="e.g : A, B, C, etc" value="<?php echo $kelas;?>"><br>
            <label>Masukkan kkm : </label><br>
            <input type="text" name="kkm" placeholder="" value="<?php echo $kkm;?>"><br>
            
            <br><h4>DESKRIPSI NILAI</h4><br>
            
            <label>Masukkan Deskripsi Nilai A : </label><br>
            <input type="text" name="desca" placeholder="" value="<?php echo $desca;?>"><br>
            
            <label>Masukkan Deskripsi Nilai B : </label><br>
            <input type="text" name="descb" placeholder="" value="<?php echo $descb;?>"><br>
            
            <label>Masukkan Deskripsi Nilai C : </label><br>
            <input type="text" name="descc" placeholder="" value="<?php echo $descc;?>"><br>
            
            <label>Masukkan Deskripsi Nilai D : </label><br>
            <input type="text" name="descd" placeholder="" value="<?php echo $descd;?>"><br>
            
            <br>
            <input type="submit" name="submit">
        </form>
    </body>
</html>


