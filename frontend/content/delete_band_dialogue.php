<div id="bandDelete" class="modal">
    <div class="modal-dialog">
        <div class="mod-found-band-content">
            <span class="close">&times;</span>
            Are you sure that you want to delete this band from the system?
            <form autocomplete="off" action="disp_bands.php?band_id=<?php echo $my_band->get_band_id();?>" method="post" id="fBand">
                <div class="f-band-form-wrapper">
                    <input type="submit" name="dButton" class="dButton" value="Yes" >
                    
                    <input type="submit" name="dButton" class="dButton" value="No">
                </div>
            </form>
        </div>
    </div>
</div>