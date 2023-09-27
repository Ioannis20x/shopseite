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

        </div>
        <h2 id="h2kat">Kategorien</h2>

        <div id="checkboxen">
            <div id="kategorien">
                <?php
                include_once "db.php";
                $sql = "SELECT * FROM Kategorien";
                $result = $dbhandle->query($sql);
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<label><input type='checkbox' name='geraet' value='" . $row['kategorie'] . "'/>" . $row['kategorie'] . "</label>";
                    }
                }
                
                ?>
            </div>
        </div>
        <h2 id="h2price">Preisspanne</h2>
        <div id="pricefilter">

            <select name="prices" id="prices" onchange="this.form.submit()">
                <option value="" selected>Preisspanne wählen...</option>
                <option value="100" value="Select * From produkte Where preis > 0 and preis > 100">0€ - 100€</option>
                <option value="500">100€ - 500€</option>
                <option value="1000">500€ - 1000€</option>
                <option value="2000">100€ - 2000€</option>
            </select>
        </div>
        </form>
    </div>

    <div class="grid-container">
        <?php
        include_once "db.php";
        include_once "import.php";
        include_once "suche.php";

        // Verbindungsdaten zur Datenbank
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'shopseite';


        if (isset($_GET["page"])) {
            $offset = (6 * $_GET["page"]) - 7;
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
    </div>

    <div id="seiten">
        <a href="http://localhost/shop/?page=1"><button class="pagebtn">1</button></a>
        <a href="http://localhost/shop/?page=2"><button class="pagebtn">2</button></a>
        <a href="http://localhost/shop/?page=3"><button class="pagebtn">3</button></a>
        <a href="http://localhost/shop/?page=4"><button class="pagebtn">4</button></a>
    </div>


    <!-- <script>
        // Alle Checkboxen auswählen
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        var handycb = document.getElementById("handycb");
        var huaweicb = document.getElementById("huaweicb");
        var laptopcb = document.getElementById("laptopcb");
        var monitorcb = document.getElementById("monitorcb");
        var sonstcb = document.getElementById("sonstcb");

        function uncheckall(kat) {
            switch (kat) {
                case 1:
                    huaweicb.disabled = true;
                    break;
                case 2:
                    localStorage.clear("handycb");
                    localStorage.clear("laptopcb");
                    localStorage.clear("monitorcb");
                    localStorage.clear("sonstcb");
                    break;
                case 3:
                    localStorage.clear("handycb");
                    localStorage.clear("huaweicb");
                    localStorage.clear("monitorcb");
                    localStorage.clear("sonstcb");
                    break;
                case 4:
                    localStorage.clear("handycb");
                    localStorage.clear("laptopcb");
                    localStorage.clear("huaweicb");
                    localStorage.clear("sonstcb");
                    break;
                case 5:
                    localStorage.clear("handycb");
                    localStorage.clear("laptopcb");
                    localStorage.clear("huaweicb");
                    localStorage.clear("monitorcb");
                    break;
            }
        }

        document.addEventListener("DOMContentLoaded", function() {


            // Überprüfen, ob die Checkboxen im localStorage gespeichert sind und den Haken entsprechend setzen
            if (localStorage.getItem("handycb") === "true") {
                handycb.checked = true;
            }
            if (localStorage.getItem("huaweicb") === "true") {
                huaweicb.checked = true;
            }
            if (localStorage.getItem("laptopcb") === "true") {
                laptopcb.checked = true;
            }
            if (localStorage.getItem("monitorcb") === "true") {
                monitorcb.checked = true;
            }
            if (localStorage.getItem("sonstcb") === "true") {
                sonstcb.checked = true;
            }

            // HANDY
            handycb.addEventListener("change", function() {
                localStorage.setItem("handycb", handycb.checked);
                if (handycb.checked) {
                    uncheckall(1);
                    window.location.replace(window.location.href + "?kategorie=handys");
                } else {
                    window.location.replace("http://localhost/shop")
                }
            });

            // HUAWEI
            huaweicb.addEventListener("change", function() {
                localStorage.setItem("huaweicb", huaweicb.checked);
                if (huaweicb.checked) {
                    uncheckall(1);
                    window.location.replace(window.location.href + "?kategorie=huawei");
                } else {
                    window.location.replace("http://localhost/shop")
                }
            });

            // LAPTOP
            laptopcb.addEventListener("change", function() {
                localStorage.setItem("laptopcb", laptopcb.checked);
                if (laptopcb.checked) {
                    window.location.replace(window.location.href + "?kategorie=laptop");
                } else {
                    window.location.replace("http://localhost/shop")
                }
            });

            // MONITOR
            monitorcb.addEventListener("change", function() {
                localStorage.setItem("monitorcb", monitorcb.checked);
                if (monitorcb.checked) {
                    window.location.replace(window.location.href + "?kategorie=monitor");
                } else {
                    window.location.replace("http://localhost/shop")
                }
            });

            // SONST
            sonstcb.addEventListener("change", function() {
                localStorage.setItem("sonstcb", sonstcb.checked);
                if (sonstcb.checked) {
                    window.location.replace(window.location.href + "?kategorie=sonstiges");
                } else {
                    window.location.replace("http://localhost/shop")
                }
            });
        });


        // Event-Listener für jede Checkbox hinzufügen
    </script> -->
</body>

</html>