<?php

session_start();

if (isset($_SERVER['HTTP_REFERER']))
{
    $current_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
    if ($_SERVER['HTTP_REFERER']!=$current_url and !isset($noreturn))
    {
        session_unset();
    }
}

require 'include/check_load_save_previous.php';
require 'config.php';
require 'include/db_functions.php';
require 'include/display_functions.php';
require 'include/html/display_html_functions.php';

$bd = connect_to_db($confSQL);

$nb_participants = (int)nb_participants();

if (isset($_POST['recherche']))
{
    determination_recherche($_POST['recherche'], 0);
    if ($_POST['recherche'] !="")
    {
        $nb_pages_max =nombre_de_pages($_SESSION['count_recherche'], 25);
        unset($_SESSION['count_recherche']);
    }
    else
    {
        $nb_pages_max =nombre_de_pages($nb_participants, 25);
    }
}
else
{
    $nb_pages_max =nombre_de_pages($nb_participants, 25);
}

if (isset($_POST['page']))
{
    if ($_POST['page'] >$nb_pages_max)
    {
        $page = $nb_pages_max;
        $rang =set_start_lign($page);
    }
    else
    {
        $page = $_POST['page'];
        $rang = set_start_lign($page);
    }
}
else
{
    $rang=0;
    $page=1;
}

if (isset($_POST['recherche']))
{
    if ($_POST['recherche'] !="")
    {
        $invite = determination_recherche($_POST['recherche'], $rang);
        unset($_SESSION['count_recherche']);
    }
    else
    {
        $invite = all_guests($rang);
    }
}
else
{
    $invite = all_guests($rang);
}


require 'include/html/header.php';

require 'include/html/display_index.php';

include 'include/html/footer.php';