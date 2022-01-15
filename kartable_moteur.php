<?php
//============================================================+
// File name   : kartable_moteur.php
// Last Update : 2020-12-26
// Author      : Philippe mbambi Mayele : philippembambi413@gmail.com
// Tout droit réservé à l'auteur. Ceci est une propriété intellectuelle de l'auteur
// -------------------------------------------------------------------
?>

<?php
require("database.php");
include("kartable_debut.php");
include("kartable_functions.php");
include("Kartable_update_exel_db_student.php");
$action = (isset($_GET['action']))?htmlspecialchars($_GET['action']):'';
?>

<?php
class robot_kartable
{
   private $_db; //instance de PDO
   protected $lien;
   protected $curl;

public function __construct($db)
{    
    $this->setDb($db);
}

public function setDb(PDO $db)
{
    $this->_db = $db;
}

public function get_content_page($lien)
{
                                          $this->curl = curl_init($lien);
                                          $time_out = 200;
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

public function nouveau_contrat($responsable, $date_debut, $date_fin, $mois_contrat, $observation, $id_admin)
{
    $q = $this->_db->prepare('INSERT INTO kartable_contrat (noms_responsable, date_debut, mois_debut, temps_reel, echeance_contrat, observation, id_admin) 
    VALUES(:noms_responsable, :date_debut, :mois_debut, :temps_reel, :echeance_contrat, :observation, :id_admin)');
        $q->bindValue(':noms_responsable', $responsable, PDO::PARAM_STR);
           $q->bindValue(':date_debut', $date_debut, PDO::PARAM_STR);
              $q->bindValue(':mois_debut', $mois_contrat, PDO::PARAM_STR);
                 $q->bindValue(':temps_reel', time(), PDO::PARAM_INT);
                    $q->bindValue(':echeance_contrat', $date_fin, PDO::PARAM_STR);
                       $q->bindValue(':observation', $observation, PDO::PARAM_STR);
                          $q->bindValue(':id_admin', $id_admin, PDO::PARAM_INT);
                             $q->execute();
                                $q->CloseCursor();  

$date_debut = strtotime($date_debut);
$date_debut = date('d/m/Y', $date_debut);

$date_fin = strtotime($date_fin);
$date_fin = date('d/m/Y', $date_fin);

$message = 'Nouveau contrat du  '.$date_debut.' au  '. $date_fin.' avec : Nom_école signé avec succès ! ';                                    
header('location: kartable_new_contrat.php?message='.$message);
} 

public function convertir_monnaie($devise_A, $montant, $devise_B, $taux)
{

if($devise_A == "fc" && $devise_B == "usd")
{
$resultat = $montant / $taux;
$resultat = $montant." FC     vaut :     ".$resultat." $";
}
elseif($devise_A == "usd" && $devise_B == "fc")
{
    $resultat = $montant * $taux;
    $resultat = $montant." $     vaut :     ".$resultat." FC";
}
else{
    $resultat = "Une erreur a survenu lors du traitement !";
}
header("location: convertisseur_monnaie.php?resultat=".$resultat);
}

public function payer_personnel($id_personnel, $type_rem, $montant, $devise, $note, $date, $mois, $mois2, $id_admin)
{
    $q = $this->_db->prepare('INSERT INTO kartable_remuneration (type_rem, desc_rem, date_rem, montant_rem, devise_rem, id_personnel, mois_rem, id_admin) 
    VALUES(:type_rem, :desc_rem, :date_rem, :montant_rem, :devise_rem, :id_personnel, :mois_rem, :id_admin)');
        $q->bindValue(':type_rem', $type_rem, PDO::PARAM_STR);
           $q->bindValue(':desc_rem', $note, PDO::PARAM_STR);
              $q->bindValue(':date_rem', $date, PDO::PARAM_STR);
                 $q->bindValue(':montant_rem', $montant, PDO::PARAM_INT);
                    $q->bindValue(':devise_rem', $devise, PDO::PARAM_STR);
                       $q->bindValue(':id_personnel', $id_personnel, PDO::PARAM_INT);
                          $q->bindValue(':mois_rem', $mois, PDO::PARAM_STR);
                             $q->bindValue(':id_admin', $id_admin, PDO::PARAM_INT);
                                $q->execute();
                                   $q->CloseCursor();  

$q = $this->_db->prepare('SELECT noms_personel FROM kartable_personnel WHERE id_personel = :id_personel');
$q->bindValue(':id_personel', $id_personnel, PDO::PARAM_INT);
$q->execute();
$data = $q->fetch();  
    if($devise == "usd")
    {
        $exchange_rate = "$";
    }
    elseif($devise == "fc")
    {
        $exchange_rate = "FC";
    }
    else{
        $exchange_rate = "Francs";
    }

    $message = 'Mr / Mme  '.$data['noms_personel'].'  a été rémunéré (e) d\'un montant de  '.$montant.' '.$exchange_rate.'  pour le mois de  '.$mois2;
    header("location: ./dossier_cmp_paie_salaire/kartable_paie_salaire.php?message=".$message);
}

public function emprunter_argent($id_personnel, $montant, $devise, $note, $date, $id_admin)
{
    $q = $this->_db->prepare('INSERT INTO kartable_emprunt (id_personnel, id_admin, date_emp, montant_emp, devise_emp, note_emp) 
    VALUES(:id_personnel, :id_admin, :date_emp, :montant_emp, :devise_emp, :note_emp)');
        $q->bindValue(':id_personnel', $id_personnel, PDO::PARAM_INT);
           $q->bindValue(':id_admin', $id_admin, PDO::PARAM_INT);
              $q->bindValue(':date_emp', $date, PDO::PARAM_STR);
                 $q->bindValue(':montant_emp', $montant, PDO::PARAM_INT);
                    $q->bindValue(':devise_emp', $devise, PDO::PARAM_STR);
                       $q->bindValue(':note_emp', $note, PDO::PARAM_STR);
                           $q->execute();
                               $q->CloseCursor();  

                                   $q = $this->_db->prepare('SELECT noms_personel FROM kartable_personnel WHERE id_personel = :id_personel');
                                   $q->bindValue(':id_personel', $id_personnel, PDO::PARAM_INT);
                                   $q->execute();
                                   $data = $q->fetch();  
                                   
                                   if($devise == "usd")
                                   {   $exchange_rate = "$";
                                   }
                                   elseif($devise == "fc")
                                   {  $exchange_rate = "FC";
                                   }
                                   else
                                   { $exchange_rate = "Francs";
                                   }
                               
                                   $message = 'L\'emprunt de   '.$montant.' '.$exchange_rate.'   pour Mr / Mme  '.$data['noms_personel'].'  a été enregistré avec succès !';
                                   header("location: kartable_emprunt.php?message=".$message);                                 

}

//Fin de la classe
}

class admin
{
   private $_db; //instance de PDO
   private $a_noms;
   private $a_psw;
   private $a_id;

public function __construct($db)
{    
    $this->setDb($db);
    
} 

public function connecter_admin($psw)
{ 
$this->a_psw = $psw;

$psw_admin = md5($psw);
$q = $this->_db->prepare('SELECT* FROM kartable_admin WHERE psw_admin = :psw');
$q->bindValue(':psw', $psw_admin, PDO::PARAM_STR);
$q->execute();
$data = $q->fetch();
if($data['id_admin'] != 0)
  {   
      
  //Variables de session
                                                    $_SESSION['id_admin'] = $data['id_admin'];
                                                    $id_admin = $data['id_admin'];
            $reposnse = "Identification réussie pour l'adminstrateur ".$data['noms_admin'];
            $code_erreur = '0';
            $resultat = $reposnse.':'.$code_erreur;
            echo $resultat;
  }
 elseif($data['id_admin'] == 0)
  {                       $reposnse = "Mot de passe erroné";
                          $code_erreur = '1';
                          $resultat = $reposnse.':'.$code_erreur;
                          echo $resultat;
            
    
  }
  else {
                          $reposnse = "Une erreur inconnue s'est produite.";
                          $code_erreur = '2';
                          $resultat = $reposnse.':'.$code_erreur;
                          echo $resultat;
  }
}

public function supprimer_recu($id_frais, $id_admin)
{
    $req = $this->_db->prepare('SELECT montant, date_paiement FROM kartable_frais_scolaire WHERE id_frais = :id_frais'); 
    $req->bindValue(':id_frais', $id_frais,PDO::PARAM_INT); 
    $req->execute(); 
    $data = $req->fetch();
    $somme_ignoree = $data['montant'];
    $date_operation = $data['date_paiement'];
    $req->CloseCursor();

    $q = $this->_db->prepare('INSERT INTO kartable_suppression (table_ref_sup, id_ref_sup, date_sup, id_admin_sup, somme_ignoree, date_operation)
    VALUES(:table_ref_sup, :id_ref_sup, :date_sup, :id_admin_sup, :somme_ignoree, :date_operation)'); 
    $q->bindValue(':table_ref_sup', "kartable_frais_scolaire",PDO::PARAM_STR);
    $q->bindValue(':id_ref_sup', $id_frais,PDO::PARAM_INT);
    $q->bindValue(':date_sup', time(),PDO::PARAM_INT);
    $q->bindValue(':id_admin_sup', $id_admin,PDO::PARAM_INT); 
    $q->bindValue(':somme_ignoree', $somme_ignoree,PDO::PARAM_STR);
    $q->bindValue(':date_operation', $date_operation,PDO::PARAM_STR);
    $q->execute(); 
    $q->CloseCursor(); 

    $query = $this->_db->prepare('DELETE FROM kartable_frais_scolaire WHERE id_frais = :id_frais'); 
    $query->bindValue(':id_frais', $id_frais,PDO::PARAM_INT); 
    $query->execute(); 
    $query->CloseCursor(); 
    
    header("location: ".$_SERVER['HTTP_REFERER']);    
}

public function ajouter_cours($id_promo, $id_affectation, $id_jour, $id_heure, $id_admin)
{
    $q = $this->_db->prepare('INSERT INTO kartable_horaire (id_affectation, id_promo, id_jour, heure, id_admin_h, date_enregistrement)
    VALUES(:id_affectation, :id_promo, :id_jour, :heure, :id_admin_h, :date_enregistrement)'); 
    $q->bindValue(':id_affectation', $id_affectation, PDO::PARAM_INT);
    $q->bindValue(':id_promo', $id_promo, PDO::PARAM_INT);
    $q->bindValue(':id_jour', $id_jour, PDO::PARAM_INT);
    $q->bindValue(':heure', $id_heure, PDO::PARAM_INT); 
    $q->bindValue(':id_admin_h', $id_admin, PDO::PARAM_INT);
    $q->bindValue(':date_enregistrement', time(), PDO::PARAM_INT);
    $q->execute(); 
    $q->CloseCursor(); 

    $message = "Cours ajouté à l'horaire avec succès !";
    header("location: cmp_ajouter_cours.php?id_promo=".$id_promo."&message=".$message);
}

public function deconnect_admin($id_admin)
{ 
$q = $this->_db->prepare('DELETE FROM kartable_whosonline WHERE online_id= :id_admin'); 
$q->bindValue(':id_admin', $id_admin,PDO::PARAM_INT); 
$q->execute(); 
$q->CloseCursor(); 

session_destroy();
$id_admin = 0;
$noms_admin = '';
header("location: dialog.php");
}

public function stop_session($id_admin_session)
{ 
$q = $this->_db->prepare('DELETE FROM kartable_whosonline WHERE online_id= :id_admin'); 
$q->bindValue(':id_admin', $id_admin_session,PDO::PARAM_INT); 
$q->execute(); 
$q->CloseCursor(); 
header("location: connected_admin.php");
}

public function register_admin($a_noms, $a_psw, $a_droit_access)
{ 
$psw_encrypted = md5($a_psw);    
$q = $this->_db->prepare('INSERT INTO  kartable_admin (noms_admin, psw_admin) 
VALUES(:noms_admin, :psw_admin)');
    $q->bindValue(':noms_admin', $a_noms, PDO::PARAM_STR);
       $q->bindValue(':psw_admin', $psw_encrypted, PDO::PARAM_STR);
           $q->execute();
              $last_admin = $this->_db->lastInsertId();
                 $q->CloseCursor();  

    $query = $this->_db->prepare('INSERT INTO  kartable_droit_admin (id_d_acces, id_admin) 
    VALUES(:id_d_acces, :id_admin)');
    $query->bindValue(':id_d_acces', $a_droit_access, PDO::PARAM_INT);
    $query->bindValue(':id_admin', $last_admin, PDO::PARAM_INT);
    $query->execute();
    $query->CloseCursor();
             
$message = $a_noms.' enregistré comme administrateur avec succès !';
header("location: kartable_new_admin.php?message=".$message);
}

public function attribuer_droit_access($admin, $droit_access)
{
    $query = $this->_db->prepare('INSERT INTO  kartable_droit_admin (id_d_acces, id_admin) 
    VALUES(:id_d_acces, :id_admin)');
    $query->bindValue(':id_d_acces', $droit_access, PDO::PARAM_INT);
    $query->bindValue(':id_admin', $admin, PDO::PARAM_INT);
    $query->execute();
    $query->CloseCursor();
             
$message = 'Attribution des droits d\'accèss effectuée avec succès  !';
header("location: cmp_droit_access.php?message=".$message);

}

public function supprimer_droit_access($admin, $droit_access)
{
    $query = $this->_db->prepare('DELETE FROM kartable_droit_admin 
    WHERE id_d_acces = :id_d_acces AND id_admin = :id_admin');
    $query->bindValue(':id_d_acces', $droit_access, PDO::PARAM_INT);
    $query->bindValue(':id_admin', $admin, PDO::PARAM_INT);
    $query->execute();
    $query->CloseCursor();
             
$message = 'Suppression des droits d\'accèss effectuée avec succès  !';
header("location: cmp_del_droit_acces.php?message=".$message);
}

public function delete($id_admin_session)
{ 
$q = $this->_db->prepare('DELETE FROM  kartable_admin WHERE id_admin = :id_admin');
    $q->bindValue(':id_admin', $id_admin_session, PDO::PARAM_INT);
      $q->execute();
             $q->CloseCursor();    
$message = "Administrateur supprimé avec succès !";
header("location: connected_admin.php?message=".$message);
}

public function envoyer_msg($id_destinateur, $titre, $msg, $date, $id_admin)
{   
    $q = $this->_db->prepare('INSERT INTO messagerie_privee(id_expediteur, id_destinateur, titre_msg, contenu_msg, date_msg) 
    VALUES(:id_expediteur, :id_destinateur, :titre_msg, :contenu_msg, :date_msg)');
        $q->bindValue(':id_expediteur', $id_admin, PDO::PARAM_INT);
           $q->bindValue(':id_destinateur', $id_destinateur, PDO::PARAM_INT);
              $q->bindValue(':titre_msg', $titre, PDO::PARAM_STR);
                 $q->bindValue(':contenu_msg', $msg, PDO::PARAM_STR);
                    $q->bindValue(':date_msg', $date, PDO::PARAM_STR);
                       $q->execute();
                          $q->CloseCursor();    

                          $q = $this->_db->prepare('SELECT noms_admin FROM kartable_admin WHERE id_admin = :id_destinateur');
                                   $q->bindValue(':id_destinateur', $id_destinateur, PDO::PARAM_INT);
                                   $q->execute();
                                   $data = $q->fetch();  
                                   
    $message = 'Votre message a été envoyé à   '.$data['noms_admin'].'   avec succès !';
    header("location: kartable_messagerie.php?message=".$message);    
}

public function signaler_erreur_frais($id_frais, $id_eleve, $id_admin)
{
$q = $this->_db->prepare('UPDATE kartable_frais_scolaire SET erreur_signalee = "oui", date_erreur_signalee = :temps, id_admin_signal = :id_admin 
WHERE id_frais = :id_frais');

$q->bindValue(':id_frais', $id_frais, PDO::PARAM_INT);
$q->bindValue(':temps', time(), PDO::PARAM_INT);
$q->bindValue(':id_admin', $id_admin, PDO::PARAM_INT);
$q->execute();
$q->CloseCursor();    
                                   
    $message = 'Le reçu de paiement N° '.$id_frais.' a été vérouillé, et sera par conséquent non disponible jusqu\'à ce que toutes les vérifications soit faites.. Veillez contacter l\'administrateur central pour soit supprimer soit déverouiller ledit reçu';
    header("location: ./dossier_cmp_frais_scolaire/cmp_print_recu_frais.php?message=".$message);    
}

public function deverouiller_recu($id_frais)
{
    $q = $this->_db->prepare('UPDATE kartable_frais_scolaire SET erreur_signalee = "" WHERE id_frais = :id_frais');
    
    $q->bindValue(':id_frais', $id_frais, PDO::PARAM_INT);
    $q->execute();
    $q->CloseCursor();    
                                       
    $query = $this->_db->prepare('SELECT kartable_eleves.id_eleve AS id_ref_eleve FROM kartable_frais_scolaire  LEFT JOIN kartable_eleves
    ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve
    WHERE kartable_frais_scolaire.id_frais = :id_frais');
    $query->bindValue(':id_frais', $id_frais, PDO::PARAM_INT);
    $query->execute();
    $data = $query->fetch();

    header("location: ./dossier_cmp_frais_scolaire/cmp_print_recu_frais.php?id_frais=".$id_frais."&id_eleve=".$data['id_ref_eleve']);        
}

public function setDb(PDO $db)
{
    $this->_db = $db;
}
}
//Fin de la classe
?>

<?php
class personnel
{
   private $_db; //instance de PDO
   protected $id_personnel;
   protected $p_noms;
   protected $p_sexe;
   protected $p_lieu_naissance;
   protected $date_naissance;
   protected $p_fonction;
   protected $p_etudes;
   protected $p_adresse;
   protected $p_tel;
   protected $p_image;

public function __construct($db)
{    
    $this->setDb($db);
    
} 

public function enregister_personnel($p_noms, $p_sexe, $p_lieu, $p_date_naiss, $p_fonction, $p_etudes, $p_adresse, $p_tel, $p_image, $id_admin)
{ 
$q = $this->_db->prepare('INSERT INTO kartable_personnel (noms_personel, sexe, lieu_naissance, date_naissance, adresse, tel, fonction, etudes, photo, id_admin) 
VALUES(:noms_personel, :sexe, :lieu_naissance, :date_naissance, :adresse, :tel, :fonction, :etudes, :photo, :id_admin)');
    $q->bindValue(':noms_personel', $p_noms, PDO::PARAM_STR);
       $q->bindValue(':sexe', $p_sexe, PDO::PARAM_STR);
          $q->bindValue(':lieu_naissance', $p_lieu, PDO::PARAM_STR);
             $q->bindValue(':date_naissance', $p_date_naiss, PDO::PARAM_STR);
                $q->bindValue(':adresse', $p_adresse, PDO::PARAM_STR);
                   $q->bindValue(':tel', $p_tel, PDO::PARAM_STR);
                      $q->bindValue(':fonction', $p_fonction, PDO::PARAM_STR);
                         $q->bindValue(':etudes', $p_etudes, PDO::PARAM_STR);
                            $q->bindValue(':photo', $p_image, PDO::PARAM_STR);
                               $q->bindValue(':id_admin', $id_admin, PDO::PARAM_INT);
                                  $q->execute();
                                     $q->CloseCursor();
//$this->id_personnel = $database->lastInsertId();    
echo $p_noms.' enregistré avec succès !';
}

public function affectation_cours($id_enseignant, $id_cours, $id_admin)
{ 
$q = $this->_db->prepare('INSERT INTO affectation_cours (id_enseignant, id_cours, id_admin_affect, date_affect) 
VALUES(:id_enseignant, :id_cours, :id_admin_affect, :date_affect)');
    $q->bindValue(':id_enseignant', $id_enseignant, PDO::PARAM_INT);
    $q->bindValue(':id_cours', $id_cours, PDO::PARAM_INT);
    $q->bindValue(':id_admin_affect', $id_admin, PDO::PARAM_INT);
    $q->bindValue(':date_affect', time(), PDO::PARAM_INT);
                                  $q->execute();
                                     $q->CloseCursor();
//header('location: '.$_SERVER['HTTP_REFERER']);
$message = "Affectation éffectué avec succès !";
header("location: cmp_affecter_cours.php?message=".$message);
}

public function pointer_personnel($id_personnel, $date_pointage, $id_admin)
{ 
$valeur_pointage = 'Oui';    
$mois = date('m', time());

$q = $this->_db->prepare('UPDATE kartable_pointage SET pointe_present = :pointe_present, id_admin_pointe = :id_admin_pointe, mois = :mois
WHERE id_personnel = :id_personnel AND date_pointage = :date_pointage');
$q->bindValue(':pointe_present', $valeur_pointage, PDO::PARAM_STR);
$q->bindValue(':id_personnel', $id_personnel, PDO::PARAM_INT);
$q->bindValue(':date_pointage', $date_pointage, PDO::PARAM_STR);
$q->bindValue(':id_admin_pointe', $id_admin, PDO::PARAM_INT);
$q->bindValue(':mois', $mois, PDO::PARAM_STR);
$q->execute();
//header("location: cmp_pointage.php");
header("location:".$_SERVER['HTTP_REFERER']);
}

public function marquer_nbre_heure($id_personnel, $nbre_heure, $date_pointage)
{    
$q = $this->_db->prepare('UPDATE kartable_pointage SET nbre_heure = :nbre_heure
WHERE id_personnel = :id_personnel AND date_pointage = :date_pointage');
$q->bindValue(':id_personnel', $id_personnel, PDO::PARAM_INT);
$q->bindValue(':date_pointage', $date_pointage, PDO::PARAM_STR);
$q->bindValue(':nbre_heure', $nbre_heure, PDO::PARAM_INT);
$q->execute();
header("location: cmp_pointage.php");
//header("location:".$_SERVER['HTTP_REFERER']);
}

public function setDb(PDO $db)
{
    $this->_db = $db;
}
}
?>


<?php
class tuteur
{
   private $_db; //instance de PDO
   protected $id_tuteur;
   protected $t_noms;
   protected $t_nationalite;
   protected $t_profession;
   protected $t_adresse;
   protected $t_tel;

public function __construct($db)
{    
    $this->setDb($db);
    
} 

public function register_parent($database, $t_noms, $t_nationalite, $t_profession, $t_adresse, $t_tel)
{ 
$q = $database->prepare('INSERT INTO kartable_tuteur (t_noms, t_nationalite, t_profession, t_adresse, t_tel) 
    VALUES(:t_noms, :t_nationalite, :t_profession, :t_adresse, :t_tel)');
    $q->bindValue(':t_noms', $t_noms, PDO::PARAM_STR);
       $q->bindValue(':t_nationalite', $t_nationalite, PDO::PARAM_STR);
          $q->bindValue(':t_profession', $t_profession, PDO::PARAM_STR);
             $q->bindValue(':t_adresse', $t_adresse, PDO::PARAM_STR);
                $q->bindValue(':t_tel', $t_tel, PDO::PARAM_STR);
                   $q->execute();
                      $q->CloseCursor();
$this->id_tuteur = $database->lastInsertId();    

}

public function setDb(PDO $db)
{
    $this->_db = $db;
}
}
?>


<?php
class eleve extends tuteur
{
   private $_db; //instance de PDO

public function __construct($db)
{    
    $this->setDb($db);
    
} 

public function Kartable_update_excel_db_student()
{
    require_once "./PHPExcel/Classes/PHPExcel.php";
    // Ouvrir un fichier Excel en lecture
    $objReader = PHPExcel_IOFactory::createReader('Excel2007');
         $objPHPExcel = $objReader->load("./BD_ECOLE/BD_ECOLE.xlsx");
              $sheet = $objPHPExcel->setActiveSheetIndex(0);
                   $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                        $objWriter->save('./BD_ECOLE/BD_ECOLE.xlsx');
                             require_once "./PHPExcel/Classes/PHPExcel.php";
    // Ouvrir un fichier Excel en lecture
                                  $objReader = PHPExcel_IOFactory::createReader('Excel2007');
                                       $objPHPExcel = $objReader->load("./BD_ECOLE/BD_ECOLE.xlsx");
                                            $sheet = $objPHPExcel->setActiveSheetIndex(0);
                                                 $highestRow = $sheet->getHighestRow(); // e.g. 10 
                                                      $highestColumn = $sheet->getHighestColumn(); // e.g 'F' 
                                                           $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // e.g. 5 

                                     require('database.php');
    $query=$db->prepare('SELECT*  FROM kartable_eleves');
                                  $query->execute();
    for ($row = 3; $row <= $highestRow, $data = $query->fetch(); ++$row) 
    {
      $sheet->setCellValueByColumnAndRow(0, $row, $data['id_eleve']);   
    }
    $query1=$db->prepare('SELECT*  FROM kartable_eleves');
    $query1->execute();
    for ($row = 3; $row <= $highestRow, $data1 = $query1->fetch(); ++$row) 
    {
      $sheet->setCellValueByColumnAndRow(1, $row, $data1['noms_eleve']);   
    }
    $query2=$db->prepare('SELECT*  FROM kartable_eleves');
    $query2->execute();
    for ($row = 3; $row <= $highestRow, $data2 = $query2->fetch(); ++$row) 
    {
      $sheet->setCellValueByColumnAndRow(2, $row, $data2['sexe_eleve']);   
    }
    $query3=$db->prepare('SELECT*  FROM kartable_eleves');
    $query3->execute();
    for ($row = 3; $row <= $highestRow, $data3 = $query3->fetch(); ++$row) 
    {
      $sheet->setCellValueByColumnAndRow(3, $row, $data3['date_naissance']);   
    }
    $query4=$db->prepare('SELECT*  FROM kartable_eleves');
    $query4->execute();
    for ($row = 3; $row <= $highestRow, $data4 = $query4->fetch(); ++$row) 
    {
      $sheet->setCellValueByColumnAndRow(4, $row, $data4['lieu_naissance']);   
    }
    $query5=$db->prepare('SELECT*  FROM kartable_eleves');
    $query5->execute();
    for ($row = 3; $row <= $highestRow, $data5 = $query5->fetch(); ++$row) 
    {
      $sheet->setCellValueByColumnAndRow(5, $row, $data5['classe_eleve']);   
    }
    $query6=$db->prepare('SELECT*  FROM kartable_eleves');
    $query6->execute();
    for ($row = 3; $row <= $highestRow, $data6 = $query6->fetch(); ++$row) 
    {
      $sheet->setCellValueByColumnAndRow(6, $row, $data6['option_eleve']);   
    }
    $query7=$db->prepare('SELECT*  FROM kartable_eleves');
    $query7->execute();
    for ($row = 3; $row <= $highestRow, $data7 = $query7->fetch(); ++$row) 
    {
      $sheet->setCellValueByColumnAndRow(7, $row, $data7['info_supplementaire']);   
    }
    $query8=$db->prepare('SELECT*  FROM kartable_eleves');
    $query8->execute();
    for ($row = 3; $row <= $highestRow, $data8 = $query8->fetch(); ++$row) 
    {
      $sheet->setCellValueByColumnAndRow(8, $row, $data8['photo_eleve']);   
    }
    $query9=$db->prepare('SELECT*  FROM kartable_eleves');
    $query9->execute();
    for ($row = 3; $row <= $highestRow, $data9 = $query9->fetch(); ++$row) 
    {
      $sheet->setCellValueByColumnAndRow(9, $row, $data9['date_inscription']);   
    }
    $query10=$db->prepare('SELECT*  FROM kartable_eleves');
    $query10->execute();
    for ($row = 3; $row <= $highestRow, $data10 = $query10->fetch(); ++$row) 
    {
      $sheet->setCellValueByColumnAndRow(10, $row, $data10['admin_id']);   
    }
    $query11=$db->prepare('SELECT*  FROM kartable_eleves');
    $query11->execute();
    for ($row = 3; $row <= $highestRow, $data11 = $query11->fetch(); ++$row) 
    {
      $sheet->setCellValueByColumnAndRow(11, $row, $data11['promotion_id']);   
    }
    $query12=$db->prepare('SELECT*  FROM kartable_eleves');
    $query12->execute();
    for ($row = 3; $row <= $highestRow, $data12 = $query12->fetch(); ++$row) 
    {
      $sheet->setCellValueByColumnAndRow(12, $row, $data12['id_tuteur']);   
    }
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('./BD_ECOLE/BD_ECOLE.xlsx');
}

public function register_pupil($e_noms, $e_sexe, $e_lieu, $e_date_naiss, $e_classe, $e_option, $e_info, $e_image, $id_admin, $e_promo, $t_noms, $t_nationalite, $t_profession, $t_adresse, $t_tel)
{
$this->register_parent($this->_db, $t_noms, $t_nationalite, $t_profession, $t_adresse, $t_tel);

if($id_admin == 0)
{
 echo 'Veillez vous identifier comme administrateur !';
}
else{
$date = time();
$q = $this->_db->prepare('INSERT INTO kartable_eleves (noms_eleve, sexe_eleve, lieu_naissance, date_naissance, classe_eleve, option_eleve, info_supplementaire, photo_eleve, date_inscription, admin_id, promotion_id, id_tuteur) 
VALUES(:e_noms, :e_sexe, :e_lieu, :e_date_naiss, :e_classe, :e_option, :e_info, :e_photo, :date_inscription, :e_id_admin, :e_promo, :id_tuteur)');
$q->bindValue(':e_noms', $e_noms, PDO::PARAM_STR);
   $q->bindValue(':e_sexe', $e_sexe, PDO::PARAM_STR);
      $q->bindValue(':e_lieu', $e_lieu, PDO::PARAM_STR);
         $q->bindValue(':e_date_naiss', $e_date_naiss, PDO::PARAM_STR);
            $q->bindValue(':e_classe', $e_classe, PDO::PARAM_INT);
               $q->bindValue(':e_option', $e_option, PDO::PARAM_STR);
                  $q->bindValue(':e_info', $e_info, PDO::PARAM_STR);
                     $q->bindValue(':e_photo', $e_image, PDO::PARAM_STR);
                        $q->bindValue(':date_inscription', $date, PDO::PARAM_INT);
                           $q->bindValue(':e_id_admin', $id_admin, PDO::PARAM_INT);
                              $q->bindValue(':e_promo', $e_promo, PDO::PARAM_INT);
                                 $q->bindValue(':id_tuteur', $this->id_tuteur, PDO::PARAM_INT);
                                    $q->execute();
                                       $q->CloseCursor();
                                           $this->Kartable_update_excel_db_student();
echo 'L\'élève '.$e_noms.' enregistré avec succès !';
//header("location: kartable_promo.php?Maclasse=".$e_classe."&Masection=".$e_option);
}
}

public function register_fromExcel($e_noms, $e_sexe, $e_lieu, $e_date_naiss, $e_classe, $e_option, $e_info, $e_image, $id_admin, $e_promo, $id_tuteur, $date_isncription)
{
    $q = $this->_db->prepare('INSERT INTO kartable_eleves (noms_eleve, sexe_eleve, lieu_naissance, date_naissance, classe_eleve, option_eleve, info_supplementaire, photo_eleve, date_inscription, admin_id, promotion_id, id_tuteur) 
    VALUES(:e_noms, :e_sexe, :e_lieu, :e_date_naiss, :e_classe, :e_option, :e_info, :e_photo, :date_inscription, :e_id_admin, :e_promo, :id_tuteur)');
    $q->bindValue(':e_noms', $e_noms, PDO::PARAM_STR);
       $q->bindValue(':e_sexe', $e_sexe, PDO::PARAM_STR);
          $q->bindValue(':e_lieu', $e_lieu, PDO::PARAM_STR);
             $q->bindValue(':e_date_naiss', $e_date_naiss, PDO::PARAM_STR);
                $q->bindValue(':e_classe', $e_classe, PDO::PARAM_INT);
                   $q->bindValue(':e_option', $e_option, PDO::PARAM_STR);
                      $q->bindValue(':e_info', $e_info, PDO::PARAM_STR);
                         $q->bindValue(':e_photo', $e_image, PDO::PARAM_STR);
                            $q->bindValue(':date_inscription', $date_isncription, PDO::PARAM_STR);
                               $q->bindValue(':e_id_admin', $id_admin, PDO::PARAM_INT);
                                  $q->bindValue(':e_promo', $e_promo, PDO::PARAM_INT);
                                     $q->bindValue(':id_tuteur', $id_tuteur, PDO::PARAM_INT);
                                        $q->execute();
                                           $q->CloseCursor();
header("location:".$_SERVER['HTTP_REFERER']);    
}

public function delete_pupil($id_eleve)
{
    $q = $this->_db->prepare('DELETE FROM kartable_eleves WHERE id_eleve = :id_eleve');
    $q->bindValue(':id_eleve', $id_eleve, PDO::PARAM_STR);
    $q->execute();
    $q->CloseCursor();
    header("location:".$_SERVER['HTTP_REFERER']);
}

public function pointer_eleve($id_eleve, $date_pointage, $id_admin, $id_promo)
{
    $valeur_pointage = 'Oui';    
    $q = $this->_db->prepare('UPDATE kartable_registre_appel SET pointe_present = :pointe_present, id_admin_pointe = :id_admin_pointe
    WHERE id_eleve = :id_eleve AND date_pointage = :date_pointage');
    $q->bindValue(':pointe_present', $valeur_pointage, PDO::PARAM_STR);
    $q->bindValue(':id_eleve', $id_eleve, PDO::PARAM_INT);
    $q->bindValue(':date_pointage', $date_pointage, PDO::PARAM_STR);
    $q->bindValue(':id_admin_pointe', $id_admin, PDO::PARAM_INT);
    $q->execute();
    header("location: cmp_registre_appel.php?id_promo=".$id_promo);    
}

public function payer_frais($id_eleve, $montant_frais, $devise, $Motif, $descMotif, $Modalite, $descModalite, $id_admin)
{
    $mois = date('m', time());

    $q = $this->_db->prepare('INSERT INTO kartable_frais_scolaire (id_eleve, montant, modalite, desc_modalite, motif, desc_motif, id_admin, date_paiement, devise, mois) 
    VALUES(:id_eleve, :montant, :modalite, :desc_modalite, :motif, :desc_motif, :id_admin, :date_paiement, :devise, :mois)');
    $q->bindValue(':id_eleve', $id_eleve, PDO::PARAM_INT);
       $q->bindValue(':montant', $montant_frais, PDO::PARAM_INT);
          $q->bindValue(':modalite', $Modalite, PDO::PARAM_STR);
             $q->bindValue(':desc_modalite', $descModalite, PDO::PARAM_STR);
                $q->bindValue(':motif', $Motif, PDO::PARAM_STR);
                   $q->bindValue(':desc_motif', $descMotif, PDO::PARAM_STR);
                      $q->bindValue(':id_admin', $id_admin, PDO::PARAM_INT);
                         $q->bindValue(':date_paiement', date('Y/m/d', time()), PDO::PARAM_STR);
                            $q->bindValue(':devise', $devise, PDO::PARAM_STR);
                               $q->bindValue(':mois', $mois, PDO::PARAM_STR);
                                  $q->execute();
                                     $q->CloseCursor();
                                        $id_frais = $this->_db->lastInsertId();  
           
//$message = " ".$noms['noms_eleve'];
header("location: ./dossier_cmp_frais_scolaire/cmp_print_recu_frais.php?id_eleve=".$id_eleve."&id_frais=".$id_frais);    
}
public function setDb(PDO $db)
{
    $this->_db = $db;
}
}
?>


<?php
switch($action)
{

case "connectadmin":

    if(!empty($_GET['psw']))
{
   $psw = $_GET['psw'];
   $new_admin = new admin($db);
   $new_admin->connecter_admin($psw);
}
   else 
{
   echo "Mot de passe vide";
}
break;
?>

<?php
case "deletePupil":
$id_eleve = $_GET['id_eleve'];
$eleve = new eleve($db);
$eleve->delete_pupil($id_eleve);
break;
?>


<?php
case "registerpupil":
    
    $parametresXml = file_get_contents('php://input'); 
    //création d'un objet Simple Xml à partir des paramètres récupérés 
    $objetSimpleXML = simplexml_load_string($parametresXml); 
  
    //Les variables récupérées
    $t_noms = $objetSimpleXML->nomsTuteur;
    $t_nationalite = $objetSimpleXML->nationaliteTuteur;
    $t_profession = $objetSimpleXML->professionTuteur;
    $t_adresse = $objetSimpleXML->adresseTuteur;
    $t_tel = $objetSimpleXML->telTuteur;

    $e_noms = $objetSimpleXML->noms;
    $e_sexe = $objetSimpleXML->sexe; 
    $e_lieu = $objetSimpleXML->lieu;
    $e_date_naiss = $objetSimpleXML->date;
    $e_classe = $objetSimpleXML->classe;
    $e_option = $objetSimpleXML->option;
    $e_info = $objetSimpleXML->infos;
    //Traitement de l'image
    $e_image = $objetSimpleXML->photo;

    $e_promo = 0;
    if($e_classe == 1 && $e_option == "secondaire")
    {
        $e_promo = 1;
    }
    else if($e_classe == 2 && $e_option == "secondaire")
    {
        $e_promo = 2;
    }
    //La troisième année
    else if($e_classe == 3 && $e_option == "latinphilo")
    {
        $e_promo = 3;
    }
    else if($e_classe == 3 && $e_option == "biochimie")
    {
        $e_promo = 7;
    }
    else if($e_classe == 3 && $e_option == "commerciale")
    {
        $e_promo = 11;
    }
    //La quatrième année
    else if($e_classe == 4 && $e_option == "latinphilo")
    {
        $e_promo = 4;
    }
    else if($e_classe == 4 && $e_option == "biochimie")
    {
        $e_promo = 8;
    }
    else if($e_classe == 4 && $e_option == "commerciale")
    {
        $e_promo = 12;
    }
    //La cinquième année
    else if($e_classe == 5 && $e_option == "latinphilo")
    {
        $e_promo = 5;
    }
    else if($e_classe == 5 && $e_option == "biochimie")
    {
        $e_promo = 9;
    }
    else if($e_classe == 5 && $e_option == "commerciale")
    {
        $e_promo = 13;
    }
    //La sixième année
    else if($e_classe == 6 && $e_option == "latinphilo")
    {
        $e_promo = 6;
    }
    else if($e_classe == 6 && $e_option == "biochimie")
    {
        $e_promo = 10;
    }
    else if($e_classe == 6 && $e_option == "commerciale")
    {
        $e_promo = 14;
    }
    else 
    {
        $e_promo = 0;
    }
    
    $new_pupil = new eleve($db);
    $new_pupil->register_pupil($e_noms, $e_sexe, $e_lieu, $e_date_naiss, $e_classe, $e_option, $e_info, $e_image, $id_admin, $e_promo, $t_noms, $t_nationalite, $t_profession, $t_adresse, $t_tel);

break;
?>

<?php
case "enregistrerPersonnel":
    
    $parametresXml = file_get_contents('php://input'); 
    //création d'un objet Simple Xml à partir des paramètres récupérés 
    $objetSimpleXML = simplexml_load_string($parametresXml); 
  
    $p_noms = $objetSimpleXML->noms;
    $p_sexe = $objetSimpleXML->sexe; 
    $p_lieu = $objetSimpleXML->lieu;
    $p_date_naiss = $objetSimpleXML->date;
    $p_adresse = $objetSimpleXML->adresse;
    $p_tel = $objetSimpleXML->tel;
    $p_fonction = $objetSimpleXML->fonction;
    $p_etudes = $objetSimpleXML->etudes;

    //image
    $p_image = $objetSimpleXML->photo;

    $new_personnel = new personnel($db);
    $new_personnel->enregister_personnel($p_noms, $p_sexe, $p_lieu, $p_date_naiss, $p_fonction, $p_etudes, $p_adresse, $p_tel, $p_image, $id_admin);

break;
?>


<?php
case "affectationCours":
    $id_enseignant = $_POST['enseignant'];
    $id_cours = $_POST['cours'];

    $new_personnel = new personnel($db);
    $new_personnel->affectation_cours($id_enseignant, $id_cours, $id_admin);

break;
?>

<?php
case "deconnectAdmin":

    $user = new admin($db);
    $user->deconnect_admin($id_admin);

break;
?>

<?php
case "registerAdmin":

    $user = new admin($db);
    $user->register_admin($_POST['nomAdmin'], $_POST['motdepasseAdmin'], $_POST['droit_access']);

break;
?>

<?php
case "stopSession":
    $id_admin_session = $_GET['id_admin_session'];
    $user = new admin($db);
    $user->stop_session($id_admin_session);

break;
?>

<?php
case "deleteAdmin":
    $id_admin_session = $_GET['id_admin_session'];
    $user = new admin($db);
    $user->delete($id_admin_session);

break;
?>

<?php
case "pointerPersonnel":
    $id_personel = (int) $_GET['id_personel'];
    $date_pointage = $_GET['date_pointage'];
    
    $personnel = new personnel($db);
    $personnel->pointer_personnel($id_personel, $date_pointage, $id_admin);

break;
?>

<?php
case "marquer_nbre_heure_personnel":
    $id_personel = (int) $_GET['id_personel'];
    $date_pointage = $_GET['date_pointage'];
    $nbre_heure = $_POST['nbre_heure'];
    
    $personnel = new personnel($db);
    $personnel->marquer_nbre_heure($id_personel, $nbre_heure, $date_pointage);

break;
?>

<?php
case "pointerElevel":
    $id_eleve = (int) $_GET['id_eleve'];
    $id_promo = (int) $_GET['id_promo'];
    $date_pointage = $_GET['date_pointage'];
    
    $eleve = new eleve($db);
    $eleve->pointer_eleve($id_eleve, $date_pointage, $id_admin, $id_promo);

break;
?>


<?php
case "payerFrais":
    $id_eleve = (int) $_POST['eleve'];
    $montant_frais = (int) $_POST['montant_frais'];
    $devise = $_POST['devise'];
    $Motif = $_POST['Motif'];
    $descMotif = $_POST['descMotif'];
    $Modalite = $_POST['Modalite'];
    $descModalite = $_POST['descModalite'];

    $eleve = new eleve($db);
    $eleve->payer_frais($id_eleve, $montant_frais, $devise, $Motif, $descMotif, $Modalite, $descModalite, $id_admin);

break;
?>

<?php
case "convertir_monnaie":
    $devise_A = $_POST['devise_A'];
    $montant = (int) $_POST['montant'];
    $devise_B = $_POST['devise_B'];
    $taux = (int) $_POST['taux'];

    $monnaie = new robot_kartable($db);
    $monnaie->convertir_monnaie($devise_A, $montant, $devise_B, $taux);

break;
?>

<?php
case "payer_personnel":
    $id_personnel = $_POST['personnel'];
    $type_rem = $_POST['type_rem'];
    $montant = (int) $_POST['montant'];
    $devise = $_POST['devise'];
    $note = $_POST['note'];
    $timestamp = time();
    $date = date('d/m/Y', $timestamp);
//Obtenir le mois à partir du timestamp
    $mois = date('Y/m', $timestamp);
    $mois2 = date('m/Y', $timestamp);

    $paie = new robot_kartable($db);
    $paie->payer_personnel($id_personnel, $type_rem, $montant, $devise, $note, $date, $mois, $mois2, $id_admin);

break;
?>

<?php
case "emprunter_argent":
    $id_personnel = $_POST['personnel'];
    $montant = (int) $_POST['montant'];
    $devise = $_POST['devise'];
    $note = $_POST['note'];
    $timestamp = time();
    $date = date('d/m/Y', $timestamp);

    $emprunt = new robot_kartable($db);
    $emprunt->emprunter_argent($id_personnel, $montant, $devise, $note, $date, $id_admin);

break;
?>

<?php
case "envoyer_msg":
    $id_destinateur = $_POST['destinateur'];
    $titre = $_POST['titre'];
    $msg = $_POST['msg'];
    $msg = codeBb($msg);

    $timestamp = time();
    $date = date('d/m/Y \à H:m:s', $timestamp);

    $message = new admin($db);
    $message->envoyer_msg($id_destinateur, $titre, $msg, $date, $id_admin);

break;
?>

<?php
case "crawl_page":
    $lien = $_GET['lien'];

    $page = new robot_kartable($db);
    $page->get_content_page($lien);
break;
?>

<?php
case "nouveau_contrat":
    $responsable = $_POST['responsable'];

    $date_debut = $_POST['date_debut'];
    $date_debut = str_replace("-", "/", $date_debut);

    $date_fin = $_POST['date_fin'];
    $date_fin = str_replace("-", "/", $date_fin);

    $observation = $_POST['observation'];

//$timestamp = strtotime($date);
$mois_contrat = date('Y/m',time());

    $contrat = new robot_kartable($db);
    $contrat->nouveau_contrat($responsable, $date_debut, $date_fin, $mois_contrat, $observation, $id_admin);
break;
?>

<?php
case "signaler_erreur":
    $id_frais = $_GET['id_recu'];
    $id_eleve = $_GET['id_eleve'];

    $frais = new admin($db);
    $frais->signaler_erreur_frais($id_frais, $id_eleve, $id_admin);
break;
?>

<?php
case "deverouiller_recu":
    if($var_root == 'none' && $var_mod == 'none')
    {
    $type_erreur = 'Erreur Root-Mod::'.crc32($var_root.$var_mod);   
    $msg = 'Vous n\'avez pas le droit de modification  !';
    header('location: ./cmp_erreur.php?type='.$type_erreur.'&msg='.$msg);
    }
    else{
    $id_frais = $_GET['id_frais'];
    $frais = new admin($db);
    $frais->deverouiller_recu($id_frais);
    }
break;
?>

<?php
case "supprimer_recu":
    if($var_root == 'none' && $var_del == 'none')
    {
    $type_erreur = 'Erreur Root-Del::'.crc32($var_root.$var_del);    
    $msg = 'Vous n\'avez pas le droit de suppression  !';
    header('location: ./cmp_erreur.php?type='.$type_erreur.'&msg='.$msg);
    }
    else{
    $id_frais = $_GET['id_frais'];

    $frais = new admin($db);
    $frais->supprimer_recu($id_frais, $id_admin);
    }
break;
?>

<?php
case "ajouter_cours":
    $id_promo = $_GET['id_promo'];
    $id_affectation = $_POST['id_affectation'];
    $id_jour = $_POST['id_jour'];
    $id_heure = $_POST['id_heure'];

    $cours = new admin($db);
    $cours->ajouter_cours($id_promo, $id_affectation, $id_jour, $id_heure, $id_admin);
break;
?>

<?php
case "attribuer_droit_access":
    if($var_root == 'none')
    {
    $type_erreur = 'Erreur Root::'.crc32($var_root);    
    $msg = 'Vous n\'êtes pas autorisé d\'effectuer cette action !';
    header('location: ./cmp_erreur.php?type='.$type_erreur.'&msg='.$msg);
    }
    else{
        $admin = $_POST['admin'];
        $droit_access = $_POST['droit_access'];
    
        $droit_admin = new admin($db);
        $droit_admin->attribuer_droit_access($admin, $droit_access);
    }
  
break;
?>


<?php
case "supprimer_droit_access":
    if($var_root == 'none')
    {
    $type_erreur = 'Erreur Root::'.crc32($var_root);    
    $msg = 'Vous n\'êtes pas autorisé d\'effectuer cette action !';
    header('location: ./cmp_erreur.php?type='.$type_erreur.'&msg='.$msg);
    }
    else{
        $admin = $_POST['admin'];
        $droit_access = $_POST['droit_access'];
    
        $droit_admin = new admin($db);
        $droit_admin->supprimer_droit_access($admin, $droit_access);
    }
  
break;
?>

<?php
default:
    header("location: index.php");
break;
?>

<?php } ?>