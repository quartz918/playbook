<?php

/** Follow & Unfollow user; display new follow/unfollow button */
include_once('../backend/functions.php');
include_once('../backend/following.php');
if(isset($_GET['uid']) && isset($_GET['i'])){
    $follow = e($_GET['uid']);
    $i = e($_GET['i']);

    if(checkIfFollowing($follow)==1){
       unfollow_user($follow);
       echo "<button type='button' class='follow-btn' onclick='loadUFBtn(".$i.",".$follow.")'>Follow </button>";
    }
    else {
        follow_user($follow);
        echo "<button type='button' class='follow-btn' onclick='loadUFBtn(".$i.",".$follow.")'>Unfollow </button>";
    }
}