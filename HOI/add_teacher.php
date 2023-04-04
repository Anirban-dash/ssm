<?php
require "./../conn.php";
session_start();
if (!isset($_SESSION['id']) or $_SESSION['status'] != "hoi") {
  header("location:error.html");
}

$name = mysqli_real_escape_string($con, $_POST['name']);
$addr = mysqli_real_escape_string($con, $_POST['addr']);
$mail = mysqli_real_escape_string($con, $_POST['mail']);
$mobile = mysqli_real_escape_string($con, $_POST['mobile']);
$gender = mysqli_real_escape_string($con, $_POST['gender']);
$aadhar = mysqli_real_escape_string($con, $_POST['aadhar']);
//
$target_dir = "../img/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$uploadOk = 1;
if ($_FILES["image"]["size"] > 5000000) {
    echo "Sorry, image is too large.";
    $uploadOk = 0;
  }
  
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    die();
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      $img=$_FILES["image"]["name"];
        $res=mysqli_query($con,"INSERT INTO `teacher` (`name`, `email`, `mobile`, `aadhar`, `pass`, `gender`, `photo`, `address`) VALUES ('$name','$mail', '$mobile',  '$aadhar', 'password', '$gender', '$img', '$addr')") or die(mysqli_error($con));
        header("location:teacher.php");
    } else {
      echo "Sorry, there was an error uploading your file.";
      die();
    }
}
?>