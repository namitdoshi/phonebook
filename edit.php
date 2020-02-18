<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registeration Page</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>

<body>
  <div class="container">
    <form class="col s12" method="POST">
    <?php 
      include './connection.php';
      $email = $_GET['email'];
    //   print $email;
      $read = "SELECT * FROM user_details WHERE email='$email'";
      $result = $con->query($read);
    //   if($result) { print 'papapaaasaad'; }
      // $result = mysqli_query($con, $read);
      if ($result -> num_rows > 0) {
        // print 'pass';
        while($row=$result->fetch_assoc()) {
    ?>
      <div class="row">
        <div class="input-field col s6">
          <input id="first_name" type="text" class="validate" name="fname" value="<?php echo $row['fname']; ?>" required>
          <label for="first_name">First Name</label>
        </div>
        <div class="input-field col s6">
          <input id="last_name" type="text" class="validate" name="lname" value="<?php echo $row['lname']; ?>" required>
          <label for="last_name">Last Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input id="email" type="email" class="validate" name="email" value="<?php echo $row['email']; ?>">
          <label for="email">Email</label>
        </div>
        <div class="input-field col s6">
          <input id="number" type="number" class="validate" name="number" value="<?php echo $row['mobile']; ?>" required>
          <label for="number">Mobile Number</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input id="age" type="number" class="validate" name="age" value="<?php echo $row['age']; ?>" required>
          <label for="age">Age</label>
        </div>
        <div class="input-field col s6">
          <input id="hobby" type="text" class="validate" name="hobby" value="<?php echo $row['hobby']; ?>" required>
          <label for="hobby">Hobby</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input id="gender" type="text" class="validate"  name="gender" value="<?php echo $row['gender']; ?>">
          <label for="gender">Gender</label>
        </div>
        <div class="input-field col s6">
          <input id="address" type="text" class="validate" name="address" value="<?php echo $row['address']; ?>">
          <label for="address">Address</label>
        </div>
      </div>
      <div class="center">
        <input class="waves-effect waves-light btn" type="submit" value="update" name="submit">
        <a href="./view.php" class="waves-effect waves-light btn">View Submitted Forms</a>
      </div>
      <?php
          }
        }
      ?>
    </form>
  </div>
  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
