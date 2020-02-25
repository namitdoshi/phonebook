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
    } else {
      header('location: ./login.php');
    }

  ?>

  <div class="container" style="margin-top: 5%;">
  <div class="row">
    <div class="center">
      <a href="./add-contact.php" class="waves-effect waves-light btn">Add Contact</a>
      <a href="./add-group.php" class="waves-effect waves-light btn">Add Group</a>
    </div>
  </div>
  </div>

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>