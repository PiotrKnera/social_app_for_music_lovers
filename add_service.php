<?php include_once 'db_connection.php';?>

<?php session_start(); ?>

<?php

try{

    if(isset($_POST['title_service']) && isset($_POST['place_name']) && isset($_POST['description_service']) && isset($_POST['photo_service_name'])
      && isset($_POST['photo_service_src'])){

      $title_service = $_POST['title_service'];
      $place_name = $_POST['place_name'];
      $description_service = $_POST['description_service'];
      $photo_service_name = $_POST['photo_service_name'];
      $photo_service_src = $_POST['photo_service_src'];

      $service_added_date = date("Y-m-d") .  " " . date("H:i:s");

      $photo_file_format = substr($photo_service_name, -3);
      if($photo_file_format == "jpg"){
        $photo_service_src_cutted = substr($photo_service_src, 23);
      }else if($photo_file_format == "png"){
        $photo_service_src_cutted = substr($photo_service_src, 22);
      }

      $stmt = $conn->prepare("INSERT INTO adverts (advert_name,  place_name, description, advert_added_date, is_service, id_author) VALUES (:title_service, :place_name, :description_service, :service_added_date, 1, :user_id)");
      $stmt->bindParam(":title_service", $title_service, PDO::PARAM_STR);
      $stmt->bindParam(":place_name", $place_name, PDO::PARAM_STR);
      $stmt->bindParam(":description_service", $description_service, PDO::PARAM_STR);
      $stmt->bindParam(":service_added_date", $service_added_date, PDO::PARAM_STR);
      $stmt->bindParam(":user_id", $_SESSION['user_id'], PDO::PARAM_INT);
      $stmt->execute();

      $stmt = null;

      $stmt = $conn->prepare("SELECT id_advert FROM adverts WHERE id_author = :user_id AND advert_added_date = :service_added_date AND advert_name = :title_service");
      $stmt->bindParam(":user_id", $_SESSION['user_id'], PDO::PARAM_INT);
      $stmt->bindParam(":service_added_date", $service_added_date, PDO::PARAM_STR);
      $stmt->bindParam(":title_service", $title_service, PDO::PARAM_STR);
      $stmt->execute();

      $id_service = $stmt->fetchColumn();

      $stmt = null;

      $stmt = $conn->prepare("INSERT INTO images (id_advert, photo_url) VALUES (:id_service, :photo_service_src_cutted)");
      $stmt->bindParam(":id_service", $id_service, PDO::PARAM_INT);
      $stmt->bindParam(":photo_service_src_cutted", $photo_service_src_cutted, PDO::PARAM_STR);
      $stmt->execute();

    }

  }catch(PDOException $e){
    echo $sql . "<br><br>" . $e->getMessage();
  }

?>
