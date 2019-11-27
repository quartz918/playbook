<?php include('../backend/functions.php') ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>MusicDB</title>
    <link rel="stylesheet" href="format.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  
  <body>
    <div class="wrapper">
      <h1>Register</h1>
      <p> Please fill this form to create an account. </p>
      <div id="register">
      <form method="post" action="../index.php">
        <?php echo display_error(); ?>
      <div class="input-group">
        <label>Username</label>
        <input type="text" name="username" value="<?php echo $username; ?>" >
      </div>
      <div class="input-group">
        <label>Email</label>
        <input type="email" name="email" value="<?php echo $email; ?>">
      </div>
      <div class="input-group">
        <label> Password </label>
        <input type="password" name="password_1">
      </div>
      <div class="input-group">
        <label>Confirm Password</label>
        <input type="password" name="password_2">
      </div>
      <div class="input-group">
        <button type="submit" class="btn" name="reg_user">Register</button>
      </div>
      <p>
      Already registered? <a href="../index.php">Sign in</a>
      </p>
      </form>
    </div>
  </body>
</html>
    
