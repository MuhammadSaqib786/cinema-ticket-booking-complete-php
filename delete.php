<?php
// Include the dbconnect.php file to establish the database connection
require_once 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
  $movie_id = $_GET['id'];

  try {
    // Delete the movie from the Movies table
    $query = "DELETE FROM Movies WHERE movie_id = :movie_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':movie_id', $movie_id);

    if ($stmt->execute()) {
      // Movie deleted successfully, redirect back to movies.php
      header('Location: adminHome.php');
      exit();
    } else {
      // Error deleting the movie, display an error message or redirect to an error page
      echo 'Error deleting the movie.';
    }
  } catch (PDOException $e) {
    // Foreign key constraint violation, display an alert message
    echo '<script>alert("This movie cannot be deleted because it is associated with bookings."); window.location.href = "adminHome.php";</script>';
  }
} else {
  exit();
}
?>
