<?php
    include "../config.php";
    session_check();
    highlight_file('../code/cookie_code.php');
    
    if(empty($_COOKIE['your_lv'])){
        setcookie('your_lv', '0');
    }

    if(!empty($_COOKIE['your_lv'])){
        if($_COOKIE['your_lv'] > 100 && $_COOKIE['your_lv']>=100 ){
            echo "<br>Flag is ".COOKIE_FLAG;
        }
    }
?>