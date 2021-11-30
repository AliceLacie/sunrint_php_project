<?php
    const COOKIE_FLAG = 'HELLO WEB WORLD!';
    const SQL_FLAG = 'HELLO SQL WORLD!';
    const MAGIC_FLAG1 = "{HELLO HACK";
    const MAGIC_FLAG2 = "USER!!}";
    const MAGIC_FULL_FLAG = "{HELLO HACKUSER!!}";
    const LFI_FLAG = "HI! PHP WRAPPER!!";
    const DOWNLOAD_FLAG = "HI DOWNLOAD Attacker";
    const UPLOAD_FLAG = "do you know webshell?";
    const FLAG = array(COOKIE_FLAG,LFI_FLAG,DOWNLOAD_FLAG,SQL_FLAG,MAGIC_FULL_FLAG, UPLOAD_FLAG);

    function session_check(){
        session_start();
        if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])){
            header("location:../main.php");
        }
    }
    
    function arr_sort($array, $key, $sort){
        $keys = array();
        $vals = array();
        foreach( $array as $k=>$v ){
          $i = $v[$key].'.'.$k;
          $vals[$i] = $v;
          array_push($keys, $k);
        }
        unset($array);
      
        if( $sort=='asc' ){
          ksort($vals);
        }else{
          krsort($vals);
        }
        
        $ret = array_combine( $keys, $vals );
      
        unset($keys);
        unset($vals);
        
        return $ret;
    }
?>