<script type="text/x-template" id="template-admin">
    <div class="col-sm-4">
      <div class="panel panel-primary">
          <div class="panel-heading">
                        <h3 class="panel-title">
              <span class="block" style="">
                <span class="infobulle_options"><a class="info" href="#" style="margin-left: 5%;">
                  <strong><i class="fa fa-user fa-2x"></i> &nbsp;Admin</strong><span>
                    <i style="color: white;">Par : </i><b style="color: yellow;">Monseigneur Philippe Mbambi</b><br /><br />
                    <i style="color: white;">Nom de l'H&ocirc;te : </i><b style="color: yellow;">127.0.0.1</b><i>*</i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i style="color: white;">Port : </i><b style="color: yellow;">80</b><i>**</i>
                    <p  style="color: black;font-size: 12px;color: lightskyblue;">
                      Using components in Vue.js </p>
                      <p style="color: black;font-size: 12px;color: white;">
                       Voici une demo simple de l'utilisation de Vue.j comme bibliothèque
                        <br> 
                        <p style="color: black;font-size: 12px;color: white;">
                       Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus repudiandae reprehenderit cumque molestias rem, magnam eum alias provident corrupti ut minima eos earum dolore sequi fugit saepe aperiam nam esse! </p>         
                    <div>Afficher ou modifier les param&egrave;tres</div>
                </span></a></span>         
                <span class="text-primary"></span> 
            </span>

            <strong style="float: right;">Composant Parent</strong></h3>
          </div>
          <div class="panel-body">

    <label for="inputEmail">Connectez-vous avec votre Adresse Email</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus v-on:input="submitAdmin">
        <button class="btn btn-primary"><i class="fa fa-search"></i></button>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me" v-on:click="keepConnecting"> Se souvenir de moi
          </label>
        </div>
     <!--   <button v-on:click="printdata" class="btn btn-lg btn-primary btn-block">Se connecter</button>-->
<hr>
     <strong> * {{ infoAfter }}</strong>

  <h4><span style="color: red;">{{ TotalClient }}</span> enregistrés</h4>
 
</div>

<!--Appel au nouveau composant app-customer-->
<app-customer 
             v-bind:TurnConnection="connected" 
             v-on:clientadded="TotalClient = $event"
             v-on:clientremoved="TotalClient = $event">
</app-customer>
   
</script>

<script>
 var admin =  Vue.component('app-admin', {
    template: '#template-admin',
    data: function() { 
    return {
        info: '',
       infoAfter: '',
       connected: 'Off',
       AdminList: {nom: 'philippembambi413@gmail.com'},
       cookies: false,
       TotalClient: 0,
       selectedCmp: 'app-admin'
    }
},
methods: {
    submitAdmin: function(event) {
if(event.target.value == this.AdminList.nom || this.cookies == true)
{
this.cookies = false;       
this.info = 'Admin connecté avec succès !';
this.connected = 'ON';
this.printdata();
}

else 
{
   this.info = 'Aucune correspondance !';
   this.connected = 'Off';
   this.printdata();
}         
    },

    printdata: function() {
        this.infoAfter = this.info
        return this.infoAfter
    },

keepConnecting: function(event) {
if(this.connected == 'ON')
{
this.cookies = true;
alert('cookies créés avec succès');
       }
else 
{
 this.cookies = false;
}          
              }

},
//components: {'app-customer': Customer},
activated() {
console.log("Le composant parent Admin est activé !");
},
deactivated() {
console.log("Le composant parent Admin est désactivé !");
},
destroyed() {
console.log("Le composant parent Admin est détruit !");
}
  });
</script>

<style>
  
</style>