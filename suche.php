<?php

function buildprodquery($filters)
{
    include_once "db.php";
    $sql = "SELECT * FROM produkte WHERE 1";

    if (isset($filters['suchbegriff'])) {
        $sql .= " AND produkt LIKE '%" . $filters['suchbegriff'] . "%'";
    }

    if (isset($filters['kategorie']) && is_array($filters['kategorie'])) {
        $categoryFilter = "'" . implode("', '", $filters['kategorie']) . "'";
        $sql .= " AND id IN (SELECT produktid FROM mapping WHERE kategorieid IN (SELECT id FROM kategorien WHERE kategorie IN ($categoryFilter)))";
    }

    if (isset($filters['prices'])) {
        list($minPrice, $maxPrice) = explode('-', $filters['prices']);
        $sql .= " AND preis BETWEEN $minPrice AND $maxPrice";
    } else {
        $minPrice = 0;
        $maxPrice = 3001;
        list($minPrice, $maxPrice) = explode('-', $filters['prices']);
        $sql .= " AND preis BETWEEN $minPrice AND $maxPrice";
    }

    return $sql;
}
