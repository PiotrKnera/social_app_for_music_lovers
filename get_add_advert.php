<?php include_once 'db_connection.php';?>

<?php session_start(); ?>

<?php

echo "<div id='second_main_section' class='main-section-div profile_details'>";
  echo "<h1 class='profile_header text-center'><i class='bi bi-layout-text-window-reverse'></i></h1>";
  if($_SESSION['language'] == "ENG"){
    echo "<h1 class='profile_header text-center'>Add advert</h1><br>";
  }else if($_SESSION['language'] == "PL"){
    echo "<h1 class='profile_header text-center'>Dodaj ogłoszenie</h1><br>";
  }

  echo "<div class='row'>";
    echo "<div class='container'>";
      echo "<div class='main_box author_box'>";
        echo "<div class='col-lg-12 col-md-12 col-sm-12 text-center'>";

                if($_SESSION['language'] == "ENG"){
                  echo "<label for='title_advert'>Title </label><br>";
                }else if($_SESSION['language'] == "PL"){
                  echo "<label for='title_advert'>Tytuł </label><br>";
                }
                echo "<input class='title_advert' type='text' id='title_advert' name='title_advert' maxlength='50' required><br><br>";

                if($_SESSION['language'] == "ENG"){
                  echo "<label for='place_name'>Place name</label><br>";
                }else if($_SESSION['language'] == "PL"){
                  echo "<label for='place_name'>Nazwa miejsca</label><br>";
                }
                echo "<input id='place_name' class='place_name' name='place_name' maxlength='100' type='text'><br><br>";

                if($_SESSION['language'] == "ENG"){
                  echo "<label for='description_advert'>Description</label><br>";
                }else if($_SESSION['language'] == "PL"){
                  echo "<label for='description_advert'>Opis</label><br>";
                }
                echo "<textarea name='description_advert' class='description_advert' maxlength='500' rows='5'></textarea><br><br>";

                if($_SESSION['language'] == "ENG"){
                  echo "<label for='photo_song'>Photo</label><br><br>";
                }else if($_SESSION['language'] == "PL"){
                  echo "<label for='photo_song'>Zdjęcie</label><br><br>";
                }
                echo "<input id='photo_song' class='photo_song btn btn-primary' name='photo_song' type='file' onchange='previewFile()'><br>";
                echo "<img src='images/stock_image.jpg' class='preview_file_song' alt='Image preview...'><br>";

                if($_SESSION['language'] == "ENG"){
                  echo "<button type='button' class='btn btn-primary btn-lg' onclick='add_advert_transaction()'>Add advert</button>";
                }else if($_SESSION['language'] == "PL"){
                  echo "<button type='button' class='btn btn-primary btn-lg' onclick='add_advert_transaction()'>Dodaj ogłoszenie</button>";
                }



        echo "</div>";
      echo "</div>";
    echo "</div>";
  echo "</div>";



?>
