<?php
function verifieMotDePasse($login, $pass){
if($login == "admin" && $pass == "admin") { return true; }
else { return false; }
}

if ( !isset( $_SERVER['PHP_AUTH_USER'] ) || !isset( $_SERVER['PHP_AUTH_PW'] ) || verifieMotDePasse($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) == false) {
// Soit les informations ne sont pas présentes,
// soit elles sont erronées
// On demande donc plus d’informations au navigateur
$titre = "Authentification de l'administrateur";
header('WWW-Authenticate: Basic realm="'.$titre.'"');
header('Unauthorized', TRUE, 401);
// Texte à envoyer si l’utilisateur refuse de s’authentifier
echo '<script>alert("vous n\'avez pas accès à cette page");</script>' ;
// On arrête l’exécution
exit();
}
// L’authentification a réussi
// On peut mettre le reste de la page comme habituellement
//echo '<script>alert("Authentification réussi");</script>' ;
//echo 'Bonjour ', $_SERVER['PHP_AUTH_USER'] ;
?>