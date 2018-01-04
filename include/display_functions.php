<?php

function diner_conference($guest)
{
    if ($guest['repas'] ==1 or $guest['buffet']==1)
    {
        if ($guest['repas'] ==1 and $guest['buffet'] ==1)
        {
        echo htmlspecialchars('Dîner et conférence');
        }
        elseif ($guest['repas'] ==1 and !$guest['buffet'] ==1)
        {
        echo htmlspecialchars('Dîner');
        }
        else
        {
        echo htmlspecialchars('Conférence');
        }
    }
    else
    {
        echo htmlspecialchars('Pas d\'options');
    }
}
function ajustement_creneau($creneau)
{
    switch ($creneau)
    {
        case '21h-21h45':
            $creneau = '21h-21h35';
            break;
        case '21h45-22h30':
            $creneau = '21h50-22h25';
            break;
        case '22h30-23h':
            $creneau = '22h40-23h10';
            break;
    }
    echo htmlspecialchars($creneau);
    return $creneau;
}

function set_start_lign($page)
{
    if (preg_match("#^[1-9][0-9]*$#", $_POST['page']))
    {
        $page = $_POST['page'];
        $start_lign= 25*($page-1);
    }
    else
    {
        $start_lign=0;
    }
    return $start_lign;
}
function nombre_de_pages($entrees, $step)
{
    $nb_de_pages = intval($entrees/$step)+1;
    return $nb_de_pages;
}