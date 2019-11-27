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
                            <a <?php if($filter=="all"){echo "class='active-sub'";}?> href="disp_band_inst.php?filter=all" >All</a>
                        </li>
                        <li>
                            <a <?php if($filter=="open"){echo "class='active-sub'";}?> href="disp_band_inst.php?filter=open" >Open spots</a>
                        </li>       
                    </ul>
                </div>
            </div>    
        </div>
        <div class="enum-element">
            <?php
            
            include_once('content/disp_objects.php');
            include_once('../backend/functions.php');

            $filter = e($_GET['filter']);
            $my_band->get_band_structure();
            $band_struct = $my_band->get_band_voices();


            disp_band($my_band, "loggedout", $filter);
            ?>
                
            ?>
        </div>
    </div>
   
</div>
       <?php    include('content/footer.php'); ?>
</div>   