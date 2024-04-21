<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("Location: login.php");
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
    <title>Doctor Appointment System</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
    include 'navbar.php';
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container px-4">
                <h1 class="mt-4">Appointments</h1>
                <div class="row">
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Your Appointment DataTable
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <?php
                                    include "dbb/db_connect.php";
                                    $email = $_SESSION['email'];
                                    $sql = "SELECT bookdoctor.id, bookdoctor.name as username, bookdoctor.phone, bookdoctor.doctorId, doctor.name, bookdoctor.email, bookdoctor.description, bookdoctor.appointingdate
                                            FROM `bookdoctor`
                                            INNER JOIN `doctor` ON doctor.id = bookdoctor.doctorId
        WHERE bookdoctor.email = '$email'";
                                    $result = mysqli_query($connect, $sql);
                                    if (!$result) {
                                        echo "Error: " . mysqli_error($connect);
                                    }
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        // Code to display data in a table row
                                        echo "<tr>
        <td>" . $row['id'] . "</td>
    <td>" . $row['username'] . "</td>
    <td>" . $row['email'] . "</td>
    <td>" . $row['phone'] . "</td>
    <td>" . $row['name'] . "</td>
    <td>" . $row['description'] . "</td>
    <td>" . $row['appointingdate'] . "</td>
        </tr>";
                                    }
                                    ?>
                                     <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>User Name</th>
                                            <th>Email</th>
                                            <th>phone</th>
                                            <th>Doctor Name</th>
                                            <th>Description</th>
                                            <th>Appointing Date</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </main>
    </div>
    </div>
        <footer class="py-4 mt-4">
        <?php
    include 'footer.php';
    ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>