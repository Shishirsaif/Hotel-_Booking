<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

require('admin/database_config.php');
require('admin/essentials.php');

// Get room details
$room_id = isset($_GET['room_id']) ? (int)$_GET['room_id'] : 0;
$room_q = "SELECT * FROM rooms WHERE id=?";
$room_res = select($room_q, [$room_id], "i");

if (mysqli_num_rows($room_res) != 1) {
    header("Location: room.php");
    exit;
}

$room = mysqli_fetch_assoc($room_res);

// Get search parameters if any
$check_in = $_GET['check_in'] ?? date('Y-m-d', strtotime('+1 day'));
$check_out = $_GET['check_out'] ?? date('Y-m-d', strtotime('+2 days'));
$adults = $_GET['adults'] ?? 2;
$children = $_GET['children'] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book <?php echo $room['name']; ?> - Roovila</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Merienda:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        * { font-family: "Poppins", sans-serif; }
        .h-font { font-family: "Merienda", cursive; font-weight: 700; }
        .room-image {
            height: 250px;
            object-fit: cover;
            border-radius: 10px;
        }
        .price-highlight {
            font-size: 1.5rem;
            font-weight: bold;
            color: #28a745;
        }
    </style>
</head>
<body class="bg-light">
    <!-- Navbar (same as other pages) -->
    
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="bi bi-calendar-check me-2"></i>Book <?php echo $room['name']; ?></h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <?php if($room['featured_image']): ?>
                                    <img src="images/rooms/<?php echo $room['featured_image']; ?>" class="room-image w-100 mb-3">
                                <?php else: ?>
                                    <div class="bg-light room-image w-100 d-flex align-items-center justify-content-center mb-3">
                                        <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                    </div>
                                <?php endif; ?>
                                
                                <h5>Room Details</h5>
                                <p><strong>Price:</strong> <span class="price-highlight">৳<?php echo $room['price']; ?></span> per night</p>
                                <p><strong>Capacity:</strong> <?php echo $room['adult_capacity']; ?> Adults, <?php echo $room['children_capacity']; ?> Children</p>
                                <p><strong>Description:</strong> <?php echo $room['description']; ?></p>
                            </div>
                            
                            <div class="col-md-6">
                                <form id="booking-form">
                                    <input type="hidden" name="room_id" value="<?php echo $room['id']; ?>">
                                    <input type="hidden" name="action" value="create_booking">
                                    
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Check-in Date</label>
                                            <input type="date" name="check_in" class="form-control" value="<?php echo $check_in; ?>" required min="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Check-out Date</label>
                                            <input type="date" name="check_out" class="form-control" value="<?php echo $check_out; ?>" required>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Adults</label>
                                            <select name="adults" class="form-select" required>
                                                <?php for($i = 1; $i <= $room['adult_capacity']; $i++): ?>
                                                    <option value="<?php echo $i; ?>" <?php echo $i == $adults ? 'selected' : ''; ?>><?php echo $i; ?> Adult<?php echo $i > 1 ? 's' : ''; ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Children</label>
                                            <select name="children" class="form-select" required>
                                                <?php for($i = 0; $i <= $room['children_capacity']; $i++): ?>
                                                    <option value="<?php echo $i; ?>" <?php echo $i == $children ? 'selected' : ''; ?>><?php echo $i; ?> Child<?php echo $i > 1 ? 'ren' : ''; ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <div class="card bg-light">
                                            <div class="card-body">
                                                <h6>Booking Summary</h6>
                                                <div id="booking-summary">
                                                    <p class="mb-1">Nights: <span id="nights">0</span></p>
                                                    <p class="mb-1">Total: <span id="total-amount">৳0.00</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary w-100 btn-lg">
                                            <i class="bi bi-credit-card me-2"></i>Confirm Booking
                                        </button>
                                    </div>
                                </form>
                                
                                <div id="booking-result" class="mt-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Calculate and update booking summary
        function updateBookingSummary() {
            const checkIn = new Date(document.querySelector('input[name="check_in"]').value);
            const checkOut = new Date(document.querySelector('input[name="check_out"]').value);
            const pricePerNight = <?php echo $room['price']; ?>;
            
            if (checkIn && checkOut && checkOut > checkIn) {
                const nights = Math.ceil((checkOut - checkIn) / (1000 * 60 * 60 * 24));
                const totalAmount = nights * pricePerNight;
                
                document.getElementById('nights').textContent = nights;
                document.getElementById('total-amount').textContent = `৳${totalAmount.toLocaleString()}`;
            }
        }
        
        // Update summary when dates change
        document.querySelectorAll('input[name="check_in"], input[name="check_out"]').forEach(input => {
            input.addEventListener('change', updateBookingSummary);
        });
        
        // Initial calculation
        updateBookingSummary();
        
        // Form submission
        document.getElementById('booking-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const resultDiv = document.getElementById('booking-result');
            
            resultDiv.innerHTML = '<div class="alert alert-info">Processing your booking...</div>';
            
            fetch('ajax/booking_actions.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data === 'success') {
                    resultDiv.innerHTML = '<div class="alert alert-success">Booking successful! Redirecting to dashboard...</div>';
                    setTimeout(() => {
                        window.location.href = 'user_dashboard.php';
                    }, 2000);
                } else {
                    resultDiv.innerHTML = `<div class="alert alert-danger">${data}</div>`;
                }
            })
            .catch(error => {
                resultDiv.innerHTML = '<div class="alert alert-danger">An error occurred. Please try again.</div>';
            });
        });
        
        // Set minimum check-out date based on check-in date
        document.querySelector('input[name="check_in"]').addEventListener('change', function() {
            const checkInDate = new Date(this.value);
            checkInDate.setDate(checkInDate.getDate() + 1);
            
            const checkOutField = document.querySelector('input[name="check_out"]');
            checkOutField.min = checkInDate.toISOString().split('T')[0];
            
            if (new Date(checkOutField.value) <= new Date(this.value)) {
                checkOutField.value = checkInDate.toISOString().split('T')[0];
            }
            
            updateBookingSummary();
        });
    </script>
</body>
</html>