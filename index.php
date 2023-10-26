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

        <form method="GET" action="index.php" id="filter-form">
            <!-- Suchbegriff -->
            <div id="suche">

                <input type="search" name="suchbegriff" id="suchleiste" placeholder="Suchen...">
                <button type="submit">
                    <span class="material-symbols-outlined">search</span>
                </button>

            </div>
            <!-- Kategorien (mehrere Auswahlmöglichkeiten) -->
            <h2 id="h2kat">Kategorien</h2>
            <div id="checkboxen">
                <div id="kategorien">
                    <?php
                    include_once "db.php";
                    $selectedCategories = array();

                    if (isset($_GET['kategorie']) && is_array($_GET['kategorie'])) {
                        $selectedCategories = $_GET['kategorie'];
                    }

                    $sql = "SELECT kategorie FROM kategorien";
                    $result = $dbhandle->query($sql);
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $checkboxName = 'kategorie[]';
                            $isChecked = in_array($row['kategorie'], $selectedCategories) ? 'checked' : '';
                            echo "<label><input type='checkbox' onchange='this.form.submit()' name='$checkboxName' value='" . $row['kategorie'] . "' $isChecked />" . $row['kategorie'] . "</label>";
                        }
                    }
                    ?>
                </div>
            </div>

            <!-- Preisspannen -->
            <h2 id="h2price">Preis</h2>
            <div id="pricefilter">
                <select name="prices" id="prices" onchange="this.form.submit()">
                    <option value="0-3000" <?php echo isset($_GET['prices']) && $_GET['prices'] === '0-3000' ? 'selected' : ''; ?>>Preisspanne wählen...</option>
                    <option value="0-100" <?php echo isset($_GET['prices']) && $_GET['prices'] === '0-100' ? 'selected' : ''; ?>>0€ - 100€</option>
                    <option value="100-500" <?php echo isset($_GET['prices']) && $_GET['prices'] === '100-500' ? 'selected' : ''; ?>>100€ - 500€</option>
                    <option value="500-1000" <?php echo isset($_GET['prices']) && $_GET['prices'] === '500-1000' ? 'selected' : ''; ?>>500€ - 1000€</option>
                    <option value="1000-2000" <?php echo isset($_GET['prices']) && $_GET['prices'] === '1000-2000' ? 'selected' : ''; ?>>1000€ - 2000€</option>
                </select>

            </div>
        </form>

    </div>

    <div class="grid-container">
        <?php
        include_once "db.php";
        include_once "import.php";
        include_once "suche.php";

        $filters = array();

        if (isset($_GET['suchbegriff'])) {
            $filters['suchbegriff'] = $_GET['suchbegriff'];
        }

        if (isset($_GET['kategorie'])) {
            $filters['kategorie'] = $_GET['kategorie'];
        }

        if (isset($_GET['prices'])) {
            $filters['prices'] = $_GET['prices'];
        }

        if (!empty($filters)) {
            $sql = buildprodquery($filters);
        } else {
            // Wenn keine Filter aktiv sind, standardmäßig nur 6 Produkte pro Seite anzeigen
            $offset = (6 * $_GET["page"]) - 6;
            $sql = "SELECT * FROM produkte LIMIT 6 OFFSET " . $offset;
        }

        if (!isset($_GET["page"]) && empty($filters)) {
            header('Location: ./index.php?page=1');
        }

        $produkte = prodaction($sql);
        if (count($produkte) > 0) {

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
            echo " </div>";
            echo '    <div id="seiten">
            <a href="http://localhost/shop/?page=1"><button class="pagebtn">1</button></a>
            <a href="http://localhost/shop/?page=2"><button class="pagebtn">2</button></a>
            <a href="http://localhost/shop/?page=3"><button class="pagebtn">3</button></a>
            <a href="http://localhost/shop/?page=4"><button class="pagebtn">4</button></a>
        </div>';
        } else {
            echo "Keine Produkte gefunden";
            echo " </div>";
        }

        ?>




</body>

</html>
