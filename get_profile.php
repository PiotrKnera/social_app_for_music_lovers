<?php include_once 'db_connection.php';?>


<?php session_start(); ?>

<?php

  $data = $conn->prepare("SELECT username, name, surname, email, phone FROM users WHERE id_user = :user_id");
  $data->bindParam(":user_id", $_SESSION['user_id'], PDO::PARAM_INT);
  $data->execute();



  echo "<div id='second_main_section' class='main-section-div profile_details'>";
    echo "<h1 class='profile_header text-center'><i class='bi bi-person-circle'></i></h1>";
    if($_SESSION['language'] == "ENG"){
      echo "<h1 class='profile_header text-center'>Profile</h1><br>";
    }else if($_SESSION['language'] == "PL"){
      echo "<h1 class='profile_header text-center'>Profil</h1><br>";
    }
    echo "<div class='row'>";
      echo "<div class='container'>";
        echo "<div class='main_box author_box'>";
          echo "<div class='col-lg-12 col-md-12 col-sm-12 text-start'>";
            while ($row = $data->fetch(PDO::FETCH_ASSOC))
            {
              $counter1 = 0;

              foreach ($row as $field => $value){
                ++$counter1;

                if($counter1 == 1){
                  if($_SESSION['language'] == "ENG"){
                    echo "<span style='margin-top: 5%;'>Username:</span> <span>" . $value ."</span><br>";
                  }else if($_SESSION['language'] == "PL"){
                    echo "<span style='margin-top: 5%;'>Pseudonim:</span><span>" . $value ."</span><br>";
                  }
                }

                if($counter1 == 2){
                  if($_SESSION['language'] == "ENG"){
                    echo "<span>Name:</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $value ."</span><br>";
                  }else if($_SESSION['language'] == "PL"){
                    echo "<span>Imię:</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $value ."</span><br>";
                  }
                }

                if($counter1 == 3){
                  if($_SESSION['language'] == "ENG"){
                    echo "<span>Surame:</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $value ."</span><br>";
                  }else if($_SESSION['language'] == "PL"){
                    echo "<span>Nazwisko:</span><span>&nbsp;&nbsp;&nbsp;" . $value ."</span><br>";
                  }
                }

                if($counter1 == 4){
                  if($_SESSION['language'] == "ENG"){
                    echo "<span>Email:</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $value ."</span><br>";
                  }else if($_SESSION['language'] == "PL"){
                    echo "<span>Email:</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $value ."</span><br>";
                  }
                }

                if($counter1 == 5){
                  if($_SESSION['language'] == "ENG"){
                    echo "<span style='margin-bottom: 5%;'>Phone:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>" . $value ."</span><br>";
                  }else if($_SESSION['language'] == "PL"){
                    echo "<span style='margin-bottom: 5%;'>Telefon:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>" . $value ."</span><br>";
                  }
                }
              }

            }

          echo "</div>";
        echo "</div>";
      echo "</div>";
    echo "</div>";
    echo "<br><hr><br>";
    if($_SESSION['language'] == "ENG"){
      echo "<h2 class='profile_header text-center' style='margin-bottom: 2.5%;'>Reset Password</h2>";
    }else if ($_SESSION['language'] == "PL"){
      echo "<h2 class='profile_header text-center' style='margin-bottom: 2.5%;'>Resetowanie hasła</h2>";
    }

    echo "<div class='row'>";
      echo "<div class='container'>";
        echo "<div class='main_box author_box'>";
          echo "<div class='col-lg-12 col-md-12 col-sm-12 text-center'>";

          if($_SESSION['language'] == "ENG"){
            echo "<label for='new_password'>New password </label><br><br>";
            echo "<input class='new_password' type='password' id = 'new_password' name = 'new_password' placeholder = 'new_password' required><br><br><br>";
          }else if($_SESSION['language'] == "PL"){
            echo "<label for='new_password'>Nowe hasło </label><br><br>";
            echo "<input class='new_password' type='password' id = 'new_password' name = 'new_password' placeholder = 'nowe_hasło' required><br><br><br>";
          }

          if($_SESSION['language'] == "ENG"){
            echo "<label for='old_password'>Old password </label><br><br>";
            echo "<input class='old_password' type='password' id = 'old_password' name = 'old_password' placeholder = 'old_password' required><br><br><br>";
          }else if($_SESSION['language'] == "PL"){
            echo "<label for='old_password'>Stare hasło </label><br><br>";
            echo "<input class='old_password' type='password' id = 'old_password' name = 'old_password' placeholder = 'stare_hasło' required><br><br><br>";
          }

          echo "<div class='col-lg-12 col-md-12 col-sm-12 text-center'>";
            if($_SESSION['language'] == "ENG"){
              echo "<button type='button' class='btn btn-primary btn-lg' onclick='change_password_profile()'>Change Password</button>";
            }else if($_SESSION['language'] == "PL"){
              echo "<button type='button' class='btn btn-primary btn-lg' onclick='change_password_profile()'>Zmień hasło</button>";
            }
          echo "</div>";

          echo "</div>";
        echo "</div>";
      echo "</div>";
    echo "</div>";

  echo "</div>";


?>
