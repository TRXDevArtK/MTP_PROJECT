<?php

    //select.php

    include('database.php');
    
    $nim = $_POST['nim'];
    
    $query = "DELETE FROM `peserta` WHERE `peserta`.`nim` = $nim";
    $sql_run = mysqli_query($conn2, $query);
    
    /*$query = "DELETE FROM `nilaimtk` WHERE `nilaimtk`.`nim` = $nim";
    $sql_run = mysqli_query($conn2, $query);*/
   

?>


