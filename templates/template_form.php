<script type="text/x-template" id="template-form">
  <div style="margin-left: 2%;margin-right: 2%;">
    <form>
            <label for="user">Noms complets</label>
    <input type="text" id="user" class="form-control" v-model="client" required>
            
            <label for="sold">Solde</label>
    <input type="text" id="sold" class="form-control" v-model="soldes" placeholder="" required autofocus>
    <label for="sold">Devise</label><br>
    <select name="devise" id="devise" class="input-select" style="width:100%;" required autofocus>
    <option value="$">$</option>
    <option value="£">£</option>
    <option value="FC">FC</option>
    </select>
            <br><br>
    <button class="btn btn-lg btn-success btn-block" type="submit" v-on:click.prevent="AddClient">Ajouter</button>
     </form>   
     </div>  
    
</script>

<script>
          /*__ Core du composant form__ */
Vue.component('app-form', {
template: '#template-form',
data: function() {
  return {
      client: '',
      soldes: 0
  }
},
methods: {
  AddClient: function() {
      this.$emit('ClientAjoute', this.client);
      this.client = '';
      this.$emit('SoldeAjoute', this.soldes);
      this.soldes = 0;
  }
}
});
</script>

<style>

</style>