<?php include_once 'db_connection.php';?>

<?php session_start(); ?>

<?php

  try{
    if(isset($_POST['language'])){

      $_SESSION['language'] = $_POST['language'];

    }
  }catch(PDOException $e){
    echo $sql . "<br><br>" . $e->getMessage();
  }

?>
