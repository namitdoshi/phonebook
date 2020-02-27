<?php 
  session_start();
  if (isset($_SESSION['id'])) {
    $title = 'Edit User';
    include ('./admin-header.php');
    include './connection.php';
    $user_id = $_GET['id'];
    
    if (isset($_POST['submit'])) {
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $email = $_POST['email'];
      $number = $_POST['number'];

      $upadte_user = "UPDATE registeration SET fname = '$fname', lname = '$lname', email = '$email', mobile = '$mobile' WHERE user_id = '$user_id'";
      $update = $con -> query($upadte_user);

      if ($update) {
        header('location: ./admin.php');
      }

    }

      $read = "SELECT * FROM registeration WHERE user_id = '$id' AND status = 'active'";
      $result = $con->query($read);
  }
  ?>