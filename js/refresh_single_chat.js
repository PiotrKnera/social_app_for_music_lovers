$(document).ready(function(){

  setInterval(function(){
      if(document.getElementsByClassName('single_chat_modal_body')[0].style.display != "none"){
        if(sessionStorage.scroll_down == 1){
          var messageBody = document.getElementsByClassName('single_chat_modal_body')[0];
          messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
          sessionStorage.scroll_down = 0;
        }
      }
  },1*0.1*1000);

    setInterval(function(){
        if(document.getElementsByClassName('single_chat_modal_body')[0].style.display != "none"){
             refresh_single_chat(sessionStorage.from_user_id, sessionStorage.to_username);
          }
      },1*0.5*1000);


});
