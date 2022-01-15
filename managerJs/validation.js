function validation1()
{
 var user = document.getElementById('user').value;
 
 if(user == "")
    {
        document.getElementById('erroruser').innerHTML = "nom d'utilisateur vide";
        return false;
    }

 if((user.length <= 2) || (user.length >15))
    {
        document.getElementById('erroruser').innerHTML = "nom d'utilisateur ne doit être composé que de 3 à 15 lettres";
        return false;
    }
    else{
     document.getElementById('erroruser').innerHTML = "";
          
var myregex = /[0-9]/;

    if(myregex.test(user))
    {
        document.getElementById('erroruser').innerHTML = "Les chiffres sont exclus";
        return false;
    }
    else{
     document.getElementById('erroruser').innerHTML = "";
     return false;
    }

    }
  } 

function validation2()
{
 var psw = document.getElementById('pass').value;
 var user = document.getElementById('user').value;
 
 if(psw == "")
    {
        document.getElementById('errorpass').innerHTML = "mot de passe vide";
        return false;
    }
    if((psw.length < 3) || (psw.length >6))
    {
        document.getElementById('errorpass').innerHTML = "mot de passe doit être composé de 3 à 6 caractères";
        return false;
    }
    else{
     document.getElementById('errorpass').innerHTML = "";
        return false;
    }
} 

function validation3()
{
var psw = document.getElementById('pass').value;
var confirmpsw = document.getElementById('confirmpass').value;

if(psw == "")
    {
        document.getElementById('errorpass').innerHTML = "mot de passe vide";
        return false;
    }


if(confirmpsw == "")
    {
        document.getElementById('errorconfirmpass').innerHTML = "mot de passe de confirmation vide";
        return false;
    } 
    
    if(psw != confirmpsw)
    {
        document.getElementById('errorconfirmpass').innerHTML = "mot de passe différent";
        return false;
    }
    else{
     document.getElementById('errorconfirmpass').innerHTML = "";
        return false;
    }
}

function validation4()
{
var mobile = document.getElementById('mobile').value;
if(mobile == "")
    {
        document.getElementById('errormobile').innerHTML = "numéro de téléphone vide";
        return false;
    } 
    if(isNaN(mobile))
    {
        document.getElementById('errormobile').innerHTML = "les lettres et autres caractères sont exclus";
        return false;
    }
    if(mobile.length != 10)
    {
        document.getElementById('errormobile').innerHTML = "numéro de téléphone ne doit contenir que 10 chiffres";
        return false;
    }
    else{
     document.getElementById('errormobile').innerHTML = "";
        return false;
    }
}

function validation5()
{ var email = document.getElementById('email').value;


   if(email == "")
    {
        document.getElementById('erroremail').innerHTML = "adresse email vide";
        return false;
    } 

    if((email.charAt(email.length-4) != '.') && (email.charAt(email.length-3) != '.'))
    {
        document.getElementById('erroremail').innerHTML = "position invalide de point (.) dans votre adresse email";
        return false;
    } 
    else{
     document.getElementById('erroremail').innerHTML = "";
        return false;
    }

    if(email.indexOf('@') <= 0)
    {
        document.getElementById('erroremail').innerHTML = "le symbole '@' manque soit est mal placé dans votre adresse email";
        return false;
    } 
    else{
     document.getElementById('erroremail').innerHTML = "";
        return false;
    }
  }


function validation()
{
    var user = document.getElementById('user').value;
    var psw = document.getElementById('pass').value;
    var confirmpsw = document.getElementById('confirmpass').value;
    var mobile = document.getElementById('mobile').value;
    var email = document.getElementById('email').value;


    if(user == "")
    {
        document.getElementById('erroruser').innerHTML = "nom d'utilisateur vide";
        return false;
    }

    if((user.length <= 2) || (user.length >15))
    {
        document.getElementById('erroruser').innerHTML = "nom d'utilisateur ne doit être composé que de 3 à 15 lettres";
        return false;
    }

    if(!isNaN(user))
    {
        document.getElementById('erroruser').innerHTML = "nom d'utilisateur ne doit pas contenir des chiffres";
        return false;
    }


    if(psw == "")
    {
        document.getElementById('errorpass').innerHTML = "mot de passe vide";
        return false;
    }
    if((psw.length < 3) || (psw.length >6))
    {
        document.getElementById('errorpass').innerHTML = "mot de passe doit être composé de 3 à 6 chiffres";
        return false;
    }


    if(confirmpsw == "")
    {
        document.getElementById('errorconfirmpass').innerHTML = "mot de passe de confirmation vide";
        return false;
    } 
    
    if(psw != confirmpsw)
    {
        document.getElementById('errorconfirmpass').innerHTML = "mot de passe différent";
        return false;
    }

    if(mobile == "")
    {
        document.getElementById('errormobile').innerHTML = "numéro de téléphone vide";
        return false;
    } 
    if(isNaN(mobile))
    {
        document.getElementById('errormobile').innerHTML = "numéro de téléphone ne doit contenir que de chiffres";
        return false;
    }
    if(mobile.length != 10)
    {
        document.getElementById('errormobile').innerHTML = "numéro de téléphone ne doit contenir que 10 chiffres";
        return false;
    }


    if(email == "")
    {
        document.getElementById('erroremail').innerHTML = "adresse email vide";
        return false;
    } 
    if(email.indexOf('@') <= 0)
    {
        document.getElementById('erroremail').innerHTML = "le symbole @ manque dans votre adresse email";
        return false;
    } 

    if((email.charAt(email.length-4) != '.') && (email.charAt(email.length-3) != '.'))
    {
        document.getElementById('erroremail').innerHTML = "position invalide de point (.) dans votre adresse email";
        return false;
    }
    
}