<?php
include "../dbb/db_connect.php";
// Initialize the error variable
$login = false;
$successMessage = '';
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form inputs
  $email = $_POST["email"];
  $psw = $_POST["psw"];
  // SQL query to check if the user exists
  $sql = "SELECT * FROM `user` WHERE `email` = '$email'";
  $result = mysqli_query($connect, $sql);
  $num = mysqli_num_rows($result);
  // Check if the query returned any rows
  if ($num == 1) {
    while ($row = mysqli_fetch_assoc($result)) {
      if (password_verify($psw, $row['psw'])) {
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;
        $successMessage = 'Login Successfully!';
        $redirectURL = 'http://localhost/projectNO2/Admin/dashboard%20(2).php?message=' . urlencode($successMessage);
        header("Location:" . $redirectURL);
      } else {
        $successMessage = "Invalid Email And Password";
        $redirectURL = '?message=' . urlencode($successMessage);
        header("Location:" . $redirectURL);
      }
    }
  }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
  <section class="vh-70">
    <?php
    if (isset($_GET['message'])) {
      $successMessage = urldecode($_GET['message']);
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong></strong> ' . $successMessage . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }
    ?>
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="../pics/draw1.jpg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">
                  <form action="Admin_login.php" method="post" class="w-80">
                    <div class="d-flex align-items-center mb-3 pb-1">
                      <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                      <span class="h1 fw-bold mb-0">Admin Login</span>
                    </div>
                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>
                    <div class="form-outline mb-4">
                      <input type="email" name="email" id="form2Example17" class="form-control form-control-lg" required />
                      <label class="form-label" for="form2Example17">Email address</label>
                    </div>
                    <div class="form-outline mb-4">
                      <input type="password" name="psw" id="form2Example27" class="form-control form-control-lg" required />
                      <label class="form-label" for="form2Example27">Password</label>
                    </div>
                    <div class="pt-1 mb-4">
                      <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                    </div>
                    <a class="small text-muted" href="#!">Forgot password?</a>
                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="http://localhost/projectNO2/Admin/Admin_signup.php" style="color: #393f81;">Register here</a></p>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>