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
      $id = $_GET['id'];
    //   print $email;
      $read = "SELECT * FROM user_details WHERE id='$id'";
      $result = $con->query($read);
    //   if($result) { print 'papapaaasaad'; }
      // $result = mysqli_query($con, $read);
      if ($result -> num_rows > 0) {
        // print 'pass';
        while($row=$result->fetch_assoc()) {
    ?>
      <div class="row">
        <div class="input-field col s6">
          <input id="first_name" type="text" class="validate" name="fname" value="<?php echo $row['fname']; ?>"
            required>
          <label for="first_name">First Name</label>
        </div>
        <div class="input-field col s6">
          <input id="last_name" type="text" class="validate" name="lname" value="<?php echo $row['lname']; ?>" required>
          <label for="last_name">Last Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input id="email" type="email" class="validate" name="email" value="<?php echo $row['email']; ?>" required>
          <label for="email">Email</label>
        </div>
        <div class="input-field col s6">
          <input id="number" type="number" class="validate" name="number" value="<?php echo $row['mobile']; ?>"
            required>
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
          <input id="gender" type="text" class="validate" name="gender" value="<?php echo $row['gender']; ?>" required>
          <label for="gender">Gender</label>
        </div>
        <div class="input-field col s6">
          <input id="address" type="text" class="validate" name="address" value="<?php echo $row['address']; ?>"
            required>
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

        include './connection.php';
        // print $email;
        if (isset($_POST['submit'])) {
          $fname = $_POST['fname'];
          $lname = $_POST['lname'];
          // print "<br>";
          // print "$email";
          $email = $_POST['email'];
          $number = $_POST['number'];
          $age = $_POST['age'];
          $hobby = $_POST['hobby'];
          $gender = $_POST['gender'];
          $address = $_POST['address'];
      
          // print $address;
      
          $update_user = "UPDATE user_details SET fname = '$fname', lname = '$lname', email='$email', mobile = '$number', age = '$age', hobby = '$hobby', gender = '$gender', address = '$address' WHERE id = '$id'";
      
          $insert = $con->query($update_user);
      
          if ($insert) {
            print 'pass';
          } else {
            print 'fail';
          }
      
        } else {
          print 'name';
        }
      ?>
    </form>
  </div>
  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>