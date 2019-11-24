<?php include('../backend/functions.php');

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>OrchNet</title>
    <link rel="stylesheet" href="../format.css">
  </head>
  <body>
    <div class="ind-header-wrapper">
        <div class="ind-header-logo">
            <a href="../index.php" class="logo">OrchNet</a>
        </div>
        <div class="ind-header-login">
            <form method="post" action="../index.php">
                
                <div class="ind-header-login-wrapper">
                    <div class="ind-header-user-name">
                        <input type="text" name="username" placeholder="username">
                    </div>
                    <div class="ind-header-password">
                        <input type="password" name="password" placeholder="password">    
                    </div>
                     <div class="ind-header-login-button">
                        <input type="submit" name="login" value="Login" class="ind-header-login-btn">    
                    </div>
                </div>
            </form>
            <a href="register.php">Register</a>
        </div>
    </div>
      <?php echo display_error(); ?>
    New Search
    <div class="ind-search-wrapper">
        <form  method="get" action="search.php?go"  > 
          <div class="ind-search">
            <input  type="text" name="search_query" class="ind-search-text"> 
            <input  type="submit" name="search_go" value="Go" class="ind-search-btn"> 
          </div>
        </form> 
    </div>
    <?php
        $num_disp_hits = 10;
        $search_term=e($_GET["search_query"]);
        include("content/gen_search_result.php");
        disp_search_res_bands($num_disp_hits, $search_term, "a");  
    ?>
    <div class="footer">
        <a class="active" href="index.php">Login</a></li>
        <a href="frontend/about.php">About</a></li>
        <a href="frontend/register.php">Register</a></li>
    </div>
  </body>
</html>

