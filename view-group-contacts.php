<?php 
  session_start();
  if (isset($_SESSION['id'])) {
  $title = 'Add Contacts';
  require_once ('./header.php');
  
  include './connection.php';
  $groupID = $_GET['groupId'];
  // $viewContactsQuery = "SELECT * FROM group_contacts_list WHERE groupId = '$groupID' RIGHT JOIN user_details ON group_contacts_list.id = user_details.id" ;
  $viewContactsQuery = "SELECT * FROM `group_contacts_list` LEFT JOIN user_details ON user_details.id = group_contacts_list.contactid WHERE group_contacts_list.groupId = '$groupID'";
  $viewContacts = $con -> query($viewContactsQuery);
  if (isset($_GET['q'])) {
    print 'namit';
    $cId = $_GET['q'];
    $deleteContactQuery = "DELETE FROM `group_contacts_list` WHERE contactid = '$cId'";
    $deleteContact = $con -> query($deleteContactQuery);
    if ($deleteContact) {
      print 'saa';
      header('location: ./view-group-contacts.php');
    } else {
      print 'fail';
    }
  }

  // export contacts
  if (isset($_POST['export'])) {
    ob_clean();
    $filename = $groupID . ".csv";
    // print $filename;
    $fp = fopen('php://output', 'w');\
    header('Content-type: application/csv');
    header('Content-Disposition: attachment; filename='.$filename);
    while ($row = $viewContacts -> fetch_assoc()) {
      fputcsv($fp, $row);
    }
    exit;    
  }

?>

<!-- <head> -->
  <!-- <title>View Saved Contacts</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> -->
  
<!-- </head> -->

<!-- <body> -->
  <table>
    <form method=POST>
      <input type="submit" value="Export" name="export" class="input-field btn">
    </form>
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
        <td><a href="#" class="waves-effect waves-light btn"
            onClick="deleteContact(<?php echo $row['contactid']; ?>)">Delete</a></td>

      </tr>
      <?php    
    }
  } else {
    // echo 'No Contacts were found in your Group!';
    echo '<script type="text/javascript">'; 
    echo 'alert("You don not have any contacts in your group, please add some to view");'; 
    echo 'window.location.href = "./add-group.php";';
    echo '</script>';
  }
} else {
  header('location: ./login.php');
}
?>
    </tbody>
  </table>

  <script>
    function deleteContact(contactId) {
      console.log(contactId)
      if (window.XMLHttpRequest) {
        console.log('namit')
        xmlhttp = new XMLHttpRequest()
        xmlhttp.open("GET", "?q=" + contactId, true)
        xmlhttp.send();
        // location.reload();
      }
    }
  </script>
  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>