<?php
include("kartable_functions.php");
$error = NULL;
$filename = NULL;

if (isset($_FILES['uploadFile']) && $_FILES['uploadFile']['error'] === 0) 
{
    $extension_upload = strtolower(substr(strrchr($_FILES['uploadFile']['name'], '.') ,1));
    $extensions_valides = array( 'pdf' , 'PDF' );

if (!in_array($extension_upload, $extensions_valides))
{
    echo "<script>alert('Extension de l'image incorrecte !');</script>";
    //$error = "Extension de l'image incorrecte";
}
else
{
    $filename = $_FILES['uploadFile']['name'];
    $targetpath = getcwd() . './send/' . $filename; // On stocke le chemin où enregistrer le fichier
    // On déplace le fichier depuis le répertoire temporaire vers $targetpath
    if (@move_uploaded_file($_FILES['uploadFile']['tmp_name'], $targetpath)) 
    { 
        // Si ça fonctionne
    //$error = 'OK';
    echo "<script>alert('Fichier importé avec succès !');</script>";
    } 
    else 
    { // Si ça ne fonctionne pas
        echo "<script>alert('Échec de l'enregistrement !');</script>";
    //$error = "Échec de l'enregistrement !";
    }
}

} 
else 
{
    echo "<script>alert('Aucun fichier réceptionné !');</script>";
}
// Et pour finir, on écrit l'appel vers la fonction uploadEnd :
?>