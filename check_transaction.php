<?php include_once 'db_connection.php';?>


<?php session_start(); ?>

<?php

if(isset($_POST['advert_id']) && isset($_POST['user_id']) && isset($_POST['author_id'])){

  $advert_id = $_POST['advert_id'];
  $user_id = $_POST['user_id'];
  $author_id = $_POST['author_id'];

  $stmt = $conn->prepare("SELECT offer_start, offer_confirmed, user_confirm_success, author_confirm_success FROM transaction_adverts WHERE id_advert = :advert_id AND id_author = :author_id");
  $stmt->bindParam(":advert_id", $advert_id, PDO::PARAM_INT);
  $stmt->bindParam(":author_id", $author_id, PDO::PARAM_INT);
  $stmt->execute();
  $results = $stmt->rowCount();

  if($results > 0){
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
      $counter1 = 0;
          foreach ($row as $field => $value){
            ++$counter1;

            if($counter1 == 1){
              $offer_start = $value;
            }
            if($counter1 == 2){
              $offer_confirmed = $value;
            }
            if($counter1 == 3){
              $user_confirm_success = $value;
            }
            if($counter1 == 4){
              $author_confirm_success = $value;
            }

          }
    }

    if($offer_start == 1){
      echo "<script class='transaction_6'>sessionStorage.requested = 1;</script>";
    }else{
      echo "<script class='transaction_6'>sessionStorage.requested = 0;</script>";
    }

    if($offer_confirmed == 1){
      echo "<script class='transaction_7'>sessionStorage.advert_author_confirmed_request = 1;</script>";
    }else{
      echo "<script class='transaction_7'>sessionStorage.advert_author_confirmed_request = 0;</script>";
    }

    if($user_confirm_success == 1){
      echo "<script class='transaction_8'>sessionStorage.confirmed_success = 1;</script>";
    }else{
      echo "<script class='transaction_8'>sessionStorage.confirmed_success = 0;</script>";
    }

    if($author_confirm_success == 1){
      echo "<script class='transaction_9'>sessionStorage.advert_author_confirmed_success = 1;</script>";
    }else{
      echo "<script class='transaction_9'>sessionStorage.advert_author_confirmed_succes = 0;</script>";
    }
  }else{
    echo "<script class='transaction_10'>sessionStorage.error = 1;</script>";
  }

}

 ?>
