<?php include_once('../backend/functions.php');
include('../backend/check_if_logged_in.php');	
include('../backend/set_band_var.php');

?>
<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<link rel="stylesheet" type="text/css" href="../format.css">
<link rel="stylesheet" type="text/css" href="home_sty.css">
<link rel="stylesheet" type="text/css" href="bands_sty.css">
</head>
<body>
  
 <?php    
 if(isLoggedIn()){
     if($my_band->check_if_leader(e($_SESSION['user']['id']))){
         include('content/band/disp_sel_leader.php');
     }
     elseif($my_band->check_if_member(e($_SESSION['user']['id']))){
         include('content/band/disp_sel_mem.php');
     }
     else {
          include('content/band/disp_sel_in.php');
     }
 }
 else {
     include('content/band/disp_sel_out.php');
 }
 
 
 
 include('content/home_gen_js.php'); ?> 
</body>
</html>