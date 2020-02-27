<!-- <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add to group</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>

<body> -->

<?php 
    session_start();
    if (isset($_SESSION['id'])) {

      $user_id = $_SESSION['id'];
      $title = 'Add Contacts to Group';
      include ('./header.php');
      include './connection.php';
      // print $_GET['id'];
      // $searchData = '';
      // $flag = 0;

      // if ($flag == 0) {
      //   $read = "SELECT * FROM `user_details`";
      //   $result = $con->query($read);
      // }

      if (isset($_POST['search']) and isset($_POST['searchBy'])) {
        print 'asd';
        $searchBy = $_POST['searchBy'];
        print $searchBy;
        $searchData = $_POST['search-box'];
        // $searchQuery = "SELECT * FROM user_details WHERE $searchBy = '$searchData'";
        $searchQuery = "SELECT * FROM user_details WHERE $searchBy LIKE '%$searchData%' AND user_id = '$user_id'";
        $result = $con->query($searchQuery);
        if ($result) {
          print 'match';
        } else { print 'not match'; }
      }
      else {
        $gId = $_GET['groupId'];
        // $read = "SELECT * FROM `user_details`";
        // $read = "SELECT * FROM user_details WHERE id NOT IN (SELECT contactid from group_contacts_list WHERE groupId = '$gId')";
        $read = "SELECT * FROM user_details WHERE id NOT IN (SELECT contactid from group_contacts_list WHERE groupId = '$gId') AND user_id = '$user_id'";
        $result = $con->query($read);
      }

      if (isset($_POST['add-contact']) and isset($_GET['groupId'])) {
        print 'kay';
        // print $_POST['contacts'];
        // $checkBox = implode(',', $_POST['contacts']);
        // $selectvalue = $_POST['contacts'];
        $groupId = $_GET['groupId'];
        print 'sasa';
        foreach ($_POST['contacts'] as $contact) {
    
          // $addContactQuery = "INSERT INTO `group_contacts_list` (`groupId`, `contactidid`) VALUES ('$groupId', '$contact')";
          $addContactQuery = "INSERT INTO `group_contacts_list` (`user_id`, `groupId`, `contactid`) VALUES ('$user_id', '$groupId', '$contact')";
          $insertContacts = $con -> query($addContactQuery);
    
          if ($insertContacts) {
            header('location: ./add-to-group.php?groupId=' . $groupId);
          } else {
            print 'Please try again!';
          }
        }
        // print $checkBox;
        // $groupId = $_GET['groupId'];
        // $addContactQuery = "INSERT INTO group_contact_list (groupId, id) VALUES ('$groupId', '" . $checkBox . "')";
        // $insertContacts = $con -> query($addContactQuery);

        // if ($insertContacts) {
        //   print 'yay';
        // } else {
        //   print 'nay';
        // }

      }

      // if (isset($_POST['search'])) {
        // $searchData = $_POST['search-box'];
        // $searchQuery = "SELECT * FROM user_details WHERE fname = '$searchData'";
        // $result = $con->query($searchQuery);
        // $flag = 1;
        // print 'qorj';
        // if ($result) {
        //   print 'match';
        // } else { print 'not match'; }
      // }


      // if (isset($_GET['id'])) {
      //   $id = $_GET['id'];

      //   $delete_query = "DELETE FROM `user_details` WHERE `user_details`.`id` = '$id'";
      //   $res = $con->query($delete_query);
      //   if ($res) { print 'pass1'; }
      // }

      // $read = "SELECT * FROM `user_details`";
      // $result = $con->query($read);
      
      // $result = mysqli_query($con, $read);
      if ($result -> num_rows > 0) {
        // print 'pass';

?>

  <div class="container">
    <form method="POST" class="col s12">
      <div class="row">
        <div class="input-field col s4">
          <input id="search-box" type="text" class="validate" name="search-box">
        </div>
        <div class="input-field col s4">
          <select name="searchBy">
            <option value="" disabled selected>Choose option </option>
            <option value="fname">First Name</option>
            <option value="lname">Last Name</option>
            <option value="email">Email</option>
            <!-- <option value="mobile">Mobile</option>
            <option value="age">Age</option>
            <option value="hobby">Hobby</option>
            <option value="gender">Gender</option>
            <option value="address">Address</option> -->
          </select>
          <label>Search By</label>
        </div>
        <div class="input-field col-3">
          <input type="submit" value="Search" class="input-field input-btn btn" name="search">
          <!-- <a href="" class="waves-effect waves-light btn" name="search">Search</a> -->
        </div>
      </div>
    </form>

    <!-- Groups to Add -->

    <div class="row">
      <form method=POST>
        <div class="input-field col s4">
          <select multiple name="contacts[]">
            <option value="" disabled selected>Choose option</option>
            <?php 
              while($row=$result->fetch_assoc()) {
            ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['fname'] . ' ' . $row['lname']; ?></option>
            <?php
              }
            ?>
          </select>
          <label>Add Contacts</label>
        </div>
        <!-- </div>
    <div class="row center"> -->
        <input type="submit" value="Save Changes" class="input-field input-btn btn" name="add-contact">
      </form>
    </div>
  </div>

</body>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="./main.js"></script>
</body>

<?php
      }
      else {
        print 'No contacts found, add some first!';
      }
    } else {
      header('location: ./login.php');
    }
?>