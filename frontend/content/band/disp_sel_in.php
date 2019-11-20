<?php 
include_once("../../../backend/functions.php");
if(!isLoggedIn()){
    $_SESSION['msg'] = "You must log in first";
    header('location: ../../../index.php');
} else {
?>
<div class="wrapper">
    <?php include('content/header.php');?>

<div class="content">
    <?php    include('content/cover_band.php'); ?>
    
    <div class="navbar">
        <ul class="navigation">
            <li><a href="disp_sel_band.php" class="active">About</a></li>
            <li><a href="disp_band_inst.php?filter=1" >Instruments</a></li>
             <li><a href="disp_band_schedule.php" >Schedule</a></li>
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
            You are logged in.
        </div>            
     </div>    
</div>
       <?php    include('content/footer.php'); ?>
</div> 
<?php }?>