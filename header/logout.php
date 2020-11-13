<?php 
    session_start();
    $_SESSION["tw_id"] = "";
    session_destroy();
    header("location: http://localhost/TehnologiiWeb/header/login.php", true);
    exit();
?>