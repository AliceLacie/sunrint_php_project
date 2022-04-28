<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>join</title>
</head>
<body>
    <form action="./register.php" method="POST">
        id : <input type="text" name="id"><br>
        name : <input type="text" name="name"><br>
        password : <input type="password" name="pw"><br>
        password check : <input type="password" name="pw_back"><br>
        <input type="submit" value="submit" name="submit"><br>
    </form>
</body>
</html>
<?php
    if(!empty($_POST['submit'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $pw = $_POST['pw'];
        $pw_back = $_POST['pw_back'];
        if(!empty($id)&&!empty($pw)){
            $user = 'root';
            $pass = '';

            $dsn = "mysql:host=localhost;dbname=sunrin;charset=utf8mb4;port=3306";
            try {
                $db = new \PDO($dsn, $user, $pass);
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }
            $query = "SELECT * FROM user WHERE id=?";
            $stmt = $db->prepare($query); 
            $stmt->execute(array($id)); 
            $result = $stmt->fetch(PDO::FETCH_NUM);

            if(!empty($result)){
                echo "The ID overlaps";
            }
            else{
                if($pw !== $pw_back){
                    echo "Password and password check are not the same.";
                }
                else{
                    $q = "INSERT INTO user(id, name, password) VALUES (?,?,?)";
                    $stmt= $db->prepare($q)->execute([$id, $name, md5($pw)]);
                    echo "register Success!!";
                    header("location:index.php");
                }
            }
        }
        else{
            echo "register Fail..";
        }
    }
?>
