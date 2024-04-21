
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="">Doctor Appointment System</a>
        <!-- Sidebar Toggle-->
        <!-- <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button> -->
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="Admin_logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="http://localhost/projectNO2/Admin/dashboard%20(2).php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Pages</div>
                        <a class="nav-link" href="http://localhost/projectNO2/Admin/doctor_ad.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Doctors
                        </a>
                        <a class="nav-link" href="http://localhost/projectNO2/Admin/users.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Users
                        </a>
                        <a class="nav-link" href="http://localhost/projectNO2/Admin/Appointbook.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Appointment Book
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Doctor Appointment System
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Add User</h1>
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
                            // Prepare and execute the SQL query to check if the email already exists
                            $email_check_sql = "SELECT * FROM `user` WHERE `email` = '$email'";
                            $email_check_result = mysqli_query($connect, $email_check_sql);
                            if (mysqli_num_rows($email_check_result) > 0) {
                                $showalert = "Email already registered. Please use a different email address.";
                            } else {
                                // Prepare and execute the SQL query to insert the user data
                                $sql = "INSERT INTO `user` (`id`, `name`, `email`, `psw`) VALUES (NULL, '$name', '$email', '$hashed_password')";
                                $result = mysqli_query($connect, $sql);
                                if ($result) {
                                    $successMessage = 'User Added Successfully!';
                                    $redirectURL = 'http://localhost/projectNO2/Admin/users.php?message=' . urlencode($successMessage);
                                    header("Location:" . $redirectURL);
                                }
                            }
                        } else {
                            $successMessage = "Invalid Password or Email";
                        }
                        // Passwords do not match
                    }
                    ?>
                    <div class="row">
                        <form class="" action="AddUser.php" method="post">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Your Name</label>
                                <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Your Email</label>
                                <input type="email" class="form-control" name="email" id="exampleInputPassword1" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" class="form-control" name="psw" id="exampleInputPassword1" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Repeat Password</label>
                                <input type="password" class="form-control" name="conpsw" id="exampleInputPassword1" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                        </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>
</html>