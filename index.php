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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <div id="filter">
        <div id="suche">
            <form method="GET" id="filter-form">

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
                include_once "suche.php";
                $filter = array();

                $sql = "SELECT * FROM kategorien";
                $result = $dbhandle->query($sql);
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<label><input type='checkbox' name='geraet' value='" . $row['kategorie'] . "'/>" . $row['kategorie'] . "</label>";
                    }
                }

                ?>
            </div>
        </div>
        <h2 id="h2price">Preis</h2>
        <div id="pricefilter">
            <select name="prices" id="prices" onchange="this.form.submit()">
                <option value="" selected>Preisspanne wählen...</option>
                <option value="0-100">0€ - 100€</option>
                <option value="100-500">100€ - 500€</option>
                <option value="500-1000">500€ - 1000€</option>
                <option value="100-2000">100€ - 2000€</option>
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


        if (isset($_GET['suchbegriff'])) {
            $filters['suchbegriff'] = $_GET['suchbegriff'];
        }

        if (isset($_GET['geraet'])) {
            $filters['kategorien'] = $_GET['geraet'];
        }

        if (isset($_GET['prices'])) {
            $filters['prices'] = $_GET['prices'];
        }

        $sql = buildprodquery($filter);

        $produkte = prodaction($sql);

        foreach ($produkte as $produkt) {
            $preis = number_format($produkt["preis"], 2, ',', '.');
            echo '<a href="detail.php?prodid=' . $produkt["id"] . '">';
            echo "<div class='grid-item'>";
            echo "<h1 class='prodname'>";
            echo $produkt["produkt"];
            echo "</h1>";
            echo "<h2 class='price'>$preis €</h2>";
            if ($produkt["lager"] == 0) {
                echo "<h1 id='soldindex' class='sold'>AUSVERKAUFT</h1>";
                echo '<img class="grau" src="' . './alle_produkte/' . $produkt["dateiname"] . '">';
            } else {
                echo '<img draggable="false" src="' . './alle_produkte/' . $produkt["dateiname"] . '">';
            }
            echo "</div>";
            echo "</a>";
        }
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
        } else if(!isset($_GET["prices"]) || !isset($_GET["suchbegriff"]) ){

        }else{
            header("Location: ./index.php?page=1");
        }
        /*


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
                    echo '<a href="detail.php?prodid=' . $row["id"] . '">';
                    echo "<div class='grid-item'>";
                    echo "<h1 class='prodname'>";
                    echo $row["produkt"];
                    echo "</h1>";
                    echo "<h2 class='price'>$preis €</h2>";
                    if ($row["lager"] == 0) {
                        echo "<h1 id='soldindex' class='sold'>AUSVERKAUFT</h1>";
                        echo '<img class="grau" src="' . './alle_produkte/' . $row["dateiname"] . '">';
                    } else {
                        echo '<img draggable="false" src="' . './alle_produkte/' . $row["dateiname"] . '">';
                    }
                    echo "</div>";
                    echo "</a>";
                }
            } else {
                echo "Keine Daten gefunden.";
            }
        }
        */
        ?>
    </div>

    <div id="seiten">
        <a href="http://localhost/shop/?page=1"><button class="pagebtn">1</button></a>
        <a href="http://localhost/shop/?page=2"><button class="pagebtn">2</button></a>
        <a href="http://localhost/shop/?page=3"><button class="pagebtn">3</button></a>
        <a href="http://localhost/shop/?page=4"><button class="pagebtn">4</button></a>
    </div>

    <script>
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        var product = document.getElementsByClassName("grid-item");
        product.onclick = () => {
            localstorage.setItem("page", urlParams.get("page"));
        }
    </script>
</body>

</html>