<?php
  session_start();
  if (isset($_SESSION['id'])) {
    $title = 'Add profile photo';
    include './header.php';
    include './connection.php';
    
    if (isset($_POST['submit-file'])) {
      if ($_FILES['file']['name']) {
        $import = false;
        $filename = explode('.', $_FILES['file']['name']);
        if ($filename[1] == 'jpg' || $filename[1] == 'jpeg' || $filename[1] == 'png') {
          $file = fopen($_FILES['file']['tmp_name'], "r");
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
              <span>Sellect Image</span>
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

      <?php

  } else {
    header('./login.php');
  }
  
?>