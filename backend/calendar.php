<?php
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
                throw new Exception("bands.php, db_create_band: Error 1 while updating instrument table" . $ex);
            }
        }
        else {
            foreach($errors as $item){
                echo $item."<br>";
            }
            
        }
    }
    
    function get_events_of_band($band_id){
        global $db;
        $user_check_query = "SELECT * FROM calendar WHERE band_id=". $band_id;
        try {
                $result = mysqli_query($db, $user_check_query);
        } catch(mysqli_sql_exception $ex){
            throw new Exception("bands.php, db_create_band: Error 1 while updating instrument table" . $ex);
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

