<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "db.php";

// Datenbankverbindung 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shopseite";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("FEHLER: " . $conn->connect_error);
}

// CSV-Datei einlesen und Daten importieren
if (($handle = fopen("csv.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        $produkt = $data[0];
        $preis = $data[1];
        $lager = $data[2];
        $lieferzeit = $data[3];
        $kategorie = $data[4];
        $dateiname = $data[5];

        // Produkt existent?
        $prodid = 0;
        $prodquery = "SELECT id FROM produkte WHERE produkt = '$produkt'";
        $prodres = $conn->query($prodquery);

        if ($prodres !== false && $prodres->num_rows > 0) {
            $row = $prodres->fetch_assoc();
            $prodid = $row["id"];
        } else {

            $preis = str_replace('.', '', $preis);
            $preis = str_replace(',', '.', $preis);
            $preis = (float)$preis;
            //$preis = number_format($preis, 2, ',', '.');
            // Produkt in DB einfügen
            $insprodquery = "INSERT INTO produkte (produkt, preis, lager, lieferzeit, dateiname) 
                VALUES ('$produkt', '$preis', $lager, $lieferzeit, '$dateiname')";
            $conn->query($insprodquery);
            $prodid = $conn->insert_id;
        }

        // Kategorie existent?
        $katid = 0;
        $katquery = "SELECT id FROM kategorien WHERE kategorie = '$kategorie'";
        $katres = $conn->query($katquery);


        if ($katres->num_rows > 0) {
            $row = $katres->fetch_assoc();
            $katid = $row["id"];
        } else {
            // Kategorie anlegen
            $inskat = "INSERT INTO kategorien (kategorie) VALUES ('$kategorie')";
            $conn->query($inskat);
            $katid = $conn->insert_id;
        }

        // Verknüpfung zwischen Produkt und Kategorie herstellen
        $checklinkq = "SELECT * FROM mapping WHERE produktid = '$prodid' AND kategorieid = '$katid'";
        $checklinkres = $conn->query($checklinkq);
        if (!$checklinkres) {
            die("Fehler in der Abfrage: " . $conn->error);
        }
        if ($checklinkres && $checklinkres->num_rows == 0) {
            $insprodkat = "INSERT INTO mapping (produktid, kategorieid) 
                VALUES ($prodid, $katid)";
            dbaction($conn, $insprodkat);
        }
    }
    fclose($handle);
} else {
    echo "Fehler beim Öffnen der CSV-Datei.";
}

$conn->close();
