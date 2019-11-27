 <script src="https://code.jquery.com/jquery-1.12.4.js"></script> 
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
<div class="header" id="myHeader">
    <div class="header-wrapper">
        
        <div class="header-logo">
           
            <a href="../index.php">[LOGO] </a>
           
        </div>
        <div class="header-search-wrapper">
        <form  method="get" action="<?php if(isLoggedIn()){ echo "disp_search.php?go";} 
                                            else { echo "search.php?go";}?>"> 
                                               
          <div class="header-search">
            <input  type="text" name="search_query" class="header-search-text"> 
            <input  type="submit" name="submit" value="Go" class="header-search-btn"> 
          </div>
        </form> 
        </div>
        <?php
        if (isLoggedIn()) {
            include('header_logged_in.php');
        }
        else {
            include('header_logged_out.php');
        }
        ?>
    </div>   
</div>
 <div class="header-mobile-search">
     <form  method="get" action="<?php if(isLoggedIn()){ echo "disp_search.php?go";} 
                                            else { echo "search.php?go";}?>"> 
                                               
          <div class="header-search">
            <input  type="text" name="search_query" class="header-mobile-search-input"> 
            <input  type="submit" name="submit" value="Go" class="header-search-btn"> 
          </div>
         
        </form> 
 </div>
 <script>
     $(".header-search-btn").click( function(event){
         event.stopPropagation();
        $(".header-settings-content").hide();
        $(".header-notification-content").hide();
        $(".header-mobile-search").toggle();
    });
    
    </script>