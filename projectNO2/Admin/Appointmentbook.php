<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("Location: http://localhost/projectNO2/Admin/admin_login.php");
    exit;
}
?>
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
                    <?php $page = basename($_SERVER['PHP_SELF']); ?>
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="http://localhost/projectNO2/Admin/dashboard%20(2).php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Pages</div>
                        <a class="nav-link " href="http://localhost/projectNO2/Admin/doctor_ad.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Doctors
                        </a>
                        <a class="nav-link" href="http://localhost/projectNO2/Admin/users.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Users
                        </a>
                        <a class="nav-link <?php if ($page == 'Appointmentbook.php') : echo 'active';
                                            endif; ?>" href="http://localhost/projectNO2/Admin/Appointmentbook.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Appointment Book
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Doctor Appointment Syestem
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
            <?php
                    if (isset($_GET['message'])) {
                        $successMessage = urldecode($_GET['message']);
                        echo '<div class="alert alert-success alert-dismissible fade show" style = "width: 20%!important;" role="alert">
    <strong></strong> ' . $successMessage . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
                    }
                    ?>
                <div class="container-fluid px-4">
                    <?php
                    include "../dbb/db_connect.php";
                    $sql = "SELECT bookdoctor.id, bookdoctor.name as username, bookdoctor.phone, bookdoctor.doctorId, doctor.name, bookdoctor.email, bookdoctor.description, bookdoctor.appointingdate
FROM `bookdoctor`
INNER JOIN `doctor` ON doctor.id = bookdoctor.doctorId";
                    $result = mysqli_query($connect, $sql);
                    // Step 3: Fetch data and store it in a session variable
                    if ($result->num_rows > 0) {
                        $employeeData = array();
                        while ($row = $result->fetch_assoc()) {
                            $employeeData[] = $row;
                        }
                        $_SESSION['employee_data'] = $employeeData;
                    }
                    // Step 4: Close the database connection
                    $connect->close();
                    ?>
                    <h1 class="mt-4">Appointments</h1>
                    <div class="row">
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    Appointment DataTable
                                </div>
                                <div class="card-body">
                                    <table id="datatablesSimple">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>phone</th>
                                                <th>Doctor Name</th>
                                                <th>Description</th>
                                                <th>Appointing Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        // Display the data in the table
                                        foreach ($employeeData as $row) {
                                            echo "<tr>";
                                            echo "<td>" . $row["id"] . "</td>";
                                            echo "<td>" . $row["username"] . "</td>";
                                            echo "<td>" . $row["email"] . "</td>";
                                            echo "<td>" . $row["phone"] . "</td>";
                                            echo "<td>" . $row["name"] . "</td>";
                                            echo "<td>" . $row["description"] . "</td>";
                                            echo "<td>" . $row["appointingdate"] . "</td>";
                                            echo "<td><a class='btn btn-danger' href='http://localhost/projectNO2/Delete/delete.php?id=" . $row['id'] . "'onclick='return confirm(\"Sure!you want to delete this record?\");'>Delete</a> <a class='btn btn-success' href='http://localhost/projectNO2/Admin/UpdateAppointments.php?id=" . $row['id'] . "' onclick='return confirm(\"You want to Update this record?\");'>Update</a></td>";

                                            echo "</tr>";
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
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