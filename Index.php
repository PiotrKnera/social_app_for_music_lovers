<?php include_once 'db_connection.php';?>

<?php session_start(); ?>

<?php

  if(!(isset($_SESSION['language']))){
    $_SESSION['language'] = "PL";
  }

?>

<html lang="pl-PL" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
      if($_SESSION['language'] == "ENG"){
        echo "<title>SocialAppForMusicLovers</title>";
      }else if($_SESSION['language'] == "PL"){
        echo "<title>SpołecznościowaAplikacjaWebowa</title>";
      }
    ?>
    <link rel="shortcut icon" href="https://firebasestorage.googleapis.com/v0/b/spolecznosciowaaplikacjawebowa.appspot.com/o/MainPageImages%2Fmain_icon.ico?alt=media&token=c5337cff-f3f5-4c66-a57a-bde193e548d6">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Special+Elite&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">

  </head>

  <body data-spy="scroll" data-target=".navbar" data-offset="200">

    <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top navbar-collapse" id="navbar">
      <div class="container">
        <?php
          if(!(isset($_SESSION['user_id']))){
      		    echo "<a class='navbar-brand' onclick='main_site_on()'><img src='https://firebasestorage.googleapis.com/v0/b/spolecznosciowaaplikacjawebowa.appspot.com/o/MainPageImages%2Flogo.svg?alt=media&token=08ba3771-efbb-4da2-a05c-25db2d580cdb' width='32px' height='32px'></a>";
          }else{
              echo "<div class='dropdown_timer' >";
                echo "<a class='navbar-brand' onclick='main_site_on()'><img src='https://firebasestorage.googleapis.com/v0/b/spolecznosciowaaplikacjawebowa.appspot.com/o/MainPageImages%2Flogo.svg?alt=media&token=08ba3771-efbb-4da2-a05c-25db2d580cdb' width='32px' height='32px'></a>";
                echo "<div class='dropdown_timer_content'>";
                  if(isset($_SESSION['logout_timer'])){
                    if($_SESSION['language'] == "ENG"){
                      echo "<span>Logout in: <span class='logout_value'>" . $_SESSION['logout_timer'] . "s</span></span>";
                    }else if($_SESSION['language'] == "PL"){
                      echo "<span>Wylogowanie za: <span class='logout_value'>" . $_SESSION['logout_timer'] . "s</span></span>";
                    }

                  }
                echo "</div>";
              echo "</div>";
          }
        ?>
    		  	<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar" onclick = "menu_opened()">
    					<span class="navbar-toggler-icon"></span>
    				</button>
    	  <div class="collapse navbar-collapse flex-row-reverse" id="collapsibleNavbar">
      		<ul class="navbar-nav ml-auto">
      		  <li class="nav-item">
              <?php
                if($_SESSION['language'] == "ENG"){
                  echo "<a class='nav-link' onclick='adverts_on()'>Adverts</a>";
                }else if($_SESSION['language'] == "PL"){
                  echo "<a class='nav-link' onclick='adverts_on()'>Ogłoszenia</a>";
                }
              ?>
      		  </li>
      		  <li class="nav-item">
              <?php
                if($_SESSION['language'] == "ENG"){
                  echo "<a class='nav-link' onclick='services_on()'>Services</a>";
                }else if($_SESSION['language'] == "PL"){
                  echo "<a class='nav-link' onclick='services_on()'>Usługi</a>";
                }
              ?>

      		  </li>
            <li class="nav-item">
              <?php
                if($_SESSION['language'] == "ENG"){
                  echo "<a class='nav-link' onclick='songs_on()'>Songs</a>";
                }else if($_SESSION['language'] == "PL"){
                  echo "<a class='nav-link' onclick='songs_on()'>Utwory muzyczne</a>";
                }
              ?>
            </li>
            <li class="nav-item mx-4 my-1">
              <i class="bi bi-circle-fill text-secondary"></i>
            </li>
            <?php
              echo "<li class='nav-item dropdown'>";
                if($_SESSION['language'] == "ENG"){
                  echo "<a class='nav-link dropdown-toggle' id='navbarDropdown3' role='button' data-bs-toggle='dropdown' aria-expanded='false'>Language</a>";
                }else if($_SESSION['language'] == "PL"){
                  echo "<a class='nav-link dropdown-toggle' id='navbarDropdown3' role='button' data-bs-toggle='dropdown' aria-expanded='false'>Język</a>";
                }
                echo "<ul class='dropdown-menu bg-dark' aria-labelledby='navbarDropdown3'>";
                  echo  "<li><a class='dropdown-item text-light' onclick='PL_on()'>PL <img src='https://firebasestorage.googleapis.com/v0/b/spolecznosciowaaplikacjawebowa.appspot.com/o/MainPageImages%2FPolska.jpg?alt=media&token=e53ef998-0ac7-4a0d-8c2c-5195acf9113f' width='24px' height='16px'></a></li>";
                  echo  "<li><a class='dropdown-item text-light' onclick='ENG_on()'>ENG <img src='https://firebasestorage.googleapis.com/v0/b/spolecznosciowaaplikacjawebowa.appspot.com/o/MainPageImages%2FWielka_Brytania.jpg?alt=media&token=17882be1-20ec-4256-bb9a-3daf0c77be0e' width='24px' height='16px'></a></li>";
                echo "</ul>";
              echo "</li>";
            ?>
            <li class="nav-item">
                 <?php
                 if(!(isset($_SESSION["user_id"]))){
                   if($_SESSION['language'] == "ENG"){
                     echo "<a class='nav-link' onclick='register_on()'>Register</a>";
                   }else if($_SESSION['language'] == "PL"){
                     echo "<a class='nav-link' onclick='register_on()'>Rejestracja</a>";
                   }
                 }
                 ?>
            </li>
            <?php
            if((isset($_SESSION["user_id"]))){
              echo "<li class='nav-item dropdown'>";
              if($_SESSION['language'] == "ENG"){
                  echo "<a class='nav-link dropdown-toggle' id='navbarDropdown2' role='button' data-bs-toggle='dropdown' aria-expanded='false'>Yours</a>";
                  echo "<ul class='dropdown-menu bg-dark' aria-labelledby='navbarDropdown2'>";
                    echo  "<li><a class='dropdown-item text-light' onclick='user_adverts_on()'>Adverts</a></li>";
                    echo  "<li><a class='dropdown-item text-light' onclick='user_services_on()'>Services</a></li>";
                    echo  "<li><a class='dropdown-item text-light' onclick='user_songs_on()'>Songs</a></li>";
                    echo  "<li><a class='dropdown-item text-light' onclick='user_archive_on()'>Adverts archive</a></li>";
                  echo "</ul>";
              }else if($_SESSION['language'] == "PL"){
                echo "<a class='nav-link dropdown-toggle' id='navbarDropdown2' role='button' data-bs-toggle='dropdown' aria-expanded='false'>Twoje</a>";
                echo "<ul class='dropdown-menu bg-dark' aria-labelledby='navbarDropdown2'>";
                  echo  "<li><a class='dropdown-item text-light' onclick='user_adverts_on()'>Ogłoszenia</a></li>";
                  echo  "<li><a class='dropdown-item text-light' onclick='user_services_on()'>Usługi</a></li>";
                  echo  "<li><a class='dropdown-item text-light' onclick='user_songs_on()'>Utwory muzyczne</a></li>";
                  echo  "<li><a class='dropdown-item text-light' onclick='user_archive_on()'>Archiwum ogłoszeń</a></li>";
                echo "</ul>";
              }
              echo "</li>";
            }

            if((isset($_SESSION["user_id"]))){
              echo "<li class='nav-item dropdown'>";
              if($_SESSION['language'] == "ENG"){
                echo "<a class='nav-link dropdown-toggle' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>Add</a>";
                echo "<ul class='dropdown-menu bg-dark' aria-labelledby='navbarDropdown'>";
                  echo  "<li><a class='dropdown-item text-light' onclick='add_advert_on()'>Advert</a></li>";
                  echo  "<li><a class='dropdown-item text-light' onclick='add_service_on()'>Service</a></li>";
                  echo  "<li><a class='dropdown-item text-light' onclick='add_song_on()'>Song</a></li>";
                echo "</ul>";
              }else if($_SESSION['language'] == "PL"){
                echo "<a class='nav-link dropdown-toggle' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>Dodaj</a>";
                echo "<ul class='dropdown-menu bg-dark' aria-labelledby='navbarDropdown'>";
                  echo  "<li><a class='dropdown-item text-light' onclick='add_advert_on()'>Ogłoszenie</a></li>";
                  echo  "<li><a class='dropdown-item text-light' onclick='add_service_on()'>Usługi</a></li>";
                  echo  "<li><a class='dropdown-item text-light' onclick='add_song_on()'>Utwór muzyczny</a></li>";
                echo "</ul>";
              }
              echo "</li>";
            }

            if((isset($_SESSION["user_id"]))){
              echo "<li class='nav-item'>";
                if($_SESSION['language'] == "ENG"){
                  echo "<a class='nav-link' onclick='chat_on()'>Chat</a>";
                }else if($_SESSION['language'] == "PL"){
                  echo "<a class='nav-link' onclick='chat_on()'>Czat</a>";
                }
              echo "</li>";
            }

            if((isset($_SESSION["user_id"]))){
              echo "<li class='nav-item'>";
                if($_SESSION['language'] == "ENG"){
                  echo "<a class='nav-link' onclick='profile_on()'>Profile</a>";
                }else if($_SESSION['language'] == "PL"){
                  echo "<a class='nav-link' onclick='profile_on()'>Profil</a>";
                }
              echo "</li>";
            }
            ?>
            <li class="nav-item">
                 <?php
                   if(!(isset($_SESSION["user_id"]))){
                     if($_SESSION['language'] == "ENG"){
                       echo "<a class='nav-link' onclick='login_on()'>Login</a>";
                     }else if($_SESSION['language'] == "PL"){
                       echo "<a class='nav-link' onclick='login_on()'>Logowanie</a>";
                     }
                   }else{
                     if($_SESSION['language'] == "ENG"){
                       echo "<a class='nav-link' onclick='logout_on()'>Logout</a>";
                     }else if($_SESSION['language'] == "PL"){
                       echo "<a class='nav-link' onclick='logout_on()'>Wylogowanie</a>";
                     }
                   }
                 ?>
            </li>

      		</ul>
    	  </div>
      </div>
    </nav>

