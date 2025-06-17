<?php
// save.php
// Allow from any origin
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// For preflight request (OPTIONS), just exit
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *"); // Allow Vue to access it
header("Access-Control-Allow-Headers: *");
$servername = "localhost";
$username = "root";
$password = "";
$db = "my_database";

$conn = new mysqli("localhost", "root", "", "my_database");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$age = $_POST['age'] ?? null;
$gender = $_POST['gender'] ?? '';
$agree = $_POST['agree'] ?? '0';
$country = $_POST['country'] ?? '';
$message = $_POST['message'] ?? '';

$filename = '';
if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) mkdir($uploadDir);
    $filename = basename($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'], $uploadDir . $filename);
}

$stmt = $conn->prepare("INSERT INTO user_form (name, email, age, gender, agree, country, message, file) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssisssss", $name, $email, $age, $gender, $agree, $country, $message, $filename);

if ($stmt->execute()) {
    echo json_encode("Data saved successfully!");
} else {
    // echo "Error: " . $stmt->error;
    echo json_encode($stmt->error);
}

$stmt->close();
$conn->close();
