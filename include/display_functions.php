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
    if(gettype($entrees/$step)!='integer')
    {
        $nb_de_pages = intval($entrees/$step)+1;
    }
    else
    {
        $nb_de_pages = $entrees/$step;
    }
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
            $id = '<span style="color: blue">'.$id.'</span>';
            break;
        }
        case (int)$id<=1900:
        {
            $id = '<span style="color: green">'.$id.'</span>';
            break;
        }
        case (int)$id<=2850:
        {
            $id = '<span style="color: red">'.$id.'</span>';
            break;
        }
        case (int)$id<=3200:
        {
            $id = '<span style="color: orange">'.$id.'</span>';
            break;
        }
    }
    return $id;
}
function is_correct_bracelet($bracelet_id,$creneau)
{
    switch ($bracelet_id)
    {
        case "":
        {
            return true;
        }
        case $bracelet_id<=1050:
        {
            if ($creneau != '21h-21h45')
            {
                $_SESSION['erreur_bracelet'] ='Vous avez entré une id ('.four_chars_bracelet_id($bracelet_id).') de bracelet de 1er créneau ! Recommencez svp';
                return false;
            }
            else
            {
                return true;
            }
        }
        case $bracelet_id<=1900:
        {
            if ($creneau != '22h30-23h')
            {
                $_SESSION['erreur_bracelet'] ='Vous avez entré une id ('.four_chars_bracelet_id($bracelet_id).') de bracelet de 3e créneau ! Recommencez svp';
                return false;
            }
            else
            {
                return true;
            }
        }
        case $bracelet_id<=2850:
        {
            if ($creneau != '21h45-22h30')
            {
                $_SESSION['erreur_bracelet'] ='Vous avez entré une id ('.four_chars_bracelet_id($bracelet_id).') de bracelet de 2e créneau ! Recommencez svp';
                return false;
            }
            else
            {
                return true;
            }
        }
        case $bracelet_id<=3200:
        {
            $_SESSION['erreur_bracelet'] ='Vous avez entré une id ('.four_chars_bracelet_id($bracelet_id).') de bracelet orange (spécial)! Recommencez svp';
            return false;
        }
        default:
        {
            $_SESSION['erreur_bracelet'] ='Vous avez entré une id ('.four_chars_bracelet_id($bracelet_id).') incorrecte ! Recommencez svp';
            return false;
        }
    }
}
function color_percentage($percentage)
{
    switch ($percentage)
    {
        case 'undefined':
        {
            break;
        }
        case $percentage<25:
        {
            $percentage = '<span style="color:#cc0000; font-weight:bold">'.$percentage.'%</span>';
            break;
        }
        case $percentage<50:
        {
            $percentage = '<span style="color:#ff6600">'.$percentage.'%</span>';
            break;
        }
        case $percentage<75:
        {
            $percentage = '<span style="color:#ffcc00">'.$percentage.'%</span>';
            break;
        }
        case $percentage<90:
        {
            $percentage = '<span style="color:blue">'.$percentage.'%</span>';
            break;
        }
        case $percentage<100:
        {
            $percentage = '<span style="color:#50D050">'.$percentage.'%</span>';
            break;
        }
        case 100:
        {
            $percentage = '<span style="color:green; font-weight:bold">'.$percentage.'%</span>';
            break;
        }
        default:
        {
        }
    }
    return $percentage;
}