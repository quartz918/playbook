<?php 
/**
 * 
 * @param ty
 */
function display_list_events($res){
    $i = 0;    // counter for the different elements
                
    function cmp($a, $b)
    {
        if ($a["start_date"] == $b["start_date"]) {
            return 0;
        }
        return ($a["start_date"] < $b["start_date"]) ? -1 : 1;
    }

    usort($res,"cmp");
    foreach ($res as $item) {
        $event_id = $item["event_id"];
        $event_title = $item["title"];
        $event_start = $item["start_date"];
        $event_end = $item["end_date"];
        echo "<div class='enum-item'>";
        echo "<div class='enum-item-header'>";
        echo "<div class='enum-item-title'>";
        echo "<a id=".$event_id." onclick='setBandCookie(this.id)' href='disp_sel_band.php'>".$event_title."</a>";
        echo "</div>";
        
      
        echo "</div>";
        echo "<div class='enum-item-content'>";
        echo "start: ".date_format($event_start, 'Y-m-d H:i:s')."<br>";
        echo "end: ".date_format($event_end, 'Y-m-d H:i:s');
        echo "<div class='enum-item-usr-inf'>";
        /* shpw usr pic */
        echo "<div class='usr-pic-list'>";
        // $pic = load_band_pic($band_id);
        //echo '<img src="'.$pic.'" alt="user" class="usr-pic-list"  >';
        echo "</div>";
        /* show found user's list of instruments */
      
        echo "</div>";
        echo "</div>";
        echo "</div>";
        $i++;    
    }
}