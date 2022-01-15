<script type="text/x-template" id="template-header">

<div>

<hr>
<span style="float: left;margin-left: 1%;"><img src="./img/RDC.png" alt="" style="height: 50px;"></span>
<h3 style="text-align: center;font-weight; bolder;text-transform: uppercase;">Republique démocratique du Congo</h3>
          <h4 style="text-align: center;font-weight;">ARCHIDIOCESE DE KINSHASA</h4>
          <br>
          <h4 style="text-align: center;font-weight: bold;">Coordination des écoles conventionnées catholique</h4>
          <h4 style="text-align: center;font-weight; bold;text-transform: uppercase;"> <?php echo $nom_ecole; ?></h4>
<hr>

        </div>

    </script> 


  <script>
 var entete =  Vue.component('file-header', {
    template: '#template-header',
    props: {
      hideClasses: Boolean
    },
    data: function() { 
    return {
    }
},
methods: {

},
created() {
},
activated() {

},
deactivated() {
console.log("Le composant file-header est désactivé !");
},
destroyed() {
console.log("Le composant file-header est détruit !");
}
  });
</script>