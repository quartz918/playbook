<?php
include_once("functions.php");
include_once ("following.php");
include_once("band_structure.php");


class band{    
    private $band_id;
    private $band_name;
    private $band_voices;
    
    private $band_leader;
    private $band_members;
    private $band_instruments;
    private $band_email;
    
    private function get_num_of_voices(){
        global $db;
        $user_check_query = "SELECT * FROM band_voices WHERE band_id=".$this->band_id;
        try {
            $result = mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
            throw new Exception("bands.php, change location" . $ex);
        }
       
        return $result->num_rows;
    }
  
    public function __construct($bndId){
        $band = get_band_from_id($bndId);
        $this->band_id = $bndId;        
        $this->band_name = $band["bandname"];
    }
    
    /* Functions to get the state of the band *
     * ************************************** *
     */
    public function get_band_name(){
        return $this->band_name;
    }
    public function get_band_id(){
        return $this->band_id;
    }
    public function get_band_voices(){
        return $this->band_voices;
    }
    
    /**
     * 
     * @global type $db
     * @global type $errors
     * @param type $instruments: PHP Array with following entry format: ["inst_name"], ["num_of_players"]
     */
    public function add_instrument($inst_name, $inst_num, $voice_id){        
        global $db;
        if($voice_id==-1){
            $this->add_voice("");
            $voice_id = $band_id = mysqli_insert_id($db);
        }
        $user_check_query = "INSERT INTO band_inst (inst_name, band_id, voice_id) VALUES ('".e($inst_name)."', '".$this->band_id."', '".$voice_id."')";
        try {
            for($i = 0; $i < $inst_num;$i++){
                mysqli_query($db, $user_check_query);
            }        
        } catch(mysqli_sql_exception $ex){
            throw new Exception("bands.php, add_instrument: Error 1 while updating instrument table" . $ex);
        }       
    }
    
    public function add_voice($voice_name){
        global $db;
        $num_voices = $this->get_num_of_voices();
        if(empty($voice_name)){
            $voice_name = "voice ".($num_voices);
        }
        $user_check_query = "INSERT INTO band_voices (band_id, voice_name) VALUES (".$this->band_id.", '".$voice_name."')";
        try {
            $result = mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
            throw new Exception("bands.php, add_voice" . $ex);
        }     
    }
    
    /**Change location of band. Assumption: location is string with $lon,$lat format
     * 
     * @global type $db
     * @param type $location
     * @throws Exception
     */
    public function change_location($location){
        global $db;
        $loc = explode("|",$location);
        $lat = floatval($loc[0]);
        $lon = floatval($loc[1]);
        $user_check_query = "UPDATE bands SET lat=".$lat.", lon=".$lon." WHERE band_id=".$this->band_id;
        try {
            $result = mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
            throw new Exception("bands.php, change location" . $ex);
        }
    }
    
    /**
     * User $user_id joins band as player of instrument with $inst_id
     * @global type $db
     * @global type $errors
     * @param type $user_id
     * @param type $inst_id
     * @throws Exception
     */
    public function join_inst($user_id, $inst_id){
        global $db;
        $user_check_query = "UPDATE band_inst SET player_id=".$user_id." WHERE band_id=".$this->band_id." AND inst_id =".$inst_id;
        try {
                $result = mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
            throw new Exception("bands.php, join_inst: " . $ex);
        }
    }
    
    
    public function accept_applicant($user_id, $inst_id){
        global $db;
        $user_check_query = "UPDATE band_inst_apply SET status = 0 WHERE inst_id =".$inst_id;
        try {
           $result = mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
            throw new Exception("bands.php, join_inst: " . $ex);
        }
        $user_check_query = "UPDATE band_inst_apply SET status = 2 WHERE inst_id =".$inst_id." AND player_id=".$user_id;
        try {
                $result = mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
            throw new Exception("bands.php, join_inst: " . $ex);
        }
    }
    /**
     * User $user_id applies for instrument $inst_id
     * @param type $user_id
     * @param type $inst_id
     */
    public function apply_inst($user_id, $inst_id){
        global $db;
        $user_check_query = "SELECT * FROM band_inst_apply WHERE inst_id =".$inst_id." AND player_id=".$user_id;
        try {
                $result = mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
            throw new Exception("bands.php, join_inst: " . $ex);
        }
        $row = mysqli_fetch_array($result);
        if(empty($row)){
            $user_check_query = "INSERT INTO band_inst_apply (inst_id, player_id, status) VALUES('".$inst_id."', '".$user_id."', 1)";
            try {
                    $result = mysqli_query($db, $user_check_query);
            } catch(mysqli_sql_exception $ex){
                throw new Exception("bands.php, join_inst: " . $ex);
            }
        }
        elseif($row['status'] != 3){
            $user_check_query = "UPDATE band_inst_apply SET status = 1 WHERE inst_id =".$inst_id." AND player_id=".$user_id;
            try {
                $result = mysqli_query($db, $user_check_query);
            } catch(mysqli_sql_exception $ex){
               throw new Exception("bands.php, get_name from id: " . $ex);
            }
        }
    }
    
