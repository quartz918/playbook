<?php 
include_once("../backend/google_places_request.php");
include("../backend/set_band_var.php");
if(isset($_GET["addInstrument"])){
    $my_band->add_instrument(e($_POST["inst"]), e($_POST["num_inst"]));
}
if(!empty($_POST["location"])){
    $my_band->change_location(e($_POST["location"]));
     
}
elseif(!empty($_POST["search-location"])){
    $location = google_places_request(e($_POST["search-location"]));
    $my_band->change_location(e($location));
     
}
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
            You are a member of the band.
       
           <div class="band-found">
            <button class="band-found-button" type="button" id="band-delete-button" data-modal="#bandDelete">Delete band</button>
            <?php
            include('content/delete_band_dialogue.php'); ?>
            </div>
            <form action="disp_sel_band.php?addInstrument=true" method="post">
               <div class='add-inst-to-band-form'>
                <input type='text' name='inst' placeholder='instrument' class='instrument'>

                <input type='number' name='num_inst' class='num-inst'>
                <input type="submit" name="fButton" class="found-band-btn" value="Add Instrument" id="fBandBtn">
                </div>
                
            </form> 
            </div>
         <div>
             <form action="disp_sel_band.php" method="post">
                 <div> 
                    <?php include("content/get_location_form.php")?>
                 <input type="submit" value="Change location">
                 </div>
             </form>
         </div>
     </div>
    
</div>
       <?php    include('content/footer.php'); ?>
</div> 
