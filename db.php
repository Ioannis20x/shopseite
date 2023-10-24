<?php
$servername = "localhost";
$dbuser = "root";
$dbpas = "";
$dbname = "shopseite";

$dbhandle = new mysqli($servername, $dbuser, $dbpas, $dbname);

if ($dbhandle->connect_error) {
    die("Verbindung fehlgeschlagen: " . $dbhandle->connect_error);
} else {

    // echo "VERBINDUNG: ERFOLG! <br>";
}

function dbaction($handle, $query)
{
    if ($handle->connect_error) {
        die("Verbindung fehlgeschlagen: " . $handle->connect_error);
    } else {

        if ($handle->query($query) === TRUE) {
            echo "QUERY: ERFOLG! <br>";
        } else {
            echo "QUERY: FEHLER( " . $handle->error . ")<br>";
        }
    }
}

function prodaction($sql) {
    global $dbhandle; // Hinzugefügt, um auf die globale Datenbankverbindung zuzugreifen

    $result = $dbhandle->query($sql);

    $produkte = array();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $produkte[] = $row;
        }
    }

    return $produkte;
}

function getCategoriesFromMapping() {
    global $dbhandle;

    $categories = array();
    $sql = "SELECT DISTINCT kategorie FROM mapping";
    $result = $dbhandle->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
    }

    return $categories;
}


function getprods()
{
    global $dbhandle;

    $sql = "SELECT * FROM produkte LIMIT 6 OFFSET 1";
    $result = $dbhandle->query($sql);

    if ($result && $result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return array();
    }
}

function getprodsbycat($category, $limit, $offset)
{
    global $dbhandle;

    $sql = "SELECT * FROM produkte WHERE kategorie = '$category' LIMIT $limit OFFSET $offset";
    $result = $dbhandle->query($sql);

    if ($result && $result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return array();
    }
}