    public function withdraw_inst($user_id, $inst_id){
        global $db, $errors;
        $user_check_query = "UPDATE band_inst_apply SET status = 0 WHERE inst_id =".$inst_id." AND player_id=".$user_id;
        try {
            $result = mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
           throw new Exception("bands.php, get_name from id: " . $ex);
        }
    }
    /**
     * User $user_id leaves instrument $inst_id
     * @global type $db
     * @global type $errors
     * @param type $user_id
     * @param type $inst_id
     * @throws Exception
     */
    public function leave_inst($user_id, $inst_id){
        global $db;
        $user_check_query = "UPDATE band_inst SET player_id=NULL WHERE band_id=".$this->band_id." AND inst_id =".$inst_id." AND player_id =".$user_id;
        try {
                $result = mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
            throw new Exception("bands.php, leave_inst: " . $ex);
        }
    }
    
    public function check_if_applied($user_id, $inst_id){
        global $db;
        $user_check_query = "SELECT status FROM band_inst_apply WHERE player_id=".$user_id." AND inst_id=".$inst_id;
        try {
           $result = mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
            throw new Exception("bands.php, leave_inst: " . $ex);
        }
        $row = mysqli_fetch_array($result);
           
        if((!empty($row)) && ($row['status'] ==1)){
            return True;
        }
        else{            
            return False;
        }
        
    }
    /**
     * check_if_member: check if user with user_id is member of band 
     * @global type $db
     * @global type $errors
     * @param type $user_id
     */
    public function check_if_member($user_id){
        global $db;
        $user_check_query = "SELECT * FROM band_inst WHERE band_id=".$this->band_id." AND player_id =".$user_id;       
        try {
                $result = mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
            throw new Exception("bands.php, check_if_member: Error while checking if user is member" . $ex);
        }
        $row = mysqli_fetch_array($result);           
        if(!empty($row)){
            return True;
        }
        else{           
            return False;
        }
    }
    
    public function check_if_member_inst($user_id, $inst_id){
        global $db;
        $user_check_query = "SELECT * FROM band_inst WHERE (inst_id=".$inst_id." AND band_id=".$this->band_id." AND player_id =".$user_id.")";       
        try {
                $result = mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
            throw new Exception("bands.php, check_if_member_inst: Error while checking if user is member and plays inst." . $ex);
        }
        $row = mysqli_fetch_array($result);        
        if(!empty($row)){
            return True;
        }
        else{           
            return False;
        }
    }
    
    public function check_if_inst_in_band($inst_id){
        global $db;        
        $user_check_query = "SELECT * FROM band_inst WHERE inst_id =" . $inst_id. " AND band_id = ".$this->band_id;
        try {
            $result = mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
           throw new Exception("bands.php, check if inst in band" . $ex);
        }
        $row = mysqli_fetch_array($result);
        if(empty($row)){
            return False;
        }
        else {
            return True;
        }
    }
                
                
                
    public function check_inst_null($inst_id){
        global $db;        
        $user_check_query = "SELECT * FROM band_inst WHERE inst_id =" . $inst_id. " AND band_id = ".$this->band_id;
        try {
            $result = mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
           throw new Exception("bands.php, check_if_inst_null" . $ex);
        }
        while($row = mysqli_fetch_array($result)){
            if(empty($row['player_id'])){
                return True;
            }
        }                    
        return False;
    }
    
    /** get all instruments of a band 
     * 
     * @global type $db
     * @global type $errors
     * @return array
     * @throws Exception
     */
    public function get_inst(){
        $res = array();
        global $db, $errors;
        $user_check_query = "SELECT * FROM band_inst WHERE band_id = ".$this->band_id;
        try {
            $result = mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
           throw new Exception("bands.php, check_if_member: Error while checking if user is member" . $ex);
        }
        while($row = mysqli_fetch_array($result)){
            $inst_id = $row['inst_id'];
            $inst_name = $row['inst_name'];
            $inst_part = $row['inst_part'];
            $inst_player = $row['player_id'];
            array_push($res, ["inst_id" => $inst_id, "inst" => $inst_name, "voice" => $inst_part, "player_id" => $inst_player]);
        }
        return $res;
    }
    
