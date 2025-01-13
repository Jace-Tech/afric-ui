<?php
header("Content-Type: application/json");

// Database credentials
$servername = "localhost";
$username = "jealxeco_jealo";
$password = "jealoandyesglobal";
$dbname = "jealxeco_alphabot";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed."]);
    exit;
}

// Get the JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Validate input
if (!isset($data['sender_room'], $data['recipient_room'], $data['return_to_sender'], $data['sender_email'], $data['recipient_email'])) {
    echo json_encode(["success" => false, "message" => "Invalid input."]);
    exit;
}

// Sanitize input
$sender_room = $conn->real_escape_string($data['sender_room']);
$recipient_room = $conn->real_escape_string($data['recipient_room']);
$return_to_sender = (int) $data['return_to_sender'];
$sender_email = $conn->real_escape_string($data['sender_email']);
$recipient_email = $conn->real_escape_string($data['recipient_email']);

// Insert data into the database
$sql = "INSERT INTO bookings (sender_room, recipient_room, return_to_sender, sender_email, recipient_email)
        VALUES ('$sender_room', '$recipient_room', $return_to_sender, '$sender_email', '$recipient_email')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Error: " . $conn->error]);
}

$conn->close();
?>