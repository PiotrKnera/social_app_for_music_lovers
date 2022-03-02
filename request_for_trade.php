<?php include_once 'db_connection.php'; ?>

<?php session_start(); ?>

<?php

  try{

    if(isset($_POST['advert_id']) && isset($_POST['author_id']) && isset($_POST['id_user_requested'])){

      $advert_id = $_POST['advert_id'];
      $author_id = $_POST['author_id'];
      $id_user_requested = $_POST['id_user_requested'];

      $stmt = $conn->prepare("INSERT INTO transaction_adverts (id_transaction_advert, id_advert, id_author, id_user_requested, offer_start, offer_confirmed, author_confirm_success, user_confirm_success, offer_success) VALUES (NULL, :advert_id, :author_id, :id_user_requested, 1, 0, 0, 0, 0)");
      $stmt->bindParam(":advert_id", $advert_id, PDO::PARAM_INT);
      $stmt->bindParam(":author_id", $author_id, PDO::PARAM_INT);
      $stmt->bindParam(":id_user_requested", $id_user_requested, PDO::PARAM_INT);
      $stmt->execute();

    }

  }catch(PDOException $e){
    echo $sql . "<br><br>" . $e->getMessage();
  }

?>
