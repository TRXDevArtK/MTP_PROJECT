<?php
//session_start();
include_once "database.php";

if(isset($_POST['submit']) && $_POST['nim'] != ''){ //check if form was submitted
    $nim = $_POST['nim'];
    
    $query = "SELECT nim FROM peserta where nim = $nim";
    $sql_run = mysqli_query($conn2, $query);
    
    //Test untuk data apakah ada atau tidak
    if(mysqli_num_rows($sql_run)==1){
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

        $query = "INSERT INTO `peserta` (`nim`, `namafull`, `namapanggil`, `notelp`, `tempat`, `tanggal`, `jk`, `fakultas`, `universitas`, `alamat`) "
                . "VALUES ('$nim', '$namafull', '$namapanggil', '$notelp', '$tempat', '$tanggal', '$jk', "
                . "'$fakultas', '$universitas', '$alamat')";
        $sql_run = mysqli_query($conn2, $query);
        
        //Test untuk sql berjalan
        if($sql_run){
            header("location:peserta.php");
        }
        else{
            echo "Maaf ada kesalahan data, silahkan coba lagi";
        }
    }

}
?>

<html>
    <head></head>
    <body>
        <form action="#" method="post">
            <br><h4>PROFIL PESERTA</h4><br>
            
            <label>Masukkan NIM (WAJIB DI ISI, JANGAN SAMPAI SALAH) :</label><br>
            <input type="text" name="nim" placeholder="e.g : 1700018028"><br>
            
            <label>Masukkan nama peserta :</label><br>
            <input type="text" name="namafull" placeholder="e.g : Fulan Fulan"><br>
            
            <label>Masukkan Nama Panggil : </label><br>
            <input type="text" name="namapanggil" placeholder="e.g : Fulan"><br>
            
            <label>Masukkan Nomor Telepon : </label><br>
            <input type="text" name="notelp" placeholder="e.g : 085212413135"><br>
            
            <label>Masukkan Tempat Lahir : </label><br>
            <input type="text" name="tempat" placeholder="e.g : Jl. Fulan belakang"><br>
            
            <label>Masukkan Tanggal Lahir (FORMAT : DD-MM-YYYY): </label><br>
            <input type="text" name="tanggal" placeholder="e.g : 08-07-2020"><br>
            
            <label>Masukkan Jenis Kelamin : </label><br>
            <select name="jk">
                <option value="P">Perempuan</option>
                <option value="L">Laki-laki</option>
            </select><br>
            
            <label>Masukkan Fakultas : </label><br>
            <input type="text" name="fakultas" placeholder="e.g : Farmasi"><br>
            
            <label>Masukkan Universitas : </label><br>
            <input type="text" name="universitas" placeholder="e.g : Universitas Ahmad Dahlan"><br>
            
            <label>Masukkan Alamat : </label><br>
            <input type="text" name="alamat" placeholder="e.g : Jl. Taman Sari"><br>
            
            <br>
            <input type="submit" name="submit">
        </form>
    </body>
</html>



