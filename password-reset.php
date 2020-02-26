<?php
  session_start();
  if (isset($_SESSION['id'])) {

    $user_id = $_SESSION['id'];
    $err = '';  
    include './header.php';
    include './connection.php';
    if (isset($_POST['reset'])) {
      $prepassword = md5($_POST['prepassword']);
      $password = $_POST['password'];
      $repassword = $_POST['repassword'];

      $getPasswordQuery = "SELECT password from registeration WHERE user_id = '$user_id'";
      $getPassword = $con -> query($getPasswordQuery);
      if ($getPassword) {
        if ($getPassword -> num_rows > 0) {
          $row = $getPassword -> fetch_assoc();
          $previousPassword = $row['password'];
          if ($previousPassword === $prepassword) {
            if ($password === $repassword) {
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
            } else {
              $err = 'password do not match';
            }
          } else {
            $err = 'incorrect previous password';
          }
        }
      }
    }
  }
?>


<div class="container">
  <form method="POST">
    <div class="row">
      <div class="input-field col s12">
        <input id="prepassword" type="password" class="validate" name="prepassword" required>
        <label for="prepassword">Password</label>
      </div>
    </div>
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