<?php include('backend/functions.php');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>OrchNet</title>
    <link rel="stylesheet" href="format.css">
    <link rel="stylesheet" href="sign_in_sty.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <div class="ind-header-wrapper">
        <div class="ind-header-logo">
            <a href="index.php" class="logo">OrchNet</a>
        </div>
        
    </div>

    
      <div class="signin-wrapper">
          <div class="signin-title">
              Sign In
          </div>
           <div class="signin-login">
               <form method="post" action="<?php
                    if(isset($_GET["forward"])){
                        echo "sign_in.php?forward=".e($_GET["forward"]);
                    }
                    else {
                        echo "sign_in.php?forward=frontend/disp_home.php";
                    }
                    ?>">
                
                <div class="signin-login-wrapper">
                    <div class="signin-user-name">
                        <input type="text" name="username" placeholder="username">
                    </div>
                    <div class="signin-password">
                        <input type="password" name="password" placeholder="password">    
                    </div>
                     <div class="signin-login-button">
                        <input type="submit" name="login" value="Sign in" class="signin-login-btn">    
                    </div>
                </div>
            </form>
               <div class="signin-errors">
                   <?php echo display_error(); ?>
               </div>  
        </div>
          <div class="signin-register">
              <a href="frontend/register.php">Create Account</a>
          </div>  
      </div>

    <div class="footer">
        <a class="active" href="index.php">Login</a></li>
        <a href="frontend/about.php">About</a></li>
        <a href="frontend/register.php">Register</a></li>
    </div>
  </body>
</html>



