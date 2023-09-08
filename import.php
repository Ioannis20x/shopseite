<?php
// Verbindungsdaten zur Datenbank
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'shopseite';

function importproducts($dhandle)
{
    $i = 0;
    $file = fopen('csv.csv', 'r');
    while ($data = fgetcsv($file, 500, ';')) {

        if ($i >= 1) {
            $checksql = "SELECT * FROM Produkte WHERE produkt='$data[0]'";
            $checkres = $dhandle->query($checksql);
            if ($checkres->num_rows > 0) {
                echo "ACHTUNG: DATENSATZ VORHANDEN<br>";
            } else {
                $sql = "INSERT INTO produkte (produkt, preis, lager, lieferzeit, kategorie, dateiname, seite) VALUES ('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]')";
                dbaction($dhandle, $sql);
            }
        } else {
            $i++;
        }
    }
    fclose($file);
}
