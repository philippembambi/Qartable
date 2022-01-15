      <!--Formulaire personnel-->
    <div class="modal fade" id="personnel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog cascading-modal modal-avatar modal-xl" role="document">
          <!--Content-->
          <div class="modal-content">
      
            <!--Header-->
            <div class="modal-header">
              <img id="avatar2" src="./images/user.png" class="rounded-circle img-responsive" alt="Avatar photo">
            </div>
            <!--Body-->
            <div class="modal-body text-center mb-1">
      
              <h4 class="mt-1 mb-2" style="font-weight: bold;font-family: leelawadee;">Formulaire  Personnel</h4>
           
              <div class="col-md-12">
      
      <div class="pull-left col-md-8">
      
      <form method="post" action="" name="formulaire" data-theme="a">
  
  <input type="text" name="noms_personnel" id="noms_personnel" placeholder="Noms complet :" autocomplete="off" oninput="validate_string()" data-theme="d"/>
  <span id="errorpupil" style="color: red;font-family: leelawadee;"></span>
      
  <fieldset data-role="collapsible" data-theme="a">
    <legend data-theme="d">Naissance</legend>
    <label for="lieu_personnel">Lieu de naissance :</label>
    <input type="text" name="lieu_personnel" id="lieu_personnel" placeholder="Text input" value="" data-theme="d">
    <label for="date_naissance_personnel" data-theme="d">Date de naissance :</label>
    <input type="date" name="date_naissance_personnel" id="date_naissance_personnel" value="" data-theme="d"/>
  </fieldset>
  
  <select name="sexe_personnel" id="sexe_personnel" data-role="slider" data-theme="a">
        <option value="M">M</option>
        <option value="F">F</option>
    </select>
  
    <fieldset data-role="collapsible" data-theme="a">
    <legend data-theme="d">Coordonnées</legend>
    <label for="adresse">Adresse :</label>
    <input type="text" name="adresse" id="adresse" value="" data-theme="d">

    <label for="tel">Téléphone :</label>
    <input type="tel" name="tel" id="tel" value="+243" data-theme="d">
  </fieldset>
  <br>
  <fieldset id="focntion" data-role="collapsible" data-theme="a">
    <legend>Fonction à remplir</legend>
    <div data-role="controlgroup" data-theme="c">
        <input type="checkbox" name="prefet" id="prefet" value="prefet">
        <label for="prefet">Préfet d'études</label>
        <input type="checkbox" name="DE" id="DE" value="DE">
        <label for="DE">Directeur des études</label>
        <input type="checkbox" name="CP" id="CP" value="CP">
        <label for="CP">Conseiller pédagogique</label>
        <input type="checkbox" name="CO" id="CO" value="CO">
        <label for="CO">Conseiller d'orientation</label>
        <input type="checkbox" name="SEC" id="SEC" value="SEC">
        <label for="SEC">Sécretaire</label>
        <input type="checkbox" name="DD" id="DD" value="DD">
        <label for="DD">Directeur de discipline</label>
   <a href="#">   
        <input type="checkbox" name="enseignant" id="enseignant" value="enseignant">
        <label for="enseignant" >Enseignant</label>
        </a>
    </div>
  </fieldset>
  <br>
  <fieldset id="etudes" data-role="collapsible" data-theme="a">
    <legend>Niveau d'études</legend>
    <div data-role="controlgroup" data-theme="c">
        <input type="checkbox" name="docteur" id="docteur" value="docteur">
        <label for="docteur">Docteur</label>
        <input type="checkbox" name="master" id="master" value="master">
        <label for="master">Master</label>
        <input type="checkbox" name="licence" id="licence" value="licencie">
        <label for="licence">Licencié</label>
        <input type="checkbox" name="graduat" id="graduat" value="graduat">
        <label for="graduat">Graduat</label>
        <input type="checkbox" name="baccalaureat" id="baccalaureat" value="baccalaureat">
        <label for="baccalaureat">Diplomé d'&Eacute;tat</label>
    </div>
  </fieldset>
 
  <div class="text-left mt-4" >
  <button target="_blank" rel="external" class="ui-btn ui-corner-all ui-icon-check ui-btn-icon-left ui-shadow ui-btn-inline ui-btn-a" onclick="enregistrer_personnel()">Valider</button>
      </div>
      </form>
      </div>
      
      <div class="pull-right col-md-4" style="margin-top: -6%">
          <form id="uploadForm2" name="uploadForm2" enctype="multipart/form-data" action="upload2.php" target="uploadFrame2" method="post">
      
      <span style="visibility: hidden;">
      <input type="file" name="uploadFile2" id="uploadFile2" accept="image/*">
    </span>      
    <h6 id="fichier2" name="fichier2"></h6>
    
      <button class="ui-btn ui-corner-all ui-icon-camera ui-btn-icon-left ui-shadow ui-btn-inline ui-btn-a" onclick="document.uploadForm2.uploadFile2.click()">image</button>
      <button id="uploadSubmit2" class="ui-btn ui-corner-all ui-icon-action ui-btn-icon-left ui-shadow ui-btn-inline ui-btn-a" onclick="document.uploadForm2.submit()">Ok</button>  
      </form>
      
      <div id="uploadStatus2">Aucun upload en cours</div>
      <div id="loadingstate2"></div>
      <iframe id="uploadFrame2" name="uploadFrame2" frameborder="0"></iframe>
      </div>
      </div></div></div></div>
      </div> 