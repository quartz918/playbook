<?php
include "search_within.php";
include "functions.php";

$search_query = e($_GET['term']);
$res = search_within_bands(0,$search_query);
$disp = [];

foreach($res as $item){
    $disp[] = $item["bandname"];
}
echo json_encode($disp);