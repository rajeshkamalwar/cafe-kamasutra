<?php
            session_start();
            include 'admin/db.php';
            include 'admin/config.php';
            ob_start();
if(isset($_GET['action'])){
    $action = trim($_GET['action']);
     $cpage = $_GET['cpage'];
    
    $_SESSION['current_lang']=$action;
    header("location:$cpage");

}
