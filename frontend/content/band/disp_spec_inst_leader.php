<?php 


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
    <div class="content-element">
        <div class="content-header">
            <div class="content-title">
                <?php
                try{
                    $inst_name = e($_GET["inst_name"]);
                    $inst_id = e($_GET["inst_id"]);
                    echo $inst_name;
                }catch(mysqli_sql_exception $ex){
                    throw new Exception("disp_spec_inst_leader.php, : " . $ex);
                } ?>
            </div>
        </div>    
    
    <div class="enum-element">
        <?php
        include("../backend/set_band_var.php");
        if($my_band->check_if_inst_in_band($inst_id) && $my_band->check_if_leader($user_id)){
            $_SESSION["inst_id"] = $inst_id;
            include_once("content/disp_list_usr.php");
            
            $applicants = $my_band->get_applicants_inst($inst_id);
            disp_list_applicants($applicants);
        }
        else {
            echo "Error: user rights violation";
        }
        ?>
    </div>
    </div>
   
</div>
       <?php    include('content/footer.php'); ?>
</div>   
