<?php

require '../include/display_functions.php';
require '../config.php';
require '../include/db_functions.php';
require '../include/html/display_html_functions.php';

$bd = connect_to_db($confSQL);

if(isset($_POST['add_id']))
{
    $add_id = $_POST['add_id'];
    $add_data = select_single_lign($add_id);
}

require '../include/html/add/header_add.php';
require '../include/html/add/tableau.php';
require '../include/html/footer.php';
