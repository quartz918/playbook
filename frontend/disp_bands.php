<?php 
include('../backend/check_if_logged_in.php');	
include_once('../backend/bands.php');
include_once('content/disp_list_bands.php');
include_once('../backend/google_places_request.php');

?>

<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<link rel="stylesheet" type="text/css" href="../format.css">
<link rel="stylesheet" type="text/css" href="home_sty.css">
<link rel="stylesheet" type="text/css" href="bands_sty.css">
<link rel="stylesheet" type="text/css" href="found_band_sty.css">
</head>
<body>
<div class="wrapper">
    <?php include('content/header.php');?>


<div class="content">
    <?php    include('content/cover.php'); ?>
    
    <div class="navbar">
        <ul class="navigation">
            <li><a href="disp_about.php">About</a></li>
            <li><a href="disp_instruments.php" >Instruments</a></li>
            <li><a href="disp_bands.php" class="active">Bands</a></li>
            <li><a href="disp_following.php">You Follow</a></li>
            <li><a href="disp_follower.php">Follower</a></li>
        </ul>
    </div>
    
    <div class="content-element">
        <div class="content-band-header">
            <div class="content-title">
                <p>Your are in <?php 
                
                $user_id = e($_SESSION['user']['id']);
                $my_bands = get_user_bands($user_id, "a");
                echo count($my_bands); ?> bands / orchestras:</p> 
            </div> 
            <div class="content-band-header-right">
                 
                <div></div>
                <div class="band-found">
                    <button class="content-title-button" type="button" id="band-found-button" data-modal="#bandFound">Found a band</button>
                    <?php include('content/found_band_dialogue.php') ?>

                </div>
            </div>
               
        </div>
        
        <div class="error-message">
          
        <?php
        
        if(isset($_POST["fButton"])){                           // found band routine
            $bandname = e($_POST["bandName"]);
            $instruments = array();
            if(!isset($_POST["inst0"])){
                echo "Error: Please choose at least 1 instrument for your band.";
            }
            elseif(!isset($_POST["location"])){
                echo "Error: Please provide the location of the band.";
            }
            else{
                $i=0;
                $instArray = array();
                $instStr = "inst".$i;
                $num_play_str = "num_inst".$i;
               
                while(!empty($_POST[$instStr])){
                   
                    $item = array("inst_name" => e($_POST[$instStr]), "num_player_inst"=> e($_POST[$num_play_str]));
                    array_push($instArray, $item);
                    $i++;
                    $instStr = "inst".$i;
                    $num_play_str = "num_inst".$i;
                }
                $fBand = new band($bandname,0);
                
                $location="";
                if(!empty($_POST["location"])){
                    $location = e($_POST["location"]);
     
                }
                elseif(!empty($_POST["search-location"])){
                    $location = google_places_request(e($_POST["search-location"]));
                    
                }
        
                $fBand->db_create_band($instArray, $location);
            }
        }
        
        if(isset($_POST["dButton"])){
          
            if(e($_POST["dButton"])== "Yes"){
                $bid = e($_GET["band_id"]);
                delete_band($bid);
            }
        }
        ?>
        </div>
        <div class="enum-element">
            <?php
            
            
            display_list_bands($my_bands);
   
            ?>
        </div>
        <div class="enum-index">
            <?php 
            /*
            if($page >= 2){
                echo "<a href='disp_bands.php?page=".($page-1)."'>back </a>";
            }
            for($i = 3; $i > 0; $i--){
                $offset = ($page - $i-1) * 10;
                if((($offset)>= 0)) {
                    if(!empty(get_my_bands($offset))){
                        echo "<a href='disp_bands.php?page=".($page-$i)."'>".($page-$i)." </a>";
                    }
                }
            }
            
            echo "<a class='act-ind' href='disp_bands.php?page=".$page."'>".$page." </a> ";
            for($i = 1; $i < 4; $i++){
                $offset = ($page + $i-1) * 10;
                if(!empty(get_my_bands($offset))){
                    echo "<a href='disp_bands.php?page=".($page+$i)."'>".($page+$i)." </a>";
                }
            }
            if(!empty(get_my_bands($page * 10))){
                echo "<a href='disp_bands.php?page=".($page+1)."'> next</a>";
            }
            
            */?>
        </div>
    </div>
</div>
        <?php    include('content/footer.php'); ?>
</div>   
    
</body><?php    include('content/home_gen_js.php'); ?> 


</html>
