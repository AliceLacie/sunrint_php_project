<?php
    $name = $_POST['name'];
    $pw = $_POST['pw'];


    $result = $DB->query("SELECT * FROM 'user' WHERE name='$name' and password='$pw';");
    $result = $result->fetchArray();
    if(!empty($result)){
        echo "Welcome ".$result['name']."<br>";
        if($result['name'] === 'admin'){
            solve(1);
        }
    }
    else{
        echo "없는 계정입니다..";
    }
?>