    /** get all open spots in a band
     * 
     * @global type $db
     * @global type $errors
     * @return array
     * @throws Exception
     */
    public function get_empty_inst(){
        
        $res = array();
        global $db, $errors;
        $user_check_query = "SELECT * FROM band_inst WHERE (player_id IS NULL) AND band_id = ".$this->band_id;
        try {
            $result = mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
           throw new Exception("bands.php, check_if_member: Error while checking if user is member" . $ex);
        }
        while($row = mysqli_fetch_array($result)){
            $inst_id = $row['inst_id'];
            $inst_name = $row['inst_name'];
            $inst_part = $row['inst_part'];
            array_push($res, ["inst_id" => $inst_id, "inst" => $inst_name, "voice" => $inst_part]);
        }
        return $res;
    }
    
    /** get instruments of user in band
     * 
     * @global type $db
     * @global type $errors
     * @param type $user_id
     * @return array
     * @throws Exception
     */
    public function get_user_inst($user_id){
        $res = array();
        global $db, $errors;
        $user_check_query = "SELECT * FROM band_inst WHERE band_id = ".$this->band_id. " AND player_id = ".$user_id;
        try {
            $result = mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
           throw new Exception("bands.php, get user inst" . $ex);
        }
        while($row = mysqli_fetch_array($result)){
            $inst_id = $row['inst_id'];
            $inst_name = $row['inst_name'];
            $inst_part = $row['inst_part'];
            array_push($res, ["inst_id" => $inst_id, "inst" => $inst_name, "voice" => $inst_part]);
        }
        return $res;
    }
    
    /**
     * Get applicants for a instrument $inst_id
     * @global type $db
     * @global type $errors
     * @param type $inst_id
     * @return array
     * @throws Exception
     */
    public function get_applicants_inst($inst_id){
        $res = array();
        global $db, $errors;
        $user_check_query = "SELECT * FROM band_inst_apply INNER JOIN users ON band_inst_apply.player_id=users.id WHERE inst_id = ".$inst_id;
        try {
            $result = mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
           throw new Exception("bands.php, get applicants_inst: " . $ex);
        }
        while($row = mysqli_fetch_array($result)){
            if($row['status']==1){
                $user_id = $row['player_id'];
                $user_name = $row['username'];
                $status = checkIfFollowing($user_id);
                array_push($res, ["user_id" => $user_id, "user_name" => $user_name, "status" => $status]);
            }
        }
        return $res;
    }
    
    /** get all applications of band
     * 
     * @global type $db
     * @global type $errors
     * @return array
     * @throws Exception
     */
    public function get_application_inst(){
        $res = array();
        global $db, $errors;
        $user_check_query = "SELECT * FROM band_inst_apply INNER JOIN users ON band_inst_apply.player_id=users.id "
                . "INNER JOIN band_inst ON band_inst_apply.inst_id=band_inst.inst_id WHERE band_inst.band_id = ".$this->band_id. " AND band_inst_apply.status = 1";
        try {
            $result = mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
           throw new Exception("bands.php, get applicants_inst: " . $ex);
        }
        while($row = mysqli_fetch_array($result)){
            if($row['status']==1){
                $user_id = $row['player_id'];
                $user_name = $row['username'];
                $inst_id = $row['inst_id'];
                $inst_name= $row['inst_name'];
                $status = checkIfFollowing($user_id);
                array_push($res, ["user_id" => $user_id, "user_name" => $user_name, "status" => $status, "inst_name" => $inst_name, "inst_id" => $inst_id]);
            }
        }
        return $res;
    }
    
    /** check if user is band leader
     * 
     * @global type $db
     * @global type $errors
     * @return int
     * @throws Exception
     */
    public function check_if_leader($user_id){
        global $db;
        
        $user_id = e($user_id);
        $user_check_query = "SELECT leader FROM bands WHERE band_id = ".$this->band_id;
        try {
            $result = mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
           throw new Exception("bands.php, check_if_leader" . $ex);
        }
        while($row = mysqli_fetch_array($result)){
            if($row['leader'] == $user_id){
                return True;
            }
        }            
        
        return False;
    }
    
