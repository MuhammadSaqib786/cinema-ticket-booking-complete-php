<?php
// Include database connection
include_once('dbconnect.php');

// Initialize message variable
$msg = '';
$Cname = "";
$CEmail = "";
$CPhonenumber = "";
$age = "";
$Password = "";

// Check if form is submitted
if (isset($_POST['register'])) {
    // Retrieve form data
    $Cname = $_POST['Cname'];
    $CEmail = $_POST['CEmail'];
    $CPhonenumber = $_POST['CPhonenumber'];
    $age = $_POST['age'];
    $Password = $_POST['Password'];

    // Validate form data
    if (empty($Cname) || empty($CEmail) || empty($CPhonenumber) || empty($age) || empty($Password)) {
        $msg = "Please fill out all fields";
    } elseif (!filter_var($CEmail, FILTER_VALIDATE_EMAIL)) {
        $msg = "Invalid email format";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $Cname)) {
        $msg = "Invalid name format";
    } elseif (!preg_match("/^[0-9]*$/", $CPhonenumber) || strlen($CPhonenumber) != 10) {
        $msg = "Invalid phone number";
    } elseif ($age <=0) {
        $msg = "Invalid age";
    } elseif (strlen($Password) < 6) {
        $msg = "Password must be at least 6 characters long";
    } else {
        try {
            // Insert user data into database
            $sql ="INSERT INTO myUser (username, email, phone, age, password) 
            VALUES (:cn, :ce, :cp, :ag, :pw)";
            $stmt = $conn->prepare($sql);
            
            $stmt->execute(array(
              ':cn' => $Cname,
              ':ce' => $CEmail,
              ':cp' => $CPhonenumber,
              ':ag' => $age,
              ':pw' => $Password
            ));

            
            header('Location: login.php');
        } catch(PDOException $e) {
            $msg = "Connection failed: " . $e->getMessage();
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Signup</title>

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

  
</style>
</head>
<body>
<?php
  include 'navbar.php';
?>

  <div class="content" style="margin-bottom: 50px; margin-top: 50px;">
    <h1>Register </h1>
    
        <?php if (!empty($msg)): ?>
            <div class="alert <?php echo ($msg == 'Registration successful!') ? 'alert-success' : 'alert-danger'; ?>">
                <?php echo $msg; ?>
            </div>
        <?php endif; ?>
    <form method="post" action="signup.php">
      <div class="form-group">
        <label for="Cname">Full Name</label>
        <input type="text" class="form-control" id="Cname" name="Cname" value="<?php echo $Cname; ?>">
      </div>
      <div class="form-group">
        <label for="CEmail">Email</label>
        <input type="email" class="form-control" id="CEmail" name="CEmail" value="<?php echo $CEmail; ?>">
      </div>
      <div class="form-group">
        <label for="CPhonenumber">Phone Number</label>
        <input type="tel" class="form-control" id="CPhonenumber" name="CPhonenumber" value="<?php echo $CPhonenumber; ?>">
      </div>
      <div class="form-group">
        <label for="age">Age</label>
        <input type="number" class="form-control" id="age" name="age" value="<?php echo $age; ?>">
      </div>
      <div class="form-group">
        <label for="Password">Password</label>
        <input type="password" class="form-control" id="Password" name="Password" value="<?php echo $Password; ?>" >
      </div>
      <button type="submit" class="btn mb-3" name='register' style="width:100%; background: #FDCCE2; color: white;">Register Now</button>
    </form>
    
  
  </div>
  <?php include 'footer.php' ?>
  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
