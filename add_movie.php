<?php
// Include the dbconnect.php file to establish the database connection
require_once 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve data from the form
  $movie_name = $_POST['movie_name'];
  $release_date = $_POST['release_date'];
  $available_tickets = $_POST['available_tickets'];

  // Insert data into the Movies table
  $query = "INSERT INTO Movies (movie_name, release_date, available_tickets) VALUES (:movie_name, :release_date, :available_tickets)";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(':movie_name', $movie_name);
  $stmt->bindParam(':release_date', $release_date);
  $stmt->bindParam(':available_tickets', $available_tickets);

  try {
    $stmt->execute();

    // Redirect to a success page or perform any other necessary actions
    header('Location: adminHome.php');
    exit();
  } catch (PDOException $e) {
    // Display an error message or redirect to an error page
    echo 'Error adding the movie: ' . $e->getMessage();
  }
} else {
  exit();
}
?>

