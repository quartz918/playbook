<?php

include_once('../backend/functions.php');
        if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../index.php');
}
$filename = "img_00" . $_SESSION['user']['id'] . ".jpg";
$target_dir = "/srv/http/user_pic/";
$target_file = $target_dir . basename($filename);

$extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$status = 1;

if(file_exists($target_file)){
    unlink($target_file);
}

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $status = 1;
    } else {
        echo "File is not an image.";
        $status = 0;
    }
}

if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $status = 0;
} 

// Allow certain file formats
if($extension != "jpg" && $extension != "png" && $extension != "jpeg"
&& $extension != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed. " ;
    $status = 0;
} 

if($status == 0){
    echo "file could not be uploaded";
}

 else {
    
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        header('location: ../frontend/home.php');
    } else {
        echo "Sorry, there was an error uploading your file.";
        $user = posix_getpwuid(posix_geteuid());

        var_dump($user);
    }
}
