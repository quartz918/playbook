<?php
include_once('../../backend/functions.php');
include_once('../../backend/bands.php');
include_once('../../backend/set_band_var.php');
$inst_id = $_SESSION["inst_id"];
$user_id = e($_GET["uid"]);
echo "test";
if($my_band->check_if_applied($user_id, $inst_id)){
    echo "test";
    $my_band->join_inst($user_id, $inst_id);
    $my_band->accept_applicant($user_id, $inst_id);
    $inst_name = get_inst_by_id($inst_id);
    header('musicdb/frontend/disp_band_spec_inst.php?inst_name='.$inst_name.'&inst_id='.$inst_id);
}

