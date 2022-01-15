<?php 
function set_name(){
    require('database.php');
$req=$db->prepare('SELECT*  FROM kartable_personnel');
$req->execute();

        for($i = 0; $data = $req->fetch(); $i++)
        {
          return '<td>'.$data['noms_personel'].'</td>';
        }
      }
?>