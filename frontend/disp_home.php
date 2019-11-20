<?php 
include('../backend/check_if_logged_in.php');	
?>

<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<link rel="stylesheet" type="text/css" href="../format.css">
<link rel="stylesheet" type="text/css" href="home_sty.css">

</head>
<body>
<div class="wrapper">
<?php include('content/header.php');?>

<div class="content">
       <?php include('content/cover.php'); ?>
    
    <div class="navbar">
        <ul class="navigation">
            <li><a href="disp_about.php">About</a></li>
            <li><a href="disp_instruments.php" id="dispInst">Instruments</a></li>
            <li><a href="disp_bands.php">Bands</a></li>
            <li><a href="disp_following.php">You Follow</a></li>
            <li><a href="disp_follower.php">Follower</a></li>
        </ul>
    </div>
    

    <div class="home">
        <div class="content-element">
        <div class="content-header">
            <div class="content-title">
                <p>Home: </p> 
            </div>
            
            
        </div>
        <div class="error-message">
        
        </div>
        <div class="enum-element">
           
        </div>
    </div>
        
    </div>
    </div>

    <?php    include('content/footer.php'); ?>
</div>
    
   <?php    include('content/home_gen_js.php'); ?> 
    

</body>
</html>