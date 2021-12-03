<?php
    include "../config.php";
    session_check();
    echo "file DOWNLOAD<br>";
    echo "<br>FLAG 파일은 ../FLAG/THIS_is_downFLAG.php입니다!!<br>";
    echo "<a href='?file=testfile'>test</a>";
    if(!empty($_GET['file'])){
        $file = $_GET['file'];
        if(file_exists($file)){
            if(strpos($file, "THIS_is_downFLAG") !== false){
                header("Content-Type:application/octet-stream");
                header("Content-Disposition:attachment;filename=$file");
                header("Content-Transfer-Encoding:binary");
                header("Content-Length:".filesize($file)+300);
                header("Cache-Control:cache,must-revalidate");
                header("Pragma:no-cache");
                header("Expires:0");
                if(is_file($file)){
                    $fp = fopen($file,"r");
                    while(!feof($fp)){
                    $buf = fread($fp,8096);
                    $read = strlen($buf);
                    print($buf);
                    flush();
                    }
                    fclose($fp);
                }
            }
            else{
                echo "파일 접근 권한이 없습니다..";
            }
        }
        else{
            echo "존재하지 않는 파일입니다..";
        }
    }
?>