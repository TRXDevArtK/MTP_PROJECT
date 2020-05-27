<?php
    ob_start();
    session_start();
    unset ($_SESSION['login_id']);
    session_destroy();
    header("location:index.php");
    exit();
?>

