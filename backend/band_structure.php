<?php

function get_voices_by_bandid($band_id){
}

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
}


class instrument {
    private $inst_id;
    private $inst_name;
    private $player_id;
    private $player_name;
    
    public function __construct($inst_id){
        $this->inst_id = $inst_id;
        $this->inst_name = get_instname_by_instid($inst_id);
        $this->player_id = get_playerid_by_instid($inst_id);
        $this->player_name = get_username_from_id($this->player_id);
    }
}



/* voice constructor functions *
 * *************************** *
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