<?php
function google_places_request($input){
    include_once('functions.php');
    
    $url = "https://maps.googleapis.com/maps/api/geocode/json";
    $query = "?address=".urlencode($input)."&key=AIzaSyDka1cdROWRuGEkyB7YgTl3vRvXwl8LFJ4";
    $res = file_get_contents($url. $query);
    $resJSON = json_decode($res,true);
    $lat=$resJSON["results"][0]["geometry"]["location"]["lat"];

    $lon=$resJSON["results"][0]["geometry"]["location"]["lng"];
    $address=$resJSON["results"][0]["formatted_address"];
    $result = $lat ."|".$lon."|".$address;
    return $result;
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

