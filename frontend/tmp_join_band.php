<?php
include_once('../backend/bands.php');
include_once('content/disp_list_instruments.php');
?>
<html><head><link rel="stylesheet" type="text/css" href="../format.css">
<link rel="stylesheet" type="text/css" href="home_sty.css">
<link rel="stylesheet" type="text/css" href="bands_sty.css">
<link rel="stylesheet" type="text/css" href="instruments_sty.css"></head>
    <body>
        <?php

$band_id = e($_GET['band_id']);
$band_name = get_name_from_id($band_id);
$myband = new band($band_name,$band_id);

$inst_list = $myband->get_empty_inst();

disp_instruments($inst_list,2);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
    </body>
</html>