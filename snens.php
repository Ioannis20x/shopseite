<?php
require_once "db.php";


// CSV-Datei einlesen + Daten importieren
if (($handle = fopen("csv.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        $produkt = $data[0];
        $preis = $data[1];
        $lager = $data[2];
        $lieferzeit = $data[3];
        $kategorie = $data[4];
        $dateiname = $data[5];
        
        // Überprüfen, ob die Kategorie bereits existent
        $katid = 0;
        $katquery = "SELECT id FROM kategorien WHERE kategorie = '$kategorie'";
        $katres = $dbhandle->query($katquery);
        if ($katres !== false &&  $katres->num_rows > 0) {
            $row = $katres->fetch_assoc();
            $katid = $row["id"];
        } else {
            // Kategorie anlegen, wenn  nicht existent
            $insert_katquery = "INSERT INTO kategorien (kategorie) VALUES ('$kategorie')";
            $dbhandle->query($insert_katquery);
            $katid = $dbhandle->insert_id;
        }
        
        // Produkt in die Datenbank einfügen
        $prodquery = "INSERT INTO produkte (produkt, preis, lager, lieferzeit, kategorie, dateiname) 
            VALUES ('$produkt', '$preis', $lager, $lieferzeit, '$kategorie','$dateiname')";
        $dbhandle->query($prodquery);
        
        // Verknüpfung zwischen Produkt und Kategorie 
        $prodkatquery = "INSERT INTO mapping (produktid, kategorieid) 
            VALUES (" . $dbhandle->insert_id . ", $katid)";
        $dbhandle->query($prodkatquery);
    }
    fclose($handle);
}

$dbhandle->close();
?>
