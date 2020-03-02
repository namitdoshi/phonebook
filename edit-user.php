<?php 
  session_start();
  if (isset($_SESSION['id'])) {
    $title = 'Edit User';
    include ('./admin-header.php');
    include './connection.php';
    $user_id = $_GET['id'];
    
    if (isset($_POST['submit'])) {
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $email = $_POST['email'];
      $mobile = $_POST['mobile'];

      $upadte_user = "UPDATE registeration SET fname = '$fname', lname = '$lname', email = '$email', mobile = '$mobile' WHERE user_id = '$user_id'";
      $update = $con -> query($upadte_user);

      if ($update) {
        header('location: ./admin.php');
      } else {
        print 'Oh snap! something went wrong.';
      }

    }

    $read = "SELECT * FROM registeration WHERE user_id = '$user_id' AND status = 'active'";
    $result = $con->query($read);

    if ($result -> num_rows > 0) {
  ?>
<div class="container">
  <form class="col s12" method="POST">
    <?php 
      $row=$result->fetch_assoc();
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
        <input id="email" type="email" class="validate" name="email" value="<?php echo $row['email']; ?>" required>
        <label for="email">Email</label>
      </div>
      <div class="input-field col s6">
        <input id="number" type="number" class="validate" name="mobile" value="<?php echo $row['mobile']; ?>" required>
        <label for="number">Mobile Number</label>
      </div>
    </div>
    <div class="center">
      <input class="input-btn input-field btn" type="submit" value="update" name="submit">
      <!-- <a href="./view.php" class="waves-effect waves-light btn">View Saved Contacts</a> -->
    </div>
  </form>
</div>
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>

<?php
    }
  } else {
    header('location: ./index.php');
  }
?>