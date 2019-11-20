<?php   
function search_within_follower($offset, $search_query){
    include_once("following.php");
    $searchResult = array();
    $search_query = e($search_query);
    
    global $db, $errors;
    $userid = $_SESSION['user']['id'];
    $userid = e($userid);
    if(isset($search_query)){ 
        
        $user_check_query="SELECT users.username, users.id FROM follow INNER JOIN users ON follow.id = users.id WHERE users.username LIKE '%" . $search_query . "%' OR users.email LIKE '%" . $search_query  ."%' LIMIT ".$offset.", 10";
        $result = mysqli_query($db, $user_check_query);

        if($result){
            while($user = mysqli_fetch_assoc($result)){
                if(!($user['id'] == $userid)){      // dont include yourself in search
                    $found_user_name = $user['username'];
                    $found_user_id = $user['id'];
                    $found_user_stat = checkIfFollowing($found_user_id);
                    array_push($searchResult, ["username" => $found_user_name, "id"=>$found_user_id, "status" => $found_user_stat]);

                }
            }
        }
        else {
            echo "error 1 in following.php, function search_for_user, MYSQL Error";
        } 
    }
    return $searchResult;
}

function get_num_search_follower($search_query){
    global $db, $errors;
    $userid = $_SESSION['user']['id'];
    $userid = e($userid);
    $search_query = e($search_query);
    $max= 1000;
    $user_check_query = "SELECT users.username, users.id FROM follow INNER JOIN users ON follow.id = users.id WHERE users.username LIKE '%" . $search_query . "%' OR users.email LIKE '%" . $search_query  ."%' LIMIT ".$max;;
    $result = mysqli_query($db, $user_check_query);
    if($result){     
         if( mysqli_num_rows($result) == $max){
             return $max;
         }
         else {
             return mysqli_num_rows($result);
         }
    }
}

function search_within_following($offset,$search_query){
    include_once('following.php');
    $searchResult = array();
    $search_query = e($search_query);

    global $db, $errors;
    $userid = $_SESSION['user']['id'];
    $userid = e($userid);
    if(isset($search_query)){ 

        $user_check_query="SELECT users.username, users.id FROM follow INNER JOIN users ON follow.follow_id = users.id WHERE users.username LIKE '%" . $search_query . "%' OR users.email LIKE '%" . $search_query  ."%' LIMIT ".$offset.", 10";
        $result = mysqli_query($db, $user_check_query);

        if($result){
            while($user = mysqli_fetch_assoc($result)){
                if(!($user['id'] == $userid)){      // dont include yourself in search
                    $found_user_name = $user['username'];
                    $found_user_id = $user['id'];
                    $found_user_stat = checkIfFollowing($found_user_id);
                    array_push($searchResult, ["username" => $found_user_name, "id"=>$found_user_id, "status" => $found_user_stat]);

                }
            }
        }
        else {
            echo "error 1 in following.php, function search_for_user, MYSQL Error";
        } 
    }


return $searchResult;
}

function get_num_search_following($search_query){
    global $db, $errors;
    $userid = $_SESSION['user']['id'];
    $userid = e($userid);
    $search_query = e($search_query);
    $max= 1000;
    $user_check_query = "SELECT users.username, users.id FROM follow INNER JOIN users ON follow.follow_id = users.id WHERE users.username LIKE '%" . $search_query . "%' OR users.email LIKE '%" . $search_query  ."%' LIMIT ".$max;
    $result = mysqli_query($db, $user_check_query);
    if($result){     
         if( mysqli_num_rows($result) == $max){
             return $max;
         }
         else {
             return mysqli_num_rows($result);
         }
    }
}