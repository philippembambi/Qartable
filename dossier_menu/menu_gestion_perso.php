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
              <li><a href="#popupromo" data-rel="popup" data-transition="flip">Bordereau de paie</a></li>
            </ul>
          </li><!-- /collapsible -->

          <li data-role="collapsible" data-inset="false" data-iconpos="right">
<h3 class="ui-btn ui-shadow ui-corner-all ui-icon-user ui-btn-icon-left">&nbsp;&nbsp;&nbsp;&nbsp; Journées pédagogiques</h3>
<ul data-role="listview">
<li><a href="#eleve1">Affecter à un ensignant</a></li>
<li><a href="#eleve1">Modifier</a></li>
</ul>
</li><!-- /collapsible -->

<li data-role="collapsible" data-inset="false" data-iconpos="right">
<h3 class="ui-btn ui-shadow ui-corner-all ui-icon-user ui-btn-icon-left">&nbsp;&nbsp;&nbsp;&nbsp; Personnels</h3>
<ul data-role="listview">
<li><a href="#personnel" data-toggle="modal" data-target="#personnel">Nouveau Personnel</a></li>
<li><a href="#" onclick="listing()">Listing</a></li>
<li><a href="#" onclick="show_affectation()">Affectation des cours</a></li>
</ul>
</li><!-- /collapsible -->

<li data-role="collapsible" data-inset="false" data-iconpos="right">
<h3 class="ui-btn ui-shadow ui-corner-all ui-icon-check ui-btn-icon-left">&nbsp;&nbsp;&nbsp;&nbsp; Pointage</h3>
<ul data-role="listview">
<li><a href="#" onclick="pointage()">Pointage du jour</a></li>
<li><a href="#" onclick="historique_pointage()">Historique de pointage</a></li>
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