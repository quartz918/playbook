<div id="createEvent" class="modal">
    <div class="modal-dialog-wide">
        <div class="mod-create-event-content">
            <span class="close">&times;</span>
            <form action="disp_band_schedule.php" method="post">
                <div class="two-col-form-wrapper">
                    <div class="left-col-form">
                        <label for="title">Event title</label>
                        <input id="title" type="text" name="title" placeholder="Title">
                        <br>
                        <label for="startdate">on</label>
                        <input id="startdate" name="startdate" type="date">
                        <label for="starttime">at (hh:mm)</label>                        
                        <input id="starttime" name="starttime" type="text">
                        <br>
                        <label for="enddate">till</label>
                        <input id="enddate" name="enddate" type="date">
                        <label for"endtime">at (hh:mm)</label>
                        <input id="endtime" name="endtime" type="text">
                        <textarea rows="4" cols="40" name="description" maxlength="200" class="text-area" id="textArea" placeholder="Enter a description here"></textarea>
                    </div>
                    <div class="right-col-form">
                        <?php include("content/get_location_form.php");?>
                    </div>
                </div>
                <input type="submit" name="createEvent" value="create event">
            </form>
           
            
        </div>
    </div>
</div>

    
