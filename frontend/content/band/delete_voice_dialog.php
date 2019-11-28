<div id="deleteVoice" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="mod-wrapper">
                <div class="add-new-voice-title">Are you sure that you want to remove <span id="instvn-delete"></span> from your band/orchestra?</div>                
                    <form action="../backend/band/delete_voice.php" method="post">
                         <input type="submit" name="delete-response" value="yes" >  
                         <input type="submit" name="delete-response" value="no" >
                         <input type="hidden" id="vcid-delete" name="voice_id" value="">
                    </form>                 
            </div>
        </div>
    </div>
</div>
