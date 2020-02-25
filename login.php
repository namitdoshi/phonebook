<?php
  
  session_start();
  if (isset($_SESSION['id'])) {
    header('location: ./index.php');
  } else {
    include './connection.php';
    if (isset($_POST['login'])) {
      $email = $_POST['email'];
      $password = md5($_POST['password']);
      // $loginQuery = "SELECT fname, lname, email, mobile FROM registeration WHERE email = '$email' AND password = '$password'";
      $loginQuery = "SELECT * FROM registeration WHERE email = '$email'";
      $login = $con -> query($loginQuery);
      if ($login) {
        if ($login -> num_rows > 0) {
          $row = $login -> fetch_assoc();
            $user_id = $row['id'];
            $fname = $row['fname'];
            $lname = $row['lname'];
            $email = $row['email'];
            $mobile = $row['mobile'];
            $pass = $row['password'];
          
          // print $pass . "<br>";
          // print md5($password);
        }
        if ($pass === $password) {
          print 'welcome' . $fname;
          session_start();
          $_SESSION['id'] = $user_id;
          $_SESSION['email'] = $email;
          $_SESSION['name'] = $fname . " " . $lname;
          print $_SESSION['name'];
          header('location: ./index.php');
        } else {
          print '<br>' . 'incorrect password';
        }
      } else {
        print 'incorrect email';
      }
    } 
  }
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>

<body>

  <div class="container">>
    <form method="POST" class="">
      <div class="row">
        <div class="col s4"></div>
        <div class="input-field col s4">
          <input id="email" type="email" class="validate" name="email" required>
          <label for="email">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="col s4"></div>
        <div class="input-field col s4">
          <input id="password" type="password" class="validate" name="password" required>
          <label for="password">Password</label>
        </div>
      </div>
      <div class="row">
        <div class="center">
          <input type="submit" value="Login" class="input-field btn" name="login">
        </div>
    </form>
  </div>

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>