<div class="main_chat_modal_background"></div>

    <div class="container-fluid header-main">

      <section class = "front-end-section-label">
        <?php
          if($_SESSION['language'] == "ENG"){
            echo "<p class='firstTitle'> <span id='front-end'>hidden content </span>Social App For Music Lovers</p>";
          }else if($_SESSION['language'] == "PL"){
            echo "<p class='firstTitle'> <span id='front-end'>hidden content </span>Społecznościowa aplikacja webowa dla miłośników muzyki</p>";
          }
        ?>

      </section>

    </div>

     <section id = "main-section">
      <div id="carouselExampleControls" class="carousel slide" data-bs-ride="false">
        <div class="carousel-inner">
          <div class="carousel-item active container-fluid">
            <div id="first_main_section" class="main-section-div">
              <div class="row">
                <div class="container">
                  <div class="main_box">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-pad">
                        <p class="main_content">
                          <?php
                            if($_SESSION['language'] == "ENG"){
                              echo "The above application has been written not only to unite people interested in music, it also fulfills other important tasks...";
                            }else if($_SESSION['language'] == "PL"){
                              echo "Powyższa aplikacja została napisana nie tylko w celu zjednoczenia ludzi interesujących się tematyką muzyczną, spełnia ona również inne ważne zadania...";
                            }
                          ?>
                        </p>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-pad">
                        <img class="intro_image" src="https://firebasestorage.googleapis.com/v0/b/spolecznosciowaaplikacjawebowa.appspot.com/o/MainPageImages%2Fintro_image1.jpg?alt=media&token=1f77c6cd-36ab-4d20-b1fc-b26c4439117e" alt="intro_image">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="carousel-item container-fluid">
            <div id="first_main_section" class="main-section-div">
              <div class="row">
                <div class="container">
                  <div class="main_box left_image">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-pad">
                        <p class="main_content">
                          <?php
                            if($_SESSION['language'] == "ENG"){
                              echo "...The exchange and rental of musical instruments will help poorer enthusiasts to provide access to training on a musical instrument and a later career, and for people who are not interested or have no time to play, it will help to get rid of the unwanted object in a useful way for society and even the natural environment, because more often musical instruments contains a lot of electronics, and thus harmful substances...";
                            }else if($_SESSION['language'] == "PL"){
                              echo "...Wymiana jak i wypożyczanie instrumentów muzycznych pomoże biedniejszym pasjonatom udostępnić  drogę do treningów na instrumencie muzycznym i późniejszej kariery, a osobom niemającym czasu na grę ułatwi pozbycie się niechcianego przedmiotu w sposób pożyteczny społeczeństwu, a nawet środowisku naturalnemu, ponieważ coraz częściej instrumenty muzyczne zawierają w sobie dużo elektroniki, a co za tym idzie szkodliwych substancji...";
                            }
                          ?>

                        </p>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-pad">
                        <img class="intro_image" src="https://firebasestorage.googleapis.com/v0/b/spolecznosciowaaplikacjawebowa.appspot.com/o/MainPageImages%2Fintro_image2.jpg?alt=media&token=91e793c9-53bc-4eca-aea1-19b0bc229c15" alt="intro_image">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="carousel-item container-fluid">
            <div id="first_main_section" class="main-section-div">
              <div class="row">
                <div class="container">
                  <div class="main_box">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-pad">
                        <p class="main_content">
                          <?php
                            if($_SESSION['language'] == "ENG"){
                              echo "...For those who don't get bored of playing the instrument and are still passionate about it, the feature of advertising your services will certainly help you get more job offers, as other users looking for a musician for a party will easily be able to find him here. Composers and filmmakers will also use this application, in the next section for posting your own music you will find background music for your film production.";
                            }else if($_SESSION['language'] == "PL"){
                              echo "...Tym, którym gra na instrumencie jednak się nie znudziła i w dalszym ciągu jest ich pasją funkcja ogłaszania  swoich usług z pewnością pomoże otrzymać więcej ofert pracy, ponieważ inni użytkownicy szukający muzyka na imprezę z łatwością będą mogli go tutaj znaleźć. Również kompozytorzy jak i twórcy filmowi skorzystają z tej aplikacji, w kolejnej sekcji do zamieszczania własnych utworów muzycznych można będzie znaleźć podkład muzyczny między innymi do swojej produkcji filmowej.";
                            }
                          ?>
                        </p>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-pad">
                        <img class="intro_image" src="https://firebasestorage.googleapis.com/v0/b/spolecznosciowaaplikacjawebowa.appspot.com/o/MainPageImages%2Fintro_image3.jpg?alt=media&token=4a251bf9-3a84-42e9-9da8-fd89c10ff63d" alt="intro_image">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <a class="carousel-control-prev" data-bs-target="#carouselExampleControls" type="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" data-bs-target="#carouselExampleControls" type="button" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </a>
      </div>

    </section>

    <div class="bg"></div>
    <div class="main_login_box">
      <div class="col-lg-12 col-md-12 col-sm-12 col-pad">
        <div class="login_field">

          <img class="logo1" src="https://firebasestorage.googleapis.com/v0/b/spolecznosciowaaplikacjawebowa.appspot.com/o/MainPageImages%2Flogo.svg?alt=media&token=08ba3771-efbb-4da2-a05c-25db2d580cdb" alt="logo">

            <?php
              if($_SESSION['language'] == "ENG"){
                echo "<label for='email_login'>Email </label><br><br>";
                echo "<input class='firstinput' type='email' id = 'email_login' name = 'email_login' placeholder = 'example@email.com' ><br><br>";
              }else if($_SESSION['language'] == "PL"){
                echo "<label for='email_login'>Email </label><br><br>";
                echo "<input class='firstinput' type='email' id = 'email_login' name = 'email_login' placeholder = 'przykład@email.com' ><br><br>";
              }
            ?>



            <?php
              if($_SESSION['language'] == "ENG"){
                echo "<label for='password_login'>Password </label><br><br>";
                echo "<input class='secondinput' type='password' id = 'password_login' name = 'password_login' placeholder = 'p@$\$w00rd' ><br><br><br>";
              }else if($_SESSION['language'] == "PL"){
                echo "<label for='password_login'>Hasło </label><br><br>";
                echo "<input class='secondinput' type='password' id = 'password_login' name = 'password_login' placeholder = 'h@\$ł0' ><br><br><br>";
              }
            ?>


            <?php
              if($_SESSION['language'] == "ENG"){
                echo "<input class='thirdinput' value='Login' onclick='login_transaction()' readonly><br>";
              }else if($_SESSION['language'] == "PL"){
                echo "<input class='thirdinput' value='Zaloguj' onclick='login_transaction()' readonly><br>";
              }
            ?>



        </div>
      </div>
    </div>

    <div class="main_register_box">
      <div class="register_field">
        <div class="row">
          <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-pad text-center">
              <img class="logo1" src="https://firebasestorage.googleapis.com/v0/b/spolecznosciowaaplikacjawebowa.appspot.com/o/MainPageImages%2Flogo.svg?alt=media&token=08ba3771-efbb-4da2-a05c-25db2d580cdb" alt="logo"><br>

                  <?php
                    if($_SESSION['language'] == "ENG"){
                      echo "<label for='email_register'>Email </label><br>";
                      echo "<input class='email_register' type='email' id = 'email_register' name = 'email_register' placeholder = 'example@email.com' required><br><br>";
                    }else if($_SESSION['language'] == "PL"){
                      echo "<label for='email_register'>Email </label><br>";
                      echo "<input class='email_register' type='email' id = 'email_register' name = 'email_register' placeholder = 'przykład@email.com' required><br><br>";
                    }
                  ?>

                  <?php
                    if($_SESSION['language'] == "ENG"){
                      echo "<label for='password1_register'>Password </label><br>";
                      echo "<input class='password1_register' type='password' id = 'password1_register' name = 'password1_register' placeholder = 'p@$\$w00rd' required><br><br>";
                    }else if($_SESSION['language'] == "PL"){
                      echo "<label for='password1_register'>Hasło </label><br>";
                      echo "<input class='password1_register' type='password' id = 'password1_register' name = 'password1_register' placeholder = 'h@\$ł0' required><br><br>";
                    }
                  ?>

                  <?php
                    if($_SESSION['language'] == "ENG"){
                      echo "<label for='password2_register'>Confirm password </label><br>";
                      echo "<input class='password2_register' type='password' id = 'password2_register' name = 'password2_register' placeholder = 'p@$\$w00rd' required><br><br>";
                    }else if($_SESSION['language'] == "PL"){
                      echo "<label for='password2_register'>Potwierdź hasło </label><br>";
                      echo "<input class='password2_register' type='password' id = 'password2_register' name = 'password2_register' placeholder = 'h@\$ł0' required><br><br>";
                    }
                  ?>

                  <?php
                    if($_SESSION['language'] == "ENG"){
                      echo "<label for='username_register'>Username </label><br>";
                      echo "<input class='username_register' type='text' id = 'username_register' name = 'username_register' placeholder = 'Username' required><br><br>";
                    }else if($_SESSION['language'] == "PL"){
                      echo "<label for='username_register'>Pseudonim </label><br>";
                      echo "<input class='username_register' type='text' id = 'username_register' name = 'username_register' placeholder = 'Pseudonim' required><br><br>";
                    }
                  ?>


                  <?php
                    if($_SESSION['language'] == "ENG"){
                      echo "<label for='name_register'>Name </label><br>";
                      echo "<input class='name_register' type='text' id = 'name_register' name = 'name_register' placeholder = 'Name' required><br><br>";
                    }else if($_SESSION['language'] == "PL"){
                      echo "<label for='name_register'>Imię </label><br>";
                      echo "<input class='name_register' type='text' id = 'name_register' name = 'name_register' placeholder = 'Imię' required><br><br>";
                    }
                  ?>

                  <?php
                    if($_SESSION['language'] == "ENG"){
                      echo "<label for='surname_register'>Surname </label><br>";
                      echo "<input class='surname_register' type='text' id = 'surname_register' name = 'surname_register' placeholder = 'Surname' required><br><br>";
                    }else if($_SESSION['language'] == "PL"){
                      echo "<label for='surname_register'>Nazwisko </label><br>";
                      echo "<input class='surname_register' type='text' id = 'surname_register' name = 'surname_register' placeholder = 'Nazwisko' required><br><br>";
                    }
                  ?>

                  <?php
                    if($_SESSION['language'] == "ENG"){
                      echo "<label for='phone_register'>Phone number </label><br>";
                    }else if($_SESSION['language'] == "PL"){
                      echo "<label for='phone_register'>Numer telefonu </label><br>";
                    }
                  ?>
                  <input class="phone_register" type="tel" id = "phone_register" name = "phone_register" placeholder = "123-123-123" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" required><br><br>

                  <?php
                    if($_SESSION['language'] == "ENG"){
                      echo "<input class='thirdinput' value='Register' onclick='register_transaction()' readonly><br>";
                    }else if($_SESSION['language'] == "PL"){
                      echo "<input class='thirdinput' value='Zarejestruj' onclick='register_transaction()' readonly><br>";
                    }
                  ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal  -->
    <div id="main_chat_modal" class="main_chat_modal">

      <div id="main_chat_modal_content" class="main_chat_modal_content">
        <div class="row">
          <div class="container">
              <div class="main_chat_modal_header">
                <div class="col-lg-6 col-md-6 col-sm-6 text-start">
                  <?php
                    if($_SESSION['language'] == "ENG"){
                      echo "<p class='main_chat_header text-start'>USERS LIST</p>";
                    }else if($_SESSION['language'] == "PL"){
                      echo "<p class='main_chat_header text-start'>LISTA UŻYTKOWNIKÓW</p>";
                    }
                  ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 text-end">
                  <span class="close text-end"><i class="bi bi-x-octagon text-white x_exit"></i></span>
                </div>
              </div>
          </div>
        </div>
            <hr>
            <div class="main_chat_modal_body">

            </div>

      </div>
    </div>

    <div id="single_chat_modal" class="single_chat_modal">

      <div id="single_chat_modal_content" class="single_chat_modal_content">
        <div class="row">
          <div class="container">
              <div class="single_chat_modal_header">
                <div class="col-lg-6 col-md-6 col-sm-6 text-start">
                  <?php
                    if($_SESSION['language'] == "ENG"){
                      echo "<p class='single_chat_header text-start text-nowrap'>CHAT WITH </p>";
                    }else if($_SESSION['language'] == "PL"){
                      echo "<p class='single_chat_header text-start text-nowrap'>ROZMAWIASZ Z </p>";
                    }
                  ?>

                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 text-end">
                  <span class="single_close text-end"><i class="bi bi-x-octagon text-white single_x_exit text-end"></i></span>
                </div>
              </div>
          </div>
        </div>

            <hr>
            <div class="single_chat_modal_body"></div>

            </br>
            <div class="single_chat_modal_write">
              <textarea class='textarea_chat' maxlength='200' rows='5'></textarea>
            </div>

            <hr></br>
            <div class="single_chat_modal_send text-end">
              <?php
                if($_SESSION['language'] == "ENG"){
                  echo "<button type='button' class='send_to_user btn btn-primary btn-md'>Send</button>";
                }else if($_SESSION['language'] == "PL"){
                  echo "<button type='button' class='send_to_user btn btn-primary btn-md'>Wyślij</button>";
                }

              ?>
            </div>

      </div>
    </div>


    <!-- jQuery JS -->
    <script src="js/jquery/jquery-3.5.1.min.js" type="text/javascript"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-storage.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-firestore.js"></script>
    <script src="js/firebase_config.js" type="text/javascript"></script>


    <script src="js/setBase64img.js" type="text/javascript"></script>

    <script src="js/main.js" type="text/javascript"></script>
    <script src="js/scrollnavbar.js" charset="utf-8"></script>
    <script src="js/session_check.js" charset="utf-8"></script>
    <script src="js/upload.js" type="text/javascript"></script>
    <script src="js/transaction_check.js" type="text/javascript"></script>
    <script src="js/refresh_single_chat.js" type="text/javascript"></script>
    <script src="js/logout_timer.js" type="text/javascript"></script>

    <footer class="py-4 bg-dark footer">
      <div class="container">
        <p class="m-0 text-center text-white h5">Piotr Knera <i class="bi bi-diamond-fill text-secondary mx-5"></i> 2021</p>
        <br>
        <div class='footer-placement'>

          <?php

          echo "<div class='col-lg-6 col-md-12 col-sm-12 text-center'>";
            if($_SESSION['language'] == "ENG"){
              echo "<span class='text-light'>Sample photos on the website were downloaded from the: <a class='text-info' href='https://pixabay.com/pl/' target='_blank' style='text-decoration: none;'> Pixabay</a> </span>";
            }else if($_SESSION['language'] == "PL"){
              echo "<span class='text-light'>Przykładowe zdjęcia zamieszczone na stronie zostały pobrane z: <a class='text-info' href='https://pixabay.com/pl/' target='_blank' style='text-decoration: none;'> Pixabay</a> </span>";
            }
          echo "</div>";
          echo "<div class='col-lg-6 col-md-12 col-sm-12 text-center'>";
            if($_SESSION['language'] == "ENG"){
              echo "<span class='text-light'>Sample music on the website were downloaded from the: <a class='text-info' href='https://musopen.org/' target='_blank' style='text-decoration: none;'> Musopen</a> </span>";
            }else if($_SESSION['language'] == "PL"){
                echo "<span class='text-light'>Przykładowa muzyka na stronie została pobrana z: <a class='text-info' href='https://musopen.org/' target='_blank' style='text-decoration: none;'> Musopen</a> </span>";
            }
          echo "</div>";

          ?>
        </div>
      </div>
    </footer>

  </body>
</html>
