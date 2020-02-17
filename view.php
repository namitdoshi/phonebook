

<head>
  <title>View Details</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>

<body>

<div class="container-fluid">
<table>
    <thead>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Mobile Number</th>
        <th>Age</th>
        <th>Hobby</th>
        <th>Gender</th>
        <th>Address</th>
      </tr>
    </thead>

    <tbody>
  <?php
    include './connection.php';
    $read = "SELECT * FROM `user_details`";
    $result = $con->query($read);
    // $result = mysqli_query($con, $read);
    if ($result -> num_rows > 0) {
      // print 'pass';
      while($row=$result->fetch_assoc()) {
 
  ?>
      <tr>
        <td><?php echo $row['fname'] ?></td>
        <td><?php echo $row['lname'] ?></td>
        <td><?php echo $row['email'] ?></td>
        <td><?php echo $row['mobile'] ?></td>
        <td><?php echo $row['age'] ?></td>
        <td><?php echo $row['hobby'] ?></td>
        <td><?php echo $row['gender'] ?></td>
        <td><?php echo $row['address'] ?></td>
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
</div>
  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
