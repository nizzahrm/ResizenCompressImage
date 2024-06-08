<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: signIn.html");
    exit;
}

include 'connect.php';

// Ambil data gambar dari database
$sql = "SELECT photo FROM upload WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

$images = [];
while ($row = $result->fetch_assoc()) {
    $images[] = base64_encode($row['photo']);
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My First Website</title>
    <link rel="stylesheet" href="gambar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="banner">
    <div class="navbar">
        <img src="ResizenCompress/remage.png" class="logo">
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
    <main>
        <?php if (count($images) > 0) : ?>
            <?php foreach ($images as $image) : ?>
                <div class="image-container">
                    <img src="data:image/jpeg;base64,<?= $image ?>" alt="Uploaded Image">
                </div>
            <?php endforeach; ?>
        <?php else : ?>
        <?php endif; ?>
    </main>
</body>

</html>