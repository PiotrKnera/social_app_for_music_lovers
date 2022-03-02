var flag = 0;
var comment_flag = 0;
var which_content = "main";
var scroll_nav = true;
var increase = true;
var song_url;
var photo_src;

$(document).ready(function(){
  if (!(sessionStorage.language)) {
    sessionStorage.language = "PL";
  }
});

function remove_classes_main_image(){
  if ($(".front-end-section-label-adverts")[0]){
     document.getElementsByClassName("front-end-section-label")[0].classList.remove('front-end-section-label-adverts');
  }else if($(".front-end-section-label-services")[0]){
     document.getElementsByClassName("front-end-section-label")[0].classList.remove('front-end-section-label-services');
  }else if($(".front-end-section-label-songs")[0]){
     document.getElementsByClassName("front-end-section-label")[0].classList.remove('front-end-section-label-songs');
  }else if($(".front-end-section-label-login")[0]){
     document.getElementsByClassName("front-end-section-label")[0].classList.remove('front-end-section-label-login');
     document.getElementsByClassName("main_login_box")[0].style.display = "none";
     document.getElementsByClassName("front-end-section-label")[0].style.display = "flex";
     document.getElementsByClassName("bg")[0].style.display = "none";
  }else if($(".front-end-section-label-register")[0]){
     document.getElementsByClassName("front-end-section-label")[0].classList.remove('front-end-section-label-register');
     document.getElementsByClassName("main_register_box")[0].style.display = "none";
     document.getElementsByClassName("front-end-section-label")[0].style.display = "flex";
     document.getElementsByClassName("bg")[0].style.display = "none";
  }else if($(".front-end-section-label-one")[0]){
     document.getElementsByClassName("front-end-section-label")[0].classList.remove('front-end-section-label-one');
     document.getElementsByClassName("front-end-section-label")[0].style.display = "flex";
  }
}

function remove_other_content(){
  if ($("#second_main_section")[0]){
    document.getElementById('second_main_section').remove();
    if($(".second_bottom_nav")[0]){
      document.getElementsByClassName('second_bottom_nav')[0].remove();
    }if($(".author_section")[0]){
      document.getElementsByClassName('author_section')[0].remove();
    }
  }
}

function PL_on(){

  sessionStorage.language = "PL";

  $.ajax({
  type: "POST",
  url: "set_language.php",
  data: {
    'language': "PL"
  },
  success: function(){
    location.reload();
  },
  error: function(err) {
    console.log(err);
  }
});

}

function ENG_on(){

  sessionStorage.language = "ENG";

    $.ajax({
    type: "POST",
    url: "set_language.php",
    data: {
      'language': "ENG"
    },
    success: function(){
      location.reload();
    },
    error: function(err) {
      console.log(err);
    }
  });

}

function main_site_on(){

  window.comment_flag = 0;
  window.which_content = "main";
  window.flag = 0;

  window.scroll_nav = true;
  window.scrollTo(0, 0);

  if(sessionStorage.language == "ENG"){
    document.getElementsByClassName("firstTitle")[0].innerHTML = "Social App For Music Lovers";
  }else if(sessionStorage.language == "PL"){
    document.getElementsByClassName("firstTitle")[0].innerHTML = "Społecznościowa Aplikacja Webowa Dla Miłośników Muzyki";
  }

  remove_classes_main_image();
  remove_other_content();
  document.getElementById("carouselExampleControls").style.display = "block";
}

function adverts_on(){

  window.comment_flag = 0;
  if(window.which_content != "adverts"){
    window.flag = 0;
  }
  window.which_content = "adverts";

  window.scroll_nav = true;

  if(sessionStorage.language == "ENG"){
    document.getElementsByClassName("firstTitle")[0].innerHTML = "Adverts";
  }else if(sessionStorage.language == "PL"){
    document.getElementsByClassName("firstTitle")[0].innerHTML = "Ogłoszenia";
  }

  remove_classes_main_image();
  remove_other_content();
  document.getElementsByClassName("front-end-section-label")[0].classList.add('front-end-section-label-adverts');
  document.getElementById("carouselExampleControls").style.display = "none";

  $.ajax({
  type: "POST",
  url: "get_adverts_data.php",
  data: {
    'offset': window.flag,
    'limit': 5
  },
  success: function(back_data){
    window.scrollTo(0, 0);
    $('#main-section').append(back_data);
  },
  error: function(err) {
    console.log(err);
  }
});

}

