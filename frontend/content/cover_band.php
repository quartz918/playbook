<div class="cover">
    <div class="cover-wrapper">
        <div>
            
            <?php
            $path = e($_SERVER['DOCUMENT_ROOT']);
            $path .= "/musicdb/backend/load_pic.php";
            include_once($path);
            
            $path = e($_SERVER['DOCUMENT_ROOT']);
            $path .= "/musicdb/backend/bands.php";
            include_once($path);
            

            
            $my_band = new band($band_id);
            $user_id = e($_SESSION['user']['id']);
            if($my_band->check_if_leader($user_id)){
                include('cover_band_leader.php');
              
            }
            else {
                include('cover_band_other.php');
            }
            
            ?> 
        </div>
        <div class="user-name">
        <a href="disp_sel_band.php">
            <?php echo $band_name; ?></a>
        </div>
    </div>
</div>