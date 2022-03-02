<?php include_once 'db_connection.php'; ?>

<?php

try{

  if(isset($_POST['email_login']) && isset($_POST['password_login'])){
    session_start();

    $email_login = $_POST['email_login'];
    $password_login = $_POST['password_login'];
    $is_OK = true;

    $email = ltrim(rtrim(filter_var($email_login, FILTER_SANITIZE_EMAIL)));
    if (empty($email) || (!filter_var($email, FILTER_VALIDATE_EMAIL)))
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $is_OK = false;
        }
    }

    $password = ltrim(rtrim(filter_var($password_login, FILTER_SANITIZE_STRING)));
    if (empty($password))
    {
        $is_OK = false;
    }

    $salt = md5("X5Y7Z9");
    if($is_OK == true){

      $stmt = $conn->prepare("SELECT id_user FROM users WHERE email = :email AND password = :password");
      $stmt->bindValue(":email", $email);
      $stmt->bindValue(":password", md5($password . $salt));
      $stmt->execute();

      if ($stmt->rowCount() > 0){
        $stmt = $conn->prepare("SELECT is_verificated FROM users WHERE email = :email AND password = :password");
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":password", md5($password . $salt));
        $stmt->execute();

        $is_verificated = $stmt->fetchColumn();

        if($is_verificated == 1){

          $query = "SELECT id_user, password, is_admin FROM users WHERE email = :email";
          $stmt = $conn->prepare($query);
          $stmt->bindParam(":email", $email, PDO::PARAM_STR);
          $stmt->execute();

          if ($stmt->rowCount() > 0)
          {
              $row = $stmt->fetch(PDO::FETCH_OBJ);
              if (md5($password . $salt) === $row->password)
              {
                  $_SESSION["user_id"] = $row->id_user;


                  $query = "SELECT username FROM users WHERE email = :email";
                  $stmt = $conn->prepare($query);
                  $stmt->bindParam(":email", $email, PDO::PARAM_STR);
                  $stmt->execute();
                  $_SESSION['session_username'] = $stmt->fetchColumn();;

                  $_SESSION['timeout'] = time();
                  $_SESSION['logout_timer'] = 600;
                  if($_SESSION['language'] == "ENG"){
                    echo "<script class='info_modal_ok'>alert('Login OK'); </script>";
                  }else if($_SESSION['language'] == "PL"){
                    echo "<script class='info_modal_ok'>alert('Logowanie poprawne'); </script>";
                  }

                  if($row->is_admin == 1){
                    $_SESSION["is_admin"] = 1;
                  }

              }else{
                if($_SESSION['language'] == "ENG"){
                  echo "<script class='info_modal_verification'>alert('Wrong PASSWORD or EMAIL'); </script>";
                }else if($_SESSION['language'] == "PL"){
                  echo "<script class='info_modal_verification'>alert('Złe HASŁO lub EMAIL'); </script>";
                }
              }
          }
        }else{
          if($_SESSION['language'] == "ENG"){
            echo "<script class='info_modal_verification'>alert('Account is not verificated'); </script>";
          }else if($_SESSION['language'] == "PL"){
            echo "<script class='info_modal_verification'>alert('Konto nie zostało aktywowane'); </script>";
          }
        }

        }else{
          if($_SESSION['language'] == "ENG"){
            echo "<script class='info_modal_wrong'>alert('Wrong PASSWORD or EMAIL'); </script>";
          }else if($_SESSION['language'] == "PL"){
            echo "<script class='info_modal_wrong'>alert('Złe HASŁO lub EMAIL'); </script>";
          }
        }
      }else{
        if($_SESSION['language'] == "ENG"){
          echo "<script class='info_modal_wrong'>alert('Wrong PASSWORD or EMAIL'); </script>";
        }else if($_SESSION['language'] == "PL"){
          echo "<script class='info_modal_wrong'>alert('Złe HASŁO lub EMAIL'); </script>";
        }
      }

  }

}catch(PDOException $e){
  echo $sql . "<br><br>" . $e->getMessage();
}

?>
