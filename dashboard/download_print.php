<?php
    $nim = $_POST['nim'];

    ob_start();
    include 'laporan.php';
    $string = ob_get_clean();
    
    echo $string;
    echo '<body onload="window.print()">';
?>
