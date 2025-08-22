<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Roovila - Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Merienda:wght@700&display=swap" rel="stylesheet">
  <style>
    * { font-family: "Poppins", sans-serif; }
    .h-font { font-family: "Merienda", cursive; font-weight: 700; }
    .form-card {
      max-width: 450px;
      margin: 50px auto;
      padding: 30px;
      border-radius: 10px;
      background: #fff;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-4 py-lg-3 shadow-sm sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold fs-4 h-font" href="index.php">Roovila</a>
    <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link me-3" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link me-3" href="room.php">Rooms</a></li>
        <li class="nav-item"><a class="nav-link me-3" href="facilities.php">Facilities</a></li>
        <li class="nav-item"><a class="nav-link me-3" href="about.php">About Us</a></li>
        <li class="nav-item"><a class="nav-link me-3" href="contact.php">Contact Us</a></li>
      </ul>
    </div>
  </div>
</nav>
<!-- Register Form -->
<div class="form-card">
  <h3 class="text-center mb-4">Create Your Account</h3>
  <form id="register-form" enctype="multipart/form-data">
    <div class="mb-3">
      <label>Full Name</label>
      <input type="text" name="name" class="form-control" placeholder="Your name" required>
    </div>
    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" placeholder="Your email" required>
    </div>
    <div class="mb-3">
      <label>Phone Number</label>
      <input type="text" name="phonenum" class="form-control" placeholder="Phone number">
    </div>
    <div class="mb-3">
      <label>Address</label>
      <input type="text" name="address" class="form-control" placeholder="Address">
    </div>
    <div class="mb-3">
      <label>Date of Birth</label>
      <input type="date" name="dob" class="form-control">
    </div>
    <div class="mb-3">
      <label>Password</label>
      <input type="password" name="password" class="form-control" placeholder="Password" required>
    </div>
    <div class="mb-3">
      <label>Profile Picture</label>
      <input type="file" name="profile" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary w-100">Register</button>
  </form>
</div>


<script>

document.getElementById('register-form')?.addEventListener('submit', function(e){
    e.preventDefault();
    let formData = new FormData(this);
    fetch('ajax/login_register.php', {
        method: 'POST',
        body: formData
    }).then(res => res.text())
      .then(data => {
        if(data.trim() == 'registered'){
            alert('Registration successful!');
            window.location.href = 'login.php';
        } else {
            alert(data);
        }
    });
});
</script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
