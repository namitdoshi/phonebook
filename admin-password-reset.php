<?php
  session_start();
  if (isset($_SESSION['id'])) {
    include './admin-header.php';
    include './connection.php';
    
    if (isset($_GET['id'])) {
      $user_id = $_GET['id'];
      if (isset($_POST['reset'])) {
          $password = $_POST['password'];
          $repassword = $_POST['repassword'];
          
        if ($password == $repassword) {
          print $err;
          if (strlen($password) < 8 || strlen($password) > 16) {
            $err = 'password must be of lenght between 8-16';
          } elseif (!preg_match ("/[0-9]/", $password)) {
            $err = 'password must contain at least one number';
          } elseif (!preg_match("/[a-z]/", $password)) {
             $err = 'password must contain one small case letter';    
          } elseif (!preg_match("/[A-Z]/", $password)) {
            $err = 'password must contain at least one capital letter';
          } elseif (!preg_match("/[!@#%$]/", $password)) {
            $err = 'password must have either of !, @, #, %, $';
          } else {
             $err ='nice password';
            $password = md5($password);
            $insertQuery = "INSERT INTO registeration ( password) VALUES ('$password') WHERE user_id = '$user_id'";
            $insert = $con -> query($insertQuery);
            if ($insert) {
              print 'password updated';
            } else {
              print 'Oh snap! something went wrong';
            }
          }
        }
      }
    } else {
      header('location: ./admin.php');
    }

  } else {
    header('location: ./login.php');
  }
?>