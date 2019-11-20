<?php 
	include('../backend/functions.php');
        if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../index.php');
       
}
include('../backend/instruments.php');
?>
<html>
<head>

<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
 <form action="tmp_add_inst.php" method="post">
  <select name="instrument">
    <?php echo get_instrument_list(); ?>
  </select>
  <br><br>
  <input type="submit">
 </form>
 <?php 
 if(isset($_POST['instrument'])){
     $addInst = e($_POST['instrument']);
     add_instrument($addInst); 
 }
?>
    <br>
    <a href="home.php">home</a>
</body>
</html>