<?php
header("Cache-Control: no-cache, must-revalidate");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json");
include 'db.php';

// Get JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Validate input
if (!isset($data['url']) || empty($data['url'])) {
    echo json_encode(["error" => "URL is required"]);
    exit;
}

$longUrl = trim($data['url']);

// Validate URL format
if (!filter_var($longUrl, FILTER_VALIDATE_URL)) {
    echo json_encode(["error" => "Invalid URL format"]);
    exit;
}

// Function to generate random code
function generateCode($length = 6) {
    return substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, $length);
}

// Ensure unique code
do {
    $shortCode = generateCode();
    $check = $conn->query("SELECT id FROM links WHERE short_code='$shortCode'");
} while ($check->num_rows > 0);

// Save to DB
$stmt = $conn->prepare("INSERT INTO links (long_url, short_code) VALUES (?, ?)");
$stmt->bind_param("ss", $longUrl, $shortCode);

if ($stmt->execute()) {
    echo json_encode([
        "short_url" => "http://localhost/url-shortener/" . $shortCode
    ]);
} else {
    echo json_encode(["error" => "Failed to save"]);
}
?>