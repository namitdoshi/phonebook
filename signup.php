<?php 

  session_start();
  if (isset($_SESSION['id'])) {
    header('location: ./user-home.php');
  } else {
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
      $security_question = $_POST['security-question'];
      $security_answer = $_POST['security-answer'];
      
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
            $insertQuery = "INSERT INTO registeration (fname, lname, email, mobile, password, status, securityQuestion, securityAnswer) VALUES ('$fname', '$lname', '$email', '$mobile', '$password', 'active', '$security_question', '$security_answer')";
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
          <input id="mobile" type="text" class="validate" name="mobile" maxlength="10" required>
          <label for="mobile">Mobile</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <select name="security-question" required>
            <option value="" disabled selected>Choose your option</option>
            <option value="What is you birth place?">What is you birth place?</option>
            <option value="What is your pet's name?">What is your pet's name?</option>
            <option value="What is vehicle's registeration number?">What is vehicle's registeration number?</option>
          </select>
          <label>Security Question</label>
        </div>
        <div class="input-field col s6">
          <input id="security-answer" type="text" class="validate" name="security-answer" required>
          <label for="security-answer">Answer</label>
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
            if ($err != ' ') {
              echo '<br>' . $err;
            }
            echo '<br>';
          ?>
          <span>Already have an account? Login <a href="./login.php">here</a>.</span>
        </div>
      </div>
    </form>
  </div>

  <!-- Compiled and minified JavaScript -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script src="./main.js"></script>
  
</body>

</html>