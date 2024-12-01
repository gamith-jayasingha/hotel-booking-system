<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel_booking";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$room_id = $_POST['room_id'];
$checkin = $_POST['checkin'];
$checkout = $_POST['checkout'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone_number = $_POST['phone_number'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="confirm_booking.css">
</head>
<body>
<div class="container">
    <?php
    // Insert guest details
    $sql = "INSERT INTO guests (first_name, last_name, email, phone_number) 
            VALUES ('$first_name', '$last_name', '$email', '$phone_number')";
    if ($conn->query($sql) === TRUE) {
        $guest_id = $conn->insert_id;

        // Insert booking details
        $sql = "INSERT INTO bookings (room_id, guest_id, check_in_date, check_out_date) 
                VALUES ($room_id, $guest_id, '$checkin', '$checkout')";
        if ($conn->query($sql) === TRUE) {
            echo "<div class='confirmation-message'>
                    <h2>Booking Confirmed!</h2>
                    <p>Thank you, <strong>$first_name</strong>.</p>
                    <p>Your booking is confirmed for <strong>$checkin</strong> to <strong>$checkout</strong>.</p>
                  </div>";
        } else {
            echo "<div class='error-message'>
                    <h2>Error!</h2>
                    <p>There was an issue confirming your booking: " . $conn->error . "</p>
                  </div>";
        }
    } else {
        echo "<div class='error-message'>
                <h2>Error!</h2>
                <p>There was an issue saving your details: " . $conn->error . "</p>
              </div>";
    }

    $conn->close();
    ?>
</div>
</body>
</html>
