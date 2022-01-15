<?php
class robot_crawler
{
  protected $lien;
  public $curl;

  public function  __construct()
{

}

public function visit_website($lien)
{
                                            $this->lien = $lien;
                                            curl_setopt($this->curl, CURLOPT_URL, $this->lien);
                                            curl_setopt($this->curl, CURLOPT_COOKIESESSION, true);
                                            curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
                                            $return = curl_exec($this->curl);
                                            curl_close($this->curl);
}

public function post_connexion($lien, $donnees)
{
    $this->lien = $lien;
    curl_setopt($this->curl, CURLOPT_URL, $this->lien);  
    curl_setopt($this->curl, CURLOPT_COOKIESESSION, true);  
    curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($this->curl, CURLOPT_POST, true);
    curl_setopt($this->curl, CURLOPT_POSTFIELDS, $donnees);
    curl_exec($this->curl);
    $result = curl_exec($this->curl);
    echo $result;
    curl_close($this->curl);
    //$ok = 'Connexion OK !';
    //$ko = 'Connexion KO !';
   //return !preg_match('#Username and Password do not match#i', $return)?$ok:$ko;
}

public function Keep_connexion($lien)
{
                              $this->lien = $lien;
                              $path_cookie = 'fichier_temporaire';
if(!file_exists(realpath($path_cookie)))
{
                              touch($path_cookie);
                              curl_setopt($this->curl, CURL_COOKIEJAR, realpath($path_cookie));
  }
}

public function get_data($lien)
{
                              $this->curl = curl_init($lien);
                              curl_setopt($this->curl, CURLOPT_URL, $this->lien);
                              curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
                              curl_setopt($this->curl, CURLOPT_HEADER, false);
                              $result = curl_exec($this->curl);
                              curl_close($this->curl);
                              echo $result;
}

//Web spider function
public function crawl_it($lien)
{
  $this->curl = curl_init($lien);
  //Créer un fichier texte pour stocker le contenu crawlé
  if(file_exists('fichier_html_brut.txt'))
  {
    unlink('fichier_html_brut.txt');
  }

  $fp_fichier_html_brut = fopen('fichier_html_brut.txt', 'a');
  //Rédiger l'output dans le fichier txt
  curl_setopt($this->curl, CURLOPT_FILE, $fp_fichier_html_brut);
 //On spécifie d'ignorer les headers HTTP
 curl_setopt($this->curl, CURLOPT_HEADER, 0);
 curl_exec($this->curl);
 fclose($fp_fichier_html_brut);
 //Passage du contenu du fichier à une variable pour analyse
 $html_brut = file_get_contents('fichier_html_brut.txt');
 //extraction des emails
 preg_match_all('#"mailto:.+"#U', $html_brut, $adresse_mail);
 //Création d'un fichier pour recevoir des emails
 $fp_fichier_emails = fopen('fichier_mails.txt', 'a');
 //On crée une boucle pour placer tous les mails de la page dans le fichier
 foreach($adresse_mail[0] as $element)
 {
      //On nettoye les mails en enlevant les guillemets et le "mailto"
      $element = preg_replace('#"#','', $element);
      $element = preg_replace('#mailto:#', '', $element);
      //Ajouter un retour chariot en fin de ligne pour avoir 1 mail / ligne
      $element .= "\n";
      fputs($fp_fichier_emails, $element);
 } 
 fclose($fp_fichier_emails);
 //Extraction des liens
 preg_match_all('#"/?[a-zA-Z0-9_./-]+\.(php|html|htm)"#', $html_brut, $liens_existants);
 //Si le fichier contenant des liens existe déjà
 if(file_exists('liens_a_suivre.txt'))
 {
  $fp_fichier_liens = fopen('liens_a_suivre.txt', 'a');
  
  foreach($liens_extraits[0] as $element)
  {
    $gestion_doublons = file_get_contents('liens_a_suivre.txt');
    //On enlève les "" qui entourent les liens
    $element = preg_replace('#"#', '', $element);
    $follow_url = $element;
    $follow_url .= "\n";
    //Création d'un pattern pour la vérification des doublons
    $pattern = '#'.$follow_url.'#';
    //On vérifie grâce au pattern précedemment créé que le lien qu'on vient de capturer n'est pas déjà dans le fichier
    if(!preg_match($pattern, $gestion_doublons))
    {
      fputs($fp_fichier_liens, $follow_url);
    }
  }
 }
else{
  $fp_fichier_liens = fopen('liens_a_suivre.txt', 'a');
  
  foreach($liens_extraits[0] as $element)
  {
    $element = preg_replace('#"', '', $element);
    $follow_url .= "\n";
    fputs($fp_fichier_liens, $follow_url);
    fclose($fp_fichier_liens);
  }
  crawl_it($lien);
  //ensuite on ouvre le fichier des liens pour visiter les autres pages du site
  $lire_autres_pages = fopen('liens_a_suivre.txt', 'r');
  //on rée une boucle pour visiter chacun des liens , o stope quand le curseur arrive à le fin du fichier
  $num_de_ligne = 1;
  while(!feof('liens_a_suivre.txt'))
  {
     $page_suivante = $this->lien;
     $page_suivante .= fgets($lire_autres_pages);
     echo $num_de_ligne.'Analyse en cours, page : '.$page_suivante;
     $num_de_ligne++;
     crawl_it($page_suivante);
  }
  fclose($lire_autres_pages);
}

}

public function get_content_page($lien)
{
                                          $this->curl = curl_init($lien);
                                          $time_out = 120;
                                          curl_setopt($this->curl, CURLOPT_FRESH_CONNECT, true);
                                          curl_setopt($this->curl, CURLOPT_TIMEOUT, $time_out);
                                          curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
                                          curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, 0);
                                          curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, true);
                                          curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
                                          $page_content = curl_exec($this->curl);
                                          curl_close($this->curl);
                                          echo $page_content;
 }


}

//Le robot va s'inscrire comme client dans le site de vente en ligne Soliphaire SARL
//$Objet_robot = new robot_crawler();
//$lien = 'http://www.soliphaire.smeeta.us/identification.php';
//$data = array(  'noms' => 'Robot_Crawler',  'adresse' => 'Kotoko 101 Masina mapela',  'tel' => '826686661');
//$Objet_robot->post_connexion($lien, $data);
//unset($Objet_robot);

//Le robot va m'afficher la page d'acceuil de google
$lien = 'https://www.unicef.org/congo/';
$Objet_robot = new robot_crawler();
$Objet_robot->get_content_page($lien);
unset($Objet_robot);
?>