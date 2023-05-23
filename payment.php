<?php
session_start();
if(!isset($_SESSION['user_email']))
{
    header('Location: login.php');
    exit;
}
include 'dbconnect.php';

$total=0;
$ticket_id=0;
if(isset($_POST['movie_id']))
{
    $total=$_POST['ticket_quantity']*20;
    $movie_id=$_POST['movie_id'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Home</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  
</head>
<body>
<?php
  include 'navbar.php';
?>

<div class="container" style="margin-top: 90px; margin-bottom:280px;">
<form method="post" action="process.php">
  <div class="form-group">
    <label for="card_number">Card Number</label>
    <input type="text" class="form-control" id="card_number" name="card_number" required>
  </div>
  <div class="form-group">
    <label for="exp_date">Expiration Date</label>
    <input type="date" class="form-control" id="exp_date" name="exp_date" required>
  </div>
  <div class="form-group">
    <label for="total">Total</label>
    <input type="text" class="form-control" id="total" name="total" value="<?php echo $total; ?>" readonly>
    <input type="hidden" name="movie_id" value="<?php echo $movie_id; ?>">
  </div>
  <button type="submit" class="btn btn-primary">Buy Now</button>
</form>


  </div>
  <?php include 'footer.php' ?>
  
  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
