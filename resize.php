<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: signIn.html");
    exit;
}

include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["photo-data"])) {
    $user_id = $_SESSION['user_id'];
    $photo_data = $_POST['photo-data'];
    $photo = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $photo_data));

    $sql = "INSERT INTO upload (user_id, photo) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $user_id, $photo);

    if ($stmt->execute()) {
        // Handle successful upload if needed
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PicPerfect</title>
    <link rel="icon" href="ResizenCompress/Frame 106.png" type="image/png">
    <link rel="stylesheet" href="filter.css">
</head>
<body class="banner">
    <div class="navbar">
        <img src="ResizenCompress/remage1.png" class="logo">
        <ul>
            <li><a href="main.php">Home</a></li>
            <li><a href="resize.php">Photo</a></li>
            <li><a href="gambar.php">History</a></li>
            <button onclick="window.location.href='profile.php'" class="profile-btn">
                <?php echo htmlspecialchars($_SESSION['email']); ?>
            </button>
            <button onclick="window.location.href='logout.php'">Logout</button>
        </ul>
    </div>
    <div class="webcam-container">
        <video id="video" autoplay></video>
        <canvas id="canvas"></canvas>
    <main>
        <div class="controls">
            <button id="start-btn" onclick="startWebcam()">Start Webcam</button>
            <button id="stop-btn" onclick="stopWebcam()">Stop Webcam</button>
            <button id="capture-btn" onclick="captureImage()">Capture</button>
            <select id="filter-select" onchange="applyFilter()">
                <option value="">No Filter</option>
                <option value="grayscale(100%)">Grayscale</option>
                <option value="sepia(100%)">Sepia</option>
                <option value="invert(100%)">Negate (Invert)</option>
                <option value="blur(5px)">Blur</option>
            </select>
        
    </div>
    <div class="controls">
    <form id="upload-form" method="post" action="resize.php">
        <input type="hidden" id="photo-data" name="photo-data">
        <button type="submit" id="upload-btn">Upload</button>
    </form>
    <a id="download-link" class="button" download="webcam_photo.png"><button>Download</button></a>
    </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="resize.js"></script>
    </main> 
</body>
</html>
