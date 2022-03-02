<?php include_once 'db_connection.php';?>


<?php session_start(); ?>

<?php

if(isset($_POST['advert_id'])){

  $advert_id = $_POST['advert_id'];

  $data = $conn->prepare("SELECT id_author FROM adverts WHERE id_advert = :advert_id");
  $data->bindParam(":advert_id", $advert_id, PDO::PARAM_INT);
  $data->execute();
  $author_id = $data->fetchColumn();

  $data = $conn->prepare("SELECT adv.id_advert, adv.advert_added_date, us.username, adv.place_name, adv.description, adv.advert_name, img.photo_url FROM adverts AS adv
  INNER JOIN images AS img ON adv.id_advert = img.id_advert INNER JOIN users AS us ON adv.id_author = us.id_user
  WHERE adv.is_musical_instrument = 1 AND adv.id_advert = :advert_id");
  $data->bindParam(":advert_id", $advert_id, PDO::PARAM_INT);
  $data->execute();

  echo "<div id='second_main_section' class='main-section-div service_details'>";
  if($_SESSION['language'] == "ENG"){
    echo "<button type='button' class='btn btn-dark btn-lg back_button' onclick='adverts_on()'><i class='bi bi-arrow-left'></i> Back to adverts</button>";
  }else if($_SESSION['language'] == "PL"){
    echo "<button type='button' class='btn btn-dark btn-lg back_button' onclick='adverts_on()'><i class='bi bi-arrow-left'></i> Powrót do ogłoszeń</button>";
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
                        $advert_id2  = $value;
                      }

                    }

                    if($counter1 == 2){
                      echo "<div class='col-lg-6 col-md-12 col-sm-12 col-pad'>";
                      if($_SESSION['language'] == "ENG"){
                        echo "<span>Added:</span> <span>" . $value ."</span><br>";
                      }else if($_SESSION['language'] == "PL"){
                        echo "<span>Dodano:</span>&nbsp; <span>" . $value ."</span><br>";
                      }
                    }

                    if($counter1 == 3){
                      if($_SESSION['language'] == "ENG"){
                        echo "<span>Author:</span><span>" . $value ."</span><br>";
                      }else if($_SESSION['language'] == "PL"){
                        echo "<span>Autor:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>" . $value ."</span><br>";
                      }
                    }

                    if($counter1 == 4){
                      if($_SESSION['language'] == "ENG"){
                        echo "<span>Place:</span>&nbsp;&nbsp;&nbsp;<span>" . $value ."</span><br><br><br>";
                      }else if($_SESSION['language'] == "PL"){
                        echo "<span>Miejsce:</span>&nbsp;&nbsp;&nbsp;<span>" . $value ."</span><br><br><br>";
                      }
                    }

                    if($counter1 == 5){
                      if($_SESSION['language'] == "ENG"){
                        echo "<span class='advert_description'>Description:</span><br><p class='description'>" . $value ."</p>";
                      }else if($_SESSION['language'] == "PL"){
                        echo "<span class='advert_description'>Opis:</span><br><p class='description'>" . $value ."</p>";
                      }
                    }

                    if($counter1 == 6){
                      if((isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] == 1) || $author_id == $_SESSION["user_id"]){
                        if($_SESSION['language'] == "ENG"){
                          echo "<button type='button' class='btn btn-danger btn-lg details' onclick='delete_advert(" . $advert_id2 . ")'>Delete advert</button>";
                        }else if($_SESSION['language'] == "PL"){
                          echo "<button type='button' class='btn btn-danger btn-lg details' onclick='delete_advert(" . $advert_id2 . ")'>Usuń ogłoszenie</button>";
                        }
                      }
                      echo "</div>";
                      echo "<div class='col-lg-6 col-md-12 col-sm-12 text-center'>";
                      echo "<p class='advert_title'>" . $value ."</p>";

                    }

                    if($counter1 == 7){
                      echo "<img class='intro_image advert_image' src='data:image/jpg;base64, " . $value . "' alt='picture'>";
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
  WHERE adv.is_musical_instrument = 1 AND adv.id_author = :user_id ");
  $data->bindParam(":user_id", $author_id, PDO::PARAM_INT);
  $data->execute();

  echo "<div id='third_main_section' class='author_section'>";
  while ($row = $data->fetch(PDO::FETCH_ASSOC))
  {
    $counter1 = 0;
    echo "<div class='row'>";
      echo "<div class='container'>";
          echo "<div class='main_box author_box'>";

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

  if($_SESSION["user_id"] == $author_id){
    $_SESSION['is_author'] = true;
  }else{
    $_SESSION['is_author'] = false;
  }

  echo "<div class='advert_transaction'>";
    echo "<hr>";
    if($_SESSION['is_author'] == true){
      if($_SESSION['language'] == "ENG"){
        echo "<h2 class='comments_header text-center'>Transaction (This is your advert)</h2>";
      }else if($_SESSION['language'] == "PL"){
        echo "<h2 class='comments_header text-center'>Transakcja (twojego ogłoszenia)</h2>";
      }
    }else{
      if($_SESSION['language'] == "ENG"){
        echo "<h2 class='comments_header text-center'>Transaction</h2>";
      }else if($_SESSION['language'] == "PL"){
        echo "<h2 class='comments_header text-center'>Transakcja</h2>";
      }
    }

  if($_SESSION['is_author'] == true){
    $_SESSION['transaction_with_you'] = true;

    $stmt = $conn->prepare("SELECT id_user_requested FROM transaction_adverts WHERE id_advert = :advert_id AND id_author = :author_id");
    $stmt->bindParam(":advert_id", $advert_id, PDO::PARAM_INT);
    $stmt->bindParam(":author_id", $author_id, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->rowCount();
    $_SESSION['results'] = $results;

    if($results > 0){
      $_SESSION['any_transaction'] = 1;
      if($results > 1){
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
          $counter1 = 0;
          foreach ($row as $field => $value){
            ++$counter1;

            $id_user_requested = $value;


            $data = $conn->prepare("SELECT username, name, surname, email, phone FROM users WHERE id_user = :id_user_requested ");
            $data->bindParam(":id_user_requested", $id_user_requested, PDO::PARAM_INT);
            $data->execute();

            while ($row = $data->fetch(PDO::FETCH_ASSOC))
            {
              $counter2 = 0;
              echo "<div class='row'>";
                echo "<div class='container'>";
                    echo "<div class='main_box author_box'>";

                            foreach ($row as $field => $value){
                              ++$counter2;

                                if($counter2 == 1){
                                  echo "<div class='col-lg-6 col-md-12 col-sm-12'>";
                                  if($_SESSION['language'] == "ENG"){
                                    echo "<p class='about_author'>User requested</p>";
                                  }else if($_SESSION['language'] == "PL"){
                                    echo "<p class='about_author'>Użytkownik pytający</p>";
                                  }
                                  echo "<span>Username:</span> <span>" . $value ."</span><br>";
                                }

                              if($counter2 == 2){
                                if($_SESSION['language'] == "ENG"){
                                  echo "<span>Name:</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $value ."</span><br>";
                                }else if($_SESSION['language'] == "PL"){
                                  echo "<span>Imię:</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $value ."</span><br>";
                                }
                              }

                              if($counter2 == 3){
                                if($_SESSION['language'] == "ENG"){
                                  echo "<span>Surame:</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $value ."</span><br>";
                                }else if($_SESSION['language'] == "PL"){
                                  echo "<span>Nazwisko:</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $value ."</span><br>";
                                }
                              }

                              if($counter2 == 4){
                                if($_SESSION['language'] == "ENG"){
                                  echo "<span>Email:</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $value ."</span><br>";
                                }else if($_SESSION['language'] == "PL"){
                                  echo "<span>Email:</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $value ."</span><br>";
                                }
                              }

                              if($counter2 == 5){
                                if($_SESSION['language'] == "ENG"){
                                  echo "<span style='margin-bottom: 5%;'>Phone:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>" . $value ."</span><br>";
                                }else if($_SESSION['language'] == "PL"){
                                  echo "<span style='margin-bottom: 5%;'>Phone:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>" . $value ."</span><br>";
                                }
                                echo "</div>";
                                echo "<div class='col-lg-6 col-md-12 col-sm-12 text-center'>";
                                  if($_SESSION['language'] == "ENG"){
                                      if((isset($_SESSION["user_id"]))){
                                          echo "<button type='button' class='btn btn-primary btn-lg details btn_chat' onclick='start_chat(" . $_SESSION['user_id'] . ", " . $id_user_requested . ")'>Start Chat</button>";
                                      }
                                      if((isset($_SESSION["user_id"]))){
                                          echo "<button type='button' class='btn btn-success btn-lg details btn_confirm_request' onclick='confirm_request(" . $advert_id . ", " . $author_id . ", " . $id_user_requested . ")'>Confirm request</button>";
                                      }
                                  }else if($_SESSION['language'] == "PL"){
                                    if((isset($_SESSION["user_id"]))){
                                        echo "<button type='button' class='btn btn-primary btn-lg details btn_chat' onclick='start_chat(" . $_SESSION['user_id'] . ", " . $id_user_requested . ")'>Rozpocznij czat</button>";
                                    }
                                    if((isset($_SESSION["user_id"]))){
                                        echo "<button type='button' class='btn btn-success btn-lg details btn_confirm_request' onclick='confirm_request(" . $advert_id . ", " . $author_id . ", " . $id_user_requested . ")'>Potwierdź zapytanie</button>";
                                    }
                                  }
                                echo "</div>";
                              }
                            }
                  echo "</div>";
                echo "</div>";
              echo "</div>";
            }


          }
        }

        $_SESSION['offer_start'] = 0;


      }else{
        $stmt = $conn->prepare("SELECT id_user_requested, offer_start, offer_confirmed, author_confirm_success, user_confirm_success FROM transaction_adverts WHERE id_advert = :advert_id AND id_author = :author_id");
        $stmt->bindParam(":advert_id", $advert_id, PDO::PARAM_INT);
        $stmt->bindParam(":author_id", $author_id, PDO::PARAM_INT);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
          $counter1 = 0;
          foreach ($row as $field => $value){
            ++$counter1;
              if($counter1 == 1){
                $_SESSION['id_user_requested'] = $value;
              }
              if($counter1 == 2){
                $_SESSION['offer_start'] = $value;
              }
              if($counter1 == 3){
                $_SESSION['offer_confirmed'] = $value;
              }
              if($counter1 == 4){
                $_SESSION['author_confirm_success'] = $value;
              }
              if($counter1 == 5){
                $_SESSION['user_confirm_success'] = $value;
              }
          }
        }

        if($_SESSION['offer_confirmed'] == 0 || $_SESSION['offer_start'] == 0){
          $stmt = $conn->prepare("SELECT username, name, surname, email, phone FROM users WHERE id_user = :id_user_requested ");
          $stmt->bindParam(":id_user_requested", $_SESSION['id_user_requested'], PDO::PARAM_INT);
          $stmt->execute();

          while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
          {
            $counter1 = 0;
            echo "<div class='row'>";
              echo "<div class='container'>";
                  echo "<div class='main_box author_box'>";

                          // fileds/cells //
                          foreach ($row as $field => $value){
                            ++$counter1;

                              if($counter1 == 1){
                                 $_SESSION['username_author'] = $value;
                                echo "<div class='col-lg-6 col-md-12 col-sm-12'>";
                                if($_SESSION['language'] == "ENG"){
                                  echo "<p class='about_author'>User requested</p>";
                                  echo "<span>Username:</span> <span>" . $value ."</span><br>";
                                }else if($_SESSION['language'] == "PL"){
                                  echo "<p class='about_author'>Użytkownik pytający</p>";
                                  echo "<span>Pseudonim:</span> <span>" . $value ."</span><br>";
                                }
                              }

                            if($counter1 == 2){
                              if($_SESSION['language'] == "ENG"){
                                echo "<span>Name:</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $value ."</span><br>";
                              }else if($_SESSION['language'] == "PL"){
                                echo "<span>Imię:</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $value ."</span><br>";
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
                                echo "<span>Email:</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $value ."</span><br>";
                              }
                            }

                            if($counter1 == 5){
                              if($_SESSION['language'] == "ENG"){
                                echo "<span style='margin-bottom: 5%;'>Phone:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>" . $value ."</span><br>";
                              }else if($_SESSION['language'] == "PL"){
                                echo "<span style='margin-bottom: 5%;'>Telefon:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>" . $value ."</span><br>";
                              }
                              echo "</div>";
                              echo "<div class='col-lg-6 col-md-12 col-sm-12 text-center'>";
                                if($_SESSION['language'] == "ENG"){
                                    if((isset($_SESSION["user_id"]))){
                                        echo "<button type='button' class='btn btn-primary btn-lg details btn_chat' onclick='start_chat(" . $_SESSION['user_id'] . ", " .  $_SESSION['username_author'] . ", " . $_SESSION['id_user_requested']. ")'>Start Chat</button>";
                                    }
                                    if((isset($_SESSION["user_id"]))){
                                        echo "<button type='button' class='btn btn-success btn-lg details btn_confirm_request' onclick='confirm_request(" . $advert_id . ", " . $author_id . ", " . $_SESSION['id_user_requested'] . ")'>Confirm request</button>";
                                    }
                                }else if($_SESSION['language'] == "PL"){
                                  if((isset($_SESSION["user_id"]))){
                                      echo "<button type='button' class='btn btn-primary btn-lg details btn_chat' onclick='start_chat(" . $_SESSION['user_id'] . ", " .  $_SESSION['username_author'] . ", " . $_SESSION['id_user_requested']. ")'>Rozpocznij zzat</button>";
                                  }
                                  if((isset($_SESSION["user_id"]))){
                                      echo "<button type='button' class='btn btn-success btn-lg details btn_confirm_request' onclick='confirm_request(" . $advert_id . ", " . $author_id . ", " . $_SESSION['id_user_requested'] . ")'>Potwierdź zapytanie</button>";
                                  }
                                }
                              echo "</div>";
                            }
                          }
                echo "</div>";
              echo "</div>";
            echo "</div>";
          }

        }

      }

    }else{
      $_SESSION['any_transaction'] = 0;
    }


  }else{
    $stmt = $conn->prepare("SELECT * FROM transaction_adverts WHERE id_advert = :advert_id AND id_author = :author_id");
    $stmt->bindParam(":advert_id", $advert_id, PDO::PARAM_INT);
    $stmt->bindParam(":author_id", $author_id, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->rowCount();
    $_SESSION['results'] = $results;

    if($results > 0){
      $_SESSION['any_transaction'] = 1;

      if($results == 1){
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
          $counter1 = 0;
              foreach ($row as $field => $value){
                ++$counter1;
                if($counter1 == 1){
                  $_SESSION['id_transaction_advert'] = $value;
                }
                if($counter1 == 2){
                  $_SESSION['id_advert'] = $value;
                }
                if($counter1 == 3){
                  $_SESSION['id_author'] = $value;
                }
                if($counter1 == 4){
                  $_SESSION['id_user_requested'] = $value;
                }
                if($counter1 == 5){
                  $_SESSION['offer_start'] = $value;
                }
                if($counter1 == 6){
                  $_SESSION['offer_confirmed'] = $value;
                }
                if($counter1 == 7){
                  $_SESSION['author_confirm_success'] = $value;
                }
                if($counter1 == 8){
                  $_SESSION['user_confirm_success'] = $value;
                }
                if($counter1 == 9){
                  $_SESSION['offer_success'] = $value;
                }
              }
            }

        if($_SESSION['id_user_requested'] == $_SESSION['user_id']){
          $_SESSION['transaction_with_you'] = true;
        }else{
          $_SESSION['transaction_with_you'] = false;
        }
      }else{
        $_SESSION['transaction_with_you'] = false;

        $stmt = $conn->prepare("SELECT * FROM transaction_adverts WHERE id_advert = :advert_id AND id_author = :author_id AND id_user_requested = :user_id");
        $stmt->bindParam(":advert_id", $advert_id, PDO::PARAM_INT);
        $stmt->bindParam(":author_id", $author_id, PDO::PARAM_INT);
        $stmt->bindParam(":user_id", $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->rowCount();

        if($results == 1){
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
          {
            $counter1 = 0;
                foreach ($row as $field => $value){
                  ++$counter1;
                  if($counter1 == 1){
                    $_SESSION['id_transaction_advert'] = $value;
                  }
                  if($counter1 == 2){
                    $_SESSION['id_advert'] = $value;
                  }
                  if($counter1 == 3){
                    $_SESSION['id_author'] = $value;
                  }
                  if($counter1 == 4){
                    $_SESSION['id_user_requested'] = $value;
                  }
                  if($counter1 == 5){
                    $_SESSION['offer_start'] = $value;
                  }
                  if($counter1 == 6){
                    $_SESSION['offer_confirmed'] = $value;
                  }
                  if($counter1 == 7){
                    $_SESSION['author_confirm_success'] = $value;
                  }
                  if($counter1 == 8){
                    $_SESSION['user_confirm_success'] = $value;
                  }
                  if($counter1 == 9){
                    $_SESSION['offer_success'] = $value;
                  }
                }
              }
          }else{
            $_SESSION['offer_start'] = 0;
            $_SESSION['offer_confirmed'] = 0;
            $_SESSION['author_confirm_success'] = 0;
            $_SESSION['user_confirm_success'] = 0;
          }

      }

    }else{
      $_SESSION['any_transaction'] = 0;
    }

  }

      // progress bar transaction
        if(($_SESSION['is_author'] == false || ((isset($_SESSION['offer_confirmed']) && $_SESSION['offer_confirmed'] == 1) && (isset($_SESSION['transaction_with_you']) && $_SESSION['transaction_with_you'] == true) || $_SESSION['results'] > 1) && $_SESSION['offer_start'] == 1)){
          echo "<div class='progress_bar_transaction'>";
            echo "<div class='row'>";
              echo "<div class='container'>";
                echo "<div class='progress_section'>";

                    if($_SESSION['any_transaction'] == 0 || (isset($_SESSION['offer_start']) && $_SESSION['offer_start'] == 0)){
                        echo "<div class='col-lg-3 col-md-12 col-sm-12 text-center'>";
                          echo "<span class='requested'><i class='bi bi-x-circle-fill' style='font-size: 2rem;'></i></span>";
                          if($_SESSION['language'] == "ENG"){
                            echo "<p class='p_requested'>requested</p>";
                          }else if($_SESSION['language'] == "PL"){
                            echo "<p class='p_requested'>prośba wysłana</p>";
                          }
                          echo "<script class='transaction_1'>sessionStorage.requested = 0;</script>";
                        echo "</div>";
                        echo "<div class='col-lg-3 col-md-12 col-sm-12 text-center'>";
                          echo "<span class='advert_author_confirmed_request'><i class='bi bi-x-circle-fill' style='font-size: 2rem;'></i></span>";
                          if($_SESSION['language'] == "ENG"){
                            echo "<p class='p_advert_author_confirmed_request'>advert author confirmed request</p>";
                          }else if($_SESSION['language'] == "PL"){
                            echo "<p class='p_advert_author_confirmed_request'>autor ogłoszenia potwierdził zapytanie</p>";
                          }
                          echo "<script class='transaction_2'>sessionStorage.advert_author_confirmed_request = 0;</script>";
                        echo "</div>";
                        echo "<div class='col-lg-3 col-md-12 col-sm-12 text-center'>";
                          echo "<span class='confirmed_success'><i class='bi bi-x-circle-fill' style='font-size: 2rem;'></i></span>";
                          if($_SESSION['language'] == "ENG"){
                            echo "<p class='p_confirmed_success'>confirmed success</p>";
                          }else if($_SESSION['language'] == "PL"){
                            echo "<p class='p_confirmed_success'>potwierdzono zakończenie transakcji</p>";
                          }
                          echo "<script class='transaction_3'>sessionStorage.confirmed_success = 0;</script>";
                        echo "</div>";
                        echo "<div class='col-lg-3 col-md-12 col-sm-12 text-center'>";
                          echo "<span class='advert_author_confirmed_success'><i class='bi bi-x-circle-fill' style='font-size: 2rem;'></i></span>";
                          if($_SESSION['language'] == "ENG"){
                            echo "<p class='p_advert_author_confirmed_success'>advert author confirmed success</p>";
                          }else if($_SESSION['language'] == "PL"){
                            echo "<p class='p_advert_author_confirmed_success'>autor ogłoszenia potwierdził zakończenie transakcji</p>";
                          }
                          echo "<script class='transaction_4'>sessionStorage.advert_author_confirmed_success = 0;</script>";
                        echo "</div>";
                    }else{
                      if($_SESSION['offer_start'] == 0){
                        echo "<div class='col-lg-3 col-md-12 col-sm-12 text-center'>";
                          echo "<span class='requested'><i class='bi bi-x-circle-fill' style='font-size: 2rem;'></i></span>";
                          if($_SESSION['language'] == "ENG"){
                            echo "<p class='p_requested'>requested</p>";
                          }else if($_SESSION['language'] == "PL"){
                            echo "<p class='p_requested'>prośba wysłana</p>";
                          }
                          echo "<script class='transaction_1'>sessionStorage.requested = 0;</script>";
                        echo "</div>";
                      }else{
                        echo "<div class='col-lg-3 col-md-12 col-sm-12 text-center'>";
                          echo "<span class='requested'><i class='bi bi-check-circle-fill text-success' style='font-size: 3rem;'></i></span>";
                          if($_SESSION['language'] == "ENG"){
                            echo "<p class='p_requested transaction_label text-success'>requested</p>";
                          }else if($_SESSION['language'] == "PL"){
                            echo "<p class='p_requested transaction_label text-success'>prośba wysłana</p>";
                          }
                          echo "<script class='transaction_1'>sessionStorage.requested = 1;</script>";
                        echo "</div>";
                      }

                      if($_SESSION['offer_confirmed'] == 0){
                        echo "<div class='col-lg-3 col-md-12 col-sm-12 text-center'>";
                          echo "<span class='advert_author_confirmed_request'><i class='bi bi-x-circle-fill' style='font-size: 2rem;'></i></span>";
                          if($_SESSION['language'] == "ENG"){
                            echo "<p class='p_advert_author_confirmed_request'>advert author confirmed request</p>";
                          }else if($_SESSION['language'] == "PL"){
                            echo "<p class='p_advert_author_confirmed_request'>autor ogłoszenia potwierdził zapytanie</p>";
                          }
                          echo "<script class='transaction_2'>sessionStorage.advert_author_confirmed_request = 0;</script>";
                        echo "</div>";
                      }else{
                        echo "<div class='col-lg-3 col-md-12 col-sm-12 text-center'>";
                          echo "<span class='advert_author_confirmed_request'><i class='bi bi-check-circle-fill text-success' style='font-size: 3rem;'></i></span>";
                          if($_SESSION['language'] == "ENG"){
                            echo "<p class='p_advert_author_confirmed_request transaction_label text-success'>advert author confirmed requested</p>";
                          }else if($_SESSION['language'] == "PL"){
                            echo "<p class='p_advert_author_confirmed_request transaction_label text-success'>autor ogłoszenia potwierdził zapytanie</p>";
                          }
                          echo "<script class='transaction_2'>sessionStorage.advert_author_confirmed_request = 1;</script>";
                        echo "</div>";
                      }

                      if($_SESSION['user_confirm_success'] == 0){
                        echo "<div class='col-lg-3 col-md-12 col-sm-12 text-center'>";
                          echo "<span class='confirmed_success'><i class='bi bi-x-circle-fill' style='font-size: 2rem;'></i></span>";
                          if($_SESSION['language'] == "ENG"){
                            echo "<p class='p_confirmed_success'>confirmed success</p>";
                          }else if($_SESSION['language'] == "PL"){
                            echo "<p class='p_confirmed_success'>potwierdzono zakończenie transakcji</p>";
                          }
                          echo "<script class='transaction_3'>sessionStorage.confirmed_success = 0;</script>";
                        echo "</div>";
                      }else{
                        echo "<div class='col-lg-3 col-md-12 col-sm-12 text-center'>";
                          echo "<span class='confirmed_success'><i class='bi bi-check-circle-fill text-success' style='font-size: 3rem;'></i></span>";
                          if($_SESSION['language'] == "ENG"){
                            echo "<p class='p_confirmed_success transaction_label text-success'>confirmed success</p>";
                          }else if($_SESSION['language'] == "PL"){
                            echo "<p class='p_confirmed_success transaction_label text-success'>potwierdzono zakończenie transakcji</p>";
                          }
                          echo "<script class='transaction_3'>sessionStorage.confirmed_success = 1;</script>";
                        echo "</div>";
                      }

                      if($_SESSION['author_confirm_success'] == 0){
                        echo "<div class='col-lg-3 col-md-12 col-sm-12 text-center'>";
                          echo "<span class='advert_author_confirmed_success'><i class='bi bi-x-circle-fill' style='font-size: 2rem;'></i></span>";
                          if($_SESSION['language'] == "ENG"){
                            echo "<p class='p_advert_author_confirmed_success'>advert author confirmed success</p>";
                          }else if($_SESSION['language'] == "PL"){
                            echo "<p class='p_advert_author_confirmed_success'>autor ogłoszenia potwierdził zakończenie transakcji</p>";
                          }
                          echo "<script class='transaction_4'>sessionStorage.advert_author_confirmed_success = 0;</script>";
                        echo "</div>";
                      }else{
                        echo "<div class='col-lg-3 col-md-12 col-sm-12 text-center'>";
                          echo "<span class='advert_author_confirmed_success'><i class='bi bi-check-circle-fill text-success' style='font-size: 3rem;'></i></span>";
                          if($_SESSION['language'] == "ENG"){
                            echo "<p class='p_advert_author_confirmed_success transaction_label text-success'>advert author confirmed success</p>";
                          }else if($_SESSION['language'] == "PL"){
                            echo "<p class='p_advert_author_confirmed_success transaction_label text-success'>autor ogłoszenia potwierdził zakończenie transakcji</p>";
                          }
                          echo "<script class='transaction_4'>sessionStorage.advert_author_confirmed_success = 1;</script>";
                        echo "</div>";
                      }

                    }



                echo "</div>";
              echo "</div>";
            echo "</div>";
          echo "</div>";
        }else{

        }
      // end of progress bar transaction

      echo "<div class='row'>";
        echo "<div class='container'>";
          echo "<div class='col-lg-12 col-md-12 col-sm-12 text-center'>";
            if($_SESSION['is_author'] == true){
              if($_SESSION['any_transaction'] == 0){
                if($_SESSION['language'] == "ENG"){
                  echo "<p class='advert_title' style='color: #bfffff; text-shadow: 1px 1px 5px black;'>Advert wait for user request</p>";
                }else if($_SESSION['language'] == "PL"){
                  echo "<p class='advert_title' style='color: #bfffff; text-shadow: 1px 1px 5px black;'>Ogłoszenie czeka na prósby innych użytkowników</p>";
                }
              }else{
                if((isset($_SESSION['offer_confirmed']) && $_SESSION['offer_confirmed'] == 1) && $_SESSION['author_confirm_success'] == 0){
                  if($_SESSION['language'] == "ENG"){
                    echo "<button type='button' class='btn btn-primary btn-lg' onclick='advert_author_confirm_success(" . $advert_id . ", " . $_SESSION['user_id'] . ")'>Confirm success</button>";
                  }else if($_SESSION['language'] == "PL"){
                    echo "<button type='button' class='btn btn-primary btn-lg' onclick='advert_author_confirm_success(" . $advert_id . ", " . $_SESSION['user_id'] . ")'>Potwierdź zakończenie transakcji</button>";
                  }

                  $data = $conn->prepare("SELECT username FROM users WHERE id_user = :id_user_requested ");
                  $data->bindParam(":id_user_requested", $_SESSION['id_user_requested'], PDO::PARAM_INT);
                  $data->execute();
                  $_SESSION['username_with_transaction'] = $data->fetchColumn();
                  if($_SESSION['language'] == "ENG"){
                    echo "<br><br><p class='advert_title' style='color: #bfffff; text-shadow: 1px 1px 5px black;'>Transaction with: " . $_SESSION['username_with_transaction'] . "</p>";
                  }else if($_SESSION['language'] == "PL"){
                    echo "<br><br><p class='advert_title' style='color: #bfffff; text-shadow: 1px 1px 5px black;'>Transakcja z użytkownikiem: " . $_SESSION['username_with_transaction'] . "</p>";
                  }
                }

                if((isset($_SESSION['offer_confirmed']) && $_SESSION['offer_confirmed'] == 1) && $_SESSION['author_confirm_success'] == 1){
                  $data = $conn->prepare("SELECT username FROM users WHERE id_user = :id_user_requested ");
                  $data->bindParam(":id_user_requested", $_SESSION['id_user_requested'], PDO::PARAM_INT);
                  $data->execute();
                  $_SESSION['username_with_transaction'] = $data->fetchColumn();
                  if($_SESSION['language'] == "ENG"){
                    echo "<br><br><p class='advert_title' style='color: #bfffff; text-shadow: 1px 1px 5px black;'>Transaction with: " . $_SESSION['username_with_transaction'] . "</p>";
                  }else if($_SESSION['language'] == "PL"){
                    echo "<br><br><p class='advert_title' style='color: #bfffff; text-shadow: 1px 1px 5px black;'>Transakcja z użytkownikiem: " . $_SESSION['username_with_transaction'] . "</p>";
                  }
                }

              }
            }else{
              if($_SESSION['any_transaction'] == 0){
                if($_SESSION['language'] == "ENG"){
                  echo "<button type='button' class='btn btn-primary btn-lg' onclick='request_for_trade(" . $advert_id . ", " . $author_id . ", " . $_SESSION['user_id'] . ")'>Send request</button>";
                }else if($_SESSION['language'] == "PL"){
                  echo "<button type='button' class='btn btn-primary btn-lg' onclick='request_for_trade(" . $advert_id . ", " . $author_id . ", " . $_SESSION['user_id'] . ")'>Wyślij zapytanie</button>";
                }
              }else{
                if($_SESSION['offer_start'] == 0 && $_SESSION['offer_confirmed'] == 0 && $_SESSION['author_confirm_success'] == 0 && $_SESSION['user_confirm_success'] == 0){
                  if($_SESSION['language'] == "ENG"){
                    echo "<button type='button' class='btn btn-primary btn-lg' onclick='request_for_trade(" . $advert_id . ", " . $author_id . ", " . $_SESSION['user_id'] . ")'>Send request</button>";
                  }else if($_SESSION['language'] == "PL"){
                    echo "<button type='button' class='btn btn-primary btn-lg' onclick='request_for_trade(" . $advert_id . ", " . $author_id . ", " . $_SESSION['user_id'] . ")'>Wyślij zapytanie</button>";
                  }
                }

                if($_SESSION['transaction_with_you'] == true){
                  if($_SESSION['offer_confirmed'] == 1 && $_SESSION['user_confirm_success'] == 0){
                    if($_SESSION['language'] == "ENG"){
                      echo "<button type='button' class='btn btn-primary btn-lg' onclick='user_confirm_success(" . $advert_id . ", " . $author_id . ")'>Confirm success</button>";
                    }else if($_SESSION['language'] == "PL"){
                      echo "<button type='button' class='btn btn-primary btn-lg' onclick='user_confirm_success(" . $advert_id . ", " . $author_id . ")'>Potwierdź zakończenie transakcji</button>";
                    }
                  }
                }else{
                  if($_SESSION['offer_confirmed'] == 1){
                    if($_SESSION['language'] == "ENG"){
                      echo "<p class='advert_title' style='color: #bfffff; text-shadow: 1px 1px 5px black;'>Transaction started with other user</p>";
                    }else if($_SESSION['language'] == "PL"){
                      echo "<p class='advert_title' style='color: #bfffff; text-shadow: 1px 1px 5px black;'>Transakcja rozpoczęła się już z innym użytkownikiem</p>";
                    }
                  }
                }
              }
            }

          echo "</div>";
        echo "</div>";
      echo "</div>";
    echo "</div>";

  echo "<script class='transaction_5'>sessionStorage.advert_id = " . $advert_id . ";  sessionStorage.user_id = " . $_SESSION["user_id"] . "; sessionStorage.author_id = " . $author_id . "</script>";
  echo "</div>";

}

 ?>
