<?php
// Include the dbconnect.php file to establish the database connection
require_once 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the form data
  $movie_id = $_POST['movie_id'];
  $movie_name = $_POST['movie_name'];
  $release_date = $_POST['release_date'];
  $available_tickets = $_POST['available_tickets'];

  try {
    // Update the movie details in the Movies table
    $query = "UPDATE Movies SET movie_name = :movie_name, release_date = :release_date, available_tickets = :available_tickets WHERE movie_id = :movie_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':movie_name', $movie_name);
    $stmt->bindParam(':release_date', $release_date);
    $stmt->bindParam(':available_tickets', $available_tickets);
    $stmt->bindParam(':movie_id', $movie_id);

    if ($stmt->execute()) {
      // Movie details updated successfully, redirect back to adminHome.php
      header('Location: adminHome.php');
      exit();
    } else {
      // Error updating the movie details, display an error message or redirect to an error page
      echo 'Error updating the movie details.';
    }
  } catch (PDOException $e) {
    // Handle the exception here, display an error message or redirect to an error page
    echo 'An error occurred: ' . $e->getMessage();
  }
} else {
  exit();
}
?>
