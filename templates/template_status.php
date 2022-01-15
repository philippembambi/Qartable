<script type="text/x-template" id="template-status-server">
  <div class="panel panel-success">
    <div class="panel-heading">
      <h3 class="panel-title"><strong><i class=" fa fa-desktop fa-2x"></i>&nbsp; Serveur MYSQL</strong></h3>
    </div>
<div class="panel-body">         
<p>* Etat du serveur  était : <strong> {{ etat }} </strong></p>
<p>* Etat du serveur  devient : <strong> {{ EtatProps }} </strong> </p>
<hr>
<p style="display: block;">
<button @click="ChangerEtat" class="btn btn-success"><i class="fa fa-compress"></i> Changer</button>
<button @click="ResetValue" class="btn btn-success"><i class=" fa fa-spinner"></i> Initialiser</button>
<button @click="callbackFn" class="btn btn-success"><i class=" fa fa-reply"></i> Call Back</button>
</p>
</div>
</div>
</script>


<script type="text/x-template" id="template-cmp-sever">
  <div class="panel panel-primary">
    <div class="panel-body">
* L'état du serveur est : <strong> {{ CallbackEtat }} </strong>
<div class="block">
<button @click="initState" class="btn btn-primary"><i class="fa fa-spinner"></i> Initialiser</button>
</div>
  </div> </div>
</script>

<script>
  /*__ */
Vue.component('app-statut-serveur', {
  template: '#template-status-server',
  data: function() {
    return {
        etat: 'Crtique'
    }
},
props: {
    EtatProps: String,
    callbackFn: Function
       },
methods: {
    ChangerEtat() {
        this.etat = 'Normal';
    },
    inverserLettre() {

      return this.EtatProps.split("").reverse().join(""); //Inverser les caractères
    },
    ResetValue() {
        this.EtatProps = 'La valeur a été initialisé dans le serveur MYSQL';
        this.$emit('valeurInitialiser', this.EtatProps); //emetteur d'évenement 
    }
},
created() {
    eventBus.$on('StateWasInit', (NouveauStatut) => {
        this.etat = NouveauStatut;
    })
}
});

/*__*/
Vue.component('app-cmp-serveur', {
  template: '#template-cmp-sever',
  props: {
    CallbackEtat: String
},
data: function() {
    return {
  Serveurs: ['Apaache', 'Node', 'TomCat']
    }
},
methods: {
    Ajouter() {
 this.Serveurs.push('TomCat2');
    },

    initState() {
 this.CallbackEtat = "L'Etat du serveur a été initialisé dans le composant 3";
 eventBus.$emit('StateWasInit', this.CallbackEtat);       
//this.$emit('InitState', this.CallbackEtat);
    }
  }
});
</script>