<?php
echo "<link rel='stylesheet' type='text/css' href='content/disp_objects_sty.css'>";

/**
 * 
 * @param type $inst
 * @param type $opt available options: "loggedin", "loggedout", "member", "leader"
 */
function disp_instrument($inst, $opt, $voice_id){   
    echo "<div class='inst-container'>";
    echo "<div class='inst-symbol'>";
    echo "<img src='../icons/default_inst.png' alt='inst_sym' class='inst-symbol-pic'>";   
    echo "</div>";
    echo "<div class='inst-name'>";
    echo "<a href='disp_band_spec_inst.php?inst_id=".$inst->get_inst_id()."&inst_name=".$inst->get_inst_name()."'>".$inst->get_inst_name()."</a>";    
    echo "</div>";
   
    
    // sign in, join, apply ... depending on $opt
    $user_id = e($_SESSION['user']['id']); 
    switch($opt) {
        case "loggedin":
            echo "<div class='inst-join-button' id='inst-join-button".$inst->get_inst_id()."'>";            
            if($inst->get_player_id() == null){   
                if($inst->check_if_user_applied($user_id)){
                    echo "<button type='button' class='jujoin-btn' onclick='joinBand(".urldecode($inst->get_inst_id()).',"'."w".'"'.")'>Withdraw </button>";
                } else {
                    echo "<button type='button' class='jujoin-btn' onclick='joinBand(".urldecode($inst->get_inst_id()).',"'."a".'"'.")'>Apply </button>";
                }
            }
            elseif($inst->get_player_id() == $user_id){
                    echo "<button type='button' class='jujoin-btn' onclick='joinBand(".urldecode($inst->get_inst_id()).',"'."l".'"'.")'>Leave </button>";
            }
            echo "</div>";
            break;
            
        case  "loggedout":
            echo "<div class='inst-join-button' id='inst-join-button".$inst->get_inst_id()."'>";  
            echo "<button type='button' class='jujoin-btn' onclick=".'"'."window.location.href='../sign_in.php?forward='+window.location.href;".'"'.">Sign In</button>" . "<br>to join";
            echo "</div>";
            break;
        
        
        case "member":
            echo "<div class='inst-player'>";
            echo "Current player: " . $inst->get_player_name();
            echo "</div>";
            echo "<div class='inst-join-button' id='inst-join-button".$inst->get_inst_id()."'>";            
            if($inst->get_player_id() == null){   
                if($inst->check_if_user_applied($user_id)){
                    echo "<button type='button' class='jujoin-btn' onclick='joinBand(".urldecode($inst->get_inst_id()).',"'."w".'"'.")'>Withdraw </button>";
                } else {
                    echo "<button type='button' class='jujoin-btn' onclick='joinBand(".urldecode($inst->get_inst_id()).',"'."a".'"'.")'>Apply </button>";
                }
            }
            elseif($inst->get_player_id() == $user_id){
                    echo "<button type='button' class='jujoin-btn' onclick='joinBand(".urldecode($inst->get_inst_id()).',"'."l".'"'.")'>Leave </button>";
            }
            echo "</div>";
            break;
            
            
        case "leader":
            echo "<div class='inst-player'>";
            if($inst->get_player_id() != null){                
                echo "Current player: " . $inst->get_player_name();                
            }
            else{
                echo count($inst->get_applicants())." applicants";
            }
            echo "</div>";
            echo "<div class='inst-join-button' id='inst-join-button".$inst->get_inst_id()."'>";
                       
            if($inst->get_player_id() == null){                
                echo "<button type='button' class='jujoin-btn' onclick='joinBand(".urldecode($inst->get_inst_id()).',"'."j".'"'.")'>Join </button>";
            }
            elseif($inst->get_player_id() == $user_id){
                echo "<button type='button' class='jujoin-btn' onclick='joinBand(".urldecode($inst->get_inst_id()).',"'."l".'"'.")'>Leave </button>";
            }
            echo "</div>";
            break;
    }        
    echo "</div>"; ?>
    <script>
         function joinBand(inst_id,option){

          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function(){

             if (this.readyState == 4 && this.status == 200) {
                document.getElementById("inst-join-button"+inst_id).innerHTML = this.responseText;

               }
            };
            xhttp.open("GET", "jujoin.php?inst_id=" + inst_id + "&option=" + option + "&voice_id=" + <?php echo $voice_id ?>, true);
            xhttp.send();

        }
    </script> <?php
}

function add_inst_to_voice_button($voice){
    echo "<div id='new-inst-to-voice".$voice->get_voice_id()."'></div>";
    
    
    echo "<div class='inst-container'>";
    
    echo '<button class="new-inst-to-voice-btn" id="add-inst-to-voice'.$voice->get_voice_id().'" data-modal="#addInstToVoice">Add instrument to voice</button>';
   
    ?>   
    <script>
        $("#add-inst-to-voice" + <?php echo $voice->get_voice_id()?>).on("click", function() {
            
            var modal = $(this).data("modal");
            var vn = '<?php echo $voice->get_voice_name(); ?>';
            var x = <?php echo $voice->get_voice_id(); ?>;
            $("#vcID").val(x);
            $("#inst-voice-name").html(vn);
            $(modal).show();
        });
    </script>
    <?php 
    
    echo "</div>";
}
    
