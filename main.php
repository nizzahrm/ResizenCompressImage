<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: signUp.html");
    exit;
}

include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PicPerfect</title>
    <link rel="stylesheet" href="landingpage.css">
</head>
<body>
    <div class="banner">
        <div class="navbar">
            <img src="ResizenCompress/remage.png" class="logo">
            <ul>
            <ul>
                <li><a href="main.php">Home</a></li>
                <li><a href="resize.php">Resize</a></li>
                <li><a href="gambar.php">History</a></li>
                <button onclick="window.location.href='profile.php'" class="profile-btn">
                <?php echo htmlspecialchars($_SESSION['email']); ?>
                </button>
                <button onclick="window.location.href='logout.php'">Logout</button>
            </ul>

        </div>
        <div class="content">
            <h1>Take Your Photo</h1>
            <p>Use stunning filters to transform your photos into high-quality works of art in an instant</p> 
        </div>
    </div>
</body>
</html>