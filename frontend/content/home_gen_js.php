


    <script>
        $(".inst-add-button").on("click", function() {
        var modal = $(this).data("modal");
        $(modal).show();
        });
        $(".prof-button").on("click", function() {
        var modal = $(this).data("modal");
        $(modal).show();
        });
        $("#band-found-button").on("click", function() {
        var modal = $(this).data("modal");
        $(modal).show();
        });
        $("#band-delete-button").on("click", function() {
        var modal = $(this).data("modal");
        $(modal).show();
        });
        
        $(".modal").on("click", function(e) {
          var className = e.target.className;
          if(className === "modal" || className === "close"){
            $(this).closest(".modal").hide();
          }
        });
    </script>