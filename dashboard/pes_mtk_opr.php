<?php
session_start();
include('database.php');
    
//LOAD DATA
if(isset($_POST['key']) && $_POST['key'] == 'load'){
    $nim = $_POST['nim'];
    //CEK APABILA PESERTA SUDAH ADA DI TABEL MATKUL (OPERASI)
    $query = "SHOW TABLES LIKE '%_______mtk'";
    $sql_run = mysqli_query($conn2, $query);

    while($row = mysqli_fetch_array($sql_run)){
        $data[] = $row;
    }

    $itung = count($data);

    for($i=0;$i < $itung;$i++){
        $query = "select *from ".$data[$i][0]." where nim = '$nim'";
        $sql_run = mysqli_query($conn2, $query);

        if(mysqli_num_rows($sql_run)==0){
            $idmatkul = chop($data[$i][0],"_mtk");
            $data_1[] = $idmatkul;
        }
        else{
            //$data -= NULL;
        }
    }

    foreach($data_1 as $single_data){
        $query = "SELECT id,nama,semester FROM idmtk where id = $single_data";
        $sql_run = mysqli_query($conn2, $query);

        while($row = mysqli_fetch_assoc($sql_run)){
            $data_2[] = $row;
        }
    }

    echo json_encode($data_2);

}

//PILIH MATKUL
if(isset($_POST['key']) && $_POST['key'] == 'submit'){
    $id = $_POST['id'];
    $nim = $_POST['nim'];

    date_default_timezone_set('Asia/Jakarta');
    $date = date('G:i - d/M/Y');
    
    for($i=0;$i < count($id);$i++){
        $query = "INSERT INTO `$id[$i]_mtk` (`id`, `nim`, `nilai`, `tanggal_nilai`) VALUES ('$id[$i]', '$nim', '', '$date')";
        mysqli_query($conn2,$query);
    }
    
    $_SESSION['nim'] = $nim;
}
?>

