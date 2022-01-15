<script type="text/x-template" id="template-my-server">
  <div class="col-sm-4">
    <div class="panel panel-warning">
      <div class="panel-heading">
        <h3 class="panel-title"><strong><i class="fa fa-signal fa-2x"></i> Serveurs Apache 2.0</strong></h3>
      </div>
      <div class="panel-body">
        * Etat du serveur : <strong style="color: red;"> {{ state }} </strong>
<hr>
<button @click="changeState"  class="btn btn-warning"> <i class="fa fa-compress"></i> Changer d'état</button>
      </div>
<app-statut-serveur 
                v-bind:EtatProps="state" 
                v-on:valeurInitialiser="state = $event"
                :callbackFn="ResetValue"
>
</app-statut-serveur>

<app-cmp-serveur 
                v-bind:CallbackEtat="state"
                v-on:InitState="state = $event"
>
</app-cmp-serveur>

    </div></div>
</script>

<script>
  /*__ Core du composant app-my-server__ */
Vue.component('app-my-server', {
  template: '#template-my-server',
  data: function() {
    return {
        state: 'Amélioré',
        selectedCmp: 'app-my-server'
    }
},
methods: {
    changeState() {
        this.state = 'Optimisé';
    },
    ResetValue() {
        this.state = "Etat initialisé par un callback dans le serveur MySQL"
    }
},
  activated() {
console.log("Le composant parent Home est activé !");
},
deactivated() {
console.log("Le composant parent Home est désactivé !");
},
destroyed() {
console.log("Le composant parent Home est détruit !");
}
});
</script>

<style>

</style>