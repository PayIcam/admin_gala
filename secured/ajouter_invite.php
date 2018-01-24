<?php

session_start();

var_dump($_POST);
var_dump($_SESSION);

require '../include/check_load_save_previous.php';
require '../include/display_functions.php';
require '../config.php';
require '../include/db_functions.php';
require '../include/html/display_html_functions.php';

if(isset($_SESSION['erreur_ajout']))
{
    $precedent_ajout = $_SESSION['erreur_ajout'];
}

$bd = connect_to_db($confSQL);

require'../include/html/display_add.php';

var_dump($_SESSION);