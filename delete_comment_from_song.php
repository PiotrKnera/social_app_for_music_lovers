<?php include_once 'db_connection.php'; ?>
<?php session_start(); ?>

<?php

  try{
    if(isset($_POST['comment_id'])){

      $comment_id = $_POST['comment_id'];

      $stmt = $conn->prepare("DELETE FROM commented_adverts WHERE id_com_advert = :comment_id");
      $stmt->bindParam(":comment_id", $comment_id, PDO::PARAM_INT);
      $stmt->execute();

    }
  }catch(PDOException $e){
    echo $sql . "<br><br>" . $e->getMessage();
  }


?>
