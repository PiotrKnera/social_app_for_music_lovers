<?php include_once 'db_connection.php';?>
<?php session_start(); ?>

<?php

  if(isset($_SESSION['timeout']) ) {
    $session_life = time() - $_SESSION['timeout'];

    if($session_life == 500){
      echo "2";
    }else if($session_life >= 600){
      echo "0";
    }else echo "1";
  }else{
    echo "1";
  }

?>
