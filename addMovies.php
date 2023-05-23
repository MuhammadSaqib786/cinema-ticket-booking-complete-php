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
  


  <div class="container" style="margin-bottom: 180px; margin-top:30px;">
    <h2>Add New Movie</h2>
    <form action="add_movie.php" method="POST">
      <div class="form-group">
        <label for="movie_name">Movie Name:</label>
        <input type="text" class="form-control" id="movie_name" name="movie_name" required>
      </div>
      <div class="form-group">
        <label for="release_date">Release Date:</label>
        <input type="date" class="form-control" id="release_date" name="release_date" required>
      </div>
      <div class="form-group">
        <label for="available_tickets">Available Tickets:</label>
        <input type="number" class="form-control" id="available_tickets" name="available_tickets" required>
      </div>
      <button type="submit" class="btn btn-primary mb-3">Add Movie</button>
    </form>
  </div>

  <?php include 'footer.php' ?>
  
  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
