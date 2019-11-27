<div class="wrapper">
    <?php include('content/header.php');?>

<div class="content">
    <?php    include('content/cover_band.php'); ?>
    
    <div class="navbar">
        <ul class="navigation">
            <li><a href="disp_sel_band.php" >About</a></li>
            <li><a href="disp_band_inst.php?filter=all" >Instruments</a></li>
            <li><a href="disp_band_schedule.php" class="active">Schedule</a></li>
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
           $res = get_events_of_band($my_band->get_band_id());
           include('content/disp_list_events.php');
           display_list_events($res);
           ?>
            </div>
       
     </div>
    
</div>
       <?php    include('content/footer.php'); ?>
</div> 
<script>
    $(#attend-event-button).on( "click", function(){
        document.getElementById("attendEvent").innerHTML = "Unregister";
    }
</script>