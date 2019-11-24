<div id="attend-event">
    <?php
    $user_id = $_SESSION['user']['id'];
    if(check_if_attending($event_id, $user_id)){
        echo "<input type='button' value='unregister' class='content-title-button'  onclick='unregEvent(". $event_id .")' id='unregister-event-button'>";

    } else {
        echo "<input type='button' value='attend event' class='content-title-button' onclick='regEvent(". $event_id .")' id='attend-event-button'>";

    }
    ?>
</div>
<script>
    function regEvent(event_id){
        document.getElementById("attend-event").innerHTML = "<input type='button' value='unregister' class='content-title-button' onclick='unregEvent(" + event_id +")'  id='unregister-event-button'>";
        
        var url = "../backend/event/event_register.php";
        var event_id_ser = "event_id=" + event_id;
        $.ajax({
            type: "GET",
            url: url,   
            data: event_id_ser,
            dataType: "text",
            success: function(res){},
            error: function(error){console.log("registering failed");}
        });
    };
   function unregEvent(event_id){
        document.getElementById("attend-event").innerHTML = "<input type='button' value='attend event' class='content-title-button'  onclick='regEvent(" + event_id +")' id='attend-event-button'>";
    
    var url = "../backend/event/event_unregister.php";
        var event_id_ser = "event_id=" + event_id;
        $.ajax({
            type: "GET",
            url: url,
            data: event_id_ser,
            dataType: "text",
            success: function(res){},
            error: function(error){console.log("unregistering failed")}
        });
    }
</script>
