<?php
    //header("Content-type: application/vnd-ms-excel");
    //header("Content-Disposition: attachment; filename=raport2.xls");

    require_once 'dompdf/autoload.inc.php';

    // reference the Dompdf namespace
    use Dompdf\Dompdf;

    // instantiate and use the dompdf class

    $nim = $_POST['nim'];

    $dompdf = new Dompdf();

    ob_start();
    include 'laporan.php';
    $string = ob_get_clean();

    $dompdf->loadHtml($string);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4','potrait');

    // Render the HTML as PDF
    $dompdf->render();;

    // Output the generated PDF to Browser
    $dompdf->stream($nim."_raport");

    $_SESSION['nim'] = $nim;
    header('Location:kader_data.php');
    exit();

?>