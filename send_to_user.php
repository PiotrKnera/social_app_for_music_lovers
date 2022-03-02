<?php include_once 'db_connection.php';?>


<?php session_start(); ?>

<?php

if(isset($_POST['from_user_id']) && isset($_POST['to_username']) && isset($_POST['content'])){

  $from_user_id = $_POST['from_user_id'];
  $to_username = $_POST['to_username'];
  $content = $_POST['content'];
  $message_added_date = date("Y-m-d") .  " " . date("H:i:s");

  $data = $conn->prepare("SELECT DISTINCT id_user FROM users WHERE username = :to_username");
  $data->bindParam(":to_username", $to_username, PDO::PARAM_STR);
  $data->execute();
  $to_user_id = $data->fetchColumn();

  $stmt = $conn->prepare("INSERT INTO chat_message (to_user_id, from_user_id, chat_message, message_added_date) VALUES (:to_user_id, :from_user_id, :chat_message, :message_added_date)");
  $stmt->bindParam(":to_user_id", $to_user_id, PDO::PARAM_INT);
  $stmt->bindParam(":from_user_id", $from_user_id, PDO::PARAM_INT);
  $stmt->bindParam(":chat_message", $content, PDO::PARAM_STR);
  $stmt->bindParam(":message_added_date", $message_added_date, PDO::PARAM_STR);
  $stmt->execute();

}

?>
