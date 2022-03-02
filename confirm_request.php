<?php include_once 'db_connection.php'; ?>

<?php session_start(); ?>

<?php

  try{

    if(isset($_POST['advert_id']) && isset($_POST['author_id']) && isset($_POST['id_user_requested'])){

      $advert_id = $_POST['advert_id'];
      $author_id = $_POST['author_id'];
      $id_user_requested = $_POST['id_user_requested'];

      $stmt = $conn->prepare("UPDATE transaction_adverts SET offer_confirmed = 1 WHERE id_advert = :advert_id AND id_author = :author_id AND id_user_requested = :id_user_requested");
      $stmt->bindParam(":advert_id", $advert_id, PDO::PARAM_INT);
      $stmt->bindParam(":author_id", $author_id, PDO::PARAM_INT);
      $stmt->bindParam(":id_user_requested", $id_user_requested, PDO::PARAM_INT);
      $stmt->execute();

      $stmt = $conn->prepare("DELETE FROM transaction_adverts WHERE id_advert = :advert_id AND id_author = :author_id AND id_user_requested != :id_user_requested");
      $stmt->bindParam(":advert_id", $advert_id, PDO::PARAM_INT);
      $stmt->bindParam(":author_id", $author_id, PDO::PARAM_INT);
      $stmt->bindParam(":id_user_requested", $id_user_requested, PDO::PARAM_INT);
      $stmt->execute();

    }

  }catch(PDOException $e){
    echo $sql . "<br><br>" . $e->getMessage();
  }

?>
