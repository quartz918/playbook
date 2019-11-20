<div class="cover">
    <div class="cover-wrapper">
        <div>
            
            <?php
           
            
            $usrid = e($_SESSION['user']['id']);
            
            $pic = load_usr_pic($usrid);
            
            
            echo '<button id="prof-img-button" class="prof-button" data-modal="#picUpload">';
            echo '<img src="'.$pic.'" alt="user" class="userPic" >';
            echo '</button>';
            ?>
            <div id="picUpload" class="modal" >
                <div class="modal-dialog">
                    <div class="pic_upload">
                        <span class="close">&times;</span>
                        <p>Select image to upload:</p>
                        <form action="../backend/upload_pic.php" method="post" enctype="multipart/form-data">
                        <div class="upload-wrapper">
                        <div class="upload-btn-wrapper">

                                <input type="file" name="fileToUpload" id="fileToUpload">
                        </div>
                        <input type="submit" value="Upload Image" name="submit_pic" class="std-btn">
                        </div>
                        </form>
                    </div>
                </div>
            </div>  
        </div>
        <div class="user-name">
        <a href="disp_home.php">
            <?php echo $_SESSION['user']['username']; ?></a>
        </div>
    </div>
</div>