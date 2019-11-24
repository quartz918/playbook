<?php
/* join and leave bands */
include('../backend/check_if_logged_in.php');	
include_once('../backend/functions.php');
include_once('../backend/bands.php');
if(isset($_GET['inst_id']) && isset($_GET['option'])){

    $inst_id=e($_GET['inst_id']);
    $option = e($_GET['option']);
    $user_id = e($_SESSION['user']['id']);
    include('../backend/set_band_var.php');
    if($my_band->check_if_leader($user_id)){                            // neccessary in case js gets modified by user
        if(!($my_band->check_if_member_inst($user_id,$inst_id))){
            if($option == "j"){
                $my_band->join_inst($user_id,$inst_id);        
                echo "<button type='button' class='jujoin-btn' onclick='joinBand(".$inst_id.',"'."l".'"'.")'>Leave</button>";
            }
        }
        else{
           
            if($option == "l"){
                $my_band->leave_inst($user_id,$inst_id);   
                echo "<button type='button' class='jujoin-btn' onclick='joinBand(".$inst_id.',"'."j".'"'.")'>Join</button>";
            }
        }
    }
    else {
        if(!($my_band->check_if_member_inst($user_id,$inst_id))){
            if($option == "a" && !$my_band->check_if_applied($user_id, $inst_id)){
                $my_band->apply_inst($user_id,$inst_id);        
                echo "<button type='button' class='jujoin-btn' onclick='joinBand(".$inst_id.',"'."w".'"'.")'>Withdraw</button>";
            }
            elseif($option == "w" && $my_band->check_if_applied($user_id, $inst_id)){
                $my_band->withdraw_inst($user_id, $inst_id);
                echo "<button type='button' class='jujoin-btn' onclick='joinBand(".$inst_id.',"'."a".'"'.")'>Apply</button>";
            }
        }
        else{
            $my_band->leave_inst($user_id,$inst_id);   
            echo "<button type='button' class='jujoin-btn' onclick='joinBand(".$inst_id.',"'."l".'"'.")'>Leave</button>";
        }
    }
}