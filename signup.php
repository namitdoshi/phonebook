<?php 
  include './connection.php';
  $err =' ';
  if (isset($_POST['submit'])) {
    // echo 'a';
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
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
        $checkEmailQuery = "SELECT email FROM registeration WHERE email = '$email'";
        $checkEmai = $con -> query($checkEmailQuery);
        if ($checkEmai -> num_rows > 0) {
          $err = 'email already exists';
        } else {
          $password = md5($password);
          $insertQuery = "INSERT INTO registeration (fname, lname, email, mobile, password) VALUES ('$fname', '$lname', '$email', '$mobile', '$password')";
          $insert = $con -> query($insertQuery);
          if ($insert) {
            // print 'Yee-haw';
            print $err;
            header('location: ./signup.php');
          }
        }
      }
    } else {
      $err = 'password do not match!';
    }
  }
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>

<body>
  <div class="container">
    <form class="s 12" method="POST">
      <div class="row">
        <div class="input-field col s6">
          <input id="fname" type="text" class="validate" name="fname" required>
          <label for="fname">First Name</label>
        </div>
        <div class="input-field col s6">
          <input id="lname" type="text" class="validate" name="lname" required>
          <label for="lname">Last Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input id="email" type="text" class="validate" name="email" required>
          <label for="email">Email</label>
        </div>
        <div class="input-field col s6">
          <input id="mobile" type="text" class="validate" name="mobile" required>
          <label for="mobile">Mobile</label>
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
          <input type="submit" value="Submit" class="input-field btn" name="submit">
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
</body>

</html>