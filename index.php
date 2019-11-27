<?php include('backend/functions.php');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>OrchNet</title>
    <link rel="stylesheet" href="format.css">
  </head>
  <body>
    <div class="ind-header-wrapper">
        <div class="ind-header-logo">
            <a href="index.php" class="logo">OrchNet</a>
        </div>
        <div class="header-login-button">
            <form action="sign_in.php">                
                <div class="ind-header-login-button">
                    <input type="submit" name="login" value="Sign in" class="header-login-btn">    
                </div>
            </form>
        </div>
      <?php echo display_error(); ?>
    </div>
    <div class="ind-search-wrapper">
        <form  method="get" action="frontend/search.php?go"  > 
          <div class="ind-search">
            <input  type="text" name="search_query" class="ind-search-text"> 
            <input  type="submit" name="search_go" value="Go" class="ind-search-btn"> 
          </div>
        </form> 
        </div>
    <div class="footer">
        <a class="active" href="index.php">Login</a></li>
        <a href="frontend/about.php">About</a></li>
        <a href="frontend/register.php">Register</a></li>
    </div>
  </body>
</html>

