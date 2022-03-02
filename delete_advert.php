<?php include_once 'db_connection.php'; ?>
<?php session_start(); ?>

<?php

  try{
    if(isset($_POST['advert_id'])){

        $advert_id = $_POST['advert_id'];

        $stmt = $conn->prepare("SELECT is_musical_instrument FROM adverts WHERE id_advert = :advert_id");
        $stmt->bindParam(":advert_id", $advert_id, PDO::PARAM_INT);
        $stmt->execute();
        $is_advert = $stmt->fetchColumn();

        if($is_advert == 0){
          $stmt = $conn->prepare("SELECT content FROM commented_adverts WHERE id_advert = :advert_id");
          $stmt->bindParam(":advert_id", $advert_id, PDO::PARAM_INT);
          $stmt->execute();

          if ($stmt->rowCount() > 0)
          {
            $stmt = $conn->prepare("DELETE FROM commented_adverts WHERE id_advert = :advert_id");
            $stmt->bindParam(":advert_id", $advert_id, PDO::PARAM_INT);
            $stmt->execute();
          }

          $stmt = $conn->prepare("SELECT id_user FROM liked_adverts WHERE id_advert = :advert_id");
          $stmt->bindParam(":advert_id", $advert_id, PDO::PARAM_INT);
          $stmt->execute();

          if ($stmt->rowCount() > 0)
          {
            $stmt = $conn->prepare("DELETE FROM liked_adverts WHERE id_advert = :advert_id");
            $stmt->bindParam(":advert_id", $advert_id, PDO::PARAM_INT);
            $stmt->execute();
          }

          $stmt = $conn->prepare("DELETE FROM images WHERE id_advert = :advert_id");
          $stmt->bindParam(":advert_id", $advert_id, PDO::PARAM_INT);
          $stmt->execute();

          $stmt = $conn->prepare("DELETE FROM adverts WHERE id_advert = :advert_id");
          $stmt->bindParam(":advert_id", $advert_id, PDO::PARAM_INT);
          $stmt->execute();

        }else{
          $stmt = $conn->prepare("SELECT offer_success FROM transaction_adverts WHERE id_advert = :advert_id");
          $stmt->bindParam(":advert_id", $advert_id, PDO::PARAM_INT);
          $stmt->execute();

          if ($stmt->rowCount() > 0)
          {
            $stmt = $conn->prepare("DELETE FROM transaction_adverts WHERE id_advert = :advert_id");
            $stmt->bindParam(":advert_id", $advert_id, PDO::PARAM_INT);
            $stmt->execute();
          }

          $stmt = $conn->prepare("DELETE FROM images WHERE id_advert = :advert_id");
          $stmt->bindParam(":advert_id", $advert_id, PDO::PARAM_INT);
          $stmt->execute();

          $stmt = $conn->prepare("DELETE FROM adverts WHERE id_advert = :advert_id");
          $stmt->bindParam(":advert_id", $advert_id, PDO::PARAM_INT);
          $stmt->execute();

        }

    }
  }catch(PDOException $e){
    echo $sql . "<br><br>" . $e->getMessage();
  }

?>
