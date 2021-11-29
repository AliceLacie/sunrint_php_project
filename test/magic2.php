<?php
    include "../config.php";
    session_check();
    error_reporting(E_ALL^ E_WARNING);
    highlight_file("../code/magic2.php");
    if(!empty($_GET['c2'])){
        $rand_cmp = md5(random_bytes(32));
        $s2 = $_GET['c2'];
        if(strcmp($s2, $rand_cmp) == 0){
            include  "../config.php";
            echo "<br>".MAGIC_FLAG2;
        }
    }  
?>