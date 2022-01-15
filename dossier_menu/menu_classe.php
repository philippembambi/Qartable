<?php include("./template_OnOff.php"); ?>
<script type="text/x-template" id="template-menu2">

<div data-role="panel" data-display="push" data-theme="c" id="left-panel">
  <ul data-role="listview">
    <li data-icon="delete"><a href="#" data-rel="close">Fermer</a></li>

<li>
<app-OnOff></app-OnOff>
</li>


<li data-role="collapsible" data-inset="false" data-iconpos="right">
<h3 class="ui-btn ui-shadow ui-corner-all ui-icon-action ui-btn-icon-left">&nbsp;&nbsp;&nbsp;&nbsp; Fichier</h3>
<ul data-role="listview">
<li><a href="#" onclick="ouvrir_bulletin()">Bulletins scolaire</a></li>
  <li><a href="#" onclick="show_bulletin()">Nouveau bulletin</a></li>
  </ul>
</li><!-- /collapsible -->

<li data-role="collapsible" data-inset="false" data-iconpos="right">
<h3 class="ui-btn ui-shadow ui-corner-all ui-icon-gear ui-btn-icon-left">&nbsp;&nbsp;&nbsp;&nbsp; Classe</h3>
<ul data-role="listview">
<li><a href="#" onclick="allStudent()">Effectif d'elèves</a></li>
<li><a href="#" onclick="enseignants_affectes()">Enseignants affectés</a></li>
<li><a href="#" onclick="cours_dispenses()">Cours dispensés</a></li>
</ul>
</li><!-- /collapsible -->

<li data-role="collapsible" data-inset="false" data-iconpos="right">
<h3 class="ui-btn ui-shadow ui-corner-all ui-icon-grid ui-btn-icon-left">&nbsp;&nbsp;&nbsp;&nbsp;Registre d'appel</h3>
<ul data-role="listview">
<li><a href="#" onclick="registre_appel()">Registre d'Aujourd'hui</a></li>
<li><a href="#" onclick="registre_appel_story()">Historique</a></li>
</ul>
</li><!-- /collapsible -->

<li data-role="collapsible" data-inset="false" data-iconpos="right">
<h3 class="ui-btn ui-shadow ui-corner-all ui-icon-clock ui-btn-icon-left">&nbsp;&nbsp;&nbsp;&nbsp;Horaire des cours</h3>
<ul data-role="listview">
<li><a href="#" onclick="afficher_horaire()">Afficher l'horaire</a></li>
<li><a href="#" onclick="ajouter_cours()">Ajouter un cours</a></li>
</ul>
</li><!-- /collapsible -->

<li data-role="collapsible" data-inset="false" data-iconpos="right">
<h3 class="ui-btn ui-shadow ui-corner-all ui-icon-bars ui-btn-icon-left">&nbsp;&nbsp;&nbsp;&nbsp; Licence du produit</h3>
<ul data-role="listview">
<li><a href="#popupCloseRightPage2" data-rel="popup">Termes du contrat</a></li>
<li><a href="#">Conditions d'utilisation</a></li>
</ul>
</li><!-- /collapsible -->

<li data-role="collapsible" data-inset="false" data-iconpos="right">
            <h3 class="ui-btn ui-shadow ui-corner-all ui-icon-info ui-btn-icon-left">&nbsp;&nbsp;&nbsp;&nbsp; Sources  externes</h3>
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
var admin =  Vue.component('app-menu2', {
template: '#template-menu2'
});  
</script>