    public function get_band_structure(){
        global $db;
        $this->band_voices = array();
        $user_check_query = "SELECT voice_id FROM band_voices WHERE band_id = ".$this->band_id;
        try {
            $result = mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
           throw new Exception("bands.php, check_if_leader" . $ex);
        }
        while($row = mysqli_fetch_array($result)){
            $new_voice = new voice($row["voice_id"]);
            array_push($this->band_voices, $new_voice);
        }
    }
    
    public function get_my_voices(){
        $res = array();
        $user_id = $_SESSION['user']['id'];
        foreach($this->band_voices as $voice) {
            
            foreach($voice->get_instruments() as $instrument){
                if($instrument->get_player_id() == $user_id){
                    array_push($res, $voice);
                    break;
                }
            }
        }
        return $res;
    }    
    public function get_my_applied_voices(){
        $res = array();
        $user_id = $_SESSION['user']['id'];
        foreach($this->band_voices as $voice) {
            
            foreach($voice->get_instruments() as $instrument){
                if($instrument->check_if_user_applied($user_id)){
                    array_push($res, $voice);
                    break;
                }
            }
        }
        return $res;
    }                
    
    
}


    

/**
 * 
 * @global type $db
 * @global type $errors
 * @param type $offset
 * @param type $search_query
 * @param type $num_disp
 * @param type $filter: "a" search for active bands, "i" search for inactive, else all
 * @return array
 * @throws Exception
 */
function search_for_band($offset, $search_query, $num_disp, $filter){
    
    $searchResult = array();
    $search_query = e($search_query);
    $user_check_query = "";
    global $db;
    if(isset($_GET['submit']) OR isset($_GET['search_go'])){ 
        if($filter == "a") {
            $user_check_query="SELECT * FROM bands WHERE status=1 AND bandname LIKE '%" . $search_query . "%'  LIMIT ".$offset.", ". $num_disp;     
        }
        elseif($filter == "i") {
            $user_check_query="SELECT * FROM bands WHERE status=0 AND bandname LIKE '%" . $search_query . "%'  LIMIT ".$offset.", ". $num_disp;
        }
        else {
            $user_check_query="SELECT * FROM bands WHERE bandname LIKE '%" . $search_query . "%'  LIMIT ".$offset.", ". $num_disp;
        }
        try {
                $result = mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
            throw new Exception("bands.php, search_for_band: Error 1 while searching for band" . $ex);
        }       
        while($user = mysqli_fetch_assoc($result)){
            $band_id = $user['band_id'];
            $my_band = new band($band_id);
            array_push($searchResult, $my_band);
        }     
    }
    return $searchResult;
}


/**
 * 
 * @global type $db
 * @global type $errors
 * @param type $user_id
 * @param char $filter "a" search for active bands, "i" search for inactive, else all
 * @return array
 * @throws Exception
 */

function get_user_bands($user_id, $filter){    
    $user_id = e($user_id);
    global $db;
    $user_check_query = "";
    if($filter == "a"){             // active bands
        $user_check_query="SELECT DISTINCT bands.band_id, bands.bandname FROM bands INNER JOIN band_inst ON bands.band_id=band_inst.band_id WHERE bands.status=1 AND band_inst.player_id=".$user_id;        
    }
    elseif($filter == "i"){             // inactive bands
        $user_check_query="SELECT DISTINCT bands.band_id, bands.bandname FROM bands INNER JOIN band_inst ON bands.band_id=band_inst.band_id WHERE bands.status=0 AND band_inst.player_id=".$user_id;    
    }
    else {                          // all
        $user_check_query="SELECT DISTINCT bands.band_id, bands.bandname FROM bands INNER JOIN band_inst ON bands.band_id=band_inst.band_id WHERE band_inst.player_id=".$user_id;      
    }
    try {
            $result = mysqli_query($db, $user_check_query);
    } catch(mysqli_sql_exception $ex){
        throw new Exception("bands.php, get_user_bands: Error 1 while searching for band" . $ex);
    }
    $searchResult = array();
    while($user = mysqli_fetch_assoc($result)){       
        $band_id = $user['band_id'];
        $my_band = new band($band_id);
        array_push($searchResult, $my_band);
    }
    return $searchResult;
}


function get_inst_by_id($inst_id){
    global $db;
    $user_check_query = "SELECT * FROM band_inst WHERE inst_id='$inst_id' LIMIT 10";
    try{
        $result = mysqli_query($db, $user_check_query);
    } catch(mysqli_sql_exception $ex){
            throw new Exception("instruments.php, get_my_inst:" . $ex);
    }
    $inst = mysqli_fetch_assoc($result);
    return $inst['inst_name'];
}
    
    
function get_name_from_id($bid){ 
    global $db;
    $user_check_query = "SELECT bandname FROM bands WHERE band_id =".$bid;
    try {
        $result = mysqli_query($db, $user_check_query);
    } catch(mysqli_sql_exception $ex){
       throw new Exception("bands.php, get_name from id: " . $ex);
    }
    $bnd = mysqli_fetch_assoc($result);
    return $bnd['bandname'];
}

