<?php
require_once 'dbconnect.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Validate admin credentials from the database
  $query = "SELECT * FROM Admin WHERE aemail = :em AND Apassword = :password";
  $statement = $conn->prepare($query);
  $statement->execute([
    ':em' => $email,
    ':password' => $password,
  ]);
  $admin = $statement->fetch(PDO::FETCH_ASSOC);

  if ($admin) {
    $_SESSION['admin_email'] = $admin['email'];
    $_SESSION['admin_username'] = $admin['username'];
    header("Location: adminHome.php");

    } else {
    // Admin credentials are invalid, show error message
    $error_message = "Invalid login details";
  }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- Custom CSS -->
  <style>
  
  .content {
    width: 50%;
    margin: auto;
  }

  h1 {
    text-align: center;
    margin-top: 1rem;
    margin-bottom: 3rem;
  }
  .error {
    color: red;
    margin-top: 1rem;
    text-align: center;
  }
  
</style>
</head>
<body>
<?php
  include 'navbar.php';
?>

  <div class="content" style="margin-bottom:340px">
    <h1>Admin</h1>
    <form action="admin.php" method="post">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="email" name="email" >
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" >
      </div>
      <button type="submit" class="btn mb-3" style="width:100%; background: #FDCCE2; color: white;">Login</button>
    </form>
    <?php if (isset($error_message)) { ?>
    <div class="error">
      <?php echo $error_message; ?>
    </div>
  <?php } ?>
    
    
  
  </div>
  <?php include 'footer.php' ?>
  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
