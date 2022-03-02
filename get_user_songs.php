<?php include_once 'db_connection.php';?>

<?php session_start(); ?>

<?php

if(isset($_POST['offset']) && isset($_POST['limit'])){

  $limit = $_POST['limit'];
  $offset = $_POST['offset'];


  $data_all = $conn->prepare("SELECT adv.advert_added_date, us.username, adv.description, adv.song_name, adv.song_address, img.photo_url, adv.likes FROM adverts AS adv
  INNER JOIN images AS img ON adv.id_advert = img.id_advert INNER JOIN users AS us ON adv.id_author = us.id_user
  WHERE adv.is_song = 1 AND adv.id_author = :id_user");
  $data_all->bindParam(":id_user", $_SESSION['user_id'], PDO::PARAM_INT);
  $data_all->execute();
  $results = $data_all->rowCount();


  // columns //
  $data = $conn->prepare("SELECT adv.id_advert, adv.advert_added_date, us.username, adv.description, adv.song_name, adv.song_address, img.photo_url, adv.likes FROM adverts AS adv
  INNER JOIN images AS img ON adv.id_advert = img.id_advert INNER JOIN users AS us ON adv.id_author = us.id_user
  WHERE adv.is_song = 1 AND adv.id_author = :id_user ORDER BY adv.advert_added_date DESC LIMIT {$limit} OFFSET {$offset}");
  $data->bindParam(":id_user", $_SESSION['user_id'], PDO::PARAM_INT);
  $data->execute();

  $counter_block = 0;

  echo "<div id='second_main_section' class='main-section-div'>";
  while ($row = $data->fetch(PDO::FETCH_ASSOC))
  {
    ++$counter_block;
    $counter1 = 0;
    echo "<div class='row'>";
      echo "<div class='container'>";
        if($counter_block % 2 != 0){
          echo "<div class='main_box right_image'>";
        }else{
          echo "<div class='main_box left_image'>";
        }
                  foreach ($row as $field => $value){
                    ++$counter1;

                    if((isset($_SESSION["user_id"]))){

                      if($counter1 == 1){
                        $advert_id  = $value;
                      }

                    }

                    if($counter1 == 2){
                      echo "<div class='col-lg-6 col-md-12 col-sm-12 col-pad'>";
                      if($_SESSION['language'] == "ENG"){
                        echo "<span>Added:</span> <span>" . $value ."</span><br>";
                      }else if($_SESSION['language'] == "PL"){
                        echo "<span>Dodano:</span><span>" . $value ."</span><br>";
                      }
                    }

                    if($counter1 == 3){
                      if($_SESSION['language'] == "ENG"){
                        echo "<span>Author:</span><span>" . $value ."</span><br><br><br>";
                      }else if($_SESSION['language'] == "PL"){
                        echo "<span>Autor:</span> <span>&nbsp;&nbsp;&nbsp;" . $value ."</span><br><br><br>";
                      }
                    }

                    if($counter1 == 4){
                      if($_SESSION['language'] == "ENG"){
                        if(strlen($value) >= 100){
                          echo "<span class='advert_description'>Description:</span><br><p class='description'>" . substr($value, 0, 100) ." ...</p>";
                        }else{
                          echo "<span class='advert_description'>Description:</span><br><p class='description'>" . $value . "</p>";
                        }
                      }else if($_SESSION['language'] == "PL"){
                        if(strlen($value) >= 100){
                          echo "<span class='advert_description'>Opis:</span><br><p class='description'>" . substr($value, 0, 100) ." ...</p>";
                        }else{
                          echo "<span class='advert_description'>Opis:</span><br><p class='description'>" . $value . "</p>";
                        }
                      }
                    }

                    if($counter1 == 5){
                      if((isset($_SESSION["user_id"]))){
                        if($_SESSION['language'] == "ENG"){
                          echo "<button type='button' class='btn btn-primary btn-lg details' onclick='one_song_on(" . $advert_id . ", " . $counter_block . ")'>Check details</button>";
                        }else if($_SESSION['language'] == "PL"){
                          echo "<button type='button' class='btn btn-primary btn-lg details' onclick='one_song_on(" . $advert_id . ", " . $counter_block . ")'>Sprawdź szczegóły</button>";
                        }
                      }
                      echo "</div>";
                      echo "<div class='col-lg-6 col-md-12 col-sm-12 col-pad text-center'>";
                      echo "<p class='advert_title'>" . $value ."</p>";

                    }

                    if($counter1 == 6){
                      if((isset($_SESSION['user_id']))){
                        echo "<audio class='song_player' controls src='" . $value . "'>";
                      }else{
                        echo "<audio class='song_player' controls controlsList='nodownload' src='" . $value . "'>";
                      }
                      echo  "Sorry, your browser doesn't support audio file!";
                      echo "</audio>";
                    }

                    if($counter1 == 7){
                      echo "<img class='intro_image advert_image song_image' src='data:image/jpg;base64, " . $value . "' alt='picture'>";
                    }

                    if($counter1 == 8){
                      if((isset($_SESSION["user_id"]))){
                        echo "<span class='service_likes clickable_service_likes " . $counter_block . "' onclick='like_on(" . $advert_id . ", this)'>" . $value . " <i class='bi bi-hand-thumbs-up-fill text-center'></i></span>";
                      }
                      else{
                        echo "<span class='service_likes'>" . $value . " <i class='bi bi-hand-thumbs-up-fill text-center'></i></span>";
                      }
                      echo "</div>";
                    }
                  }
        echo "</div>";
      echo "</div>";
    echo "</div>";
  }

  $loaded_adverts = $counter_block  + $offset;

  // writing bottom navigations
    echo "<div class='second_bottom_nav'>";
      echo "<div class='row second_bottom_nav'>";
        echo "<div class='container'>";
          echo "<div class='bottom_nav'>";
            echo "<div class='col-lg-4 col-md-4 col-sm-4 text-center'>";
              if($loaded_adverts > 5){
                if($_SESSION['language'] == "ENG"){
                  echo "<button type='button' class='btn btn-dark btn-lg' onclick='previous_adverts()'>Previous</button>";
                }else if($_SESSION['language'] == "PL"){
                  echo "<button type='button' class='btn btn-dark btn-lg' onclick='previous_adverts()'>Poprzednia</button>";
                }
              }
            echo "</div>";
            echo "<div class='col-lg-4 col-md-4 col-sm-4'>";
              if($loaded_adverts > $results){
                $loaded_adverts = $results;
              }
              echo "<p class='bottom_nav_pages'>" . $loaded_adverts . "/" . $results . "</p>";
            echo "</div>";
            echo "<div class='col-lg-4 col-md-4 col-sm-4 text-center'>";
              if($loaded_adverts < $results){
                if($_SESSION['language'] == "ENG"){
                  echo "<button type='button' class='btn btn-dark btn-lg' onclick='next_adverts()'>Next</button>";
                }else if($_SESSION['language'] == "PL"){
                  echo "<button type='button' class='btn btn-dark btn-lg' onclick='next_adverts()'>Następna</button>";
                }
              }
            echo "</div>";
          echo "</div>";
        echo "</div>";
      echo "</div>";
    echo "</div>";

}

 ?>
