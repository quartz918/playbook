<div id="changeVoiceName" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="mod-wrapper">
                <div class="add-new-voice-title">Change voice name</div>
                <div>
                    
                         <input type="text" name="inst-name" id="name-input" placeholder="Instrument name">   
                         <input type="button" name="submit-change-instname" value="submit" onclick="changeInstName()">
                         <input type="hidden" id="voice-id" name="voice_id" value="">
                    

                </div>                
            </div>
        </div>
    </div>
</div>

<script>
    function changeVoiceName(){
        var name = document.getElementById("name-input").value;
        var voice_id = document.getElementById("voice-id").value;
        document.getElementById("voice-name"+voice_id).innerHTML = name;
        
        var url = "../backend/band/change_voice_name.php";
        var data = "voice_id=" + voice_id + "&voice_name=" + name;
        $.ajax({
            type: "GET",
            url: url,   
            data: data,
            dataType: "text",
            success: function(res){},
            error: function(error){console.log("registering failed");}
        });
        $(".modal").hide();
    };
    </script>