<?php include_once 'db_connection.php'; ?>
<?php session_start(); ?>

<?php

  try{
    if(isset($_POST['song_id']) && isset($_POST['user_id']) && isset($_POST['content'])){

      $song_id = $_POST['song_id'];
      $user_id = $_POST['user_id'];
      $content = $_POST['content'];

      $comment_added_date = date("Y-m-d") .  " " . date("H:i:s");

      $stmt = $conn->prepare("INSERT INTO commented_adverts (id_advert, id_user, comment_added_date, content) VALUES (:song_id, :id_user, :comment_added_date, :content)");
      $stmt->bindParam(":song_id", $song_id, PDO::PARAM_INT);
      $stmt->bindParam(":id_user", $user_id, PDO::PARAM_INT);
      $stmt->bindParam(":comment_added_date", $comment_added_date, PDO::PARAM_STR);
      $stmt->bindParam(":content", $content, PDO::PARAM_STR);
      $stmt->execute();

    }
  }catch(PDOException $e){
    echo $sql . "<br><br>" . $e->getMessage();
  }


?>
