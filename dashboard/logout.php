<?php
    session_start();
    $run = session_destroy();
    if($run == true){
        redirect()->to(base_url().'/login');
    }
    else{
        redirect()->to(previous_url());
    }
?>

