<?php include_once 'db_connection.php';?>

<?php

  $verification_code = $_GET['verification_code'];

  $stmt = $conn->prepare("SELECT is_verificated FROM users WHERE verification_code = :verification_code");
  $stmt->bindParam(":verification_code", $verification_code, PDO::PARAM_STR);
  $stmt->execute();
  $is_verificated = $stmt->fetchColumn();

  if($is_verificated == 0){

    $stmt = $conn->prepare("SELECT id_user FROM users WHERE verification_code = :verification_code");
    $stmt->bindParam(":verification_code", $verification_code, PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->rowCount();

    if($results == 1){
    	$id_user = $stmt->fetchColumn();

    	$stmt = $conn->prepare("UPDATE users SET is_verificated = 1 WHERE id_user = :id_user");
    	$stmt->bindParam(":id_user", $id_user, PDO::PARAM_INT);
    	$stmt->execute();

    	echo "Verification account successfull!";
    }else{
    	echo "Something go wrong. Try another time :(";
    }
  }else{
    echo "Account is already verificated";
  }

?>
