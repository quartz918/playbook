<div class="get-band-loc-form">   

    <input type='text' name='search-location' placeholder='location' class='band-location-search' value="" id="bandLocQuery">
    <input type="hidden" id="locationdata" name="location" >
    <input type="button" name="sButton" class="found-band-btn" value="Search" id="submitLocQuery">

<div id="search-loc-print">

</div>
<script>
    $("#submitLocQuery").click(function() {
        var locQuery = document.getElementById("bandLocQuery").value;
        var ajxQuery = "input=" + locQuery;
        var url = "../backend/get_loc_google_places_api.php";                     // change for other api
        $.ajax({
            type: "GET",
            url: url,
            data: ajxQuery,
            dataType: "text",           
            success: function(res){
                if(res){                                                      
                    $('#search-loc-print').html(res);
                }
            },
            error: function(error) {
                console.log('Error: ' + error);
            }
        });       
    });
   
    function chooseLocation(lat,  lon, address){
       $('#bandLocQuery').val(address);
       $('#locationdata').val(lat+"|"+lon+"|"+address);
    };
    </script>
</script>
</div>