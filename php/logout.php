<?php
    ob_start();
    session_start();
    if(session_destroy()) {
        $_SESSION['user_logged']=false;
        header("Location: ../index.php");
    }
?>
