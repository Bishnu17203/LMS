<?php
session_start();
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Retrieve user data from the database based on the provided email
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password is correct, set session variables and redirect to the main page
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("Location: main.php");
            exit();
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "Invalid email!";
    }
}

$conn->close();
?>
