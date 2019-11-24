<?php
include_once("functions.php");
include_once("bands.php");
$band_cookie = e($_COOKIE["band_inf"]);

$band_id = $band_cookie;
$band_name = get_name_from_id($band_id);
$my_band = new band($band_id);
