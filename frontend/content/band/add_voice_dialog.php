
<div id="addVoice" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="mod-wrapper">
                <div class="add-new-voice-title">Add a new voice</div>
                <form action="disp_band_inst.php?filter=<?php echo e($_GET['filter']); ?>" method="post">
                    <input type="text" name="voice-name" placeholder="Voice name">    
                    <div class='fb-voice-add'>
                        <table><tr><td valign="top">
                        <div class='fb-voice-wrapper'>            
                            <div class='fb-inst-drop'>
                                    <input type='button' name='set0' onclick='openSet(0)' value='  ' class='fb-inst-drop-btn'>
                                    <div class='fb-inst-menu' id='fb-inst-menu0'>
                                        <input type='button' name='add_inst_voice0' class='add-inst-to-voice' onclick='addInstToVoice(0)' value='add another instrument to voice'>
                                    </div>
                            </div>

                        </div></td><td>
                        <div class="fb-instrument-wrapper">    
                            <div class="fb-instrument">
                                <table><tr><td>
                                            <input type='text' name='inst0' placeholder='instrument 0' class='instrument'></td>
                                        <td>&nbsp;&nbsp;&nbsp;number: &nbsp;</td><td><input type='number' name='num_inst0' class='num-inst' min='1'></td></tr></table>
                                <input type='hidden' name='voice_inst0' value='0'>

                            </div>
                                <div id='addInstVoice0'></div></div></td></tr></table>
                        </div>
                    <input type="submit" name="submit-new-voice" value="submit">
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var i = 1;
    var k = 1;
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
                    <table><tr><td><input type='text' name='inst" + i + "' placeholder='instrument "+ i +"' class='instrument'><td>\n\
                    <td>&nbsp;&nbsp;&nbsp;number: &nbsp;</td><td><input type='number' name='num_inst" + i + "' class='num-inst' min='1'></td></tr></table>\n\
                    <input type='hidden' name='voice_inst" + i + "' value='" + k + "'>"
                    
                + "</div>" +
                '<div id="addInstVoice' + k + '"></div>';
        i++;
        
    }
        
     $(document).click( function(){
        $(".fb-inst-menu").hide();
    });
   
    
 </script>