<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./css/style.css">
    <title>Detailseite</title>
</head>

<body>
    <div id='oben'>
        <div id='backbutton'>
            <a href='./index.php'>&#706; zurück</a>
        </div>
        <?php

        include_once "db.php";

        if (isset($_GET["prodid"])) {
            $prodid = $_GET['prodid'];
            $sql = "SELECT * FROM produkte WHERE id = " . $prodid;

            $result = $dbhandle->query($sql);
            if (!$result) {
                die('SQL-Fehler: ' . mysqli_error($conn));
            }
            if ($result && $result->num_rows == 1) {
                while ($row = $result->fetch_assoc()) {
                    $preis = number_format($row["preis"], 2, ',', '.');
                    echo '<div id="prodbild">
                    <img src="./alle_produkte/' . $row["dateiname"] . '" alt="">
                </div>';

                    echo '<div id="details">
                <h1 id="prodname">' . $row["produkt"] . '</h1>';

                    echo ' <div id="preis">
                            <h2>Preis</h2>
                            <h1>' . $row["preis"] . '€</h1>
                    </div>';

                    echo '<div id="versand">
                     <h2>Versand</h2>
                    <h1>Lieferung in ' . $row["lieferzeit"] . ' Tagen</h1>
                 </div>';

                    echo '<div id="lager">
                    <h2>Lagerbestand</h2>';
                    if ($row["lager"] == 0) {
                        echo '<h1 class="sold">AUSVERKAUFT</h1>';
                    } else {
                        echo '<h1>' . $row["lager"] . ' auf Lager </h1>.';
                    }
                   echo '</div>';
                    echo '<form action="./kauf.html">
                         <button id="kaufbutton" type="submit">Kaufen</button>
                 </form>
                </div>
            </div>';
                }
            }

            $produktid = $_GET["prodid"];
            $sql1 = "SELECT * FROM mapping WHERE produktid = $produktid";
            $ergebnis1 = $dbhandle->query($sql1);

            if ($ergebnis1) {
                $row = $ergebnis1->fetch_assoc();
                $kategorieid = $row['kategorieid'];

                // Schritt 1: Versuche, genau 5 Produkte derselben Kategorie abzurufen
                $sql2 = "SELECT * FROM produkte
                     JOIN mapping ON produkte.id = mapping.produktid
                     WHERE mapping.kategorieid = $kategorieid AND produkte.id <> $produktid
                     LIMIT 6"; // Maximal 5 Produkte anzeigen
                $ergebnis2 = $dbhandle->query($sql2);

                if ($ergebnis2 && $ergebnis2->num_rows > 0) {
                    // Es gibt mindestens 1 Produkt derselben Kategorie (außer dem ausgewählten Produkt)
                    while ($row = $ergebnis2->fetch_assoc()) {
                        showalt($row, $ergebnis2);
                    }
                } /*else {

                    $sql3 = "SELECT * FROM produkte WHERE produkt LIKE '%$produktname%' AND id <> $produktid LIMIT 6"; // Maximal 5 Produkte anzeigen
                    $ergebnis3 = $dbhandle->query($sql3);

                    if ($ergebnis3 && $ergebnis3->num_rows > 0) {
                        // Es gibt ähnliche Produkte
                        while ($row = $ergebnis3->fetch_assoc()) {
                            showalt($row, $ergebnis3);
                        }
                    } else {
                        echo "Keine weiteren Produkte gefunden";
                    }
                }*/
            } else {
                echo "Fehler bei der Abfrage: " . $dbhandle->error;
            }
        } else {
            header('location: ./index.php');
        }




        function showalt($ro, $res)
        {
            echo '<div id="unten">';
            echo '<h1 id="vortit">Ähnliche Produkte</h1>';
            echo '<div id="vorschl">';
            while ($ro = $res->fetch_assoc()) {
                echo '<div class="vprod">
                    <div class="vprodinfo">';
                echo '<h1>' . $ro["produkt"] . '</h1>';
                echo '<h2>' . $ro["preis"] . '€</h1>';
                echo "</div>";
                echo '<img src="./alle_produkte/' . $ro["dateiname"] . '">';
                echo "</div>";
            }

            echo "</div>";
            echo "</div>";
        }
        ?>
</body>

</html>