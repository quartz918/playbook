<?php 
include('../backend/check_if_logged_in.php');	
 include '../backend/following.php';
include '../backend/instruments.php';
include 'content/disp_list_usr.php';
include 'content/disp_list_instruments.php';
$user_id = 0;
$user_name="";
if(isset($_GET["user_id"]) && isset($_GET["user_name"])){
    $user_id = e($_GET["user_id"]);
    $user_name = e($_GET["user_name"]);
    
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<link rel="stylesheet" type="text/css" href="../format.css">
<link rel="stylesheet" type="text/css" href="home_sty.css">
<link rel="stylesheet" type="text/css" href="content_sty.css">
<link rel="stylesheet" type="text/css" href="following_sty.css">
</head>
<body>
<div class="wrapper">

    <?php include('content/header.php');?>


<div class="content">
    <?php    include('content/cover_user.php'); ?>
    
    <div class="navbar">
        <ul class="navigation">
  
        </ul>
    </div>
    
 
        <div class="content-element">
        <div class="content-header">
            <div class="content-title">
                <?php echo $user_name; ?>
            </div>
             <div class="follow-user-title" id="follow-btn-title">
                 <?php                 
                 $follow_status = checkIfFollowing($user_id);
                 if($follow_status == 0){
                    echo "<button type='button' class='follow-btn-big' onclick='loadUFBtn(".$user_id.")'>Follow </button>";
                 }
                 else {
                     echo "<button type='button' class='follow-btn-big' onclick='loadUFBtn(".$user_id.")'>Unfollow </button>";
                 }?>
                 <script>
                function loadUFBtn(id){
                 var xhttp = new XMLHttpRequest();
                 xhttp.onreadystatechange = function(){
                    if (this.readyState == 4 && this.status == 200) {
                       document.getElementById("follow-btn-title").innerHTML = this.responseText;
                      }
                   };
                   xhttp.open("GET", "uffollow_single.php?uid=" + id, true);
                   xhttp.send();
                   }
                   </script>
                </div>
            
        </div>
        <div class="error-message">
        
        </div>
        <div class="enum-element">
            <?php
                $user_inst = get_inst_user($user_id);
                disp_instruments($user_inst, 2);
                ?>
        </div>

        
    </div>
</div>
    <?php    include('content/footer.php'); ?>
</div>  
    <?php    include('content/home_gen_js.php'); ?> 
</body>
</html>
