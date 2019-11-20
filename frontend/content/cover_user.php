<div class="cover">
    <div class="cover-wrapper">
        <div>
            
            <?php
           
            
            $usrid = $user_id;
            
            $pic = load_usr_pic($usrid);
            
            
            
            echo '<img src="'.$pic.'" alt="user" class="userPic" >';
           
            ?>
           
        </div>
        <div class="user-name">
       
            <?php echo $user_name; ?>
        </div>
    </div>
</div>