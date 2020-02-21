<?php 
  include './connection.php';
  $groupID = $_GET['groupId'];
  // $viewContactsQuery = "SELECT * FROM group_contacts_list WHERE groupId = '$groupID' RIGHT JOIN user_details ON group_contacts_list.id = user_details.id" ;
  $viewContactsQuery = "SELECT * FROM `group_contacts_list` LEFT JOIN user_details ON user_details.id = group_contacts_list.id WHERE group_contacts_list.groupId = '$groupID'";
  $viewContacts = $con -> query($viewContactsQuery);
?>
<head>
  <title>View Saved Contacts</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <script>
    function deleteContact (contactId) {
      console.log(contactId)
    }
  </script>
</head>

<body>
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
        <td><a href="#" class="waves-effect waves-light btn" onClick="deleteContact(<?php echo $row['id']; ?>)">Delete</a></td>

      </tr>
      <?php    
    }
  } else {
    echo 'No Contacts were found in your Group!';
  }
?>
    </tbody>
  </table>

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>