<?php
$query=$db->prepare('SELECT COUNT(*) AS unread_msg FROM messagerie_privee LEFT JOIN kartable_admin
ON kartable_admin.id_admin = messagerie_privee.id_destinateur 
WHERE messagerie_privee.lu = "" AND messagerie_privee.id_destinateur = :id_admin');
$query->bindValue(':id_admin', (int) $id_admin, PDO::PARAM_INT);
$query->execute();
$data2 = $query->fetch();
$unread_msg = $data2['unread_msg'];
$query->CloseCursor();
?>

<?php include("template_OnOff.php"); ?>

<script type="text/x-template" id="template-menu">

    <div data-role="panel" data-display="push" id="left-panel" data-theme="c">
      <ul data-role="listview">
          <li data-icon="delete"><a href="#" data-rel="close">&nbsp;</a>
          </li>
<li>
<app-OnOff></app-OnOff>
</li>
          
          <li data-role="collapsible" data-inset="false" data-iconpos="right">
            <h3 class="ui-btn ui-shadow ui-corner-all ui-icon-gear ui-btn-icon-left">&nbsp;&nbsp;&nbsp;&nbsp; Fichiers</h3>
            <ul data-role="listview">
              <li><a href="#popupromo" data-rel="popup" data-transition="flip">Données Excel</a></li>
              <li><a href="#" onclick="">Uploader un fichier</a></li>
            </ul>
          </li><!-- /collapsible -->

          <li data-role="collapsible" data-inset="false" data-iconpos="right">
<h3 class="ui-btn ui-shadow ui-corner-all ui-icon-user ui-btn-icon-left">&nbsp;&nbsp;&nbsp;&nbsp; Calculator</h3>
<ul data-role="listview">
<li><a href="#eleve1" data-toggle="modal" data-target="#eleve1" onclick="ouvrir_calculator()">Ouvrir</a></li>
</ul>
</li><!-- /collapsible -->


<li data-role="collapsible" data-inset="false" data-iconpos="right">
<h3 class="ui-btn ui-shadow ui-corner-all ui-icon-user ui-btn-icon-left">&nbsp;&nbsp;&nbsp;&nbsp; Bulletins des cotes</h3>
<ul data-role="listview">
<li><a href="#personnel" data-toggle="modal" data-target="#personnel" onclick="ouvrir_bulletins()">Afficher</a></li>
</ul>
</li><!-- /collapsible -->

<li data-role="collapsible" data-inset="false" data-iconpos="right">
<h3 class="ui-btn ui-shadow ui-corner-all ui-icon-check ui-btn-icon-left">&nbsp;&nbsp;&nbsp;&nbsp; Palmarès</h3>
<ul data-role="listview">
<li><a href="#" onclick="ouvrir_palmares()">Afficher</a></li>
</ul>
</li><!-- /collapsible -->


          <li data-role="collapsible" data-inset="false" data-iconpos="right">
            <h3 class="ui-btn ui-shadow ui-corner-all ui-icon-info ui-btn-icon-left">&nbsp;&nbsp;&nbsp;&nbsp; Grille de cotes</h3>
            <ul data-role="listview">
              <li><a href="#" onclick="ouvrir_grilles()">Afficher</a></li>
            </ul>
          </li><!-- /collapsible -->

          <li data-role="collapsible" data-inset="false" data-iconpos="right">
            <h3 class="ui-btn ui-shadow ui-corner-all ui-icon-mail ui-btn-icon-left">&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: #3388cc;font-size: 18px;"><?php echo $unread_msg; ?></span> Messagerie privée</h3>
            <ul data-role="listview">
              <li><a href="#" onclick="messagerie_privee()">Nouveau message</a></li>
              <li><a href="#" onclick="boite_reception()">Boîte de reception (<span style="color: #3388cc;font-size: 18px;"><?php echo $unread_msg; ?></span>)</a></li>
            <li><a href="#" onclick="messages_envoyes()">Messages envoyés</a></li>
            </ul>
          </li><!-- /collapsible -->

          <li data-role="collapsible" data-inset="false" data-iconpos="right">
            <h3 class="ui-btn ui-shadow ui-corner-all ui-icon-clock ui-btn-icon-left">&nbsp;&nbsp;&nbsp;&nbsp; Sources  externes</h3>
            <ul data-role="listview">
            <li><a href="#" onclick="crawl_page()">MIN-EPSP</a></li>
              <li><a href="#" onclick="crawl_unicef()">USAID</a></li>
              <li><a href="#" onclick="crawl_unicef()">UNICEF</a></li>
            </ul>
          </li><!-- /collapsible -->


        </ul>
  </div><!-- /panel -->

  </script>

  <script>
 var admin =  Vue.component('app-menu', {
    data: function() { 
    return {
    }
},
methods: {
  turnIt: function(){
    alert("allez ?");
    console.log("ok");
  }
},
activated() {
console.log("Le composant formulaire est activé !");
},
deactivated() {
console.log("Le composant formulaire est désactivé !");
},
destroyed() {
console.log("Le composant formulaire est détruit !");
},
template: '#template-menu'
  });  
</script>