/**
 * 
 * @param type $inst
 * @param type $opt available options: "loggedin", "loggedout", "member", "leader"
 */
function disp_voice($voice, $opt, $filter){
    echo "<div class='voice-container'>";
    echo "<div class='voice-header'>";
    if($opt == "leader"){ 
        echo "<button class='delete' id='delete-voice".$voice->get_voice_id()."' data-modal='#deleteVoice'><i class='material-icons'>delete</i></button>";
        include('content/band/delete_voice_dialog.php');
     ?>   
        <script>
            $("#delete-voice" + <?php echo $voice->get_voice_id()?>).on("click", function() {
                var modal = $(this).data("modal");
                var x = <?php echo $voice->get_voice_id(); ?>;
                var vn = '<?php echo $voice->get_voice_name(); ?>';
                $("#vcid-delete").val(x);
                $("#instvn-delete").html(vn);
                $(modal).show();
              

            });
        </script>
    <?php } 
    echo "<div class='voice-header-name'>";
    echo "<span id='voice-name".$voice->get_voice_id()."'>".$voice->get_voice_name()."</span>"; 
    if($opt == "leader"){ 
        echo ' <button class="voice-mod-prop" id="voice-mod-name'.$voice->get_voice_id().'" data-modal="#changeVoiceName"><i class="material-icons">create</i></button>';
        include('content/band/change_voice_name_dialog.php');
    ?>   
        <script>
            $("#voice-mod-name" + <?php echo $voice->get_voice_id()?>).on("click", function() {
                var modal = $(this).data("modal");
                var x = <?php echo $voice->get_voice_id(); ?>;
                $("#voice-id").val(x);
                $(modal).show();
              

            });
        </script>
    <?php } 
    echo "</div>";
    
    if($opt == "leader" || $opt == "member"){
        echo "<div class='voice-header-leader'>";    
        echo "First chair: ".$voice->get_voice_leader_name();
        if($opt == "leader") {
            echo ' <button class="voice-mod-prop" id="voice-mod-leader'.$voice->get_voice_id().'" data-modal="#changeFirstChair"><i class="material-icons">create</i></button><br>';
            include('content/band/change_first_chair_dialog.php');
    ?>   
            <script>
                $("#voice-mod-leader" + <?php echo $voice->get_voice_id()?>).on("click", function() {
                    var modal = $(this).data("modal");
                    $(modal).show();
             

                });
            </script>
    <?php } 
        echo "</div>";
    }
    echo "</div>";
    echo "<div class='break'></div>";
    
    $open_spot_in_voice = 0;
    foreach($voice->get_instruments() as $inst){
        if($filter == "all"){
            echo "<div>";
            disp_instrument($inst,$opt, $voice->get_voice_id());
            echo "</div>";
        }
        
        elseif($filter =="open"){
            if($inst->get_player_id() == null){
                echo "<div>";
                disp_instrument($inst,$opt, $voice->get_voice_id());
                echo "</div>";
                $open_spot_in_voice = 1;
            }
        }
        
        elseif($filter == "my"){   
            if($inst->get_player_id() == $_SESSION['user']['id']){
                echo "<div>";
                disp_instrument($inst,$opt, $voice->get_voice_id());
                echo "</div>";
            }
        }
        
        elseif($filter == "applic"){   
            if($inst->check_if_user_applied($_SESSION['user']['id'])){
                echo "<div>";
                disp_instrument($inst,$opt, $voice->get_voice_id());
                echo "</div>";
            }
        }
    }
    
    // special cases
    if($filter =="open" && $open_spot_in_voice == 0){
        echo "<div>";
        echo 'No open positions in voice "'.$voice->get_voice_name().'"';
        echo "</div>";
    }
    
    if(($filter == "all" || $filter == "open") && $opt=="leader"){
        add_inst_to_voice_button($voice);    
    }
    echo "</div>";
}

function disp_band($band, $opt, $filter){
    if(empty($filter)){
        $filter = all;
    }
    
    echo "<div class='band-container'>";
    $voices = $band->get_band_voices();
    if($filter == "my"){        
        $my_voices = $band->get_my_voices();
        foreach($my_voices as $voice){
            disp_voice($voice,$opt, $filter);
        }
    }
    elseif($filter == "applic"){        
        $my_voices = $band->get_my_applied_voices();
        foreach($my_voices as $voice){
            disp_voice($voice,$opt, $filter);
        }
    }
    else {
        
            foreach($voices as $voice){
                disp_voice($voice,$opt, $filter);
                include('content/band/add_inst_to_voice_dialog.php');
            }
        }
    
    echo "</div>";
}
    