<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="./css/style.css">
    <title>Detailseite</title>
</head>

<body>
    <div id='oben'>
        <div id='backbutton'>
            <a id="back" href="./index.php?page=1" >&#706; zurück</a>
        </div>
        <?php
        include_once "db.php";

        if (isset($_GET["prodid"])) {
            $prodid = $_GET['prodid'];

            $sql = "SELECT * FROM produkte WHERE id = " . $prodid . " LIMIT 5";

            $result = $dbhandle->query($sql);
            if (!$result) {
                die('SQL-Fehler: ' . mysqli_error($dbhandle));
            }
            if ($result && $result->num_rows == 1) {
                while ($row = $result->fetch_assoc()) {
                    $produktname = $row["produkt"];
                    $preis = number_format($row["preis"], 2, ',', '.');
                    echo '<div id="prodbild">';
                    if($row["lager"] == 0){
                        echo '<img class="grau" src="./alle_produkte/' . $row["dateiname"] . '" alt="">';
                    }else{
                        echo '<img src="./alle_produkte/' . $row["dateiname"] . '" alt="">';
                    }
                    
                    echo '</div>';

                    echo '<div id="details">
                        <h1 id="prodname">' . $row["produkt"] . '</h1>';

                    echo ' <div id="preis">
                                <h2>Preis</h2>
                                <h1>' . $row["preis"] . '€</h1>
                        </div>';

                    $heutigesDatum = new DateTime();
                    $zukuenftigesDatum = clone $heutigesDatum;
                    $lz = (int)$row["lieferzeit"];
                    $zukuenftigesDatum->modify("+$lz days");


                    // Deutsche Wochentage und Monate
                    $deutscheWochentage = [
                        'Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'
                    ];

                    $deutscheMonate = [
                        '', 'Januar', 'Februar', 'März', 'April', 'Mai', 'Juni',
                        'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'
                    ];

                    // Das zukünftige Datum im deutschen Format anzeigen
                    $lieferzeit = $deutscheWochentage[$zukuenftigesDatum->format('w')] . ', ' . $zukuenftigesDatum->format('j') . '. ' . $deutscheMonate[(int)$zukuenftigesDatum->format('n')];
                    echo '<div id="versand">
                         <h2>Versand</h2>
                         
                        <h1>Lieferung bis ' . $lieferzeit . '</h1>
                    </div>';

                    echo '<div id="lager">
                        <h2>Lagerbestand</h2>';
                    if ($row["lager"] == 0) {
                        echo '<h1 class="sold">AUSVERKAUFT</h1>';
                        echo '</div>';
                    } else {
                        echo '<h1>' . $row["lager"] . ' Stück auf Lager </h1>.';
                        echo '</div>';
                    }
                    echo '<form action="./kauf.html">
                         <button id="kaufbutton" type="submit">Kaufen</button>
                    </form>
                </div>
            </div>';
                }
            }

            $produktid = $_GET["prodid"];
            $sql1 = "SELECT * FROM mapping WHERE produktid = $produktid LIMIT 6";
            $ergebnis1 = $dbhandle->query($sql1);

            if ($ergebnis1) {
                $row = $ergebnis1->fetch_assoc();
                $kategorieid = $row['kategorieid'];

                $sql2 = "SELECT * FROM produkte
                     JOIN mapping ON produkte.id = mapping.produktid
                     WHERE mapping.kategorieid = $kategorieid AND produkte.id <> $produktid
                     LIMIT 5";
                $ergebnis2 = $dbhandle->query($sql2);

                if ($ergebnis2 && $ergebnis2->num_rows > 0) {

                    echo '<div id="unten">';
                    echo '<h1 id="vortit">Ähnliche Produkte</h1>';
                    echo '<div id="vorschl">';
                    while ($row = $ergebnis2->fetch_assoc()) {
                        echo '<a href=./detail.php?prodid=' . $row["produktid"] . '>';
                        echo '<div class="vprod">
                            <div class="vprodinfo">';
                        echo '<h1>' . $row["produkt"] . '</h1>';
                        echo '<h2>' . $row["preis"] . '€</h1>';
                        echo "</div>";
                        if($row["lager"] == 0){
                            echo '<img class="grau" src="./alle_produkte/' . $row["dateiname"] . '">';
                        }else{
                            echo '<img src="./alle_produkte/' . $row["dateiname"] . '">';
                        }
                        
                        echo "</div>";
                        echo "</a>";
                    }
                    echo "</div>";

                    echo "</div>";
                } else {
                    $sql3 = "SELECT * FROM produkte WHERE produkt LIKE '%$produktname%' AND id <> $produktid LIMIT 5";
                    $ergebnis3 = $dbhandle->query($sql3);

                    if ($ergebnis3 && $ergebnis3->num_rows > 0) {
                        echo '<div id="unten">';
                        echo '<h1 id="vortit">Ähnliche Produkte</h1>';
                        echo '<div id="vorschl">';
                        while ($row = $ergebnis3->fetch_assoc()) {
                            echo '<div class="vprod">
                                <div class="vprodinfo">';
                            echo '<h1>' . $row["produkt"] . '</h1>';
                            echo '<h2>' . $row["preis"] . '€</h1>';
                            echo "</div>";
                            if($row["lager"] == 0){
                            echo '<img class="grau" src="./alle_produkte/' . $row["dateiname"] . '">';
                            }
                            else{
                                echo '<img src="./alle_produkte/' . $row["dateiname"] . '">';
                            }
                            echo "</div>";
                        }
                        echo "</div>";
                        echo "</div>";
                    } else {
                        echo "Keine weiteren Produkte gefunden";
                    }
                }
            } else {
                echo "Fehler bei der Abfrage: " . $dbhandle->error;
            }
        } else {
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
        ?>
    </div>
</body>
<script>
    const back = document.getElementById("back");
    back.onclick = () => {
        let page = localStorage.get("page");
        window.location = "./index.php?page=" + page;
    }
</script>

</html>