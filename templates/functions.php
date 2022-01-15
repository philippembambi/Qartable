<?php
class client
{
    private $_db; //instance de PDO

public function __construct($db)
{    
        $this->setDb($db);  
}

public function getClient()
{
  $requete = $this->_db->prepare('SELECT*  FROM clients');
  $requete->execute(); 
  while($data = $requete->fetch())
  {
    echo $data['noms_client'];
  }
    
}

public function getSolde()
{

  $requete = $this->_db->prepare('SELECT*  FROM clients');
  $requete->execute(); 
  
  while($data = $requete->fetch())
  {
  echo $data['solde_client'];   
  }
}

public function setDb(PDO $db)
{
    $this->_db = $db;
}
}
//trigger_error("Something is wrong !", E_USER_ERROR);
?>