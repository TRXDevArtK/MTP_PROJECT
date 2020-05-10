<?php
session_start();
include('database.php');
    
//LOAD DATA PESERTA YANG TIDAK ADA DI MATKUL
if(isset($_POST['key']) && $_POST['key'] == 'load'){
    $idmatkul = $_POST['idmatkul'];
    $query = "SELECT nim from peserta";
    $sql_run = mysqli_query($conn2, $query);
    
    while($row = mysqli_fetch_assoc($sql_run)){
        $data[] = $row;
    }

    foreach($data as $single_data){
        $query = "select nim from $idmatkul where nim = ".$single_data['nim']."";
        $sql_run = mysqli_query($conn2, $query);
        
        if(mysqli_num_rows($sql_run)==0){
            $data_1[] = $single_data['nim'];
        }
        else{
            //ABAIKAN YG ADA ISI DI MATKUL
        }
        
    }
    
    foreach($data_1 as $datas){
        $query = "SELECT nim,namafull from peserta where nim = $datas";
        $sql_run = mysqli_query($conn2, $query);
        
        while($row = mysqli_fetch_assoc($sql_run)){
            $data_2[] = $row;
        }
    }
    
    echo json_encode($data_2);
}

//SUBMIT CHECK BOX YANG DIPILIH
if(isset($_POST['key']) && $_POST['key'] == 'submit'){
    $idmatkul = $_POST['idmatkul'];
    $nim = $_POST['nim'];

    date_default_timezone_set('Asia/Jakarta');
    $date = date('G:i - d/M/Y');
    
    $chp = chop($idmatkul,"_mtk");
    
    for($i=0;$i < count($nim);$i++){
        $query = "INSERT INTO `$idmatkul` (`id`, `nim`, `nilai`, `tanggal_nilai`) VALUES ('$chp', '$nim[$i]', '', '$date')";
        mysqli_query($conn2,$query);
    }
    
    $_SESSION['id'] = $chp;
}

?>

