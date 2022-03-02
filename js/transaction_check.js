$(document).ready(function(){

    setInterval(function(){
        if($(".progress_bar_transaction")[0]){

          $.ajax({
            type: "POST",
            url: "check_transaction.php",
            data: {
              'advert_id': sessionStorage.advert_id,
              'user_id': sessionStorage.user_id,
              'author_id': sessionStorage.author_id
            },
            success: function(data){
              $('#main-section').append(data);

              if(sessionStorage.getItem("error") === null){
                if(sessionStorage.requested == 1){
                  document.getElementsByClassName("requested")[0].innerHTML = "<i class='bi bi-check-circle-fill text-success' style='font-size: 3rem;'></i>";
                    if(document.getElementsByClassName("p_requested")[0].classList.contains("text-success")){}else{
                      document.getElementsByClassName("p_requested")[0].classList.add("transaction_label");
                      document.getElementsByClassName("p_requested")[0].classList.add("text-success");
                    }
                }else{
                  document.getElementsByClassName("requested")[0].innerHTML = "<i class='bi bi-x-circle-fill' style='font-size: 2rem;'></i>";
                    if(document.getElementsByClassName("p_requested")[0].classList.contains("text-success")){
                      document.getElementsByClassName("p_requested")[0].classList.remove("transaction_label");
                      document.getElementsByClassName("p_requested")[0].classList.remove("text-success");
                    }else{}
                }

                if(sessionStorage.advert_author_confirmed_request == 1){
                  document.getElementsByClassName("advert_author_confirmed_request")[0].innerHTML = "<i class='bi bi-check-circle-fill text-success' style='font-size: 3rem;'></i>";
                    if(document.getElementsByClassName("p_advert_author_confirmed_request")[0].classList.contains("text-success")){}else{
                      document.getElementsByClassName("p_advert_author_confirmed_request")[0].classList.add("transaction_label");
                      document.getElementsByClassName("p_advert_author_confirmed_request")[0].classList.add("text-success");
                    }
                }else{
                  document.getElementsByClassName("advert_author_confirmed_request")[0].innerHTML = "<i class='bi bi-x-circle-fill' style='font-size: 2rem;'></i>";
                    if(document.getElementsByClassName("p_advert_author_confirmed_request")[0].classList.contains("text-success")){
                      document.getElementsByClassName("p_advert_author_confirmed_request")[0].classList.remove("transaction_label");
                      document.getElementsByClassName("p_advert_author_confirmed_request")[0].classList.remove("text-success");
                    }else{}
                }

                if(sessionStorage.confirmed_success == 1){
                  document.getElementsByClassName("confirmed_success")[0].innerHTML = "<i class='bi bi-check-circle-fill text-success' style='font-size: 3rem;'></i>";
                    if(document.getElementsByClassName("p_confirmed_success")[0].classList.contains("text-success")){}else{
                      document.getElementsByClassName("p_confirmed_success")[0].classList.add("transaction_label");
                      document.getElementsByClassName("p_confirmed_success")[0].classList.add("text-success");
                    }
                }else{
                  document.getElementsByClassName("confirmed_success")[0].innerHTML = "<i class='bi bi-x-circle-fill' style='font-size: 2rem;'></i>";
                    if(document.getElementsByClassName("p_confirmed_success")[0].classList.contains("text-success")){
                      document.getElementsByClassName("p_confirmed_success")[0].classList.remove("transaction_label");
                      document.getElementsByClassName("p_confirmed_success")[0].classList.remove("text-success");
                    }else{}
                }

                if(sessionStorage.advert_author_confirmed_success == 1){
                  document.getElementsByClassName("advert_author_confirmed_success")[0].innerHTML = "<i class='bi bi-check-circle-fill text-success' style='font-size: 3rem;'></i>";
                    if(document.getElementsByClassName("p_advert_author_confirmed_success")[0].classList.contains("text-success")){}else{
                      document.getElementsByClassName("p_advert_author_confirmed_success")[0].classList.add("transaction_label");
                      document.getElementsByClassName("p_advert_author_confirmed_success")[0].classList.add("text-success");
                    }
                }else{
                  document.getElementsByClassName("advert_author_confirmed_success")[0].innerHTML = "<i class='bi bi-x-circle-fill' style='font-size: 2rem;'></i>";
                    if(document.getElementsByClassName("p_advert_author_confirmed_success")[0].classList.contains("text-success")){
                      document.getElementsByClassName("p_advert_author_confirmed_success")[0].classList.remove("transaction_label");
                      document.getElementsByClassName("p_advert_author_confirmed_success")[0].classList.remove("text-success");
                    }else{}
                }
              }

              if($(".transaction_6")[0]){
                document.getElementsByClassName("transaction_6")[0].remove();
              }
              if($(".transaction_7")[0]){
                document.getElementsByClassName("transaction_7")[0].remove();
              }
              if($(".transaction_8")[0]){
                document.getElementsByClassName("transaction_8")[0].remove();
              }
              if($(".transaction_9")[0]){
                document.getElementsByClassName("transaction_9")[0].remove();
              }
              if($(".transaction_10")[0]){
                document.getElementsByClassName("transaction_10")[0].remove();
              }


            },
            error: function(err) {
              console.log(err);
              console.log(err.responseText);
            }
          });
        }

      },1*1*1000);


});
