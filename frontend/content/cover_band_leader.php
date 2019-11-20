<?php
$pic = load_bnd_pic($band_id);
echo '<button id="prof-img-button" class="prof-button" data-modal="#picUpload">';
echo '<img src="'.$pic.'" alt="user" class="userPic" >';
echo '</button>';
?>
<div id="picUpload" class="modal" >
    <div class="modal-dialog">
        <div class="pic_upload">
            <span class="close">&times;</span>
            <p>Select image to upload:</p>
            <form action="../backend/upload_pic_band.php" method="post" enctype="multipart/form-data">
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