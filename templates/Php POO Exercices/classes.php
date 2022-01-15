<?php
abstract class Vehicule
{
    protected $v_moteur = true;
    protected $v_nbre_litre_essence;
    protected $v_vitesse;
    protected $v_vitesse_max = 0;
    protected $v_acceleration = 0;
    protected $v_marque;

    public function rouler($vitesse)
    {
        $this->v_vitesse = $vitesse;
        
        if((!is_int($vitesse))){
          echo 'Veillez entrer une vitesse';
          echo "\n";
        }
        else{
            if(!isset($this->v_vitesse_max) || $vitesse > $this->v_vitesse_max){
                echo 'Debordement de vitesse, veillez ralentir !';
                echo "\n";
            }
            else{
                echo '**** Le vehicule :'.$this->v_marque.' roule maintenant a une de vitesse de :'.$this->v_vitesse.' Km / h ****';
                echo "\n";
            }
        }
    }
    
    public function accelerer()
    {
        $this->v_acceleration = rand(1, 100);
        $this->v_vitesse += $this->v_acceleration;
       
        echo '______ Le vehicule :'.$this->v_marque.' a accelere la vitesse a :'.$this->v_acceleration.'Km / h ______';
        echo "\n";
        $this->rouler($this->v_vitesse);
    }

    public function ralentir()
    {
        $this->v_acceleration = rand(1, 50);
        $this->v_vitesse -= $this->v_acceleration;
       
        echo '______ Le vehicule :'.$this->v_marque.' a ralenti la vitesse a :'.$this->v_acceleration.' Km / h ______';
        echo "\n";
        $this->rouler($this->v_vitesse);
    }
}


abstract class Automobile extends Vehicule
{
    protected $auto_nbre_roue;

    
}

class Voiture extends Automobile
{
    public function __construct($marque)
    {    
        $this->v_marque = $marque;
        $this->auto_nbre_roue = 4;
        $this->v_vitesse_max = 120;
    }
}

class Moto_cyclique extends Automobile
{
    public function __construct($marque)
    {    
        $this->v_marque = $marque;
        $this->auto_nbre_roue = 2;
        $this->v_vitesse_max = 80;
    }
}

class Aero_transport extends Automobile
{
    public function __construct($marque)
    {    
        $this->v_marque = $marque;
        $this->auto_nbre_roue = 2;
        $this->v_vitesse_max = 80;
    }
}
?>

<?php
$voiture = new Voiture('Mercedes');
$voiture->rouler();
echo "\n";
$voiture->accelerer();
?>