<!-- <head>
  <title>View Contacts</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>

<body> -->

<?php 
  include './header.php';
  session_start();
    if (isset($_SESSION['id'])) {
        
      include './connection.php';
      $user_id = $_SESSION['id'];
      // print $_GET['id'];
      // $searchData = '';
      // $flag = 0;

      // if ($flag == 0) {
      //   $read = "SELECT * FROM `user_details`";
      //   $result = $con->query($read);
      // }

      if (isset($_POST['search']) and isset($_POST['searchBy'])) {
        // print 'asd';
        $searchBy = $_POST['searchBy'];
        // print $searchBy;
        $searchData = $_POST['search-box'];
        // $searchQuery = "SELECT * FROM user_details WHERE $searchBy = '$searchData'";
        $searchQuery = "SELECT * FROM user_details WHERE $searchBy = '$searchData' AND user_id = '$user_id'";
        $result = $con->query($searchQuery);
        if ($result) {
          print 'match';
        } else { print 'not match'; }
      }

      elseif (isset($_GET['sortByfname'])) {
        // print 'beepbop';
        // $sortFname = "SELECT * FROM user_details ORDER BY fname";
        $sortFname = "SELECT * FROM user_details WHERE user_id = '$user_id' ORDER BY fname";
        $result = $con->query($sortFname);
      //   if ($result) {
      //     print 'match';
      //   } else { print 'not match'; }
      }
      
      else {
        // $read = "SELECT * FROM `user_details`";
        $read = "SELECT * FROM `user_details` WHERE user_id = '$user_id'";
        $result = $con->query($read);
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


      if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // $delete_query = "DELETE FROM `user_details` WHERE `user_details`.`id` = '$id'";
        $delete_query = "DELETE FROM `user_details` WHERE `user_details`.`id` = '$id' AND user_id = '$user_id'";
        $res = $con->query($delete_query);
        if ($res) { print 'pass1'; }
      }

      if (isset($_POST['submit-file'])) {
        // if(isset($_POST['file'])) {
        //   echo $_POST['file'];
        // }
        // $fileName = $_POST['file'];
        // $csv = array_map('str_getcsv', file($fileName));
        // print $csv;
        // $file = fopen($fileName, "r");
        // while (($getData = fgetcsv($file, 10, ",")) !== FALSE) { }

        if ($_FILES['file']['name']) {
          $import = false;
          $filename = explode('.', $_FILES['file']['name']);
          if ($filename[1] == 'csv') {
            $file = fopen($_FILES['file']['tmp_name'], "r");
            while ($data = fgetcsv($file)) {
              // $checkEmailQuery = "SELECT email FROM user_details WHERE email = '$data[2]'";
              $checkEmailQuery = "SELECT email FROM user_details WHERE email = '$data[2]' AND user_id = '$user_id'";
              $checkEmail = $con -> query($checkEmailQuery);

              if ($checkEmail -> num_rows > 0) {
                continue;
              } else {
                $importQuery = "INSERT INTO user_details (user_id, fname, lname, email, mobile, age, hobby, gender, address) VALUES ('$user_id', '$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$data[5]', '$data[6]', '$data[7]')";
                $import = $con -> query($importQuery);
              }
            }
            if ($import) { 
              echo 'data imported successfully!';
              header('location: ./view.php');
            } else {
              print "something's not right, maybe the data already exists!";
            }
          } else {
            echo 'Please provide a csv file as input!';
          }
        }
      }

      // $read = "SELECT * FROM `user_details`";
      // $result = $con->query($read);
      
      // $result = mysqli_query($con, $read);
      if ($result -> num_rows > 0) {
        // print 'pass';
    
?>

  <div class="container-fluid">
    <div class="row center">
      <div style="width: 30%; margin: auto;">
        <form method="POST" class="col s12" enctype="multipart/form-data">
          <div class="file-field input-field col s9">
            <div class="btn">
              <span>Import</span>
              <input type="file" name="file" required>
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text" required>
            </div>
          </div>
          <div class="col s3">
            <input type="submit" value="Submit" name="submit-file" class="input-field btn">
          </div>
        </form>
      </div>
    </div>
    <table>
      <thead>
        <tr>
          <th>Id</th>
          <th>First Name <a href="?sortByfname=true" class="waves-effect waves-light btn" name="sort">Sort</a></th>
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
    
?>
      </tbody>
    </table>
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
              <option value="mobile">Mobile</option>
              <option value="age">Age</option>
              <option value="hobby">Hobby</option>
              <option value="gender">Gender</option>
              <option value="address">Address</option>
            </select>
            <label>Search By</label>
          </div>
          <div class="col s3">
            <input type="submit" value="Search" class="input-btn input-field btn" name="search">
            <!-- <a href="" class="waves-effect waves-light btn" name="search">Search</a> -->
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- Compiled and minified JavaScript -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script src="./main.js"></script>
</body>

<?php
  } else {
    print 'There are no contacts in your account';
  }
} else {
  header('location: ./login.php');
}
?>