<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Doctor Appointment</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
  <div class="">
    <?php $page = basename($_SERVER['PHP_SELF']); ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a href="http://localhost/projectNO2/Dashboard.php" class="navbar-brand">Doctor Appointment System</a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <div class="navbar-nav">
            <a href="http://localhost/projectNO2/Dashboard.php" class="nav-item nav-link text-nowrap <?php if ($page == 'Dashboard.php') : echo 'active';
                                                                                                      endif; ?>">Home</a>
            <a href="http://localhost/projectNO2/AppointDoc.php" class="nav-item nav-link text-nowrap <?php if ($page == 'AppointDoc.php') : echo 'active';
                                                                                                      endif; ?>">Appoint Doctor</a>

<a href="http://localhost/projectNO2/Appointment.php" class="nav-item nav-link text-nowrap <?php if ($page == 'Appointment.php') : echo 'active';
                                                                                                      endif; ?>">View Appointment</a>
            <a href="http://localhost/projectNO2/contactus.php" class="nav-item nav-link text-nowrap <?php if ($page == 'contactus.php') : echo 'active';
                                                                                                      endif; ?>">Contact Us</a>
            <?php
            session_start();
            ?>
            <?php if ($_SESSION['loggedin'] == true) : ?>
              <a href="logout.php" class="nav-item nav-link" style="float: right;" <?php if ($page == 'logout.php') : echo 'active';
                                                                  endif; ?> >Logout</a>
            <?php else : ?>
              <a href="login.php" type="btn" class="nav-item nav-link" style="float: right;" <?php if ($page == 'login.php') : echo 'active';
                                                                                  endif; ?>>Log In </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </nav>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>