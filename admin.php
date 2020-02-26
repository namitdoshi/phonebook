<?
  session_start();
  if (isset($_SESSION['id'])) {
    
  } else {
    header('location: ./login.php');
  }
?>