<?php
  session_start();
  if (isset($_SESSION['id'])) {
    include ('./admin-header.php');
  } else {
    header('location: ./login.php');
  }
?>