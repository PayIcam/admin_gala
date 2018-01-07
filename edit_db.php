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
    $correct=is_correct_bracelet($bracelet_id, $creneau);
    if($bracelet_id=="")
    {
        $bracelet_id=null;
    }
    if(!$correct)
    {
        goto end;
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

end:
header('Location: edit.php');