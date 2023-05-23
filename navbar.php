<style>
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
<nav class="navbar navbar-expand-lg">
  <div class="container">
  <a class="navbar-brand" href="<?php echo isset($_SESSION['user_email']) ? 'index.php' : (isset($_SESSION['admin_email']) ? 'adminHome.php' : '#'); ?>">
  Cinema System
</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <?php if (!isset($_SESSION['admin_email'])) 
      
      {
        
        ?>
          
          <?php if (!isset($_SESSION['user_email']))
          {
          ?> 
        
          <li class="nav-item">
            <a class="nav-link" href="admin.php">Admin Panel</a>
          </li>
          <?php } ?>
          
          

          
      <?php
      }
      if (isset($_SESSION['user_email'])) {
        // Show logout button with icon
        echo '
        <li class="nav-item active">
        <a class="nav-link" href="index.php">Home</a>
      </li>
                <li class="nav-item">
                    <a class="nav-link" href="booked.php">My Bookings</a>
                </li>
                
                <li class="nav-item active">
                  <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </li>
              ';
      } elseif (isset($_SESSION['admin_email'])) 
      
      {
        echo '
        <li class="nav-item active">
                  <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </li>';

      }
      else {
        // Show signup and login links
        echo '
                <li class="nav-item">
                  <a class="nav-link" href="signup.php">Sign Up</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="login.php">Login</a>
                </li>
              ';
      }
      ?>
      </ul>
    </div>
  </div>
</nav>