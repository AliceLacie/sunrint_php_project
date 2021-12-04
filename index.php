<!DOCTYPE html>
<html lang="en">
<?php 
    session_start();
    include "config.php";
?>
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
</head>
<body>
    <?php
        error_reporting(E_ALL&~E_NOTICE);
        if(isset($_SESSION['user_id']) || isset($_SESSION['user_name'])){
            // echo "XSS SQLI COOKIE LFI UPLOAD DOWNLOAD";
            $test = array("COOKIE", "LFI", "DOWNLOAD", "SQL", "MAGIC", "UPLOAD");
            for($i = 0; $i < count($test)-1; $i++){
                echo "<a href='test/".$test[$i].".php'>".($i+1).". ".$test[$i]."</a><br>";
            }
        ?>
            <form action="" method='POST'>
                FLAG : <input type="text" name="flag">
                <input type="submit" name="flag_submit">
            </form>
        <?php
            $id = $_SESSION['user_id'];
            $name = $_SESSION['user_name'];
            $db = mysqli_connect("127.0.0.1", "root", "", "sunrin");
            if(!empty($_POST['flag_submit'])){
                for($i = 0; $i<count(FLAG); $i++){
                    if(FLAG[$i] === $_POST['flag']){
                        $cnt = $i+1;
                        $q = "update user set chall$cnt=1 where id='$id'";
                        mysqli_query($db, $q);
                    }
                }
            }
            $q = "select chall1, chall2, chall3, chall4, chall5 from user where id='$id'";
            $r = mysqli_query($db, $q);
            $re = mysqli_fetch_row($r); 
            $score = (int)array_count_values($re)['1'] * 1000;
            $q = "update user set score=$score where id='$id'";
            mysqli_query($db, $q);
            echo "<p><strong>$name</strong>($id)";
            echo "<br>score : $score";
            echo "<br><a href=\"logout.php\">[로그아웃]</a></p><br><h1>Ranking</h1>";
            $q = "select * from user order by score desc";
            $r = mysqli_query($db, $q);
            echo "<table border='1' width='200' height='100'>
            <th>Name</th>
            <th>Score</th>";
            for($i=0;$i<mysqli_num_rows($r); $i++){
               $result = mysqli_fetch_array($r);
               echo        "<tr>
                                <td>".$result['name']."</td>
                                <td>".$result['score']."</td>
                            </tr>";
            }
            echo "</table>";
        }else{
    ?>
    <form action="index.php" method="POST">
        id : <input type="text" name="id"><br>
        pw : <input type="password" name="pw"><br>
        <input type="submit" value="submit" name="submit"><br>
    </form>
    <a href="./register.php">register</a>
        <?php 
            }
            
        if(!empty($_POST['submit'])){
            $id = $_POST['id'];
            $pw = $_POST['pw'];


            $user = 'root';
            $pass = '';
            $dsn = "mysql:host=localhost;dbname=sunrin;charset=utf8mb4;port=3306";
            try {
                $db = new \PDO($dsn, $user, $pass);
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }
            $query = "select * from user where id=? and password=?";
            $stmt = $db->prepare($query); 
            $stmt->execute(array($id, md5($pw))); 
            $result = $stmt->fetchAll(PDO::FETCH_NUM);

            if(!empty($result)){
                $_SESSION['user_id'] = $id;
                $_SESSION['user_name'] = $result[0][1];
                header("location:index.php");
            }
            else{
                echo "Login Fail...";
                echo  md5($pw);
            } 
        }
        ?>
    
</body>
</html>