<?php

    include_once "database.php";
    
    if(isset($_POST['submit']) && $_POST['nia'] != ''){ //check if form was submitted
        
        $nia = $_POST['nia'];

        $query = "SELECT nia FROM instruktur where nia = $nia";
        $sql_run = mysqli_query($conn2, $query);

        //Test untuk data apakah ada atau tidak
        if(mysqli_num_rows($sql_run)==1){
            echo "Maaf NIA yang anda inputkan, sudah ada silahkan coba lagi";
        }
        else{
            $nama = $_POST['nama'];
            $jabatan = $_POST['jabatan'];
            $asal = $_POST['asal'];

            $query = "INSERT INTO `instruktur` (`nia`, `jabatan`, `nama`, `asal`) VALUES ('$nia', '$jabatan', '$nama', '$asal')";
            $sql_run = mysqli_query($conn2, $query);

            //Test untuk sql berjalan
            if($sql_run){
                header("location:dad.php");
            }
            else{
                echo "Maaf ada kesalahan data, silahkan coba lagi";
            }
        }
    }
    
    $query = "SELECT 1 FROM instruktur WHERE jabatan = 'MOT'";
    $sql_run = mysqli_query($conn2, $query);
    $mot_state = 0;
    if(mysqli_num_rows($sql_run)==1){
        $mot_state = 1;
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
                <h3>Input Profil Instruktur</h3>      
            </div>
              
            <br></br>
            <form action="#" method="post">
                
                <div class="form-group">
                    <label>Masukkan NIA instruktur (Jangan Sampai Salah) :</label>
                    <input type="number" class="form-control" name="nia" placeholder="e.g : 1231235">
                </div>
                
                <div class="form-group">
                    <label>Masukkan Nama Instruktur :</label>
                    <input type="text" class="form-control" name="nama" placeholder="e.g : Fulan">
                </div>
                
                <div class="form-group">
                    <label>Masukkan Jabatan Insturktur : </label>
                    <label class="radio-inline"><input type="radio" name="jabatan" value="MOT" <?php if($mot_state == 1){echo "disabled";} ?>>MOT</label>
                    <label class="radio-inline"><input type="radio" name="jabatan" value="SOT">SOT</label>
                    <label class="radio-inline"><input type="radio" name="jabatan" value="IOT">IOT</label>
                    <label class="radio-inline"><input type="radio" name="jabatan" value="PO">PO</label>
                    <label class="radio-inline"><input type="radio" name="jabatan" value="OB">OB</label>
                </div>
                
                <div class="form-group">
                    <label>Masukkan Asal Komsat Instruktur : </label>
                    <input type="text" class="form-control" name="asal" placeholder="e.g : FTI">
                </div>
                
                <input type="submit" name="submit" class="btn btn-primary center-block" value="Update / Submit">
                
            </form>
        </div>
    </body>
</html>

