<?php
function histo($x,$y,$donn,$texte, $details)
{
    $image=imagecreate($x,$y);
    //la première couleur déclarée est la couleur de fond
    $ocre=imagecolorallocate($image,220,220,220);
    $blanc=imagecolorallocate($image,255,255,255);
    $bleu =imagecolorallocate($image,255,255,255);
    $noir =imagecolorallocate($image,0,0,0);
    $vert=imagecolorallocate($image,51, 136, 204);
    $nbcol=count($donn);
    $maxi=0;
    //Recherche de la valeur maxi  
    for($i=0;$i<$nbcol;$i++)
    {
        $maxi = max($maxi,$donn[$i]);
    }  
    //coefficient d'échelle  
    $coeff = ($y*0.8)/ $maxi;
    $XO = 10;
    $YO = $y-50;
    $larg = ($x-20)/$nbcol;
    //coordonnées des sommets des rectangles  
    for($i=0;$i<$nbcol;$i++)
    {
        $tabX[$i] = $XO + $larg*$i;
        $tabY[$i] = $YO - $coeff*$donn[$i];
    }  
    //tracé des rectangles  
    for($i=0;$i<$nbcol;$i++)
    {    
        //tracés des rectangles en noir 
        imagerectangle($image,$tabX[$i],$tabY[$i],$tabX[$i]+$larg,$YO,$noir);
        //remplissage des rectangles en jaune    
        imagefill($image,$tabX[$i]+5,$YO-5,$vert);
         //Écriture des données au dessus des rectangles
     //    @imagettftext($image,15,0,$tabX[$i]+20,$tabY[$i]-5,$noir,"./assets/fonts/fontawesome-webfont.ttf",$donn[$i]);
         imagestring($image,50,$tabX[$i]+20,$tabY[$i]-1, $donn[$i]. ' $', $blanc);

         //Écriture des jours en bas des rectangles    
        //@imagettftext($image,15,0,$tabX[$i]+20,$y-55,$bleu,"./assets/fonts/fontawesome-webfont.ttf", $texte[$i]);
        imagestring($image,20,$tabX[$i]+20,$y-50, $texte[$i], $noir);

    }
    //Écriture du titre de l'histogramme en bas  
    imagestring($image,20,10, $y-23, $details.' $', $noir);

  //enregistre l'image  
  imagepng($image,"histo_frais.png");
  //Libère la mémoire  
  imagedestroy($image);
  }
  ?>