<?php
include('includes/navigation.php');
require('admin/database_config.php');
require('admin/essentials.php');

// Get search parameters if any
$check_in = $_POST['check_in'] ?? '';
$check_out = $_POST['check_out'] ?? '';
$adults = $_POST['adults'] ?? 2;
$children = $_POST['children'] ?? 0;

// Get all rooms - FIXED: Pass empty arrays for values and datatypes
$rooms_q = "SELECT * FROM rooms WHERE status=1";
$rooms_res = select($rooms_q, [], "");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,600;1,600&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Poppins:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link rel="stylesheet" href="CSS/Common.css">

<style>
  .box:hover{
    border-top-color: rgb(127, 189, 255) !important;
  }
.pop:hover{
    border-top-color: rgb(127, 140, 255) !important;
    transform: scale(1.03);
    transition:all 0.3s;
    }
</style>


</head>
<body class="bg-black">

<!-- Filters -->
<div class="container">
    <div class="row">

        <div class="col-lg-3 col-md-12 mb-lg-0 mb-4 px-lg-0">
            <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
                <div class="container-fluid flex-lg-column align-items-stretch">
                    <h4 class="mt-2">Filters</h4>
                    <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#filterDropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filterDropdown">
                        <div class="border bg-light p-3 rounded mb-3">
                            <h5 class="mb-3" style="font-size: 18px;">Check Availability</h5>

                            <label class="form-label">Check-In</label>
                            <input type="date" class ="form-control shadow-none mb-3">

                            <label class="form-label">Check-Out</label>
                            <input type="date" class ="form-control shadow-none">
                        </div>
                        <div class="border bg-light p-3 rounded mb-3">
                            <h5 class="mb-3" style="font-size: 18px;">Facilities</h5>
                            <div class="mb-2">
                                <input type="checkbox" id="f1" class ="form-check-input shadow-none me-1">
                                <label class="form-check-label" for="f1">Facility one</label>
                            </div>
                            <div class="mb-2">
                                <input type="checkbox" id="f" class ="form-check-input shadow-none me-1">
                                <label class="form-check-label" for="f2">Facility Two</label>
                            </div>
                            <div class="mb-2">
                                <input type="checkbox" id="f3" class ="form-check-input shadow-none me-1">
                                <label class="form-check-label" for="f3">Facility Three</label>
                            </div>
                        </div>
                         <div class="border bg-light p-3 rounded mb-3">
                            <h5 class="mb-3" style="font-size: 18px;">Guests</h5>
                            <div class="d-flex">
                                <div class="me-3">
                                <label class="form-label mt-2">Adults</label>
                                <input type="number" class ="form-control shadow-none">
                            </div>
                            <div>
                                <label class="form-label mt-2">Children</label>
                                <input type="number" class ="form-control shadow-none">
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
<!-- Cards -->
        <div class="col-lg-9 col-md-12 px-4">
            <div class="card mb-4 border-0 shadow">
                <div class="row g-0 p-3 align-items-center">
                    <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                        <img src="Images/Rooms/IMG_11892.png" class="img-fluid rounded mb-4 me-4">
                    </div>
                    <div class="col-md-5 px-lg-3 px-md-3 px-0">
                        <h5 class="">Deluxe Family Suite</h5>
                         <div class="features mb-3">
                            <h6 class="mb-1">Features</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                2 Bedrooms
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                2 Bathrooms
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                1 Balcony
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                1 Living Room
                            </span>
                        </div>
                        <div class="facilities mb-2">
                            <h6 class="mb-1">Facilities</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Free Wifi
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Smart TV
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Air Conditioner
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Room Heater
                            </span>
                        </div>
                           <div class="guests">
                            <h6 class="mb-1">Guests</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                               Upto 5 Adults &
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                3 Children
                            </span>
                        </div>
                    </div>
                    <div class="col-md-2 text-center">
                        <h6 class="mb-3">৳5000 per night</h6>
                        <a href="booking.php?room_id=<?php echo $room['id']; ?>" class="btn btn-sm text-white custom-bg shadow-none">Book Now</a>
                        
                    </div>
                </div>
            </div>
             <div class="card mb-4 border-0 shadow">
                <div class="row g-0 p-3 align-items-center">
                    <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                        <img src="Images/Rooms/IMG_78809.png" class="img-fluid rounded">
                    </div>
                    <div class="col-md-5 px-lg-3 px-md-3 px-0">
                        <h5 class="">Premium Wooden Cottage</h5>
                         <div class="features mb-3">
                            <h6 class="mb-1">Features</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                2 Bedrooms
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                1 Bathroom
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Private Balcony with Garden View
                            </span>
                        </div>
                        <div class="facilities mb-2">
                            <h6 class="mb-1">Facilities</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Free Wifi
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Smart TV
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Air Conditioner
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Geyser
                            </span>
                        </div>
                           <div class="guests">
                            <h6 class="mb-1">Guests</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Up to 3 Adults &
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                2 Children
                            </span>
                        </div>
                    </div>
                    <div class="col-md-2 text-center">
                        <h6 class="mb-4">৳8000 per night</h6>
                        <a href="booking.php?room_id=<?php echo $room['id']; ?>" class="btn btn-sm text-white custom-bg shadow-none">Book Now</a>
                        
                    </div>
                </div>
            </div>
             <div class="card mb-4 border-0 shadow">
                <div class="row g-0 p-3 align-items-center">
                    <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                        <img src="Images/Rooms/IMG_65019.png" class="img-fluid rounded">
                    </div>
                    <div class="col-md-5 px-lg-3 px-md-3 px-0">
                        <h5 class="">Luxury Modern Apartment</h5>
                         <div class="features mb-3">
                            <h6 class="mb-1">Features</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                3 Bedrooms
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                2 Bathrooms
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                1 Balcony
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                1 Kitchen
                            </span>
                        </div>
                        <div class="facilities mb-2">
                            <h6 class="mb-1">Facilities</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Free Wifi
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Smart TV
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Air Conditioner
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Geyser
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                Spa Access
                            </span>
                        </div>
                           <div class="guests">
                            <h6 class="mb-1">Guests</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                5 Adults
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                3 Children
                            </span>
                        </div>
                    </div>
                    <div class="col-md-2 text-center">
                        <h6 class="mb-4">৳10000 per night</h6>
                        <a href="booking.php?room_id=<?php echo $room['id']; ?>" class="btn btn-sm text-white custom-bg shadow-none">Book Now</a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        







