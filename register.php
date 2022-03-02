<?php include_once 'db_connection.php';?>
<?php session_start(); ?>

<?php

  if(isset($_POST['email_register']) && isset($_POST['password1_register']) && isset($_POST['password2_register'])
    && isset($_POST['username_register']) && isset($_POST['name_register']) && isset($_POST['surname_register'])
    && isset($_POST['phone_register'])){

      $email_register = $_POST['email_register'];
      $password1_register = $_POST['password1_register'];
      $password2_register = $_POST['password2_register'];
      $username_register = $_POST['username_register'];
      $name_register = $_POST['name_register'];
      $surname_register = $_POST['surname_register'];
      $phone_register = $_POST['phone_register'];
      $OK = true;


      // validate mail
      $email_filter = filter_var($email_register, FILTER_SANITIZE_EMAIL);
      if ((filter_var($email_register, FILTER_VALIDATE_EMAIL) == false) || ($email_filter != $email_register))
      {
        $OK = false;
        if($_SESSION['language'] == "ENG"){
          echo "<script class='info_modal_email'>alert('Wrong EMAIL'); </script>";
        }else if($_SESSION['language'] == "PL"){
          echo "<script class='info_modal_email'>alert('Nieprawidłowy EMAIL'); </script>";
        }
      }

      // validate password
      if ((strlen($password1_register)<8) || (strlen($password1_register)>20))
      {
        $OK = false;
        if($_SESSION['language'] == "ENG"){
          echo "<script class='info_modal_password'>alert('Password must have 8 to 20 chars!'); </script>";
        }else if($_SESSION['language'] == "PL"){
          echo "<script class='info_modal_password'>alert('Hasło musi zawierać od 8 do 20 znaków!'); </script>";
        }
      }

      if ($password1_register != $password2_register)
      {
        $OK = false;
        if($_SESSION['language'] == "ENG"){
          echo "<script class='info_modal_password_confirm'>alert('Password confirmation failed'); </script>";
        }else if($_SESSION['language'] == "PL"){
          echo "<script class='info_modal_password_confirm'>alert('Potwierdzenie hasła nie powiodło się'); </script>";
        }
      }

      // validate username
      if ((strlen($username_register)<3) || (strlen($username_register)>15))
      {
        $OK = false;
        if($_SESSION['language'] == "ENG"){
          echo "<script class='info_modal_username'>alert('Username must have 3 to 15 chars!'); </script>";
        }else if($_SESSION['language'] == "PL"){
          echo "<script class='info_modal_username'>alert('Pseudonim musi zawierać od 3 do 15 znaków'); </script>";
        }
      }

      if (ctype_alnum($username_register)==false)
      {
        $OK = false;
        if($_SESSION['language'] == "ENG"){
          echo "<script class='info_modal_username2'>alert('The username can only consist of letters and numbers (no Polish or other special characters)'); </script>";
        }else if($_SESSION['language'] == "PL"){
          echo "<script class='info_modal_username2'>alert('Pseudonim może składać się tylko z liter i cyfr (bez polskich i specjalnych znaków)'); </script>";
        }
      }

      // validate name
      if ((strlen($name_register)<3) || (strlen($name_register)>20))
      {
        $OK = false;
        if($_SESSION['language'] == "ENG"){
          echo "<script class='info_modal_name'>alert('Name must have 3 to 20 chars!'); </script>";
        }else if($_SESSION['language'] == "PL"){
          echo "<script class='info_modal_name'>alert('Imię musi zawierać od 3 do 20 znaków!'); </script>";
        }
      }


      // validate surname
      if ((strlen($surname_register)<3) || (strlen($surname_register)>15))
      {
        $OK = false;
        if($_SESSION['language'] == "ENG"){
          echo "<script class='info_modal_surname'>alert('Surame must have 3 to 20 chars!'); </script>";
        }else if($_SESSION['language'] == "PL"){
          echo "<script class='info_modal_surname'>alert('Nazwisko musi zawierać od 3 do 20 znaków'); </script>";
        }
      }

      // validate phone
      if ((strlen($phone_register) != 11))
      {
        $OK = false;
        if($_SESSION['language'] == "ENG"){
          echo "<script class='info_modal_phone'>alert('Phone number must have 9 numbers in format: 111-111-111'); </script>";
        }else if($_SESSION['language'] == "PL"){
          echo "<script class='info_modal_phone'>alert('Numer telefonu musi mieć 9 cyfr w formacie: 111-111-111'); </script>";
        }
      }

      if($OK == true){
          $stmt = $conn->prepare("SELECT id_user FROM users WHERE email = :email_register ");
          $stmt->bindParam(":email_register", $email_register, PDO::PARAM_STR);
          $stmt->execute();

          if ($stmt->rowCount() > 0)
          {
            $OK = false;
            if($_SESSION['language'] == "ENG"){
              echo "<script class='info_modal_email_duplicate'>alert('Email already exists!'); </script>";
            }else if($_SESSION['language'] == "PL"){
              echo "<script class='info_modal_email_duplicate'>alert('Taki email już istnieje!'); </script>";
            }
          }

          $stmt = $conn->prepare("SELECT id_user FROM users WHERE username = :username_register ");
          $stmt->bindParam(":username_register", $username_register, PDO::PARAM_STR);
          $stmt->execute();

          if($stmt->rowCount() > 0){
            $OK = false;
            if($_SESSION['language'] == "ENG"){
              echo "<script class='info_modal_username_duplicate'>alert('Username already exists!'); </script>";
            }else if($_SESSION['language'] == "PL"){
              echo "<script class='info_modal_username_duplicate'>alert('Taki użytkownik jest już zajęty!'); </script>";
            }
          }

          if($OK == true){
            $u_letter = chr(rand(65,90));
            $l_letter = chr(rand(97,122));
            $user_activation_code = md5(rand() . $u_letter . rand() . $l_letter . rand());;

            $salt = md5("X5Y7Z9");
            $password1_register_e = md5($password1_register . $salt);

            $stmt = $conn->prepare("INSERT INTO users (username, name, surname, email, password, phone, verification_code, is_verificated, is_admin) VALUES (:username_register, :name_register, :surname_register, :email_register, :password_register, :phone_register, :user_activation_code, 0, 0)");
            $stmt->bindParam(":username_register", $username_register, PDO::PARAM_STR);
            $stmt->bindParam(":name_register", $name_register, PDO::PARAM_STR);
            $stmt->bindParam(":surname_register", $surname_register, PDO::PARAM_STR);
            $stmt->bindParam(":email_register", $email_register, PDO::PARAM_STR);
            $stmt->bindParam(":password_register", $password1_register_e, PDO::PARAM_STR);
            $stmt->bindParam(":phone_register", $phone_register, PDO::PARAM_STR);
            $stmt->bindParam(":user_activation_code", $user_activation_code, PDO::PARAM_STR);
            $stmt->execute();

            $to_email = $email_register;
            if($_SESSION['language'] == "ENG"){
              $subject = "Verification account";
              $body = "<html><body style='background-color: #e6f7ff; padding: 20px 0; text-align: center'>";
              $body .= "<img src='https://firebasestorage.googleapis.com/v0/b/spolecznosciowaaplikacjawebowa.appspot.com/o/Test1%2Flogo.png?alt=media&token=bc8dda5e-dddc-4a2b-9599-fbea046d8f6f' alt='logo' width='64px' height='64px'><br><br>";
              $body .= "<h1 style='text-align: center;'>Hello!</h1><h4 style='text-align: center;'>We are delighted that you want to join us.<br>You have only one step to activate your account!<br>Just click on the code below:</h4><br><br><br>" . "<table style='text-align: center;'><a style='margin: 0 auto; font-size: 3rem; border-radius: 10px; background-color:#1f77c4; color:#fff; text-decoration: none; font-weight:900; padding:20px 50px;' href =http://localhost/Spolecznosciowa_aplikacja_webowa_dla_milosnikow_muzyki/verification.php?verification_code=" . $user_activation_code . "> ACTIVATE </a></table><br>";
            }else if($_SESSION['language'] == "PL"){
              $subject = "Aktywacja konta";
              $body = "<html><body style='background-color: #e6f7ff; padding: 20px 0; text-align: center'>";
              $body .= "<img src='https://firebasestorage.googleapis.com/v0/b/spolecznosciowaaplikacjawebowa.appspot.com/o/Test1%2Flogo.png?alt=media&token=bc8dda5e-dddc-4a2b-9599-fbea046d8f6f' alt='logo' width='64px' height='64px'><br><br>";
              $body .= "<h1 style='text-align: center;'>Witaj!</h1><h4 style='text-align: center;'>Jesteśmy zaszczyceni, że chcesz do nas dołączyć.<br>Tylko jeden krok dzieli Cię od aktywacji konta!<br>Kliknij na przycisk \"Aktywuj\" poniżej:</h4><br><br><br>" . "<table style='text-align: center;'><a style='margin: 0 auto; font-size: 3rem; border-radius: 10px; background-color:#1f77c4; color:#fff; text-decoration: none; font-weight:900; padding:20px 50px;' href =http://localhost/Spolecznosciowa_aplikacja_webowa_dla_milosnikow_muzyki/verification.php?verification_code=" . $user_activation_code . "> AKTYWUJ </a></table><br>";
            }
            $body .= "</body></html>";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: SpolecznosciowaAplikacjaWebowa @ gmail . com";
            mail($to_email, $subject, $body, $headers);

            echo "<script class='info_modal'>alert('account created successfully, please check your email to verify account'); </script>";
          }
      }

  }

?>
