<?php

    include('database.php');

    //LOAD LIST IDMTK
    if(isset($_POST['key']) && $_POST['key'] == 'load'){
        $limit = $_POST['limit'];
        if (isset($_POST["page"])){ 
            $page  = $_POST["page"]; 
        } 
        else{ 
            $page=1; 
        }  

        $start_from = ($page-1) * $limit;  

        $keyword = '%'.$_POST['keyword'].'%'; 

        $query = "SELECT * FROM idmtk_skp WHERE nama LIKE ? limit ?,?";
        $sql_run = mysqli_prepare($conn2, $query);
        mysqli_stmt_bind_param($sql_run, "sii", $keyword,$start_from,$limit);
        mysqli_stmt_execute($sql_run);
        $result = mysqli_stmt_get_result($sql_run);

        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }

        //$data += array("cek"=>"HALOOOOO", "cek2"=>"heyaaaa");

        echo json_encode($data);
    }

    //DELETE MTK
    if(isset($_POST['key']) && $_POST['key'] == 'delete'){
        $id = $_POST['id'];

        $val = mysqli_query($conn2, "select 1 from idmtk_skp where id = $id LIMIT 1");
        $val = mysqli_fetch_assoc($val);
        if($val[1] == 1){
            mysqli_query($conn2, "DELETE FROM idmtk_skp WHERE idmtk_skp.id = $id");
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

        $id_k = $id."_mtk_skp";
        mysqli_query($conn2, "DROP TABLE IF EXISTS $id_k");

    }

?>