<!-- Footer -->
<div class="container-fluid bg-white mt-5">
  <div class="row shadow">
    <div class="col-lg-4 p-4">
      <h3 class="h-font fw-bold fs-3 mb-2">Roovila</h3>
      <p>
        Roovila is a reliable hotel booking platform designed to make travel simple and stress-free. 
        We connect travelers with verified hotels, offering clear pricing, 
        secure payments, and instant confirmation—so you can book your perfect stay with confidence.
      </p>
    </div>
    <div class="col-lg-4 p-4">
      <h5 class="mb-3">Links</h5>
      <a href="index.php" class="d-inline-block mb-2 text-dark text-decoration-none">Home</a><br>
      <a href="room.php" class="d-inline-block mb-2 text-dark text-decoration-none">Rooms</a><br>
      <a href="facilities.php" class="d-inline-block mb-2 text-dark text-decoration-none">Facilities</a><br>
      <a href="contact.php" class="d-inline-block mb-2 text-dark text-decoration-none">Contact Us</a><br>
      <a href="about.php" class="d-inline-block mb-2 text-dark text-decoration-none">About Us</a>
    </div>
    <div class="col-lg-4 p-4">
      <h5 class="mb-3">Follow us</h5>
      <a href="#" class="d-inline-block text-dark text-decoration-none mb-2"><i class="bi bi-instagram me-1"></i>Instagram</a><br>
      <a href="#" class="d-inline-block text-dark text-decoration-none mb-2"><i class="bi bi-facebook me-1"></i>Facebook</a><br>
      <a href="#" class="d-inline-block text-dark text-decoration-none mb-2"><i class="bi bi-twitter-x me-1"></i>Twitter-X</a><br>
    </div>
  </div>
</div>

<h6 class="text-center bg-dark text-white p-3 m-0"><i class="bi bi-c-circle"></i> 2025 All Rights Reserved By Shishir & Roovila.</h6>
<script>
    // Booking functionality
document.querySelectorAll('.book-now-btn').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Check if user is logged in
        <?php if(isset($_SESSION['user_id'])): ?>
            const roomId = this.getAttribute('data-room-id');
            const roomName = this.getAttribute('data-room-name');
            const roomPrice = this.getAttribute('data-room-price');
            
            // Show booking modal or redirect to booking page
            window.location.href = `booking.php?room_id=${roomId}`;
        <?php else: ?>
            alert('Please login to book a room!');
            window.location.href = 'login.php';
        <?php endif; ?>
    });
});
</script>
</body>
</html>
