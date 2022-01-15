<?php
$action = (isset($_GET['action']))?htmlspecialchars($_GET['action']):'';
?>

<?php
switch($action)
{ 
    case "NouveauClient":

?>

<?php
$parametresXml = file_get_contents('php://input');
$objetSimpleXML = simplexml_load_string($parametresXml);
$nomsxml = $objetSimpleXML->user;
$mobilexml = $objetSimpleXML->mobile;
?>

<?php
 sleep(12);
class personne
{    
     private $_db; //instance de PDO
 
public function __construct($db)
{    
     $this->setDb($db);
     
} 
 public function add($name, $tel)
 { //Ajout d'un client
   $q = $this->_db->prepare('INSERT INTO client (client_noms, client_telephone)
   VALUES (:pseudo, :tel)');
   $q->bindValue(':pseudo', $name, PDO::PARAM_STR);
   $q->bindValue(':tel', $tel, PDO::PARAM_INT);
   $q->execute();
 }
 public function setDb(PDO $db)
 {
     $this->_db = $db;
 }
//Supppression d'un client
 public function delete($id)
 {
     $this->_db->exec('DELETE FROM client WHERE client_id = '.$id);
 }
 //La liste complète des clients
 public function getList()
 {
     $clients = [];
     $q = $this->_db->query('SELECT client_id, client_noms, client_telephone FROM client ORDER BY client_id');
     while($data = $q->fetch(PDO::FETCH_ASSOC))
     {
        $clients = $clients[$data];
     }
     return $clients;
 }
}
?>

<?php
$db = new PDO('mysql:host=127.0.0.1;dbname=manager', 'root', '');
$NewClient = new personne($db);
$NewClient->add($nomsxml, $mobilexml);
unset($NewClient);
$resultat = "La réquête a abouti";
echo $resultat;
break;
}
?>



<?php
switch($action)
{ 
    case "NouvelArticle":
?>

<?php
$parametresXml = file_get_contents('php://input');
$objetSimpleXML = simplexml_load_string($parametresXml);
//Attribution des variables xml
$Libelle = $objetSimpleXML->libelle;
$Prix_unitaire = $objetSimpleXML->prix_unitaire;
$Description_libelle = $objetSimpleXML->description;
$genre = $objetSimpleXML->genre;
?>

<?php
class article
{   private $date;
    private $titre;
    private $contenu;
    private $auteur;
     private $_db; //instance de PDO
 
public function __construct($db)
{    
     $this->setDb($db);
     
} 
 public function add($tag, $price, $desc, $gender)
 { //Ajout d'un article
   $q = $this->_db->prepare('INSERT INTO article (article_libelle, article_prix_unitaire, 
   article_description, article_genre) VALUES (:libelle, :prix, :descript, :genre)');
   $q->bindValue(':libelle', $tag, PDO::PARAM_STR);
   $q->bindValue(':prix', $price, PDO::PARAM_INT);
   $q->bindValue(':descript', $desc, PDO::PARAM_STR);
   $q->bindValue(':genre', $gender, PDO::PARAM_STR);
   $q->execute();
 }
 public function setDb(PDO $db)
 {
     $this->_db = $db;
 }
//Supppression d'un client
 public function delete($id)
 {
     $this->_db->exec('DELETE FROM article WHERE article_id = '.$id);
 }
 //La liste complète des clients
 public function getList()
 {
    $articles = [];
     $q = $this->_db->query('SELECT article_libelle, article_prix_unitaire, 
     article_description, article_genre FROM article ORDER BY article_id');
     while($data = $q->fetch(PDO::FETCH_ASSOC))
     {
        $articles = $articles[$data];
     }
     return $articles;
 }
}
?>

<?php
$db = new PDO('mysql:host=127.0.0.1;dbname=manager', 'root', '');
$NewArticle = new article($db);
$NewArticle->add($Libelle, $Prix_unitaire, $Description_libelle, $genre);
unset($NewArticle);
break;
}
?>





<?php
switch($action)
{ 
    case "NouvelArticle":
    $chemin = 'C:/article_texte.txt';
    $db = new PDO('mysql:host=127.0.0.1;dbname=manager', 'root', '');  
    $db->exec('LOAD DATA INFILE "‪E:\EXCEL\article.xlsx" INTO TABLE `article`');
?>


<?php break; } ?>