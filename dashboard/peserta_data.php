<?php
    include('database.php');
    
    $nim = $_POST['nim'];
    
    $query = "SELECT *FROM `peserta` where `peserta`.`nim` = $nim";
    $sql_run = mysqli_query($conn2, $query);
    $row = mysqli_fetch_assoc($sql_run);
    
    $nim = $row['nim'];
    $namafull = $row['namafull'];
    $namapanggil = $row['namapanggil'];
    $notelp = $row['notelp'];
    $tempat = $row['tempat'];
    $tanggal = $row['tanggal'];
    $jk = $row['jk'];
    $fakultas = $row['fakultas'];
    $universitas = $row['universitas'];
    $alamat = $row['alamat'];
    
    $query = "SELECT *FROM `nilaimtk` where `nilaimtk`.`nim` = '1900023246'";
    $sql_run = mysqli_query($conn2, $query);
    $num_rows = mysqli_num_fields($sql_run);
    
    $row = mysqli_fetch_array($sql_run, MYSQLI_NUM);
    
    //DEBUG
    /*for($i=1;$i < $num_rows;$i++){
        echo $row[$i];
    }
    if(empty($row[1])){
        echo "kosong";
    }
    else{
        echo "isinya : ",$row[1],"\n";
        echo "berisi";
    }*/

    
?>

<html>
    <head>
         <!--Metadata-->
        <meta charset="UTF-8">
        <script src="../scripts/jquery-3.4.1.js"></script>
        <link rel="stylesheet" href="../css/bootstrap337.min.css" />  
        <script src="../scripts/bootstrap.js"></script>  
        <title></title>
    </head>
    <body>
        <?php 
        
        ?>
    </body>
</html>