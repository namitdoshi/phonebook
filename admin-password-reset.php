<?php
  session_start();
  if (isset($_SESSION['id'])) {
    include './admin-header.php';
    include './connection.php';
    $err= '';
    
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
            $insertQuery = "UPDATE registeration SET password= '$password' WHERE user_id = '$user_id'";
            $insert = $con -> query($insertQuery);
            if ($insert) {
              $err =  'password updated';
            } else {
              $err = 'Oh snap! something went wrong';
            }
          }
        }
      }
    } else {
      header('location: ./admin.php');
      exit;
    }

  } else {
    header('location: ./login.php');
  }
?>

<div class="container">
  <form method="POST" class="s 12">
    <div class="row">
      <div class="input-field col s6">
        <input id="password" type="password" class="validate" name="password" required>
        <label for="password">Password</label>
      </div>
      <div class="input-field col s6">
        <input id="repassword" type="password" class="validate" name="repassword" required>
        <label for="repassword">Re enter password</label>
      </div>
    </div>
    <div class="row">
      <div class="center">
        <input type="submit" value="Submit" class="input-field btn" name="reset">
        <?php 
            echo "<br>";
            echo $err; 
          ?>
      </div>
    </div>
  </form>
</div>

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>