<?php
    
    include('database.php');

    //LOAD DATA
    if(isset($_POST['key']) && $_POST['key'] == 'load'){
        $nim = $_POST['nim'];
        //CEK APABILA KADER SUDAH ADA DI TABEL MATERI (OPERASI)
        
        if(isset($_POST['mtk']) && $_POST['mtk'] == 'skp'){
            $u_mtk = "%_______mtk_skp";
            $t_mtk = "idmtk_skp";
            $c_mtk = "_mtk_skp";
            $semester = "";
        }
        else if(isset($_POST['mtk']) && $_POST['mtk'] == 'mtk'){
            $u_mtk = "%_______mtk";
            $t_mtk = "idmtk";
            $c_mtk = "_mtk";
            $semester = ",semester";
        }
        
        $query = "SHOW TABLES LIKE '$u_mtk'";
        $sql_run = mysqli_query($conn2, $query);
        
        $data = array();
        while($row = mysqli_fetch_array($sql_run)){
            $data[] = $row;
        }

        $itung = count($data);
        
        $data_1 = array();
        for($i=0;$i < $itung;$i++){
            $query = "select *from ".$data[$i][0]." where nim = '$nim'";
            $sql_run = mysqli_query($conn2, $query);

            if(mysqli_num_rows($sql_run)==0){
                $idmateri = chop($data[$i][0],$c_mtk);
                $data_1[] = $idmateri;
            }
            else{
                //$data -= NULL;
            }
        }
        
        $data_2 = array();
        foreach($data_1 as $single_data){
            $query = "SELECT id,nama$semester FROM $t_mtk where id = '$single_data'";
            $sql_run = mysqli_query($conn2, $query);

            while($row = mysqli_fetch_assoc($sql_run)){
                $data_2[] = $row;
            }
        }

        echo json_encode($data_2);

    }

    //PILIH MATERI
    if(isset($_POST['key']) && $_POST['key'] == 'submit'){
        $id = $_POST['id'];
        $nim = $_POST['nim'];
        
        if(isset($_POST['mtk']) && $_POST['mtk'] == 'skp'){
            $c_mtk = "_mtk_skp";
        }
        else if(isset($_POST['mtk']) && $_POST['mtk'] == 'mtk'){
            $c_mtk = "_mtk";
        }

        date_default_timezone_set('Asia/Jakarta');
        $date = date('G:i - d/M/Y');

        for($i=0;$i < count($id);$i++){
            $query = "INSERT INTO `".$id[$i].$c_mtk."` (`id`, `nim`, `nilai`, `tanggal_nilai`) VALUES ('$id[$i]', '$nim', '', '$date')";
            mysqli_query($conn2,$query);
        }

        $_SESSION['nim'] = $nim;
    }
    
?>

