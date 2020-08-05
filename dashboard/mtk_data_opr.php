<?php

    include('database.php');

    //LOAD NILAI MTK
    if(isset($_POST['key']) && $_POST['key'] == 'load_nilai'){
        //Dapatkan data properties
        $idmateri = $_POST['idmateri'];

        $limit = $_POST['limit'];
        if (isset($_POST["page"])){ 
            $page  = $_POST["page"]; 
        }
        else{ 
            $page=1; 
        }  

        $start_from = ($page-1) * $limit;

        $query = "SELECT $idmateri.nim, kader.namafull, kader.komsat, $idmateri.tanggal_nilai, $idmateri.nilai FROM kader,$idmateri "
                . "WHERE kader.nim = $idmateri.nim LIMIT $start_from,$limit";

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
        $idmateri = $_POST['idmateri'];
        
        if(isset($_POST['mtk']) && $_POST['mtk'] == 'skp'){
            $idmateri = chop($idmateri,"_mtk_skp");
        }
        else if(isset($_POST['mtk']) && $_POST['mtk'] == 'mtk'){
            $idmateri = chop($idmateri,"_mtk");
        }
       
        $query = "select A,B,C,D from descmtk where id = $idmateri";

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
        $idmateri = $_POST['idmateri'];

        date_default_timezone_set('Asia/Jakarta');
        $date = date('G:i - d/M/Y');

        for($i = 0; $i < count($nim); $i++){
            $query = "UPDATE `$idmateri` SET `nilai` = '$nilai[$i]', `tanggal_nilai` = '$date' WHERE `$idmateri`.`nim` = $nim[$i]";
            mysqli_query($conn2, $query);
        }
    }

    //DELETE DATA KADER YANG DIMATERI
    if(isset($_POST['key']) && $_POST['key'] == 'delete'){
        $nim = $_POST['nim'];
        $idmateri = $_POST['idmateri'];

        for($i = 0; $i < count($nim); $i++){
            $query = "DELETE FROM `$idmateri` WHERE `$idmateri`.`nim` = $nim[$i]";
            mysqli_query($conn2, $query);
        }
    }
    
?>

