<?php

require '../include/html/add/header_add.php';

if(isset($_POST['add_id']))
{
    $add_id = $_POST['add_id'];
    $add_data = select_single_lign($add_id);
    require '../include/html/add/tableau.php';
}
else
{
    require'../include/html/add/add_form.php';
}

require '../include/html/footer.php';
