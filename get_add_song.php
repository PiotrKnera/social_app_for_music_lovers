<?php include_once 'db_connection.php';?>

<?php session_start(); ?>

<?php

$data = $conn->prepare("SELECT username FROM users WHERE id_user = :user_id");
$data->bindParam(":user_id", $_SESSION['user_id'], PDO::PARAM_INT);
$data->execute();
$username = $data->fetchColumn();

echo "<div id='second_main_section' class='main-section-div profile_details'>";
  echo "<h1 class='profile_header text-center'><i class='bi bi-file-music'></i></h1>";
  if($_SESSION['language'] == "ENG"){
    echo "<h1 class='profile_header text-center'>Add song</h1><br>";
  }else if($_SESSION['language'] == "PL"){
    echo "<h1 class='profile_header text-center'>Dodaj utwór muzyczny</h1><br>";
  }
  echo "<div class='row'>";
    echo "<div class='container'>";
      echo "<div class='main_box author_box'>";
        echo "<div class='col-lg-12 col-md-12 col-sm-12 text-center'>";

                if($_SESSION['language'] == "ENG"){
                  echo "<label for='title_song'>Title </label><br>";
                }else if($_SESSION['language'] == "PL"){
                  echo "<label for='title_song'>Tytuł </label><br>";
                }
                echo "<input class='title_song' type='text' id='title_song' name='title_song' maxlength='50' required><br><br>";

                if($_SESSION['language'] == "ENG"){
                  echo "<label for='description_song'>Description</label><br>";
                }else if($_SESSION['language'] == "PL"){
                  echo "<label for='description_song'>Opis</label><br>";
                }
                echo "<textarea name='description_song' class='description_song' maxlength='500' rows='5'></textarea>";

                if($_SESSION['language'] == "ENG"){
                  echo "<label for='photo_song'>Photo</label><br><br>";
                }else if($_SESSION['language'] == "PL"){
                  echo "<label for='photo_song'>Zdjęcie</label><br><br>";
                }
                echo "<input id='photo_song' class='photo_song btn btn-primary' name='photo_song' type='file' onchange='previewFile()'><br>";
                echo "<img src='images/stock_image.jpg' class='preview_file_song' alt='Image preview...'>";

                if($_SESSION['language'] == "ENG"){
                  echo "<label for='file_song'>Song MP3</label><br><br>";
                }else if($_SESSION['language'] == "PL"){
                  echo "<label for='file_song'>Utwór muzyczny MP3</label><br><br>";
                }
                echo "<input type='file' onchange='uploadData(\"" . $username . "\")' id='file_song' class='file_song btn btn-primary' name='Files[]' required><br><br>";

                if($_SESSION['language'] == "ENG"){
                  echo "<button type='button' class='btn btn-primary btn-lg' onclick='add_song_transaction()'>Add song</button>";
                }else if($_SESSION['language'] == "PL"){
                  echo "<button type='button' class='btn btn-primary btn-lg' onclick='add_song_transaction()'>Dodaj utwór muzyczny</button>";
                }

        echo "</div>";
      echo "</div>";
    echo "</div>";
  echo "</div>";



?>
