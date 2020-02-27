<?php
session_start();
include './connection.php';
$user_id = $_SESSION['id'];
if (isset($_SESSION['id'])) {
  $deactivateQuery = "UPDATE registeration r, user_details u, group_contacts_list g1, group_details g2 SET r.status = 'deactivated', u.status = 'deactivated', g1.status = 'deactivated', g2.status = 'deactivated' WHERE (r.user_id = '$user_id' AND u.user_id = '$user_id' AND g1.user_id = '$user_id' AND g2.user_id = '$user_id')";
  $deactivate = $con -> query($deactivateQuery);
  if ($deactivate) {
    header('location: ./index.php');
  }
} else {
  header('loccation: ./login.php');
}
?>