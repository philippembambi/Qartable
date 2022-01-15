<?php
require('database.php');
require('kartable_debut.php');

if($var_print_calculator == 'print_calculator')
{
  header('location: ./ktb_gestion_cotes.php');
}
elseif($var_print_class == "print_class")
{
  header('location: ./ktb_gestion_eleve.php');
}
elseif($var_print_cpte == "print_cpte")
{
  header('location: ./ktb_gestion_financiere.php');
}
elseif($var_print_perso == "print_personnel")
{
  header('location: ./ktb_gestion_personnel.php');
}
elseif($var_root == "root")
{
  header('location: ./kartable_config.php');
}
else
 {
    $msg = 'Accès réfusé !';
    header('location: ./dialog.php?msg='.$msg);
   }
?>