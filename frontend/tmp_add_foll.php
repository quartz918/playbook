<?php
include('../backend/functions.php');
        if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../index.php');
}
?>
<html>
    <body>
        <h1> Search for user </h1>
        search by user name or email
        <form  method="post" action="tmp_add_foll.php?go"  id="searchform"> 
          <input  type="text" name="search_query"> 
          <input  type="submit" name="submit" value="Search"> 
        </form> 
        <?php 
            include '../backend/follower.php';
            if(isset($_POST['submit'])){
                $res = search_for_user();
                printSearchResult($res);
            }
            if(isset($_GET['add'])){
                $addUser = e($_GET['add']);
                $myself = $_SESSION["user"]["id"];
                follow_user($myself,$addUser);
            }
            if(isset($_GET['del'])){
                $delUser = e($_GET['del']);
                $myself = $_SESSION["user"]["id"];
                unfollow_user($myself,$delUser);
                echo "delete";
            }
        ?>
        <a href='home.php'> home </a>
    </body>
</html>

