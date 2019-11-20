<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
<div class="header-wrapper-right">
    <div class="header-notification">
        <button class="header-notification-btn"><i class="material-icons inactive">library_books</i></button>
        <div class="header-notification-content">You do not have any notification</div>
    </div>
    <div class="header-home">
        <?php
            $path = e($_SERVER['DOCUMENT_ROOT']);
            $path .= "/musicdb/backend/load_pic.php";
            include_once($path);
            $usrid = e($_SESSION['user']['id']);

            $pic = load_usr_pic($usrid);
            echo '<a href=/musicdb/frontend/disp_home.php>';
            echo '<img src="'.$pic.'" alt="user" width="70" height="70" class="header-home-pic">';
            echo '</a>';
        ?>
    </div>
    <div class="header-settings">
        <button class="header-setting-btn"><i class="material-icons on-top ">details</i></button>
        <div class="header-settings-content">
            <a href="disp_home.php?logout='1'" style="color: red;">logout</a>
        </div>
    </div>
</div>

<script>
    $(".header-setting-btn").click( function(event){
        event.stopPropagation();
        $(".header-notification-content").hide();
        $(".header-settings-content").toggle();
    });
    $(".header-notification-btn").click( function(event){
        event.stopPropagation();
        $(".header-settings-content").hide();
        $(".header-notification-content").toggle();
    });
    
    $(document).click( function(){
        $(".header-settings-content").hide();
        $(".header-notification-content").hide();
    });
    
   

</script>
