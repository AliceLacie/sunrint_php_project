<?php
    include  "../config.php";
    if(!empty($_GET['c2'])){
        $rand_cmp = md5(random_bytes(32));
        $s2 = $_GET['c2'];
        if(strcmp($s2, $rand_cmp) == 0){
            solve(1);
        }
    }  
?>