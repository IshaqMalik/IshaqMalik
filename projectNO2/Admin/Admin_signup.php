<?php
include "../dbb/db_connect.php";
$showalert = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $psw = $_POST['psw'];
  $conpsw = $_POST['conpsw'];

  // Perform any necessary validation on the form fields here

  // Check if the passwords match
  if ($psw === $conpsw) {
    // Check if the database connection is successful
    // Hash the password before storing it in the database
    $hashed_password = password_hash($psw, PASSWORD_DEFAULT);
    $showalert = "Passwords do not match. Please try again.";

    // Prepare and execute the SQL query to check if the email already exists
    $email_check_sql = "SELECT * FROM `user` WHERE `email` = '$email'";
    $email_check_result = mysqli_query($connect, $email_check_sql);

    if (mysqli_num_rows($email_check_result) > 0) {
        $showalert= "Email already registered. Please use a different email address.";
    } else {
        // Prepare and execute the SQL query to insert the user data
        $sql = "INSERT INTO `user` (`id`, `name`, `email`, `psw`) VALUES (NULL, '$name', '$email', '$hashed_password')";
        $result = mysqli_query($connect, $sql);

        if ($result) {
            $showalert = "Account has been Created Successfully";
           
        } 
    }
} else {
    $showalert = "Passwords do not match. Please try again.";
}

    // Passwords do not match
    
  }
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Sign Up</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
  <?php
  if ($showalert) {

    echo
    '<div class="alert alert-success alert-dismissible fade show" style = "width: 20%!important;" role="alert" >
  <strong></strong>' .$showalert.
  '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
';
  }
  ?>
  <section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="card text-black" style="border-radius: 25px;">
            <div class="card-body p-md-5">
              <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Admin Sign up</p>

                  <form action="Admin_signup.php" method="post" class="mx-1 mx-md-4">

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="text" name="name" id="form3Example1c" class="form-control" required />
                        <label class="form-label" for="form3Example1c">Your Name</label>
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="email" name="email" id="form3Example3c" class="form-control" required />
                        <label class="form-label" for="form3Example3c">Your Email</label>
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="password" name="psw" id="form3Example4c" class="form-control" required />
                        <label class="form-label" for="form3Example4c">Password</label>
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="password" name="conpsw" id="form3Example4cd" class="form-control" required />
                        <label class="form-label" for="form3Example4cd">Repeat your password</label>
                      </div>
                    </div>
                    <div class="form-check d-flex justify-content-center mb-3">
                      
                         <a href="http://localhost/projectNO2/Admin/admin_login.php">Click here to Login</a>
                      </label>
                    </div>
                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <button type="submit" class="btn btn-primary btn-lg">Register</button>
                    </div>
                  </form>
                </div>
                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                  <img src="../pics/draw1.jpg" class="img-fluid" alt="Sample image">
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