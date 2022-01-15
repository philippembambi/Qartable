<script type="text/x-template" id="template-form">
  <!--Formulaire eleve-->
  <div class="modal fade" id="eleve1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
      aria-hidden="true">
      <div class="modal-dialog cascading-modal modal-avatar modal-xl" role="document">
        <!--Content-->
        <div class="modal-content">
    
          <!--Header-->
          <div class="modal-header">
            <img id="avatar" src="./images/user_blue.png" class="rounded-circle img-responsive" alt="Avatar photo">
          </div>
          <!--Body-->
          <div class="modal-body text-center mb-1">
    
            <h4 class="mt-1 mb-2" style="font-weight: bold;font-family: leelawadee;">Formulaire Elève</h4>
         
            <div class="col-md-12">
    
    <div class="pull-left col-md-8">
    
    <form method="post" action="" name="formulaire" data-theme="c">

<input type="text" name="noms_eleve" id="noms_eleve" placeholder="Noms complet :" autocomplete="off" oninput="validate_string()" data-theme="d"/>
<span id="errorpupil" style="color: red;font-family: leelawadee;"></span>
    
<fieldset data-role="collapsible" data-theme="c">
  <legend data-theme="d">Naissance</legend>
  <label for="lieu">Lieu de naissance :</label>
  <input type="text" name="lieu" id="lieu" placeholder="Text input" value="" data-theme="d">
  <label for="date_naissance" data-theme="d">Date de naissance :</label>
  <input type="date" name="date_naissance" id="date_naissance" value="" data-theme="d"/>
</fieldset>

<select name="sexe" id="sexe" data-role="slider" data-theme="c">
      <option value="M">M</option>
      <option value="F">F</option>
  </select>


<fieldset id="promotion" data-role="collapsible" data-theme="c">
  <legend>Promotion</legend>
  <label for="textinput-f">Entrer la classe :</label>
  <input type="number" pattern="[1-6]*" name="classe" id="classe" placeholder="" value="" data-theme="d">
  <div data-role="controlgroup" data-theme="c">
      <input type="checkbox" name="options" id="option1" value="secondaire">
      <label for="option1">Secondaire</label>
      <input type="checkbox" name="options" id="option2" value="biochimie">
      <label for="option2">Chimie-Biologie</label>
      <input type="checkbox" name="options" id="option3" value="latinphilo">
      <label for="option3">Latin-Philo</label>
      <input type="checkbox" name="options" id="option4" value="commerciale">
      <label for="option4">Commerciale Informatique</label>
      
  </div>
</fieldset>

<fieldset data-role="collapsible" data-theme="c">
  <legend>Informations sur le tuteur</legend>
  <input type="text" name="t_noms" id="t_noms" placeholder="Noms :" data-theme="d" oninput="validate_string2()">
  <span id="errortutor" style="color: red;font-family: leelawadee;"></span>
  <input type="text" name="t_nationalite" id="t_nationalite" placeholder="Nationalité :" data-theme="d">
  <input type="text" name="t_profession" id="t_profession" placeholder="Profession" data-theme="d">
  <input type="text" name="t_adresse" id="t_adresse" placeholder="N° / Avenue / Quartier / Commune / Ville" data-theme="d">
  <input type="text" name="t_tel" id="t_tel" placeholder="+243" autocomplete="off" oninput="validate_number()" onblur="validate_DRC()" data-theme="d">
  <span id="error_tel" style="color: red;font-family: leelawadee;"></span>
</fieldset>
    
    <textarea name="infos" id="infos" class="form-control" placeholder="Informations complémentaires rélatives à l'élève..." data-theme="d"></textarea>
   
    <div class="text-left mt-4" >
    
<button class="ui-btn ui-corner-all ui-icon-check ui-btn-icon-left ui-shadow ui-btn-inline ui-btn-b" onclick="register_people()">Valider</button>
    </div>
    </form>
    </div>
    
    <div class="pull-right col-md-4" style="margin-top: -6%">
        <form id="uploadForm" name="uploadForm" enctype="multipart/form-data" action="upload.php" target="uploadFrame" method="post">
    
    <span style="visibility: hidden;">
    <input type="file" name="uploadFile" id="uploadFile" accept="image/*">
  </span>      
  <h6 id="fichier" name="fichier"></h6>
  
    <button class="ui-btn ui-corner-all ui-icon-camera ui-btn-icon-left ui-shadow ui-btn-inline ui-btn-b" onclick="document.uploadForm.uploadFile.click()">image</button>
    <button id="uploadSubmit" class="ui-btn ui-corner-all ui-icon-action ui-btn-icon-left ui-shadow ui-btn-inline ui-btn-b" onclick="document.uploadForm.submit()">Ok</button>  
    </form>
    
    <div id="uploadStatus">Aucun upload en cours</div>
    <div id="loadingstate"></div>
    <iframe id="uploadFrame" name="uploadFrame"></iframe>
    </div>
    </div></div></div></div>
    </div> 
</script> 


  <script>
 var formulaire =  Vue.component('app-formulaire', {
    template: '#template-form',
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
console.log("Le composant formulaire est désactivé !");
},
destroyed() {
console.log("Le composant formulaire est détruit !");
}
  });
</script>