<?php

    //select.php

    include('database.php');
    
    $id = $_POST['id'];
    
    $val = mysqli_query($conn2, "select 1 from idmtk where id = $id LIMIT 1");
    $val = mysqli_fetch_assoc($val);
    if($val[1] == 1){
        mysqli_query($conn2, "DELETE FROM idmtk WHERE idmtk.id = $id");
    }
    else{
        echo "nope";
    }
    
    $val = mysqli_query($conn2, "select 1 from descmtk where id = $id LIMIT 1");
    $val = mysqli_fetch_assoc($val);
    if($val[1] == 1){
        mysqli_query($conn2, "DELETE FROM descmtk WHERE descmtk.id = $id");
    }
    else{
        echo "nope";
    }
    
    $id_k = $id."_mtk";
    $val = mysqli_query($conn2, "SELECT 1 FROM $id_k");
    $exists = mysqli_fetch_assoc($val);
    if($exists){
        mysqli_query($conn2, "DROP TABLE $id_k");
    }
    else{
        echo "nope";
    }
    

?>


