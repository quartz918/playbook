<?php
class event {
    private $event_id;
    private $event_name;
    private $event_start;
    private $event_end;
    private $event_address;
    private $event_lat;
    private $event_lon;
    private $event_desc;
    private $event_band;
    
    public function __construct($event_id){
        
        $event_info = get_event_by_id($event_id);
        
        $data =$event_info["band_id"];
        if(!empty($data)){
            $this->event_band = $data;
        }
        $data =$event_info["title"];
        if(!empty($data)){
            $this->event_name = $data;
        }
        $data =$event_info["start_date"];
        if(!empty($data)){
            $this->event_start = $data;
        }
        $data =$event_info["end_date"];
        if(!empty($data)){
            $this->event_end = $data;
        }
        $data =$event_info["venue"];
        if(!empty($data)){
            $this->event_address = $data;
        }
        $data =$event_info["lon"];
        if(!empty($data)){
            $this->event_lon = $data;
        }
        $data =$event_info["lat"];
        if(!empty($data)){
            $this->event_lat = $data;
        }
        $data =$event_info["description"];
        if(!empty($data)){
            $this->event_desc = $data;
        }
    }
    
    public function get_name(){
        return $this->event_name;
    }
}
    /** include error checks
     * 
     * @global type $db
     * @global type $error
     * @param type $band_id
     * @param type $title
     * @param type $start_date datetime format
     * @param type $end_date datetime format
     * @param type $venue
     * @param type $lon
     * @param type $lat
     * @param type $desc
     * @throws Exception
     */
$errors = array();
function create_event($band_id, $title, $start_date, $end_date, $venue, $lon, $lat, $desc){
    global $db, $errors;
    if(empty($start_date) || empty($end_date)){
        array_push($errors, "Please set start and end of the event!");          
    }
    if($start_date > $end_date){

        array_push($errors, "The start of the event must be before the end of the event!"); 
    }
    $startdt = $start_date->format('Y-m-d H:i:s');
    $enddt = $end_date->format('Y-m-d H:i:s');
    if(count($errors) == 0){
        $value_str = "(".$band_id.", '".$title."', '".$startdt."', '".$enddt."', '".$venue."', ".$lon.", ".$lat.", '".$desc."')";
        $user_check_query = "INSERT INTO calendar (band_id, title, start_date, end_date, venue, lon, lat, description) VALUES " . $value_str;
        echo $user_check_query;
        try {
                $result = mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
            throw new Exception("calendar.php, " . $ex);
        }
    }
    else {
        foreach($errors as $item){
            echo $item."<br>";
        }

    }
}

function get_event_by_id($event_id){
    global $db;
    $user_check_query = "SELECT * FROM calendar WHERE event_id=". $event_id;
    try {
            $result = mysqli_query($db, $user_check_query);
    } catch(mysqli_sql_exception $ex){
        throw new Exception("calendar.php, " . $ex);
    }
    
    $res = mysqli_fetch_array($result);
    return $res;
}
/** get events of a specific band with $band_id
 * 
 * @return type
 * @throws Exception
 */
function get_events_of_band($band_id){
    global $db;
    $user_check_query = "SELECT * FROM calendar WHERE band_id=". $band_id;
    try {
            $result = mysqli_query($db, $user_check_query);
    } catch(mysqli_sql_exception $ex){
        throw new Exception("calendar.php, " . $ex);
    }
    $res = array();
    while($row = mysqli_fetch_array($result)){
        $row["start_date"] = date_create($row["start_date"]);
        $row["end_date"] = date_create($row["end_date"]);
        array_push($res,$row);
    }
    return $res;
}


function make_datetime($date, $time){
    return $date." ".$time;
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function check_if_attending($event_id, $user_id){
    global $db;
    $user_check_query = "SELECT status FROM event_attend WHERE event_id=". $event_id." AND user_id=".$user_id;
    try {
            $result = mysqli_query($db, $user_check_query);
    } catch(mysqli_sql_exception $ex){
        throw new Exception("calendar.php, " . $ex);
    }
    $row = mysqli_fetch_array($result);
    if(empty($row) || $row['status'] == 0){
        return false;
    }
    else {
        return true;
    }
}

function register_user($event_id, $user_id){
    global $db;
    $user_check_query = "SELECT status FROM event_attend WHERE event_id=". $event_id." AND user_id=".$user_id;
    try {
            $result = mysqli_query($db, $user_check_query);
    } catch(mysqli_sql_exception $ex){
        throw new Exception("calendar.php, " . $ex);
    }
    $row = mysqli_fetch_array($result);
    if(empty($row)){
       $user_check_query = "INSERT INTO event_attend (event_id, user_id, status) VALUES (".$event_id.", ".$user_id.", 1)";
       try {
            $result = mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
            throw new Exception("calendar.php, " . $ex);
        }
    }
    elseif($row['status'] == 0){
        $user_check_query = "UPDATE event_attend SET status = 1 WHERE event_id=". $event_id." AND user_id=".$user_id;
    
        try {
                $result = mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
            throw new Exception("calendar.php, " . $ex);
        }
    }
}

function unregister_user($event_id, $user_id){
        global $db;
        $user_check_query = "UPDATE event_attend SET status = 0 WHERE event_id=". $event_id." AND user_id=".$user_id;
    
        try {
                $result = mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
            throw new Exception("calendar.php, " . $ex);
        }
}