<?php include_once 'db_connection.php';?>


<?php session_start(); ?>

<?php

if(isset($_POST['song_id']) && isset($_POST['counter_block']) && isset($_POST['limit_comment']) && isset($_POST['offset_comment'])){

  $song_id = $_POST['song_id'];
  $counter_block = $_POST['counter_block'];
  $limit_comment = $_POST['limit_comment'];
  $offset_comment = $_POST['offset_comment'];

  $data = $conn->prepare("SELECT id_author FROM adverts WHERE id_advert = :song_id");
  $data->bindParam(":song_id", $song_id, PDO::PARAM_INT);
  $data->execute();
  $author_id = $data->fetchColumn();

  $data = $conn->prepare("SELECT adv.id_advert, adv.advert_added_date, us.username, adv.description, adv.song_name, adv.song_address, img.photo_url, adv.likes FROM adverts AS adv
  INNER JOIN images AS img ON adv.id_advert = img.id_advert INNER JOIN users AS us ON adv.id_author = us.id_user WHERE adv.is_song = 1 AND adv.id_advert = :song_id");
  $data->bindParam(":song_id", $song_id, PDO::PARAM_INT);
  $data->execute();

  echo "<div id='second_main_section' class='main-section-div service_details'>";
  if($_SESSION['language'] == "ENG"){
    echo "<button type='button' class='btn btn-dark btn-lg back_button' onclick='songs_on()'><i class='bi bi-arrow-left'></i> Back to songs</button>";
  }else if($_SESSION['language'] == "PL"){
    echo "<button type='button' class='btn btn-dark btn-lg back_button' onclick='songs_on()'><i class='bi bi-arrow-left'></i> Powrót do utworów muzycznych</button>";
  }
  while ($row = $data->fetch(PDO::FETCH_ASSOC))
  {
    $counter1 = 0;
    echo "<div class='row'>";
      echo "<div class='container'>";
          echo "<div class='main_box right_image'>";

                  // fileds/cells //
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
                        echo "<span class='advert_description'>Description:</span><br><p class='description'>" . $value ."</p>";
                      }else if($_SESSION['language'] == "PL"){
                        echo "<span class='advert_description'>Opis:</span><br><p class='description'>" . $value ."</p>";
                      }
                    }

                    if($counter1 == 5){
                      if((isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] == 1) || $author_id == $_SESSION["user_id"]){
                        if($_SESSION['language'] == "ENG"){
                          echo "<button type='button' class='btn btn-danger btn-lg details' onclick='delete_advert(" . $advert_id . ")'>Delete song</button>";
                        }else if($_SESSION['language'] == "PL"){
                          echo "<button type='button' class='btn btn-danger btn-lg details' onclick='delete_advert(" . $advert_id . ")'>Usuń utwór muzyczny</button>";
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
  echo "</div>";

  // author section
  $data = $conn->prepare("SELECT DISTINCT us.username, us.name, us.surname, us.email, us.phone FROM users AS us INNER JOIN adverts AS adv ON adv.id_author = us.id_user
  WHERE adv.is_song = 1 AND adv.id_author = :user_id ");
  $data->bindParam(":user_id", $author_id, PDO::PARAM_INT);
  $data->execute();

  echo "<div id='third_main_section' class='author_section'>";
  while ($row = $data->fetch(PDO::FETCH_ASSOC))
  {
    $counter1 = 0;
    echo "<div class='row'>";
      echo "<div class='container'>";
          echo "<div class='main_box author_box'>";

                  // fileds/cells //
                  foreach ($row as $field => $value){
                    ++$counter1;

                      if($counter1 == 1){
                        $username_author = $value;
                        echo "<div class='col-lg-6 col-md-12 col-sm-12'>";
                        if($_SESSION['language'] == "ENG"){
                          echo "<p class='about_author'>About author</p>";
                          echo "<span>Username:</span> <span>" . $value ."</span><br>";
                        }else if($_SESSION['language'] == "PL"){
                          echo "<p class='about_author'>O autorze</p>";
                          echo "<span>Pseudonim:</span>&nbsp; <span>" . $value ."</span><br>";
                        }
                      }

                    if($counter1 == 2){
                      if($_SESSION['language'] == "ENG"){
                        echo "<span>Name:</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $value ."</span><br>";
                      }else if($_SESSION['language'] == "PL"){
                        echo "<span>Imię:</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp" . $value ."</span><br>";
                      }
                    }

                    if($counter1 == 3){
                      if($_SESSION['language'] == "ENG"){
                        echo "<span>Surame:</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $value ."</span><br>";
                      }else if($_SESSION['language'] == "PL"){
                        echo "<span>Nazwisko:</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $value ."</span><br>";
                      }
                    }

                    if($counter1 == 4){
                      if($_SESSION['language'] == "ENG"){
                        echo "<span>Email:</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $value ."</span><br>";
                      }else if($_SESSION['language'] == "PL"){
                        echo "<span>Email:</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $value ."</span><br>";
                      }
                    }

                    if($counter1 == 5){
                      if($_SESSION['language'] == "ENG"){
                        echo "<span style='margin-bottom: 5%;'>Phone:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>" . $value ."</span><br>";
                      }else if($_SESSION['language'] == "PL"){
                        echo "<span style='margin-bottom: 5%;'>Telefon:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>" . $value ."</span><br>";
                      }
                      echo "</div>";
                      echo "<div class='col-lg-6 col-md-12 col-sm-12 text-center'>";
                        if((isset($_SESSION["user_id"]))){
                          if($_SESSION["user_id"] != $author_id){
                            if($_SESSION['language'] == "ENG"){
                              echo "<button type='button' class='btn btn-primary btn-lg details btn_chat' onclick='start_chat(" . $_SESSION['user_id'] . ", \"" . $username_author. "\")'>Start Chat</button>";
                            }else if($_SESSION['language'] == "PL"){
                              echo "<button type='button' class='btn btn-primary btn-lg details btn_chat' onclick='start_chat(" . $_SESSION['user_id'] . ", \"" . $username_author. "\")'>Rozpocznij czat</button>";
                            }
                          }
                        }
                      echo "</div>";
                    }
                  }
        echo "</div>";
      echo "</div>";
    echo "</div>";
  }

    echo "<div class='comment_send'>";
      echo "<hr>";
      if($_SESSION['language'] == "ENG"){
        echo "<h2 class='comments_header text-center'>Comments</h2>";
      }else if($_SESSION['language'] == "PL"){
        echo "<h2 class='comments_header text-center'>Komentarze</h2>";
      }
      echo "<div class='row'>";
        echo "<div class='container'>";
          echo "<div class='main_box author_box'>";
            echo "<div class='col-lg-12 col-md-12 col-sm-12 text-center'>";

              echo "<textarea class='textarea_comment' maxlength='200' rows='5' ;></textarea>";

              echo "<div class='col-lg-12 col-md-12 col-sm-12 text-center'>";
                if($_SESSION['language'] == "ENG"){
                  echo "<button type='button' class='btn btn-primary btn-lg' onclick='add_comment_to_song(" . $advert_id . ", " . $_SESSION['user_id'] . ", " . $counter_block . ")'>Send comment</button>";
                }else if($_SESSION['language'] == "PL"){
                  echo "<button type='button' class='btn btn-primary btn-lg' onclick='add_comment_to_song(" . $advert_id . ", " . $_SESSION['user_id'] . ", " . $counter_block . ")'>Wyślij komentarz</button>";
                }
              echo "</div>";

            echo "</div>";
          echo "</div>";
        echo "</div>";
      echo "</div>";
    echo "</div>";


    $data_all = $conn->prepare("SELECT com.id_com_advert, com.comment_added_date, us.username, com.content FROM users AS us INNER JOIN commented_adverts AS com ON com.id_user = us.id_user
    WHERE com.id_advert = :song_id ORDER BY com.comment_added_date DESC");
    $data_all->bindParam(":song_id", $song_id, PDO::PARAM_INT);
    $data_all->execute();
    $results = $data_all->rowCount();

    $counter_block_comment = 0;

    $data = $conn->prepare("SELECT com.id_com_advert, com.comment_added_date, us.username, com.content FROM users AS us INNER JOIN commented_adverts AS com ON com.id_user = us.id_user
    WHERE com.id_advert = :song_id ORDER BY com.comment_added_date DESC LIMIT {$limit_comment} OFFSET {$offset_comment}");
    $data->bindParam(":song_id", $song_id, PDO::PARAM_INT);
    $data->execute();


    echo "<div class='comment_section'>";
      while ($row = $data->fetch(PDO::FETCH_ASSOC))
      {
        ++$counter_block_comment;
        $counter1 = 0;
        echo "<div class='row'>";
          echo "<div class='container'>";
            echo "<div class='main_box author_box'>";
              echo "<div class='col-lg-12 col-md-12 col-sm-12'>";
                foreach ($row as $field => $value){
                  ++$counter1;

                  if($counter1 == 1){
                    $comment_id = $value;
                  }

                  if($counter1 == 2){
                    $comment_date = $value;
                    echo "<span class='comment_date'>" . $value ."</span><br>";
                  }

                  if($counter1 == 3){
                    echo "<span class='comment_author'>" . $value ."</span><br><br>";
                  }

                  if($counter1 == 4){
                    $comment_content = $value;
                    echo "<span class='comment_content'>" . $value ."</span><br>";

                    if(isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] == 1){
                      if($_SESSION['language'] == "ENG"){
                        echo "<button type='button' class='btn btn-danger btn-lg details' onclick='delete_comment_from_song(" . $song_id . ", " . $comment_id . ", " . $counter_block .  ")'>Delete comment</button>";
                      }else if($_SESSION['language'] == "PL"){
                        echo "<button type='button' class='btn btn-danger btn-lg details' onclick='delete_comment_from_song(" . $song_id . ", " . $comment_id . ", " . $counter_block .  ")'>Usuń komentarz</button>";
                      }
                    }
                  }

                }
              echo "</div>";
            echo "</div>";
          echo "</div>";
        echo "</div>";
      }
    echo "</div>";

  echo "</div>";


  $loaded_song_comments = $counter_block_comment  + $offset_comment;

  // writing bottom navigations
    echo "<div class='second_bottom_nav'>";
      echo "<div class='row second_bottom_nav'>";
        echo "<div class='container'>";
          echo "<div class='bottom_nav'>";
            echo "<div class='col-lg-4 col-md-4 col-sm-4 text-center'>";
              if($loaded_song_comments > 5){
                if($_SESSION['language'] == "ENG"){
                  echo "<button type='button' class='btn btn-dark btn-lg' onclick='previous_comments_song(" . $song_id . ", " . $counter_block  . ")'>Previous</button>";
                }else if($_SESSION['language'] == "PL"){
                  echo "<button type='button' class='btn btn-dark btn-lg' onclick='previous_comments_song(" . $song_id . ", " . $counter_block  . ")'>Poprzednia</button>";
                }
              }
            echo "</div>";
            echo "<div class='col-lg-4 col-md-4 col-sm-4'>";
              if($loaded_song_comments  > $results){
                $loaded_song_comments  = $results;
              }
              echo "<p class='bottom_nav_pages'>" . $loaded_song_comments  . "/" . $results . "</p>";
            echo "</div>";
            echo "<div class='col-lg-4 col-md-4 col-sm-4 text-center'>";
              if($loaded_song_comments  < $results){
                if($_SESSION['language'] == "ENG"){
                  echo "<button type='button' class='btn btn-dark btn-lg' onclick='next_comments_song(" . $song_id . ", " . $counter_block  . ")'>Next</button>";
                }else if($_SESSION['language'] == "PL"){
                  echo "<button type='button' class='btn btn-dark btn-lg' onclick='next_comments_song(" . $song_id . ", " . $counter_block  . ")'>Następna</button>";
                }
              }
            echo "</div>";
          echo "</div>";
        echo "</div>";
      echo "</div>";
    echo "</div>";

}

 ?>
