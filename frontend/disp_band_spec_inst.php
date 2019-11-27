<?php include_once('../backend/functions.php');
include('../backend/check_if_logged_in.php');	
include('../backend/set_band_var.php');
include_once('content/disp_list_instruments.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<link rel="stylesheet" type="text/css" href="../format.css">
<link rel="stylesheet" type="text/css" href="home_sty.css">
<link rel="stylesheet" type="text/css" href="following_sty.css">
<link rel="stylesheet" type="text/css" href="bands_sty.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
 <?php    
 if(isLoggedIn()){
     $user_id = e($_SESSION['user']['id']);
     if($my_band->check_if_leader($user_id)){
   
         include('content/band/disp_spec_inst_leader.php');
         
     }
     elseif($my_band->check_if_member($user_id)){


     }
     else {

     }
 }
 else {
 
 }
           include('content/home_gen_js.php'); ?> 
</body>
</html>