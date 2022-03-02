var storageRef;
var file_name;

function getURL(file_name){
  let music_name = file_name;
  window.storageRef.child(music_name).getDownloadURL().then(url=>{
      sessionStorage.songURL = url;
  }).catch(e=>{
      console.log("error: " + e);
  });
}

function uploadData(username){

  window.storageRef = firebase.storage().ref(username);
  let file = document.getElementById('file_song').files[0];

  file_name = file.name;
  let format_file = file_name.substr(-3);

  if(format_file == "mp3"){
    sessionStorage.errorSONGformat = 0;
    let thisRef = storageRef.child(file.name);
    thisRef.put(file).then(res=>{
      getURL(document.getElementsByClassName("file_song")[0].files[0].name);
      if(sessionStorage.language == "ENG"){
        alert("The song has been successfully loaded.");
      }else if(sessionStorage.language == "PL"){
        alert("Utwór muzyczny został dodany.");
      }
    }).catch(e=>{
      if(sessionStorage.language == "ENG"){
        alert("FAILED\nerror: " + e);
      }else if(sessionStorage.language == "PL"){
        alert("NIEPOWODZENIE\nbłąd: " + e);
      }
    });
  }else{
    if(sessionStorage.language == "ENG"){
      alert("Song must be added in mp3 format");
    }else if(sessionStorage.language == "PL"){
      alert("Utwór muzyczny musi być dodany w formacieMP3.");
    }
    sessionStorage.errorSONGformat = 1;
  }
}



function previewFile() {
  let photo_file_name = document.getElementsByClassName("photo_song")[0].files[0].name;
  let format_photo_file = photo_file_name.substr(-3);

  if(format_photo_file != "jpg" && format_photo_file != "png"){
    if(sessionStorage.language == "ENG"){
      alert("Photo must be added in jpg or png format");
    }else if(sessionStorage.language == "PL"){
      alert("Fotografia musi być dodana w formacie jpg lub png.");
    }
    sessionStorage.errorIMGformat = 1;
  }
  else{
    sessionStorage.errorIMGformat = 0;
    const preview = document.getElementsByClassName("preview_file_song")[0];
    const file = document.querySelector('input[type=file]').files[0];
    const reader = new FileReader();

    reader.addEventListener("load", function () {
      preview.src = reader.result;
      sessionStorage.base64IMG = preview.src;
    }, false);

    if (file) {
      reader.readAsDataURL(file);
    }

  }

}
