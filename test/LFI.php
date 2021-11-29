<?php
    include "../config.php";
    session_check();
    $_SESSION['LFI_session'] = 'I_am_LFIsession';

    error_reporting(E_ALL^ E_WARNING);
    echo "LFI<br>?flag=flag<br>";
    if(!empty($_GET['flag'])){
        if($_GET['flag']==='flag.php'){
            echo "You have to run the php file!!<br>";
        }
        $file = $_GET['flag'];
        $file = str_replace( array( "../", "..\\" ), "", $file );
        if(strpos($file, "I_am_LFIflag") !== false){
            include($file.'.php');   
        }
        else{
            echo "다른 php file은 접근할수 없습니다..";
        }
    }
?>