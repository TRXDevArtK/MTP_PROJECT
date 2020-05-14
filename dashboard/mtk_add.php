<?php

    include_once "database.php";

    if(isset($_POST['submit']) && !empty($_POST['nama'])){ //check if form was submitted
        $nama       = $_POST['nama'];
        $semester   = $_POST['semester'];
        $thn        = $_POST['thn'];
        $kelas      = $_POST['kelas'];
        $kkm        = $_POST['kkm'];

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
            $query = "INSERT INTO `idmtk` (`id`, `nama`, `semester`, `thn`, `kelas`, `kkm`) VALUES ('$id', '$nama', '$semester', '$thn', '$kelas', '$kkm')";
            mysqli_query($conn2, $query);

            //untuk tabel matakuliah
            $id_t = $id."_mtk";
            $query = "CREATE TABLE $id_t (id INT(7) NULL, "
                    . "nim INT(11) PRIMARY KEY, "
                    . "nilai CHAR(1) NULL, "
                    . "tanggal_nilai VARCHAR(30) NULL)";
            mysqli_query($conn2, $query);

            //untuk tabel descmtk
            $query = "INSERT INTO `descmtk` (`id`, `A`, `B`, `C`, `D`) VALUES ('$id', '$desca', '$descb', '$descc', '$descd')";
            mysqli_query($conn2, $query);
        }
        header("location:mtk.php");
    }  
    
?>

<html>
    <head></head>
    <body>
        <form action="#" method="post">
            <br><h4>PROFIL MATKUL</h4><br>
            
            <label>Masukkan nama matkul (Wajib) :</label><br>
            <input type="text" name="nama" placeholder="e.g : Al-Quran"><br>
            <label for="lname">Masukkan semester : </label><br>
            <input type="text" name="semester" placeholder="e.g : 1, 2, 3, etc"><br>
            <label for="lname">Masukkan tahun ajar : </label><br>
            <input type="text" name="thn" placeholder="e.g : 2019/2020"><br>
            <label for="lname">Masukkan kelas : </label><br>
            <input type="text" name="kelas" placeholder="e.g : A, B, C, etc"><br>
            <label for="lname">Masukkan kkm : </label><br>
            <input type="text" name="kkm" placeholder=""><br>
            
            <br><h4>DESKRIPSI NILAI</h4><br>
            
            <label for="lname">Masukkan Deskripsi Nilai A : </label><br>
            <input type="text" name="desca" placeholder=""><br>
            
            <label for="lname">Masukkan Deskripsi Nilai B : </label><br>
            <input type="text" name="descb" placeholder=""><br>
            
            <label for="lname">Masukkan Deskripsi Nilai C : </label><br>
            <input type="text" name="descc" placeholder=""><br>
            
            <label for="lname">Masukkan Deskripsi Nilai D : </label><br>
            <input type="text" name="descd" placeholder=""><br>
            
            <br>
            <input type="submit" name="submit">
        </form>
    </body>
</html>


