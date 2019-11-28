<?php 
if(isset($_POST["submit-new-voice"])){
    
    $voice_name = e($_POST["voice-name"]);
    $voice_id = $my_band->add_voice($voice_name);
    
    $i=0;
    $instArray = array();
    $instStr = "inst".$i;
    $num_play_str = "num_inst".$i;


    while(!empty($_POST[$instStr])){                   
        $inst_name = e($_POST[$instStr]);
        $inst_num = e($_POST[$num_play_str]);
               
        $my_band->add_instrument($inst_name, $inst_num, $voice_id);
        
        $i++;
        $instStr = "inst".$i;
        $num_play_str = "num_inst".$i;
    }
}
if(isset($_POST["submit-add-inst"])){
    $voice_id = e($_POST["voice_id"]);
    echo $voice_id;
    $inst_name =e($_POST["inst-name"]);
    
        $my_band->add_instrument($inst_name, 1, $voice_id);
    
}



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
    <?php  if(isset($_GET['filter'])) {
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
                        <li>
                            <a <?php if($filter=="my"){echo "class='active-sub'";}?> href="disp_band_inst.php?filter=my">My instruments</a>
                        </li>
                        <li>
                            <a <?php if($filter=="applic"){echo "class='active-sub'";}?> href="disp_band_inst.php?filter=applic">Applications</a>
                        </li>
                    </ul>
                </div>
            </div>    
        </div>
        <div class="enum-element">
            <?php 
            if($filter == "all" || $filter == "open"){
                echo '<button class="add-voice-button" type="button" id="add-voice-button" data-modal="#addVoice" >Add a voice</button>';
                include('content/band/add_voice_dialog.php');
             ?>
            
                <script>
                    $("#add-voice-button").on("click", function() {
                        var modal = $(this).data("modal");
                        $(modal).show();
                        console.log("test");
                    });
                </script>
            <?php } 
            
            
                include_once('content/disp_objects.php');
                include_once('../backend/functions.php');

                $filter = e($_GET['filter']);
                $my_band->get_band_structure();
                $band_struct = $my_band->get_band_voices();


                disp_band($my_band, "leader", $filter);
               
                
             
                    
              
            ?>
        </div>
    </div>
   
</div>
       <?php    include('content/footer.php'); ?>
</div>   