function services_on(){

    window.comment_flag = 0;
    if(window.which_content != "services" || window.which_content != "one_service"){
      window.flag = 0;
    }
    window.which_content = "services";

    window.scroll_nav = true;

    if(sessionStorage.language == "ENG"){
      document.getElementsByClassName("firstTitle")[0].innerHTML = "Services";
    }else if(sessionStorage.language == "PL"){
      document.getElementsByClassName("firstTitle")[0].innerHTML = "Usługi";
    }

    remove_classes_main_image();
    remove_other_content();
    document.getElementsByClassName("front-end-section-label")[0].classList.add('front-end-section-label-services');
    document.getElementById("carouselExampleControls").style.display = "none";

    $.ajax({
    type: "POST",
    url: "get_services_data.php",
    data: {
      'offset': window.flag,
      'limit': 5
    },
    success: function(back_data){
      window.scrollTo(0, 0);
      $('#main-section').append(back_data);
    },
    error: function(err) {
      console.log(err);
      console.log(err.responseText);
    }
  });

}

function songs_on(){


  window.comment_flag = 0;
  if(window.which_content != "songs"){
    window.flag = 0;
  }
  window.which_content = "songs";


  window.scroll_nav = true;

  if(sessionStorage.language == "ENG"){
    document.getElementsByClassName("firstTitle")[0].innerHTML = "Songs";
  }else if(sessionStorage.language == "PL"){
    document.getElementsByClassName("firstTitle")[0].innerHTML = "Utwory muzyczne";
  }

  remove_classes_main_image();
  remove_other_content();
  document.getElementsByClassName("front-end-section-label")[0].classList.add('front-end-section-label-songs');
  document.getElementById("carouselExampleControls").style.display = "none";

  $.ajax({
  type: "POST",
  url: "get_songs_data.php",
  data: {
    'offset': window.flag,
    'limit': 5
  },
  success: function(back_data){
    window.scrollTo(0, 0);
    $('#main-section').append(back_data);
  },
  error: function(err) {
    console.log(err);
    console.log(err.responseText);
  }
});

}

function next_adverts(){
  window.flag += 5;
  adverts_on();
}

function previous_adverts(){
  window.flag -= 5;
  adverts_on();
}

function login_on(){

  window.flag = 0;
  window.which_content = "login";

  remove_classes_main_image();
  remove_other_content();
  document.getElementsByClassName("front-end-section-label")[0].classList.add('front-end-section-label-login');
  document.getElementsByClassName("front-end-section-label")[0].style.display = "none";
  document.getElementById("carouselExampleControls").style.display = "none";
  window.scroll_nav = false;
  document.getElementsByClassName("main_login_box")[0].style.display = "inline-block";
  document.getElementsByClassName("bg")[0].classList.remove('register');
  document.getElementsByClassName("bg")[0].style.display = "block";
  window.scrollTo(0, 0);

}

function login_transaction(){

  if(document.getElementsByClassName("firstinput")[0].value != "" && document.getElementsByClassName("secondinput")[0].value != "" ){

    $.ajax({
      type: "POST",
      url: "login.php",
      data: {
        email_login: document.getElementsByClassName("firstinput")[0].value,
        password_login: document.getElementsByClassName("secondinput")[0].value
      },
      success: function(back_data){

        $('#main-section').append(back_data);
        if ($(".info_modal_email")[0] || $(".info_modal_password")[0] || $(".info_modal_wrong")[0] || $(".info_modal_verification")[0]) {
          if($(".info_modal_email")[0]){
            $(".info_modal_email")[0].remove();
          }
          if($(".info_modal_password")[0]){
            $(".info_modal_password")[0].remove();
          }
          if($(".info_modal_wrong")[0]){
            $(".info_modal_wrong")[0].remove();
          }
          if($(".info_modal_verification")[0]){
            $(".info_modal_verification")[0].remove();
          }

          login_on();
        }else{
          main_site_on();
          location.reload();
        }

      },
      error: function(err) {
        console.log(err);
        console.log(err.responseText);
      }
    });

  }else{
    if(sessionStorage.language == "ENG"){
      alert("Please fill all fields");
    }else if(sessionStorage.language == "PL"){
      alert("Proszę wypełnić wszystkie pola");
    }
  }

}

function register_on(){

  window.flag = 0;
  window.which_content = "register";

  remove_classes_main_image();
  remove_other_content();

  document.getElementsByClassName("front-end-section-label")[0].classList.add('front-end-section-label-register');
  document.getElementsByClassName("front-end-section-label")[0].style.display = "none";
  document.getElementById("carouselExampleControls").style.display = "none";
  window.scroll_nav = false;
  document.getElementsByClassName("main_register_box")[0].style.display = "inline-block";
  document.getElementsByClassName("bg")[0].style.display = "block";
  document.getElementsByClassName("bg")[0].classList.add('register');
  window.scrollTo(0, 0);

}

