<?php 
include('../backend/check_if_logged_in.php');	
include '../backend/following.php';
include '../backend/instruments.php';
include 'content/disp_list_usr.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<link rel="stylesheet" type="text/css" href="../format.css">
<link rel="stylesheet" type="text/css" href="home_sty.css">
<link rel="stylesheet" type="text/css" href="content_sty.css">
<link rel="stylesheet" type="text/css" href="following_sty.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <li><a href="disp_following.php" class="active">You Follow</a></li>
            <li><a href="disp_follower.php">Follower</a></li>
        </ul>
    </div>
    
    <div class="content-element">
        <div class="content-header">
            <div class="content-title">
                <p>Your follow <?php $var = get_num_following(); echo $var; ?> users:</p> 
                
            </div> 
            <div class="content-sfield">
            <div class="content-searchform"  id="ssform">
                <form  autocomplete="off" method="get" action="disp_following_search.php?go" id="test123" > 
                <?php 
                
                include('content/autocomplete_search_following.php'); ?>
                </form> 
            </div>
        </div>
   
        </div>
        <div class="error-message">
        
        </div>
        <div class="enum-element">
            <?php
                $page = 1;
                if(isset($_GET['page'])){
                    $page = e($_GET['page']);
                }
                $offset = ($page-1) * 10;
                $res = get_my_follow($offset);
                
                display_list_users($res);   
            ?>
        </div>
        
        <div class="enum-index">
            <?php 
            
            if($page >= 2){
                echo "<a href='disp_following.php?page=".($page-1)."'>back </a>";
            }
            for($i = 3; $i > 0; $i--){
                $offset = ($page - $i-1) * 10;
                if((($offset)>= 0)) {
                    if(!empty(get_my_follow($offset))){
                        echo "<a href='disp_following.php?page=".($page-$i)."'>".($page-$i)." </a>";
                    }
                }
            }
            
            echo "<a class='act-ind' href='disp_following.php?page=".$page."'>".$page." </a> ";
            for($i = 1; $i < 4; $i++){
                $offset = ($page + $i-1) * 10;
                if(!empty(get_my_follow($offset))){
                    echo "<a href='disp_following.php?page=".($page+$i)."'>".($page+$i)." </a>";
                }
            }
            if(!empty(get_my_follow($page * 10))){
                echo "<a href='disp_following.php?page=".($page+1)."'> next</a>";
            }
            
            ?>
        </div>
    </div>
</div>
    <?php    include('content/footer.php'); ?>
</div>   
    <?php    include('content/home_gen_js.php'); ?> 
</body>
</html>

<script>
    $( function(){
       
        
        $("#sfield").autocomplete({
   
     
            source: function(req, resp){
                
                $.ajax({
                    
                    url:"../backend/json_search_within_following.php", 
                    type: "get",
                    dataType: "json",  
                    data: {
                        term: req.term
                    },
                    success: function(data){
                      resp(data);
                    }
                });
            },
            appendTo: "#ssform"
  
        });
    });
</script>