<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM items WHERE id = $id";

    if ($conn->query($sql)) {
        header("Location: index.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
