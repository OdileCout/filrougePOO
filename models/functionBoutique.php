<?php
include_once('panier/db.class.php');
include_once('panier/panier.class.php');
    $DB = new Db();
    $Panier = new Panier($DB);
    $row = $DB->query('SELECT `id`, `nom_produit`, `description`, `prix_unitaire`, `quantite_disponibles`, `numeroImage` FROM `listeproduits`');

