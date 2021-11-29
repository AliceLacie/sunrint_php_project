<?php
    $a = "0e215962017";
    $ser_str = serialize($a);
    echo $ser_str;
    $un = unserialize($ser_str);
    echo $un;
    echo md5($un);
    if($un == md5($un)){
        echo "asdf";
    }
?>