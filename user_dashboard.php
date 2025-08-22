<?php
include('includes/navigation.php');
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

require('admin/database_config.php');
require('admin/essentials.php');

// Get user details
$user_id = $_SESSION['user_id'];
$user_q = "SELECT * FROM users WHERE id=?";
$user_res = select($user_q, [$user_id], "i");
$user_data = mysqli_fetch_assoc($user_res);

// Get user bookings
$bookings_q = "SELECT b.*, r.name as room_name, r.featured_image 
               FROM bookings b 
               JOIN rooms r ON b.room_id = r.id 
               WHERE b.user_id = ? 
               ORDER BY b.booking_date DESC";
$bookings_res = select($bookings_q, [$user_id], "i");

// Get booking statistics
$total_bookings_q = "SELECT COUNT(*) as total FROM bookings WHERE user_id = ?";
$total_bookings_res = select($total_bookings_q, [$user_id], "i");
$total_bookings = mysqli_fetch_assoc($total_bookings_res)['total'];

$upcoming_bookings_q = "SELECT COUNT(*) as upcoming FROM bookings WHERE user_id = ? AND check_in >= CURDATE() AND status = 'confirmed'";
$upcoming_bookings_res = select($upcoming_bookings_q, [$user_id], "i");
$upcoming_bookings = mysqli_fetch_assoc($upcoming_bookings_res)['upcoming'];