function delete_band($bid){
    global $db;    
    $user_check_query = "UPDATE bands SET status = 0 WHERE band_id =".$bid;
    try {
        $result = mysqli_query($db, $user_check_query);
    } catch(mysqli_sql_exception $ex){
       throw new Exception("bands.php, get_name from id: " . $ex);
    }
}

function get_band_from_id($band_id){
    global $db;
    $user_check_query = "SELECT * FROM bands WHERE band_id=".$band_id;
    try {
        $result = mysqli_query($db, $user_check_query);
    } catch(mysqli_sql_exception $ex){
       throw new Exception("bands.php, get_name from id: " . $ex);
    }
    $band = mysqli_fetch_assoc($result);
    return $band;
}


function db_create_band($band_name, $instruments, $location){        
    global $db, $errors;
    if(empty($band_name)){
        array_push($errors, "Band / orchestra name is required");
    }
    if(empty($instruments)){
        array_push($errors, "Instrument list is required");
    }

    // check if band name already exists: later duplicate band names possible
    $user_check_query = "SELECT * FROM bands WHERE bandname='".$band_name."' LIMIT 1";
    try {
        $result = mysqli_query($db, $user_check_query);
    } catch(mysqli_sql_exception $ex){
        throw new Exception("bands.php, db_create_band: Error while checking if band name exists" . $ex);
    }
    $band = mysqli_fetch_assoc($result);
    if($band){
        array_push($errors, "Band / orchestra name already exists");
    }

    // create band if no previous errors
    if(count($errors) == 0){
        // load data in db
        $loc = explode("|",$location);
        $lat = floatval($loc[0]);
        $lon = floatval($loc[1]);

        $user_check_query = "INSERT INTO bands(bandname, email, status, lat, lon, leader) VALUES('".$band_name."','', 1,".$lat.", ".$lon.", ".$_SESSION['user']['id'].")";
        try {
            $result = mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
            throw new Exception("bands.php, db_create_band: Error while creating band" . $ex);
        }

        // get band id
        $band_id = mysqli_insert_id($db);

        //fill instrument table
        // create string to load instrument list to db
        $inst_str = array();
        $voice_arr = array();
        foreach($instruments as $item){
            $num_player = $item["num_player_inst"];
            if(!array_key_exists(e($item["voice_inst"]), $voice_arr)){                
                // Add new voice if it is the first instrument of the voice and safe voice_id in voice_arr
                $user_check_query = "INSERT INTO band_voices (band_id, voice_name) VALUES (".$band_id.", 'Voice ".e($item["voice_inst"])."')";
                try {
                    $result = mysqli_query($db, $user_check_query);
                } catch(mysqli_sql_exception $ex){
                    throw new Exception("bands.php, db_create_band: Error 1 while updating voice table" . $ex);
                } 
                $voice_arr[e($item["voice_inst"])] = mysqli_insert_id($db);
            }
            
            for($j=0;$j<$num_player; $j++){
                if(empty($inst_str)){
                    $inst_str =  "('" . e($item["inst_name"]) . "', " . $band_id . ", ".$voice_arr[e($item["voice_inst"])].")"; //sanitize and add to str
                }
                else{
                    $inst_str = $inst_str . ", ('" . e($item["inst_name"]) .   "', " . $band_id . ", ".$voice_arr[e($item["voice_inst"])]. ")";
                }
            }
        }        
        //update instrument table
        $user_check_query = "INSERT INTO band_inst (inst_name, band_id, voice_id) VALUES " . $inst_str;
        try {
                $result = mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
            throw new Exception("bands.php, db_create_band: Error 1 while updating instrument table" . $ex);
        }

        // Add Founder as organizer
        $user_check_query = "INSERT INTO band_inst (inst_name, band_id, player_id) VALUES ('Organizer', ".$band_id.", ".e($_SESSION['user']['id']).")";
            try {
               $result = mysqli_query($db, $user_check_query);
            } catch(mysqli_sql_exception $ex){
                throw new Exception("bands.php, db_create_band: Error 2 while updating instrument table" . $ex);
        }
    }
    else {
        foreach($errors as $item){
            echo $item."<br>";
        }
    }
}