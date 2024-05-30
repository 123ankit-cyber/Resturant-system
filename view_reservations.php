<?php

// Database configuration
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = "password"; // Your MySQL password
$database = "customer informtion"; // Your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle reservation request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $num_guests = $_POST["num_guests"];
    $date = $_POST["date"];
    $time = $_POST["time"];

    $stmt = $conn->prepare("INSERT INTO reservations (name, phone, email,num_guests, reservation_date, reservation_time) VALUES (?, ?,?, ?, ?, ?)");
    $stmt->bind_param("sssiss", $name, $phone,$email, $num_guests, $date, $time);

    if ($stmt->execute() === TRUE) {
        echo "Reservation made successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}

$conn->close();

?>
