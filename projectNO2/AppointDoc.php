<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true) {
  header("Location: login.php");
  exit;
}
?>
<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Doctor Appointment System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <?php
    include 'navbar.php';
    ?>
    <?php
    include "dbb/db_connect.php";
    $email = $_SESSION['email'];
    $successMessage = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $doctorId = $_POST['doctorId'];
      $description = $_POST['description'];
      $appointingdate = $_POST['appointingdate'];
      $sql = "INSERT INTO `bookdoctor` (`id`, `name`, `email`, `phone`, `doctorId`, `description`, `appointingdate`) VALUES (NULL, '$name', '$email', '$phone', '$doctorId', '$description', '$appointingdate');";
      $result = mysqli_query($connect, $sql);
      if ($result) {
        $successMessage ="Your Appointment has been Register Successfully!";
        $redirectURL = 'http://localhost/projectNO2/Dashboard.php?message=' . urlencode($successMessage);
        header("Location:" . $redirectURL);  
      }
      else {
    $successMessage = "Error In Booking Appointment.";
      }
    }
    ?>
    <section class="container  mt-4" >
      <h1 style="text-align: center;">Appoint A Doctor</h1>
      <form action="AppointDoc.php" method="post" class=" mt-4 m-2">
        <div class="row">
            <div class="form-group p-2">
              <span class="form-label p-2">Name</span>
              <input class="form-control p-2" name="name" type="text" placeholder="Enter your name" required>
            </div>
            <div class="form-group p-2">
              <span class="form-label p-2">Email</span>
              <input class="form-control p-2" name="email" type="email" placeholder="Enter your email" value="<?php echo $email; ?>" readonly>
            </div>
        <div class="form-group p-2">
          <span class="form-label p-2">Phone</span>
          <input class="form-control p-2" name="phone" type="text" placeholder="Enter your phone number" required>
        </div>
        <?php
        // Fetch data based on the selected doctor name
        $sql = "SELECT * FROM `doctor`";
        $result = mysqli_query($connect, $sql);
        ?>
        <div class="form-group p-2 ">
          <span class="form-label p-2">Doctor Name</span>
          <select id="" name="doctorId" class="form-control p-2">
            <!-- Add an empty option as the default option -->
            <option value="" selected disabled>Select a Doctor</option>
            <?php
            // Loop through the fetched data and add options for each doctor
            while ($row = mysqli_fetch_assoc($result)) {
              // Get the name of the doctor from the current row
              $doctorName = $row["name"];
              $doctorId = $row["id"];
              // Output the option element with the doctor name as both the value and the displayed text
              echo '<option value="' . $doctorId . '">' . $doctorName . '</option>';
            }
            ?>
          </select>
        </div>
        <div class="form-group p-2 ">
          <span class="form-label p-2">Enter Description</span>
          <input class="form-control p-2" name="description" type="text" placeholder="Enter Description" required>
        </div>
        <div class="form-group p-2 ">
          <span class="form-label p-2">Appointing Date</span>
          <input class="form-control p-2" name="appointingdate" type="date" min="<?php echo date('Y-m-d'); ?>" required>
        </div>
<div class="p-2">
        <button type="submit" class="btn btn-primary">Book Now</button>
        </div>
      </form>
    </section>
    </div>
    <?php
  include 'footer.php';
  ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>