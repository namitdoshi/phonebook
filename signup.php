<?php 
  if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    
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
    <form class="s 12 ">
      <div class="row">
        <div class="input-field col s6">
          <input id="first_name" type="text" class="validate" required>
          <label for="first_name">First Name</label>
        </div>
        <div class="input-field col s6">
          <input id="last_name" type="text" class="validate" required>
          <label for="last_name">Last Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input id="email" type="text" class="validate" required>
          <label for="email">Email</label>
        </div>
        <div class="input-field col s6">
          <input id="mobile" type="text" class="validate" required>
          <label for="mobile">Mobile</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input id="password" type="text" class="validate" required>
          <label for="password">Password</label>
        </div>
        <div class="input-field col s6">
          <input id="repassword" type="text" class="validate" required>
          <label for="repassword">Re enter password</label>
        </div>
      </div>
      <div class="row">
        <div class="center">
          <input type="submit" value="Submit" class="input-field btn">
        </div>
      </div>
    </form>
  </div>

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>