<?
  session_start();
  if (isset($_SESSION[''])) {
    
  } else {
    header('location: ./login.php');
  }
?>