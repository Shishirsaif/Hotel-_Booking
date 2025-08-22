<?php
require_once('admin/database_config.php');
require_once('admin/essentials.php');

session_start();
if(!isset($_SESSION['user_id'])){
    echo "Please login first!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $user_id = $_SESSION['user_id'];
    
    if ($action === 'create_booking') {
        $frm_data = filteration($_POST);
        
        // Validate dates
        $check_in = date('Y-m-d', strtotime($frm_data['check_in']));
        $check_out = date('Y-m-d', strtotime($frm_data['check_out']));
        
        if ($check_in >= $check_out) {
            echo "Check-out date must be after check-in date!";
            exit;
        }
        
        // Get room details
        $room_q = "SELECT * FROM rooms WHERE id=?";
        $room_res = select($room_q, [$frm_data['room_id']], "i");
        
        if (mysqli_num_rows($room_res) != 1) {
            echo "Room not found!";
            exit;
        }
        
        $room = mysqli_fetch_assoc($room_res);
        
        // Check capacity
        if ($frm_data['adults'] > $room['adult_capacity'] || $frm_data['children'] > $room['children_capacity']) {
            echo "Number of guests exceeds room capacity!";
            exit;
        }
        
        // Calculate total amount
        $date1 = new DateTime($check_in);
        $date2 = new DateTime($check_out);
        $days = $date1->diff($date2)->days;
        $total_amount = $days * $room['price'];
        
        // Insert booking
        $q = "INSERT INTO bookings (user_id, room_id, check_in, check_out, adults, children, total_amount) VALUES (?,?,?,?,?,?,?)";
        $values = [$user_id, $frm_data['room_id'], $check_in, $check_out, $frm_data['adults'], $frm_data['children'], $total_amount];
        
        $res = insert($q, $values, 'iissiid');
        
        if ($res == 1) {
            echo "success";
        } else {
            echo "Booking failed! Please try again.";
        }
        
    } elseif ($action === 'cancel_booking') {
        $booking_id = (int)$_POST['booking_id'];
        
        // Verify user owns this booking
        $verify_q = "SELECT * FROM bookings WHERE id=? AND user_id=?";
        $verify_res = select($verify_q, [$booking_id, $user_id], "ii");
        
        if (mysqli_num_rows($verify_res) != 1) {
            echo "Booking not found!";
            exit;
        }
        
        $booking = mysqli_fetch_assoc($verify_res);
        
        // Check if booking can be cancelled (at least 2 days before check-in)
        $check_in = new DateTime($booking['check_in']);
        $today = new DateTime();
        $diff = $today->diff($check_in)->days;
        
        if ($diff < 2) {
            echo "Cannot cancel booking within 48 hours of check-in!";
            exit;
        }
        
        // Cancel booking
        $cancel_q = "UPDATE bookings SET status='cancelled' WHERE id=? AND user_id=?";
        $cancel_res = update($cancel_q, [$booking_id, $user_id], "ii");
        
        if ($cancel_res == 1) {
            echo "success";
        } else {
            echo "Cancellation failed!";
        }
    }
}
?>