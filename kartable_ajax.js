/*---------------------------MOTEUR AJAX DE KARTABLE By Philippe Mbambi Mayele : philippembambi413@gmail.com -----------------------*/  
function creationXHR() 
{ // fonction générique de l'instiaciation de l'objet XmlHttpRequest
    var resultat=null; 
    try { 
        // Test pour les navigateurs : Mozilla, Opera, safari...    
        resultat= new XMLHttpRequest();
        }
        catch (Error)
        { try { 
            // Test pour les navigateurs Internet Explorer > 5.0     
            resultat= new ActiveXObject("Msxml2.XMLHTTP"); }
            catch (Error) {
                try { // Test pour le navigateur Internet Explorer 5.0
                resultat= new ActiveXObject("Microsoft.XMLHTTP"); }
                catch (Error) { resultat= null; 
                } }  }
                return resultat;
             }


//Connexion de l'administrateur             
function connect_admin() 
{ 
      //Définir les variables de cookies js
                                                                        objetXHR = creationXHR();   
                                   var psw_admin = document.getElementById("motdepasse").value;  
objetXHR.open("get","kartable_moteur.php?action=connectadmin&psw="+psw_admin, true); 
objetXHR.onreadystatechange = actualiser_admin;
objetXHR.send(null);
}

function actualiser_admin()
{
if (objetXHR.readyState == 4) { 
 if (objetXHR.status == 200) {  

    var resultat = objetXHR.responseText.split(":");
    var reponse = decodeURI(resultat[0]);
    var code_erreur = decodeURI(resultat[1]);
 //  alert(reponse);  
//   console.log(reponse);
if(code_erreur == '0')
{
  // localStorage.setItem('adminPsw', document.getElementById("motdepasse").value);
   window.open('./index.php');   
}
else{
   window.open('./dialog.php?erreur=true');

}

}
    else{    
         alert(" Erreur serveur : " + objetXHR.status + "  -  " + objetXHR.statusText);
         objetXHR.abort();
         objetXHR = null;
        }
    }
              
    }

    function open_promotion() 
    {  
                                                                           objetXHR = creationXHR();   
                                        var Maclasse = document.getElementById("Maclasse").value;
                                       // var Masection = document.getElementById("Masection").value; 
    objetXHR.open("get","kartable_redirection.php?action=voirpromo&id_promo="+Maclasse, true); 
    //objetXHR.onreadystatechange = actualiser_promo;
    objetXHR.send(null);
    }   

    function actualiser_promo()
{
if (objetXHR.readyState == 4) { 
 if (objetXHR.status == 200) {  

}
    else{    
         alert(" Erreur serveur : " + objetXHR.status + "  -  " + objetXHR.statusText);
         objetXHR.abort();
         objetXHR = null;
        }
    }
              
    }

 //Simuler l'attente du serveur   
 function make_sleep()
 {
                       objetXHR = creationXHR();   
objetXHR.open("get","kartable_sleep.php", false); 
objetXHR.send(null);
 }
 
function print_pdf()
{
                       objetXHR = creationXHR();   
                       var parametresxml = "<eleve>" +  
                       "<noms>" + document.getElementById("noms_eleve").value + "</noms>" + 
                       "<date>" + document.getElementById("date_naissance").value + "</date>" +   
                       "<lieu>" + document.getElementById("lieu").value + "</lieu>" + 
                       "<sexe>" + document.getElementById("sexe").value + "</sexe>" +
                       "<classe>" + document.getElementById("classe").value + "</classe>" +
                       "<option>" + option + "</option>" +
                       "<infos>" + document.getElementById("infos").value + "</infos>" +
                       "<nomsTuteur>" + document.getElementById("t_noms").value + "</nomsTuteur>" +
                       "<nationaliteTuteur>" + document.getElementById("t_nationalite").value + "</nationaliteTuteur>" +
                       "<professionTuteur>" + document.getElementById("t_profession").value + "</professionTuteur>" +
                       "<adresseTuteur>" + document.getElementById("t_adresse").value + "</adresseTuteur>" +
                       "<telTuteur>" + document.getElementById("t_tel").value + "</telTuteur>" +
                       "<photo>" + fichier + "</photo>" +  
                       "</eleve>";
                       objetXHR.open("post", "kartable_print_pdf.php?action=formulaire_eleve", true);
                       
                       objetXHR.onreadystatechange = init_pdf;
                       objetXHR.setRequestHeader("Content-Type", "text/xml");
                       objetXHR.send(parametresxml);  
}


