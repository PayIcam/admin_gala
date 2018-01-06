<?php
require 'config.php';
require 'include/db_functions.php';

session_start();

$bd = connect_to_db($confSQL);

if (isset($_POST['is_icam']))
{
    $is_icam=1;
    $bracelet_id = $_POST['bracelet_id'];
    switch ($bracelet_id)
    {
        case "":
        {
            $bracelet_id=null;
            break;
        }
        case (preg_match("#^[0-9]{1}$#", $bracelet_id) ? true:false):
        {
            $bracelet_id='000'.$bracelet_id;
            break;
        }
        case (preg_match("#^[0-9]{2}$#", $bracelet_id) ? true:false):
        {
            $bracelet_id='00'.$bracelet_id;
            break;
        }
        case (preg_match("#^[0-9]{3}$#", $bracelet_id) ? true:false):
        {
            $bracelet_id='0'.$bracelet_id;
            break;
        }
    }
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
header('Location: edit.php');