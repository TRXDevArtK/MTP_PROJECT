<?php
    #include sesuatu disini
    include_once "database.php";
    
    //LOAD DATA KOMSAT
    if(isset($_POST['key']) && $_POST['key'] == 'load_instruktur'){
        $query = "SELECT *FROM `instruktur`";
        $sql_run = mysqli_query($conn2, $query);

        $data = array();
        while($row = mysqli_fetch_assoc($sql_run)){
            $data[] = $row;
        }
        
        $query = "SELECT 1 FROM instruktur WHERE jabatan = 'MOT'";
        $sql_run = mysqli_query($conn2, $query);
        $mot_state = "mot_false";
        if(mysqli_num_rows($sql_run)==1){
            $mot_state = "mot_true";
        }
        
        $data[0]['mot_state'] = $mot_state;
     
        echo json_encode($data);
    }
    
    //LOAD DATA PC
    if(isset($_POST['key']) && $_POST['key'] == 'load_pc'){
        $query = "SELECT nia,nama,jabatan,pc FROM `data_pc`";
        $sql_run = mysqli_query($conn2, $query);

        $data = array();
        while($row = mysqli_fetch_assoc($sql_run)){
            $data[] = $row;
        }
        
        echo json_encode($data);
    }
    
    //UPDATE
    if(isset($_POST['key']) && $_POST['key'] == 'update_instruktur'){
        
        $nia = $_POST['nia'];
        $nama = $_POST['nama'];
        $jabatan = $_POST['jabatan'];
        $asal = $_POST['asal'];
        
        for($i=0;$i < count($nia);$i++){
            $query = "UPDATE `instruktur` SET `jabatan` = '$jabatan[$i]', `nama` = '$nama[$i]', `asal` = '$asal[$i]' WHERE `instruktur`.`nia` = $nia[$i]";
            mysqli_query($conn2, $query);
        }
    }
    
    //DELETE
    if(isset($_POST['key']) && $_POST['key'] == 'delete_instruktur'){
        
        $nia = $_POST['nia'];
        
        for($i=0;$i < count($nia);$i++){
            $query = "DELETE FROM `instruktur` WHERE `instruktur`.`nia` = $nia[$i]";
            mysqli_query($conn2, $query);
        }
    }
    
    //UPDATE DATA PC
    if(isset($_POST['key']) && $_POST['key'] == 'update_pc'){
        
        $ketum_nama = $_POST['ketum_nama'];
        $ketum_nia = $_POST['ketum_nia'];
        $kader_nama = $_POST['kader_nama'];
        $kader_nia = $_POST['kader_nia'];

        $query = "UPDATE `data_pc` SET `nia` = '$ketum_nia', `nama` = '$ketum_nama' WHERE `data_pc`.`pc` = 'ketum'";
        mysqli_query($conn2, $query);
        
        $query = "UPDATE `data_pc` SET `nia` = '$kader_nia', `nama` = '$kader_nama' WHERE `data_pc`.`pc` = 'kader'";
        mysqli_query($conn2, $query);
    }
    
    
?>