function register_transaction(){

  if(document.getElementsByClassName("email_register")[0].value != "" && document.getElementsByClassName("password1_register")[0].value != "" &&
    document.getElementsByClassName("password2_register")[0].value != "" && document.getElementsByClassName("username_register")[0].value != "" &&
    document.getElementsByClassName("name_register")[0].value != "" && document.getElementsByClassName("surname_register")[0].value != "" &&
    document.getElementsByClassName("phone_register")[0].value != ""){

    $.ajax({
      type: "POST",
      url: "register.php",
      data: {
        email_register: document.getElementsByClassName("email_register")[0].value,
        password1_register: document.getElementsByClassName("password1_register")[0].value,
        password2_register: document.getElementsByClassName("password2_register")[0].value,
        username_register: document.getElementsByClassName("username_register")[0].value,
        name_register: document.getElementsByClassName("name_register")[0].value,
        surname_register: document.getElementsByClassName("surname_register")[0].value,
        phone_register: document.getElementsByClassName("phone_register")[0].value

      },
      success: function(back_data){
        $('#main-section').append(back_data);
        register_on();
        if($(".info_modal")[0]){
          document.getElementsByClassName('info_modal')[0].remove();
        }
      },
      error: function(err) {
        console.log(err);
        console.log(err.responseText);
      }
    });

}else{
  if(sessionStorage.language == "ENG"){
    alert("Please fill all fields");
  }else if(sessionStorage.language == "PL"){
    alert("Proszę wypełnić wszystkie pola");
  }
}

}

function like_on(data, info){

  $.ajax({
    type: "POST",
    url: "increase_like.php",
    data: {
      service_id: data
    },
    success: function(back_data){
      $('head').append(back_data);

      let likes_number = document.getElementsByClassName(info.className)[0].textContent;
      if(window.increase == true){
        likes_number++;
      }else{
        likes_number--;
      }
      document.getElementsByClassName(info.className)[0].innerHTML = likes_number + " <i class='bi bi-hand-thumbs-up-fill text-center'></i>";
      document.getElementsByClassName("like_info")[0].remove();


    },
    error: function(err) {
      console.log(err);
      console.log(err.responseText);
    }
  });

}

function user_adverts_on(){

    if(window.which_content != "user_adverts"){
      window.flag = 0;
    }
    window.which_content = "user_adverts";

    window.scroll_nav = true;
    if(sessionStorage.language == "ENG"){
      document.getElementsByClassName("firstTitle")[0].innerHTML = "Your adverts";
    }else if(sessionStorage.language == "PL"){
      document.getElementsByClassName("firstTitle")[0].innerHTML = "Twoje ogłoszenia";
    }
    remove_classes_main_image();
    remove_other_content();
    document.getElementsByClassName("front-end-section-label")[0].classList.add('front-end-section-label-adverts');
    document.getElementById("carouselExampleControls").style.display = "none";

    $.ajax({
    type: "POST",
    url: "get_user_adverts.php",
    data: {
      'offset': window.flag,
      'limit': 5
    },
    success: function(back_data){
      window.scrollTo(0, 0);
      $('#main-section').append(back_data);
    },
    error: function(err) {
      console.log(err);
      console.log(err.responseText);
    }
  });

}

function one_advert_on(advert_id){

    window.which_content = "one_advert";

    remove_classes_main_image();
    remove_other_content();
    document.getElementsByClassName("front-end-section-label")[0].classList.add('front-end-section-label-one');
    document.getElementsByClassName("front-end-section-label")[0].style.display = "none";
    document.getElementById("carouselExampleControls").style.display = "none";

    $.ajax({
    type: "POST",
    url: "get_one_advert_data.php",
    data: {
      advert_id: advert_id
    },
    success: function(back_data){
      window.scrollTo(0, 0);
      $('#main-section').append(back_data);
    },
    error: function(err) {
      console.log(err);
      console.log(err.responseText);
    }
  });

}

function request_for_trade(advert_id, author_id, id_user_requested){
  $.ajax({
    type: "POST",
    url: "request_for_trade.php",
    data: {
      advert_id: advert_id,
      author_id: author_id,
      id_user_requested: id_user_requested
    },
    success: function(back_data){
    console.log(back_data);
    one_advert_on(advert_id);
    window.scrollTo(0, 0);
    },
    error: function(err) {
    console.log(err);
    console.log(err.responseText);
    }
  });
}

