<?php
require("database.php");

$terme = $_GET['s'];
$requete = $db->prepare('SELECT * FROM client WHERE client_noms LIKE :terme');
$requete->execute(array('terme' => '%'.$terme.'%'));
$array = array();

while($donnee = $requete->fetch())
{
 
        array_push($array, $donnee['client_noms']);

}
echo json_encode($array);
?>