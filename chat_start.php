<?php include_once 'db_connection.php';?>


<?php session_start(); ?>

<?php

if(isset($_POST['from_user_id']) && isset($_POST['to_username'])){

  $from_user_id = $_POST['from_user_id'];
  $to_username = $_POST['to_username'];

  $data = $conn->prepare("SELECT DISTINCT id_user FROM users WHERE username = :to_username");
  $data->bindParam(":to_username", $to_username, PDO::PARAM_STR);
  $data->execute();
  $to_user_id = $data->fetchColumn();

  $data = $conn->prepare("SELECT DISTINCT username FROM users WHERE id_user = :from_user_id");
  $data->bindParam(":from_user_id", $from_user_id, PDO::PARAM_STR);
  $data->execute();
  $from_user_username = $data->fetchColumn();

  $data = null;

  $data = $conn->prepare("SELECT from_user_id, to_user_id, message_added_date, chat_message FROM chat_message WHERE (to_user_id = :to_user_id AND from_user_id = :from_user_id) OR (to_user_id = :from_user_id AND from_user_id = :to_user_id) ORDER BY message_added_date ASC LIMIT 1000");
  $data->bindParam(":to_user_id", $to_user_id, PDO::PARAM_INT);
  $data->bindParam(":from_user_id", $from_user_id, PDO::PARAM_INT);
  $data->execute();

  echo "<div class='single_chat_modal_body_mobile'>";
  while ($row = $data->fetch(PDO::FETCH_ASSOC))
  {
    $counter = 0;
    $is_you = true;
    echo "<div class='row'>";
      echo "<div class='container'>";
        echo "<div class='single_chat_modal_arrangement mt-1 mb-1'>";
          foreach ($row as $field => $value){
            ++$counter;
            if($counter == 1){
              if($_SESSION['user_id'] == $value){
                $is_you = true;
              }else{
                $is_you = false;
              }
            }
            if($counter == 2){
            }
            if($counter == 3){
              if($is_you == true){
                echo "<div class='col-lg-12 col-md-12 col-sm-12 text-end align-middle text-wrap text-break'>";
                  echo "<span class='text-end fst-italic fw-lighter fs-6 text-white-50 me-2'>$value</span><br>";
                  echo "<p class='single_chat_username text-end text-primary mb-1 fs-5 fw-bold me-2'>$from_user_username</p>";
              }else{
                echo "<div class='col-lg-12 col-md-12 col-sm-12 text-start align-middle text-wrap text-break'>";
                  echo "<span class='text-start fst-italic fw-light fs-6 text-white-50'>$value</span><br>";
                  echo "<p class='single_chat_username text-start text-success mb-1 fs-5 fw-bold'>$to_username</p>";
              }
            }
            if($counter == 4){
              if($is_you == true){
                echo "<span class='single_chat_message text-end mb-1 me-2'>$value</span>";
              }else{
                echo "<span class='single_chat_message text-start mb-1'>$value</span>";
              }
              echo "</div><br>";
            }
          }
          echo "</div>";
        echo "</div>";
      echo "</div>";
  }
  echo "</div>";
}

?>
