<div id="instAdd" class="modal">
    <div class="modal-dialog">
        <div class="mod-add-inst-content">
            <span class="close">&times;</span>
            <form autocomplete="off" action="disp_instruments.php" method="post" id="searchF">
                <div class="textfield-auto-wrapper">
                    <div class="autocomplete-wrapper">
                    <div>
                        <div class="autocomplete">
                            <input id="myInput" type="text" name="instrument" placeholder="Instrument" class="inst-search">         
                        </div>
                        
                        <input type="submit" class="inst-search-btn" value="Add Instrument" id="instSearchBtn">
                    </div>    
                    </div>
                    
                    <div class="instrument-desc">
                        <p>Description:</p>
                        <textarea rows="4" cols="40" name="description" maxlength="200" class="text-area" id="textArea" placeholder="Enter a description here (e.g. skill level, favorite genre ...)"></textarea>
                    </div>
                </div>
          </form>
        </div>
    </div>
</div>