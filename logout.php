<?php
    session_start();
    if($_SESSION['is_logged']) {
        session_unset();
        session_destroy();
        header("location: index.php");
        exit();
    }
?>