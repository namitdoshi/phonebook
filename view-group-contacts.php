<?php 
  include './connection.php';
  $groupID = $_GET['groupId'];
  $viewContactsQuery = "SELECT * FROM group_contacts_list WHERE groupId = '$groupID' RIGHT JOIN user_details ON group_contacts_list.id = user_details.id" ;
  $viewContactsQuery = "SELECT * FROM `group_contacts_list` LEFT JOIN user_details ON user_details.id = group_contacts_list.id WHERE group_contacts_list.groupId = '$groupID'";
  $viewContacts = $con -> query($viewContactsQuery);
?>

<table>
  <thead>
    <tr>
      <th>Contact id</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>EMail</th>
      <th>Mobile</th>
      <th>Age</th>
      <th>Hobby</th>
      <th>Gender</th>
      <th>Address</th>
      <th>Delete</th>
    </tr>
  </thead>
  <?php  
  if ($viewContacts -> num_rows > 0) {
    while ($row = $viewContacts -> fetch_assoc()) {
      // echo $row['id'];
      // echo '<br>';
?>


  <tbody>
    <tr>
      <td><?php echo $row['id']; ?></td>
      <td><?php echo $row['fname']; ?></td>
      <td><?php echo $row['lname']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['mobile']; ?></td>
      <td><?php echo $row['age']; ?></td>
      <td><?php echo $row['hobby']; ?></td>
      <td><?php echo $row['gender']; ?></td>
      <td><?php echo $row['address']; ?></td>
      <td></td>

    </tr>
<?php    
    }
  } else {
    echo 'No Contacts were found in your Group!';
  }
?>
    </tbody>
  </table>