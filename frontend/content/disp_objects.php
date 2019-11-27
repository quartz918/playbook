<?php
echo "<link rel='stylesheet' type='text/css' href='content/disp_objects_sty.css'>";

/**
 * 
 * @param type $inst
 * @param type $opt available options: "loggedin", "loggedout", "member", "leader"
 */
function disp_instrument($inst, $opt){   
    echo "<div class='inst-container'>";
    echo "<div class='inst-symbol'>";
    echo "<img src='../icons/default_inst.png' alt='inst_sym' class='inst-symbol-pic'>";   
    echo "</div>";
    echo "<div class='inst-name'>";
    echo $inst->get_inst_name();    
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
            xhttp.open("GET", "jujoin.php?inst_id=" + inst_id + "&option=" + option, true);
            xhttp.send();

        }
    </script> <?php
}

function add_inst_to_voice_button(){
    echo "<div id='new-inst-to-voice'></div>";
    
    
    echo "<div class='inst-container'>";
    
    echo '<button class="new-inst-to-voice-btn">Add instrument to voice</button>';
    
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
    echo "<div class='voice-header-name'>";
    echo $voice->get_voice_name().' <button class="voice-mod-prop" id="voice-mod-name'.$voice->get_voice_id().'"><i class="material-icons">create</i></button><br>';
    echo "</div>";
    
    if($opt == "leader" || $opt == "member"){
        echo "<div class='voice-header-leader'>";    
        echo "First chair: ".$voice->get_voice_leader_name().' <button class="voice-mod-prop" id="voice-mod-leader'.$voice->get_voice_id().'"><i class="material-icons">create</i></button><br>';
        echo "</div>";
    }
    echo "</div>";
    echo "<div class='break'></div>";
    
    $open_spot_in_voice = 0;
    foreach($voice->get_instruments() as $inst){
        if($filter == "all"){
            echo "<div>";
            disp_instrument($inst,$opt);
            echo "</div>";
        }
        
        elseif($filter =="open"){
            if($inst->get_player_id() == null){
                echo "<div>";
                disp_instrument($inst,$opt);
                echo "</div>";
                $open_spot_in_voice = 1;
            }
        }
        
        elseif($filter == "my"){   
            if($inst->get_player_id() == $_SESSION['user']['id']){
                echo "<div>";
                disp_instrument($inst,$opt);
                echo "</div>";
            }
        }
        
        elseif($filter == "applic"){   
            if($inst->check_if_user_applied($_SESSION['user']['id'])){
                echo "<div>";
                disp_instrument($inst,$opt);
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
        add_inst_to_voice_button();    
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
        if(empty($voices)){
            echo '<form action="disp_sel_band.php?addInstrument=true" method="post">';
            echo "<div class='add-inst-to-band-form'>";
            echo "<input type='text' name='inst' placeholder='instrument' class='instrument'>";
            echo "<input type='number' name='num_inst' class='num-inst'>";
            echo '<input type="submit" name="fButton" class="found-band-btn" value="Add Instrument" id="fBandBtn">';
            echo '</div>';
            echo '</form> ';
        }
        else {
            foreach($voices as $voice){
                disp_voice($voice,$opt, $filter);
            }
        }
    }
    echo "</div>";
}
    