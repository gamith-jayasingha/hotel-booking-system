<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <h1>Hotel Booking System</h1>
    <form id="bookingForm" method="POST" action="check_availability.php">
        <label for="hotel">Select Hotel:</label>
        <select id="hotel" name="hotel">
            <option value="The Hadoc Hotel">The Hadoc Hotel</option>
            <option value="Kings Hotel">Kings Hotel</option>
        </select><br><br>

        <label for="checkin">Check-In Date:</label>
        <input type="date" id="checkin" name="checkin" required><br><br>

        <label for="checkout">Check-Out Date:</label>
        <input type="date" id="checkout" name="checkout" required><br><br>

        <label for="guests">Guest Quantity:</label>
        <input type="number" id="guests" name="guests" min="1" max="10" required><br><br>

        <button type="submit">Check Availability</button>
    </form>

    <div id="rooms"></div>
    <script src="script.js"></script>
</body>
</html>
