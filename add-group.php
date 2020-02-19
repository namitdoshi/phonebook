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
  // print $_POST['group-name'];
  // $_POST['group-name'] = '';
  // print $_POST['group-name'];
  // print '<br>';
  if (isset($_POST['submit']) and isset($_POST['group-name'])) {
    print 'phase 1';
    $groupName = $_POST['group-name'];
    $insertIntoGroup = "INSERT INTO group_details (groupName) VALUES ('$groupName')";
    $result = $con -> query($insertIntoGroup);
    if ($result) {
      print 'pass';
      unset($_POST['group-name']);
      unset($groupName);
      print '<br>';
      // print $groupName;
    } else {
      print 'fail';
    }
  }

  $showGroupsQuery = "SELECT * FROM group_details";
  $showGroups = $con -> query($showGroupsQuery);

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

    <div class="row">
      <table>
        <thead>
          <tr>
            <th>Group Id</th>
            <th>Group Name</th>
            <th>Add Contact(s)</th>
            <th>View Saved Contacts</th>
          </tr>
        </thead>

        <tbody>
          <?php 
            if ($showGroups -> num_rows > 0) {
              while($row=$showGroups->fetch_assoc()) {
          ?>
          <tr>
            <td><?php echo $row['groupId']; ?></td>
            <td><?php echo $row['groupName']; ?></td>
            <td><a href="./add-to-group.php?groupId=<?php echo $row['groupId']; ?>" class="waves-effect waves-light btn">+</a></td>
            <td><a href="" class="waves-effects waves-light btn">View</a></td>
          </tr>
          <?php 
              }
            }
          ?>
      </table>
    </div>
  </div>

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>