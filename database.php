<?php
try
{
	$db = new PDO('mysql:host=127.0.0.1;dbname=kartable', 'costa', 'costa');
	$req = $db->exec("SET lc_time_names='fr_FR' ");
	$req = $db->exec("SET names utf8");
}
catch (Exception $e)
{
die('Erreur : ' . $e->getMessage());
}
?>