function confirm_request(advert_id, author_id, id_user_requested){
    $.ajax({
      type: "POST",
      url: "confirm_request.php",
      data: {
        advert_id: advert_id,
        author_id: author_id,
        id_user_requested: id_user_requested
      },
      success: function(back_data){
      console.log(back_data);
      one_advert_on(advert_id);
      window.scrollTo(0, 0);
      },
      error: function(err) {
      console.log(err);
      console.log(err.responseText);
      }
    });
}

function user_confirm_success(advert_id, author_id){
  $.ajax({
    type: "POST",
    url: "user_confirm_success.php",
    data: {
      advert_id: advert_id,
      author_id: author_id
    },
    success: function(back_data){
    console.log(back_data);
    one_advert_on(advert_id);
    window.scrollTo(0, 0);
    },
    error: function(err) {
    console.log(err);
    console.log(err.responseText);
    }
  });
}

function advert_author_confirm_success(advert_id, author_id){
  $.ajax({
    type: "POST",
    url: "advert_author_confirmed_success.php",
    data: {
      advert_id: advert_id,
      author_id: author_id
    },
    success: function(back_data){
    console.log(back_data);
    one_advert_on(advert_id);
    window.scrollTo(0, 0);
    },
    error: function(err) {
    console.log(err);
    console.log(err.responseText);
    }
  });
}

function user_services_on(){

    if(window.which_content != "user_services"){
      window.flag = 0;
    }
    window.which_content = "user_services";

    window.scroll_nav = true;
    if(sessionStorage.language == "ENG"){
      document.getElementsByClassName("firstTitle")[0].innerHTML = "Your services";
    }else if(sessionStorage.language == "PL"){
      document.getElementsByClassName("firstTitle")[0].innerHTML = "Twoje usługi";
    }
    remove_classes_main_image();
    remove_other_content();
    document.getElementsByClassName("front-end-section-label")[0].classList.add('front-end-section-label-services');
    document.getElementById("carouselExampleControls").style.display = "none";

    $.ajax({
    type: "POST",
    url: "get_user_services.php",
    data: {
      'offset': window.flag,
      'limit': 5
    },
    success: function(back_data){
      window.scrollTo(0, 0);
      $('#main-section').append(back_data);
    },
    error: function(err) {
      console.log(err);
      console.log(err.responseText);
    }
  });

}

function one_service_on(service_id, data){

    window.which_content = "one_service";

    remove_classes_main_image();
    remove_other_content();
    document.getElementsByClassName("front-end-section-label")[0].classList.add('front-end-section-label-one');
    document.getElementsByClassName("front-end-section-label")[0].style.display = "none";
    document.getElementById("carouselExampleControls").style.display = "none";

    $.ajax({
    type: "POST",
    url: "get_one_service_data.php",
    data: {
      service_id: service_id,
      counter_block: data,
      limit_comment: 5,
      offset_comment: window.comment_flag
    },
    success: function(back_data){
      // console.log(back_data);
      window.scrollTo(0, 0);
      $('#main-section').append(back_data);
    },
    error: function(err) {
      console.log(err);
      console.log(err.responseText);
    }
  });

}

function next_comments_service(service_id, data){
  window.comment_flag += 5;
  one_service_on(service_id, data);
}

function previous_comments_service(service_id, data){
  window.comment_flag -= 5;
  one_service_on(service_id, data);
}

function add_comment_to_service(service_id, user_id, block){

  $.ajax({
    type: "POST",
    url: "add_comment_to_service.php",
    data: {
      'service_id': service_id,
      'user_id': user_id,
      'content': document.getElementsByClassName("textarea_comment")[0].value
    },
    success: function(back_data){
      one_service_on(service_id, block);
    },
    error: function(err) {
      console.log(err);
      console.log(err.responseText);
    }
  });

}

function delete_comment_from_service(service_id, comment_id, block){

  $.ajax({
    type: "POST",
    url: "delete_comment_from_service.php",
    data: {
      'comment_id': comment_id
    },
    success: function(back_data){
      one_service_on(service_id, block);
    },
    error: function(err) {
      console.log(err);
      console.log(err.responseText);
    }
  });

}

