<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add group</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

</head>

<?php 
  include './connection.php';  
  if (isset($_POST['submit'])) {
    print 'phase 1';
    $groupName = $_POST['group-name'];
    $insertIntoGroup = "INSERT INTO group_details (groupName) VALUES ('$groupName')";
    $result = $con -> query($insertIntoGroup);
    if ($result) {
      print 'pass';
    } else {
      print 'fail';
    }
  }
?>

<body>
  <div class="container">
    <form class="col s12" method="POST">
      <div class="row">
        <div class="center">
          <div class="input-field col s4">
            <input id="group-name" type="text" class="validate" name="group-name" required>
            <label for="group-name">Group Name</label>
          </div>
          <div class="input-field col">
            <input class="waves-effect waves-light btn" type="submit" value="submit" name="submit">
          </div>
        </div>
      </div>
    </form>
  </div>

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>