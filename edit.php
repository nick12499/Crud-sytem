<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <h2 class="text-center">Edit Item</h2>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM items WHERE id = $id";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $image = $_FILES['image']['name'];
            $target = "uploads/" . basename($image);

            if ($image) {
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
                $sql = "UPDATE items SET image = '$image', name = '$name', description = '$description' WHERE id = $id";
            } else {
                $sql = "UPDATE items SET name = '$name', description = '$description' WHERE id = $id";
            }

            if ($conn->query($sql)) {
                echo "<div class='alert alert-success'>Item updated successfully</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
            }
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" name="image">
                <img src="uploads/<?php echo $row['image']; ?>" width="100" class="mt-2">
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" rows="4" required><?php echo $row['description']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Item</button>
            <a href="index.php" class="btn btn-secondary">Back</a>
        </form>
    </div>

</body>

</html>