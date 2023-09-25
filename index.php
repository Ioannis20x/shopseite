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
            border-left: solid 0.5px grey;
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

        html,
        body {
            height: 100%;
        }

        #filter {
            float: left;
            width: 300px;
            min-height: 100%;
            height: auto !important;
            height: 100%;
            display: block;
            text-align: center;
            box-shadow: rgba(0, 0, 0, 0.15) 3.95px 0px 6px;
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
            margin-left: -10px;
            display: inline-block;
            border: solid 1px;

        }

        input[type="checkbox"] {
            appearance: none;
            box-sizing: border-box;
            padding: 0;
            display: list-item;
            width: 1.15em;
            height: 1.15em;
            position: absolute;
            display: grid;
            place-content: center;
            font: inherit;
            color: currentColor;
            border: 0.1em solid gray;
            border-radius: 0.15em;
            transform: translateY(-0.075em);
            place-content: center;
            content: "";
        }

        input[type="checkbox"]::before {
            content: "";
            width: 0.65em;
            height: 0.55em;
            transform: scale(0);
            content: "";
            border: 0.1em solid white;
            background-color: #AFD96F;
            transition: 120ms transform ease-in-out;
            box-shadow: inset 1em 1em var(--form-control-color);
        }

        input[type="checkbox"]:checked::before {
            transform: scale(1);
        }

        [type="search"] {
            border: none;
        }

        #checkboxen {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-left: 40px;
            margin-top: 35px;
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
            margin-top: -149px;
            margin-left: 100px;
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

        #h2price {
            display: inline-block;
            position: absolute;
            top: 255px;
            left: 50px;
            border: none;
        }

        #h2kat {
            display: inline-block;
            position: absolute;
            top: 62px;
            left: 50px;
            border: none;
        }

        #prices {
            height: 30px;
            margin-top: 60px;
            width: 215px;
            margin-left: 40px;
            display: block;
            border: solid 1px;

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
            print_r($result);
        }



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