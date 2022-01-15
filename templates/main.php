<?php
require("./db.php");
include("./functions.php"); ?>
<script>
/*__ Core du composant Administrateur__ */
var php_client = "<?php $client = new client($db); $client->getClient(); ?>";
var php_solde = "<?php $solde = new client($db); $solde->getSolde(); ?>";

const eventBus = new Vue(); //Bus d'événement

var application = new Vue({}); //Nouvelle instance Vue
application.$mount('#cmp-application'); //Exécuter l'application
</script>