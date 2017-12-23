<?php  


$_CONFIG['conf_gala'] = [
  'sql_host' => "localhost",
  'sql_db'   => "icam_galadesicam",
  'sql_user' => "root",
  'sql_pass' => ""
];

$confSQL = $_CONFIG['conf_gala'];

try{
  $bd = new PDO('mysql:host='.$confSQL['sql_host'].';dbname='.$confSQL['sql_db'].';charset=utf8',$confSQL['sql_user'],$confSQL['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
} catch(Exeption $e) {
  die('erreur:'.$e->getMessage());
}

$parametre=$bd->prepare('SELECT * FROM configs');
$parametre->execute();
$valeurs=$parametre->fetchAll();

$participants = $bd->prepare('SELECT COUNT(*) FROM guests');
$participants->execute();
$nb_participants = $participants->fetch();

$liste_invite = $bd->prepare('SELECT * FROM guests LIMIT 0,25');
$liste_invite->execute();
$invite = $liste_invite->fetchAll();
// var_dump($valeurs);
// $confSQL['quotas']=array('parents'=>$valeurs['quota_parent'], 
//   'ingenieur'=>$valeurs['quota_ingenieur']);
// $confSQL['tarifs']=array(
//   'place' => $valeurs['prix_soiree'],
//   'diner' => $valeurs['prix_diner'],
//   'conf' => $valeurs['prix_conference'],
//   'ticket_boisson' => $valeurs['prix_ticket_boisson']);


  ?>