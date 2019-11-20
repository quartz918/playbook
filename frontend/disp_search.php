<?php 
include('../backend/check_if_logged_in.php');	
include '../backend/following.php';
include '../backend/instruments.php';
include_once('../backend/bands.php');
include 'content/disp_list_usr.php';
include_once('content/disp_list_bands.php');
include_once('content/gen_search_result.php');
include_once('content/search_page_num.php');
?>

<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<link rel="stylesheet" type="text/css" href="../format.css">
<link rel="stylesheet" type="text/css" href="home_sty.css">
<link rel="stylesheet" type="text/css" href="following_sty.css">
<link rel="stylesheet" type="text/css" href="bands_sty.css">
<link rel="stylesheet" type="text/css" href="instruments_sty.css">
<link rel="stylesheet" type="text/css" href="search_sty.css">
<link rel="stylesheet" type="text/css" href="content_sty.css">
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
            <li><a href="disp_bands.php">Bands</a></li>
            <li><a href="disp_following.php">You Follow</a></li>
            <li><a href="disp_follower.php">Follower</a></li>
        </ul>
    </div>
    
    
    <?php

            $num_disp_hits = 5;
            $search_term = e($_GET['search_query']);
            if(empty($_GET['filter'])){
                $filter='all';

            }
            else{
                
                $filter=e($_GET['filter']);
  
            }
            $url="disp_search.php?search_query=".$search_term."&submit=Go";
            
    ?>
    
    
    <div class="search">
        <div class="content-element">
            <div class="content-header">
                <div class="content-title">
                    <div class="content-title-menu">
                        <ul class="content-title-menu-list">
                            <li> 
                                <a <?php if($filter=='all'){echo "class='active-sub'";}?> id="all-btn" href=<?php echo $url."&filter=all";?> >All</a>      
                            </li>
                            <li >
                                <a <?php if($filter=='people'){echo "class='active-sub'";}?>  id="people-btn" href=<?php echo $url."&filter=people";?> >People</a>
                            </li>
                            <li >
                                <a <?php if($filter=='bands'){echo "class='active-sub'";}?>  id="bands-btn" href=<?php echo $url."&filter=bands";?> >Bands</a>
                            </li>
                        </ul>
                    </div>
                </div>   
            </div>
            <div class="error-message">
        
            </div>

            <div class="enum-element">
            <?php
            if($filter == 'bands'){
         
                disp_search_res_bands($num_disp_hits, $search_term, "a");  
            }
            elseif($filter == 'people'){
             
                disp_search_res_people($num_disp_hits, $search_term); 
            }
            else{
                disp_search_res_all($num_disp_hits, $search_term, "a"); 
            }
         
            ?>
            </div>
            <div class="enum-index">
            <?php  
           
            if($filter == 'bands'){
                disp_page_num_bands($num_disp_hits, $search_term, "disp_search.php", "search_for_band", $filter);
            }
            elseif($filter == 'people'){
                
                disp_page_num($num_disp_hits, $search_term, "disp_search.php", "search_for_user", $filter);
            }?>
            </div>
        </div>
        
    </div>
</div>
    <?php    include('content/footer.php'); ?>
</div>
    <?php    include('content/home_gen_js.php'); ?> 
</body>

</html>
