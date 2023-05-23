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
  


 <div class="container" style="margin-bottom: 350px; margin-top:30px;">
  <h2>Order Report</h2>

  <?php
  // Include the dbconnect.php file to establish the database connection
  require_once 'dbconnect.php';

  try {
    // Retrieve order information from the tables
    $query = "SELECT mb.booking_id, mb.booking_date, mu.username, m.movie_name, mb.totalAmount, mb.noOfseats
              FROM MovieBooking mb
              INNER JOIN myUser mu ON mb.user_id = mu.user_id
              INNER JOIN Movies m ON mb.movie_id = m.movie_id";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check if there are any orders
    if (count($orders) > 0) {
      echo '<table class="table table-bordered">';
      echo '<thead>';
      echo '<tr>';
      echo '<th>Order ID</th>';
      echo '<th>Booking Date</th>';
      echo '<th>User</th>';
      echo '<th>Movie</th>';
      echo '<th>Total Amount</th>';
      echo '<th>No. of Seats</th>';
      echo '</tr>';
      echo '</thead>';
      echo '<tbody>';

      // Display order information in the table rows
      foreach ($orders as $order) {
        echo '<tr>';
        echo '<td>' . $order['booking_id'] . '</td>';
        echo '<td>' . $order['booking_date'] . '</td>';
        echo '<td>' . $order['username'] . '</td>';
        echo '<td>' . $order['movie_name'] . '</td>';
        echo '<td>' . $order['totalAmount'] . '</td>';
        echo '<td>' . $order['noOfseats'] . '</td>';
        echo '</tr>';
      }

      echo '</tbody>';
      echo '</table>';
    } else {
      echo 'No orders found.';
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
