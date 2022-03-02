$(document).ready(function(){
    setInterval(function(){
      if ($(".logout_value")[0]){
              $.ajax({
                type: "POST",
                url: "check_logout_timer.php",
                success: function(timer){
                  document.getElementsByClassName("logout_value")[0].innerHTML = timer + "s";
                },
                error: function(err) {
                  console.log(err);
                  console.log(err.responseText);
                }
              });
            }
      },1*1*1000);
});
