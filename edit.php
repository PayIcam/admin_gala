<?php
require 'config.php';
require 'include/db_functions.php';
require 'include/display_functions.php';
require 'include/html/display_html_functions.php';

$bd = connect_to_db($confSQL);

if(isset($_POST['edit_id']))
{
    $edit_data = select_single_lign($_POST['edit_id']);
    $edit_id = $_POST['edit_id'];
    var_dump($edit_id);
}

$nb_invites = $_POST['message_invite'][0];
if ($nb_invites >0)
{
    $invites_data = set_invites($edit_id);
}

require 'include/html/header.php';
require 'include/html/edit/tableau_edit.php';
require 'include/html/edit/form_edit.php';
require 'include/html/edit/tableau_complementaire.php';
include 'include/html/footer.php';