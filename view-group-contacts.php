<?php 
  include './connection.php';
  $groupID = $_GET['groupId'];
  $viewContactsQuery = "SELECT * FROM group_contacts_list WHERE groupId = '$groupID' RIGHT JOIN user_details ON group_contacts_list.id = user_details.id" ;
  $viewContactsQuery = "SELECT * FROM `group_contacts_list` LEFT JOIN user_details ON user_details.id = group_contacts_list.id WHERE group_contacts_list.groupId = '$groupID'";
  $viewContacts = $con -> query($viewContactsQuery);
  if ($viewContacts -> num_rows > 0) {
    while ($row = $viewContacts -> fetch_assoc()) {
      echo $row['id'];
      echo '<br>';
    }
  } else {
    echo 'No Contacts were found in your Group!';
  }
?>