<?php
require_once "db.php";

$conn = $dbhandle;


if (isset($_GET['suchbegriff'])) {
    $suchbegriff = $_GET['suchbegriff'];

    $sql = "SELECT * FROM produkte WHERE produkt LIKE '%$suchbegriff%'";
    $result = $conn->query($sql);
    if (!$result) {
        die('SQL-Fehler: ' . mysqli_error($conn));
    }
    while ($row = $result->fetch_assoc()) {
    }
}
