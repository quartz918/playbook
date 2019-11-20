<?php

/** Follow & Unfollow user; display new follow/unfollow button */
include_once('../backend/functions.php');
include_once('../backend/following.php');
if(isset($_GET['uid']) ){
    $follow = e($_GET['uid']);


    if(checkIfFollowing($follow)==1){
       unfollow_user($follow);
       echo "<button type='button' class='follow-btn-big' onclick='loadUFBtn(".$follow.")'>Follow </button>";
    }
    else {
        follow_user($follow);
        echo "<button type='button' class='follow-btn-big' onclick='loadUFBtn(".$follow.")'>Unfollow </button>";
    }
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

