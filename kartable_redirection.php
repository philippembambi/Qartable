<?php
$Maclasse = $_GET["Maclasse"];
$Masection = $_GET["Masection"];

switch($Maclasse)
{
case $Maclasse == 1:
    header("location: kartable_promo.php?id_promo=1");
break;

case $Maclasse == 2:
    header("location: kartable_promo.php?id_promo=2");
break;
//La troisième année

case $Maclasse == 3 && $Masection == 'latinphilo':
    header("location: kartable_promo.php?id_promo=3");
break;

case $Maclasse == 3 && $Masection == 'biochimie':
    header("location: kartable_promo.php?id_promo=7");
break;

case $Maclasse == 3 && $Masection == 'commerciale':
    header("location: kartable_promo.php?id_promo=11");
break;

//La quatrième année
case $Maclasse == 4 && $Masection == 'latinphilo':
    header("location: kartable_promo.php?id_promo=4");
break;

case $Maclasse == 4 && $Masection == 'biochimie':
    header("location: kartable_promo.php?id_promo=8");
break;

case $Maclasse == 4 && $Masection == 'commerciale':
    header("location: kartable_promo.php?id_promo=12");

//La cinquième année

case $Maclasse == 5 && $Masection == 'latinphilo':
    header("location: kartable_promo.php?id_promo=5");
break;

case $Maclasse == 5 && $Masection == 'biochimie':
    header("location: kartable_promo.php?id_promo=9");
break;

case $Maclasse == 5 && $Masection == 'commerciale':
    header("location: kartable_promo.php?id_promo=13");
break;

//La sixième année

case $Maclasse == 6 && $Masection == 'latinphilo':
    header("location: kartable_promo.php?id_promo=6");
break;

case $Maclasse == 6 && $Masection == 'biochimie':
    header("location: kartable_promo.php?id_promo=10");
break;

case $Maclasse == 6 && $Masection == 'commerciale':
    header("location: kartable_promo.php?id_promo=14");
break;
}
?>