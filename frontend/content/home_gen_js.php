

<script>
    // sticky header
    window.onscroll = function() {myFunction()};

    var header = document.getElementById("myHeader");
    var sticky = header.offsetTop;

    function myFunction() {
      if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
      } else {
        header.classList.remove("sticky");
      }
    }
    </script>
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