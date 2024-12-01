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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Booking</title>
    <link rel="stylesheet" href="book_room.css">
</head>
<body>
<?php
// Check if the room is available
$sql = "SELECT * FROM bookings WHERE room_id = $room_id AND 
        ('$checkin' BETWEEN check_in_date AND check_out_date OR 
        '$checkout' BETWEEN check_in_date AND check_out_date)";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<p class='error-message'>Room is not available for the selected dates. Please choose another date.</p>";
} else {
    // Get guest details
    echo "<form method='POST' action='confirm_booking.php'>
        <input type='hidden' name='room_id' value='$room_id'>
        <input type='hidden' name='checkin' value='$checkin'>
        <input type='hidden' name='checkout' value='$checkout'>
        <label>First Name:</label>
        <input type='text' name='first_name' required>
        <label>Last Name:</label>
        <input type='text' name='last_name' required>
        <label>Email:</label>
        <input type='email' name='email' required>
        <label>Phone Number:</label>
        <input type='text' name='phone_number' required>
        <button type='submit'>Confirm Booking</button>
    </form>";
}

$conn->close();
?>
</body>
</html>
