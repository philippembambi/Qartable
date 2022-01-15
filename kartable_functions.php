<?php function move_image($image)
{ 
$extension_upload = strtolower(substr( strrchr($image['name'],'.') ,1));
$name = time();
$nomimage = str_replace(' ','',$name).".".$extension_upload;
$name = "./images/".str_replace('','',$name).".".$extension_upload;
move_uploaded_file($image['tmp_name'],$name);
return $nomimage;
}
?>

<?php function check_image($picture)
{
    $i = 0;
    $image_erreur = NULL;
    $image_erreur1 = NULL;
    $image_erreur2 = NULL;
    $image_erreur3 = NULL;

    //On définit les variables :
    $maxsize = 3048576; //Poid de l'image
    $maxwidth = 1500; //Largeur de l'image
    $maxheight = 1500; //Longueur de l'image
    $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png', 'bmp' ); //Liste des extensions valides
    if ($picture['error'] > 0)
    {
    $image_erreur = "Erreur lors du transfert de
    l'image : ";
    }
    if ($picture['size'] > $maxsize)
    {
    $i++;
    $image_erreur1 = "Le fichier est trop gros :
    (<strong>".$picture['size']." Octets</strong> contre
    <strong>".$maxsize." Octets</strong>)";

    }
    $image_sizes = getimagesize($picture['tmp_name']);
    if ($image_sizes[0] > $maxwidth OR $image_sizes[1] >
    $maxheight)
    {
    $i++;
    $image_erreur2 = "Image trop large ou trop longue :
    (<strong>".$image_sizes[0]."x".$image_sizes[1]."</strong> contre
    <strong>".$maxwidth."x".$maxheight."</strong>)";
    }
    $extension_upload = strtolower(substr(strrchr($picture['name'], '.') ,1));
    if (!in_array($extension_upload, $extensions_valides) )
    {
    $i++;
    $image_erreur3 = "Extension de l'image
    incorrecte";
    }
if($i != 0)
{
    echo $image_erreur.' / '.$image_erreur1.' / '.$image_erreur2.' / '.$image_erreur3.' / ';
break;
}

}

?>

<?php
function getErrorStudent($var1, $var2)
{
    if(empty($var1) || empty($var2))
    {
        header("location: kartable_error.php");
    }    
}
?>


<?php  
function getErrorPupils($var1, $var2)
{
if(empty($var1) || empty($var2))
{
 ?>
 <br>
 
  <h3 class="ui-bar ui-bar-a ui-corner-all" data-theme="c"> <span><img src="./images/logo.png" alt="image logo" style="max-height: 80px;width: 100px;">
       </span>     
      L'effectif de la promotion est vide !</h3>
    <div class="ui-body ui-body-a ui-corner-all">
        <p data-theme="a"> 
        <p>Veillez choisir une action:</p>
        </p>

    <ul data-role="listview" data-inset="true">
        <li><a href="#" data-toggle="modal" data-target="#eleve1">
            <img src="./images/Employee Card_100px.png" class="ui-li-thumb">
            <h2>Nouvelle inscription</h2>
              <p>Formulaire élève</p>
              <p class="ui-li-aside">Inscription</p>
          </a></li>
        <li><a href="#">
            <img src="./images/Excel_color.png" class="ui-li-thumb">
            <h2>Exporter des enregistrements</h2>
              <p>Via un fichier Excel, Acess ou SQL</p>
              <p class="ui-li-aside">Exportation</p>
          </a></li>
        <li><a href="#">
            <img src="./images/Error_color100px.png" class="ui-li-thumb">
            <h2>Signaler un problème</h2>
              <p>Avez-vous rencontré un problème ?</p>
              <p class="ui-li-aside">Reportage</p>
          </a></li>
        
      </ul>
      </div>

      <script src="./main.js"></script>
<?php
}
}

function codeBb($texte)
{   $texte = preg_replace('`\[g\](.+)\[/g\]`isU', '<b>$1</b>', $texte);
	//italique
	$texte = preg_replace('`\[i\](.+)\[/i\]`isU', '<em>$1</em>', $texte);
	//souligné
	$texte = preg_replace('`\[s\](.+)\[/s\]`isU', '<u>$1</u>', $texte);

	$texte = preg_replace('`\[couleur\](.+)\[/couleur\]`isU', '<span style="color: #3388cc;">$1</span>', $texte);

	$texte = preg_replace('`\[url="([^|\']+)"](.+)\[/url]`isU', '<a href="$1">$2</a>', $texte);
	//lien
	$texte = preg_replace('#http://[a-z0-9._/-]+#i', '<a href="$0">$0</a>', $texte);
	//etc., etc.
	$texte = preg_replace('`\[quote\](.+)\[/quote\]`isU', '<div id="quote">$1</div>', $texte);
	//On retourne la variable texte
	return $texte;
}
?>