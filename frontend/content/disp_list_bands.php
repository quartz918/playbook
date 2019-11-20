<?php 
/**
 * 
 * @param type $res array of band objects
 */
function display_list_bands($res){
    $i = 0;    // counter for the different elements
                
    
    foreach ($res as $item) {
        
        
        echo "<div class='enum-item'>";
        echo "<div class='enum-item-header'>";
        echo "<div class='enum-item-title'>";
        echo "<a id=".$item->get_band_id()." onclick='setBandCookie(this.id)' href='disp_sel_band.php'>".$item->get_band_name()."</a>";
        echo "</div>";
        
      
        echo "</div>";
        echo "<div class='enum-item-content'>";
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
      ?>
        <script>
        function setBandCookie(str){
           

            var cookie_val = "band_inf="+str+";path=/musicdb";
            document.cookie = cookie_val;

        }
        </script>
        
      
        <?php
}