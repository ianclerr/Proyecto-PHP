<?php
    session_start();
    session_destroy();
 
    header('location:/empleado/index.html');
?>