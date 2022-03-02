$(document).ready(function(){
  setInterval(function(){
          $.get("check_session.php", function(data){
            if(data==0){
              $.ajax({
                type: "POST",
                url: "logout.php",
                success: function(){
                  main_site_on();
                  location.reload();
                  main_site_on();
                  if(sessionStorage.language == "ENG"){
                    alert("You have been logged out. Please login again.");
                  }else if(sessionStorage.language == "PL"){
                    alert("Zostałeś wylogowany. Proszę zalogować się ponownie.");
                  }
                },
                error: function(err) {
                  console.log(err);
                  console.log(err.responseText);
                }
              });
            }else if (data == 2){
              if(sessionStorage.language == "ENG"){
                alert("You will be logged out by about one minute. Please finish your work.");
              }else if(sessionStorage.language == "PL"){
                alert("Zostaniesz wylogowany za około minutę. Proszę kończyć swoje prace.");
              }
            }
          });
      },1*10*1000);
});
