<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <h2 class="text-center">Add New Item</h2>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $image = $_FILES['image']['name'];
            $target = "uploads/" . basename($image);

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $sql = "INSERT INTO items (image, name, description) VALUES ('$image', '$name', '$description')";
                if ($conn->query($sql)) {
                    echo "<div class='alert alert-success'>Item added successfully</div>";
                } else {
                    echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Failed to upload image</div>";
            }
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" name="image" required>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Item</button>
            <a href="index.php" class="btn btn-secondary">Back</a>
        </form>
    </div>

</body>

</html>