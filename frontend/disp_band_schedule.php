<?php include_once('../backend/functions.php');
include('../backend/check_if_logged_in.php');	
include('../backend/set_band_var.php');
include_once('content/disp_list_instruments.php');
include_once('../backend/calendar.php');
include_once('../backend/google_places_request.php');
if(isset($_POST["createEvent"])){
    $title = "";
    if(isset($_POST["title"])){
        $title = e($_POST["title"]);
    }
    $desc = "";
    if(isset($_POST["description"])){
        $desc = e($_POST["description"]);
    }
    $lat = 0;
    $lon = 0;
    $venue = "";
    if(!empty($_POST["location"])){
        $location = parse_location(e($_POST["location"]));
        $lat = $location[0];
        $lon = $location[1];
        $venue = $location[2];
    }
    elseif(!empty($_POST["search-location"])){
        $location = google_places_request(e($_POST["search-location"]));
        $location = parse_location($location);
        $lat = $location[0];
        $lon = $location[1];
        $venue = $location[2];
     
    }

    if(isset($_POST["startdate"]) && isset($_POST["enddate"])){
        $startdate = e($_POST["startdate"]);
        $enddate = e($_POST["enddate"]);
        
        if(isset($_POST["starttime"])){
            $startdate = make_datetime($startdate, e($_POST["starttime"]));            
        }
        if(isset($_POST["endtime"])){
            $enddate = make_datetime($enddate, e($_POST["endtime"]));   
        }
        $startdate = date_create($startdate);
        $enddate = date_create($enddate);
        
        create_event($my_band->get_band_id(), $title, $startdate, $enddate, $venue, $lon, $lat, $desc);
    }    
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<link rel="stylesheet" type="text/css" href="../format.css">
<link rel="stylesheet" type="text/css" href="home_sty.css">
<link rel="stylesheet" type="text/css" href="bands_sty.css">
<link rel="stylesheet" type="text/css" href="schedule_sty.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
 <?php    
 if(isLoggedIn()){
     $user_id = e($_SESSION['user']['id']);
     if($my_band->check_if_leader($user_id)){

         include('content/band/disp_sched_leader.php');
         
     }
     elseif($my_band->check_if_member($user_id)){

         include('content/band/disp_sched_mem.php');
     }
     else {

          include('content/band/disp_sched_in.php');
     }
 }
 else {

     include('content/band/disp_sched_out.php');
 }
 
 
           include('content/home_gen_js.php'); ?> 
</body>
</html>