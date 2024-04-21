<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - Admin</title>
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
                        <a class="nav-link" href="http://localhost/projectNO2/Admin/Appointmentbook.php">
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
                    <h1 class="mt-4">Update Doctor info</h1>
                    <?php
                    include "../dbb/db_connect.php";
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $sql = "SELECT * FROM `doctor` WHERE id = $id";
                        $result = mysqli_query($connect, $sql);
                        $row = mysqli_fetch_assoc($result);
                    }
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $id = $_POST['id'];
                        $name = $_POST['name'];
                        $specialization = $_POST['specialization'];
                        $email = $_POST['email'];
                        $experience = $_POST['experience'];                      
                        // Use $_FILES to access the uploaded file
                        // Define the upload directory and allowed file types
                        $uploadDir = '../pics/';
                        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
                        // Get the uploaded file details
                        $file = $_FILES['image'];
                        $fileName = $file['name'];
                        $fileTmpName = $file['tmp_name'];
                        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                        // Generate a unique filename based on the doctor's name
                        $uniqueFileName = uniqid() . '.' . $fileType;
                        $uploadPath = $uploadDir . $uniqueFileName;
                        // Check if the file type is allowed
                        if (in_array($fileType, $allowedTypes)) {
                            // Upload the file with the unique filename
                            if (move_uploaded_file($fileTmpName, $uploadPath)) {
                            } else {
                                echo "Error uploading file.";
                            }
                        } else {
                            echo "Invalid file type. Allowed types: " . implode(', ', $allowedTypes);
                        }
                        // ... your database connection code ...
                        $sql = "UPDATE `doctor` SET `id`='$id',`name`='$name',`specialization`='$specialization',`email`='$email',`experience`='$experience',`image`='$uniqueFileName' WHERE `id`= '$id'";
                        $result = mysqli_query($connect, $sql);
                        if ($result) {
                            $successMessage = 'Data Updated  Successfully!';
                            $redirectURL = 'http://localhost/projectNO2/Admin/doctor_ad.php?message=' . urlencode($successMessage);
                            header("Location:" . $redirectURL);
                            }
                        } else {
                            // Error in submitting data
                            $message = "Error in Updating Data: " . mysqli_error($connect);
                        }
                        // Close the database connection
                        mysqli_close($connect);             
                    ?>
                    <?php error_reporting(E_ALL);
                    ini_set('display_errors', 0); ?>
                    <div class="row">
                        <form class="" action="UpdateDoc.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputId"></label>
                                <input type="hidden" value="<?php echo $row['id']; ?>" class="form-control" id="exampleInputId" name="id" readonly>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Name</label>
                                    <input type="text" value="<?php echo $row['name']; ?>" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Specialization</label>
                                    <input type="text" value="<?php echo $row['specialization']; ?>" class="form-control" name="specialization" id="exampleInputPassword1" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Email Address</label>
                                    <input type="email" value="<?php echo $row['email']; ?>" class="form-control" name="email" id="exampleInputPassword1" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Experience</label>
                                    <input type="text" value="<?php echo $row['experience']; ?>" class="form-control" name="experience" id="exampleInputPassword1" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Upload Image</label>
                                    <input type="file" value="<?php echo $row['image']; ?>" class="form-control" name="image" id="exampleInputPassword1">
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
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