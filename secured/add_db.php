<?php

session_start();

require '../include/display_functions.php';
require '../config.php';
require '../include/db_functions.php';

$bd = connect_to_db($confSQL);


if(isset($_POST['conférence']))
{
    $buffet=1;
}
else
{
    $buffet=0;
}

if($_POST['is_icam']=1)
{
    if(isset($_POST['dîner']))
    {
        $repas=1;
    }
    else
    {
        $repas=0;
    }
    $bracelet = (int)$_POST['bracelet'];
    $creneau = $_POST['creneau'];
    $correct= is_correct_bracelet($bracelet, $creneau);
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    if($bracelet=="")
    {
        $bracelet=null;
    }
    if($tel=="")
    {
        $tel=null;
    }
    if($email=="")
    {
        $email=null;
    }
    if(!$correct)
    {
        $_SESSION['erreur_ajout']=$_POST;
        goto end;
    }
    $insert = $bd->prepare('INSERT INTO guests(nom, prenom, repas, buffet, is_icam, promo, email, telephone, inscription, bracelet_id, plage_horaire_entrees, paiement, price, tickets_boisson) VALUES (:nom, :prenom, :repas, :buffet, 1, :promo, :email, :telephone, CURRENT_TIMESTAMP(), :bracelet_id, :plage_horaire_entrees, :paiement, :price, :tickets_boisson)');
    $insert ->execute(array(
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'repas' => $repas,
        'buffet' => $buffet,
        'promo' => $_POST['promo'],
        'email' => $email,
        'telephone' => $tel,
        'bracelet_id' => $bracelet,
        'plage_horaire_entrees' => $creneau,
        'paiement' => $_POST['paiement'],
        'price' => $_POST['price'],
        'tickets_boisson' => $_POST['tickets']
        ));
}

end:
header('Location: ajouter_invite.php');