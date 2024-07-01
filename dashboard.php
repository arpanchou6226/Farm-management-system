<?php
session_start();
if (!isset($_SESSION['farmer_id'])) {
    header("Location: login.php");
    exit();
}

include('includes/db.php');

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_crop'])) {
        $crop_name = $_POST['crop_name'];
        $planting_date = $_POST['planting_date'];
        $harvest_date = $_POST['harvest_date'];
        $farmer_id = $_SESSION['farmer_id'];

        $sql = "INSERT INTO crops (farmer_id, crop_name, planting_date, harvest_date) VALUES ('$farmer_id', '$crop_name', '$planting_date', '$harvest_date')";
        if ($conn->query($sql) === TRUE) {
            echo "New crop added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['add_animal'])) {
        $animal_type = $_POST['animal_type'];
        $count = $_POST['count'];
        $farmer_id = $_SESSION['farmer_id'];

        $sql = "INSERT INTO animals (farmer_id, animal_type, count) VALUES ('$farmer_id', '$animal_type', '$count')";
        if ($conn->query($sql) === TRUE) {
            echo "New animal added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

include('includes/header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Welcome to your Dashboard</h2>
    <p>Manage your crops and animals here.</p>

    <!-- Crop Management Form -->
    <h3>Add New Crop</h3>
    <form action="dashboard.php" method="POST">
        <div class="form-group">
            <label for="crop_name">Crop Name:</label>
            <input type="text" class="form-control" id="crop_name" name="crop_name" required>
        </div>
        <div class="form-group">
            <label for="planting_date">Planting Date:</label>
            <input type="date" class="form-control" id="planting_date" name="planting_date" required>
        </div>
        <div class="form-group">
            <label for="harvest_date">Harvest Date:</label>
            <input type="date" class="form-control" id="harvest_date" name="harvest_date" required>
        </div>
        <button type="submit" name="add_crop" class="btn btn-primary">Add Crop</button>
    </form>

    <!-- Animal Management Form -->
    <h3 class="mt-5">Add New Animal</h3>
    <form action="dashboard.php" method="POST">
        <div class="form-group">
            <label for="animal_type">Animal Type:</label>
            <input type="text" class="form-control" id="animal_type" name="animal_type" required>
        </div>
        <div class="form-group">
            <label for="count">Count:</label>
            <input type="number" class="form-control" id="count" name="count" required>
        </div>
        <button type="submit" name="add_animal" class="btn btn-primary">Add Animal</button>
    </form>
</div>

<?php include('includes/footer.php'); ?>
</body>
</html>
