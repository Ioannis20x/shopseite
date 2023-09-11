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
    <style>
        .grid-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .grid-item {
            width: 500px;
            height: 500px;
            margin-bottom: 50px;
            box-shadow: 0px 0px 10px black;
            text-align: left;
            margin-left: 10px;
        }

        img {
            width: 375px;
            height: 360px;
        }

        #seiten {
            margin: 50px auto auto auto;
            width: 50%;
            text-align: center;
        }

        .pagebtn {
            border: solid 1px;
            height: 20px;
            border-radius: 0;

        }

        .pagebtn:hover {
            cursor: pointer;
        }

        #sold {
            display: block;
            margin-left: 45px;
            color: #DF2727;
        }

        .grau {
            -webkit-filter: grayscale(100%);
            -moz-filter: grayscale(100%);
            -ms-filter: grayscale(100%);
            -o-filter: grayscale(100%);
            filter: grayscale(100%);
            width: 350px;
            height: 325px;
        }

        h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 25px;
            font-weight: 400;
            color: #505050;
            line-height: 30px;
        }

        h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 20px;
            font-weight: 700;
            color: #AFD96F;
            line-height: 24px;
        }

        .prodname {
            display: block;
            margin-left: 45px;
        }

        .price {
            display: block;
            margin-top: -15px;
            margin-left: 45px;
        }

        #filter {
            float: left;
            width: 300px;
            height: 100%;
            display: block;
            text-align: center;
            box-shadow: 0px 0px 10px black;
            align-content: center;
        }

        ::placeholder {
            padding-top: 10px;
            padding-left: 20px;
            padding-bottom: 10px;
        }

        #suche {
            height: 30px;
            margin-top: 20px;
            margin-bottom: 10px;
            display: inline-block;
            border: solid 1px;

        }

        input[type="checkbox"] {

            box-sizing: border-box;
            padding: 0;
            display: list-item;
            width: 1.15em;
            height: 1.15em;
            border: 0.15em solid grey;
            border-radius: 100px;
            transform: translateY(-0.075em);
            white-space: nowrap;
            position: absolute;
            margin-right: 0;
        }

        [type="search"] {
            border: none;
        }

        #checkboxen {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 65px;
            width: 50px;
        }

        .kategorie {
            margin-bottom: 20px;
            width: 20px;

        }

        #suchleiste {
            height: inherit;
            position: relative;
            top: -6px;
            left: -0px;
            display: inline-block;
        }

        input:focus {
            outline: none;
        }

        button[type="submit"]:hover {
            background-color: gray;
        }

        button[type="submit"] {
            display: inline-block;
            height: inherit;
            background: none;
            border-width: 0;
            border-style: none;
            outline: none;
        }

        #kategorien {
            position: relative;
            width: 60px;
            height: auto !important;
            height: 150px;
            left: -35px;
            min-height: 150px;
            margin-top: -190px;
            margin-left: 150px;
            float: left;
        }


        label {
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
            font-weight: 400;
            color: #505050;
            line-height: 19px;
            display: inline-block;
            margin-top: 10px;
        }

        #h2kat {
            display: inline-block;
            position: absolute;
            top: 62px;
            left: 50px;
            border: none;
        }
    </style>
</head>

<body>

    <div id="filter">
        <div id="suche">
            <input type="search" name="suchen" id="suchleiste" placeholder="Suchen...">
            <button type="submit">
                <span class="material-symbols-outlined">search</span>
            </button>
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

    </div>
    <div class="grid-container">
        <?php
        include "db.php";
        include "import.php";

        // Verbindungsdaten zur Datenbank
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'shopseite';

        //importproducts($dbhandle);

        if (isset($_GET["page"])) {
            $offset = (6 * $_GET["page"]) - 6;
            if (isset($_GET["kategorie"])) {
                if ($_GET["page"] == 1) {
                    $sql = "SELECT * FROM produkte WHERE kategorie= " . $_GET['kategorie'] . " LIMIT 6 OFFSET 0";
                    $result = $dbhandle->query($sql);
                } else if ($_GET["page"] > 1) {
                }
                $sql = "SELECT * FROM produkte WHERE kategorie= " . $_GET['kategorie'] . " LIMIT 6 OFFSET" . $offset . "";
                $result = $dbhandle->query($sql);
            } else {
                //echo $offset;
                $sql = "SELECT * FROM produkte LIMIT 6 OFFSET " . $offset;
            }
            $result = $dbhandle->query($sql);
        } else {
            $sql = "SELECT * FROM produkte LIMIT 6 OFFSET 0";
            $result = $dbhandle->query($sql);
        }

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='grid-item'>";
                echo "<h1 class='prodname'>";
                echo $row["produkt"];
                echo "</h1>";
                echo "<h2 class='price'>$row[preis]€</h2>";
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

        ?>
    </div>

    <div id="seiten">
        <a href="http://localhost/shop/?page=1"><button class="pagebtn">1</button></a>
        <a href="http://localhost/shop/?page=2"><button class="pagebtn">2</button></a>
        <a href="http://localhost/shop/?page=3"><button class="pagebtn">3</button></a>
        <a href="http://localhost/shop/?page=4"><button class="pagebtn">4</button></a>
    </div>
</body>

</html>