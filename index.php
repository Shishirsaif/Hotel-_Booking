<?php
session_start();
include('includes/navigation.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roovila-Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,600;1,600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="CSS/Common.css">

    <style>
        .room-image {
            height: 200px;
            object-fit: cover;
        }
        
        .custom-bg {
            background-color: #198754; 
        }
        
        .h-font {
            font-family: 'Merienda', cursive;
        }
        
        body {
            background-color: #f8f9fa;
        }
        
        .availability-form {
            margin-top: -420px;
            position: relative;
            z-index: 2;
        }
        
        @media (max-width: 575.98px) {
            .availability-form {
                margin-top: 25px;
            }
        }
    </style>
</head>
<body>


<!---Carousel-->
<div class="container-fluid px-lg-4 mt-4">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="Images/Carousel/IMG_15372.png" />
            </div>
            <div class="swiper-slide">
                <img src="Images/Carousel/IMG_40905.png" />
            </div>
            <div class="swiper-slide">
                <img src="Images/Carousel/IMG_55677.png" />
            </div>
            <div class="swiper-slide">
                <img src="Images/Carousel/IMG_62045.png" />
            </div>
            <div class="swiper-slide">
                <img src="Images/Carousel/IMG_93127.png" />
            </div>
            <div class="swiper-slide">
                <img src="Images/Carousel/IMG_99736.png" />
            </div>
        </div>
    </div>
</div>

<!-- Check Availability Form -->
<div class="container availability-form">
    <div class="row">
        <div class="col-lg-12 bg-white shadow p-4 rounded">
            <h5 class="mb-4">Check Booking Availability</h5>
            <form id="availability-form" method="POST" action="room.php">
                <div class="row align-items-end">
                    <div class="col-lg-3 mb-3">
                        <label class="form-label" style="font-weight: 500;">Check-In</label>
                        <input type="date" name="check_in" class="form-control shadow-none" required>
                    </div>
                    <div class="col-lg-3 mb-3">
                        <label class="form-label" style="font-weight: 500;">Check-Out</label>
                        <input type="date" name="check_out" class="form-control shadow-none" required>
                    </div>
                    <div class="col-lg-2 mb-3">
                        <label class="form-label" style="font-weight: 500;">Adults</label>
                        <select name="adults" class="form-select shadow-none" required>
                            <option value="1">1 Adult</option>
                            <option value="2" selected>2 Adults</option>
                            <option value="3">3 Adults</option>
                            <option value="4">4 Adults</option>
                        </select>
                    </div>
                    <div class="col-lg-2 mb-3">
                        <label class="form-label" style="font-weight: 500;">Children</label>
                        <select name="children" class="form-select shadow-none" required>
                            <option value="0" selected>0 Children</option>
                            <option value="1">1 Child</option>
                            <option value="2">2 Children</option>
                            <option value="3">3 Children</option>
                        </select>
                    </div>
                    <div class="col-lg-2 mb-lg-3 mt-2">
                        <button type="submit" class="btn text-white shadow-none custom-bg w-100">Check Availability</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Our Rooms -->
<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR ROOMS</h2>

<!-- Cards -->
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-6 my-3">
            <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                <img src="Images/Rooms/IMG_11892.png" class="card-img-top room-image">
                <div class="card-body">
                    <h5>Deluxe Family Suite</h5>
                    <h6 class="mb-4">৳5000 Per Night</h6>
                    <div class="features mb-4">
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
                    <div class="facilities mb-4">
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
                    <div class="guests mb-4">
                        <h6 class="mb-1">Guests</h6>
                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                            Upto 4 Adults
                        </span>
                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                            2 Children
                        </span>
                    </div>
                    <div class="ratings mb-4">
                        <h6 class="mb-1">Rating</h6>
                        <span class="badge rounded-pill bg-light">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </span>
                    </div>
                    <div class="d-flex justify-content-evenly mb-2">
                        <?php if(isset($_SESSION['user_id'])): ?>
                            <a href="booking.php?room_id=1" class="btn btn-sm text-white custom-bg shadow-none">Book Now</a>
                        <?php else: ?>
                            <a href="login.php" class="btn btn-sm text-white custom-bg shadow-none">Login to Book</a>
                        <?php endif; ?>
                        <a href="room.php" class="btn btn-sm btn-outline-dark shadow-none">More Details</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 my-3">
            <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                <img src="Images/Rooms/IMG_78809.png" class="card-img-top room-image">
                <div class="card-body">
                    <h5>Premium Wooden Cottage</h5>
                    <h6 class="mb-4">৳8000 Per Night</h6>
                    <div class="features mb-4">
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
                    <div class="facilities mb-4">
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
                    <div class="guests mb-4">
                        <h6 class="mb-1">Guests</h6>
                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                            Upto 3 Adults
                        </span>
                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                            2 Children
                        </span>
                    </div>
                    <div class="ratings mb-4">
                        <h6 class="mb-1">Rating</h6>
                        <span class="badge rounded-pill bg-light">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </span>
                    </div>
                    <div class="d-flex justify-content-evenly mb-2">
                        <?php if(isset($_SESSION['user_id'])): ?>
                            <a href="booking.php?room_id=2" class="btn btn-sm text-white custom-bg shadow-none">Book Now</a>
                        <?php else: ?>
                            <a href="login.php" class="btn btn-sm text-white custom-bg shadow-none">Login to Book</a>
                        <?php endif; ?>
                        <a href="room.php" class="btn btn-sm btn-outline-dark shadow-none">More Details</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 my-3">
            <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                <img src="Images/Rooms/IMG_65019.png" class="card-img-top room-image">
                <div class="card-body">
                    <h5>Luxury Modern Apartment</h5>
                    <h6 class="mb-4">৳10000 Per Night</h6>
                    <div class="features mb-4">
                        <h6 class="mb-1">Features</h6>
                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                            3 Bedrooms
                        </span>
                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                            2 Bathrooms
                        </span>
                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                            1 Kitchen
                        </span>
                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                            1 Balcony & Living Room
                        </span>
                    </div>
                    <div class="facilities mb-4">
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
                            Spa access
                        </span>
                    </div>
                    <div class="guests mb-4">
                        <h6 class="mb-1">Guests</h6>
                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                            Up to 6 Adults
                        </span>
                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                            3 Children
                        </span>
                    </div>
                    <div class="ratings mb-4">
                        <h6 class="mb-1">Rating</h6>
                        <span class="badge rounded-pill bg-light">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </span>
                    </div>
                    <div class="d-flex justify-content-evenly mb-2">
                        <?php if(isset($_SESSION['user_id'])): ?>
                            <a href="booking.php?room_id=3" class="btn btn-sm text-white custom-bg shadow-none">Book Now</a>
                        <?php else: ?>
                            <a href="login.php" class="btn btn-sm text-white custom-bg shadow-none">Login to Book</a>
                        <?php endif; ?>
                        <a href="room.php" class="btn btn-sm btn-outline-dark shadow-none">More Details</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 text-center mt-5">
            <a href="room.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Rooms >>>>></a>
        </div>
    </div>
</div>

<!-- Our Facilities -->
<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR FACILITIES</h2>
<div class="container">
    <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
        <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
            <img src="Images/Features/Wifi.svg" width="80px">
            <h5 class="mt-3">WiFi</h5>
        </div>
        <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
            <img src="Images/Features/TV.svg" width="80px">
            <h5 class="mt-3">TV</h5>
        </div>
        <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
            <img src="Images/Features/Air Conditioner.svg" width="80px">
            <h5 class="mt-3">Air Conditioner</h5>
        </div>
        <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
            <img src="Images/Features/Geyser.svg" width="80px">
            <h5 class="mt-3">Geyser</h5>
        </div>
        <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
            <img src="Images/Features/Room heater.svg" width="80px">
            <h5 class="mt-3">Room heater</h5>
        </div>
        <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
            <img src="Images/Features/spa.svg" width="80px">
            <h5 class="mt-3">Spa</h5>
        </div>
        <div class="col-lg-12 text-center mt-5">
            <a href="facilities.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">Know more about facilities >>>>></a>
        </div>
    </div>
</div>

<!-- Testimonials -->
<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">TESTIMONIALS</h2>
<div class="container mb-4"> <!-- Removed shadow class and added mb-4 for bottom margin -->
    <div class="swiper swiper-testimonials">
        <div class="swiper-wrapper">
            <div class="swiper-slide bg-white p-4">
                <div class="profile d-flex align-items-center mb-0">
                    <img src="Images/Features/women.svg" width="30px">
                    <h6 class="m-0 ms-2">Sarah Ahmed</h6>
                </div>
                <p class="mt-2 mb-2">
                    "The Deluxe Family Suite was perfect for our trip. 
                    Clean rooms, fast WiFi, and the balcony view was amazing. 
                    Roovila made booking so easy!"
                </p>
                <div class="rating">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                </div>
            </div>
            <div class="swiper-slide bg-white p-4">
                <div class="profile d-flex align-items-center mb-0">
                    <img src="Images/Features/man.svg" width="30px">
                    <h6 class="m-0 ms-2">Tanvir Hasan</h6>
                </div>
                <p class="mt-2 mb-2">
                    "I stayed at the Premium Wooden Cottage. The natural vibe and wooden interior felt so cozy. 
                    Would love to come again."
                </p>
                <div class="rating">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                </div>
            </div>
            <div class="swiper-slide bg-white p-4">
                <div class="profile d-flex align-items-center mb-0">
                    <img src="Images/Features/man.svg" width="30px">
                    <h6 class="m-0 ms-2">Abdullah Karim</h6>
                </div>
                <p class="mt-2 mb-2">
                    "Smooth booking process and no hidden charges. 
                    The room heater worked great during our winter trip. Highly recommend!"
                </p>
                <div class="rating">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>

<div class="col-lg-12 text-center mt-3 mb-5"> <!-- Added mb-5 for bottom margin -->
    <a href="about.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">Know More >>>>></a>
</div>


<!-- Find US -->
<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">FIND US</h2>

<div class="container shadow">
    <div class="row">
        <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded"> 
            <iframe class="w-100 rounded" height="320px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.7564163810407!2d90.37035598576563!3d23.756064133567378!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b9982c401b0b%3A0x69e469d879d2a4b7!2sDhanmondi%20%23%2027!5e0!3m2!1sen!2sbd!4v1755560712710!5m2!1sen!2sbd" loading="lazy" ></iframe>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="bg-white p-4 rounded mb-4">
                <h5>Call Us</h5>
                <a href="tel:+8801930243176" class="d-inline-block mb-2 text-decoration-none text-dark"><i class="bi bi-telephone"></i>+8801930243176</a><br>
                <a href="tel:+8801796216837" class="d-inline-block text-decoration-none text-dark"><i class="bi bi-telephone"></i>+8801796216837</a>
            </div>
            <div class="bg-white p-4 rounded mb-4">
                <h5>Follow Us</h5>
                <a href="#" class="d-inline-block mb-3">
                    <span class="badge bg-light text-dark fs-6 p-2">
                        <i class="bi bi-instagram me-1"></i>Instagram
                    </span>
                </a>
                <br>
                <a href="#" class="d-inline-block mb-3">
                    <span class="badge bg-light text-dark fs-6 p-2">
                        <i class="bi bi-facebook me-1"></i>Facebook
                    </span>
                </a>
                <br>
                <a href="#" class="d-inline-block mb-3">
                    <span class="badge bg-light text-dark fs-6 p-2">
                        <i class="bi bi-twitter-x me-1"></i>Twitter-X
                    </span>
                </a>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script> 

<!---Initialize swiper-->
<script>
    // Initialize Carousel Swiper
    var swiper = new Swiper(".mySwiper", {
        spaceBetween: 30,
        effect: "fade",
        loop: true,
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        }
    });
    
     //initialize testimonial swiper
    var swiper = new Swiper(".swiper-testimonials", {
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: true,
      },
      pagination: {
        el: ".swiper-pagination",
      },
    });
  

    
    // Set active navigation link
    function setActive() {
        let navbar = document.getElementById('navbarNav');
        if (!navbar) return;
        
        let a_tags = navbar.getElementsByTagName('a');
        let currentPage = window.location.pathname.split('/').pop();
        
        for (let i = 0; i < a_tags.length; i++) {
            let linkPage = a_tags[i].href.split('/').pop();
            if (currentPage === linkPage) {
                a_tags[i].classList.add('active');
                break;
            }
        }
    }
    
    // Call function when page loads
    document.addEventListener('DOMContentLoaded', setActive);
</script>
</body>
</html>