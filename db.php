<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'Ahmed_AJ';

if (class_exists('mysqli')) {
    $conn = @new mysqli($host, $user, $pass, $db);
} else {
    $conn = null;
}
if (!$conn || $conn->connect_errno) {
    $db_error = $conn->connect_error;
    $conn = null;
} else {
    $conn->set_charset('utf8mb4');
}

function e($value): string {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
