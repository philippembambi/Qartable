<?php
abstract class Vehicule
{
    const MOTEUR = true;
    const TYPE_VEHICULE_A = "voiture";
    const TYPE_VEHICULE_B = "moto_cyclique";
    const TYPE_VEHICULE_C = "avion";
    const TYPE_VEHICULE_D = "hélicoptère";
    protected $v_nbre_litre_essence;
    protected $v_vitesse;
    protected $v_vitesse_max = 0;
    protected $v_acceleration = 0;
    protected $v_model;
    protected $v_type_vehicule;
    protected $v_type_mouvement;

    protected function mouver($type_mouvement, $vitesse)
    {
        $this->v_vitesse = $vitesse;

        switch($type_mouvement)
        {
        //Action de rouler    
        case "rouler":
            $this->v_type_mouvement = "rouler";

            if((!is_int($vitesse))){
                echo "\n";
                echo '** Veillez entrer une vitesse !';
              }
              else{
                  if(!isset($this->v_vitesse_max) || $vitesse > $this->v_vitesse_max){
                    echo "\n";
                      echo 'Debordement de vitesse, veillez ralentir !';
                  }
                  else{
                    echo "\n";
                      echo '**** L\'automobile :'.$this->v_model.' roule maintenant a une de vitesse de :'.$this->v_vitesse.' Km / h ****';
                  }
              }
        break;

        //Action de voler
        case "voler":
            $this->v_type_mouvement = "voler";

            if((!is_int($vitesse))){
                echo "\n";
                echo 'Veillez entrer une vitesse';
              }
              else{
                  if(!isset($this->v_vitesse_max) || $vitesse > $this->v_vitesse_max){
                    echo "\n";                    
                      echo 'Debordement de vitesse, veillez ralentir !';
                  }
                  else{
                      echo "\n";
                      echo '**** L\engin :'.$this->v_model.' vole maintenant a une de vitesse de :'.$this->v_vitesse.' Km / h ****';
                  }
              }
        default:
        echo "\n";
        echo 'Aucun mouvement defini';
        break;

        }
        
    }
    
    protected function accelerer()
    {
        $this->v_acceleration = rand(1, 100);
        $this->v_vitesse += $this->v_acceleration;
        echo "\n";
        echo '______ Le vehicule : '.$this->v_model.' a accelere la vitesse a : '.$this->v_acceleration.'Km / h ______';
        $this->mouver($this->v_type_mouvement, $this->v_vitesse);
    }

    protected function ralentir()
    {
        $this->v_acceleration = rand(1, 50);
        $this->v_vitesse -= $this->v_acceleration;
        echo "\n";
        echo '______ Le vehicule : '.$this->v_model.' a ralenti la vitesse à : '.$this->v_acceleration.' Km / h ______';
        $this->mouver($this->v_type_mouvement, $this->v_vitesse);
    }

    protected function freiner()
    {
        $this->v_vitesse = 0;
        echo "\n";
        echo '______ La vitesse actuelle de : '.$this->v_model.' est de : '.$this->v_vitesse.' Km / h ______';
    }

}


abstract class Automobile extends Vehicule
{
    protected $auto_nbre_roue;

    protected abstract function klaxonner();
    
}


class Voiture extends Automobile
{
    public function __construct($model)
    {    
        $this->v_model = $model;
        $this->v_type_vehicule = self::TYPE_VEHICULE_A; //Accéder à une constante
        $this->auto_nbre_roue = 4;
        $this->v_vitesse_max = 120;
        echo 'Type de vehicule : '.$this->v_type_vehicule;
    }

    public function klaxonner()
    {
        echo "Mvvrrummmm Mvvrrummmm !";
    }

    public function __clone()
    {
        echo 'L\'objet : '.$this->v_type_vehicule.' est en clone (copie)';
    }

    public function __destruct()
    {

    }
}

class Moto_cyclique extends Automobile
{
    public function __construct($model)
    {    
        $this->v_model = $model;
        $this->v_type_vehicule = self::TYPE_VEHICULE_B; //Accéder à une constante
        $this->auto_nbre_roue = 2;
        $this->v_vitesse_max = 80;
        echo 'Type de vehicule : '.$this->v_type_vehicule;
    }

    public function klaxonner()
    {
        echo "Piiippiiii !";
    }

    public function __clone()
    {
        echo 'L\'objet : '.$this->v_type_vehicule.' est en clone (copie)';
    }

    public function __destruct()
    {
        
    }
}

abstract class Aero_transport extends Vehicule
{
    protected $aero_altitude;
    protected $aero_longitude;
    protected $aero_latitude;
    protected $aero_distance_trajectoire;
    protected $aero_point_A;
    protected $aero_point_B;

    protected abstract function decoller($point_A, $point_B, $distance, $latitude, $longitude, $vitesse_decollage);
    protected abstract function voler($vitesse_vol, $altitude); // Méthode à rédefinir
    protected abstract function atterir($vitesse_atterissage); // Méthode à rédefinir
    
    protected function activer_pilotage_automatique($point_A, $point_B, $distance)
    {

    }
}

class Avion extends Aero_transport
{
    public function __construct($model)
    {    
        $this->v_model = $model;
        $this->v_type_vehicule = self::TYPE_VEHICULE_C; //Accéder à une constante
        $this->auto_nbre_roue = 2;
        $this->v_vitesse_max = 80;
        echo 'Type de vehicule : '.$this->v_type_vehicule;
    }
}
?>

<?php
//Fonction principale

$ma_voiture = new Voiture('Mercedes');
$ma_voiture->mouver('rouler', 70);
$ma_voiture->accelerer();

echo "\n";
echo "\n";

$ma_moto = new Moto_cyclique('Hoaujin');
$ma_moto->mouver('rouler', 70);
$ma_moto->accelerer();
//unset($ma_moto); //Fait appel au destructeur

//$ma_moto2 = clone $ma_moto; 
echo "\n";
echo "\n";
//Le clonage : copie de l'objet avec des attributs initialement identiques
$ma_moto2 = clone $ma_moto; 
$ma_moto2->mouver('rouler', 60);
$ma_moto2->freiner();
echo "\n";
echo "\n";

?>