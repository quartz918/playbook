<?php function display_list_users($res){
    $i = 0;    // counter for the different elements
                
                
    foreach ($res as $item) {
        $userid = $item["id"];

        echo "<div class='enum-item'>";
        echo "<div class='enum-item-header'>";
        echo "<div class='enum-item-title'>";
        echo "<a href=disp_user.php?user_id=".$item["id"]."&user_name=".$item["username"].">".$item["username"]."</a>";
        echo "</div>";
        echo "<div class='fu-follow' id='fufollow".$i."'>";
        if($item["status"] == 1){
            echo "<button type='button' class='follow-btn' onclick='loadUFBtn(".$i.",".$item["id"].")'>Unfollow </button>";
        }
        else{
            echo "<button type='button' class='follow-btn' onclick='loadUFBtn(".$i.",".$item["id"].")'>Follow </button>";
        }
        echo "</div>";
        ?>
        <script>
            function loadUFBtn(x, id){
              var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function(){
                 if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("fufollow"+x).innerHTML = this.responseText;
                   }
                };
                xhttp.open("GET", "uffollow.php?uid=" + id + "&i=" + x, true);
                xhttp.send();
                }
        </script>
        <?php
        echo "</div>";
        echo "<div class='enum-item-content'>";
        echo "<div class='enum-item-usr-inf'>";
        /* shpw usr pic */
        echo "<div class='usr-pic-list'>";
        $pic = load_usr_pic($userid);
        echo '<img src="'.$pic.'" alt="user" class="usr-pic-list"  >';
        echo "</div>";
        /* show found user's list of instruments */
        echo "<div class='inst-list'>";
        $instList = get_inst_user($userid);
        echo "<ul>";
        foreach($instList as $item){
            echo "<li>".$item["inst"]."</li>";
        }
        echo "</ul>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        $i++;    
    }
}
    
function disp_list_applicants($applicants){
         $i = 0;    // counter for the different elements
                
                
    foreach ($applicants as $item) {
        $userid = $item["user_id"];

        echo "<div class='enum-item'>";
        echo "<div class='enum-item-header'>";
        echo "<div class='enum-item-title'>";
        echo "<a href=disp_user.php?user_id=".$item["id"]."&user_name=".$item["username"].">".$item["username"]."</a>";
        echo "</div>";
       
        echo "<div class='fu-follow' id='fufollow".$i."'>";
        if($item["status"] == 1){
            echo "<button type='button' class='follow-btn' onclick='loadUFBtn(".$i.",".$item["user_id"].")'>Unfollow </button>";
        }
        else{
            echo "<button type='button' class='follow-btn' onclick='loadUFBtn(".$i.",".$item["user_id"].")'>Follow </button>";
        }
        echo "</div>";
        ?>
        <script>
            function loadUFBtn(x, id){
              var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function(){
                 if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("fufollow"+x).innerHTML = this.responseText;
                   }
                };
                xhttp.open("GET", "uffollow.php?uid=" + id + "&i=" + x, true);
                xhttp.send();
            }
        </script>
        <?php
        echo "</div>";
        echo "<div class='enum-item-content'>";
        echo "<div class='enum-item-usr-inf'>";
        /* shpw usr pic */
        echo "<div class='usr-pic-list'>";
        $pic = load_usr_pic($userid);
        echo '<img src="'.$pic.'" alt="user" class="usr-pic-list"  >';
        echo "</div>";
        
        echo "<div class='player-accept' id='player-accept".$i."'>";
        echo "<button type='button' class='follow-btn' onclick='accept(".$i.",".$item["user_id"].")'>Accept </button>";
        echo "</div>";
        /* show found user's list of instruments */
        ?>
        <script>
            function accept(x, id){
              
              var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function(){
                 if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("player-accept"+x).innerHTML = this.responseText;
                    
                   }
                };
                xhttp.open("GET", "band_player_accept.php?uid=" + id + "&i=" + x, true);
                xhttp.send();
                
            }
        </script>
        <?php
        
      
        
     
   
        echo "</div>";
        echo "</div>";
        echo "</div>";
        $i++;    
    }
 }