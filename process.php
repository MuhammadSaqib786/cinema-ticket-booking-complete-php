<?php
// Include the dbconnect.php file to establish the database connection
require_once 'dbconnect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve data from the form
  $card_number = $_POST['card_number'];
  $exp_date = $_POST['exp_date'];
  $total = $_POST['total'];
  $seats = $total / 20;
  $movie_id = $_POST['movie_id'];
  $user_id = $_SESSION['user_id'];

  try {
    $conn->beginTransaction();

    // Update the available seats in the Movies table
    $updateQuery = "UPDATE Movies SET available_tickets = available_tickets - :seats WHERE movie_id = :movie_id";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bindParam(':seats', $seats);
    $updateStmt->bindParam(':movie_id', $movie_id);
    $updateStmt->execute();

    // Insert data into the MovieBooking table
    $queryBooking = "INSERT INTO MovieBooking (movie_id, user_id, booking_date, totalAmount, noOfseats) VALUES (:movie_id, :user_id, CURDATE(), :totalAmount, :noOfseats)";
    $stmtBooking = $conn->prepare($queryBooking);
    $stmtBooking->bindParam(':movie_id', $movie_id);
    $stmtBooking->bindParam(':user_id', $user_id);
    $stmtBooking->bindParam(':totalAmount', $total);
    $stmtBooking->bindParam(':noOfseats', $seats);
    $stmtBooking->execute();
    $booking_id = $conn->lastInsertId(); // Get the generated booking ID

    $conn->commit();

    // Redirect to a success page or perform any other necessary actions
    header('Location: booked.php?booking_id=' . $booking_id);
    exit();
  } catch (PDOException $e) {
    $conn->rollBack();

    // Display an error message or redirect to an error page
    echo 'Error processing the payment: ' . $e->getMessage();
  }
}
 else {
  exit();
}
?>
