<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: index.php#register'); exit; }
$first = trim($_POST['first_name'] ?? '');
$last = trim($_POST['last_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$agree = isset($_POST['agree']);

if (!$first || !$last || !filter_var($email, FILTER_VALIDATE_EMAIL) || !$phone || !$agree) {
    header('Location: index.php?error=invalid#register'); exit;
}
if (!$conn) { header('Location: index.php?error=db#register'); exit; }

$check = $conn->prepare('SELECT id FROM participants WHERE email = ? LIMIT 1');
$check->bind_param('s', $email);
$check->execute();
$check->store_result();
$exists = $check->num_rows > 0;
$check->close();
if ($exists) { header('Location: index.php?error=duplicate#register'); exit; }

$ticket = random_int(100000, 999999);
while (true) {
    $check = $conn->prepare('SELECT id FROM participants WHERE ticket_no = ? LIMIT 1');
    $check->bind_param('i', $ticket);
    $check->execute();
    $check->store_result();
    $exists = $check->num_rows > 0;
    $check->close();
    if (!$exists) break;
    $ticket = random_int(100000, 999999);
}

$stmt = $conn->prepare('INSERT INTO participants (ticket_no, first_name, last_name, email, phone) VALUES (?, ?, ?, ?, ?)');
$stmt->bind_param('issss', $ticket, $first, $last, $email, $phone);
$stmt->execute();
$stmt->close();

header('Location: success.php?ticket='.urlencode($ticket).'&name='.urlencode($first.' '.$last));
exit;
