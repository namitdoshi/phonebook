<?php
  session_start();
  if (isset($_SESSION['id'])) {
    $title = 'Add profile photo';
    include './header.php';
    include './connection.php';

  } else {
    header('./login.php');
  }
  
?>