function user_songs_on(){

  if(window.which_content != "songs"){
    window.flag = 0;
  }
  window.which_content = "songs";


  window.scroll_nav = true;
  if(sessionStorage.language == "ENG"){
    document.getElementsByClassName("firstTitle")[0].innerHTML = "Your songs";
  }else if(sessionStorage.language == "PL"){
    document.getElementsByClassName("firstTitle")[0].innerHTML = "Twoje utwory muzyczne";
  }
  remove_classes_main_image();
  remove_other_content();
  document.getElementsByClassName("front-end-section-label")[0].classList.add('front-end-section-label-songs');
  document.getElementById("carouselExampleControls").style.display = "none";

  $.ajax({
  type: "POST",
  url: "get_user_songs.php",
  data: {
    'offset': window.flag,
    'limit': 5
  },
  success: function(back_data){
    window.scrollTo(0, 0);
    $('#main-section').append(back_data);
  },
  error: function(err) {
    console.log(err);
    console.log(err.responseText);
  }
});

}

// - - - - - - - - - - - - - - - - - - //


function one_song_on(song_id, data){

    window.which_content = "one_song";

    remove_classes_main_image();
    remove_other_content();
    document.getElementsByClassName("front-end-section-label")[0].classList.add('front-end-section-label-one');
    document.getElementsByClassName("front-end-section-label")[0].style.display = "none";
    document.getElementById("carouselExampleControls").style.display = "none";

    $.ajax({
    type: "POST",
    url: "get_one_song_data.php",
    data: {
      song_id: song_id,
      counter_block: data,
      limit_comment: 5,
      offset_comment: window.comment_flag
    },
    success: function(back_data){
      // console.log(back_data);
      window.scrollTo(0, 0);
      $('#main-section').append(back_data);
    },
    error: function(err) {
      console.log(err);
      console.log(err.responseText);
    }
  });

}

function next_comments_song(song_id, data){
  window.comment_flag += 5;
  one_song_on(song_id, data);
}

function previous_comments_song(song_id, data){
  window.comment_flag -= 5;
  one_song_on(song_id, data);
}

function add_comment_to_song(song_id, user_id, block){

  $.ajax({
    type: "POST",
    url: "add_comment_to_song.php",
    data: {
      'song_id': song_id,
      'user_id': user_id,
      'content': document.getElementsByClassName("textarea_comment")[0].value
    },
    success: function(back_data){
      one_song_on(song_id, block);
    },
    error: function(err) {
      console.log(err);
      console.log(err.responseText);
    }
  });

}

function delete_comment_from_song(song_id, comment_id, block){

  $.ajax({
    type: "POST",
    url: "delete_comment_from_song.php",
    data: {
      'comment_id': comment_id
    },
    success: function(back_data){
      one_song_on(song_id, block);
    },
    error: function(err) {
      console.log(err);
      console.log(err.responseText);
    }
  });

}


// - - - - - - - - - - - - - - - - - - //

function profile_on(){

  window.flag = 0;
  window.which_content = "profile";

  window.scroll_nav = false;
  remove_classes_main_image();
  remove_other_content();
  document.getElementsByClassName("front-end-section-label")[0].classList.add('front-end-section-label-one');
  document.getElementsByClassName("front-end-section-label")[0].style.display = "none";
  document.getElementById("carouselExampleControls").style.display = "none";

  $.ajax({
    type: "POST",
    url: "get_profile.php",
    success: function(back_data){
      window.scrollTo(0, 0);
      $('#main-section').append(back_data);
    },
    error: function(err) {
      console.log(err);
      console.log(err.responseText);
    }
  });

}

function change_password_profile(){

  if(document.getElementsByClassName("new_password")[0].value != "" && document.getElementsByClassName("old_password")[0].value != ""){

    $.ajax({
      type: "POST",
      url: "change_password_profile.php",
      data: {
        'new_password': document.getElementsByClassName("new_password")[0].value,
        'old_password': document.getElementsByClassName("old_password")[0].value
      },
      success: function(back_data){
        $('#main-section').append(back_data);
        profile_on();
        if($(".info_password")[0]){
          document.getElementsByClassName('info_password')[0].remove();
        }
      },
      error: function(err) {
        console.log(err);
        console.log(err.responseText);
      }
    });

  }else{
    alert("Incorect input");
  }

}

function add_advert_on(){

  window.flag = 0;
  window.which_content = "add_advert";

  window.scroll_nav = false;
  remove_classes_main_image();
  remove_other_content();
  document.getElementsByClassName("front-end-section-label")[0].classList.add('front-end-section-label-one');
  document.getElementsByClassName("front-end-section-label")[0].style.display = "none";
  document.getElementById("carouselExampleControls").style.display = "none";

  $.ajax({
    type: "POST",
    url: "get_add_advert.php",
    success: function(back_data){
      $('#main-section').append(back_data);
    },
    error: function(err) {
      console.log(err);
      console.log(err.responseText);
    }
  });

}