function init_pdf()
 {
    if (objetXHR.readyState == 4) { 
    if (objetXHR.status == 200) {  
    
    console.info('Etat de readyState :' + objetXHR.readyState); 
    var rep = objetXHR.responseText;   
    alert(rep);      
 }
else{    
     console.info(" Erreur serveur : " + objetXHR.status + "  -  " + objetXHR.statusText);
     alert(" Erreur serveur : " + objetXHR.status + "  -  " + objetXHR.statusText)
     objetXHR.abort();
     objetXHR=null;
    }
 }
}


 function register_people()
 { 
      var option = null;
     var fichier = document.getElementById("fichier").innerHTML;
    objetXHR = creationXHR();
    if(document.getElementById("option1").checked == true)
    {
    option = document.getElementById("option1").value;
    }
    else if(document.getElementById("option2").checked == true)
    {
    option = document.getElementById("option2").value;
    }
    else if(document.getElementById("option3").checked == true)
    {
    option = document.getElementById("option3").value;
    }
    else if(document.getElementById("option4").checked == true)
    {
    option = document.getElementById("option4").value;
    }
    else {
        option = "Non définie";
    }
    var parametresxml = "<eleve>" +  
    "<noms>" + document.getElementById("noms_eleve").value + "</noms>" + 
    "<date>" + document.getElementById("date_naissance").value + "</date>" +   
    "<lieu>" + document.getElementById("lieu").value + "</lieu>" + 
    "<sexe>" + document.getElementById("sexe").value + "</sexe>" +
    "<classe>" + document.getElementById("classe").value + "</classe>" +
    "<option>" + option + "</option>" +
    "<infos>" + document.getElementById("infos").value + "</infos>" +
    "<nomsTuteur>" + document.getElementById("t_noms").value + "</nomsTuteur>" +
    "<nationaliteTuteur>" + document.getElementById("t_nationalite").value + "</nationaliteTuteur>" +
    "<professionTuteur>" + document.getElementById("t_profession").value + "</professionTuteur>" +
    "<adresseTuteur>" + document.getElementById("t_adresse").value + "</adresseTuteur>" +
    "<telTuteur>" + document.getElementById("t_tel").value + "</telTuteur>" +
    "<photo>" + fichier + "</photo>" +  
    "</eleve>";
    objetXHR.open("post", "kartable_moteur.php?action=registerpupil", true);

    objetXHR.onreadystatechange = init_people;
    objetXHR.setRequestHeader("Content-Type", "text/xml");
    objetXHR.send(parametresxml);
 }

 function init_people()
 {
    if (objetXHR.readyState == 4) { 
        if (objetXHR.status == 200) {  

    console.info('Etat de readyState :' + objetXHR.readyState); 
    var rep = objetXHR.responseText;   
    alert(rep);
    window.open("./index.php");      
 }
else{    
     console.info(" Erreur serveur : " + objetXHR.status + "  -  " + objetXHR.statusText);
     alert(" Erreur serveur : " + objetXHR.status + "  -  " + objetXHR.statusText)
     objetXHR.abort();
     objetXHR=null;
    }
 }
}


