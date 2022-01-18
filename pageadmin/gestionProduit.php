<?php
$db = new Db();
$lesProduits = $db->query('SELECT * FROM listeproduits');

?>