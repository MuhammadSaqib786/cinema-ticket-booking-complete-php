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

<div class="container" style="margin-top: 40px; margin-bottom:200px">
  <h2> Select the Movie  </h2>
  <h3>Price per ticket = 20 OMR </h3>
  <div class="row">
    <?php foreach ($movies as $movie): ?>
    <div class="col-md-4">
      <div class="card mb-4 shadow-sm">
        <div class="card-body">
          <h5 class="card-title"><b>Movie: </b> <?php echo $movie['movie_name']; ?></h5>
          <p class="card-text"><b>Date: </b><?php echo $movie['release_date']; ?></p>
          <p class="card-text"><b>Available Tickets: </b><?php echo $movie['available_tickets']; ?></p>
          <form action="payment.php" method="post">
            <div class="form-group">
              <label for="ticket_quantity">Number of Tickets:</label>
              <input type="number" class="form-control" id="ticket_quantity" name="ticket_quantity" min="1" max="<?php echo $movie['available_tickets']; ?>" required>
            </div>
            <input type="hidden" name="movie_id" value="<?php echo $movie['movie_id']; ?>">
            <input type="hidden" name="movie_name" value="<?php echo $movie['movie_name']; ?>">
            <input type="hidden" name="release_date" value="<?php echo $movie['release_date']; ?>">
            <button type="submit" class="btn btn-sm btn-outline-secondary">Buy Now</button>
          </form>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

  <?php include 'footer.php' ?>
  
  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
