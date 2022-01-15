    function validate_DRC()
{
    var t_tel = document.getElementById('t_tel').value;
    var myregex = /^(0(8|9))(\d{8})$/;

    if(!myregex.test(t_tel))
    {
        document.getElementById('error_tel').innerHTML = "Format de numéro incorrect";
        return false;
 
    }

}

function validate_string()
{
 var eleve = document.getElementById('noms_eleve').value;
 
 if(eleve == "")
    {
        document.getElementById('errorpupil').innerHTML = "Le nom ne peut pas être vide";
        return false;
    }

 if((eleve.length <= 5) || (eleve.length >25))
    {
        document.getElementById('errorpupil').innerHTML = "Le nom ne doit être composé que de 5 à 25 lettres";
        return false;
    }
    else
    {
        document.getElementById('errorpupil').innerHTML = "";
     
var myregex = /[0-9]/;

    if(myregex.test(eleve))
    {
        document.getElementById('errorpupil').innerHTML = "Les chiffres sont exclus";
        return false;
    }
}
 
} 

function validate_string2()
{
 var tuteur = document.getElementById('t_noms').value;
 
 if(tuteur == "")
    {
        document.getElementById('errortutor').innerHTML = "Le nom ne peut pas être vide";
        return false;
    }

 if((tuteur.length <= 5) || (tuteur.length >15))
    {
        document.getElementById('errortutor').innerHTML = "Le nom ne doit être composé que de 5 à 25 lettres";
        return false;
    }
    else
    {
        document.getElementById('errortutor').innerHTML = "";
     
var myregex = /[0-9]/;

    if(myregex.test(tuteur))
    {
        document.getElementById('errortutor').innerHTML = "Les chiffres sont exclus";
        return false;
    }
}
 
} 


function validate_number()
{
    var t_tel = document.getElementById('t_tel').value;
    
    if(t_tel == "")
    {
        document.getElementById('error_tel').innerHTML = "numéro de téléphone vide";
        return false;
    } 
    if(isNaN(t_tel))
    {
        document.getElementById('error_tel').innerHTML = "les lettres et autres caractères sont exclus";
        return false;
    }
    if(t_tel.length != 10)
    {
        document.getElementById('error_tel').innerHTML = "numéro de téléphone ne doit contenir que 10 chiffres";
        return false;
    }
    else{
     document.getElementById('error_tel').innerHTML = "";
        return false;
    }

}