<?php
  session_start();
  if (isset($_SESSION['id'])) {
    $title = 'Admin home';
    include ('./admin-header.php');
    include ('./connection.php');

    if (isset($_GET['id'])) {
      $user_id = $_GET['id'];
      $deleteUserQuery = "UPDATE registeration r, user_details u, group_contacts_list g1, group_details g2 SET r.status = 'deleted', u.status = 'deleted', g1.status = 'deleted', g2.status = 'active' WHERE (r.user_id = '$user_id' AND u.user_id = '$user_id' AND g1.user_id = '$user_id' AND g2.user_id = '$user_id')";
      $deleteUser = $con -> query($deleteUserQuery);
    // UPDATE group_contacts_list g1, group_details g2 SET g1.status = 'active', g2.status = 'active'
      if ($deleteUser) {
        header('location: ./admin.php');
      } else {
        print 'abc';
      }

    }

    $viewUserQuery = "SELECT * FROM registeration WHERE status = 'active' OR status = 'deactivated'";
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
      <th>Rest Password</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php
    while ($row = $viewUser -> fetch_assoc()) {
    ?>
      <tr>
          <td><?php echo $row['user_id'] ?></td>
          <td><?php echo $row['fname'] ?></td>
          <td><?php echo $row['lname'] ?></td>
          <td><?php echo $row['email'] ?></td>
          <td><?php echo $row['mobile'] ?></td>
          <td><a class="waves-effect waves-light btn" href="./edit.php?id=<?php echo $row['user_id']?>">Edit</a></td>
          <td><a href="./admin-password-reset.php?id=<?php echo $row['user_id']?>" class="waves-effect waves-light btn">Reset Password</a></td>
          <td><a class="waves-effect waves-light btn" href="?id=<?php echo $row['user_id']; ?>" name="delete">Delete</a></td>
        </tr>
    <?php
    }
    }
  } else {
    header('location: ./login.php');
  }
?>