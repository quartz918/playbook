<?php
foreach($instruments as $item){        
    echo "<div class='enum-item'>";
    echo "<div class='enum-item-header'>";
    echo "<div class='enum-item-header-title'>";
    echo "<a href=disp_band_spec_inst.php?inst_name=".$item["inst"]."&inst_id=".$item["inst_id"].">".$item["inst"]."</a>";
    echo "</div>";
    echo "<div class='enum-item-header-ju' id='enum-item-header-ju".$item["inst_id"]."'>";
    $user_id = e($_SESSION['user']['id']);
    if($my_band->check_inst_null($item["inst_id"])){                
        echo "<button type='button' class='jujoin-btn' onclick='joinBand(".urldecode($item["inst_id"]).',"'."j".'"'.")'>Join </button>";
    }
    elseif($my_band->check_if_member_inst($user_id,e($item["inst_id"]))){
        echo "<button type='button' class='jujoin-btn' onclick='joinBand(".urldecode($item["inst_id"]).',"'."l".'"'.")'>Leave </button>";
    }
    else {}
    echo "</div>";  
    echo "</a><br>";
    echo "</div>";
    echo "<div class='enum-item-content'>";
    echo "Voice: ".e($item["voice"])."<br>";
    if(!empty($item["player_id"])){
        echo "Current Player: ".e(get_username_from_id($item["player_id"]))."<br>";
    }
    echo "Applicants: ".count($my_band->get_applicants_inst($item["inst_id"]));
    echo "</div>";
    echo "</div>";
}