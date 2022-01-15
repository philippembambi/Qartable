<?php
$nom_fichier = $_GET['nom_fichier'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
<iframe src="<?php echo './'.$nom_fichier.'.pdf' ?>" frameborder="0" style="height: 600px;width: 100%;" id="myframes" data-transition="flip"></iframe>    
</body>
 </html>