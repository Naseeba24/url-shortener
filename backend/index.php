<?php
include 'db.php';

// Get path after /url-shortener/
$request = $_SERVER['REQUEST_URI'];

// Remove project folder from URL
$basePath = "/url-shortener/";
$code = str_replace($basePath, "", $request);
$code = trim($code, "/");

// If no code → show homepage message
if ($code == "" || $code == "index.php") {
    echo "URL Shortener API Running";
    exit;
}

// Find URL in database
$stmt = $conn->prepare("SELECT long_url FROM links WHERE short_code = ?");
$stmt->bind_param("s", $code);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    header("Location: " . $row['long_url']);
    exit;
} else {
    echo "Short URL not found";
}
?>