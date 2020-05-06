<?php
    session_start();
    include_once "database.php";

if(isset($_POST['edit']) && !empty($_POST['nim'])){
    
    $nim = $_POST['nim'];
    $namafull = $_POST['namafull'];
    $namapanggil = $_POST['namapanggil'];
    $notelp = $_POST['notelp'];
    $tempat = $_POST['tempat'];
    $tanggal = $_POST['tanggal'];
    $jk = $_POST['jk'];
    $fakultas = $_POST['fakultas'];
    $universitas = $_POST['universitas'];
    $alamat = $_POST['alamat'];
    
    if($jk == "Perempuan"){
        $jk = "P";
    }
    else if($jk == "Laki-laki"){
        $jk = "L";
    }
  
}

if(isset($_POST['submit'])){ //check if form was submitted
    $nim = $_POST['nim'];
    $namafull = $_POST['namafull'];
    $namapanggil = $_POST['namapanggil'];
    $notelp = $_POST['notelp'];
    $tempat = $_POST['tempat'];
    $tanggal = $_POST['tanggal'];
    $jk = $_POST['jk'];
    $fakultas = $_POST['fakultas'];
    $universitas = $_POST['universitas'];
    $alamat = $_POST['alamat'];
    
    //Edit data peserta
    $query = "UPDATE `peserta` SET `namafull` = '$namafull', `namapanggil` = '$namapanggil', `notelp` = '$notelp', "
            . "`tempat` = '$tempat', `tanggal` = '$tanggal', `jk` = '$jk', `fakultas` = '$fakultas', "
            . "`universitas` = '$universitas', `alamat` = '$alamat' WHERE `peserta`.`nim` = $nim";
    mysqli_query($conn2, $query);
    
    $_SESSION['nim'] = $nim;
    header("location:peserta_data.php");

}
?>

<html>
    <head></head>
    <body>
        <form action="peserta_edit.php" method="post">
            <br><h4>PROFIL PESERTA</h4><br>
            
            <input type="hidden" name="nim" value="<?php echo $nim;?>" readonly>
            
            <label>Masukkan nama peserta :</label><br>
            <input type="text" name="namafull" placeholder="e.g : Fulan Fulan" value="<?php echo $namafull;?>"><br>
            
            <label>Masukkan Nama Panggil : </label><br>
            <input type="text" name="namapanggil" placeholder="e.g : Fulan" value="<?php echo $namapanggil;?>"><br>
            
            <label>Masukkan Nomor Telepon : </label><br>
            <input type="text" name="notelp" placeholder="e.g : 085212413135" value="<?php echo $notelp;?>"><br>
            
            <label>Masukkan Tempat Lahir : </label><br>
            <input type="text" name="tempat" placeholder="e.g : Jl. Fulan belakang" value="<?php echo $tempat;?>"><br>
            
            <label>Masukkan Tanggal Lahir (FORMAT : DD-MM-YYYY): </label><br>
            <input type="text" name="tanggal" placeholder="e.g : 08-07-2020" value="<?php echo $tanggal;?>"><br>
            
            <label>Masukkan Jenis Kelamin : </label><br>
            <select name="jk">
                <option value="P" <?php if($jk = 'P'){echo "selected"; }?> >Perempuan</option>
                <option value="L" <?php if($jk = 'L'){echo "selected"; }?> >Laki-laki</option>
            </select><br>
            
            <label>Masukkan Fakultas : </label><br>
            <input type="text" name="fakultas" placeholder="e.g : Farmasi" value="<?php echo $fakultas;?>"><br>
            
            <label>Masukkan Universitas : </label><br>
            <input type="text" name="universitas" placeholder="e.g : Universitas Ahmad Dahlan" value="<?php echo $universitas;?>"><br>
            
            <label>Masukkan Alamat : </label><br>
            <input type="text" name="alamat" placeholder="e.g : Jl. Taman Sari" value="<?php echo $alamat;?>"><br>
            
            <br>
            <input type="submit" name="submit">
        </form>
    </body>
</html>



