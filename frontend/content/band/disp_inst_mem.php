<?php 
include_once("../../../backend/functions.php");

?>
<div class="wrapper">
    <?php include('content/header.php');?>

<div class="content">
    <?php    include('content/cover_band.php'); ?>
    
    <div class="navbar">
        <ul class="navigation">
            <li><a href="disp_sel_band.php" >About</a></li>
            <li><a href="disp_band_inst.php?filter=1" class="active">Instruments</a></li>
             <li><a href="disp_band_schedule.php" >Schedule</a></li>
        </ul>
    </div>
    <?php
     if(isset($_GET['filter'])) {
            $filter =e($_GET['filter']);
        }
        else {
            $filter =1;                     // default
        }
        ?>
    <div class="content-element">
        <div class="content-header">
            <div class="content-title">
                 <div class="content-title-menu">
                    <ul class="content-title-menu-list">
                        <li>
                            <a <?php if($filter==1){echo "class='active-sub'";}?> href="disp_band_inst.php?filter=1" >All</a>
                        </li>
                        <li>
                            <a <?php if($filter==2){echo "class='active-sub'";}?> href="disp_band_inst.php?filter=2" >Open spots</a>
                        </li>
                        <li>
                            <a <?php if($filter==3){echo "class='active-sub'";}?> href="disp_band_inst.php?filter=3">My instruments</a>
                        </li>
                    </ul>
                </div>
            </div>    
        </div>
        <div class="enum-element">
            <?php
            
                if(isset($_GET['filter'])) {
                    $filter =e($_GET['filter']);
                }
                else {
                    $filter =1;                     // default
                }
                
                if($filter == 1){                   // display all
                    $inst = $my_band->get_inst();
                     disp_instruments_band($inst);
                }
                elseif($filter ==2 ){               //display open spots
                    $inst = $my_band->get_empty_inst();
                    disp_instruments_band($inst);
                }
                elseif($filter== 3){                // display user instruments
                    $user_id = $_SESSION['user']['id'];
                    $inst = $my_band->get_user_inst($user_id);
                    disp_instruments_band($inst);
                }
            ?>
        </div>
    </div>
   
</div>
       <?php    include('content/footer.php'); ?>
</div>   