function add_advert_transaction(){

  var everything_OK = true;
  var photo_name = "";

  if(document.getElementsByClassName("title_advert")[0].value == ""){
    everything_OK = false;
  }

  if(document.getElementsByClassName("place_name")[0].value == ""){
    everything_OK = false;
  }

  if(document.getElementsByClassName("description_advert")[0].value == ""){
    everything_OK = false;
  }

  if(sessionStorage.base64IMG == "" || typeof document.getElementsByClassName("photo_song")[0].files[0] == "undefined"){
    setBaseImgSong();
    sessionStorage.base64IMG = sessionStorage.base64IMGsong;
    photo_name = "stock_image.jpg"
  }else{
    photo_name = document.getElementsByClassName("photo_song")[0].files[0].name;
  }

  if(sessionStorage.errorIMGformat == 1){
    setBaseImgSong();
    sessionStorage.base64IMG = sessionStorage.base64IMGsong;
    photo_name = "stock_image.jpg"
  }

  if(everything_OK == true){
    $.ajax({
      type: "POST",
      url: "add_advert.php",
      data: {
        'title_advert': document.getElementsByClassName("title_advert")[0].value,
        'place_name': document.getElementsByClassName("place_name")[0].value,
        'description_advert': document.getElementsByClassName("description_advert")[0].value,
        'photo_advert_name': photo_name,
        'photo_advert_src': sessionStorage.base64IMG

      },
      success: function(back_data){
        $('#main-section').append(back_data);
        adverts_on();
        if($(".info_added_advert")[0]){
          document.getElementsByClassName('info_added_advert')[0].remove();
        }
      },
      error: function(err) {
        console.log(err);
        console.log(err.responseText);
      }
    });
  }else{
    alert("Please fill all fields");
  }

}

function add_service_on(){

  window.flag = 0;
  window.which_content = "add_service";

  window.scroll_nav = false;
  remove_classes_main_image();
  remove_other_content();
  document.getElementsByClassName("front-end-section-label")[0].classList.add('front-end-section-label-one');
  document.getElementsByClassName("front-end-section-label")[0].style.display = "none";
  document.getElementById("carouselExampleControls").style.display = "none";

  $.ajax({
    type: "POST",
    url: "get_add_service.php",
    success: function(back_data){
      $('#main-section').append(back_data);
    },
    error: function(err) {
      console.log(err);
      console.log(err.responseText);
    }
  });

}

function add_service_transaction(){

  var everything_OK = true;
  var photo_name;

  if(document.getElementsByClassName("title_service")[0].value == ""){
    everything_OK = false;
  }

  if(document.getElementsByClassName("place_name")[0].value == ""){
    everything_OK = false;
  }

  if(document.getElementsByClassName("description_service")[0].value == ""){
    everything_OK = false;
  }

  if(sessionStorage.base64IMG == "" || typeof document.getElementsByClassName("photo_song")[0].files[0] == "undefined"){
    setBaseImgSong();
    sessionStorage.base64IMG = sessionStorage.base64IMGsong;
    photo_name = "stock_image.jpg"
  }else{
    photo_name = document.getElementsByClassName("photo_song")[0].files[0].name;
  }

  if(sessionStorage.errorIMGformat == 1){
    setBaseImgSong();
    sessionStorage.base64IMG = sessionStorage.base64IMGsong;
    photo_name = "stock_image.jpg"
  }

  if(everything_OK == true){
    $.ajax({
      type: "POST",
      url: "add_service.php",
      data: {
        'title_service': document.getElementsByClassName("title_service")[0].value,
        'place_name': document.getElementsByClassName("place_name")[0].value,
        'description_service': document.getElementsByClassName("description_service")[0].value,
        'photo_service_name': photo_name,
        'photo_service_src': sessionStorage.base64IMG

      },
      success: function(back_data){
        $('#main-section').append(back_data);
        services_on();
        if($(".info_added_service")[0]){
          document.getElementsByClassName('info_added_service')[0].remove();
        }
      },
      error: function(err) {
        console.log(err);
        console.log(err.responseText);
      }
    });
  }else{
    alert("Please fill all fields");
  }

}

