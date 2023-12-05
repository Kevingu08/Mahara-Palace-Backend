<?php 
    session_start();
    if(isset($_COOKIE["dishList"])){
        setcookie("dishList", "", time() - 73000);
    }
    session_destroy();

    //redirect to index page
    header("Location: index.php");
?>