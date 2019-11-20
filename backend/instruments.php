<?php

/* connect to database */
include_once('db/config.php');

/* variable declaration */

$errors = array();



/* add an instrument for logged in user
 * assumption: in sql database exists column instrument with default value [] */

function add_instrument($addInst, $desc){
    global $db, $errors;
    $addInst = e($addInst);
    $desc = e($desc);
    if(strlen($addInst)==0){                            // Instrument name has to contain at least 1 character
        error_message("Please choose a valid instrument name");
        return 5;
    }
    $userid = $_SESSION['user']['id'];
    $user_check_query = "SELECT instruments FROM instruments WHERE id='$userid' LIMIT 10";
    try{
        $result = mysqli_query($db, $user_check_query);
    }catch(mysqli_sql_exception $ex){
            throw new Exception("instruments.php, get_my_inst:" . $ex);
    }
   
    $rows = [];


    while($row = mysqli_fetch_array($result))
    {
        $rows[] = strtolower($row["instruments"]);
    }

    if(count($rows) >= 6){                                  // maximum of 6 instruments
        error_message("You can only choose six instruments");
        return 1;
    }
    if(in_array(strtolower($addInst), $rows)){              // no double instruments
        error_message("This instrument is already in your instrument list");
        return 2;
    }
    else{

        $user_check_query = "INSERT INTO instruments (id,instruments, description) VALUES('$userid', '$addInst', '$desc')";
        try {
            mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
                throw new Exception("instruments.php, get_my_inst:" . $ex);
        }

    }
    return 0;
    
  
}


function delete_instrument($del_instr){
    global $db, $errors;
    $userid = $_SESSION['user']['id'];
    $del_instr = e($del_instr);         // sanitize
    $user_check_query = "SELECT * FROM instruments WHERE id='$userid' AND instruments='$del_instr'  LIMIT 1";
    try{
        $result = mysqli_query($db, $user_check_query);
    }catch(mysqli_sql_exception $ex){
            throw new Exception("instruments.php, get_my_inst:" . $ex);
    }
    
  
        if(mysqli_num_rows($result) > 0){
            $user_check_query = "DELETE FROM instruments WHERE id='$userid' AND instruments='$del_instr'";
            if(!mysqli_query($db, $user_check_query)){
                 echo "In instruments.php, function delete_instrument: SQL ERROR";
                 return 1;
            }
        }

}

function get_inst_user($i){
    global $db, $errors;
    $userid = e($i);
    $user_check_query = "SELECT * FROM instruments WHERE id='$userid' LIMIT 10";
    try{
        $result = mysqli_query($db, $user_check_query);
    }catch(mysqli_sql_exception $ex){
            throw new Exception("instruments.php, get_my_inst:" . $ex);
    }
    
     
    $rows = [];
    $element = [];
    while($row = mysqli_fetch_array($result))
    {
        $element["inst"] = $row["instruments"];
        $element["desc"] = $row["description"];
        $rows[]=$element;
    }
    return $rows;

}

/**
 * get list of instruments of user
 * @global type $db
 * @global array $errors
 * @return array of instruments with instances inst and desc
 */
function get_my_instruments(){
    global $db, $errors;
    $userid = $_SESSION['user']['id'];
    $userid = e($userid);
    $user_check_query = "SELECT * FROM instruments WHERE id='$userid' LIMIT 10";
    try{
        $result = mysqli_query($db, $user_check_query);
    }catch(mysqli_sql_exception $ex){
            throw new Exception("instruments.php, get_my_inst:" . $ex);
    }

    $rows = [];
    $element = [];
    while($row = mysqli_fetch_array($result))
    {
        $element["inst"] = $row["instruments"];
        $element["desc"] = $row["description"];
        $rows[]=$element;
    }
    return $rows;
    
}


include('error_message.php');