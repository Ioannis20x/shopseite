<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shopseite</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div id="filter">
        <div id="suche">
            <form action="" method="GET" action="suche.php">
                <input type="search" name="suchbegriff" id="suchleiste" placeholder="Suchen...">
                <button type="submit">
                    <span class="material-symbols-outlined">search</span>
                </button>
            </form>
        </div>
        <h2 id="h2kat">Kategorien</h2>

        <div id="checkboxen">

            <div class="kategorie">
                <input type="checkbox" name="handys" id="handycb" class="checkbox">
            </div>

            <div class="kategorie">
                <input type="checkbox" name="handys" id="huaweicb" class="checkbox">

            </div>
            <div class="kategorie">
                <input type="checkbox" name="handys" id="laptopcb" class="checkbox">
            </div>
            <div class="kategorie">
                <input type="checkbox" name="handys" id="monitorcb" class="checkbox">
            </div>
            <div class="kategorie">
                <input type="checkbox" name="handys" id="sonstcb" class="checkbox">
            </div>
        </div>
        <div id="kategorien">
            <label for="handycb" id="firstlabel">Handys</label>
            <label for="huaweicb">Huawei</label>
            <label for="laptopcb">Laptops</label>
            <label for="monitorcb">Monitore</label>
            <label for="sonstcb">Sonstiges</label>
        </div>
        <h2 id="h2price">Preisspanne</h2>
        <div id="pricefilter">
            <form action="" method="post">
                <select name="prices" id="prices">
                    <option value="default" selected>Preisspanne wählen...</option>
                    <option value="100" value="Select * From produkte Where preis > 0 and preis > 100">0€ - 100€</option>
                    <option value="500">100€ - 500€</option>
                    <option value="1000">500€ - 1000€</option>
                    <option value="2000">100€ - 2000€</option>
                </select>
                <input type="submit" value="Preisspanne wählen...">
            </form>

        </div>
    </div>

    <div class="grid-container">
        <?php
        include "db.php";
        include_once "import.php";
        include_once "suche.php";

        // Verbindungsdaten zur Datenbank
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'shopseite';


        if (isset($_GET["page"])) {
            $offset = (6 * $_GET["page"]) - 6;
            if ($_GET["page"] > 1) {
                $sql = "SELECT * FROM produkte LIMIT 6 OFFSET " . $offset;
                $result = $dbhandle->query($sql);
                //echo $offset;
            } else {
                //echo $offset;
                $sql = "SELECT * FROM produkte LIMIT 6 OFFSET 0";
                $result = $dbhandle->query($sql);
            }
        } else {
            //echo $offset;
            $sql = "SELECT * FROM produkte LIMIT 6 OFFSET 0";
            $result = $dbhandle->query($sql);
        }


        if (isset($_GET["kategorie"])) {
            $sql = "SELECT * FROM produkte WHERE id =1";
            $result = $dbhandle->query($sql);
            $kat = mysqli_fetch_assoc($result);
            print_r($kat);
        }


        if (!isset($_GET["suchbegriff"])) {
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
            } else {
                echo "Keine Daten gefunden.";
            }
        }

        ?>
    </div>  f

    <div id="seiten">
        <a href="http://localhost/shop/?page=1"><button class="pagebtn">1</button></a>
        <a href="http://localhost/shop/?page=2"><button class="pagebtn">2</button></a>
        <a href="http://localhost/shop/?page=3"><button class="pagebtn">3</button></a>
        <a href="http://localhost/shop/?page=4"><button class="pagebtn">4</button></a>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var handycb = document.getElementById("handycb");
            var huaweicb = document.getElementById("huaweicb");
            var laptopcb = document.getElementById("laptopcb");
            var monitorcb = document.getElementById("monitorcb");
            var sonstcb = document.getElementById("sonstcb");
            window.onload = () => {
                // Überprüfen, ob die Checkboxen im sessionStorage gespeichert sind und den Haken entsprechend setzen
                if (sessionStorage.getItem("handycb") === "true") {
                    handycb.checked = true;
                }
                if (sessionStorage.getItem("huaweicb") === "true") {
                    huaweicb.checked = true;
                }
                if (sessionStorage.getItem("laptopcb") === "true") {
                    laptopcb.checked = true;
                }
                if (sessionStorage.getItem("monitorcb") === "true") {
                    monitorcb.checked = true;
                }
                if (sessionStorage.getItem("sonstcb") === "true") {
                    sonstcb.checked = true;
                }
            }

            var link = "http://localhost/shop"

            function uncheckall() {
                handycb.checked = false;
                sessionStorage.setItem("handycb", false);
                huaweicb.checked = false;
                sessionStorage.setItem("huaweicb", false);
                laptopcb.checked = false;
                sessionStorage.setItem("laptopcb", false);
                monitorcb.checked = false;
                sessionStorage.setItem("monitorcb", false);
                sonstcb.checked = false;
                sessionStorage.setItem("sonstcb", false);
                window.location.replace("http://localhost/shop");
            }
            // HANDY
            handycb.addEventListener("change", function() {
                sessionStorage.setItem("handycb", handycb.checked);
                if (handycb.checked) {
                    window.location.replace(link + "?kategorie=handys");
                } else {
                    uncheckall();
                    
                }
            });

            // HUAWEI
            huaweicb.addEventListener("change", function() {
                sessionStorage.setItem("huaweicb", huaweicb.checked);
                if (huaweicb.checked) {
                    window.location.replace(link + "?kategorie=huawei");
                } else {
                    window.location.replace("http://localhost/shop");
                }
            });

            // LAPTOP
            laptopcb.addEventListener("change", function() {
                sessionStorage.setItem("laptopcb", laptopcb.checked);
                if (laptopcb.checked) {
                    window.location.replace(link + "?kategorie=laptop");
                } else {
                    window.location.replace("http://localhost/shop");
                }
            });

            // MONITOR
            monitorcb.addEventListener("change", function() {
                sessionStorage.setItem("monitorcb", monitorcb.checked);
                if (monitorcb.checked) {
                    window.location.replace(link + "?kategorie=monitor");
                } else {
                    window.location.replace("http://localhost/shop");
                }
            });

            // SONST
            sonstcb.addEventListener("change", function() {
                sessionStorage.setItem("sonstcb", sonstcb.checked);
                if (sonstcb.checked) {
                    window.location.replace(link + "?kategorie=sonstiges");
                } else {
                    window.location.replace("http://localhost/shop");
                }
            });
        });
    </script>

</body>

</html>