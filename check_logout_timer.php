<?php include_once 'db_connection.php';?>
<?php session_start(); ?>

<?php

  if(isset($_SESSION['timeout']) ) {
    $session_life = time() - $_SESSION['timeout'];
    $_SESSION['logout_timer'] = 600;
    $_SESSION['logout_timer'] -= $session_life;

    echo $_SESSION['logout_timer'];
  }

?>
