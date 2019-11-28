<?php


    


class voice {
    private $voice_id;
    private $voice_name;
    private $instruments;
    private $leader_id;
    private $leader_name;
    
    public function __construct($voice_id){
        $this->voice_id = $voice_id;
        $this->voice_name = get_voicename_by_voiceid($voice_id);
        $this->instruments = get_instruments_by_voice($voice_id);
        $this->leader_id = get_voice_leader($voice_id);
        $this->leader_name = get_username_from_id($this->leader_id);
    }
    public function get_voice_name(){
        return $this->voice_name;
    }
    public function get_voice_id(){
        return $this->voice_id;
    }
    public function get_instruments(){
        return $this->instruments;
    }
    public function get_voice_leader_id(){
        return $this->leader_id;
    }
    public function get_voice_leader_name(){
        if(empty($this->leader_name)) {
            return "empty";
        } else {
            return $this->leader_name;
        }
    }
    public function change_voice_name($name){
        global $db;
        $this->voice_name = $name;
        $user_check_query = "UPDATE band_voices SET voice_name='".$this->voice_name."' WHERE voice_id=".$this->voice_id;
        try {
            mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
           throw new Exception("band_structure.php, get applicants " . $ex);
        }
        
    }
}


class instrument {
    private $inst_id;
    private $inst_name;
    private $player_id;
    private $player_name;
    private $applicants;
    
    public function __construct($inst_id){
        $this->inst_id = $inst_id;
        $this->inst_name = get_instname_by_instid($inst_id);
        $this->player_id = get_playerid_by_instid($inst_id);
        $this->player_name = get_username_from_id($this->player_id);
    }
    
    public function get_inst_name(){
        return $this->inst_name;
    }
    
    public function get_player_name(){
        if(!empty($this->player_name)){
            return $this->player_name;
        }
        else {
            return "empty";
        }
    }
    public function get_player_id(){
        return $this->player_id;
    }
    public function get_inst_id(){
        return $this->inst_id;
    }

    public function get_applicants(){
        $res = array();
        global $db, $errors;
        $user_check_query = "SELECT * FROM band_inst_apply INNER JOIN users ON band_inst_apply.player_id=users.id WHERE status=1 AND inst_id = ".$this->inst_id;
        try {
            $result = mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
           throw new Exception("band_structure.php, get applicants " . $ex);
        }
        while($row = mysqli_fetch_array($result)){
            if($row['status']==1){
                $user_id = $row['player_id'];
                $user_name = $row['username'];
                $status = checkIfFollowing($user_id);
                array_push($res, ["id" => $user_id, "username" => $user_name, "status" => $status]);
            }
        }
        return $res;
    }
    
    public function check_if_user_applied($user_id){
        global $db;
        $user_check_query = "SELECT status FROM band_inst_apply WHERE player_id=".$user_id." AND inst_id=".$this->inst_id;
        try {
           $result = mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
            throw new Exception("band_structure.php, check if user applied " . $ex);
        }
        $row = mysqli_fetch_array($result);
           
        if((!empty($row)) && ($row['status'] ==1)){
            return True;
        }
        else{            
            return False;
        }
    }
}



/* voice constructor functions *
 * *************************** *
 */            

/** Get the voice name from voice_id
 * 
 * @global type $db
 * @param type $voice_id
 * @return type
 * @throws Exception
 */
function get_voicename_by_voiceid($voice_id){
    global $db;
    $user_check_query = "SELECT voice_name FROM band_voices WHERE voice_id = ".$voice_id;
    try {
        $result = mysqli_query($db, $user_check_query);
    } catch(mysqli_sql_exception $ex){
       throw new Exception("bands.php, check_if_member: Error while checking if user is member" . $ex);
    }
    $row = mysqli_fetch_array($result);
    return $row['voice_name'];
}       
            
function get_instruments_by_voice($voice_id){
        $res = array();
        global $db;
        $user_check_query = "SELECT * FROM band_inst WHERE voice_id = ".$voice_id;
        try {
            $result = mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
           throw new Exception("bands.php, check_if_member: Error while checking if user is member" . $ex);
        }
        
        while($row = mysqli_fetch_array($result)){
            $inst_id = $row['inst_id'];
            $inst = new instrument($inst_id);
            array_push($res, $inst);
        }
        return $res;
}


function get_voice_leader($voice_id){
    global $db;
    $user_check_query = "SELECT voice_leader FROM band_voices WHERE voice_id = ".$voice_id;
    try {
        $result = mysqli_query($db, $user_check_query);
    } catch(mysqli_sql_exception $ex){
       throw new Exception("bands.php, check_if_member: Error while checking if user is member" . $ex);
    }
    $row = mysqli_fetch_array($result);
    if(empty($row['voice_leader'])){
        return null;
    }
    else {
        return $row['voice_leader'];
    }
}


/* instrument constructor functions *
 * ******************************** *
 */

function get_instname_by_instid($inst_id){
    global $db;
    $user_check_query = "SELECT inst_name FROM band_inst WHERE inst_id = ".$inst_id;
    try {
        $result = mysqli_query($db, $user_check_query);
    } catch(mysqli_sql_exception $ex){
       throw new Exception("bands.php, check_if_member: Error while checking if user is member" . $ex);
    }
    $row = mysqli_fetch_array($result);
    return $row['inst_name'];
}

function get_playerid_by_instid($inst_id) {
    global $db;
    $user_check_query = "SELECT player_id FROM band_inst WHERE inst_id = ".$inst_id;
    try {
        $result = mysqli_query($db, $user_check_query);
    } catch(mysqli_sql_exception $ex){
       throw new Exception("bands.php, check_if_member: Error while checking if user is member" . $ex);
    }
    $row = mysqli_fetch_array($result);
    if(empty($row['player_id'])){
        return null;
    }
    else {
        return $row['player_id'];
    }
}