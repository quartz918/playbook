<?php include_once('../backend/functions.php');
include('../backend/check_if_logged_in.php');	
include('../backend/calendar.php');
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
  $event_id = e($_GET["event_id"]);
 
?>
<div class="wrapper">
    <?php include('content/header.php');?>

<div class="content">
    <?php    //include('content/cover_band.php'); ?>
    
    <div class="navbar">
        <ul class="navigation">
            
        </ul>
    </div>
     <div class="content-element">
        <div class="content-band-header">
            <div class="content-title">
            </div>
            
            </div>
        <div class="error-message">
        
        </div>
        <div class="enum-element">
      
        <?php 
        
        echo $event_id;
        $my_event = new event($event_id);
        echo $my_event->get_name();
        ?> <br>
        <?php  
        if(isLoggedIn()){
            $user_id = e($_SESSION['user']['id']);
            if($my_band->check_if_member($user_id)){
                include('content/event/disp_event_band_mem.php');
            }
        }?>
            </div>
            
     </div>
    
</div>
       <?php    include('content/footer.php'); ?>
</div> 

 <?php    

 
 include('content/home_gen_js.php'); ?> 
</body>
</html>