<?php 
include('includes/navigation.php'); 

require('admin/database_config.php');
require('admin/essentials.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
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

<div class="my-5 px-5">
    <h2 class="fw-bold h-font text-center">CONTACT US</h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3 mb-5">
        Have questions or need support? 
        Our team is here to help you 24/7 with bookings, payments, or any travel inquiries. 
        Reach out to us anytime—we’d love to hear from you!
    </p>
</div>


<div class="container">
    <div class="row">
        <!-- Left Side -->
        <div class="col-lg-6 col-lg-md-6 mb-5 px-4">
            <div class="bg-white rounded shadow p-4">
                <iframe class="w-100 rounded mb-4" height="320px"  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.7564163810407!2d90.37035598576563!3d23.756064133567378!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b9982c401b0b%3A0x69e469d879d2a4b7!2sDhanmondi%20%23%2027!5e0!3m2!1sen!2sbd!4v1755560712710!5m2!1sen!2sbd" loading="lazy" ></iframe>
                
                <h5>Address</h5>
                <a href="https://maps.app.goo.gl/pBWct5753Zq1cFZk6" target="_blank" class="d-inline-block text-decoration-none text-dark mb-2"><i class="bi bi-geo-alt"></i>SKS Tower, Dhanmondi 27, Dhaka-1209</a>
                
                <h5 class="mt-4">Call Us</h5>
                <a href="tel:+8801930243176" class="d-inline-block mb-2 text-decoration-none text-dark"><i class="bi bi-telephone"></i>+8801930243176</a><br>
                <a href="tel:+8801796216837" class="d-inline-block  text-decoration-none text-dark"><i class="bi bi-telephone"></i>+8801796216837</a>
                
                <h5 class="mt-4">Email</h5>
                <a href="mailto: ShishirSaif216837@gmail.com" class="d-inline-block text-decoration-none text-dark mb-2"><i class="bi bi-envelope me-1"></i>ShishirSaif216837@gmail.com</a>
                
                <h5 class="mt-4">Follow us</h5>
                <a href="#" class="d-inline-block text-dark text-decoration-none text-dark fs-5 me-2"><i class="bi bi-instagram me-1"></i></a>
                <a href="#" class="d-inline-block text-dark text-decoration-none text-dark fs-5 me-2"><i class="bi bi-facebook me-1"></i></a>
                <a href="#" class="d-inline-block text-dark text-decoration-none text-dark fs-5"><i class="bi bi-twitter-x me-1"></i></a>
            </div>
        </div>
        <!-- Right Side -->
        <div class="col-lg-6 col-lg-md-6 px-4">
            <div class="bg-white rounded shadow p-4">
                <form method ="POST" >
                    <h5>Send a message</h5>
                    <div class="mt-3">
                        <label type="text" class="form-label shadow-none fw-bold" required>Name</label>
                        <input name="name" type="text" class="form-control shadow-none" required>
                    </div>
                    <div class="mt-3">
                        <label type="text" class="form-label shadow-none fw-bold" required>Email</label>
                        <input type="Email" name="email" class="form-control shadow-none" required>
                    </div>
                    <div class="mt-3">
                        <label type="text" class="form-label shadow-none fw-bold">Subject</label>
                        <input type="text" name="subject" class="form-control shadow-none" required >
                    </div>
                    <div class="mt-3">
                        <label type="text" class="form-label shadow-none fw-bold" required>Your Message</label>
                        <textarea name="message" class="form-control shadow-none" rows="5" style="resize: none;" required></textarea>
                    </div>
                    <button type="submit" name="send" class="btn text-white custom-bg mt-3">SEND</button>
                </form>
            </div>
        </div>


<?php
if(isset($_POST['send']))
{
  $frm_data = filteration($_POST);
  $q = "INSERT INTO `user_queries`(`name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
  $values = [$frm_data['name'],$frm_data['email'],$frm_data['subject'],$frm_data['message']];

  $res = insert($q,$values,'ssss');
  
  if($res==1){
    alert('success', 'Mail sent');
  }
  else{
    alert('error','Try again later');
  }
}
?>



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
      <a href="index.html" class="d-inline-block mb-2 text-dark text-decoration-none">Home</a><br>
      <a href="room.html" class="d-inline-block mb-2 text-dark text-decoration-none">Rooms</a><br>
      <a href="facilities.html" class="d-inline-block mb-2 text-dark text-decoration-none">Facilities</a><br>
      <a href="contact.html" class="d-inline-block mb-2 text-dark text-decoration-none">Contact Us</a><br>
      <a href="about.html" class="d-inline-block mb-2 text-dark text-decoration-none">About Us</a>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