function add_song_on(){

  window.flag = 0;
  window.which_content = "add_song";

  window.scroll_nav = false;
  remove_classes_main_image();
  remove_other_content();
  document.getElementsByClassName("front-end-section-label")[0].classList.add('front-end-section-label-one');
  document.getElementsByClassName("front-end-section-label")[0].style.display = "none";
  document.getElementById("carouselExampleControls").style.display = "none";

  $.ajax({
    type: "POST",
    url: "get_add_song.php",
    success: function(back_data){
      $('#main-section').append(back_data);
    },
    error: function(err) {
      console.log(err);
      console.log(err.responseText);
    }
  });

}

function add_song_transaction(){

  var everything_OK = true;
  var photo_name;

  if(document.getElementsByClassName("title_song")[0].value == ""){
    everything_OK = false;
  }

  if(document.getElementsByClassName("description_song")[0].value == ""){
    everything_OK = false;
  }

  if(typeof document.getElementsByClassName("file_song")[0].files[0] == "undefined"){
    everything_OK = false;
  }

  if(sessionStorage.errorSONGformat == 1){
    everything_OK = false;
  }

  if(sessionStorage.base64IMG == "" || typeof document.getElementsByClassName("photo_song")[0].files[0] == "undefined"){
    setBaseImgSong();
    sessionStorage.base64IMG = sessionStorage.base64IMGsong;
    photo_name = "stock_image.jpg"
  }else{
    photo_name = document.getElementsByClassName("photo_song")[0].files[0].name;
  }

  if(sessionStorage.errorIMGformat == 1){
    setBaseImgSong();
    sessionStorage.base64IMG = sessionStorage.base64IMGsong;
    photo_name = "stock_image.jpg"
  }

  if(everything_OK == true){
    $.ajax({
      type: "POST",
      url: "add_song.php",
      data: {
        'title_song': document.getElementsByClassName("title_song")[0].value,
        'description_song': document.getElementsByClassName("description_song")[0].value,
        'photo_song_name': photo_name,
        'photo_song_src': sessionStorage.base64IMG,
        'file_song_url': sessionStorage.songURL

      },
      success: function(back_data){
        $('#main-section').append(back_data);
        songs_on();
        if($(".info_added_song")[0]){
          document.getElementsByClassName('info_added_song')[0].remove();
        }
      },
      error: function(err) {
        console.log(err);
        console.log(err.responseText);
      }
    });
  }else{
    alert("Please fill all fields");
  }

}

function delete_advert(advert_id){

  if(sessionStorage.language == "ENG"){
    if(confirm("Are you sure, you want to delete this advert?")){
      $.ajax({
        type: "POST",
        url: "delete_advert.php",
        data: {
          'advert_id': advert_id
        },
        success: function(back_data){
          console.log(back_data);
          main_site_on();
        },
        error: function(err) {
          console.log(err);
          console.log(err.responseText);
        }
      });
    }else{}
  }else if(sessionStorage.language == "PL"){
    if(confirm("Jesteś pewny, aby usunąć to ogłoszenie?")){
      $.ajax({
        type: "POST",
        url: "delete_advert.php",
        data: {
          'advert_id': advert_id
        },
        success: function(back_data){
          console.log(back_data);
          main_site_on();
        },
        error: function(err) {
          console.log(err);
          console.log(err.responseText);
        }
      });
    }else{}
  }


}

function user_archive_on(){

    if(window.which_content != "user_adverts_archive"){
      window.flag = 0;
    }
    window.which_content = "user_adverts_archive";

    window.scroll_nav = true;
    if(sessionStorage.language == "ENG"){
      document.getElementsByClassName("firstTitle")[0].innerHTML = "Your adverts archive";
    }else if(sessionStorage.language == "PL"){
      document.getElementsByClassName("firstTitle")[0].innerHTML = "Twoje archiwum ogłoszeń";
    }
    remove_classes_main_image();
    remove_other_content();
    document.getElementsByClassName("front-end-section-label")[0].classList.add('front-end-section-label-adverts');
    document.getElementById("carouselExampleControls").style.display = "none";

    $.ajax({
    type: "POST",
    url: "get_user_archived_adverts.php",
    data: {
      'offset': window.flag,
      'limit': 5
    },
    success: function(back_data){
      window.scrollTo(0, 0);
      $('#main-section').append(back_data);
    },
    error: function(err) {
      console.log(err);
      console.log(err.responseText);
    }
  });

}

