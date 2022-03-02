<?php include_once 'db_connection.php';?>

<?php session_start(); ?>

<?php

try{

    if(isset($_POST['title_song']) && isset($_POST['description_song']) && isset($_POST['photo_song_name'])
      && isset($_POST['photo_song_src']) && isset($_POST['file_song_url'])){

      $title_song = $_POST['title_song'];
      $description_song = $_POST['description_song'];
      $photo_song_name = $_POST['photo_song_name'];
      $photo_song_src = $_POST['photo_song_src'];
      $file_song_url = $_POST['file_song_url'];

      $song_added_date = date("Y-m-d") .  " " . date("H:i:s");

      $photo_file_format = substr($photo_song_name, -3);
      if($photo_file_format == "jpg"){
        $photo_song_src_cutted = substr($photo_song_src, 23);
      }else if($photo_file_format == "png"){
        $photo_song_src_cutted = substr($photo_song_src, 22);
      }

      $stmt = $conn->prepare("INSERT INTO adverts (description, advert_added_date, is_song, id_author, song_address, song_name) VALUES (:description_song, :song_added_date, 1, :user_id, :file_song_url, :title_song)");
      $stmt->bindParam(":description_song", $description_song, PDO::PARAM_STR);
      $stmt->bindParam(":song_added_date", $song_added_date, PDO::PARAM_STR);
      $stmt->bindParam(":user_id", $_SESSION['user_id'], PDO::PARAM_INT);
      $stmt->bindParam(":song_added_date", $song_added_date, PDO::PARAM_STR);
      $stmt->bindParam(":file_song_url", $file_song_url, PDO::PARAM_STR);
      $stmt->bindParam(":title_song", $title_song, PDO::PARAM_STR);
      $stmt->execute();

      $stmt = null;

      $stmt = $conn->prepare("SELECT id_advert FROM adverts WHERE id_author = :user_id AND song_address = :file_song_url");
      $stmt->bindParam(":user_id", $_SESSION['user_id'], PDO::PARAM_INT);
      $stmt->bindParam(":file_song_url", $file_song_url, PDO::PARAM_STR);
      $stmt->execute();

      $id_song = $stmt->fetchColumn();

      $stmt = null;

      $stmt = $conn->prepare("INSERT INTO images (id_advert, photo_url) VALUES (:id_song, :photo_song_src_cutted)");
      $stmt->bindParam(":id_song", $id_song, PDO::PARAM_INT);
      $stmt->bindParam(":photo_song_src_cutted", $photo_song_src_cutted, PDO::PARAM_STR);
      $stmt->execute();

    }

  }catch(PDOException $e){
    echo $sql . "<br><br>" . $e->getMessage();
  }

?>