function enregistrer_personnel()
{ 
    objetXHR = creationXHR(); // Objet Ajax
   
    var fichier2 = document.getElementById("fichier2").innerHTML;
    
   var fonction = null;
   if(document.getElementById("prefet").checked == true)
   {
    fonction = document.getElementById("prefet").value;
   }
   else if(document.getElementById("DE").checked == true)
   {
    fonction = document.getElementById("DE").value;
   }
   else if(document.getElementById("CP").checked == true)
   {
    fonction = document.getElementById("CP").value;
   }
   else if(document.getElementById("CO").checked == true)
   {
    fonction = document.getElementById("CO").value;
   }
   else if(document.getElementById("SEC").checked == true)
   {
    fonction = document.getElementById("SEC").value;
   }
   else if(document.getElementById("DD").checked == true)
   {
    fonction = document.getElementById("DD").value;
   }
   else if(document.getElementById("enseignant").checked == true)
   {
    fonction = document.getElementById("enseignant").value;
   }
   else {
    fonction = "";
   }

   var etudes = null;
   if(document.getElementById("docteur").checked == true)
   {
    etudes = document.getElementById("docteur").value;
   }
   else if(document.getElementById("master").checked == true)
   {
    etudes = document.getElementById("master").value;
   }
   else if(document.getElementById("licence").checked == true)
   {
    etudes = document.getElementById("licence").value;
   }
   else if(document.getElementById("graduat").checked == true)
   {
    etudes = document.getElementById("graduat").value;
   }
   else if(document.getElementById("baccalaureat").checked == true)
   {
    etudes = document.getElementById("baccalaureat").value;
   }
   else {
    etudes = "";
   }

   var parametresxml = "<personnel>" +  
   "<noms>" + document.getElementById("noms_personnel").value + "</noms>" + 
   "<date>" + document.getElementById("date_naissance_personnel").value + "</date>" +   
   "<lieu>" + document.getElementById("lieu_personnel").value + "</lieu>" + 
   "<sexe>" + document.getElementById("sexe_personnel").value + "</sexe>" +
   "<adresse>" + document.getElementById("adresse").value + "</adresse>" +
   "<tel>" + document.getElementById("tel").value + "</tel>" +
   "<fonction>" + fonction + "</fonction>" +
   "<etudes>" + etudes + "</etudes>" +
   "<photo>" + fichier2 + "</photo>" +  
   "</personnel>";
   objetXHR.open("post", "kartable_moteur.php?action=enregistrerPersonnel", true);

   objetXHR.onreadystatechange = init_personnel;
   objetXHR.setRequestHeader("Content-Type", "text/xml");
   objetXHR.send(parametresxml);
}

function init_personnel()
{
   if (objetXHR.readyState == 4) { 
       if (objetXHR.status == 200) {  

   console.info('Etat de readyState :' + objetXHR.readyState); 
   var rep = objetXHR.responseText;   
   alert(rep);
   window.open("./index.php");      
}
else{    
    console.info(" Erreur serveur : " + objetXHR.status + "  -  " + objetXHR.statusText);
    alert(" Erreur serveur : " + objetXHR.status + "  -  " + objetXHR.statusText)
    objetXHR.abort();
    objetXHR=null;
   }
}
}

function affectation_cours()
 {
    objetXHR.open("post", "kartable_moteur.php?action=affectationCours", true);
 
     var form = new FormData();
     form.append('enseignant', document.getElementById("enseignant").value);
     form.append('cours', document.getElementById("cours").value);

    objetXHR.onreadystatechange = init_affectation;
    objetXHR.send(form);
 }

 function init_affectation()
 {
    if (objetXHR.readyState == 4) { 
        if (objetXHR.status == 200) {  

    console.info('Etat de readyState :' + objetXHR.readyState); 
    var rep = objetXHR.responseText;   
    alert(rep);
    window.open("./index.php");      
 }
else{    
     console.info(" Erreur serveur : " + objetXHR.status + "  -  " + objetXHR.statusText);
     alert(" Erreur serveur : " + objetXHR.status + "  -  " + objetXHR.statusText)
     objetXHR.abort();
     objetXHR=null;
    }
 }
}

function testerNavigateur() {
 checkconnxion();  
 objetXHR = creationXHR();
    if(objetXHR == null)
    {
        var erreurNavigateur = "Erreur Navigateur : Création d'objet XmlHttpRequest impossible, veillez utiliser un navigateur compatible.";
           alert(erreurNavigateur);
            }
              }

               /*--------------------------FIN DU MOTEUR AJAX by Philippe Mbambi Mayele : philippembambi413@gmail.com-------------------*/ 