
<div id="bandFound" class="modal">
    <div class="modal-dialog-band">
        <div class="mod-found-band-content">
            <span class="close">&times;</span>
            <form autocomplete="off" action="disp_bands.php" method="post" id="fBand">
            <div class="found-band-wrapper"> 
                <div class="found-band-form">
                    
                        <div class="f-band-form-wrapper">
                            <input type="text" name="bandName" placeholder="Band name" class="band-name">
                            <?php
                                for($i=0;$i<4;$i++){
                                    echo "<div class='add-inst-to-band-form'>";
                                    echo "<input type='text' name='inst".$i."' placeholder='instrument ".$i."' class='instrument'>";

                                    echo "<input type='number' name='num_inst".$i."' class='num-inst'>";
                                    echo "</div>";
                                }
                                ?>

                            <input type="submit" name="fButton" class="found-band-btn" value="Found Band" id="fBandBtn">
                        </div>
                    
                </div>
                <?php include("content/get_location_form.php")?>
            </div>
            </form>  
        </div>
    </div>
</div>
   
 