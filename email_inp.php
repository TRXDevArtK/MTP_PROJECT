<?php
    session_start();
    #include sesuatu disini
    include_once "sql_connect.php";
?>

<html>
    <head>
        <!--Metadata-->
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <form class="lupa_pass" method="POST" action="lupa_pass.php">
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Masukkan Email" name="email" required>
            <button type="submit" name="login">Submit</button>
        </form>
        
    </body>
</html>


