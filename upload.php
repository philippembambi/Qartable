<?php
include("kartable_functions.php");
$error = NULL;
$filename = NULL;

if (isset($_FILES['uploadFile']) && $_FILES['uploadFile']['error'] === 0) 
{
    $extension_upload = strtolower(substr(strrchr($_FILES['uploadFile']['name'], '.') ,1));
    $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png', 'bmp' );

if (!in_array($extension_upload, $extensions_valides))
{
    $error = "Extension de l'image incorrecte";
}
else
{
    $filename = $_FILES['uploadFile']['name'];
    $targetpath = getcwd() . './images/' . $filename; // On stocke le chemin où enregistrer le fichier
    // On déplace le fichier depuis le répertoire temporaire vers $targetpath
    if (@move_uploaded_file($_FILES['uploadFile']['tmp_name'], $targetpath)) 
    { 
        // Si ça fonctionne
    $error = 'OK';
    } 
    else 
    { // Si ça ne fonctionne pas
    $error = "Échec de l'enregistrement !";
    }
}

} 
else 
{
$error = 'Aucun fichier réceptionné !';
}
// Et pour finir, on écrit l'appel vers la fonction uploadEnd :
?>
<script>
window.top.window.uploadEnd("<?php echo $error; ?>", "<?php echo
$filename; ?>");
</script>