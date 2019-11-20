<?php

function disp_instruments($instruments, $disp_opt){
    foreach($instruments as $item){        
        echo "<div class='enum-item'>";
        echo "<div class='enum-item-header'>";
        echo "<div class='enum-item-header-title'>";
        echo $item["inst"];
        echo "</div>";
        
        if($disp_opt==1){                                                        // option to delete inst from user list
             echo "<a href=/musicdb/frontend/disp_instruments.php?delete=".urlencode($item["inst"])." > ";
            echo "<span type='button' class='mini-close' >&times;</span>";
        }
        elseif($disp_opt==2){                                                       // plain instrument list
            //echo "<div class='enum-item-header-ju' id='enum-item-header-ju".$item["inst_id"]."'>";
            
           
           // echo "</div>";
  
        }        
        echo "</a><br>";
        echo "</div>";
        echo "<div class='enum-item-content'>";
        echo nl2br(str_replace('\r\n', "\n", wordwrap($item["desc"], 57, "\n")));
        echo "</div>";
        echo "</div>";
     }

     ?>
    <script>
    function joinBand(inst_id){
       
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function(){
     
         if (this.readyState == 4 && this.status == 200) {
            document.getElementById("enum-item-header-ju"+inst_id).innerHTML = this.responseText;
            
           }
        };
        xhttp.open("GET", "jujoin.php?inst_id=" + inst_id, true);
        xhttp.send();
        
    }
    </script>
    <?php
}

function disp_instruments_band($instruments){
    include('../backend/set_band_var.php');
    if(isLoggedIn()){
        if($my_band->check_if_leader(e($_SESSION['user']['id']))){
            include('band/disp_inst_list_leader.php');
        }
        elseif($my_band->check_if_member(e($_SESSION['user']['id']))) {
            include('band/disp_inst_list_mem.php');
        }
        else {
            include('band/disp_inst_list_in.php');
        }
    }
    else {
        include('band/disp_inst_list_out.php');
    }   

    ?>
    
    <script>

    function joinBand(inst_id,option){
       
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function(){
     
         if (this.readyState == 4 && this.status == 200) {
            document.getElementById("enum-item-header-ju"+inst_id).innerHTML = this.responseText;
            
           }
        };
        xhttp.open("GET", "jujoin.php?inst_id=" + inst_id + "&option=" + option, true);
        xhttp.send();
        
    }
    </script>
    <?php
}

function disp_inst_band_applicants($inst_with_appl){
    include('../backend/set_band_var.php');
    if(isLoggedIn()){
        if($my_band->check_if_leader(e($_SESSION['user']['id']))){            
            foreach($inst_with_appl as $item){        
                echo "<div class='enum-item'>";
                echo "<div class='enum-item-header'>";
                echo "<div class='enum-item-header-title'>";                
                echo "<a href=disp_band_spec_inst.php?inst_name=".$item["inst_name"]."&inst_id=".$item["inst_id"].">".$item["inst_name"]."</a>";
                echo "</div>";
                echo "</div>";
                echo "<div class='enum-item-content'>";
                echo "Applicant: ".$item["user_name"];
                echo "</div>";
                echo "</div>";
            }
        }

    }
}