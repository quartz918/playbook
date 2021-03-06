<?php

/* connect to database */
include('db/config.php');

/* variable declaration */

$errors = array();

/**
 * search for user: executed if GET['go'] exists; search query in $_Post['search_query']
 * @global type $db
 * @global array $errors
 * @return array of array with keys username, id, status (i.e. currently following if 1, else 0)
 */
function search_for_user($offset, $search_query, $max_disp){
    $searchResult = array();
    $search_query = e($search_query);
    
    global $db, $errors;
    $userid = $_SESSION['user']['id'];
    $userid = e($userid);
    if(isset($_GET['submit'])){ 
        
        $user_check_query="SELECT * FROM users WHERE (username LIKE '%" . $search_query . "%' OR email LIKE '%" . $search_query  ."%') AND NOT id = ". $userid ." LIMIT ".$offset.", ". $max_disp;
        
        try{
            $result = mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
            throw new Exception("following.php, search for user: Error while searching for user" . $ex);
        }

        while($user = mysqli_fetch_assoc($result)){
            $found_user_name = $user['username'];
            $found_user_id = $user['id'];
            $found_user_stat = checkIfFollowing($found_user_id);
            array_push($searchResult, ["username" => $found_user_name, "id"=>$found_user_id, "status" => $found_user_stat]);
        }
    }
    return $searchResult;
}

function follow_user($follow){
    global $db, $errors;
    $follow = e($follow);
    if(checkIfFollowing($follow) == 1){        
        return 1;
    }
    $userid = $_SESSION['user']['id'];
    $userid = e($userid);
    
    $user_check_query = "INSERT INTO follow (user_id,follow_id) VALUES('$userid', '$follow')";
    try {
        mysqli_query($db, $user_check_query);
    } catch(mysqli_sql_exception $ex){
        throw new Exception("following.php, follow_user: Error while trying to follow user" . $ex);
    }
    return 0; 
}

function unfollow_user($follow){
    global $db, $errors;
    $userid = $_SESSION['user']['id'];
    $userid = e($_SESSION['user']['id']);
    $follow = e($follow);
    if(checkIfFollowing($follow) == 0){        
        return 1;
    }
    $user_check_query = "DELETE FROM follow WHERE user_id='$userid' AND follow_id='$follow'";
    try {
        mysqli_query($db, $user_check_query);
    } catch(mysqli_sql_exception $ex){
        throw new Exception("following.php, unfollow_user: Error while trying to unfollow user" . $ex);
    }
    return 0;
}

/** checkIfFollowing
 * 
 * @return int 1 if user in follow list, 0 otherwise
 */
function checkIfFollowing($follow){
    global $db, $errors;
    $userid = $_SESSION['user']['id'];
    $userid = e($userid);
    $follow = e($follow);
    $user_check_query = "SELECT * FROM follow WHERE user_id='$userid' AND follow_id='$follow'  LIMIT 1";
    try {
        $result = mysqli_query($db, $user_check_query);
    } catch(mysqli_sql_exception $ex){
        throw new Exception("following.php, checkIfFollowing: Error while checking if following" . $ex);
    }
    if(mysqli_num_rows($result) == 0){ 
        return 0;
    }
    else {
        return 1;
    }
   
}


function get_my_follow($offset){
    global $db, $errors;
    $userid = $_SESSION['user']['id'];
    $userid = e($userid);
    $user_check_query = "SELECT users.username, users.id FROM follow INNER JOIN users ON follow.follow_id = users.id WHERE follow.user_id =".$userid." LIMIT ". $offset .", 10;";
    try {
        $result = mysqli_query($db, $user_check_query);
    } catch(mysqli_sql_exception $ex){
        throw new Exception("following.php, get_my_follow: Error while getting user who follow" . $ex);
    }

    $follow = array();
    while($row = mysqli_fetch_array($result)){
        $found_user_id  = $row["id"];
        $found_user_name = $row['username'];
        $found_user_stat = 1;       
        array_push($follow, ["username" => $found_user_name, "id"=>$found_user_id, "status" => $found_user_stat]);
    }
 
    return $follow;

}

function get_my_follower($offset){
    global $db, $errors;
    $userid = $_SESSION['user']['id'];
    $userid = e($userid);
    $user_check_query = "SELECT users.username, users.id FROM follow INNER JOIN users ON follow.user_id = users.id WHERE follow.follow_id =".$userid." LIMIT ". $offset .", 10;";
    try {
        $result = mysqli_query($db, $user_check_query);
    } catch(mysqli_sql_exception $ex){
         throw new Exception("following.php, get_my_follower: Error while getting follower" . $ex);
    }
    $follow = array();
    while($row = mysqli_fetch_array($result)){
        $found_user_id  = $row["id"];
        $found_user_name = $row['username'];
        $found_user_stat = checkIfFollowing($found_user_id);      
        array_push($follow, ["username" => $found_user_name, "id"=>$found_user_id, "status" => $found_user_stat]);
    
    }
     
    return $follow;
}

function get_num_follower(){
    global $db, $errors;
    $userid = $_SESSION['user']['id'];
    $userid = e($userid);
    $max= 1000;
    $user_check_query = "SELECT * FROM follow WHERE follow_id='$userid' LIMIT ".$max;
    try{
        $result = mysqli_query($db, $user_check_query);
    }
    catch(mysqli_sql_exception $ex){
         throw new Exception("following.php, get_num_follower: Error while getting num of follower" . $ex);
    }
      
    if( mysqli_num_rows($result) == $max){
        return $max;
    }
    else {
        return mysqli_num_rows($result);
    }
    
}

function get_num_following(){
    global $db, $errors;
    $userid = $_SESSION['user']['id'];
    $userid = e($userid);
    $max= 1000;
    $user_check_query = "SELECT * FROM follow WHERE user_id='$userid' LIMIT ".$max;
    try {
        $result = mysqli_query($db, $user_check_query);
    } catch(mysqli_sql_exception $ex){
         throw new Exception("following.php, get_num_following: Error while getting people who follow" . $ex);
    }
  
    if( mysqli_num_rows($result) == $max){
        return $max;
    }
    else {
        return mysqli_num_rows($result);
         
    }
}

function get_num_search($search_query){
    global $db, $errors;
    $userid = $_SESSION['user']['id'];
    $userid = e($userid);
    $search_query = e($search_query);
    $max= 1000;
    
    $user_check_query = "SELECT * FROM users WHERE username LIKE '%" . $search_query . "%' OR email LIKE '%" . $search_query  ."%' LIMIT ".$max;;
    try {
        $result = mysqli_query($db, $user_check_query);
    } catch(mysqli_sql_exception $ex){
         throw new Exception("following.php, get_num_search: Error while getting number of search hits" . $ex);
    }
    
    if( mysqli_num_rows($result) == $max){
        return $max;
    }
    else {
        return mysqli_num_rows($result);
    }
    
}