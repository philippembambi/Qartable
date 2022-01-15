<?php
//============================================================+
// File name   : kartable_print_pdf.php
// Last Update : 2020-12-26
// Author      : Philippe mbambi Mayele : philippembambi413@gmail.com
// Tout droit réservé à l'auteur. Ceci est une propriété intellectuelle de l'auteur
// -------------------------------------------------------------------
?>

<?php
require('database.php');
include("mes_fonctions.php");
$action = (isset($_GET['action']))?htmlspecialchars($_GET['action']):'';
?>
<?php
switch($action)
{
case "formulaire":

  require('database.php');

$id_eleve = $_GET['id_eleve'];
$query=$db->prepare('SELECT*  FROM kartable_eleves LEFT JOIN kartable_promotion
ON kartable_eleves.promotion_id = kartable_promotion.id_promotion 
WHERE kartable_eleves.id_eleve = :id_eleve');
$query->bindValue(':id_eleve', $id_eleve, PDO::PARAM_INT);
$query->execute();
$data = $query->fetch();
$classe_promo = ($data['classe_promo'] > 1 )?($data['classe_promo']." ième"):($data['classe_promo']." ière année");
$code_impression = $data['id_eleve'].substr($data['noms_eleve'], 0, 2).substr(MD5($data['noms_eleve']), 0, 3);

if(empty($data['photo_eleve']))
{
  $image = 'avatar.png';
}
else
{
  $image = $data['photo_eleve'];
}

    //Les fichiers de configuration
    require_once('tcpdf/config/tcpdf_config.php');
    require_once('tcpdf/tcpdf.php');

    //Par défaut, on passe comme paramètre PDF_PAGE_FORMAT pour remplacer le format A4
          $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "A4", true, 'UTF-8', false);
            //Set default font subsetting mode
               $pdf->setFontSubsetting(true);
                  //Paramètrer les marges
                     $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
                            //Les entêtes
                                $pdf->SetHeaderData('', '', 'Rapport kartable', 'Fiche d\'Inscription n° '.$data['id_eleve'].'                                                                                         Code d\'impression: '.$code_impression, 
                                    array(83, 174, 197), array(83, 174, 197));
    
                                       //La police du header et de footer
    $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                                 //monospaced font Comme police par défaut
                      $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    //Encore des marges
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_FOOTER);
    //Paramètres des auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    //Set font dejavusans is a UTF-8 Unicode font if you only need to print standard ASCII chars, you can use core fonts like helvetica or times to reduce file size
    $pdf->SetFont('dejavusans', '', 10, '', true);
    $pdf->AddPage();

    $tbl_header = '
    <div style="border: 1px solid #dee2e6;font-family: leelawadee;">
    <div style="background-color: array(83, 174, 197);">
    <img src="./images/'.$image.'" style="height: 60px;"/>
    </div>
    <ul>
    <li>Noms : ..............................<b>'.$data['noms_eleve'].'</b></li><br>
    <li>Sexe : ...............................<b>'.$data['sexe_eleve'].'</b></li><br>
    <li>Classe : .............................<b>'.$classe_promo.' '.$data['option_promo'].'</b></li><br>
    <li>Date d\'inscription : ...........<b>'.date('d/m/Y \à H:m',$data['date_inscription']).'</b></li>
    </ul>
    </div>
    </br>';
    
    $html = '
<h1 style="font-size: 20px;font-family: leelawadee;letter-spacing: 1px;"><u>Billet de vacances</u></h1>
<div style="line-height: 1.5 px;">
Chers parents, nous validons la demande d\'inscription de l\'élève
<b>'.$data['noms_eleve'].'</b> en classe de <b>'.$classe_promo.' '.$data['option_promo'].'</b>. Sur ce, ledit élève doit être soumis au test d\'admission qui aura lieu ce 
<b>'.date('d/m/Y \à H:m:s',time()).'</b> dans l\'enseinte de l\'école. 
<p>
La rentrée scolaire est fixée au 09 Septembre, et l\'élève sera muni des objets classiques suivants :
</p>
<div>
<style>
table {
  border-collapse: collapse;
}.table {
  width: 100%;
  margin-bottom: 1rem;
  color: #212529;
}.table th,
.table td {
  padding: 0.75rem;
  vertical-align: top;
  border-top: 1px solid #dee2e6;
}.table thead th {
  vertical-align: bottom;
  border-bottom: 2px solid #dee2e6;
}.table tbody + tbody {
  border-top: 2px solid #dee2e6;
}.table-sm th,
.table-sm td {
  padding: 0.3rem;
}.table-bordered {
  border: 1px solid #dee2e6;
}.table-bordered th,
.table-bordered td {
  border: 1px solid #dee2e6;
}.table-bordered thead th,
.table-bordered thead td {
  border-bottom-width: 2px;
}.table-borderless th,
.table-borderless td,
.table-borderless thead th,
.table-borderless tbody + tbody {
  border: 0;
}.table-striped tbody tr:nth-of-type(odd) {
  background-color: rgba(0, 0, 0, 0.05);
}.table-hover tbody tr:hover {
  color: #212529;
  background-color: rgba(0, 0, 0, 0.075);
}.table-active,
.table-active > th,
.table-active > td {
  background-color: rgba(0, 0, 0, 0.075);
}.table-hover .table-active:hover {
  background-color: rgba(0, 0, 0, 0.075);
}.table-hover .table-active:hover > td,
.table-hover .table-active:hover > th {
  background-color: rgba(0, 0, 0, 0.075);
}.table .thead-dark th {
  color: #fff;
  background-color: #343a40;
  border-color: #454d55;
}.table .thead-light th {
  color: #495057;
  background-color: #e9ecef;
  border-color: #dee2e6;
}.table-dark {
  color: #fff;
  background-color: #343a40;
}.table-dark th,
.table-dark td,
.table-dark thead th {
  border-color: #454d55;
}.table-dark.table-bordered {
  border: 0;
}.table-dark.table-striped tbody tr:nth-of-type(odd) {
  background-color: rgba(255, 255, 255, 0.05);
}.table-dark.table-hover tbody tr:hover {
  color: #fff;
  background-color: rgba(255, 255, 255, 0.075);
}
</style>

<table class="table table-bordered" style="">
<thead>
  <tr>
    <th>Objets classiques</th>
    <th>Pour filles</th>
    <th>Pour garçons</th>
  </tr>
</thead>
<tbody>
  <tr>
    <td rowspan="5">Uniformes</td>
    <td>* Jupe longue atteignant les chevilles, couleur bleue foncée.</td>
    <td>* Pantalon bleu foncé (pas de taille basse, ni jeans)</td>
  </tr>
  <tr>
    <td>* Blouse blanche manches courtes, col rond.</td>
    <td>* Chemise blanche manches courtes</td>
  </tr>
  <tr>
  <td>* Ketch ou pantoufle.</td>
  <td>* Ketch ou pantoufle</td>
</tr>
<tr>
<td>* Cheveux tressés en étoile.</td>
<td>* Cheveux coupés à 1mm près</td>
</tr>
<tr>
<td>* Une tenue de gymnastique (culotte + polo bleu ciel).</td>
<td>* Une tenue de gymnastique (culotte + polo bleu ciel).</td>
</tr>
</tbody>
</table>
<hr>
<table class="table table-bordered" style="">
<thead>
  <tr>
    <th>Objets classiques</th>
    <th style="font-weight: bold;">7 iè & 8 iè secondaires</th>
    <th style="font-weight: bold;">3 iè & 4 iè des humanités</th>
  </tr>
</thead>
<tbody>
  <tr>
    <td rowspan="3">Fournitures scolaire</td>
    <td>* 6 cahiers quadrillés 200 pages pour les notes;</td>
    <td>* 1 cahier cartonné quadrillé;</td>
  </tr>
  <tr>
    <td>* 8 cahiers quadrillés 96 pages pour les notes;</td>
    <td>* 9 cahiers quadrillés 200 pages pour les notes;</td>
  </tr>
  <tr>
  <td>* 10 cahiers quadrillés 48 pages pour les devoirs;</td>
  <td>* 6 cahiers quadrillés 48 pages pour les devoirs;</td>
</tr>

</tbody>
</table>
NB: L\'accompte des frais scolaires est payable durant les vancance et le montant s\'élève à 150 000 FC.
<p>
La direction <span><img src="./images/signature.png" style="height: 30px;"/></span>
</p>
</div>
    ';

    $pdf->writeHTML($tbl_header.$html, true, false, false, false, '');
    //$pdf->writeHTML($html, true, 0);
    //Impression du document complet
    $fichier = substr($data['noms_eleve'], 0, 5);
    $fichier = $fichier.$data['id_eleve'];
    $pdf->Output($fichier.'.pdf', 'F');
    //$alerte = "Impression effectuée avec succès !";
    header('location: kartable_iframe_pdf.php?nom_fichier='.$fichier);   
   //header("location: kartable_eleve.php?id_promo=".$data['promotion_id']."&alerte=".$alerte);

break;
?>

<?php
case "print_fees_Story":

      //Les fichiers de configuration
      require_once('tcpdf/config/tcpdf_config.php');
      require_once('tcpdf/tcpdf.php');
  
      //Par défaut, on passe comme paramètre PDF_PAGE_FORMAT pour remplacer le format A4
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "A4", true, 'UTF-8', false);
              //Set default font subsetting mode
                 $pdf->setFontSubsetting(true);
                    //Paramètrer les marges
                       $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                          $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
                              //Les entêtes
                                  $pdf->SetHeaderData('', '', 'Historique de paiement des frais', 'Imprimé le '.date('d/m/Y',time()).'',
                                      array(83, 174, 197), array(83, 174, 197));
      
                                         //La police du header et de footer
      $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                                   //monospaced font Comme police par défaut
                        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
  
      //Encore des marges
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_FOOTER);
      //Paramètres des auto page breaks
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
  
      //Set font dejavusans is a UTF-8 Unicode font if you only need to print standard ASCII chars, you can use core fonts like helvetica or times to reduce file size
      $pdf->SetFont('dejavusans', '', 10, '', true);
      $pdf->AddPage();

      $solde=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "Accompte"');
