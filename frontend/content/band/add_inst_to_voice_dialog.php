<div id="addInstToVoice" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="mod-wrapper">
                <div class="add-new-voice-title">Add an instrument to <span id="inst-voice-name"></span></div>
                
                    <form action="disp_band_inst.php?filter=<?php echo e($_GET['filter']); ?>" method="post">
                         <input type="text" name="inst-name" id="name-input" placeholder="Instrument name">   
                         <input type="submit" name="submit-add-inst" value="submit" >
                         <input type="hidden" id="vcID" name="voice_id" value="">
                    </form>

                           
            </div>
        </div>
    </div>
</div>
