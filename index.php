<!-- <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PhoneBook Home</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>

<body> -->

  <?php 
    session_start();
    if (isset($_SESSION['id'])) {
      $title = 'PhoneBook Home';
      include ('./header.php');
      include ('./connection.php');
      $user_id = $_SESSION['id'];

      $retrieveImageQuery = "SELECT picture FROM registeration WHERE  user_id = '$user_id'";
      $retrieveImage = $con -> query($retrieveImageQuery);
      if ($retrieveImage) {
        print 'asdfgh';
        $row = $retrieveImage -> fetch_assoc();
      } else {
        print 'dsds';
      }
    } else {
      header('location: ./login.php');
    }

  ?>

  <div class="container" style="margin-top: 5%;">
  <div class="row">
    <div class="center">
      <img src="./images/<?php echo $row['picture']; ?>" height="200" width="150">
    </div>
  </div>
  <div class="row">
    <div class="center">
      <a href="./add-contact.php" class="waves-effect waves-light btn">Add Contact</a>
      <a href="./add-group.php" class="waves-effect waves-light btn">Add Group</a>
      <a href="./deactivate.php" class="waves-effect waves-light btn">Deactivate Account</a>
    </div>
  </div>
  </div>

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>