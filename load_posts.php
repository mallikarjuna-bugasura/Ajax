<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    exit("Not logged in");
}

$uid = $_SESSION['user_id'];

// Get logged-in user's name
$user_sql = "SELECT Name FROM tUser WHERE user_id=$uid";
$user_res = $conn->query($user_sql);
$user = $user_res->fetch_assoc();
$username = $user['Name'];

// Fetch posts
$post_sql = "SELECT * FROM tWall WHERE user_id=$uid ORDER BY posting_date DESC";
$res = $conn->query($post_sql);

function render_post($p, $username) {
   echo <<<HTML
<div class="post-box">
    <div class="post-header">
        <img src="./images/mark.jpg" alt="">
        <div class="post-details">
            <a href="">{$username}</a>
            <img src="./images/blue.svg" alt="" class="posts-icon">
            <p><b>{$p['posting_date']}</b></p>
        </div>
        <div class="three-dots">
            <img src="./images/dots.svg" alt="">
        </div>
    </div>
    <div class="middle-content">
        <p>{$p['post']}</p>
    </div>
    <div class="footer">
        <div class="footer-content">
            <div class="emojis">
                <img src="./images/like.svg" alt="">
                <img src="./images/heart.svg" alt="">
                <img src="./images/smile.svg" alt="">
                <span>125k</span>
            </div>
            <div>
                <span>47.8k</span>
                <span class="message"><i class="fa-solid fa-comment"></i></span>
                <span>13k</span>
                <span class="share"><i class="fa-solid fa-share"></i></span>
            </div>
        </div>
        <div class="user-options">
            <div class="mains">
                <span><img src="./images/postlike.png" alt=""></span>
                <div class="content"><a>Like</a></div>
            </div>
        </div>
        <div class="user-options">
            <div class="mains">
                <span><img src="./images/comment.png" alt=""></span>
                <div class="content"><a>Comment</a></div>
            </div>
        </div>
        <div class="user-options">
            <div class="mains">
                <span><img src="./images/postshare.png" alt=""></span>
                <div class="content"><a>Share</a></div>
            </div>
        </div>
    </div>
</div>
HTML;
}

// Output posts
while ($p = $res->fetch_assoc()) {
    render_post($p, $username);
}
?>
