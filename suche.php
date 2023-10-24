<?php

function buildprodquery($filters)
{
    include_once "db.php";
    $sql = "SELECT * FROM produkte WHERE 1";

    if (isset($filters['suchbegriff'])) {
        $sql .= " AND produkt LIKE '%" . $filters['suchbegriff'] . "%'";
    }

    if (isset($filters['kategorie'])) {
        $selectedCategories = $filters['kategorie'];
        if (!empty($selectedCategories)) {
            $categoryFilter = "'" . implode("', '", $selectedCategories) . "'";
            $categoryQuery = "SELECT id FROM kategorien WHERE kategorie IN ($categoryFilter)";
            $sql .= " AND kategorie IN (SELECT produktid FROM mapping WHERE kategorieid IN ($categoryQuery))";
            echo "kategorie:<br>";
            echo $sql;
        }
    }

    if (isset($filters['prices'])) {
        list($minPrice, $maxPrice) = explode('-', $filters['prices']);
        $sql .= " AND preis BETWEEN $minPrice AND $maxPrice";
    }

    return $sql;
}
