<?php
    include('database.php');
    $nim = "1700018013";
    
    $query = "select *from pes_mtk where nim = $nim";
    $sql_run = mysqli_query($conn2, $query);
    $rowcount = mysqli_num_fields($sql_run);
    $minrow = $rowcount - 1;
    
    //echo $minrow;
    $datas = array();
    
    for($i=1;$i < $rowcount;$i++){
        $query = "select 1 from pes_mtk where mtk$i";
        $sql_run = mysqli_query($conn2, $query);
        
        if($sql_run->num_rows == $minrow){
            //buat tabel
            echo "buat tabel";
        }
    }
    
    $j = 0;
    for($i=1;$i < $rowcount;$i++){
        $query = "select 1 from pes_mtk where mtk$i = ''";
        $sql_run = mysqli_query($conn2, $query);
        
        if($sql_run->num_rows == 1){
            $j += 1;
            if($j == 1){
                echo $i;
            }
        }
    }
?>
