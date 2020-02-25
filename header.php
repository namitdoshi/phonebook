<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title; ?></title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>

<body>
  <nav>
    <div class="nav-wrapper">
      <a href="./index.php" class="brand-logo">Phone Book</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="./add-contact.php">Add Contact</a></li>
        <li><a href="./view.php">View Contacts</a></li>
        <li><a href="./add-group.php">Add Group</a></li>
        <li><a href="./logout.php">Logout</a></li>
      </ul>
    </div>
  </nav>