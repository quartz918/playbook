<?php
include_once('functions.php');
$input = e($_GET["input"]);
$url = "https://maps.googleapis.com/maps/api/geocode/json";
$query = "?address=".urlencode($input)."&key=AIzaSyDka1cdROWRuGEkyB7YgTl3vRvXwl8LFJ4";
$res = file_get_contents($url. $query);
$resJSON = json_decode($res,true);
$lat=$resJSON["results"][0]["geometry"]["location"]["lat"];

$lon=$resJSON["results"][0]["geometry"]["location"]["lng"];
$address=$resJSON["results"][0]["formatted_address"];
echo "<input type='button' id='loc1' onclick='chooseLocation(".$lat.", ". $lon.", ".'"'.$address.'"'.")' value='".$address."'>" . $address . "<br>";

