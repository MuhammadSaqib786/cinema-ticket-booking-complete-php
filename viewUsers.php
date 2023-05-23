<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Home</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- Custom CSS -->
  <style>
    h1 {
      text-align: center;
      margin-top: 1rem;
      margin-bottom: 3rem;
    }
  .navbar
  {
    background : #FDCCE2;
  }
  .navbar-brand
  {
    color: #FFFFFF;
    font-size : 22px;
  }
  .navbar li a {
      color: #FFFFFF;
    }

  </style>
</head>
<body>
 <?php include 'adminNav.php' ?>
  


 <div class="container" style="margin-bottom: 380px; margin-top:30px;">
  <h2>User Report</h2>

  <?php
  // Include the dbconnect.php file to establish the database connection
  require_once 'dbconnect.php';

  try {
    // Retrieve user information from the myUser table
    $query = "SELECT * FROM myUser";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check if there are any users
    if (count($users) > 0) {
      echo '<table class="table table-bordered">';
      echo '<thead>';
      echo '<tr>';
      echo '<th>User ID</th>';
      echo '<th>Username</th>';
      echo '<th>Email</th>';
      echo '<th>Age</th>';
      echo '<th>Phone</th>';
      echo '</tr>';
      echo '</thead>';
      echo '<tbody>';

      // Display user information in the table rows
      foreach ($users as $user) {
        echo '<tr>';
        echo '<td>' . $user['user_id'] . '</td>';
        echo '<td>' . $user['username'] . '</td>';
        echo '<td>' . $user['email'] . '</td>';
        echo '<td>' . $user['age'] . '</td>';
        echo '<td>' . $user['phone'] . '</td>';
        echo '</tr>';
      }

      echo '</tbody>';
      echo '</table>';
    } else {
      echo 'No users found.';
    }
  } catch (PDOException $e) {
    echo 'An error occurred: ' . $e->getMessage();
  }
  ?>

</div>


  <?php include 'footer.php' ?>
  
  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
