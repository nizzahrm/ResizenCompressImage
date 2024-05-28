<?php
session_start();
include("connect.php");

?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Resizer Javascript</title>
    <link rel="stylesheet" href="resize.css">
    <script src="resize.js" defer></script>
</head>
<body>
    <div class="wrapper">
        <div class="upload-box">
            <input type="file" accept="image/*" hidden>
            <img id="preview-img" style="display: none;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                <path d="M.5 9.9a.5.5 0 0 1 .5.5v4.1a.5.5 0 0 0 .5.5h12a.5.5 0 0 0 .5-.5V10.4a.5.5 0 0 1 1 0v4.1a1.5 1.5 0 0 1-1.5 1.5h-12A1.5 1.5 0 0 1 0 14.5V10.4a.5.5 0 0 1 .5-.5zm7.646-5.854a.5.5 0 0 1 .708 0l3 3a.5.5 0 1 1-.708.708L8.5 5.207V14.5a.5.5 0 0 1-1 0V5.207L5.854 7.754a.5.5 0 0 1-.708-.708l3-3z"/>
            </svg>
            <input type="file" id="file-input" style="display: none;">
            <p>Browse File to Upload</p>
        </div>
        <div class="content">
            <div class="row sizes">
                <div class="column width">
                    <label>Width</label>
                    <input type="number">
                </div>
                <div class="column height">
                    <label>Height</label>
                    <input type="number">
                </div>
            </div>
            <div class="row checkboxes">
                <div class="column ratio">
                    <input type="checkbox" id="ratio" checked>
                    <label for="ratio">Lock aspect ratio</label>
                </div>
                <div class="column quality">
                    <input type="checkbox" id="quality">
                    <label for="quality">Reduce quality</label>
                </div>
            </div>
            <button class="download-btn">Download Image</button>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
