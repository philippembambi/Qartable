<?php
session_start();
require('database.php');

//Attribution des variables de session
$id_admin = (isset($_SESSION['id_admin']))?(int) $_SESSION['id_admin']:0;
$noms_admin = (isset($_SESSION['noms_admin']))?$_SESSION['noms_admin']:'';

if($id_admin != 0)
{
    $temps = time();
    $query=$db->prepare('UPDATE kartable_admin SET date_last_connetion = :temps WHERE id_admin = :ident');
    $query->bindValue(':temps', $temps, PDO::PARAM_INT);
    $query->bindValue(':ident', $_SESSION['id_admin'], PDO::PARAM_INT);
    $query->execute();
}
?>

<?php
$ip = ip2long($_SERVER['REMOTE_ADDR']); 
//Requête 
$query=$db->prepare('INSERT INTO kartable_whosonline VALUES(:id, :time, :ip) ON DUPLICATE KEY UPDATE online_time = :time , online_id = :id'); 
$query->bindValue(':id', $id_admin, PDO::PARAM_INT); 
$query->bindValue(':time',time(), PDO::PARAM_INT); 
$query->bindValue(':ip', $ip, PDO::PARAM_INT); 
$query->execute(); 
$query->CloseCursor(); 
?>

<?php 
$time_max = time() - (60 * 5); 
$query=$db->prepare('DELETE FROM kartable_whosonline WHERE online_time < :timemax'); 
$query->bindValue(':timemax', $time_max, PDO::PARAM_INT); 
$query->execute(); 
$query->CloseCursor(); 

