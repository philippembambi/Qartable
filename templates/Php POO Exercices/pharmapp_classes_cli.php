<!--Projet PharmApp-->
<?php


?>

<?php

$lot_produits = new Lot_produits(12, "02/02/2021");
$lot_produits->ajouter_lot();
$lot_produits->afficher_lot();

$lot2_produits = new Lot_produits(16, "02/02/2021");
$lot2_produits->ajouter_lot();
?>