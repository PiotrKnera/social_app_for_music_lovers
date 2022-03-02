<?php include_once 'db_connection.php'; ?>
<?php session_start(); ?>

<?php

  try{
    if(isset($_POST['service_id'])){

        $service_id = $_POST['service_id'];

        $stmt = $conn->prepare("SELECT id_li_advert, id_advert, id_user FROM liked_adverts WHERE id_advert = :service_id AND id_user = :id_user");
        $stmt->bindParam(":service_id", $service_id, PDO::PARAM_INT);
        $stmt->bindParam(":id_user", $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0)
        {
          $stmt = null;

          $stmt = $conn->prepare("UPDATE adverts SET likes=likes-1 WHERE id_advert = :service_id  ");
          $stmt->bindParam(":service_id", $service_id, PDO::PARAM_INT);
          $stmt->execute();

          $stmt = null;

          $stmt = $conn->prepare("DELETE FROM liked_adverts WHERE id_advert = :service_id AND id_user = :id_user");
          $stmt->bindParam(":service_id", $service_id, PDO::PARAM_INT);
          $stmt->bindParam(":id_user", $_SESSION['user_id'], PDO::PARAM_INT);
          $stmt->execute();

          echo "<script class='like_info'> window.increase = false;</script>";

        }else{
          $stmt = null;

          $stmt = $conn->prepare("UPDATE adverts SET likes=likes+1 WHERE id_advert = :service_id  ");
          $stmt->bindParam(":service_id", $service_id, PDO::PARAM_INT);
          $stmt->execute();

          $stmt = null;

          $stmt = $conn->prepare("INSERT INTO liked_adverts (id_advert, id_user) VALUES (:service_id, :id_user)");
          $stmt->bindParam(":service_id", $service_id, PDO::PARAM_INT);
          $stmt->bindParam(":id_user", $_SESSION['user_id'], PDO::PARAM_INT);
          $stmt->execute();

          echo "<script class='like_info'> window.increase = true;</script>";
        }

    }
  }catch(PDOException $e){
    echo $sql . "<br><br>" . $e->getMessage();
  }

?>
