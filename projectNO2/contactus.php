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
    <title>Doctor Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
  <?php
                include 'navbar.php';
                ?>
  <section class="container  mt-4">
      <h1>Contact Us</h1>   
    <form class="mt-4 m-2">
      <div class="mb-3 p-2">
        <label for="exampleInputPassword1" class="form-label p-2"> First Name</label>
        <input type="text" class="form-control p-2" id="exampleInputPassword1">
      </div>
      <div class="mb-3 p-2">
        <label for="exampleInputPassword1" class="form-label p-2">Last Name</label>
        <input type="text" class="form-control p-2" id="exampleInputPassword1">
      </div>
      <div class="mb-3 p-2">
        <label for="exampleInputEmail1" class="form-label p-2">Email address</label>
        <input type="email" class="form-control p-2" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text p-2">We'll never share your email with anyone else.</div>
      </div>  
       <div class="mb-3 p-2">
        <label for="exampleInputPassword1" class="form-label p-2">Comments</label>
        <textarea name="comment" class="form-control p-2" form="usrform">Enter Comments here...</textarea>
      </div> 
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </section>
  </div>
  <?php
  include 'footer.php';
  ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>

