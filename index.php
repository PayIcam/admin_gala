<?php

session_start();
require 'include/db_functions.php';
require 'include/display_functions.php';
require 'include/html/display_html_functions.php';

$bd = set_db();

if (isset($_POST['page']))
{
    $rang = set_start_lign($_POST['page']);
}
else
{
    $rang=0;
}

$nb_participants = nb_participants();

if (isset($_POST['recherche']))
{
    if ($_POST['recherche'] !="")
    {
        $invite = determination_recherche($_POST['recherche'], $rang);
    }
    else
    {
        $invite = all_guests($rang);
    }
    // echo $invite['count(*)'] . 'entrées correspondent à la recherche.';
}
else
{
    $invite = all_guests($rang);
}

require 'include/html/header.php';

require 'include/html/display_index.php';

include 'include/html/footer.php';