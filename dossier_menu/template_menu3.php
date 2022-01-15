<?php include("./template_OnOff.php"); ?>
<script type="text/x-template" id="template-menu">

    <div data-role="panel" data-display="push" id="left-panel" data-theme="c">
      <ul data-role="listview">
          <li data-icon="delete"><a href="#" data-rel="close">&nbsp;</a>
          </li>
<li>
<app-OnOff></app-OnOff>
</li>

          
          <li data-role="collapsible" data-inset="false" data-iconpos="right">
            <h3 class="ui-btn ui-shadow ui-corner-all ui-icon-gear ui-btn-icon-left">&nbsp;&nbsp;&nbsp;&nbsp; Gérer les administrateurs</h3>
            <ul data-role="listview">
            <li><a href="#" onclick="show_connected_admin()">admins connectés</a></li>
              <li><a href="#" onclick="new_admin()">Nouvel admin</a></li>
            </ul>
          </li><!-- /collapsible -->

          <li data-role="collapsible" data-inset="false" data-iconpos="right">
            <h3 class="ui-btn ui-shadow ui-corner-all ui-icon-lock ui-btn-icon-left">&nbsp;&nbsp;&nbsp;&nbsp; Droits d'accès</h3>
            <ul data-role="listview">
              <li><a href="#" onclick="attribuer_droit_access()">Attribuer</a></li>
              <li><a href="#" onclick="supprimer_droit_access()">Supprimer</a></li>
            </ul>
          </li><!-- /collapsible -->

          <li data-role="collapsible" data-inset="false" data-iconpos="right">
<h3 class="ui-btn ui-shadow ui-corner-all ui-icon-forward ui-btn-icon-left">&nbsp;&nbsp;&nbsp;&nbsp; Autres</h3>
<ul data-role="listview">
<li><a href="#" onclick="show_classes()">Liste exhaustive des classes</a></li>
<li><a href="#" onclick="recu_verouilles()">Reçus verouillés</a></li>
</ul>
</li><!-- /collapsible -->


<li data-role="collapsible" data-inset="false" data-iconpos="right">
<h3 class="ui-btn ui-shadow ui-corner-all ui-icon-forward ui-btn-icon-left">&nbsp;&nbsp;&nbsp;&nbsp; Parcourir les modules</h3>
<ul data-role="listview">
<li><a href="./ktb_gestion_eleve.php" rel="external">Gestion élève</a></li>
<li><a href="./ktb_gestion_personnel.php" rel="external">Gestion du personnel</a></li>
<li><a href="./ktb_gestion_cotes.php" rel="external">Gestion des cotes</a></li>
<li><a href="./ktb_gestion_financiere.php" rel="external">Gestion finance</a></li>
</ul>
</li><!-- /collapsible -->

          <li data-role="collapsible" data-inset="false" data-iconpos="right">
            <h3 class="ui-btn ui-shadow ui-corner-all ui-icon-grid ui-btn-icon-left">&nbsp;&nbsp;&nbsp;&nbsp; Serveurs</h3>
            <ul data-role="listview">
              <li><a href="#" onclick="data_base()">Serveur MYSQL</a></li>
              <li><a href="#" onclick="info_serveur()">Serveur Apache</a></li>    
         </ul>
          </li><!-- /collapsible -->

          <li data-role="collapsible" data-inset="false" data-iconpos="right">
<h3 class="ui-btn ui-shadow ui-corner-all ui-icon-lock ui-btn-icon-left">&nbsp;&nbsp;&nbsp;&nbsp; Licence du produit</h3>
<ul data-role="listview">
<li><a href="#" onclick="ouvrir_licence_produit()">Contrat de licence</a></li>
<li><a href="#" onclick="historique_contrat()">Historique des contrats</a></li>
<li><a href="#" onclick="new_contrat()">Nouveau contrat</a></li>
</ul>
</li><!-- /collapsible -->

          <li data-role="collapsible" data-inset="false" data-iconpos="right">
            <h3 class="ui-btn ui-shadow ui-corner-all ui-icon-clock ui-btn-icon-left">&nbsp;&nbsp;&nbsp;&nbsp; Sources  externes</h3>
            <ul data-role="listview">
            <li><a href="#">MIN-EPSP</a></li>
              <li><a href="">USAID</a></li>
              <li><a href="#">UNICEF</a></li>
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