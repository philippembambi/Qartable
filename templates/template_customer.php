<!--Template client-->
<script type="text/x-template" id="template-customer">
  <div>
          <div class="panel panel-success">
                      <!-- Side Modal Bottom Right Danger-->
              <div class="modal fade right" id="sideModalBRDangerDemo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true" data-backdrop="false">
                <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
                  <!--Content-->
                  <div class="modal-content">
                    <!--Body-->
                    <div class="modal-body">

                        <div style="text-align: center;">
                          <p style="font-size: 16px;">Vous venez de supprimer un client.</p>
                        </div>
                    </div>

                    <!--Footer-->
                    <div class="modal-footer justify-content-center">
                      <a role="button" class="btn btn-danger" data-dismiss="modal">OK
                        <i class="far fa-gem ml-1"></i>
                      </a>
                    </div>
                  </div>
                  <!--/.Content-->
                </div>
              </div>
              <!-- Side Modal Bottom Right Danger-->


          <div class="panel-heading">
            <h3 class="panel-title">
              <strong><i class="fa fa-male" style="font-size: 25px;"></i> &nbsp; Client</strong> 
              <span style="float: right;color:red;">{{ TurnConnection }}</span>
            </h3>
          </div>
 <!--Voici la condition permettant d'afficher ou de cacher le contenu app-customer-->         
 <transition 
name="fade"
appear
enter-active-class="animated swing"
leave-active-class="animated shake"
>
<div class="panel-body" v-if="TurnConnection == 'ON'">
         
<button v-on:click="show = !show">Click me</button>
<transition 
name="fade"
appear
enter-active-class="animated bounce"
leave-active-class="animated shake"
>
<div class="alert alert-info" role="alert" v-if="show">
        <strong>Heads up!</strong> This alert needs your attention, but it's not super important.
</div>
</transition>

<transition name="slide">
<div class="alert alert-danger" role="alert" v-if="show">
        <strong>Heads up!</strong> This alert needs your attention, but it's not super important.
</div>
</transition>

         
          <table class="table table-striped">
            <thead>
              <tr>
                <th>id</th>
                <th>Noms</th>
                <th>Solde</th>
                <th>Supprimer</th>
              </tr>
            </thead>
            <tbody>
<transition 
name="fade"
appear
enter-active-class="animated bounce"
leave-active-class="animated wobble"
>
              <tr v-for="(client, index) in clients" :key="solde">
                <td>{{ index+1 }}</td>
                <td>{{ client }}</td>
                <td v-for="solde in soldes">{{ solde }}</td>
                <td><button class="btn btn-success" @click="deleteClient(index)" data-toggle="modal" data-target="#sideModalBRDangerDemo"><img src="../img/Trash_Can_100px.png" style="height: 20px;"></button></td>
              </tr>
</transition>              
            </tbody>
          </table>

<app-form v-on:ClientAjoute="customerNom($event)" v-on:SoldeAjoute="customerSolde($event)"></app-form>
       
        </div>

</div>
</transition>
</div></div>

</script>

<script>
  /*__ Core du composant client__ */
  Vue.component('app-customer', {
    template: '#template-customer',
      props: {
      TurnConnection: String
    },
data: function() {
  return {
      clients: [php_client],
      soldes: [php_solde],
      connectError: 'Off',
      show: false          
  }
},
methods: {
 customerNom(client) {
   this.clients.push(client);
   this.$emit('clientadded', this.clients.length);

 },
 customerSolde(Mysolde) {
 this.soldes = [];
 this.soldes.push(Mysolde);
 },
 deleteClient(index) {
   this.clients.splice(index, 1);
   this.soldes.splice(index, 1);
   this.$emit('clientremoved', this.clients.length);
 }
}
  });  
</script>

<style>
.fade-enter {
  opacity: 0;
}
.fade-enter-active {
  transition: opacity 1s;
}
.fade-leave {

}
.fade-leave-active {
  transition: opacity 1s;
  opacity: 0;
}
.slide-enter {

}
.slide-enter-active {

}
.slide-leave {

}
.slide-leave-active {
  animation: slide-out 1s ease-out forwards;
}
@keyframes slide-in {
  from {
    transform: translateY(20px);
  }
  to {
    transform: translateY(0);

  }
}
@keyframes slide-out {
  from {
    transform: translateY(0);
  }
  to {
    transform: translateY(20px);

  }
}
</style>