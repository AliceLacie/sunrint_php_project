<!DOCTYPE html>
<html>
<body>
<form action="UPLOAD.php" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="uploadfile" id="uploadfile"><br>
  <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>
<?php
    include "../config.php";
    session_check();
    $target_dir = "./uploads/";
    $file_name = md5(random_bytes(32));
    $target_file = $target_dir.$file_name;
    if(isset($_POST["submit"])) {
        $check = $_FILES['uploadfile']['type'];
        $ext = explode("/", $check);
        if($ext[0] === 'image') {
            echo "Your $file_name file is IMG";
            move_uploaded_file($_FILES['uploadfile']['tmp_name'], "$target_file.{$ext[1]}");
            echo "<br><a href='./uploads/$file_name'>$file_name</a>";
        } else {
            echo "File is not an image.";
        }
    }

?>
