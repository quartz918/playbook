<?php
function load_usr_pic($usrid){
    
    $usrid = e($usrid);

    $path = "/user_pic/";
    $filename = "img_00" . $usrid . ".jpg";
    $phpPath = "/srv/http" . $path . $filename;
  

    global $fileLoc;

    if(file_exists($phpPath)){
        $fileLoc = $path . $filename;
    } else {
        $fileLoc = $path . "default.png";
    }

    $timestamp = time(); // avoid caching of the picture by browser
    return $fileLoc . "?" . $timestamp;
}
function load_bnd_pic($band_id){
    
    $band_id = e($band_id);

    $path = "/band_pic/";
    $filename = "img_00" . $band_id . ".jpg";
    $phpPath = "/srv/http" . $path . $filename;
  

    global $fileLoc;

    if(file_exists($phpPath)){
        $fileLoc = $path . $filename;
    } else {
        $fileLoc = $path . "default.png";
    }

    $timestamp = time(); // avoid caching of the picture by browser
    return $fileLoc . "?" . $timestamp;
}
?>
