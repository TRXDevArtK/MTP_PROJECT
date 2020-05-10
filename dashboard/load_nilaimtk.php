<?php

    //select.php

    session_start();

    include('database.php');
    
    //Dapatkan data properties
    $idmatkul = $_POST['idmatkul'];
    
    $limit = $_POST['limit'];
    if (isset($_POST["page"])){ 
        $page  = $_POST["page"]; 
    }
    else{ 
        $page=1; 
    }  
    
    $start_from = ($page-1) * $limit;

    $query = "SELECT $idmatkul.nim, peserta.namafull, $idmatkul.tanggal_nilai, $idmatkul.nilai FROM peserta,$idmatkul "
            . "WHERE peserta.nim = $idmatkul.nim LIMIT $start_from,$limit";
    
    $sql_run = mysqli_query($conn2, $query);

    while($row = mysqli_fetch_assoc($sql_run)){
        $data[] = $row;
    }
    
    //$data += array("cek"=>"HALOOOOO", "cek2"=>"heyaaaa");
    
    echo json_encode($data);
    

?>

