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
    <title>Webcam with Filter</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto py-10">
        <h1 class="text-2xl font-bold mb-5">Webcam with Filter</h1>
        <div id="webcam-container" class="relative">
            <video id="video" class="w-full h-64" autoplay></video>
            <button id="start-btn" class="absolute top-0 left-0 mt-4 ml-4 px-4 py-2 bg-blue-500 text-white rounded" onclick="startWebcam()">Start Webcam</button>
            <button id="stop-btn" class="absolute top-0 left-0 mt-4 ml-4 px-4 py-2 bg-red-500 text-white rounded hidden" onclick="stopWebcam()">Stop Webcam</button>
            <button id="capture-btn" class="absolute bottom-0 left-0 mb-4 ml-4 px-4 py-2 bg-green-500 text-white rounded hidden" onclick="captureImage()">Capture</button>
            <select id="filter-select" class="absolute bottom-0 right-0 mb-4 mr-4 px-4 py-2 bg-white rounded hidden" onchange="applyFilter()">
                <option value="">No Filter</option>
                <option value="grayscale(100%)">Grayscale</option>
                <option value="sepia(100%)">Sepia</option>
                <option value="invert(100%)">Negate (Invert)</option>
                <option value="blur(5px)">Blur</option>
            </select>
        </div>
        <canvas id="canvas" class="hidden"></canvas>
        <form id="upload-form" method="post" action="resize.php" class="mt-5 hidden">
            <input type="hidden" id="photo-data" name="photo-data">
            <button type="submit" id="upload-btn" class="mt-3 bg-blue-500 text-white px-4 py-2 rounded hidden">Upload</button>
        </form>
        <a id="download-link" class="mt-3 bg-green-500 text-white px-4 py-2 rounded hidden" download="webcam_photo.png">Download</a>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="resize.js"></script>
</body>

</html>
