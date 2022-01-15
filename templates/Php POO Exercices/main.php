<?php
require("./classes.php");

$voiture = new Voiture('Mercedes');
$voiture->rouler(70);
echo '<br>';
$voiture->accelerer();
?>