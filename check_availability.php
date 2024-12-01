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

$hotel = $_POST['hotel'];
$checkin = $_POST['checkin'];
$checkout = $_POST['checkout'];
$guests = $_POST['guests'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>
    <link rel="stylesheet" href="check_availability.css"> <!-- Add your CSS file here -->
</head>
<body>
<header>
    <h3>Welcome to Our Hotel Booking System</h3>
</header>
<main>
    <?php
    // Fetch rooms based on guest quantity
    if ($guests < 3) {
        // Show Standard and Deluxe Rooms for less than 3 guests
        $sql = "SELECT * FROM rooms WHERE hotel_name = '$hotel'";
    } elseif ($guests >= 3 && $guests <= 5) {
        // Show Suites and Specialty Rooms for 3 to 5 guests
        $sql = "SELECT * FROM rooms WHERE hotel_name = '$hotel' AND room_type IN ('Suite', 'Specialty Room')";
    } else {
        // Show Specialty and Shared Rooms for more than 5 guests
        $sql = "SELECT * FROM rooms WHERE hotel_name = '$hotel' AND room_type IN ('Specialty Room', 'Shared Room')";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='room-list'>";
        while ($row = $result->fetch_assoc()) {
            echo "
            <div class='room'>
                <h3>{$row['room_type']}</h3>
                <p>{$row['description']}</p>
                <p>Price per Night: {$row['price_per_night']}</p>
                <img src='{$row['image_url']}' alt='{$row['room_type']}' width='100'>
                <form method='POST' action='book_room.php'>
                    <input type='hidden' name='room_id' value='{$row['id']}'>
                    <input type='hidden' name='checkin' value='$checkin'>
                    <input type='hidden' name='checkout' value='$checkout'>
                    <button type='submit'>Book Room</button>
                </form>
            </div>";
        }
        echo "</div>";
    } else {
        echo "<p>No rooms available for the selected criteria.</p>";
    }

    $conn->close();
    ?>
</main>

</body>
</html>