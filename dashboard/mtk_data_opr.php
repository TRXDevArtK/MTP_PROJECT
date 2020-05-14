<?php

    include('database.php');

    //LOAD NILAI MTK
    if(isset($_POST['key']) && $_POST['key'] == 'load_nilai'){
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
    }

    //LOAD DESC MTK
    if(isset($_POST['key']) && $_POST['key'] == 'load_dsc'){
        //Dapatkan data properties
        $idmatkul = $_POST['idmatkul'];
        
        if(isset($_POST['mtk']) && $_POST['mtk'] == 'skp'){
            $idmatkul = chop($idmatkul,"_skp_mtk");
        }
        else if(isset($_POST['mtk']) && $_POST['mtk'] == 'mtk'){
            $idmatkul = chop($idmatkul,"_mtk");
        }
       
        $query = "select A,B,C,D from descmtk where id = $idmatkul";

        $sql_run = mysqli_query($conn2, $query);

        while($row = mysqli_fetch_assoc($sql_run)){
            $data[] = $row;
        }

        //$data += array("cek"=>"HALOOOOO", "cek2"=>"heyaaaa");

        echo json_encode($data);
    }

    //UPDATE DATA MTK
    if(isset($_POST['key']) && $_POST['key'] == 'update'){
        $nim = $_POST['nim'];
        $nilai = $_POST['nilai'];
        $idmatkul = $_POST['idmatkul'];

        date_default_timezone_set('Asia/Jakarta');
        $date = date('G:i - d/M/Y');

        for($i = 0; $i < count($nim); $i++){
            $query = "UPDATE `$idmatkul` SET `nilai` = '$nilai[$i]', `tanggal_nilai` = '$date' WHERE `$idmatkul`.`nim` = $nim[$i]";
            mysqli_query($conn2, $query);
        }
    }

    //DELETE DATA PESERTA YANG DIMATKUL
    if(isset($_POST['key']) && $_POST['key'] == 'delete'){
        $nim = $_POST['nim'];
        $idmatkul = $_POST['idmatkul'];

        for($i = 0; $i < count($nim); $i++){
            $query = "DELETE FROM `$idmatkul` WHERE `$idmatkul`.`nim` = $nim[$i]";
            mysqli_query($conn2, $query);
        }
    }
    
?>

