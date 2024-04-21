 <?php
  session_start();
  if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("Location: login.php");
    exit;
  }
  // 
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
   <section class="container-fluid p-0">
     <div id="carouselExampleDark" class="carousel carousel-dark slide">
       <div class="carousel-indicators">
         <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
         <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
         <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
       </div>
       <div class="carousel-inner">
         <div class="carousel-item active" data-bs-interval="10000">
           <img src="pics/1.webp" class="d-block w-100" height="500" alt="...">
           <div class="carousel-caption d-none d-md-block">
             <h5 style="color:blue">Welcome to Doctor Appointment System</h5>
             <p>We Offers our Best Team for you</p>
           </div>
         </div>
         <?php
          $successMessage = '';
          if (isset($_GET['message'])) {
            $successMessage = urldecode($_GET['message']);
          }
          ?>
         <div class="carousel-item" data-bs-interval="2000">
           <img src="pics/3.webp" class="d-block w-100" height="500" alt="...">
           <div class="carousel-caption d-none d-md-block">
             <h5 style="color:blue">Welcome to Doctor Appointment System</h5>
             <p><?php echo ($successMessage !== '') ? $successMessage : 'We Offer Our Best Team for You'; ?></p>
           </div>
         </div>
         <?php
          if ($successMessage !== '') {
            echo '<div class="alert alert-success alert-dismissible fade show" style = "width: 20%!important;" role="alert">
        <strong></strong> ' . $successMessage . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
          }
          ?>
         <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
           <span class="carousel-control-prev-icon" aria-hidden="true"></span>
           <span class="visually-hidden">Previous</span>
         </button>
         <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
           <span class="carousel-control-next-icon" aria-hidden="true"></span>
           <span class="visually-hidden">Next</span>
         </button>
 </div>
   </section>
   <section class="container-fluid">
     <div class="text-center mb-2 mt-4">
       <h1>We Offers Our Specialist Team For You</h1>
     </div>
     <div class="row d-flex justify-content-center">
       <?php
        include "dbb/db_connect.php";
        $sql = " SELECT * FROM `doctor`";
        $result = mysqli_query($connect, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
          //code; 
          echo " <div class='col-sm-2 mx-2 my-4 d-flex justify-content-center'>
                            <div class='card' style='width: 18rem;'>
                              <img src= 'pics/" . $row['image'] . "'class='card-img-top py-2 px-2' height='250' alt='...'>
                              <div class='card-body'>
                                <h5 class='card-title'>" . $row['name'] . "</h5>
                                <p class='card-text'>" . $row['specialization'] . "</p>
                                <a href='http://localhost/projectNO2/AppointDoc.php' class='btn btn-primary'>Book your Appointment</a>
                              </div> 
                            </div>
                          </div>
                  ";
        }
        ?>
     </div>
   </section>
   <?php
    include 'footer.php';
    ?>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
 </body>
 </html>