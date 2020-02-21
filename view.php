<head>
  <title>View Details</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>

<body>

  <div class="container-fluid">
    <div class="row center">
      <div style="width: 30%; margin: auto;">
        <form action="#">
          <div class="file-field input-field">
            <div class="btn">
              <span>Import</span>
              <input type="file" name="file">
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text">
            </div>
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
    include './connection.php';
    // print $_GET['id'];
    // $searchData = '';
    $flag = 0;

    // if ($flag == 0) {
    //   $read = "SELECT * FROM `user_details`";
    //   $result = $con->query($read);
    // }

    if (isset($_POST['search']) and isset($_POST['searchBy'])) {
      print 'asd';
      $searchBy = $_POST['searchBy'];
      print $searchBy;
      $searchData = $_POST['search-box'];
      $searchQuery = "SELECT * FROM user_details WHERE $searchBy = '$searchData'";
      $result = $con->query($searchQuery);
      if ($result) {
        print 'match';
      } else { print 'not match'; }
    }

    elseif (isset($_GET['sortByfname'])) {
      // print 'beepbop';
      $sortFname = "SELECT * FROM user_details ORDER BY fname";
      $result = $con->query($sortFname);
    //   if ($result) {
    //     print 'match';
    //   } else { print 'not match'; }
    }
    
    else {
      $read = "SELECT * FROM `user_details`";
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

      $delete_query = "DELETE FROM `user_details` WHERE `user_details`.`id` = '$id'";
      $res = $con->query($delete_query);
      if ($res) { print 'pass1'; }
    }

    // $read = "SELECT * FROM `user_details`";
    // $result = $con->query($read);
    
    // $result = mysqli_query($con, $read);
    if ($result -> num_rows > 0) {
      // print 'pass';
      while($row=$result->fetch_assoc()) {
 
  ?>
        <tr>
          <td></td>
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
          <div class="input-field col-3">
            <input type="submit" value="Search" class="waves-effect waves-light btn" name="search">
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