<?php
    $file = $_GET['flag'];
    $file = str_replace( array( "../", "..\\" ), "", $file );
    include($file.'.php');
?>