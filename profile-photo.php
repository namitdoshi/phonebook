<?php
  session_start();
  if (isset($_SESSION['id'])) {
    $title = 'Add profile photo';
    $user_id = $_SESSION['id'];
    include './header.php';
    include './connection.php';
    
    if (isset($_POST['submit-file'])) {
      $target = 'images/' . basename($_FILES['user-image']['name']);

      if ($_FILES['user-image']['name']) {
        $import = false;
        $filename = explode('.', $_FILES['user-image']['name']);
        if ($filename[1] == 'jpg' || $filename[1] == 'jpeg' || $filename[1] == 'png') {
          $image = $_FILES['user-image']['name'];

          // $insertImageQuery = "INSERT into registeration "
          $insertImageQuery = "UPDATE registeration SET picture = '$image' WHERE user_id = '$user_id'";
          $insertImage = $con -> query($insertImageQuery);
          if ($insertImage) {
            // print ' sfdfsdfs';
            if (move_uploaded_file($_FILES['user-image']['tmp_name'], $target)) {
              print 'uploaded';
            } else {
              print 'fail';
            }
          }

        } else {
          echo 'Please provide a jpeg, jpg or png file as input only!';
        }  
      }
    }

?>

<div class="container">
  <form method="POST" enctype="multipart/form-data">
    <div class="row center">
      <div style="width: 30%; margin: auto;">
        <form method="POST" class="col s12" enctype="multipart/form-data">
          <div class="file-field input-field col s9">
            <div class="btn">
              <span>Select Image</span>
              <input type="file" name="user-image" required>
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text" required>
            </div>
          </div>
          <div class="col s3">
            <input type="submit" value="Submit" name="submit-file" class="input-field btn">
          </div>
        </form>
      </div>

      <!-- Compiled and minified JavaScript -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script src="./main.js"></script>

      <?php

  } else {
    header('./login.php');
  }
  
?>