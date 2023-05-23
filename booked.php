<?php
session_start();
if(!isset($_SESSION['user_email']))
{
    header('Location: login.php');
    exit;
}
include 'dbconnect.php';

try {
    $stmt = $conn->prepare("SELECT * FROM movies");
    $stmt->execute();
    $movies = $stmt->fetchAll();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payment</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  
</head>
<body>
<?php
  include 'navbar.php';
?>

<div class="container" style="margin-bottom:500px">
  <h2>Booked Tickets</h2>
  <div class="content">
  <table class="table">
  <thead>
    <tr>
      <th>Movie Name</th>
      <th>Ticket Date</th>
      <th>Number of Booked Tickets</th>
      <th>Cancel</th>
    </tr>
  </thead>
  <tbody>
    <?php
    // Include the dbconnect.php file to establish the database connection
    require_once 'dbconnect.php';

    // Retrieve booked ticket details for the logged-in user
    $user_id = $_SESSION['user_id']; // Replace with the appropriate session variable for user ID
    $query = "SELECT m.movie_name, b.booking_date, b.noOfseats AS num_booked_tickets, b.booking_id
              FROM MovieBooking b
              
              INNER JOIN Movies m ON m.movie_id = b.movie_id
              WHERE b.user_id = :user_id
              GROUP BY m.movie_name, b.booking_date";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $bookedTickets = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($bookedTickets as $ticket) {
      echo "<tr>";
      echo "<td>" . $ticket['movie_name'] . "</td>";
      echo "<td>" . $ticket['booking_date'] . "</td>";
      echo "<td>" . $ticket['num_booked_tickets'] . "</td>";
      echo "<td><a href=\"cancel.php?tid=" . urlencode($ticket['booking_id']). "\" class=\"btn btn-danger\">Cancel</a></td>";
      echo "</tr>";
    }
    ?>
  </tbody>
</table>

  </div>
</div>

  <?php include 'footer.php' ?>
  
  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
