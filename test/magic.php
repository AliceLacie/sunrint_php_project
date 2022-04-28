<?php
    include "../config.php";
    session_check();
    highlight_file("../code/magic1.php");
    if(!empty($_GET['c1'])){
        $ser_str = $_GET['c1'];
        $un = unserialize($ser_str);
        if($un == md5($un)){
            echo "<br>Go to next Round<br>";
            echo MAGIC_FLAG1."<br>";
            echo "<a href='magic2.php'>Next Round</a>";
        }
    }
?>