function chat_on(){

    if(document.getElementById("single_chat_modal").style.display != "none"){
      document.getElementById("single_chat_modal").style.display = "none";
    }

    let modal = document.getElementById("main_chat_modal");
    let modal_background = document.getElementsByClassName("main_chat_modal_background")[0];
    let span = document.getElementsByClassName("close")[0];

    modal.style.display = "block";
    modal.style.paddingTop = "5%";
    modal.style.left = "0";
    modal.style.top = "0";

    modal_background.style.position = "fixed";
    modal_background.style.display = "block";
    modal_background.style.width = "100%";
    modal_background.style.height = "200%";
    modal_background.style.zIndex = "4";
    modal_background.style.backgroundColor = "rgba(0,0,0,0.5)";

    span.onclick = function() {
      modal.style.display = "none";
      modal_background.style.display = "none";
    }

    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
        modal_background.style.display = "none";
      }
    }

    $.ajax({
      type: "POST",
      url: "chat_list.php",
      success: function(back_data){
        if(!($(".main_chat_modal_body_mobile")[0])){
          $('.main_chat_modal_body').append(back_data);
        }
      },
      error: function(err) {
        console.log(err);
        console.log(err.responseText);
      }
    });

}

function start_chat(from_user_id, to_username){

  document.getElementById("main_chat_modal").style.display = "none";
  sessionStorage.scroll_down = 1;

  let single_modal = document.getElementById("single_chat_modal");
  let single_modal_background = document.getElementsByClassName("main_chat_modal_background")[0];
  let single_span = document.getElementsByClassName("single_close")[0];

  single_modal.style.display = "block";
  single_modal.style.paddingTop = "5%";
  single_modal.style.left = "0";
  single_modal.style.top = "0";

  single_modal_background.style.position = "fixed";
  single_modal_background.style.display = "block";
  single_modal_background.style.width = "100%";
  single_modal_background.style.height = "200%";
  single_modal_background.style.zIndex = "4";
  single_modal_background.style.backgroundColor = "rgba(0,0,0,0.5)";

  single_span.onclick = function() {
    single_modal.style.display = "none";
    single_modal_background.style.display = "none";
  }

  window.onclick = function(event) {
    if (event.target == single_modal) {
      single_modal.style.display = "none";
      single_modal_background.style.display = "none";
    }
  }

  if(sessionStorage.language == "ENG"){
    var username = "CHAT WITH " + to_username + "</span>";
  }else if(sessionStorage.language == "PL"){
    var username = "ROZMAWIASZ Z " + to_username + "</span>";
  }
  document.getElementsByClassName("single_chat_header")[0].innerHTML = username;

  document.getElementsByClassName("send_to_user")[0].setAttribute("onclick", "send_to_user(" + from_user_id + ", '"+ to_username + "')");

  $.ajax({
    type: "POST",
    url: "chat_start.php",
    data: {
      'from_user_id': from_user_id,
      'to_username': to_username
    },
    success: function(back_data){
      if($(".single_chat_modal_body")[0].innerHTML != ""){
        $(".single_chat_modal_body")[0].innerHTML = ""
      }
      $('.single_chat_modal_body').append(back_data);
      sessionStorage.from_user_id = from_user_id;
      sessionStorage.to_username = to_username;
    },
    error: function(err) {
      console.log(err);
      console.log(err.responseText);
    }
  });

}

function send_to_user(from_user_id, to_username){

  $.ajax({
    type: "POST",
    url: "send_to_user.php",
    data: {
      'from_user_id': from_user_id,
      'to_username': to_username,
      'content': document.getElementsByClassName("textarea_chat")[0].value
    },
    success: function(back_data){
      document.getElementsByClassName("textarea_chat")[0].value = "";
      $('.single_chat_modal_body').append(back_data);
    },
    error: function(err) {
      console.log(err);
      console.log(err.responseText);
    }
  });

}

function refresh_single_chat(from_user_id, to_username){
  $.ajax({
    type: "POST",
    url: "chat_start.php",
    data: {
      'from_user_id': from_user_id,
      'to_username': to_username
    },
    success: function(back_data){
      $('.single_chat_modal_body').html(back_data);
    },
    error: function(err) {
      console.log(err);
      console.log(err.responseText);
    }
  });
}

function logout_on(){

  if(sessionStorage.language == "ENG"){
    if (confirm('Do you want to log out ?')){
      $.ajax({
        type: "POST",
        url: "logout.php",
        success: function(){
          main_site_on();
          location.reload();
        },
        error: function(err) {
          console.log(err);
          console.log(err.responseText);
        }
      });
    } else { return; }
  }else if(sessionStorage.language == "PL"){
    if (confirm('Czy na pewno chcesz się wylogować?')){
      $.ajax({
        type: "POST",
        url: "logout.php",
        success: function(){
          main_site_on();
          location.reload();
        },
        error: function(err) {
          console.log(err);
          console.log(err.responseText);
        }
      });
    } else { return; }
  }
}
