<?php
try
{
  $db = new PDO('mysql:host=127.0.0.1;dbname=app', 'costa', 'costa');
  echo 'Connexion réussi !';
}
catch (Exception $e)
{
die('Erreur : ' . $e->getMessage());
}
?>