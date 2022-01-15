<?php
$contrat = $db->prepare('SELECT * FROM kartable_contrat WHERE id_contrat = 1');
$contrat->execute();
$data_contrat = $contrat->fetch();
$echeance = strtotime($data_contrat['echeance_contrat']);
$echeance = date('d/m/Y', $echeance);
$contrat->CloseCursor();

$today = date('d/m/Y', time());

$expire = $db->prepare('SELECT * FROM kartable_contrat 
WHERE id_contrat = 1 AND UNIX_TIMESTAMP() < :today');
$expire->bindValue(':today', strtotime($data_contrat['echeance_contrat']), PDO::PARAM_INT);
$expire->execute();
$data_expire = $expire->fetch();
$expire->CloseCursor();

if(empty($data_expire['id_contrat']))
{
  die();
}
?>

<div data-role="popup" id="popupCloseRightPage2" class="ui-content" style="max-width:280px" data-theme="c">
  <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-left">Close</a>
<p>Ce produit est distribué sous licence MIT open source respectant les conditions se droits d'auteur <br>
<hr>
Veillez adresser toute suggestion et préoccupation : philippembambi413@gmail.com
<hr>
</div>

<div data-role="popup" id="parametre" data-theme="c">
<ul data-role="listview" data-inset="true" style="min-width:210px;">
    <li data-role="list-divider">Choisir une action</li>
    <li><a href="#">Modifier</a></li>
    <li><a href="#">Supprimer</a></li>
</ul>
</div>

<div data-role="popup" id="info" class="ui-content" style="max-width:300px" data-theme="c">
              <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-left">Close</a>
              <img src="./images/students.PNG" alt="image logo" style="max-height: 150px;width: 300px;">
          <strong><h2 style="font-size: 25px;font-family: leelawadee;color:#3388cc;"> Bienvenue sur Kartbale</h2></strong>
          <hr>
          <p contenteditable="true">
      <ul>
      <li><b style="font-weight: bold;">* Statut des Cookies : <span id="cookies"></span></b></li>
        <li><b style="font-weight: bold;">* Connexion : <span id="connect"></span></b></li>
        <li><b style="font-weight: bold;">* Le contrat expire le <span style="color: green;"><?php echo $echeance; ?></span></b></li>
    
        </ul>
          Kartable utilise les cookies pour améliorer votre expérience d'utilisation
          </p>
        <label for="grid-checkbox-1">Accepter les conditions</label>
        <input type="checkbox" id="grid-checkbox-1" name="grid-checkbox-1">
     </div>      

<script>
if(navigator.cookieEnabled == true)
{
    document.getElementById("cookies").innerText = "activé";
    document.getElementById("cookies").style.color = "green";
}
else{
  document.getElementById("cookies").innerText = "desactivé";
    document.getElementById("cookies").style.color = "red";
}

if(navigator.onLine == true)
{
    document.getElementById("connect").innerText = "activé";
    document.getElementById("connect").style.color = "green";
}
else{
  document.getElementById("connect").innerText = "desactivé";
    document.getElementById("connect").style.color = "red";
}
</script>