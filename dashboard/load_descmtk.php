<?php

    //select.php

    session_start();
    include('database.php');
    
    //Dapatkan data properties
    $idmatkul = $_POST['idmatkul'];

    $query = "select A,B,C,D from descmtk where id = $idmatkul";
    
    $sql_run = mysqli_query($conn2, $query);

    while($row = mysqli_fetch_assoc($sql_run)){
        $data[] = $row;
    }
    
    //$data += array("cek"=>"HALOOOOO", "cek2"=>"heyaaaa");
    
    echo json_encode($data);
    

?>

