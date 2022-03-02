<?php include_once 'db_connection.php'; ?>

<?php session_start(); ?>

<?php

  try{

    if(isset($_POST['advert_id']) && isset($_POST['author_id'])){

      $advert_id = $_POST['advert_id'];
      $author_id = $_POST['author_id'];

      $stmt = $conn->prepare("UPDATE transaction_adverts SET author_confirm_success = 1 WHERE id_advert = :advert_id AND id_author = :author_id");
      $stmt->bindParam(":advert_id", $advert_id, PDO::PARAM_INT);
      $stmt->bindParam(":author_id", $author_id, PDO::PARAM_INT);
      $stmt->execute();

      $stmt = $conn->prepare("SELECT offer_start, offer_confirmed, user_confirm_success, author_confirm_success FROM transaction_adverts WHERE id_advert = :advert_id AND id_author = :author_id");
      $stmt->bindParam(":advert_id", $advert_id, PDO::PARAM_INT);
      $stmt->bindParam(":author_id", $author_id, PDO::PARAM_INT);
      $stmt->execute();

      while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
      {
        $counter = 0;
        foreach ($row as $field => $value){
          ++$counter;
          if($counter == 1){
            $offer_start = $value;
          }
          if($counter == 2){
            $offer_confirmed = $value;
          }
          if($counter == 3){
            $user_confirm_success = $value;
          }
          if($counter == 4){
            $author_confirm_success = $value;
          }
        }
      }

      if($offer_start == 1 && $offer_confirmed == 1 && $author_confirm_success == 1 && $user_confirm_success == 1)
      {
        $stmt = $conn->prepare("UPDATE transaction_adverts SET offer_success = 1 WHERE id_advert = :advert_id AND id_author = :author_id");
        $stmt->bindParam(":advert_id", $advert_id, PDO::PARAM_INT);
        $stmt->bindParam(":author_id", $author_id, PDO::PARAM_INT);
        $stmt->execute();

        $stmt = $conn->prepare("UPDATE adverts SET is_archived = 1 WHERE id_advert = :advert_id");
        $stmt->bindParam(":advert_id", $advert_id, PDO::PARAM_INT);
        $stmt->execute();
      }



    }

  }catch(PDOException $e){
    echo $sql . "<br><br>" . $e->getMessage();
  }

?>