//Droit de root 
$query_root=$db->prepare('SELECT * FROM kartable_droit_acces LEFT JOIN kartable_droit_admin
ON kartable_droit_acces.id_d_acces = kartable_droit_admin.id_d_acces LEFT JOIN kartable_admin
ON kartable_droit_admin.id_admin = kartable_admin.id_admin 
WHERE kartable_droit_admin.id_admin = :id_admin AND kartable_droit_acces.d_acces = "root" '); 
$query_root->bindValue(':id_admin', $id_admin, PDO::PARAM_INT); 
$query_root->execute(); 
$data_root = $query_root->fetch();
$query_root->CloseCursor();
$var_root = (!empty($data_root['d_acces']))?htmlspecialchars($data_root['d_acces']):'none';

//Droit de modification 
$query_mod=$db->prepare('SELECT * FROM kartable_droit_acces LEFT JOIN kartable_droit_admin
ON kartable_droit_acces.id_d_acces = kartable_droit_admin.id_d_acces LEFT JOIN kartable_admin
ON kartable_droit_admin.id_admin = kartable_admin.id_admin 
WHERE kartable_droit_admin.id_admin = :id_admin AND kartable_droit_acces.d_acces = "mod" '); 
$query_mod->bindValue(':id_admin', $id_admin, PDO::PARAM_INT); 
$query_mod->execute(); 
$data_mod = $query_mod->fetch();
$query_mod->CloseCursor();
$var_mod = (!empty($data_mod['d_acces']))?htmlspecialchars($data_mod['d_acces']):'none';

//Droit de suppression 
$query_del=$db->prepare('SELECT * FROM kartable_droit_acces LEFT JOIN kartable_droit_admin
ON kartable_droit_acces.id_d_acces = kartable_droit_admin.id_d_acces LEFT JOIN kartable_admin
ON kartable_droit_admin.id_admin = kartable_admin.id_admin 
WHERE kartable_droit_admin.id_admin = :id_admin AND kartable_droit_acces.d_acces = "del" '); 
$query_del->bindValue(':id_admin', $id_admin, PDO::PARAM_INT); 
$query_del->execute(); 
$data_del = $query_del->fetch();
$query_del->CloseCursor();
$var_del = (!empty($data_del['d_acces']))?htmlspecialchars($data_del['d_acces']):'none';

//Droit d'afficher la page index' 
$query_print_calculator=$db->prepare('SELECT * FROM kartable_droit_acces LEFT JOIN kartable_droit_admin
ON kartable_droit_acces.id_d_acces = kartable_droit_admin.id_d_acces LEFT JOIN kartable_admin
ON kartable_droit_admin.id_admin = kartable_admin.id_admin 
WHERE kartable_droit_admin.id_admin = :id_admin AND kartable_droit_acces.d_acces = "print_calculator" '); 
$query_print_calculator->bindValue(':id_admin', $id_admin, PDO::PARAM_INT); 
$query_print_calculator->execute(); 
$data_print_calculator = $query_print_calculator->fetch();
$query_print_calculator->CloseCursor();
$var_print_calculator = (!empty($data_print_calculator['d_acces']))?htmlspecialchars($data_print_calculator['d_acces']):'none';

//Droit d'afficher la page index' 
$query_print_class=$db->prepare('SELECT * FROM kartable_droit_acces LEFT JOIN kartable_droit_admin
ON kartable_droit_acces.id_d_acces = kartable_droit_admin.id_d_acces LEFT JOIN kartable_admin
ON kartable_droit_admin.id_admin = kartable_admin.id_admin 
WHERE kartable_droit_admin.id_admin = :id_admin AND kartable_droit_acces.d_acces = "print_class" '); 
$query_print_class->bindValue(':id_admin', $id_admin, PDO::PARAM_INT); 
$query_print_class->execute(); 
$data_print_class = $query_print_class->fetch();
$query_print_class->CloseCursor();
$var_print_class = (!empty($data_print_class['d_acces']))?htmlspecialchars($data_print_class['d_acces']):'none';

//Droit d'afficher la page index' 
$query_print_cpte=$db->prepare('SELECT * FROM kartable_droit_acces LEFT JOIN kartable_droit_admin
ON kartable_droit_acces.id_d_acces = kartable_droit_admin.id_d_acces LEFT JOIN kartable_admin
ON kartable_droit_admin.id_admin = kartable_admin.id_admin 
WHERE kartable_droit_admin.id_admin = :id_admin AND kartable_droit_acces.d_acces = "print_cpte" '); 
$query_print_cpte->bindValue(':id_admin', $id_admin, PDO::PARAM_INT); 
$query_print_cpte->execute(); 
$data_print_cpte = $query_print_cpte->fetch();
$query_print_cpte->CloseCursor();
$var_print_cpte = (!empty($data_print_cpte['d_acces']))?htmlspecialchars($data_print_cpte['d_acces']):'none';


//Droit d'afficher la page index' 
$query_print_perso=$db->prepare('SELECT * FROM kartable_droit_acces LEFT JOIN kartable_droit_admin
ON kartable_droit_acces.id_d_acces = kartable_droit_admin.id_d_acces LEFT JOIN kartable_admin
ON kartable_droit_admin.id_admin = kartable_admin.id_admin 
WHERE kartable_droit_admin.id_admin = :id_admin AND kartable_droit_acces.d_acces = "print_personnel" '); 
$query_print_perso->bindValue(':id_admin', $id_admin, PDO::PARAM_INT); 
$query_print_perso->execute(); 
$data_print_perso = $query_print_perso->fetch();
$query_print_perso->CloseCursor();
$var_print_perso = (!empty($data_print_perso['d_acces']))?htmlspecialchars($data_print_perso['d_acces']):'none';

//echo 'Droit d\'acces : '.$var_root. ' / '.$var_mod. ' /'. $var_del. ' /'.$var_config. ' /'.$var_print_index;
?>


<?php
/** Configuration files and strings */

$annee_scolaire = "2020-2021";
$nom_ecole = "Lycée MAMA DIANKEBA";
$logo = "./images/logo.png";

$theme = "c";

$tab1_color = '<table data-role="table" id="table-custom-1" data-mode="columntoggle" 
               class="ui-body-'.$theme.' ui-shadow table-stripe ui-responsive" 
               data-column-btn-theme=b
               data-column-btn-text="Affichage..." 
               data-column-popup-theme=c>' . "\n";

$tab2_color = '<table data-role="table" id="table-custom-1"  
              class="ui-body-'.$theme.' ui-shadow table-stripe ui-responsive">' . "\n";
?>