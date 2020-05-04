<?php
session_start();
    if(isset($_POST['abc'])) 
    {
        $_SESSION['uy'] = "test";
    }
    
    echo $_SESSION['uy'];
    
    /*if(isset($_SESSION['uy'])){
        unset($_SESSION['uy']);
        header("location:index.php");
    }*/

?>

<html>
    <head>
        <!--Metadata-->
        <meta charset="UTF-8">
        <script src="../scripts/jquery-3.4.1.js"></script>
        <link rel="stylesheet" href="../css/bootstrap337.min.css" />  
        <script src="../scripts/bootstrap.js"></script> 
    </head>
    <body>
        
    </body>
</html>

<script>
$(document).ready(function(){
    var abc = "JAVASCRIP SESSION";
    function abcc(){
        $.ajax({
            method:"POST",
            data:{
                abc : 'lollllll' 
            },
            dataType: 'text',
            success:function(data){
                //window.location.href = 'test6.php';
            }
        });
    }
    
    abcc();
})
</script>