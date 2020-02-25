<!-- <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registeration Page</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head> -->

<!-- <body> -->

<?php
  session_start();
  if (isset($_SESSION['id'])) {
    $title = 'Add Contacts';
    include ('./header.php');
?>

  <div class="container">
    <form class="col s12" method="POST">
      <div class="row">
        <div class="input-field col s6">
          <input id="first_name" type="text" class="validate" name="fname" required>
          <label for="first_name">First Name</label>
        </div>
        <div class="input-field col s6">
          <input id="last_name" type="text" class="validate" name="lname" required>
          <label for="last_name">Last Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input id="email" type="email" class="validate" name="email" required>
          <label for="email">Email</label>
        </div>
        <div class="input-field col s6">
          <input id="number" type="number" class="validate" name="number" required>
          <label for="number">Mobile Number</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input id="age" type="number" class="validate" name="age" required>
          <label for="age">Age</label>
        </div>
        <div class="input-field col s6">
          <input id="hobby" type="text" class="validate" name="hobby" required>
          <label for="hobby">Hobby</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <select name="gender">
            <option value="" disabled selected>Select </option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
          </select>
          <!-- <input id="gender" type="text" class="validate" name="gender"> -->
          <label for="gender">Gender</label>
        </div>
        <div class="input-field col s6">
          <input id="address" type="text" class="validate" name="address">
          <label for="address">Address</label>
        </div>
      </div>
      <div class="center">
        <input class="waves-effect waves-light btn" type="submit" value="submit" name="submit">
        <a href="./view.php" class="waves-effect waves-light btn">View Submitted Forms</a>
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


<?php
  include './connection.php';
  if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $age = $_POST['age'];
    $hobby = $_POST['hobby'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];

    // print $address;

    $checkEmailQuery = "SELECT email FROM user_details WHERE email = '$email'";
    $checkEmail = $con -> query($checkEmailQuery);

    if ($checkEmail -> num_rows > 0) {
      print 'email already exixsts, please use another email and try again';
    } else {
      $reg_user = "INSERT into user_details (fname, lname, email, mobile, age, hobby, gender, address) values('$fname', '$lname', '$email', '$number', '$age', '$hobby', '$gender', '$address' )";

      $insert = $con->query($reg_user);

      if ($insert) {
        // echo '<script type="text/javascript">'; 
        // echo 'alert("Contact added successfully");'; 
        // echo 'window.location.href = "./add-group.php";';
        // echo '</script>';
        header('location: ./add-contact.php');
      } else {
        print 'fail';
      }
    }

  } else {
    print 'name';
  }
} else {
  header('location: ./please-login.php');
}
?>