<?php
  
  session_start();
  if (isset($_SESSION['id'])) {
    header('location: ./home.php');
  } else {
    include './connection.php';
    if (isset($_POST['login'])) {
      $email = $_POST['email'];
      $password = md5($_POST['password']);
      // $loginQuery = "SELECT fname, lname, email, mobile FROM registeration WHERE email = '$email' AND password = '$password'";
      $loginQuery = "SELECT * FROM registeration WHERE email = '$email' and status = 'active'";
      $login = $con -> query($loginQuery);
      $adminLoginQuery = "SELECT * FROM admin WHERE email = '$email'";
      $adminLogin = $con -> query($adminLoginQuery);
      // if ($login) {
      //   print 'ssds';
      // }
      if ($login -> num_rows > 0) {
        print 'aaaa';
        $row = $login -> fetch_assoc();
        $user_id = $row['user_id'];
        $fname = $row['fname'];
        $lname = $row['lname'];
        $email = $row['email'];
        $mobile = $row['mobile'];
        $pass = $row['password'];
      
       // print $pass . "<br>";
      // print md5($password);
        if ($pass === $password) {
          print 'welcome' . $fname;
          session_start();
          $_SESSION['id'] = $user_id;
          $_SESSION['email'] = $email;
          $_SESSION['name'] = $fname . " " . $lname;
          $_SESSION['type'] = 'client';
          print $_SESSION['name'];
          if (isset($_COOKIE['phonebook-user'])) {
            header('location: ./home.php');
          } else {
            header('location: cookie-set.php');
          }
        } else {
          print '<br>' . 'incorrect password';
        }
      } elseif($adminLogin -> num_rows > 0) {
        $row = $adminLogin -> fetch_assoc();
        $user_id = $row['id'];
        $email = $row['email'];
        $pass = $row['password'];
        $type = $row['type'];
        if ($pass === $password) {
          session_start();
          $_SESSION['id'] = $user_id;
          $_SESSION['email'] = $email;
          $_SESSION['type'] = $type;
          if (isset($_COOKIE['phonebook'])) {
            header('location: ./admin.php');
          } else {
            header('location: cookie-set.php');
          }
        }
      } else {
        print 'incorrect email or password';
        print '<br>';
        print 'contact admin if issue persists';
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

  <div class="container">
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
          <br>
          <span>Don't have an account? Sign up <a href="./signup.php">here</a>.</span>
        </div>
    </form>
  </div>

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>