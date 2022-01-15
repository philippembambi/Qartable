/*-----------------------------MOTEUR AJAX-----------------------*/  
function creationXHR() { 
    var resultat=null; 
    try { 
        // Test pour les navigateurs : Mozilla, Opera...    
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
                
    function nouveauClient() 
    {  
objetXHR = creationXHR();
var parametresxml = "<client>" +  "<user>" + document.getElementById("user").value + "</user>" + "<mobile>" + document.getElementById("mobile").value + "</mobile>" + "</client>";

objetXHR.open("post", "identification.php?action=NouveauClient", true);
objetXHR.onreadystatechange = actualiserPage;
objetXHR.setRequestHeader("Content-Type", "text/xml");

document.getElementById("submitClient").disabled= true;
document.getElementById("charge").style.visibility="visible";
        
objetXHR.send(parametresxml);//envoi de la requête 
} 
    function actualiserPage()
    {
        if (objetXHR.readyState == 4) { 
            if (objetXHR.status == 200) {  

//--------AFFICHAGE INFO DANS LA CONSOLE-----------
console.info('Etat de readyState :' + objetXHR.readyState + ' - Valeur de responseText :' + objetXHR.responseText); 
      
var Resultat = objetXHR.responseText;   
var info = decodeURI(Resultat);
console.info(info);
document.getElementById("submitClient").disabled= false;
document.getElementById("charge").style.visibility="hidden";
alert("Résultat" + info);
}
    else{    
        // Message d’erreur   
         document.getElementById("messageClient").innerHTML= " Erreur serveur : " +objetXHR.status+ "  -  " + objetXHR.statusText;
         alert(" Erreur serveur : " +objetXHR.status+ "  -  " + objetXHR.statusText)
         
         console.info(" Erreur serveur : " + objetXHR.status + "  -  " + objetXHR.statusText);
         document.getElementById("submitClient").disabled= false;
         document.getElementById("charge").style.visibility="hidden";
         // Annule la requête en cours
         objetXHR.abort();
         objetXHR=null;
        }
    }
}	

    function testerNavigateur() {  
        objetXHR = creationXHR();
        if(objetXHR==null)
        {
            var erreurNavigateur = "Erreur Navigateur : Création d'objet XmlHttpRequest impossible";
            document.getElementById("messageClient").innerHTML = erreurNavigateur;
           alert(erreurNavigateur);
         } 
         }
         
    function loading()
    {
        
    }     
               /*--------------------------FIN DU MOTEUR AJAX-------------------*/ 