<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: signIn.html");
    exit;
}

include 'connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch the image from the database
    $sql = "SELECT photo FROM upload WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id, $_SESSION['user_id']);
    $stmt->execute();
    $stmt->bind_result($photo);
    $stmt->fetch();

    if ($photo) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="downloaded_image.jpg"');
        header('Content-Transfer-Encoding: binary');
        echo $photo;
    } else {
        echo "Image not found or you don't have permission to download this image.";
    }

    $stmt->close();
}
$conn->close();
?>
