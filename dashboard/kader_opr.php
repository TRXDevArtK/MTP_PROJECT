<?php

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
        
        $filter = '%'.$_POST['filter'].'%';
        $keyword = '%'.$_POST['keyword'].'%';
        
        $order = $_POST['order'];
        $order = mysqli_real_escape_string($conn2, $order);

        $query = "select nim, namafull, komsat FROM kader where komsat LIKE ? AND (nim LIKE ? OR namafull LIKE ? OR komsat LIKE ?) ORDER BY $order LIMIT ?,?";
        $sql_run = mysqli_prepare($conn2, $query);
        mysqli_stmt_bind_param($sql_run, "sissii", $filter,$keyword,$keyword,$keyword,$start_from,$limit);
        mysqli_stmt_execute($sql_run);
        $result = mysqli_stmt_get_result($sql_run);

        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }

        //$data += array("cek"=>"HALOOOOO", "cek2"=>"heyaaaa");

        echo json_encode($data);
    }

    //DELETE PESERTA
    if(isset($_POST['key']) && $_POST['key'] == 'delete'){
        $nim = $_POST['nim'];
        
        //HAPUS DATA PESERTA
        $query = "DELETE FROM `kader` WHERE `kader`.`nim` = $nim";
        $sql_run = mysqli_query($conn2, $query);
        
        //HAPUS DATA PRESENSI
        $query = "DELETE FROM `kader_presensi` WHERE `kader_presensi`.`nim` = $nim";
        $sql_run = mysqli_query($conn2, $query);
        
        //HAPUS DATA CATATAN
        $query = "DELETE FROM `kader_catatan` WHERE `kader_catatan`.`nim` = $nim";
        $sql_run = mysqli_query($conn2, $query);
        
        //OPERASI HAPUS DATA PESERTA DI MATERI . .
        
        $u_mtk = "%_______mtk";
        $query = "SHOW TABLES LIKE '$u_mtk'";
        $sql_run = mysqli_query($conn2, $query);
        
        $data = array();
        while($row = mysqli_fetch_array($sql_run)){
            $data[] = $row;
        }
        
        foreach($data as $single_data){
            $query = "SELECT 1 FROM $single_data[0] WHERE nim = 1700018013";
            $sql_run = mysqli_query($conn2, $query);
            
            if(mysqli_num_rows($sql_run)==1){
                $query = "DELETE FROM `$single_data[0]` WHERE `$single_data[0]`.`nim` = $nim";
                $sql_run = mysqli_query($conn2, $query);
            }
        }
        
        //OPERASI HAPUS DATA PESERTA DI MATERI SIKAP . .
        $u_mtk = "%_______mtk_skp";
        $query = "SHOW TABLES LIKE '$u_mtk'";
        $sql_run = mysqli_query($conn2, $query);
        
        $data = array();
        while($row = mysqli_fetch_array($sql_run)){
            $data[] = $row;
        }
        
        foreach($data as $single_data){
            $query = "SELECT 1 FROM $single_data[0] WHERE nim = 1700018013";
            $sql_run = mysqli_query($conn2, $query);
            
            if(mysqli_num_rows($sql_run)==1){
                $query = "DELETE FROM `$single_data[0]` WHERE `$single_data[0]`.`nim` = $nim";
                $sql_run = mysqli_query($conn2, $query);
            }
        }
        
        
    }

?>

