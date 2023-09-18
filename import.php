<?php
// Verbindungsdaten zur Datenbank
/*$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'shopseite';

function importproducts($dhandle)
{
    $i = 0;
    $file = fopen('csv.csv', 'r');
    while ($data = fgetcsv($file, 500, ';')) {
        $produktname = $data[0];
        $preis = $data[1];
        $lager = $data[2];
        $lieferzeit = $data[3];
        $kategorie = $data[4];
        $dateiname = $data[5];
        if ($i >= 1) {
            $checksql = "SELECT * FROM Produkte WHERE produkt='$data[0]'";
            $checkres = $dhandle->query($checksql);
            if ($checkres->num_rows > 0) {
                echo "<script>console.warn('ACHTUNG: DATENSATZ VORHANDEN')</script>";
            } else {
                
                $sql = "INSERT INTO produkte (produkt, preis, lager, lieferzeit, kategorie, dateiname) VALUES ('$produktname','$preis','$lager','$lieferzeit','$dateiname')";
                dbaction($dhandle, $sql);
            }
        } else {
            $i++;
        }
    }
    $katid = "SELECT id from kategorien WHERE kategorie = '$kategorie'";
    fclose($file);
    if ($dhandle->query($katid) === TRUE) {
        echo "QUERY: ERFOLG! <br>";
    } else {
        echo "QUERY: FEHLER( " . $dhandle->error . ")<br>";
    }
    
}

function importcategories($dhandle)
{
    $i = 0;
    $file = fopen('csv.csv', 'r');
    while ($data = fgetcsv($file, 500, ';')) {

        if ($i >= 1) {
            $checksql = "SELECT * FROM kategorien WHERE kategorie='$data[4]'";
            $checkres = $dhandle->query($checksql);
            if ($checkres->num_rows > 0) {
                echo "<script>console.warn('ACHTUNG: KATEGORIE VORHANDEN')</script>";
                importproducts($dhandle);
            } else {
                $sql = "INSERT INTO kategorien (kategorie) VALUES ('$data[4]')";
                dbaction($dhandle, $sql);
            }
        } else {
            $i++;
        }
    }
    fclose($file);
}
*/
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

?>