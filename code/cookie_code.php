<?php
    if(empty($_COOKIE['your_lv'])){
        setcookie('your_lv', '0');
    }

    if($_COOKIE['your_lv'] > 100 && $_COOKIE['your_lv']>=100 ){
        solve(1);
    }
?>