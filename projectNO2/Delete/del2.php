<?php
include "../dbb/db_connect.php";

// Get the id parameter from the URL
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  // echo $id;
  // exit;
  // Prepare and execute the delete query
  $sql = "DELETE FROM `user` WHERE `user`.`id` = $id LIMIT 1";
  $result = mysqli_query($connect, $sql);

  if ($result) {
    // Check if any rows were affected
    if (mysqli_affected_rows($connect) > 0) {
      $successMessage = 'Data has been Deleted Successfully!';
      $redirectURL = 'http://localhost/projectNO2/Admin/users.php?message=' . urlencode($successMessage);
      header("Location:" . $redirectURL);

      exit;
    } else {
      // If no rows were affected, display a message indicating the record was not found
      echo "No record found with the provided ID.";
    }
  }
  // Close the database connection
  mysqli_close($connect);
}
