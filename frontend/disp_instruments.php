<?php 
include('../backend/check_if_logged_in.php');	
include('../backend/instruments.php');
if(isset($_GET['delete'])){
    $del_instr = e($_GET['delete']);
    delete_instrument($del_instr);
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<link rel="stylesheet" type="text/css" href="../format.css">
<link rel="stylesheet" type="text/css" href="home_sty.css">
<link rel="stylesheet" type="text/css" href="instruments_sty.css">
<link rel="stylesheet" type="text/css" href="instruments_add_sty.css">
</head>
<body>
<div class="wrapper">

    <?php include('content/header.php');?>


<div class="content">
    <?php    include('content/cover.php'); ?>
    
    <div class="navbar">
        <ul class="navigation">
            <li><a href="disp_about.php">About</a></li>
            <li><a href="disp_instruments.php" class="active">Instruments</a></li>
            <li><a href="disp_bands.php">Bands</a></li>
            <li><a href="disp_following.php">You Follow</a></li>
            <li><a href="disp_follower.php">Follower</a></li>
        </ul>
    </div>
    
    <div class="content-element">
        <div class="content-header">
            <div class="content-title">
                <p>Your instruments: </p> 
            </div>
            <div class="add-instrument">
                <button class="inst-add-button" type="button" id="inst-add-btn" data-modal="#instAdd">Add an instrument</button>
                
                <?php include('content/add_inst_dialogue.php') ?>
            </div>
        </div>
        <div class="error-message">
        <?php 
        if(isset($_POST['instrument'])){
                $addInst = e($_POST['instrument']);
                $desc = e($_POST['description']);
                add_instrument($addInst,$desc); 
                
            }
            ?>
        </div>
        <div class="enum-element">
            
            <?php
            include_once('content/disp_list_instruments.php');
            $instruments = get_my_instruments();
            
            disp_instruments($instruments,1);
            ?>
      
        </div>
    </div>
</div>
       <?php    include('content/footer.php'); ?>
</div>
    
    <?php    include('content/home_gen_js.php'); ?> 
    <?php    include('content/instruments_js.php'); ?> 
</body>
</html>