<?php    
    session_start();
    session_destroy();
    echo "Logged out Success!";
    header("location: ../index.php");
?>