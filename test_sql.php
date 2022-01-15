<?php
require('database.php');

$q=$db->prepare('SELECT*  FROM kartable_eleves 
WHERE id_eleve = (SELECT id_eleve FROM kartable_eleves ORDER BY id_eleve DESC LIMIT 1)');
$q->execute();
$data = $q->fetch();

    echo 'Eleve '.$data['noms_eleve'];
    echo '<br/>';
    echo $data['id_eleve'];
?>