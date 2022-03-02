<?php include_once 'db_connection.php';?>


<?php session_start(); ?>

<?php

  try{
    if(isset($_POST['new_password']) && isset($_POST['old_password']) ){

      $new_password = $_POST['new_password'];
      $old_password = $_POST['old_password'];

      $stmt = $conn->prepare("UPDATE users SET password = :new_password WHERE :old_password = password AND id_user = :id_user");
      $stmt->bindParam(":new_password", $new_password, PDO::PARAM_STR);
      $stmt->bindParam(":old_password", $old_password, PDO::PARAM_STR);
      $stmt->bindParam(":id_user", $_SESSION['user_id'], PDO::PARAM_INT);
      $stmt->execute();

      echo "<script class='info_password'>alert('Password changed successfully');</script>";

    }
  }catch(PDOException $e){
    echo $sql . "<br><br>" . $e->getMessage();
  }

?>
