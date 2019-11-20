<?php
foreach($instruments as $item){        
    echo "<div class='enum-item'>";
    echo "<div class='enum-item-header'>";
    echo "<div class='enum-item-header-title'>";
    echo $item["inst"];
    echo "</div>";
    echo "<div class='enum-item-header-ju' id='enum-item-header-ju".$item["inst_id"]."'>";
    if($my_band->check_inst_null($item["inst_id"])){        
        echo "<button type='button' class='jujoin-btn' onclick=".'"'."window.location.href='../sign_in.php?forward='+window.location.href;".'"'.">Sign In</button>";
    }    
    echo "</div>";    
    echo "</a><br>";
    echo "</div>";
    echo "<div class='enum-item-content'>";
    echo "</div>";
    echo "</div>";
}

