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
            $creneau = '<span style="color: blue">21h-21h35 </span> ';
            break;
        case '21h45-22h30':
            $creneau = '<span style="color: red">21h50-22h25 </span> ';
            break;
        case '22h30-23h':
            $creneau = '<span style="color: green">22h40-23h10 </span> ';
            break;
    }
    echo ($creneau);
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
function four_chars_bracelet_id($bracelet_id)
{
    $id = strval($bracelet_id);
    $len = strlen($id);
    switch($len)
    {
        case 1:
        {
            $zeros ='000';
            $id = $zeros.$id;
            break;
        }
        case 2:
        {
            $zeros ='00';
            $id = $zeros.$id;
            break;
        }
        case 3:
        {
            $zeros ='0';
            $id = $zeros.$id;
            break;
        }
    }
    switch((int)$id)
    {
        case (int)$id <=1050:
        {
            $id = '<span style="color: blue">'. $id . '</span> ';
            break;
        }
        case (int)$id<=1900:
        {
            $id = '<span style="color: green">'. $id . '</span> ';
            break;
        }
        case (int)$id<=2850:
        {
            $id = '<span style="color: red">'. $id . '</span> ';
            break;
        }
        case (int)$id<=3200:
        {
            $id = '<span style="color: orange">'. $id . '</span> ';
            break;
        }
    }
    return $id;
}