$total_spent_q = "SELECT COALESCE(SUM(total_amount), 0) as total_spent FROM bookings WHERE user_id = ? AND status = 'confirmed'";
$total_spent_res = select($total_spent_q, [$user_id], "i");
$total_spent = mysqli_fetch_assoc($total_spent_res)['total_spent'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Roovila</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Merienda:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        * { font-family: "Poppins", sans-serif; }
        .h-font { font-family: "Merienda", cursive; font-weight: 700; }
        
        .dashboard-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            padding: 25px;
            margin-bottom: 25px;
            color: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            padding: 20px;
            text-align: center;
            transition: transform 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-3px);
        }
        
        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: #667eea;
        }
        
        .booking-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            padding: 20px;
            margin-bottom: 20px;
            border-left: 4px solid #667eea;
            transition: transform 0.2s ease;
        }
        
        .booking-card:hover {
            transform: translateX(5px);
        }
        
        .status-badge {
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 600;
        }
        
        .profile-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .welcome-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            padding: 30px;
            color: white;
            margin-bottom: 30px;
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
                <div class="d-flex align-items-center">
                    <span class="me-3 text-dark">Welcome, <?php echo $user_data['name']; ?></span>
                    <a href="user_dashboard.php" class="btn btn-outline-primary btn-sm me-2">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                    <a href="logout.php" class="btn btn-outline-danger btn-sm">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <!-- Welcome Section -->
        <div class="welcome-section text-center">
            <div class="row align-items-center">
                <div class="col-md-3 text-center">
                    <?php if($user_data['profile_picture']): ?>
                        <img src="images/users/<?php echo $user_data['profile_picture']; ?>" class="profile-img rounded-circle">
                    <?php else: ?>
                        <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($user_data['name']); ?>&background=667eea&color=fff" class="profile-img rounded-circle">
                    <?php endif; ?>
                </div>
                <div class="col-md-9">
                    <h2 class="h-font">Welcome back, <?php echo $user_data['name']; ?>! 👋</h2>
                    <p class="mb-0">We're glad to see you again. Here's your booking overview.</p>
                    <p class="mb-0"><i class="bi bi-envelope me-2"></i><?php echo $user_data['email']; ?></p>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-5">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <h3 class="text-primary"><?php echo $total_bookings; ?></h3>
                    <p class="text-muted">Total Bookings</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-arrow-up-circle"></i>
                    </div>
                    <h3 class="text-success"><?php echo $upcoming_bookings; ?></h3>
                    <p class="text-muted">Upcoming Stays</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-currency-dollar"></i>
                    </div>
                    <h3 class="text-info">৳<?php echo number_format($total_spent, 2); ?></h3>
                    <p class="text-muted">Total Spent</p>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Bookings Section -->
            <div class="col-lg-8">
                <div class="dashboard-card">
                    <h4 class="mb-4"><i class="bi bi-journal-text me-2"></i>Your Booking History</h4>
                    
                    <?php if(mysqli_num_rows($bookings_res) > 0): ?>
                        <div class="booking-list">
                            <?php while($booking = mysqli_fetch_assoc($bookings_res)): 
                                $status_class = '';
                                switch($booking['status']) {
                                    case 'confirmed': $status_class = 'bg-success'; break;
                                    case 'pending': $status_class = 'bg-warning'; break;
                                    case 'cancelled': $status_class = 'bg-danger'; break;
                                    case 'completed': $status_class = 'bg-info'; break;
                                    default: $status_class = 'bg-secondary';
                                }
                            ?>
                                <div class="booking-card">
                                    <div class="row align-items-center">
                                        <div class="col-md-3">
                                            <?php if($booking['featured_image']): ?>
                                                <img src="images/rooms/<?php echo $booking['featured_image']; ?>" class="img-fluid rounded" style="height: 80px; width: 100%; object-fit: cover;">
                                            <?php else: ?>
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 80px;">
                                                    <i class="bi bi-image text-muted" style="font-size: 2rem;"></i>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="mb-1"><?php echo $booking['room_name']; ?></h6>
                                            <p class="mb-1 text-muted small">
                                                <i class="bi bi-calendar me-1"></i>
                                                <?php echo date('M j, Y', strtotime($booking['check_in'])); ?> - 
                                                <?php echo date('M j, Y', strtotime($booking['check_out'])); ?>
                                            </p>
                                            <p class="mb-1 text-muted small">
                                                <i class="bi bi-people me-1"></i>
                                                <?php echo $booking['adults']; ?> Adults, 
                                                <?php echo $booking['children']; ?> Children
                                            </p>
                                        </div>
                                        <div class="col-md-3 text-end">
                                            <span class="status-badge <?php echo $status_class; ?> text-white">
                                                <?php echo ucfirst($booking['status']); ?>
                                            </span>
                                            <h6 class="mt-2 text-primary">৳<?php echo number_format($booking['total_amount'], 2); ?></h6>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="bi bi-journal-x" style="font-size: 3rem; color: #6c757d;"></i>
                            <h5 class="text-muted mt-3">No bookings yet</h5>
                            <p class="text-muted">Start exploring our rooms and make your first booking!</p>
                            <a href="room.php" class="btn btn-primary">
                                <i class="bi bi-search me-2"></i>Explore Rooms
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Quick Actions Sidebar -->
            <div class="col-lg-4">
                <div class="dashboard-card">
                    <h4 class="mb-4"><i class="bi bi-lightning me-2"></i>Quick Actions</h4>
                    
                    <div class="d-grid gap-2">
                        <a href="room.php" class="btn btn-light btn-lg text-start">
                            <i class="bi bi-plus-circle me-2 text-primary"></i>
                            Book New Room
                        </a>
                        <a href="contact.php" class="btn btn-light btn-lg text-start">
                            <i class="bi bi-headset me-2 text-info"></i>
                            Contact Support
                        </a>
                        <a href="index.php" class="btn btn-light btn-lg text-start">
                            <i class="bi bi-house me-2 text-success"></i>
                            Back to Home
                        </a>
                        <a href="logout.php" class="btn btn-light btn-lg text-start">
                            <i class="bi bi-box-arrow-right me-2 text-danger"></i>
                            Logout
                        </a>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="dashboard-card mt-4">
                    <h4 class="mb-4"><i class="bi bi-clock-history me-2"></i>Recent Activity</h4>
                    
                    <div class="activity-list">
                        <div class="activity-item d-flex align-items-center mb-3">
                            <div class="activity-icon bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                <i class="bi bi-person-check text-white"></i>
                            </div>
                            <div>
                                <p class="mb-0 small">Account created</p>
                                <span class="text-muted smaller"><?php echo date('M j, Y', strtotime($user_data['created_at'])); ?></span>
                            </div>
                        </div>
                        
                        <?php if($total_bookings > 0): ?>
                        <div class="activity-item d-flex align-items-center mb-3">
                            <div class="activity-icon bg-success rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                <i class="bi bi-calendar-check text-white"></i>
                            </div>
                            <div>
                                <p class="mb-0 small">First booking made</p>
                                <span class="text-muted smaller">Welcome to Roovila!</span>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <script>   
// Cancel booking functionality
document.querySelectorAll('.cancel-booking-btn').forEach(button => {
    button.addEventListener('click', function() {
        const bookingId = this.getAttribute('data-booking-id');
        const roomName = this.getAttribute('data-room-name');
        
        if (confirm(`Are you sure you want to cancel your booking for ${roomName}?`)) {
            const formData = new FormData();
            formData.append('action', 'cancel_booking');
            formData.append('booking_id', bookingId);
            
            fetch('ajax/booking_actions.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data === 'success') {
                    alert('Booking cancelled successfully!');
                    location.reload();
                } else {
                    alert(data);
                }
            })
            .catch(error => {
                alert('An error occurred. Please try again.');
            });
        }
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>