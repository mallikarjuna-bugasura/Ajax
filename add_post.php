<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo "error";
    exit;
}

if (!isset($_POST['new_post']) || trim($_POST['new_post']) == "") {
    echo "error";
    exit;
}

$uid = $_SESSION['user_id'];
$post = $conn->real_escape_string(trim($_POST['new_post']));

$sql = "INSERT INTO tWall(user_id, posting_date, post) VALUES($uid, NOW(), '$post')";
if ($conn->query($sql)) {
    echo "success"; // just return simple text
} else {
    echo "error";
}
?>