$solde->execute();
$dataAccompte = $solde->fetch();

$tranche1=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "tranche1"');
$tranche1->execute();
$dataTranche1 = $tranche1->fetch();

$tranche2=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "tranche2"');
$tranche2->execute();
$dataTranche2 = $tranche2->fetch();

$tranche3=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "Solde"');
$tranche3->execute();
$dataTranche3 = $tranche3->fetch();


  $req=$db->prepare('SELECT*  FROM kartable_frais_scolaire LEFT JOIN kartable_eleves
  ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
  ORDER BY date_paiement ASC');
  $req->execute();
  $solde=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "Solde"');
$solde->execute();
$dataSolde = $solde->fetch();

while ($data1 = $req->fetch())
{

  $reqEleve=$db->prepare('SELECT SUM(montant) AS dette FROM kartable_frais_scolaire 
  LEFT JOIN kartable_eleves ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
  WHERE kartable_eleves.id_eleve = :id_eleve AND kartable_frais_scolaire.modalite = "Accompte" ');
  $reqEleve->bindValue(':id_eleve', (int) $data1['id_eleve'], PDO::PARAM_INT);
  $reqEleve->execute();
  $data3 = $reqEleve->fetch();
  $dette1 = $dataAccompte['montant_modalite'] - $data3['dette'];
  
  $reqEleve2=$db->prepare('SELECT SUM(montant) AS dette FROM kartable_frais_scolaire 
  LEFT JOIN kartable_eleves ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
  WHERE kartable_eleves.id_eleve = :id_eleve AND kartable_frais_scolaire.modalite = "tranche1" ');
  $reqEleve2->bindValue(':id_eleve', (int) $data1['id_eleve'], PDO::PARAM_INT);
  $reqEleve2->execute();
  $data4 = $reqEleve2->fetch();
  $dette2 = $dataTranche1['montant_modalite'] - $data4['dette'];
  
  $reqEleve3=$db->prepare('SELECT SUM(montant) AS dette FROM kartable_frais_scolaire 
  LEFT JOIN kartable_eleves ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
  WHERE kartable_eleves.id_eleve = :id_eleve AND kartable_frais_scolaire.modalite = "tranche2" ');
  $reqEleve3->bindValue(':id_eleve', (int) $data1['id_eleve'], PDO::PARAM_INT);
  $reqEleve3->execute();
  $data5 = $reqEleve3->fetch();
  $dette3 = $dataTranche2['montant_modalite'] - $data5['dette'];
  
  $reqEleve4=$db->prepare('SELECT SUM(montant) AS dette FROM kartable_frais_scolaire 
  LEFT JOIN kartable_eleves ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
  WHERE kartable_eleves.id_eleve = :id_eleve');
  $reqEleve4->bindValue(':id_eleve', (int) $data1['id_eleve'], PDO::PARAM_INT);
  $reqEleve4->execute();
  $data6 = $reqEleve4->fetch();
  $dette4 = $dataTranche3['montant_modalite'] - $data6['dette'];

  if($data1['modalite'] == "Accompte")
    {
      $dette = $dette1;
    }
    elseif($data1['modalite'] == "tranche1")
    {
      $dette = $dette2;
    }
    elseif($data1['modalite'] == "tranche2")
    {
      $dette = $dette3;
     }
    elseif($data1['modalite'] == "Solde")
    {
      $dette = $dette4;
    }
    else{
      $dette = $dette4;
    }


$html_eleve = '
<label>Réçu numéro ' . $data1['id_frais'] . '</label>
<ul>
<li>Noms : &nbsp;&nbsp;&nbsp;&nbsp;<strong>'.$data1['noms_eleve'].'</strong></li>
<li>Date  : &nbsp;&nbsp;&nbsp;&nbsp;<b>'.$data1['date_paiement'].'</b></li>
<li>Motif : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $data1['motif'] . '</b></li>
<li>Montant payé : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $data1['montant'] .$data1['devise']. '</b></li>
<li>Modalité : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $data1['modalite'] . '</b></li>
<li>Dette  :&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$dette.' '.$data1['devise'].'</b><li>

      </ul> <hr>';

$pdf->writeHTML($html_eleve, true, false, false, false, '');
}
  
//$pdf->writeHTML($html, true, 0);
//Impression du document complet
$fichier = 'HistoriquePaiementFrais';
$pdf->Output($fichier.'.pdf', 'F');
//$alerte = "Impression effectuée avec succès !";
header('location: kartable_iframe_pdf.php?nom_fichier='.$fichier);   

break;
?>


<?php
case "print_all_fees_by_date":

$date1 = $_GET['date1'];
$date2 = $_GET['date2'];

      //Les fichiers de configuration
      require_once('tcpdf/config/tcpdf_config.php');
      require_once('tcpdf/tcpdf.php');
  
      //Par défaut, on passe comme paramètre PDF_PAGE_FORMAT pour remplacer le format A4
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "A4", true, 'UTF-8', false);
              //Set default font subsetting mode
                 $pdf->setFontSubsetting(true);
                    //Paramètrer les marges
                       $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                          $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
                              //Les entêtes
                                  $pdf->SetHeaderData('', '', 'Paiement des frais scolaire du '.$date1.' au '.$date2, 'Imprimé le '.date('d/m/Y',time()).'',
                                      array(83, 174, 197), array(83, 174, 197));
      
                                         //La police du header et de footer
      $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                                   //monospaced font Comme police par défaut
                        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
  
      //Encore des marges
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_FOOTER);
      //Paramètres des auto page breaks
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
  
      //Set font dejavusans is a UTF-8 Unicode font if you only need to print standard ASCII chars, you can use core fonts like helvetica or times to reduce file size
      $pdf->SetFont('dejavusans', '', 10, '', true);
      $pdf->AddPage();

$solde=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "Accompte"');
$solde->execute();
$dataAccompte = $solde->fetch();

$tranche1=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "tranche1"');
$tranche1->execute();
$dataTranche1 = $tranche1->fetch();

$tranche2=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "tranche2"');
$tranche2->execute();
$dataTranche2 = $tranche2->fetch();

$tranche3=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "Solde"');
$tranche3->execute();
$dataTranche3 = $tranche3->fetch();


      $req=$db->prepare('SELECT*  FROM kartable_frais_scolaire LEFT JOIN kartable_eleves
      ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
      WHERE kartable_frais_scolaire.date_paiement BETWEEN :date1 AND :date2 ');
      $req->bindValue(':date1', $date1, PDO::PARAM_STR);
      $req->bindValue(':date2', $date2, PDO::PARAM_STR);
      $req->execute();
      
while ($data1 = $req->fetch())
{

  $reqEleve=$db->prepare('SELECT SUM(montant) AS dette FROM kartable_frais_scolaire 
  LEFT JOIN kartable_eleves ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
  WHERE kartable_eleves.id_eleve = :id_eleve AND kartable_frais_scolaire.modalite = "Accompte" ');
  $reqEleve->bindValue(':id_eleve', (int) $data1['id_eleve'], PDO::PARAM_INT);
  $reqEleve->execute();
  $data3 = $reqEleve->fetch();
  $dette1 = $dataAccompte['montant_modalite'] - $data3['dette'];
  
  $reqEleve2=$db->prepare('SELECT SUM(montant) AS dette FROM kartable_frais_scolaire 
  LEFT JOIN kartable_eleves ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
  WHERE kartable_eleves.id_eleve = :id_eleve AND kartable_frais_scolaire.modalite = "tranche1" ');
  $reqEleve2->bindValue(':id_eleve', (int) $data1['id_eleve'], PDO::PARAM_INT);
  $reqEleve2->execute();
  $data4 = $reqEleve2->fetch();
  $dette2 = $dataTranche1['montant_modalite'] - $data4['dette'];
  
  $reqEleve3=$db->prepare('SELECT SUM(montant) AS dette FROM kartable_frais_scolaire 
  LEFT JOIN kartable_eleves ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
  WHERE kartable_eleves.id_eleve = :id_eleve AND kartable_frais_scolaire.modalite = "tranche2" ');
  $reqEleve3->bindValue(':id_eleve', (int) $data1['id_eleve'], PDO::PARAM_INT);
  $reqEleve3->execute();
  $data5 = $reqEleve3->fetch();
  $dette3 = $dataTranche2['montant_modalite'] - $data5['dette'];
  
  $reqEleve4=$db->prepare('SELECT SUM(montant) AS dette FROM kartable_frais_scolaire 
  LEFT JOIN kartable_eleves ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
  WHERE kartable_eleves.id_eleve = :id_eleve');
  $reqEleve4->bindValue(':id_eleve', (int) $data1['id_eleve'], PDO::PARAM_INT);
  $reqEleve4->execute();
  $data6 = $reqEleve4->fetch();
  $dette4 = $dataTranche3['montant_modalite'] - $data6['dette'];

  if($data1['modalite'] == "Accompte")
    {
      $dette = $dette1;
    }
    elseif($data1['modalite'] == "tranche1")
    {
      $dette = $dette2;
    }
    elseif($data1['modalite'] == "tranche2")
    {
      $dette = $dette3;
     }
    elseif($data1['modalite'] == "Solde")
    {
      $dette = $dette4;
    }
    else{
      $dette = $dette4;
    }

$html_eleve = '
<label>Réçu numéro ' . $data1['id_frais'] . '</label>
<ul>
<li>Noms : &nbsp;&nbsp;&nbsp;&nbsp;<strong>'.$data1['noms_eleve'].'</strong></li>
<li>Motif : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $data1['motif'] . '</b></li>
<li>Montant payé : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $data1['montant'] .$data1['devise']. '</b></li>
<li>Modalité : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $data1['modalite'] . '</b></li>
<li>Dette  :&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$dette.' '.$data1['devise'].'</b><li>
';

$end =  '</ul> <hr>';   

$html_eleve = $html_eleve.$end;

$pdf->writeHTML($html_eleve, true, false, false, false, '');
}
  
//$pdf->writeHTML($html, true, 0);
//Impression du document complet
$fichier = 'Frais_par_date_de_paiement';
$pdf->Output($fichier.'.pdf', 'F');
//$alerte = "Impression effectuée avec succès !";
header('location: kartable_iframe_pdf.php?nom_fichier='.$fichier);   

break;
?>



<?php
case "print_fees_by_name":

$name = $_GET['name'];
$id_eleve = $_GET['id_eleve'];

$req1=$db->prepare('SELECT*  FROM kartable_frais_scolaire LEFT JOIN kartable_eleves
ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve
LEFT JOIN kartable_promotion ON kartable_eleves.promotion_id = kartable_promotion.id_promotion 
WHERE kartable_frais_scolaire.id_eleve = :id_eleve');
$req1->bindValue(':id_eleve', (int) $id_eleve, PDO::PARAM_INT);
$req1->execute();
$dataPromo = $req1->fetch();
$classe_promo = ($dataPromo['classe_promo'] > 1 )?($dataPromo['classe_promo']." ième"):($dataPromo['classe_promo']." ière année");
$option_promo = $dataPromo['option_promo'];

      //Les fichiers de configuration
      require_once('tcpdf/config/tcpdf_config.php');
      require_once('tcpdf/tcpdf.php');
  
      //Par défaut, on passe comme paramètre PDF_PAGE_FORMAT pour remplacer le format A4
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "A4", true, 'UTF-8', false);
              //Set default font subsetting mode
                 $pdf->setFontSubsetting(true);
                    //Paramètrer les marges
                       $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                          $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
                              //Les entêtes
                                  $pdf->SetHeaderData('', '', $name.' / '.$classe_promo.' '.$option_promo, 'Imprimé le '.date('d/m/Y',time()).'',
                                      array(83, 174, 197), array(83, 174, 197));
      
                                         //La police du header et de footer
      $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                                   //monospaced font Comme police par défaut
                        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
  
      //Encore des marges
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_FOOTER);
      //Paramètres des auto page breaks
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
  
      //Set font dejavusans is a UTF-8 Unicode font if you only need to print standard ASCII chars, you can use core fonts like helvetica or times to reduce file size
      $pdf->SetFont('dejavusans', '', 10, '', true);
      $pdf->AddPage();
      $solde=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "Accompte"');
      $solde->execute();
      $dataAccompte = $solde->fetch();
      
      $tranche1=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "tranche1"');
      $tranche1->execute();
      $dataTranche1 = $tranche1->fetch();
      
      $tranche2=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "tranche2"');
      $tranche2->execute();
      $dataTranche2 = $tranche2->fetch();
      
      $tranche3=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "Solde"');
      $tranche3->execute();
      $dataTranche3 = $tranche3->fetch();
      
      
      $req=$db->prepare('SELECT*  FROM kartable_frais_scolaire LEFT JOIN kartable_eleves
      ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve
      LEFT JOIN kartable_promotion ON kartable_eleves.promotion_id = kartable_promotion.id_promotion 
      WHERE kartable_frais_scolaire.id_eleve = :id_eleve');
      $req->bindValue(':id_eleve', (int) $id_eleve, PDO::PARAM_INT);
      $req->execute();
            
while ($data1 = $req->fetch())
{

  $reqEleve=$db->prepare('SELECT SUM(montant) AS dette FROM kartable_frais_scolaire 
  LEFT JOIN kartable_eleves ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
  WHERE kartable_eleves.id_eleve = :id_eleve AND kartable_frais_scolaire.modalite = "Accompte" ');
  $reqEleve->bindValue(':id_eleve', (int) $data1['id_eleve'], PDO::PARAM_INT);
  $reqEleve->execute();
  $data3 = $reqEleve->fetch();
  $dette1 = $dataAccompte['montant_modalite'] - $data3['dette'];
  
  $reqEleve2=$db->prepare('SELECT SUM(montant) AS dette FROM kartable_frais_scolaire 
  LEFT JOIN kartable_eleves ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
  WHERE kartable_eleves.id_eleve = :id_eleve AND kartable_frais_scolaire.modalite = "tranche1" ');
  $reqEleve2->bindValue(':id_eleve', (int) $data1['id_eleve'], PDO::PARAM_INT);
  $reqEleve2->execute();
  $data4 = $reqEleve2->fetch();
  $dette2 = $dataTranche1['montant_modalite'] - $data4['dette'];
  
  $reqEleve3=$db->prepare('SELECT SUM(montant) AS dette FROM kartable_frais_scolaire 
  LEFT JOIN kartable_eleves ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
  WHERE kartable_eleves.id_eleve = :id_eleve AND kartable_frais_scolaire.modalite = "tranche2" ');
  $reqEleve3->bindValue(':id_eleve', (int) $data1['id_eleve'], PDO::PARAM_INT);
  $reqEleve3->execute();
  $data5 = $reqEleve3->fetch();
  $dette3 = $dataTranche2['montant_modalite'] - $data5['dette'];
  
  $reqEleve4=$db->prepare('SELECT SUM(montant) AS dette FROM kartable_frais_scolaire 
  LEFT JOIN kartable_eleves ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
  WHERE kartable_eleves.id_eleve = :id_eleve');
  $reqEleve4->bindValue(':id_eleve', (int) $data1['id_eleve'], PDO::PARAM_INT);
  $reqEleve4->execute();
  $data6 = $reqEleve4->fetch();
  $dette4 = $dataTranche3['montant_modalite'] - $data6['dette'];

  $timestamp = strtotime($data1['date_paiement']);
  $date_time = date('d/m/Y',$timestamp);

  if($data1['modalite'] == "Accompte")
    {
      $dette = $dette1;
    }
    elseif($data1['modalite'] == "tranche1")
    {
      $dette = $dette2;
    }
    elseif($data1['modalite'] == "tranche2")
    {
      $dette = $dette3;
     }
    elseif($data1['modalite'] == "Solde")
    {
      $dette = $dette4;
    }
    else{
      $dette = $dette4;
    }

$html_eleve = '
<label>Réçu numéro ' . $data1['id_frais'] . '</label>
<ul>
<li>Date de paiement : &nbsp;&nbsp;&nbsp;&nbsp;<strong>'.$date_time.'</strong></li>
<li>Motif : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $data1['motif'] . '</b></li>
<li>Montant payé : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $data1['montant'] .$data1['devise']. '</b></li>
<li>Modalité : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $data1['modalite'] . '</b></li>
<li>Dette  :&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$dette.' '.$data1['devise'].'</b><li>
';

$end =  '</ul> <hr>';   

$html_eleve = $html_eleve.$end;

$pdf->writeHTML($html_eleve, true, false, false, false, '');
}
  
//$pdf->writeHTML($html, true, 0);
//Impression du document complet
//$fichier = str_replace(' ', '_', $name);
$pdf->Output($name.'.pdf', 'F');
//$alerte = "Impression effectuée avec succès !";
header('location: kartable_iframe_pdf.php?nom_fichier='.$name);   

break;
?>



<?php
case "print_fees_by_classe":

$id_classe = $_GET['id_classe'];

$solde=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "Accompte"');
$solde->execute();
$dataAccompte = $solde->fetch();

$reqPromo=$db->prepare('SELECT*  FROM kartable_frais_scolaire LEFT JOIN kartable_eleves
ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve LEFT JOIN kartable_promotion
ON kartable_eleves.promotion_id = kartable_promotion.id_promotion 
WHERE kartable_promotion.id_promotion = :id_classe');
$reqPromo->bindValue(':id_classe', (int) $id_classe, PDO::PARAM_INT);
$reqPromo->execute();
$dataPromo = $reqPromo->fetch();
$classe_promo = ($dataPromo['classe_promo'] > 1 )?($dataPromo['classe_promo']." ième"):($dataPromo['classe_promo']." ière année");
$option_promo = $dataPromo['option_promo'];

//Les fichiers de configuration
      require_once('tcpdf/config/tcpdf_config.php');
      require_once('tcpdf/tcpdf.php');
  
      //Par défaut, on passe comme paramètre PDF_PAGE_FORMAT pour remplacer le format A4
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "A4", true, 'UTF-8', false);
              //Set default font subsetting mode
                 $pdf->setFontSubsetting(true);
                    //Paramètrer les marges
                       $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                          $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
                              //Les entêtes
                                  $pdf->SetHeaderData('', '', 'Paiment pour la '.$classe_promo.' '.$option_promo, 'Imprimé le '.date('d/m/Y',time()).'',
                                      array(83, 174, 197), array(83, 174, 197));
      
                                         //La police du header et de footer
      $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                                   //monospaced font Comme police par défaut
                        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
  
      //Encore des marges
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_FOOTER);
      //Paramètres des auto page breaks
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
  
      //Set font dejavusans is a UTF-8 Unicode font if you only need to print standard ASCII chars, you can use core fonts like helvetica or times to reduce file size
      $pdf->SetFont('dejavusans', '', 10, '', true);
      $pdf->AddPage();

      $tranche1=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "tranche1"');
      $tranche1->execute();
      $dataTranche1 = $tranche1->fetch();
      
      $tranche2=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "tranche2"');
      $tranche2->execute();
      $dataTranche2 = $tranche2->fetch();
      
      $tranche3=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "Solde"');
      $tranche3->execute();
      $dataTranche3 = $tranche3->fetch();

      $req=$db->prepare('SELECT*  FROM kartable_frais_scolaire LEFT JOIN kartable_eleves
ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve LEFT JOIN kartable_promotion
ON kartable_eleves.promotion_id = kartable_promotion.id_promotion 
WHERE kartable_promotion.id_promotion = :id_classe');
$req->bindValue(':id_classe', (int) $id_classe, PDO::PARAM_INT);
$req->execute();


while ($data1 = $req->fetch())
{

  $reqEleve=$db->prepare('SELECT SUM(montant) AS dette FROM kartable_frais_scolaire 
  LEFT JOIN kartable_eleves ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
  WHERE kartable_eleves.id_eleve = :id_eleve AND kartable_frais_scolaire.modalite = "Accompte" ');
  $reqEleve->bindValue(':id_eleve', (int) $data1['id_eleve'], PDO::PARAM_INT);
  $reqEleve->execute();
  $data3 = $reqEleve->fetch();
  $dette1 = $dataAccompte['montant_modalite'] - $data3['dette'];
  
  $reqEleve2=$db->prepare('SELECT SUM(montant) AS dette FROM kartable_frais_scolaire 
  LEFT JOIN kartable_eleves ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
  WHERE kartable_eleves.id_eleve = :id_eleve AND kartable_frais_scolaire.modalite = "tranche1" ');
  $reqEleve2->bindValue(':id_eleve', (int) $data1['id_eleve'], PDO::PARAM_INT);
  $reqEleve2->execute();
  $data4 = $reqEleve2->fetch();
  $dette2 = $dataTranche1['montant_modalite'] - $data4['dette'];
  
  $reqEleve3=$db->prepare('SELECT SUM(montant) AS dette FROM kartable_frais_scolaire 
  LEFT JOIN kartable_eleves ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
  WHERE kartable_eleves.id_eleve = :id_eleve AND kartable_frais_scolaire.modalite = "tranche2" ');
  $reqEleve3->bindValue(':id_eleve', (int) $data1['id_eleve'], PDO::PARAM_INT);
  $reqEleve3->execute();
  $data5 = $reqEleve3->fetch();
  $dette3 = $dataTranche2['montant_modalite'] - $data5['dette'];
  
  $reqEleve4=$db->prepare('SELECT SUM(montant) AS dette FROM kartable_frais_scolaire 
  LEFT JOIN kartable_eleves ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
  WHERE kartable_eleves.id_eleve = :id_eleve');
  $reqEleve4->bindValue(':id_eleve', (int) $data1['id_eleve'], PDO::PARAM_INT);
  $reqEleve4->execute();
  $data6 = $reqEleve4->fetch();
  $dette4 = $dataTranche3['montant_modalite'] - $data6['dette'];

  $timestamp = strtotime($data1['date_paiement']);
  $date_time = date('d/m/Y',$timestamp);

  if($data1['modalite'] == "Accompte")
    {
      $dette = $dette1;
    }
    elseif($data1['modalite'] == "tranche1")
    {
      $dette = $dette2;
    }
    elseif($data1['modalite'] == "tranche2")
    {
      $dette = $dette3;
     }
    elseif($data1['modalite'] == "Solde")
    {
      $dette = $dette4;
    }
    else{
      $dette = $dette4;
    }

$html_eleve = '
<label>Réçu numéro ' . $data1['id_frais'] . '</label>
<ul>
<li>Date de paiement : &nbsp;&nbsp;&nbsp;&nbsp;<strong>'.$date_time.'</strong></li>
<li>Motif : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $data1['motif'] . '</b></li>
<li>Montant payé : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $data1['montant'] .$data1['devise']. '</b></li>
<li>Modalité : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $data1['modalite'] . '</b></li>
<li>Dette  :&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$dette.' '.$data1['devise'].'</b><li>
';

$end =  '</ul> <hr>';   

$html_eleve = $html_eleve.$end;

$pdf->writeHTML($html_eleve, true, false, false, false, '');
}
  
//$pdf->writeHTML($html, true, 0);
//Impression du document complet
$fichier = str_replace('è', 'e', $classe_promo.' '.$option_promo);
$fichier = str_replace('é', 'e', $fichier);
$pdf->Output($fichier.'.pdf', 'F');
//$alerte = "Impression effectuée avec succès !";
header('location: kartable_iframe_pdf.php?nom_fichier='.$fichier);   

break;
?>



<?php
case "print_fees_by_classe_date":

$id_classe = $_GET['id_classe'];
$filtre_date1 = $_GET['filtre_date1'];
$filtre_date2 = $_GET['filtre_date2'];

$reqPromo=$db->prepare('SELECT*  FROM kartable_frais_scolaire LEFT JOIN kartable_eleves
ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve LEFT JOIN kartable_promotion
ON kartable_eleves.promotion_id = kartable_promotion.id_promotion 
WHERE kartable_promotion.id_promotion = :id_classe');
$reqPromo->bindValue(':id_classe', (int) $id_classe, PDO::PARAM_INT);
$reqPromo->execute();
$dataPromo = $reqPromo->fetch();
$classe_promo = ($dataPromo['classe_promo'] > 1 )?($dataPromo['classe_promo']." ième"):($dataPromo['classe_promo']." ière année");
$option_promo = $dataPromo['option_promo'];

//Les fichiers de configuration
      require_once('tcpdf/config/tcpdf_config.php');
      require_once('tcpdf/tcpdf.php');
  
      //Par défaut, on passe comme paramètre PDF_PAGE_FORMAT pour remplacer le format A4
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "A4", true, 'UTF-8', false);
              //Set default font subsetting mode
                 $pdf->setFontSubsetting(true);
                    //Paramètrer les marges
                       $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                          $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
                              //Les entêtes
                                  $pdf->SetHeaderData('', '', 'Paiment pour la '.$classe_promo.' '.$option_promo.' : du '.$filtre_date1.' au '.$filtre_date2, 'Imprimé le '.date('d/m/Y',time()).'',
                                      array(83, 174, 197), array(83, 174, 197));
      
                                         //La police du header et de footer
      $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                                   //monospaced font Comme police par défaut
                        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
  
      //Encore des marges
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_FOOTER);
      //Paramètres des auto page breaks
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
  
      //Set font dejavusans is a UTF-8 Unicode font if you only need to print standard ASCII chars, you can use core fonts like helvetica or times to reduce file size
      $pdf->SetFont('dejavusans', '', 10, '', true);
      $pdf->AddPage();

      $date1 = str_replace('/', '_', $filtre_date1);
      $date2 = str_replace('/', '_', $filtre_date2);

      $solde=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "Accompte"');
      $solde->execute();
      $dataAccompte = $solde->fetch();

      $tranche1=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "tranche1"');
      $tranche1->execute();
      $dataTranche1 = $tranche1->fetch();
      
      $tranche2=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "tranche2"');
      $tranche2->execute();
      $dataTranche2 = $tranche2->fetch();
      
      $tranche3=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "Solde"');
      $tranche3->execute();
      $dataTranche3 = $tranche3->fetch();

      $req=$db->prepare('SELECT*  FROM kartable_frais_scolaire LEFT JOIN kartable_eleves
      ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve LEFT JOIN kartable_promotion
      ON kartable_eleves.promotion_id = kartable_promotion.id_promotion 
      WHERE (kartable_frais_scolaire.date_paiement BETWEEN :date1 AND :date2) AND (kartable_promotion.id_promotion = :id_classe)');
      $req->bindValue(':date1', $filtre_date1, PDO::PARAM_STR);
      $req->bindValue(':date2', $filtre_date2, PDO::PARAM_STR);
      $req->bindValue(':id_classe', (int) $id_classe, PDO::PARAM_INT);
      $req->execute();
      
while ($data1 = $req->fetch())
{

  $reqEleve=$db->prepare('SELECT SUM(montant) AS dette FROM kartable_frais_scolaire 
  LEFT JOIN kartable_eleves ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
  WHERE kartable_eleves.id_eleve = :id_eleve AND kartable_frais_scolaire.modalite = "Accompte" ');
  $reqEleve->bindValue(':id_eleve', (int) $data1['id_eleve'], PDO::PARAM_INT);
  $reqEleve->execute();
  $data3 = $reqEleve->fetch();
  $dette1 = $dataAccompte['montant_modalite'] - $data3['dette'];
  
  $reqEleve2=$db->prepare('SELECT SUM(montant) AS dette FROM kartable_frais_scolaire 
  LEFT JOIN kartable_eleves ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
  WHERE kartable_eleves.id_eleve = :id_eleve AND kartable_frais_scolaire.modalite = "tranche1" ');
  $reqEleve2->bindValue(':id_eleve', (int) $data1['id_eleve'], PDO::PARAM_INT);
  $reqEleve2->execute();
  $data4 = $reqEleve2->fetch();
  $dette2 = $dataTranche1['montant_modalite'] - $data4['dette'];
  
  $reqEleve3=$db->prepare('SELECT SUM(montant) AS dette FROM kartable_frais_scolaire 
  LEFT JOIN kartable_eleves ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
  WHERE kartable_eleves.id_eleve = :id_eleve AND kartable_frais_scolaire.modalite = "tranche2" ');
  $reqEleve3->bindValue(':id_eleve', (int) $data1['id_eleve'], PDO::PARAM_INT);
  $reqEleve3->execute();
  $data5 = $reqEleve3->fetch();
  $dette3 = $dataTranche2['montant_modalite'] - $data5['dette'];
  
  $reqEleve4=$db->prepare('SELECT SUM(montant) AS dette FROM kartable_frais_scolaire 
  LEFT JOIN kartable_eleves ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
  WHERE kartable_eleves.id_eleve = :id_eleve');
  $reqEleve4->bindValue(':id_eleve', (int) $data1['id_eleve'], PDO::PARAM_INT);
  $reqEleve4->execute();
  $data6 = $reqEleve4->fetch();
  $dette4 = $dataTranche3['montant_modalite'] - $data6['dette'];

  $timestamp = strtotime($data1['date_paiement']);
  $date_time = date('d/m/Y',$timestamp);

  if($data1['modalite'] == "Accompte")
    {
      $dette = $dette1;
    }
    elseif($data1['modalite'] == "tranche1")
    {
      $dette = $dette2;
    }
    elseif($data1['modalite'] == "tranche2")
    {
      $dette = $dette3;
     }
    elseif($data1['modalite'] == "Solde")
    {
      $dette = $dette4;
    }
    else{
      $dette = $dette4;
    }

$html_eleve = '
<label>Réçu numéro ' . $data1['id_frais'] . '</label>
<ul>
<li>Noms de l\'élève : &nbsp;&nbsp;&nbsp;&nbsp;<strong>'.$data1['noms_eleve'].'</strong></li>
<li>Date de paiement : &nbsp;&nbsp;&nbsp;&nbsp;<strong>'.$date_time.'</strong></li>
<li>Motif : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $data1['motif'] . '</b></li>
<li>Montant payé : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $data1['montant'] .$data1['devise']. '</b></li>
<li>Modalité : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $data1['modalite'] . '</b></li>
<li>Dette  :&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$dette.' '.$data1['devise'].'</b><li>
';

$end =  '</ul> <hr>';   

$html_eleve = $html_eleve.$end;

$pdf->writeHTML($html_eleve, true, false, false, false, '');
}
  
//$pdf->writeHTML($html, true, 0);
//Impression du document complet
$fichier = str_replace('è', 'e', $classe_promo.' '.$option_promo.'du '.$date1.' au '.$date2);
$fichier = str_replace('é', 'e', $fichier);
$pdf->Output($fichier.'.pdf', 'F');
//$alerte = "Impression effectuée avec succès !";
header('location: kartable_iframe_pdf.php?nom_fichier='.$fichier);   

break;
?>


<?php
case "print_fees_by_classe_modalite":

$id_classe = $_GET['id_classe'];
$modalite = $_GET['modalite'];

$reqPromo=$db->prepare('SELECT*  FROM kartable_frais_scolaire LEFT JOIN kartable_eleves
ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve LEFT JOIN kartable_promotion
ON kartable_eleves.promotion_id = kartable_promotion.id_promotion 
WHERE kartable_promotion.id_promotion = :id_classe');
$reqPromo->bindValue(':id_classe', (int) $id_classe, PDO::PARAM_INT);
$reqPromo->execute();
$dataPromo = $reqPromo->fetch();
$classe_promo = ($dataPromo['classe_promo'] > 1 )?($dataPromo['classe_promo']." ième"):($dataPromo['classe_promo']." ière année");
$option_promo = $dataPromo['option_promo'];

//Les fichiers de configuration
      require_once('tcpdf/config/tcpdf_config.php');
      require_once('tcpdf/tcpdf.php');
  
      //Par défaut, on passe comme paramètre PDF_PAGE_FORMAT pour remplacer le format A4
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "A4", true, 'UTF-8', false);
              //Set default font subsetting mode
                 $pdf->setFontSubsetting(true);
                    //Paramètrer les marges
                       $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                          $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
                              //Les entêtes
                                  $pdf->SetHeaderData('', '', $modalite.' pour la '.$classe_promo.' '.$option_promo, 'Imprimé le '.date('d/m/Y',time()).'', 
                                      array(83, 174, 197), array(83, 174, 197));
      
                                         //La police du header et de footer
      $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                                   //monospaced font Comme police par défaut
                        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
  
      //Encore des marges
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_FOOTER);
      //Paramètres des auto page breaks
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
  
      //Set font dejavusans is a UTF-8 Unicode font if you only need to print standard ASCII chars, you can use core fonts like helvetica or times to reduce file size
      $pdf->SetFont('dejavusans', '', 10, '', true);
      $pdf->AddPage();

      $date1 = str_replace('/', '_', $filtre_date1);
      $date2 = str_replace('/', '_', $filtre_date2);

      $solde=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "Accompte"');
      $solde->execute();
      $dataAccompte = $solde->fetch();

      $tranche1=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "tranche1"');
      $tranche1->execute();
      $dataTranche1 = $tranche1->fetch();
      
      $tranche2=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "tranche2"');
      $tranche2->execute();
      $dataTranche2 = $tranche2->fetch();
      
      $tranche3=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "Solde"');
      $tranche3->execute();
      $dataTranche3 = $tranche3->fetch();

      $requete=$db->prepare('SELECT*  FROM kartable_frais_scolaire LEFT JOIN kartable_eleves
      ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve LEFT JOIN kartable_promotion
      ON kartable_eleves.promotion_id = kartable_promotion.id_promotion 
      WHERE kartable_frais_scolaire.modalite = :modalite AND kartable_promotion.id_promotion = :id_promo');
      $requete->bindValue(':modalite', $modalite, PDO::PARAM_STR);
      $requete->bindValue(':id_promo', $id_classe, PDO::PARAM_INT);
      $requete->execute();

while ($data1 = $requete->fetch())
{

  $reqEleve=$db->prepare('SELECT SUM(montant) AS dette FROM kartable_frais_scolaire 
  LEFT JOIN kartable_eleves ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
  WHERE kartable_eleves.id_eleve = :id_eleve AND kartable_frais_scolaire.modalite = "Accompte" ');
  $reqEleve->bindValue(':id_eleve', (int) $data1['id_eleve'], PDO::PARAM_INT);
  $reqEleve->execute();
  $data3 = $reqEleve->fetch();
  $dette1 = $dataAccompte['montant_modalite'] - $data3['dette'];
  
  $reqEleve2=$db->prepare('SELECT SUM(montant) AS dette FROM kartable_frais_scolaire 
  LEFT JOIN kartable_eleves ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
  WHERE kartable_eleves.id_eleve = :id_eleve AND kartable_frais_scolaire.modalite = "tranche1" ');
  $reqEleve2->bindValue(':id_eleve', (int) $data1['id_eleve'], PDO::PARAM_INT);
  $reqEleve2->execute();
  $data4 = $reqEleve2->fetch();
  $dette2 = $dataTranche1['montant_modalite'] - $data4['dette'];
  
  $reqEleve3=$db->prepare('SELECT SUM(montant) AS dette FROM kartable_frais_scolaire 
  LEFT JOIN kartable_eleves ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
  WHERE kartable_eleves.id_eleve = :id_eleve AND kartable_frais_scolaire.modalite = "tranche2" ');
  $reqEleve3->bindValue(':id_eleve', (int) $data1['id_eleve'], PDO::PARAM_INT);
  $reqEleve3->execute();
  $data5 = $reqEleve3->fetch();
  $dette3 = $dataTranche2['montant_modalite'] - $data5['dette'];
  
  $reqEleve4=$db->prepare('SELECT SUM(montant) AS dette FROM kartable_frais_scolaire 
  LEFT JOIN kartable_eleves ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
  WHERE kartable_eleves.id_eleve = :id_eleve');
  $reqEleve4->bindValue(':id_eleve', (int) $data1['id_eleve'], PDO::PARAM_INT);
  $reqEleve4->execute();
  $data6 = $reqEleve4->fetch();
  $dette4 = $dataTranche3['montant_modalite'] - $data6['dette'];

  $timestamp = strtotime($data1['date_paiement']);
  $date_time = date('d/m/Y',$timestamp);

  if($data1['modalite'] == "Accompte")
    {
      $dette = $dette1;
    }
    elseif($data1['modalite'] == "tranche1")
    {
      $dette = $dette2;
    }
    elseif($data1['modalite'] == "tranche2")
    {
      $dette = $dette3;
     }
    elseif($data1['modalite'] == "Solde")
    {
      $dette = $dette4;
    }
    else{
      $dette = $dette4;
    }

$html_eleve = '
<label>Réçu numéro ' . $data1['id_frais'] . '</label>
<ul>
<li>Noms de l\'élève : &nbsp;&nbsp;&nbsp;&nbsp;<strong>'.$data1['noms_eleve'].'</strong></li>
<li>Date de paiement : &nbsp;&nbsp;&nbsp;&nbsp;<strong>'.$date_time.'</strong></li>
<li>Motif : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $data1['motif'] . '</b></li>
<li>Montant payé : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $data1['montant'] .$data1['devise']. '</b></li>
<li>Modalité : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $data1['modalite'] . '</b></li>
<li>Dette  :&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$dette.' '.$data1['devise'].'</b><li>
';

$end =  '</ul> <hr>';   

$html_eleve = $html_eleve.$end;

$pdf->writeHTML($html_eleve, true, false, false, false, '');
}
  
//$pdf->writeHTML($html, true, 0);
//Impression du document complet
$fichier = str_replace('è', 'e', $classe_promo.' '.$option_promo.' '.$modalite);
$fichier = str_replace('é', 'e', $fichier);
$pdf->Output($fichier.'.pdf', 'F');
//$alerte = "Impression effectuée avec succès !";
header('location: kartable_iframe_pdf.php?nom_fichier='.$fichier);   

break;
?>


<?php
case "print_fees_by_classe_montant":

$id_classe = $_GET['id_classe'];
$montant = $_GET['montant'];

$reqPromo=$db->prepare('SELECT*  FROM kartable_frais_scolaire LEFT JOIN kartable_eleves
ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve LEFT JOIN kartable_promotion
ON kartable_eleves.promotion_id = kartable_promotion.id_promotion 
WHERE kartable_promotion.id_promotion = :id_classe');
$reqPromo->bindValue(':id_classe', (int) $id_classe, PDO::PARAM_INT);
$reqPromo->execute();
$dataPromo = $reqPromo->fetch();
$classe_promo = ($dataPromo['classe_promo'] > 1 )?($dataPromo['classe_promo']." ième"):($dataPromo['classe_promo']." ière année");
$option_promo = $dataPromo['option_promo'];

//Les fichiers de configuration
      require_once('tcpdf/config/tcpdf_config.php');
      require_once('tcpdf/tcpdf.php');
  
      //Par défaut, on passe comme paramètre PDF_PAGE_FORMAT pour remplacer le format A4
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "A4", true, 'UTF-8', false);
              //Set default font subsetting mode
                 $pdf->setFontSubsetting(true);
                    //Paramètrer les marges
                       $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                          $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
                              //Les entêtes
                                  $pdf->SetHeaderData('', '', 'Ayant au moins payé '.$montant.'$ en '.$classe_promo.' '.$option_promo, 'Imprimé le '.date('d/m/Y',time()).'', 
                                      array(83, 174, 197), array(83, 174, 197));
      
                                         //La police du header et de footer
      $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                                   //monospaced font Comme police par défaut
                        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
  
      //Encore des marges
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_FOOTER);
      //Paramètres des auto page breaks
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
  
      //Set font dejavusans is a UTF-8 Unicode font if you only need to print standard ASCII chars, you can use core fonts like helvetica or times to reduce file size
      $pdf->SetFont('dejavusans', '', 10, '', true);
      $pdf->AddPage();

      $date1 = str_replace('/', '_', $filtre_date1);
      $date2 = str_replace('/', '_', $filtre_date2);

      $solde=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "Accompte"');
      $solde->execute();
      $dataAccompte = $solde->fetch();

      $tranche1=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "tranche1"');
      $tranche1->execute();
      $dataTranche1 = $tranche1->fetch();
      
      $tranche2=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "tranche2"');
      $tranche2->execute();
      $dataTranche2 = $tranche2->fetch();
      
      $tranche3=$db->prepare('SELECT*  FROM kartable_modalite WHERE modalite = "Solde"');
      $tranche3->execute();
      $dataTranche3 = $tranche3->fetch();

$req=$db->prepare('SELECT*  FROM kartable_frais_scolaire LEFT JOIN kartable_eleves
ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve LEFT JOIN kartable_promotion
ON kartable_eleves.promotion_id = kartable_promotion.id_promotion 
WHERE kartable_promotion.id_promotion = :id_classe AND kartable_frais_scolaire.montant >= :montant');
$req->bindValue(':id_classe', (int) $id_classe, PDO::PARAM_INT);
$req->bindValue(':montant', (int) $montant, PDO::PARAM_INT);
$req->execute();

while ($data1 = $req->fetch())
{

  $reqEleve=$db->prepare('SELECT SUM(montant) AS dette FROM kartable_frais_scolaire 
  LEFT JOIN kartable_eleves ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
  WHERE kartable_eleves.id_eleve = :id_eleve AND kartable_frais_scolaire.modalite = "Accompte" ');
  $reqEleve->bindValue(':id_eleve', (int) $data1['id_eleve'], PDO::PARAM_INT);
  $reqEleve->execute();
  $data3 = $reqEleve->fetch();
  $dette1 = $dataAccompte['montant_modalite'] - $data3['dette'];
  
  $reqEleve2=$db->prepare('SELECT SUM(montant) AS dette FROM kartable_frais_scolaire 
  LEFT JOIN kartable_eleves ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
  WHERE kartable_eleves.id_eleve = :id_eleve AND kartable_frais_scolaire.modalite = "tranche1" ');
  $reqEleve2->bindValue(':id_eleve', (int) $data1['id_eleve'], PDO::PARAM_INT);
  $reqEleve2->execute();
  $data4 = $reqEleve2->fetch();
  $dette2 = $dataTranche1['montant_modalite'] - $data4['dette'];
  
  $reqEleve3=$db->prepare('SELECT SUM(montant) AS dette FROM kartable_frais_scolaire 
  LEFT JOIN kartable_eleves ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
  WHERE kartable_eleves.id_eleve = :id_eleve AND kartable_frais_scolaire.modalite = "tranche2" ');
  $reqEleve3->bindValue(':id_eleve', (int) $data1['id_eleve'], PDO::PARAM_INT);
  $reqEleve3->execute();
  $data5 = $reqEleve3->fetch();
  $dette3 = $dataTranche2['montant_modalite'] - $data5['dette'];
  
  $reqEleve4=$db->prepare('SELECT SUM(montant) AS dette FROM kartable_frais_scolaire 
  LEFT JOIN kartable_eleves ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve 
  WHERE kartable_eleves.id_eleve = :id_eleve');
  $reqEleve4->bindValue(':id_eleve', (int) $data1['id_eleve'], PDO::PARAM_INT);
  $reqEleve4->execute();
  $data6 = $reqEleve4->fetch();
  $dette4 = $dataTranche3['montant_modalite'] - $data6['dette'];

  $timestamp = strtotime($data1['date_paiement']);
  $date_time = date('d/m/Y',$timestamp);

  if($data1['modalite'] == "Accompte")
    {
      $dette = $dette1;
    }
    elseif($data1['modalite'] == "tranche1")
    {
      $dette = $dette2;
    }
    elseif($data1['modalite'] == "tranche2")
    {
      $dette = $dette3;
     }
    elseif($data1['modalite'] == "Solde")
    {
      $dette = $dette4;
    }
    else{
      $dette = $dette4;
    }

$html_eleve = '
<label>Réçu numéro ' . $data1['id_frais'] . '</label>
<ul>
<li>Noms de l\'élève : &nbsp;&nbsp;&nbsp;&nbsp;<strong>'.$data1['noms_eleve'].'</strong></li>
<li>Date de paiement : &nbsp;&nbsp;&nbsp;&nbsp;<strong>'.$date_time.'</strong></li>
<li>Motif : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $data1['motif'] . '</b></li>
<li>Montant payé : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $data1['montant'] .$data1['devise']. '</b></li>
<li>Modalité : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $data1['modalite'] . '</b></li>
<li>Dette  :&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$dette.' '.$data1['devise'].'</b><li>
';

$end =  '</ul> <hr>';   

$html_eleve = $html_eleve.$end;

$pdf->writeHTML($html_eleve, true, false, false, false, '');
}
  
//$pdf->writeHTML($html, true, 0);
//Impression du document complet
$fichier = str_replace('è', 'e', $option_promo.' '.$modalite.' au moins '.$montant);
$fichier = str_replace('é', 'e', $fichier);
$pdf->Output($fichier.'.pdf', 'F');
//$alerte = "Impression effectuée avec succès !";
header('location: kartable_iframe_pdf.php?nom_fichier='.$fichier);   

break;
?>


<?php
case "print_recu":

  $id_eleve = (isset($_GET["id_eleve"]))?htmlspecialchars($_GET["id_eleve"]):0;
  $id_frais = (isset($_GET["id_frais"]))?htmlspecialchars($_GET["id_frais"]):0;
  
$info_frais = $db->prepare('SELECT * FROM kartable_frais_scolaire LEFT JOIN kartable_eleves
LEFT JOIN kartable_promotion ON kartable_eleves.promotion_id = kartable_promotion.id_promotion
ON kartable_frais_scolaire.id_eleve = kartable_eleves.id_eleve WHERE id_frais = :id_frais AND kartable_eleves.id_eleve = :id_eleve');
$info_frais->bindValue(':id_frais', $id_frais, PDO::PARAM_INT);
$info_frais->bindValue(':id_eleve', $id_eleve, PDO::PARAM_INT);
$info_frais->execute();
$data_frais = $info_frais->fetch(); 

$classe_promo = ($data_frais['classe_promo'] > 1 )?($data_frais['classe_promo']." ième"):($data_frais['classe_promo']." ière année");
$option_promo = $data_frais['option_promo'];

      //Les fichiers de configuration
      require_once('tcpdf/config/tcpdf_config.php');
      require_once('tcpdf/tcpdf.php');
  
      //Par défaut, on passe comme paramètre PDF_PAGE_FORMAT pour remplacer le format A4
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "B3", true, 'UTF-8', false);
              //Set default font subsetting mode
                 $pdf->setFontSubsetting(true);
                                   //monospaced font Comme police par défaut
                        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
  
      //Encore des marges
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      //Paramètres des auto page breaks
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
  
      //Set font dejavusans is a UTF-8 Unicode font if you only need to print standard ASCII chars, you can use core fonts like helvetica or times to reduce file size
      $pdf->SetFont('dejavusans', '', 10, '', true);
      $pdf->AddPage();
      
if($data_frais['motif'] == "fraisScolaire")
{
  $motif = "Frais scolaires";  
}
else{
  $motif = "Autre frais";
}

$html_eleve = '
<style>
.col-sm-4 {
  position: relative;
  min-height: 1px;
  padding-right: 15px;
  padding-left: 15px;
}
.col-sm-4 {
    width: 95%;
    height: 400px;
  }

  .panel {
  margin-bottom: 20px;
  background-color: #fff;
  border: 1px solid transparent;
  -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
}
.panel-body {
  padding: 15px;
}
.panel-heading {
  padding: 10px 15px;
  border-bottom: 1px solid transparent;
  border-top-left-radius: 3px;
  border-top-right-radius: 3px;
}
.panel-title {
  margin-top: 0;
  margin-bottom: 0;
  font-size: 16px;
  color: black;
}
.panel-default {
  border-color: #ddd;
}
.panel-default > .panel-heading {
  color: black;
  background-color: #c7caca;
  border-color: #ddd;
}
.panel-default > .panel-heading + .panel-collapse > .panel-body {
  border-top-color: #ddd;
}
.panel-default > .panel-heading .badge {
  color: black;
  background-color: #c7caca;
}
.panel-default > .panel-footer + .panel-collapse > .panel-body {
  border-bottom-color: #ddd;
}

</style>
<div>
<div class="panel panel-default">
  <div class="panel-heading" style="background-color: #c7caca;">
<span class="panel-title"><span style="font-family: leelawadee;" >Reçu N° <u><strong style="font-weight: bold;letter-spacing: 1px;color: black;">&nbsp;&nbsp;'.$data_frais['id_frais'].'</strong> </u></span>
            <span style="padding-right: 15px;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            
            <span style="font-size: 17px; float: right;padding-right: 15px;"><i style="font-family: leelawadee;">Montant en chiffre</i> 
            
           <strong style="border: 1px solid transparent;background-color: white;font-size: 18px;color: black;">'.$data_frais['montant'].' '.$data_frais['devise'].'</strong> 
           <br>

           </span>

             </span>
                </span>
          </div>
          <div class="panel-body">
              <br>
            <span style="font-size: 18px;font-family: leelawadee;font-weight: bold;" > Reçu de l\'élève : <b style="font-weight: bold;letter-spacing: 2px;float: right;padding-right: 15px;
  ">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            
  '.$data_frais['noms_eleve'].'</b></span>
  <br><br>
  <span style="font-size: 18px;font-family: leelawadee;font-weight: bold;" > Sexe : <b style="font-weight: bold;letter-spacing: 2px;float: right;padding-right: 15px;
  ">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            
  '.$data_frais['sexe_eleve'].'</b></span>
  <br><br>
  <span style="font-size: 18px;font-family: leelawadee;font-weight: bold;" > Classe : <b style="font-weight: bold;letter-spacing: 2px;float: right;padding-right: 15px;
  ">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            
  '.$classe_promo.' '.$option_promo.'</b></span>


         <p></p><br>
            <span style="font-size: 18px;font-family: leelawadee;font-weight: bold;"> La somme de : <i>(en toute lettre et manuellement)</i> <br>
                <div style="border: 1px solid transparent;  color: #333333;
                background-color: #c7caca;
                border-color: #ddd;height: 200px;width: 100%;" >&nbsp;<br></div>    
            </span>
<p></p>
<span style="font-family: leelawadee;font-size: 18px;" > &nbsp;Motif : 
<b style="letter-spacing: 2px;font-weight: bold;font-size: 18px;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   
'.$motif.'
</b></span>
<br>

<span style="font-family: leelawadee;font-size: 18px;" > &nbsp;Modalité : 
  <b style="letter-spacing: 2px;font-weight: bold;font-size: 18px;">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     
  '.$data_frais['modalite'].'
  </b></span>
<div>
    <br><br>
    <span style="font-family: leelawadee;font-size: 18px;"> Signature du (de la) caissier (è)</span>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   
    <span style="font-family: leelawadee;float: right;font-size: 18px;" > Fait à kinshasa, <u style="font-weight: bold;">'.$data_frais['date_paiement'].'</u></span>
    <p></p><br>

</div>
        </div>
        </div>
';

$pdf->writeHTML($html_eleve, true, false, false, false, '');
//Impression du document complet
$fichier = 'Recu frais num '.$id_frais;
$pdf->Output($fichier.'.pdf', 'F');
header('location: kartable_iframe_pdf.php?nom_fichier='.$fichier);   
break;
?>


<?php
case "print_historique_emprunt":
//Les fichiers de configuration
      require_once('tcpdf/config/tcpdf_config.php');
      require_once('tcpdf/tcpdf.php');
  
      //Par défaut, on passe comme paramètre PDF_PAGE_FORMAT pour remplacer le format A4
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "A4", true, 'UTF-8', false);
              //Set default font subsetting mode
                 $pdf->setFontSubsetting(true);
                    //Paramètrer les marges
                       $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                          $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
                              //Les entêtes
                                  $pdf->SetHeaderData('', '', 'Emprunts des salariés', 'Imprimé le '.date('d/m/Y',time()).'',                                      array(83, 174, 197), array(83, 174, 197));
                                         //La police du header et de footer
      $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                                   //monospaced font Comme police par défaut
                        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);  
      //Encore des marges
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_FOOTER);
      //Paramètres des auto page breaks
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
      //Set font dejavusans is a UTF-8 Unicode font if you only need to print standard ASCII chars, you can use core fonts like helvetica or times to reduce file size
      $pdf->SetFont('dejavusans', '', 10, '', true);
      $pdf->AddPage();

$req=$db->prepare('SELECT*  FROM kartable_emprunt LEFT JOIN kartable_personnel
ON kartable_emprunt.id_personnel = kartable_personnel.id_personel 
ORDER BY date_emp ASC');
$req->execute();

while ($data1 = $req->fetch())
{
  if($data1['devise_emp'] == "usd")
  {
      $exchange_rate = "$";
  }
  elseif($data1['devise_emp'] == "fc")
  {
      $exchange_rate = "FC";
  }
  else{
      $exchange_rate = "Francs";
  }

$html_personnel = '
<label>Emprunt N° ' . $data1['id_emp'] . '</label>
<ul>
<li>Noms du salarié : &nbsp;&nbsp;&nbsp;&nbsp;<strong>'.$data1['noms_personel'].'</strong></li>
<li>Date : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $data1['date_emp'] . '</b></li>
<li>Somme empruntée : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $data1['montant_emp'] .$exchange_rate. '</b></li>
<li>Note : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $data1['note_emp'] . '</b></li>
<li>Administrateur  :&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$data1['id_admin'].'</b></li>
';

$end =  '</ul> <hr>';   

$html_personnel = $html_personnel.$end;

$pdf->writeHTML($html_personnel, true, false, false, false, '');
}
//$pdf->writeHTML($html, true, 0);
//Impression du document complet
$fichier = "Emprunts";
$pdf->Output($fichier.'.pdf', 'F');
//$alerte = "Impression effectuée avec succès !";
header('location: kartable_iframe_pdf.php?nom_fichier='.$fichier);   

break;
?>



<?php
case "print_salaire_story":

      //Les fichiers de configuration
      require_once('tcpdf/config/tcpdf_config.php');
      require_once('tcpdf/tcpdf.php');
  
      //Par défaut, on passe comme paramètre PDF_PAGE_FORMAT pour remplacer le format A4
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "A4", true, 'UTF-8', false);
              //Set default font subsetting mode
                 $pdf->setFontSubsetting(true);
                    //Paramètrer les marges
                       $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                          $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
                              //Les entêtes
                                  $pdf->SetHeaderData('', '', 'Bulletin de paie des personnels', 'Imprimé le '.date('d/m/Y',time()).'', 
                                      array(83, 174, 197), array(83, 174, 197));
      
                                         //La police du header et de footer
      $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                                   //monospaced font Comme police par défaut
                        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
  
      //Encore des marges
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_FOOTER);
      //Paramètres des auto page breaks
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
  
      //Set font dejavusans is a UTF-8 Unicode font if you only need to print standard ASCII chars, you can use core fonts like helvetica or times to reduce file size
      $pdf->SetFont('dejavusans', '', 10, '', true);
      $pdf->AddPage();

$req=$db->prepare('SELECT*  FROM kartable_remuneration LEFT JOIN kartable_personnel
ON kartable_remuneration.id_personnel = kartable_personnel.id_personel 
ORDER BY date_rem ASC');
$req->execute();

while ($data1 = $req->fetch())
{
  if($data1['devise_rem'] == "usd")
  {
      $exchange_rate = "$";
  }
  elseif($data1['devise_rem'] == "fc")
  {
      $exchange_rate = "FC";
  }
  else{
      $exchange_rate = "Francs";
  }

$html_salaire = '
<label>Rémunération N° ' . $data1['id_rem'] . '</label>
<ul>
<li>Noms du personnel : &nbsp;&nbsp;&nbsp;&nbsp;<strong>'.$data1['noms_personel'].'</strong></li>
<li>Motif : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $data1['type_rem'] . '</b></li>
<li>Date : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $data1['date_rem'] .'</b></li>
<li>Somme rémunérée : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $data1['montant_rem'] .' '.$exchange_rate. '</b></li>
';

$end =  '</ul> <hr>';   
$html_salaire = $html_salaire.$end;
$pdf->writeHTML($html_salaire, true, false, false, false, '');
}
  
$fichier = 'Bulletin_de_paie_des_personnels';
$pdf->Output($fichier.'.pdf', 'F');
header('location: kartable_iframe_pdf.php?nom_fichier='.$fichier);   

break;
?>


<?php
case "print_payement_by_month":
$month = $_GET['month'];
$month2 = $_GET['month2'];
      //Les fichiers de configuration
      require_once('tcpdf/config/tcpdf_config.php');
      require_once('tcpdf/tcpdf.php');
  
      //Par défaut, on passe comme paramètre PDF_PAGE_FORMAT pour remplacer le format A4
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "A4", true, 'UTF-8', false);
              //Set default font subsetting mode
                 $pdf->setFontSubsetting(true);
                    //Paramètrer les marges
                       $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                          $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
                              //Les entêtes
                                  $pdf->SetHeaderData('', '', 'Bulletin de paie au mois de '.$month2.'', 'Imprimé le '.date('d/m/Y',time()).'', 
                                      array(83, 174, 197), array(83, 174, 197));
      
                                         //La police du header et de footer
      $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                                   //monospaced font Comme police par défaut
                        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
  
      //Encore des marges
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_FOOTER);
      //Paramètres des auto page breaks
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
  
      //Set font dejavusans is a UTF-8 Unicode font if you only need to print standard ASCII chars, you can use core fonts like helvetica or times to reduce file size
      $pdf->SetFont('dejavusans', '', 10, '', true);
      $pdf->AddPage();

      $req=$db->prepare('SELECT*  FROM kartable_remuneration LEFT JOIN kartable_personnel
      ON kartable_remuneration.id_personnel = kartable_personnel.id_personel WHERE kartable_remuneration.mois_rem = :mois
      ORDER BY date_rem DESC');
      $req->bindValue(':mois', $month, PDO::PARAM_STR);
      $req->execute();

while ($data1 = $req->fetch())
{
    if($data1['devise_rem'] == "usd")
    {
        $exchange_rate = "$";
    }
    elseif($data1['devise_rem'] == "fc")
    {
        $exchange_rate = "FC";
    }
    else{
        $exchange_rate = "Francs";
    }

$html_salaire = '
<label>Rémunération N° ' . $data1['id_rem'] . '</label>
<ul>
<li>Noms du personnel : &nbsp;&nbsp;&nbsp;&nbsp;<strong>'.$data1['noms_personel'].'</strong></li>
<li>Motif : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $data1['type_rem'] . '</b></li>
<li>Date : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $data1['date_rem'] .'</b></li>
<li>Somme rémunérée : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $data1['montant_rem'] .' '.$exchange_rate. '</b></li>
';

$end =  '</ul> <hr>';   
$html_salaire = $html_salaire.$end;
$pdf->writeHTML($html_salaire, true, false, false, false, '');
}
  
$month = str_replace('/', '_', $month);
$fichier = 'Bulletin_de_paie_au_'.$month;
$pdf->Output($fichier.'.pdf', 'F');
header('location: kartable_iframe_pdf.php?nom_fichier='.$fichier);   

break;
?>

<?php
case "print_payement_by_personnal":
$id_personnel = $_GET['id_personnel'];
$noms = $_GET['noms'];
      //Les fichiers de configuration
      require_once('tcpdf/config/tcpdf_config.php');
      require_once('tcpdf/tcpdf.php');
  
      //Par défaut, on passe comme paramètre PDF_PAGE_FORMAT pour remplacer le format A4
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "A4", true, 'UTF-8', false);
              //Set default font subsetting mode
                 $pdf->setFontSubsetting(true);
                    //Paramètrer les marges
                       $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                          $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
                              //Les entêtes
                                  $pdf->SetHeaderData('', '', 'Bulletin de paie pour Mr / Mme '.$noms.'', 'Imprimé le '.date('d/m/Y',time()).'', 
                                      array(83, 174, 197), array(83, 174, 197));
      
                                         //La police du header et de footer
      $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                                   //monospaced font Comme police par défaut
                        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
  
      //Encore des marges
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_FOOTER);
      //Paramètres des auto page breaks
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
  
      //Set font dejavusans is a UTF-8 Unicode font if you only need to print standard ASCII chars, you can use core fonts like helvetica or times to reduce file size
      $pdf->SetFont('dejavusans', '', 10, '', true);
      $pdf->AddPage();

      $req=$db->prepare('SELECT*  FROM kartable_remuneration LEFT JOIN kartable_personnel
      ON kartable_remuneration.id_personnel = kartable_personnel.id_personel WHERE kartable_remuneration.id_personnel = :id_personnel
      ORDER BY date_rem DESC');
      $req->bindValue(':id_personnel', $id_personnel, PDO::PARAM_INT);
      $req->execute();

while ($data1 = $req->fetch())
{
    if($data1['devise_rem'] == "usd")
    {
        $exchange_rate = "$";
    }
    elseif($data1['devise_rem'] == "fc")
    {
        $exchange_rate = "FC";
    }
    else{
        $exchange_rate = "Francs";
    }

$html_salaire = '
<label>Rémunération N° ' . $data1['id_rem'] . '</label>
<ul>
<li>Motif : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $data1['type_rem'] . '</b></li>
<li>Date : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $data1['date_rem'] .'</b></li>
<li>Somme rémunérée : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $data1['montant_rem'] .' '.$exchange_rate. '</b></li>
';

$end =  '</ul> <hr>';   
$html_salaire = $html_salaire.$end;
$pdf->writeHTML($html_salaire, true, false, false, false, '');
}
  
$fichier = 'Bulletin_de_paie_de_'.$noms;
$pdf->Output($fichier.'.pdf', 'F');
header('location: kartable_iframe_pdf.php?nom_fichier='.$fichier);   

break;
?>


<?php
case "print_contrat":
$contrat = $_GET['data'];
      //Les fichiers de configuration
      require_once('tcpdf/config/tcpdf_config.php');
      require_once('tcpdf/tcpdf.php');
  
      //Par défaut, on passe comme paramètre PDF_PAGE_FORMAT pour remplacer le format A4
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "A4", true, 'UTF-8', false);
              //Set default font subsetting mode
                 $pdf->setFontSubsetting(true);
                    //Paramètrer les marges
                       $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                          $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
                              //Les entêtes
                                  $pdf->SetHeaderData('', '', 'contrat du '.$contrat['1'].'', 'Imprimé le '.date('d/m/Y',time()).'', 
                                      array(83, 174, 197), array(83, 174, 197));
      
                                         //La police du header et de footer
      $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                                   //monospaced font Comme police par défaut
                        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
  
      //Encore des marges
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_FOOTER);
      //Paramètres des auto page breaks
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
  
      //Set font dejavusans is a UTF-8 Unicode font if you only need to print standard ASCII chars, you can use core fonts like helvetica or times to reduce file size
      $pdf->SetFont('dejavusans', '', 10, '', true);
      $pdf->AddPage();


$html_salaire = '
<ul>
<li>Nom du résponsable : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $contrat['0'] . '</b></li>
<li>Date de début : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $contrat['1'] .'</b></li>
<li>Echéance : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $contrat['2'] .'</b></li>
<li>Echéance : &nbsp;&nbsp;&nbsp;&nbsp;<b>' . $contrat['4'] .'</b></li>
';

$end =  '</ul> <hr>';   
$html_salaire = $html_salaire.$end;
$pdf->writeHTML($html_salaire, true, false, false, false, '');

  
$fichier = 'contrat_de_licence';
$pdf->Output($fichier.'.pdf', 'F');
header('location: kartable_iframe_pdf.php?nom_fichier='.$fichier);   

break;
?>


<?php
case "test_sur_tableau":
      //Les fichiers de configuration
      require_once('tcpdf/config/tcpdf_config.php');
      require_once('tcpdf/tcpdf.php');
  
      //Par défaut, on passe comme paramètre PDF_PAGE_FORMAT pour remplacer le format A4
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "A4", true, 'UTF-8', false);
              //Set default font subsetting mode
                 $pdf->setFontSubsetting(true);
                    //Paramètrer les marges
                       $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                          $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
                              //Les entêtes
                                  $pdf->SetHeaderData('', '', 'Test sur tableau', 'Imprimé le '.date('d/m/Y',time()).'', 
                                      array(83, 174, 197), array(83, 174, 197));
      
                                         //La police du header et de footer
      $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                                   //monospaced font Comme police par défaut
                        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
  
      //Encore des marges
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_FOOTER);
      //Paramètres des auto page breaks
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
  
      //Set font dejavusans is a UTF-8 Unicode font if you only need to print standard ASCII chars, you can use core fonts like helvetica or times to reduce file size
      $pdf->SetFont('dejavusans', '', 10, '', true);
      $pdf->AddPage();

      
      $html_corps = '<table>
      <thead>
        <tr>
          <th>Noms</th>
        </tr>
      </thead>
      <tbody>
        <tr>'.set_name().'
        </tr>
        </tbody>
        </table>';

        $pdf->writeHTML($html_corps, true, false, false, false, '');
  
$fichier = 'test';
$pdf->Output($fichier.'.pdf', 'F');
header('location: kartable_iframe_pdf.php?nom_fichier='.$fichier);   

break;
?>


<?php
case "autre_fichier":
// Autre fonction
function imprimer($formuliare_eleve)
{
   require_once("tcpdf/tcpdf.php");
    $pdf = new TCPDF();

    //Set document information
    $pdf->SetAuthor("SOLIPHAIRE Sarl");
    $pdf->SetTitle("Facture");
    $pdf->SetSubject("Achat N°");
    
    //Set header and footer fonts
    $pdf->SetHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->SetFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    //Margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    
    //Set Auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    $pdf->SetImageScale(PDF_IMAGE_SCALE_RATIO);
    $pdf->getAliasNbPages();
    $pdf->AddPage();

    //Set font
    $pdf->SetFont("helvetica", "", 12);
    $pdf->SetFillColor(250, 250, 255, true);
    $pdf->SetFont("", "b", 12);


    $nbreData = count($formuliare_eleve);
    for($i=0;$i<$nbreData;$i++)
    {
        $pdf->Write(12, $formuliare_eleve[$i]."\n", "Www.solophiareSarl.com", $i, 'C');
    }
    $pdf->Output("filename.pdf", "F");
}
break;
}
?>