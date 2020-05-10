<?php
session_start();
include('database.php');

//LOAD LIST PESERTA
if(isset($_POST['key']) && $_POST['key'] == 'load'){
    $limit = $_POST['limit'];
    if (isset($_POST["page"])){ 
        $page  = $_POST["page"]; 
    } 
    else{ 
        $page=1; 
    }  
    
    $start_from = ($page-1) * $limit;  

    $query = "select nim, namafull from peserta LIMIT $start_from,$limit";
    
    $sql_run = mysqli_query($conn2, $query);

    while($row = mysqli_fetch_assoc($sql_run)){
        $data[] = $row;
    }
    
    //$data += array("cek"=>"HALOOOOO", "cek2"=>"heyaaaa");
    
    echo json_encode($data);
}

//DELETE PESERTA
if(isset($_POST['key']) && $_POST['key'] == 'delete'){
    $nim = $_POST['nim'];
    
    $query = "DELETE FROM `peserta` WHERE `peserta`.`nim` = $nim";
    $sql_run = mysqli_query($conn2, $query);
}

?>

