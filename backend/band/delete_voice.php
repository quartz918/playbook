<?php
include_once('../functions.php');
include('../check_if_logged_in.php');	
include('../set_band_var.php');

$user_id = e($_SESSION['user']['id']);
if($my_band->check_if_leader($user_id)){
    if(isset($_POST["delete-response"])){
        if(e($_POST["delete-response"]) == "yes"){
            $voice_id = e($_POST["voice_id"]);
            $my_band->delete_voice($voice_id);
        }
    }
}
header('Location: ../../frontend/disp_band_inst.php');
