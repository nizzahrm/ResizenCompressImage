<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: signIn.html");
    exit;
}

include 'connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Delete the image from the database
    $sql = "DELETE FROM upload WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id, $_SESSION['user_id']);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: gambar.php");
        exit;
    } else {
        echo "Image not found or you don't have permission to delete this image.";
    }

    $stmt->close();
}
$conn->close();
?>
