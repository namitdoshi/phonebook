<?php
  session_start();
  if (isset($_SESSION['id'])) {

    $user_id = $_SESSION['id'];
    include './connection.php';
    
    if ($_SESSION['type'] == 'admin') {
      setcookie('phonebook-admin',  $_SESSION['type'], time()+30);
    } else {
      $retrieveDataQuery = "SELECT securityQuestion, securityAnswer FROM registeration WHERE user_id = '$user_id'";
      $retrieveData = $con -> query($retrieveDataQuery);
      $row = $retrieveData -> fetch_assoc();
?>

<head>
  <title>Authentication</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>

<body>
  <div class="container">
    <form class="s12" method="post">
      <div class="row">
        <div class="input-field col s6">
          <input type="text" value="<?php echo $row['securityQuestion'] ?>" disabled>
          <label for="security-question">Securtiy Question</label>
        </div>
        <div class="input-field col s6">
        <input id="security-answer" type="text" class="validate" name="security-answer" required>
          <label for="security-answer">Answer</label>
        </div>
        <div class="row">
          <div class="center">
            <input type="submit" value="submit" name="submit" class="input-field input-btn btn">
          </div>
        </div>
    </form>
  </div>
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

<?php

    }
  } else {
    header('location: ./login.php');
  }
?>