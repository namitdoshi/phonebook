<?php
  session_start();
  if (isset($_SESSION['id'])) {
    $title = 'Admin home';
    include ('./admin-header.php');
    include ('./connection.php');

    // if (isset($_GET['id'])) {
    //   $user_id = $_GET['id'];
    //   // $deleteUserQuery = "DELETE FROM regiseration, group_details, user_details, group_contacts_list WHERE user_id = '$user_id'";
    //   // $deleteUserQuery = "DELETE FROM `group_contacts_list`, `group_details`, `registeration`, `user_details` WHERE group_contacts_list.user_id = '$user_id' AND group_details.user_id = '$user_id' AND registeration.user_id = '$user_id' AND user_details.user_id = '$user_id'";
    //   $deleteUser = $con -> query($deleteUserQuery);
    //   if ($deleteUser) {
    //     header('location: ./admin.php');
    //   } else {
    //     print 'abc';
    //   }

    // }

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