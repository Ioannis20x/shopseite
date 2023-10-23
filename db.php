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


function prodaction($sql)
{
    global $dbhandle;
    if ($sql) {
        $result = $dbhandle->query($sql);

        if ($result && $result->num_rows > 0) {
            echo "true";
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            echo "false";
            return array();
        }
    }
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
