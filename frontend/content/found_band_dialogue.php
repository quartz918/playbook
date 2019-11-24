<div id="bandFound" class="modal">
    <div class="modal-dialog-band">
        <div class="mod-found-band-content">
            <span class="close">&times;</span>
            <form autocomplete="off" action="disp_bands.php" method="post" id="fBand">
            <div class="fb-wrapper">               
                    <div class="fb-title">
                        <input type="text" name="bandName" placeholder="Band name" class="band-name">
                    </div>
                    <div class="fb-content">       
                        <div class='fb-voice-add'>
                            <table><tr><td valign="top">
                            <div class='fb-voice-wrapper'>            
                                           
                                <div class='fb-inst-drop'>
                                        <input type='button' name='set0' onclick='openSet(0)' value='  ' class='fb-inst-drop-btn'>
                                        <div class='fb-inst-menu' id='fb-inst-menu0'>
                                            <input type='button' name='add_inst_voice0' class='add-inst-to-voice' onclick='addInstToVoice(0)' value='add another instrument to voice'>

                                        </div>
                                </div>
                                <div class='fb-voice-label' id='fb-voice-label0'>Voice: 1</div> 
                            </div></td><td>
                            <div class="fb-instrument-wrapper">    
                                <div class="fb-instrument">
                                    <input type='text' name='inst0' placeholder='instrument 0' class='instrument'>
                                    <input type='number' name='num_inst0' class='num-inst'>
                                    <input type='hidden' name='voice_inst0' value='0'>

                                </div>
                                    <div id='addInstVoice0'></div></div></td></tr></table>
                            </div>
                        <div id='addVoice'></div>
                        <input type='button' name='add_voice' class='add-voice' value='Add another voice' >
                    </div>
                        <?php include("content/get_location_form.php")?>
                     
                    <input class="f-button" type="submit" name="fButton" class="found-band-btn" value="Found Band" id="fBandBtn">
                </div>
            </form>  
        </div>
    </div>
</div>
<script>
    var i = 1;
    var j = 1;
    $(".add-voice").on("click", function(){
        
        document.getElementById("addVoice").outerHTML = 
            "<div class='fb-voice-add'>   \n\
                <table><tr><td valign='top'>\n\
                <div class='fb-voice-wrapper'> "                     
                    +"<div class='fb-inst-drop'>\n\
                            <input type='button' onclick='openSet(" + j +")' name='set" + j +"' value='  ' class='fb-inst-drop-btn'>\n\
                                <div class='fb-inst-menu' id='fb-inst-menu" + j+ "'>\n\
                                    <input type='button' class='add-inst-to-voice' name='add_inst_voice'" + j + " value='add another instrument to voice' onclick='addInstToVoice(" + j + ")'>\n\
                                </div>\n\
                        </div>\n\
                    <div class='fb-voice-label' id='fb-voice-label" + j +"'>Voice: " + (j+1) +"</div>\n\
                </div></td><td>\n\
                <div class='fb-instrument-wrapper'> \n\
                <div class='fb-instrument'>\n\
                    <input type='text' name='inst" + i + "' placeholder='instrument "+ i +"' class='instrument'>\n\
                    <input type='number' name='num_inst" + i + "' class='num-inst'>\n\
                    <input type='hidden' name='voice_inst" + i + "' value='" + j + "'>"
                    
                + "</div>\n\
                <div id='addInstVoice" + j +"'></div>\n\
                </div></td></tr></table>\n\
            </div>\n\
            <div id='addVoice'></div>";
                                    
        i++;
        j++;
      
    });
    function openSet(x){
        event.stopPropagation();
        var reqChange = false;
        if($("#fb-inst-menu"+x).css('display') == 'none'){
            reqChange = true;
        }
        $(".fb-inst-menu").hide();
        if(reqChange){
            $("#fb-inst-menu"+x).toggle();
        }
    }
    function addInstToVoice(k){
        console.log(k);
        
        document.getElementById("addInstVoice"+k).outerHTML = 
        "<div class='fb-instrument'>\n\
                    <input type='text' name='inst" + i + "' placeholder='instrument "+ i +"' class='instrument'>\n\
                    <input type='number' name='num_inst" + i + "' class='num-inst'>\n\
                    <input type='hidden' name='voice_inst" + i + "' value='" + k + "'>"
                    
                + "</div>" +
                '<div id="addInstVoice' + k + '"></div>';
        i++;
        
    }
        
     $(document).click( function(){
        $(".fb-inst-menu").hide();
    });
   
    
 </script>