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
  echo "L'echéance du contrat a expiré !";
  die();
}

$query=$db->prepare('SELECT COUNT(*) AS unread_msg FROM messagerie_privee LEFT JOIN kartable_admin
ON kartable_admin.id_admin = messagerie_privee.id_destinateur 
WHERE messagerie_privee.lu = "" AND messagerie_privee.id_destinateur = :id_admin');
$query->bindValue(':id_admin', (int) $id_admin, PDO::PARAM_INT);
$query->execute();
$data2 = $query->fetch();
$unread_msg = $data2['unread_msg'];
$query->CloseCursor();
?>

<div data-role="popup" id="popupCloseLeft" class="ui-content" style="max-width:280px" data-theme="c">
              <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-left">Close</a>
              <p>Ce produit est distribué sous licence Creative Commons 62.3 respectant les conditions se droits d'auteur <br>
<hr>
Veillez adresser toute suggestion et préoccupation : philippembambi413@gmail.com
      </div>      

          <div data-role="popup" id="info" class="ui-content" style="max-width:300px" data-theme="c">
              <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-left">Close</a>
              <img src="./images/students.PNG" alt="image logo" style="max-height: 150px;width: 300px;">
          <a href="#" style="font-size: 22px;font-family: leelawadee;"> Bienvenue sur Kartbale</a>
          <hr>
          <p contenteditable="true">
      <ul>
        <li><b style="font-weight: bold;">* Statut des Cookies : <span id="cookies"></span></b></li>
        <li><b style="font-weight: bold;">* Connexion : <span id="connect"></span></b></li>
        <li><b style="font-weight: bold;">* Le contrat expire le <span style="color: green;"><?php echo $echeance; ?></span></b></li>
        <li><b style="font-weight: bold;">* Nouveau message : <span style="color: green;"><?php echo $unread_msg; ?></span></b></li>
     </ul>
          En utilisant kartable, vous acceptez les condtions d'utilisation.. 
          </p>
        <label for="grid-checkbox-1">Accepter les conditons</label>
        <input type="checkbox" id="grid-checkbox-1" name="grid-checkbox-1" data-rel="back">
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