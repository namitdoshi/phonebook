<?php
  session_start();
  if (!isset($_SESSION['id'])) {
    header('location: ./index.php');
  } else {
    session_destroy();
    header('location: ./index.php');
  }
?>