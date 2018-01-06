<?php

if(isset($_SESSION['retour_edit']))
{
    $_POST = $_SESSION['page_precedente_precedente'];
    unset($_SESSION['retour_edit']);
}
/*elseif (isset($_POST['retour_page_precedente']))
{
    if($_POST['retour_page_precedente']==1)
    {
        $noreturn = 1;
        $_POST = $_SESSION['page_precedente_precedente'];
    }
}*/
else
{
    if (isset($_SESSION['page_precedente']))
    {
        $_SESSION['page_precedente_precedente'] = $_SESSION['page_precedente'];
        $_SESSION['page_precedente']=$_POST;
    }
    elseif (isset($_POST))
    {
        $_SESSION['page_precedente']=$_POST;
    }
}
