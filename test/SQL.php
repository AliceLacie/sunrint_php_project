<?php
    include "../config.php";
    session_check();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SQL</title>
</head>
<body>
    <form action="./SQL.php" method="post">
    	<input type="text" name="name">
        <input type="password" name="pw">
        <input type="submit" id="submit" name="submit" value="submit">
    </form>
    <p>admin의 계정으로 로그인 하세요!!</p>
</body>
</html>
<?php
    try{
        highlight_file("../code/sql_code.php");
        if(!empty($_POST['submit'])){
            error_reporting(E_ALL^ E_WARNING);
            $DB = new SQLite3('database.db');
        
            $name = $_POST['name'];
            $pw = $_POST['pw'];


            $result = $DB->query("SELECT * FROM 'user' WHERE name='$name' and password='$pw';");
            $result = $result->fetchArray();
            if(!empty($result)){
                echo "<br>Welcome ".$result['name']."<br>";
                if($result['name'] === 'admin'){
                    echo "Flag is ".SQL_FLAG;
                }
            }else{
                echo "<br>없는 계정입니다..";
            }
        }
    }catch(Throwable $th){
        echo "<br>알수 없는 에러가 발생했습니다..";
    }
?>
