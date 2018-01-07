<?php
require 'config.php';
require 'include/db_functions.php';
require 'include/display_functions.php';

session_start();

$bd = connect_to_db($confSQL);

if (isset($_POST['is_icam']))
{
    $is_icam=1;
    $bracelet_id = $_POST['bracelet_id'];
    $creneau = $_POST['creneau'];
    // switch ($bracelet_id)
    // {
    //     case "":
    //     {
    //         $bracelet_id=null;
    //         break;
    //     }
    //     case $bracelet_id<=1050:
    //     {
    //         if ($creneau != '21h-21h45')
    //         {
    //             $_SESSION['erreur_bracelet'] ='Vous avez entré une id ('.four_chars_bracelet_id($bracelet_id).') de bracelet de 1er créneau ! Recommencez svp';
    //             goto end;
    //         }
    //         break;
    //     }
    //     case $bracelet_id<=1900:
    //     {
    //         if ($creneau != '22h30-23h')
    //         {
    //             $_SESSION['erreur_bracelet'] ='Vous avez entré une id ('.four_chars_bracelet_id($bracelet_id).') de bracelet de 3e créneau ! Recommencez svp';
    //             goto end;
    //         }
    //         break;
    //     }
    //     case $bracelet_id<=2850:
    //     {
    //         if ($creneau != '21h45-22h30')
    //         {
    //             $_SESSION['erreur_bracelet'] ='Vous avez entré une id ('.four_chars_bracelet_id($bracelet_id).') de bracelet de 2e créneau ! Recommencez svp';
    //             goto end;
    //         }
    //         break;
    //     }
    //     case $bracelet_id<=3200:
    //     {
    //         $_SESSION['erreur_bracelet'] ='Vous avez entré une id ('.four_chars_bracelet_id($bracelet_id).') de bracelet orange (spécial)! Recommencez svp';
    //         goto end;
    //         break;
    //     }
    //     default:
    //     {
    //         $_SESSION['erreur_bracelet'] ='Vous avez entré une id ('.four_chars_bracelet_id($bracelet_id).') incorrecte ! Recommencez svp';
    //         goto end;
    //         break;
    //     }
    // }
    if ($_POST['is_icam'] == 0)
    {
        $update_db = $bd -> prepare('UPDATE guests SET nom=:nom, prenom=:prenom, bracelet_id=:bracelet_id, plage_horaire_entrees=:creneau WHERE id=:id');
        $update_db->bindParam('id', $_POST['edit_id'], PDO::PARAM_INT);
        $update_db->bindParam('nom', $_POST['nom'], PDO::PARAM_INT);
        $update_db->bindParam('prenom', $_POST['prenom'], PDO::PARAM_STR);
        $update_db->bindParam('bracelet_id', $bracelet_id, PDO::PARAM_STR);
        $update_db->bindParam('creneau', $_POST['creneau'], PDO::PARAM_STR);
        $update_db = $update_db -> execute();
    }
    elseif($_POST['is_icam'] == 1)
    {
        // $telephone = $_POST['telephone'];
        // if ($_POST['telephone'] =="")
        // {
        //     $telephone = null;
        // }
        $update_db = $bd -> prepare('UPDATE guests SET telephone=:telephone, bracelet_id=:bracelet_id, plage_horaire_entrees=:creneau WHERE id=:id');
        $update_db->bindParam('id', $_POST['edit_id'], PDO::PARAM_INT);
        $update_db->bindParam('bracelet_id', $bracelet_id, PDO::PARAM_STR);
        $update_db->bindParam('telephone', $telephone, PDO::PARAM_STR);
        $update_db->bindParam('creneau', $_POST['creneau'], PDO::PARAM_STR);
        $update_db = $update_db -> execute();
    }
}
if (isset($_POST['fromicam']))
{
    echo'fromicam';
    $_SESSION['retour_edit']=1;
    unset($_POST['fromicam']);
}

end:
header('Location: edit.php');