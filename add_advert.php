<?php include_once 'db_connection.php';?>

<?php session_start(); ?>

<?php

try{

    if(isset($_POST['title_advert']) && isset($_POST['place_name']) && isset($_POST['description_advert']) && isset($_POST['photo_advert_name'])
      && isset($_POST['photo_advert_src'])){

      $title_advert = $_POST['title_advert'];
      $place_name = $_POST['place_name'];
      $description_advert = $_POST['description_advert'];
      $photo_advert_name = $_POST['photo_advert_name'];
      $photo_advert_src = $_POST['photo_advert_src'];

      $advert_added_date = date("Y-m-d") .  " " . date("H:i:s");

      $photo_file_format = substr($photo_advert_name, -3);
      if($photo_file_format == "jpg"){
        $photo_advert_src_cutted = substr($photo_advert_src, 23);
      }else if($photo_file_format == "png"){
        $photo_advert_src_cutted = substr($photo_advert_src, 22);
      }

      $stmt = $conn->prepare("INSERT INTO adverts (advert_name,  place_name, description, advert_added_date, is_musical_instrument, id_author) VALUES (:title_advert, :place_name, :description_advert, :advert_added_date, 1, :user_id)");
      $stmt->bindParam(":title_advert", $title_advert, PDO::PARAM_STR);
      $stmt->bindParam(":place_name", $place_name, PDO::PARAM_STR);
      $stmt->bindParam(":description_advert", $description_advert, PDO::PARAM_STR);
      $stmt->bindParam(":advert_added_date", $advert_added_date, PDO::PARAM_STR);
      $stmt->bindParam(":user_id", $_SESSION['user_id'], PDO::PARAM_INT);
      $stmt->execute();

      $stmt = null;

      $stmt = $conn->prepare("SELECT id_advert FROM adverts WHERE id_author = :user_id AND advert_added_date = :advert_added_date AND advert_name = :title_advert");
      $stmt->bindParam(":user_id", $_SESSION['user_id'], PDO::PARAM_INT);
      $stmt->bindParam(":advert_added_date", $advert_added_date, PDO::PARAM_STR);
      $stmt->bindParam(":title_advert", $title_advert, PDO::PARAM_STR);
      $stmt->execute();

      $id_advert = $stmt->fetchColumn();

      $stmt = null;

      $stmt = $conn->prepare("INSERT INTO images (id_advert, photo_url) VALUES (:id_advert, :photo_advert_src_cutted)");
      $stmt->bindParam(":id_advert", $id_advert, PDO::PARAM_INT);
      $stmt->bindParam(":photo_advert_src_cutted", $photo_advert_src_cutted, PDO::PARAM_STR);
      $stmt->execute();

    }

  }catch(PDOException $e){
    echo $sql . "<br><br>" . $e->getMessage();
  }

?>
