<?php
include 'db_connect.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $nic = $_POST['nic'];
    $email = $_POST['email'];
    $district = $_POST['district'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $role = $_POST['role'];
    if ($password !== $repassword) {
        die("Passwords do not match. Please go back and try again. <a href='register.html'>Click here to try again</a>");
    }
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (name, nic, email, district, password, role) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissss", $name, $nic, $email, $district, $hashedPassword, $role);

    if ($stmt->execute()) {
        header('Location: login.html');
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
