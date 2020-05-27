<?php
    $rand = 12345;
    $password = password_hash($rand, PASSWORD_DEFAULT);
    $msg = "asdwdwdwasd"
            . "askjdhwdasdw"
            . "ahsdkwdwd";
    
    echo $password;
?>

<html>
    <head>
        <!--Metadata-->
        <meta charset="UTF-8">
        <script src="../js/jquery.min.js"></script>
        <link rel="stylesheet" href="../css/loading.css" />  
        <script src="../js/bootstrap.min.js"></script>  
        <title></title>
    </head>
    <body style="background: skyblue">
        <div class="ajaxload"><!-- Place at bottom of page --></div>
    </body>
</html>
