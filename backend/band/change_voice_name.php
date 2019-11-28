<?php
include_once("../functions.php");
include_once("../set_band_var.php");
include_once("../bands.php");
$voice_id = e($_GET["voice_id"]);
$voice_name = e($_GET["voice_name"]);
if($my_band->check_voice_permission($voice_id, "leader")){
    $voice = new voice($voice_id);
    $voice->change_voice_name($voice_name);
}
