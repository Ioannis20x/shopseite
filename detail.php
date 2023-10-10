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
                echo "<div id='oben'>
            <div id='backbutton'>
            <a href='./index.php'>&#706; zurück</a>
            </div>";
                echo '<div id="prodbild">
                    <img src="./alle_produkte/' . $row["dateiname"] . '" alt="">
                </div>';

                echo '<div id="details">
                <h1 id="prodname">' . $row["produkt"] . '</h1>';

                echo ' <div id="preis">
                            <h2>Preis</h2>
                            <h1>' . $row["preis"] . '</h1>
                    </div>';

                echo '<div id="versand">
                     <h2>Versand</h2>
                    <h1>Lieferung in ' . $row["lieferzeit"] . ' Tagen</h1>
                 </div>';

                echo '<div id="lager">
                    <h2>Lagerbestand</h2>';
                if ($row["lager"] == 0) {
                    echo "<h1>AUSVERKAUFT</h1>";
                } else {
                    echo '<h1>'.$row["lager"] . ' auf Lager </h1>.
                </div>';
                }

                echo '<form action="./kauf.html">
                         <button id="kaufbutton" type="submit">Kaufen</button>
                 </form>
                </div>
            </div> ';
            }
        }
    } else {
        echo "Fehler:";
    }
    ?>
</body>

</html>