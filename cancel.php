<?php
// Include the dbconnect.php file to establish the database connection
require_once 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['tid'])) {
  $ticket_id = $_GET['tid'];
  session_start();
  $user_id = $_SESSION['user_id'];

  try {
    $conn->beginTransaction();

    // Retrieve the number of seats for the canceled booking
    $querySeats = "SELECT noOfseats, movie_id FROM MovieBooking WHERE user_id = :user_id AND booking_id = :booking_id";
    $stmtSeats = $conn->prepare($querySeats);
    $stmtSeats->bindParam(':user_id', $user_id);
    $stmtSeats->bindParam(':booking_id', $ticket_id);
    $stmtSeats->execute();
    $booking = $stmtSeats->fetch(PDO::FETCH_ASSOC);

    if ($booking) {
      $seats = $booking['noOfseats'];
      $movie_id = $booking['movie_id'];

      // Delete the booking from the MovieBooking table
      $queryDelete = "DELETE FROM MovieBooking WHERE user_id = :user_id AND booking_id = :booking_id";
      $stmtDelete = $conn->prepare($queryDelete);
      $stmtDelete->bindParam(':user_id', $user_id);
      $stmtDelete->bindParam(':booking_id', $ticket_id);
      $stmtDelete->execute();

      // Add back the available seats in the Movies table
      $queryUpdate = "UPDATE Movies SET available_tickets = available_tickets + :seats WHERE movie_id = :movie_id";
      $stmtUpdate = $conn->prepare($queryUpdate);
      $stmtUpdate->bindParam(':seats', $seats);
      $stmtUpdate->bindParam(':movie_id', $movie_id);
      $stmtUpdate->execute();

      $conn->commit();

      // Booking canceled successfully, redirect back to the previous page or appropriate handling
      header('Location: booked.php');
      exit();
    } else {
      // Booking not found for the user, display an error message or redirect to an error page
      echo 'Booking not found.';
    }
  } catch (PDOException $e) {
    $conn->rollBack();

    // Display an error message or redirect to an error page
    echo 'Error canceling the booking: ' . $e->getMessage();
  }
} else {
  exit();
}
?>
