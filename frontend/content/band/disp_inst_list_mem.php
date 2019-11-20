<?php
foreach($instruments as $item){        
    echo "<div class='enum-item'>";
    echo "<div class='enum-item-header'>";
    echo "<div class='enum-item-header-title'>";
    echo $item["inst"];
    echo "</div>";
    echo "<div class='enum-item-header-ju' id='enum-item-header-ju".$item["inst_id"]."'>";
    $user_id = e($_SESSION['user']['id']);
    if($my_band->check_inst_null($item["inst_id"])){   
        if($my_band->check_if_applied($user_id,e($item["inst_id"]))){
            echo "<button type='button' class='jujoin-btn' onclick='joinBand(".urldecode($item["inst_id"]).',"'."w".'"'.")'>Withdraw </button>";
        } else {
            echo "<button type='button' class='jujoin-btn' onclick='joinBand(".urldecode($item["inst_id"]).',"'."a".'"'.")'>Apply </button>";
        }
    }
    elseif($my_band->check_if_member_inst($user_id,e($item["inst_id"]))){

            echo "<button type='button' class='jujoin-btn' onclick='joinBand(".urldecode($item["inst_id"]).',"'."l".'"'.")'>Leave </button>";

    }
    echo "</div>";
    echo "</a><br>";
    echo "</div>";
    echo "<div class='enum-item-content'>";
    echo "Voice: ".e($item["voice"])."<br>";
    if(!empty($item["player_id"])){
        echo "Current Player: ".e(get_username_from_id($item["player_id"]))."<br>";
    }
    echo "</div>";
    echo "</div>";
}
