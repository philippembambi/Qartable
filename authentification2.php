<?php
function verifieMotDePasse($login, $pass){
if($login == "config" && $pass == "config") 
{ 
    return true; 
}
else {
     return false; 
    }
}

if ( !isset( $_SERVER['PHP_AUTH_USER'] ) || !isset( $_SERVER['PHP_AUTH_PW'] ) || verifieMotDePasse($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) == false) {
$titre = 'Gestion de Configuration';
header('WWW-Authenticate: Basic realm="'.$titre.'"');
header('Unauthorized', TRUE, 401);
echo '<script>alert("vous n\'avez pas accès à cette page");</script>' ;
exit();
}
//echo '<script>alert("Authentification réussi");</script>' ;
//echo 'Bonjour ', $_SERVER['PHP_AUTH_USER'] ;
?>

<?php
function deconnecteHTTP() {
    $titre = 'Authentification';
    header('WWW-Authenticate: Basic realm="'.$titre.'"');
    header('Unauthorized', TRUE, 401);
    exit;
    }
?>