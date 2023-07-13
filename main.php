<?php
session_start();
require 'db_connect.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Retrieve library information from the database
$sql = "SELECT COUNT(*) AS total_books, COUNT(DISTINCT type) AS total_types, COUNT(DISTINCT author) AS total_authors, COUNT(DISTINCT genre) AS total_genres FROM books";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $totalBooks = $row['total_books'];
    $totalTypes = $row['total_types'];
    $totalAuthors = $row['total_authors'];
    $totalGenres = $row['total_genres'];
} else {
    // Handle error if library information cannot be retrieved
    // You can display an error message or take any other appropriate action
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Main Page</title>
</head>
<body>
  <h1>Welcome to the Library Management Page, <?php echo $_SESSION['username']; ?></h1>
  
  <p>Total Number of Books: <?php echo $totalBooks; ?></p>
  <p>Total Number of Book Types: <?php echo $totalTypes; ?></p>
  <p>Total Number of Authors: <?php echo $totalAuthors; ?></p>
  <p>Total Number of Genres: <?php echo $totalGenres; ?></p>
  
  <!-- Additional library information can be displayed here -->

  <a href="logout.php">Logout</a> <!-- Add a logout link or button -->
</body>
</html>
