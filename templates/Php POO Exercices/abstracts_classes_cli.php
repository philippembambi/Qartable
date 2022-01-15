<?php
abstract class Vehicule
{
    const MOTEUR = true;
    const TYPE_VEHICULE_A = "voiture";
    const TYPE_VEHICULE_B = "moto_cyclique";
    protected $v_nbre_litre_essence;
    protected $v_vitesse;
    protected $v_vitesse_max = 0;
    protected $v_acceleration = 0;
    protected $v_marque;
    protected $v_type_vehicule;
    protected $v_type_mouvement;
    protected $auto_nbre_roue;

    abstract function rouler($type_mouvement, $vitesse); //On force les sous-types à implementer cette fonction
    
    public function accelerer()
    {
        $this->v_acceleration = rand(1, 100);
        $this->v_vitesse += $this->v_acceleration;
        echo "\n";
        echo '______ Le vehicule : '.$this->v_marque.' a accelere la vitesse a : '.$this->v_acceleration.'Km / h ______';
        $this->rouler($this->v_type_vehicule, $this->v_vitesse);
    }

    public function ralentir()
    {
        $this->v_acceleration = rand(1, 50);
        $this->v_vitesse -= $this->v_acceleration;
        echo "\n";
        echo '______ Le vehicule : '.$this->v_marque.' a ralenti la vitesse à : '.$this->v_acceleration.' Km / h ______';
        $this->rouler($this->v_type_vehicule, $this->v_vitesse);
    }

    public function freiner()
    {
        $this->v_vitesse = 0;
        echo "\n";
        echo '______ La vitesse actuelle de : '.$this->v_marque.' est de : '.$this->v_vitesse.' Km / h ______';
    }

}


class Voiture extends Vehicule
{
    public function __construct($marque)
    {    
        $this->v_marque = $marque;
        $this->v_type_vehicule = self::TYPE_VEHICULE_A; //Accéder à une constante
        $this->auto_nbre_roue = 4;
        $this->v_vitesse_max = 120;
        echo 'Type de vehicule : '.$this->v_type_vehicule;
    }

    public function rouler($type_mouvement, $vitesse)
    {
        $this->v_vitesse = $vitesse;
        //Action de rouler    
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
                      echo '**** L\'automobile :'.$this->v_marque.' roule maintenant a une de vitesse de :'.$this->v_vitesse.' Km / h ****';
                  }
              }
    }


    public function __clone()
    {
        echo 'L\'objet : '.$this->v_type_vehicule.' est en clone (copie)';
    }

    public function __destruct()
    {

    }
}

class Moto_cyclique extends Vehicule
{
    public function __construct($marque)
    {    
        $this->v_marque = $marque;
        $this->v_type_vehicule = self::TYPE_VEHICULE_B; //Accéder à une constante
        $this->auto_nbre_roue = 2;
        $this->v_vitesse_max = 80;
        echo 'Type de vehicule : '.$this->v_type_vehicule;
    }

    public function rouler($type_mouvement, $vitesse)
    {
        $this->v_vitesse = $vitesse;
        //Action de rouler    
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
                      echo '**** L\'automobile :'.$this->v_marque.' roule maintenant a une de vitesse de :'.$this->v_vitesse.' Km / h ****';
                  }
              }
    }

    public function __clone()
    {
        echo 'L\'objet : '.$this->v_type_vehicule.' est en clone (copie)';
    }

    public function __destruct()
    {
        
    }
}

?>

<?php
//**Création des objets */
//Objet voiture
$ma_voiture = new Voiture('Mercedes');
$ma_voiture->rouler('voiture', 70);
$ma_voiture->accelerer();
echo "\n";
echo "\n";
//Objet Moto_cyclique
$ma_moto = new Moto_cyclique('Hoaujin');
$ma_moto->rouler('moto', 70);
$ma_moto->accelerer(); 
echo "\n";
echo "\n";
//Le clonage : copie de l'objet avec des attributs initialement identiques
$ma_moto2 = clone $ma_moto; 
$ma_moto2->rouler('moto', 60);
$ma_moto2->freiner();
echo "\n";
echo "\n";
//Destruction
unset($ma_moto); //Fait appel au destructeur
unset($ma_voiture); //Fait appel au destructeur
unset($ma_moto2); //Fait appel au destructeur en effacçant même les references
?>