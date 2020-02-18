

<head>
  <title>View Details</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>

<body>

<div class="container-fluid">
<table>
    <thead>
      <tr>
        <th>Id</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Mobile Number</th>
        <th>Age</th>
        <th>Hobby</th>
        <th>Gender</th>
        <th>Address</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>

    <tbody>
  <?php
    include './connection.php';
    // print $_GET['id'];
    if (isset($_GET['id'])) {
      $id = $_GET['id'];

      $delete_query = "DELETE FROM `user_details` WHERE `user_details`.`id` = '$id'";
      $res = $con->query($delete_query);
      if ($res) { print 'pass1'; }
    }

    $read = "SELECT * FROM `user_details`";
    $result = $con->query($read);
    
    // $result = mysqli_query($con, $read);
    if ($result -> num_rows > 0) {
      // print 'pass';
      while($row=$result->fetch_assoc()) {
 
  ?>
      <tr>
        <td><?php echo $row['id'] ?></td>
        <td><?php echo $row['fname'] ?></td>
        <td><?php echo $row['lname'] ?></td>
        <td><?php echo $row['email'] ?></td>
        <td><?php echo $row['mobile'] ?></td>
        <td><?php echo $row['age'] ?></td>
        <td><?php echo $row['hobby'] ?></td>
        <td><?php echo $row['gender'] ?></td>
        <td><?php echo $row['address'] ?></td>
        <td><a class="waves-effect waves-light btn" href="./edit.php?id=<?php echo $row['id']?>">Edit</a></td>
        <td><a class="waves-effect waves-light btn" href="?id=<?php echo $row['id']; ?>" name="delete">Delete</a></td>
      </tr>
      <?php
      }
    }
  else {
    print 'fail';
  }
?>
    </tbody>
  </table>
</div>
  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
