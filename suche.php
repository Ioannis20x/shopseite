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
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $preis = number_format($row["preis"], 2, ',', '.');
            echo "<div class='grid-item'>";
            echo "<h1 class='prodname'>";
            echo $row["produkt"];
            echo "</h1>";
            echo "<h2 class='price'>$preis €</h2>";
            if ($row["lager"] == 0) {
                echo "<h1 id='sold'>AUSVERKAUFT</h1>";
                echo '<img class="grau" src="' . './alle_produkte/' . $row["dateiname"] . '">';
            } else {
                echo '<img draggable="false" src="' . './alle_produkte/' . $row["dateiname"] . '">';
            }
            echo "</div>";
        }
    }else{
        echo "<b>Es wurden keine Produkte gefunden, welche ihrer Suchanfrage entsprechen.</b>";
    }
}
