<?php
    ob_start();
    include_once "database.php";

    if(isset($_POST['edit']) && !empty($_POST['id'])){ //check data post
    $id         = $_POST['id'];
    $nama       = $_POST['nama'];

    $val = mysqli_query($conn2, "select A,B,C,D from `descmtk` where `descmtk`.`id` = '$id'");
    $val = mysqli_fetch_assoc($val);

    $desca = $val['A'];
    $descb = $val['B'];
    $descc = $val['C'];
    $descd = $val['D'];

    }

    if(isset($_POST['submit']) && !empty($_POST['id'])){ //check if form was submitted

        $id         = $_POST['id'];
        $nama       = $_POST['nama'];

        $desca = $_POST['desca'];
        $descb = $_POST['descb'];
        $descc = $_POST['descc'];
        $descd = $_POST['descd'];

        //Update idmtk
        $query1 = "UPDATE `idmtk_skp` SET `nama` = '$nama' WHERE `idmtk_skp`.`id` = $id";
        $sql_run1 = mysqli_query($conn2, $query1);

        //Update descmtk
        $query2 = "UPDATE `descmtk` SET `A` = '$desca', `B` = '$descb', `C` = '$descc', `D` = '$descd' WHERE `descmtk`.`id` = $id";
        $sql_run2 = mysqli_query($conn2, $query2); // DEBUG // or trigger_error("Query Failed! SQL: $query2 - Error: ".mysqli_error($conn2), E_USER_ERROR);

        header("location:mtk_skp");
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
        <link rel="stylesheet" href="../css/form.css" /> 
        <script src="../js/bootstrap.min.js"></script>  
        <title></title>
    </head>
    <body>
        <?php include("nav.html"); ?>
        <div class="container">
            <div class="page-header text-center">
                <h3>Data Materi Sikap</h3>      
            </div>
              
            <br>
            <form action="#" method="post">
                <div class="form-all">
                    <div class="form-prehead">
                        <h4>Profil Matkul Sikap</h4>      
                        <hr>
                    </div>
                    
                    <!--Konten Hidden-->
                    <input type="hidden" name="id" value="<?php echo $id;?>" readonly>
                    <!-- -->

                    <div class="form-group">
                        <label>Nama Materi :</label>
                        <input type="text" class="form-control" name="nama" placeholder="e.g : SIKAP SOSIAL" value="<?php echo $nama;?>" 
                                                                    oninvalid="this.setCustomValidity('Silahkan Masukkan Nama Materinya')"
                                                                      accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>
                    
                </div>
                
                <br>
                
                <div class="form-all">
                    <div class="form-prehead">
                        <h4>Deskripsi Matkul Sikap</h4>      
                        <hr>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi Nilai A :</label>
                        <textarea type="text" class="form-control" name="desca" placeholder="e.g : NILAI SANGAT BAGUS . ."><?php echo $desca;?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi Nilai B :</label>
                        <textarea type="text" class="form-control" name="descb" placeholder="e.g : NILAI BAGUS . ."><?php echo $descb;?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi Nilai C :</label>
                        <textarea type="text" class="form-control" name="descc" placeholder="e.g : NILAI KURANG BAGUS . ."><?php echo $descc;?>></textarea>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi Nilai D :</label>
                        <textarea type="text" class="form-control" name="descd" placeholder="e.g : PERLU LATIHAN LAGI . ."><?php echo $descd;?></textarea>
                    </div>
                    
                </div>
                
                <br>
                
                <input type="submit" name="submit" class="btn btn-primary center-block" value="Update / Submit">
                
                <br>
            </form>
        </div>
    </body>
</html>


