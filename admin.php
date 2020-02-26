<?php
  session_start();
  if (isset($_SESSION['id'])) {
    $title = 'Admin home';
    include ('./admin-header.php');
    include ('./connection.php');

    $viewUserQuery = "SELECT * FROM registeration";
    $viewUser = $con -> query($viewUserQuery);
    if ($viewUser -> num_rows > 0) {
?>
<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>First Name <a href="?sortByfname=true" class="waves-effect waves-light btn" name="sort">Sort</a></th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Mobile Number</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php
    while ($row = $viewUser -> fetch_assoc()) {
    ?>
      <tr>
          <td><?php echo $row['id'] ?></td>
          <td><?php echo $row['fname'] ?></td>
          <td><?php echo $row['lname'] ?></td>
          <td><?php echo $row['email'] ?></td>
          <td><?php echo $row['mobile'] ?></td>
          <td><a class="waves-effect waves-light btn" href="./edit.php?id=<?php echo $row['id']?>">Edit</a></td>
          <td><a class="waves-effect waves-light btn" href="?id=<?php echo $row['id']; ?>" name="delete">Delete</a></td>
        </tr>
    <?php
    }
    }
  } else {
    header('location: ./login.php');
  }
?>