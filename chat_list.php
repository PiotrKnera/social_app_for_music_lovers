<?php include_once 'db_connection.php';?>


<?php session_start(); ?>

<?php

$data = $conn->prepare("SELECT DISTINCT username FROM users WHERE id_user != :user_id ORDER BY username ASC");
$data->bindParam(":user_id", $_SESSION['user_id'], PDO::PARAM_INT);
$data->execute();

  echo "<div class='main_chat_modal_body_mobile'>";
  while ($row = $data->fetch(PDO::FETCH_ASSOC))
  {
    $counter1 = 0;
    echo "<div class='row'>";
      echo "<div class='container'>";
        echo "<div class='main_chat_modal_arrangement mt-2 mb-2'>";
          foreach ($row as $field => $value){
            echo "<div class='col-lg-6 col-md-6 col-sm-6 col-pad text-center align-middle'>";
              echo "<p class='main_chat_username text-center mt-1'>$value</p>";
            echo "</div>";
            echo "<div class='chat_button_div col-lg-6 col-md-6 col-sm-6 col-pad text-center align-middle'>";
              if($_SESSION['language'] == "ENG"){
                echo "<button type='button' class='btn btn-primary btn-md text-center btn_chat' onclick='start_chat(" . $_SESSION['user_id'] . ", \"" . $value . "\")'>Start Chat</button>";
              }else if($_SESSION['language'] == "PL"){
                echo "<button type='button' class='btn btn-primary btn-md text-center btn_chat' onclick='start_chat(" . $_SESSION['user_id'] . ", \"" . $value . "\")'>Otwórz czat</button>";
              }
            echo "</div>";
          }
          echo "</div>";
        echo "</div>";
      echo "</div>";
  }
  echo "</div>";

?>
