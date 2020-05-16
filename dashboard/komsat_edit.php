<?php
    #include sesuatu disini
    include_once "database.php";
    
    if(isset($_POST['edit'])){
        $id = $_POST['id'];
        $pelaksana = $_POST['pelaksana'];
        $ketua = $_POST['ketua'];
        $cabang = $_POST['cabang'];
        $talp = $_POST['telp'];
        $alamat = $_POST['alamat'];
        $kecamatan = $_POST['kecamatan'];
        $kota = $_POST['kota'];
        $provinsi = $_POST['provinsi'];
        $faks = $_POST['faks'];
        $periode = $_POST['periode'];
    }
    
    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $pelaksana = $_POST['pelaksana'];
        $ketua = $_POST['ketua'];
        $cabang = $_POST['cabang'];
        $talp = $_POST['telp'];
        $alamat = $_POST['alamat'];
        $kecamatan = $_POST['kecamatan'];
        $kota = $_POST['kota'];
        $provinsi = $_POST['provinsi'];
        $faks = $_POST['faks'];
        $periode = $_POST['periode'];
        
        $query = "UPDATE `komsat` SET `pelaksana` = '$pelaksana', `alamat` = '$alamat', `kecamatan` = '$alamat', `kota` = '$kota', `provinsi` = '$provinsi', `faks` = '$faks', `periode` = '$periode', `ketua` = '$ketua', `telp` = '$telp', `cabang` = '$cabang' WHERE `komsat`.`id` = $id";
        mysqli_query($conn2, $query);

        header("location:dad.php");
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
        <div class="container">
            <div class="page-header text-center">
                <h3>Profil Komsat</h3>      
            </div>
              
            <br>
            <form action="#" method="post">
                <!--Konten Hidden-->
                <input type="hidden" name="id" value="<?php echo $id;?>" readonly>
                <!-- -->
                
                <div class="form-group">
                    <label>Komsat Pelaksana :</label>
                    <input type="text" class="form-control" name="pelaksana" placeholder="e.g : PK IMM Farmasi, etc" value="<?php echo $pelaksana;?>">
                </div>
                
                <div class="form-group">
                    <label>Alamat :</label>
                    <input type="text" class="form-control" name="alamat" placeholder="e.g : Jl. Semanggi Timur" value="<?php echo $alamat;?>">
                </div>
                
                <div class="form-group">
                    <label>Kecamatan : </label>
                    <input type="text" class="form-control" name="kecamatan" placeholder="e.g : Warungboto" value="<?php echo $kecamatan;?>">
                </div>
                
                <div class="form-group">
                    <label>Kabupaten/Kota : </label>
                    <input type="text" class="form-control" name="kota" placeholder="e.g : Jl. Umbulharjo" value="<?php echo $kota;?>">
                </div>
                
                <div class="form-group">
                    <label>Provinsi </label>
                    <input type="text" class="form-control" name="provinsi" placeholder="e.g : Yogyakarta" value="<?php echo $provinsi;?>">
                </div>
                
                <div class="form-group">
                    <label>Telp/Faks </label>
                    <input type="number" class="form-control" name="faks" placeholder="e.g : 021..." value="<?php echo $faks;?>">
                </div>
                
                <div class="form-group">
                    <label>Periode Jabatan : </label>
                    <input type="text" class="form-control" name="periode" placeholder="e.g : 2019/2020" value="<?php echo $periode;?>">
                </div>
                
                <div class="form-group">
                    <label>Nama Ketua : </label>
                    <input type="text" class="form-control" name="ketua" placeholder="e.g : Pak Wahyudi . . ." value="<?php echo $ketua;?>">
                </div>
                
                <div class="form-group">
                    <label>No Telp/WA : </label>
                    <input type="number" class="form-control" name="telp" placeholder="e.g : Jl. 08. . ." value="<?php echo $telp;?>">
                </div>
                
                <div class="form-group">
                    <label>Pimpinan Cabang : </label>
                    <input type="text" class="form-control" name="cabang" placeholder="e.g : Djazman Alkindi" value="<?php echo $cabang;?>">
                </div>
                
                <input type="submit" name="submit" class="btn btn-primary center-block" value="Update / Submit">
                
            </form>
        </div>
    </body>
</html>


