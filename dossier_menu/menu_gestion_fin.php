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
            <h3 class="ui-btn ui-shadow ui-corner-all ui-icon-info ui-btn-icon-left">&nbsp;&nbsp;&nbsp;&nbsp; Fichiers</h3>
            <ul data-role="listview">
              <li><a href="#" onclick="historique_des_frais()">Bulletins frais scolaires</a></li>
              <li><a href="#" onclick="bulletin_de_paie()">Bulletins de paie</a></li>
            <li><a href="#" onclick="bulletin_des_emprunts()">Bons des emprunts</a></li>
            </ul>
          </li><!-- /collapsible -->
          
          <li data-role="collapsible" data-inset="false" data-iconpos="right">
            <h3 class="ui-btn ui-shadow ui-corner-all ui-icon-gear ui-btn-icon-left">&nbsp;&nbsp;&nbsp;&nbsp; Frais scolaires</h3>
            <ul data-role="listview">
              <li><a href="#" onclick="payer_frais()">Nouveau paiement de frais</a></li>
              <li><a href="#" onclick="historique_frais()">Historique et Contrôle</a></li>
              <li><a href="#" onclick="print_stats_fees()" rel="external">Statistique</a></li>
            </ul>
          </li><!-- /collapsible -->


<li data-role="collapsible" data-inset="false" data-iconpos="right">
<h3 class="ui-btn ui-shadow ui-corner-all ui-icon-user ui-btn-icon-left">&nbsp;&nbsp;&nbsp;&nbsp; Paie des salariés</h3>
<ul data-role="listview">
<li><a href="#" onclick="remunerer_personnel()">Payer un salarié</a></li>
<li><a href="#" onclick="show_payement_story()">Historique de paie</a></li>
</ul>
</li><!-- /collapsible -->

<li data-role="collapsible" data-inset="false" data-iconpos="right">
<h3 class="ui-btn ui-shadow ui-corner-all ui-icon-user ui-btn-icon-left">&nbsp;&nbsp;&nbsp;&nbsp; Emprunts des salariés</h3>
<ul data-role="listview">
<li><a href="#" onclick="enregister_emprunt()">Enregistrer un emprunt</a></li>
<li><a href="#" onclick="histortique_emprunt()">Historique des emprunts</a></li>
</ul>
</li><!-- /collapsible -->

          <li data-role="collapsible" data-inset="false" data-iconpos="right">
            <h3 class="ui-btn ui-shadow ui-corner-all ui-icon-recycle ui-btn-icon-left">&nbsp;&nbsp;&nbsp;&nbsp; Convertisseur</h3>
            <ul data-role="listview">
            <li><a href="#" onclick="convertir_monnaie()">Monnaie</a></li>
            </ul>
          </li><!-- /collapsible -->

         

          <li data-role="collapsible" data-inset="false" data-iconpos="right">
            <h3 class="ui-btn ui-shadow ui-corner-all ui-icon-clock ui-btn-icon-left">&nbsp;&nbsp;&nbsp;&nbsp; Transactions</h3>
            <ul data-role="listview">
            <li><a href="#">AUjourd'hui</a></li>
            <li><a href="#">Historique</a></li>
            </ul>
          </li><!-- /collapsible -->


          <li data-role="collapsible" data-inset="false" data-iconpos="right">
            <h3 class="ui-btn ui-shadow ui-corner-all ui-icon-mail ui-btn-icon-left">&nbsp;&nbsp;&nbsp;&nbsp; Messagerie privée</h3>
            <ul data-role="listview">
              <li><a href="#" onclick="messagerie_privee()">Nouveau message</a></li>
              <li><a href="#" onclick="boite_reception()">Boîte de reception </a></li>
            <li><a href="#" onclick="messages_envoyes()">Messages envoyés</a></li>
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