<?php
include_once('../calendar.php');
include_once('../functions.php');

$user_id = $_SESSION['user']['id'];
$event_id = e($_GET['event_id']);
error_log($user_id.", ".$event_id);
register_user($event_id, $user_id);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

