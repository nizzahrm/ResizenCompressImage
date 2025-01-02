<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Mengenkripsi kata sandi dengan md5

    $sql = "SELECT * FROM loginuser WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        header("Location: main.php");
        exit();
    } else {
        echo "Invalid username or password.";
    }

    mysqli_close($conn);
}
?>
