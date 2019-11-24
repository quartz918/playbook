<?php
session_start();

/* connect to database */
include_once('db/config.php');

/* variable declaration */
$username = "";
$email = "";
$errors = array();

/* call the register() function if reg_user is clicked */
if (isset($_POST['reg_user'])) {
  register();
}
/* login */
if (isset($_POST['login'])) {
    $forward="frontend/disp_home.php";
    if(isset($_GET['forward'])){
        $forward=e($_GET["forward"]);
    }
    $login_time = getdate();
    login($forward);
}
/* logout */ 
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    header("location: /index.php");
}


function register(){
  global $db, $errors, $username, $email;
  
  // get values from registration form and escape them
  $username = e($_POST['username']);
  $email = e($_POST['email']);
  $password_1 = e($_POST['password_1']);
  $password_2 = e($_POST['password_2']);
  
  // check if form is properly filled
  if(empty($username)){
    array_push($errors, "Username is required");
  }
  if(empty($email)){
    array_push($errors, "Email is required");
  }
  if(empty($password_1)) {
    array_push($errors, "Password is required");
  }
  if($password_1 != $password_2){
    array_push($errors, "The two passwords do not match");
  }
 // check if user already exists
 try {
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
 } catch(mysqli_sql_exception $ex){
     throw new Exception("functions.php, register: Error while checking if usrname exists" . $ex);
 }
 
 if($user){
  if($user['username'] === $username){
    array_push($errors, "Username already exists");
   }
   if($user['email'] === $email){
    array_push($errors, "email already exists");
   }
  }
  // register user if there are no errors in the form
  if (count($errors) == 0) {
    $password = password_hash($password_1, PASSWORD_BCRYPT); 
    $query = "INSERT INTO users(username, email, password)
        VALUES('$username', '$email', '$password')";
    try{  
    mysqli_query($db, $query);
    $logged_in_user_id = mysqli_insert_id($db);
    } catch(mysqli_sql_exception $ex){
         throw new Exception("functions.php, register: Error while registring user" . $ex);
    }

    $_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
    $_SESSION['success']  = "You are now logged in";
    header('location: frontend/disp_home.php');		
  }
  
}

function login($forward){
    global $db, $username, $errors, $password;
    
    // grap form values
    $username = e($_POST['username']);
    $password = e($_POST['password']);
    
    // make sure form is filled properly
    if (empty($username)) {
	array_push($errors, "Username is required");
    }
    if (empty($password)) {
	array_push($errors, "Password is required");
    }
    
    // attempt login if no errors on form
    if (count($errors) == 0) {
	
	$query = "SELECT * FROM users WHERE username='$username'";
        try{
            $results = mysqli_query($db, $query);
        } catch(mysqli_sql_exception $ex){
         throw new Exception("functions.php, login: Error while logging in user" . $ex);
        }
        if (mysqli_num_rows($results) == 1) { // user found
            $logged_in_user = mysqli_fetch_assoc($results);
            if(password_verify($password,$logged_in_user["password"])){
                $_SESSION['user'] = $logged_in_user;
                $_SESSION['success']  = "You are now logged in";
                header('location: '.$forward);
            }
            else {
                array_push($errors, "Wrong username/password combination");
            }
            
        }
        else{
            array_push($errors, "Wrong username/password combination");
        }
    }
}

function display_json_field($username, $column_name){
    global $db, $errors;
    
    $user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    
    $instruments = json_decode($user[$column_name], true);
    
    foreach($instruments as $key => $item){
        echo $item["name"] . "<a href=/musicdb/frontend/disp_home.php?delete=".$item['name']."> delete</a><br>";
    }

}

// return user array from their id
function getUserById($id){
    global $db;
    $query = "SELECT * FROM users WHERE id=" . $id;
    try{
        $result = mysqli_query($db, $query);
    }
    catch(mysqli_sql_exception $ex){
         throw new Exception("functions.php, getUserById: Error while getting user id" . $ex);
    }
    $user = mysqli_fetch_assoc($result);
    return $user;
}

function get_username_from_id($id) {
    global $db;
    if($id == null){
        return null;
    }
        else {
        $query = "SELECT username FROM users WHERE id=" . $id;
        try{
            $result = mysqli_query($db, $query);
        }
        catch(mysqli_sql_exception $ex){
             throw new Exception("functions.php, getUserById: Error while getting user id" . $ex);
        }
        $user = mysqli_fetch_assoc($result);
        return $user["username"];
    }
}


// escape string
function e($val){
    global $db;
    return mysqli_real_escape_string($db, trim($val));
}

function display_error() {
    global $errors;
    if (count($errors) > 0){
	echo '<div class="error">';
	foreach ($errors as $error){
        	echo $error .'<br>';
	}
	echo '</div>';
    }
}	
function isLoggedIn()
{
    if (isset($_SESSION['user'])) {
            return true;
    } else {
            return false;
    }
}

/**Parse location to php array: input string must have format $lat,$lon,$address
 * 
 * @param type $location
 */
function parse_location($location){
    $loc = explode("|",$location);
    if(!isset($loc[0])){
        $loc[0] = 0.;
    }
    if(!isset($loc[1])){
        $loc[1] = 0.;
    }
    if(!isset($loc[2])){
        $loc[2] = "null";
    }
    return $loc;
}
?>