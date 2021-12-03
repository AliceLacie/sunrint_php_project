<?php
    include  "../config.php";
    if(!empty($_GET['c1'])){
        $ser_str = $_GET['c1'];
        $un = unserialize($ser_str);
        if($un == md5($un)){
            echo "Go to next Round<br>";
            solve(1);
        }
    }
?>