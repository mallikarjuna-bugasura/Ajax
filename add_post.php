<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "Not logged in"]);
    exit;
}

if (!isset($_POST['new_post']) || trim($_POST['new_post']) == "") {
    echo json_encode(["status" => "error", "message" => "Post cannot be empty"]);
    exit;
}

$uid = $_SESSION['user_id'];
$post = $conn->real_escape_string(trim($_POST['new_post']));

$sql = "INSERT INTO tWall(user_id, posting_date, post) VALUES($uid, NOW(), '$post')";
if ($conn->query($sql)) {
    echo json_encode(["status" => "success", "message" => "Post added successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to add post"]);
}
?>




