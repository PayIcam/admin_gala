<?php

function connect_to_db($conf)
{
    try
    {
        $bd = new PDO('mysql:host='.$conf['sql_host'].';dbname='.$conf['sql_db'].';charset=utf8',$conf['sql_user'],$conf['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
        $bd ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $bd;
    }
    catch(Exeption $e)
    {
        die('erreur:'.$e->getMessage());
    }
}

function nb_participants()
{
    global $bd;
    $participants = $bd->prepare('SELECT COUNT(*) FROM guests');
    $participants->execute();
    $nb_participants = $participants->fetch()['COUNT(*)'];
    return $nb_participants;
}
function all_guests($rang)
{
    global $bd;
    $liste_invite = $bd->prepare('SELECT * FROM guests LIMIT :rang,25');
    $liste_invite->bindParam('rang', $rang, PDO::PARAM_INT);
    $liste_invite->execute();
    $invite = $liste_invite->fetchAll();
    return $invite;
}
function select_single_lign($id)
{
    global $bd;
    $edit_query = $bd->prepare('SELECT * FROM guests WHERE id =:id');
    $edit_query->execute(array('id' => $id));
    $edit_data = $edit_query -> fetch();
    return $edit_data;
}

function nombre_invites($guest)
{
    global $bd;
    if ($guest['is_icam'] ==1)
    {
        $nb_invite = $bd -> prepare('SELECT count(*) nb FROM icam_has_guest where icam_id=:id');
        $nb_invite -> execute(array('id' => $guest['id']));
        $nb_invite = $nb_invite->fetch()['nb'];

        switch ($guest['promo'])
        {
            case 120:
            {
                $total = 3;
                break;
            }
            case 119:
            case 118:
            {
                $total = 2;
                break;
            }
            default:
            {
                $total =1;
                break;
            }
        }
        $message = $nb_invite . "/" . $total;
        return $message;
    }
    else
    {
        return 'XXX';
    }
}
function set_invites($id)
{
    global $bd;
    $invites_id = $bd->prepare('SELECT guest_id FROM icam_has_guest WHERE icam_id =:icam_id');
    $invites_id -> execute(array('icam_id' => $id));
    $invites_id = $invites_id->fetchall();

    foreach($invites_id as $invite)
    {
        $invite_data = select_single_lign($invite['guest_id']);
        $invites_data[] = $invite_data;
    }
    return $invites_data;
}
function count_promo($promo)
{
    global $bd;
    $nb = $bd -> prepare('SELECT COUNT(*) nb FROM guests where promo=:promo');
    $nb -> execute(array('promo' => $promo));
    $nb = $nb->fetch()['nb'];
    return $nb;
}
function count_creneau($creneau)
{
    global $bd;
    $nb = $bd -> prepare('SELECT COUNT(*) nb FROM guests where plage_horaire_entrees=:plage_horaire_entrees');
    $nb -> execute(array('plage_horaire_entrees' => $creneau));
    $nb = $nb->fetch()['nb'];
    return $nb;
}
function count_conference()
{
    global $bd;
    $nb = $bd -> prepare('SELECT COUNT(*) nb FROM guests where buffet=1');
    $nb -> execute();
    $nb = $nb->fetch()['nb'];
    return $nb;
}
function count_diner()
{
    global $bd;
    $nb = $bd -> prepare('SELECT COUNT(*) nb FROM guests where repas=1');
    $nb -> execute();
    $nb = $nb->fetch()['nb'];
    return $nb;
}
function count_icam($condition)
{
    global $bd;
    if ($condition==true)
    {
        $nb = $bd -> prepare('SELECT COUNT(*) nb FROM guests where is_icam=1');
    }
    else
    {
        $nb = $bd -> prepare('SELECT COUNT(*) nb FROM guests where is_icam=0');
    }
    $nb -> execute();
    $nb = $nb->fetch()['nb'];
    return $nb;
}
function count_bracelet($condition)
{
    global $bd;
    if ($condition==True)
    {
        $nb = $bd -> prepare('SELECT COUNT(bracelet_id) nb FROM guests');
    }
    else
    {
        $nb = $bd -> prepare('SELECT SUM(CASE WHEN bracelet_id IS NULL THEN 1 ELSE 0 END) nb FROM guests');
    }
    $nb -> execute();
    $nb = $nb->fetch()['nb'];
    return $nb;
}
function count_telephone($condition)
{
    global $bd;
    if ($condition==True)
    {
        $nb = $bd -> prepare('SELECT COUNT(telephone) nb FROM guests WHERE is_icam=1');
    }
    else
    {
        $nb = $bd -> prepare('SELECT SUM(CASE WHEN telephone IS NULL THEN 1 ELSE 0 END) nb FROM guests WHERE is_icam=1');
    }
    $nb -> execute();
    $nb = $nb->fetch()['nb'];
    return $nb;
}
function count_price($condition)
{
    global $bd;
    if ($condition==True)
    {
        $nb = $bd -> prepare('SELECT COUNT(price) nb FROM guests WHERE price !=0');
    }
    else
    {
        $nb = $bd -> prepare('SELECT COUNT(price) nb FROM guests WHERE price =0');
    }
    $nb -> execute();
    $nb = $nb->fetch()['nb'];
    return $nb;
}
function count_payement($payement)
{
    global $bd;
    $nb = $bd -> prepare('SELECT COUNT(paiement) nb FROM guests WHERE paiement=:paiement');
    $nb-> execute(array('paiement' => $payement));
    $nb = $nb->fetch()['nb'];
    return $nb;
}
function determination_recherche($recherche, $rang)
{
    global $bd;
    switch ($recherche)
    {
        case (preg_match("#^0[1-68]([-. ]?[0-9]{2}){4}$#", $recherche) ? true : false):
        {
            $champ='telephone';
            $recherche_bdd =$bd->prepare('SELECT * FROM guests WHERE telephone = :telephone LIMIT :rang,25');
            $recherche_bdd -> bindParam('rang', $rang, PDO::PARAM_INT);
            $recherche_bdd -> bindParam('telephone', $recherche, PDO::PARAM_STR);
            $count_recherche =$bd->prepare('SELECT count(*) FROM guests WHERE telephone = :telephone');
            $count_recherche -> execute(array('telephone' => $recherche));
            $count_recherche = $count_recherche->fetch()['count(*)'];
            break;
        }
        case(preg_match("#^11[789]|12[012]|201[89]|202[012]|Ingénieur|FC|Parent|Permanent$#i", $recherche) ? true : false):
        {
            $champ='promo';
            $recherche_bdd =$bd->prepare('SELECT * FROM guests WHERE promo = :promo LIMIT :rang,25');
            $recherche_bdd -> bindParam('rang', $rang, PDO::PARAM_INT);
            $recherche_bdd -> bindParam('promo', $recherche, PDO::PARAM_STR);
            $count_recherche = count_promo($recherche);
            break;
        }
        case(preg_match("#^[0-9]{1,4}$#", $recherche) ? true:false):
        {
            $champ='bracelet';
            $recherche_bdd =$bd->prepare('SELECT * FROM guests WHERE bracelet_id = :bracelet_id LIMIT :rang,25');
            $recherche_bdd -> bindParam('rang', $rang, PDO::PARAM_INT);
            $recherche_bdd -> bindParam('bracelet_id', $recherche, PDO::PARAM_STR);
            $count_recherche =$bd->prepare('SELECT count(*) FROM guests WHERE bracelet_id = :bracelet_id');
            $count_recherche -> execute(array('bracelet_id' => $recherche));
            $count_recherche = $count_recherche->fetch()['count(*)'];
            break;
        }
        case(preg_match("#^tickets$#", $recherche) ? true:false):
        {
            $recherche_bdd =$bd->prepare('SELECT * FROM guests WHERE tickets_boisson > 0 ORDER BY tickets_boisson DESC LIMIT :rang,25');
            $recherche_bdd -> bindParam('rang', $rang, PDO::PARAM_INT);
            $count_recherche =$bd->prepare('SELECT count(*) FROM guests WHERE tickets_boisson > 0');
            $count_recherche = $count_recherche->fetch()['count(*)'];
            break;
        }
        case(preg_match("#^21h|21h50|22h40|Petite porte|INTERDIT|Libre|17h30$#", $recherche) ?true:false):
        {
            $champ='plage_horaire_entrees';
            $recherche_bdd =$bd->prepare('SELECT * FROM guests WHERE plage_horaire_entrees = :plage_horaire_entrees LIMIT :rang,25');
            $recherche_bdd -> bindParam('rang', $rang, PDO::PARAM_INT);
            switch ($recherche)
            {
                case '21h':
                {
                    $horaire = '21h-21h45';
                    break;
                }
                case '21h50':
                {
                    $horaire = '21h45-22h30';
                    break;
                }
                case '22h40':
                {
                    $horaire = '22h30-23h';
                    break;
                }
                default:
                {
                    $horaire = $recherche;
                    break;
                }
            }
            $recherche_bdd -> bindParam('plage_horaire_entrees', $horaire, PDO::PARAM_STR);
            $count_recherche = count_creneau($horaire);
            break;
        }
        case (preg_match("#^invite|invité$#i", $recherche) ? true : false):
        {
            $champ = 'is_icam';
            $recherche_bdd =$bd->prepare('SELECT * FROM guests WHERE is_icam =0 LIMIT :rang,25');
            $recherche_bdd -> bindParam('rang', $rang, PDO::PARAM_INT);
            $condition =false;
            $count_recherche = count_icam($condition);
            break;
        }
        case (preg_match("#^icam[s]?$#i", $recherche) ? true : false):
        {
            $champ = 'is_icam';
            $recherche_bdd =$bd->prepare('SELECT * FROM guests WHERE is_icam =1 LIMIT :rang,25');
            $recherche_bdd -> bindParam('rang', $rang, PDO::PARAM_INT);
            $condition =true;
            $count_recherche = count_icam($condition);
            break;
        }
        case (preg_match("#^telephone$|^téléphone$#i", $recherche) ? true : false):
        {
            $champ = 'telephone';
            $recherche_bdd =$bd->prepare('SELECT * FROM guests WHERE is_icam =1 and telephone IS NOT NULL LIMIT :rang,25');
            $recherche_bdd -> bindParam('rang', $rang, PDO::PARAM_INT);
            $count_recherche = count_telephone(True);
            break;
        }
        case (preg_match("#^no[t]? telephone|no[t]? téléphone$#i", $recherche) ? true : false):
        {
            $champ = 'telephone';
            $recherche_bdd =$bd->prepare('SELECT * FROM guests WHERE is_icam =1 and telephone IS NULL LIMIT :rang,25');
            $recherche_bdd -> bindParam('rang', $rang, PDO::PARAM_INT);
            $count_recherche = count_telephone(False);
            break;
        }
        case (preg_match("#^bracelet$#i", $recherche) ? true : false):
        {
            $champ = 'bracelet';
            $recherche_bdd =$bd->prepare('SELECT * FROM guests WHERE bracelet_id IS NOT NULL or bracelet_id !="" LIMIT :rang,25');
            $recherche_bdd -> bindParam('rang', $rang, PDO::PARAM_INT);
            $count_recherche = count_bracelet(True);
            break;
        }
        case (preg_match("#^no[t]? bracelet$#i", $recherche) ? true : false):
        {
            $champ = 'telephone';
            $recherche_bdd =$bd->prepare('SELECT * FROM guests WHERE bracelet_id IS NULL or bracelet_id="" LIMIT :rang,25');
            $recherche_bdd -> bindParam('rang', $rang, PDO::PARAM_INT);
            $count_recherche = count_bracelet(False);
            break;
        }
        case (preg_match("#^price$#i", $recherche) ? true : false):
        {
            $champ = 'price';
            $recherche_bdd =$bd->prepare('SELECT * FROM guests WHERE price !=0 LIMIT :rang,25');
            $recherche_bdd -> bindParam('rang', $rang, PDO::PARAM_INT);
            $count_recherche = count_price(True);
            break;
        }
        case (preg_match("#^no[t]? price$#i", $recherche) ? true : false):
        {
            $champ = 'price';
            $recherche_bdd =$bd->prepare('SELECT * FROM guests WHERE price=0 LIMIT :rang,25');
            $recherche_bdd -> bindParam('rang', $rang, PDO::PARAM_INT);
            $count_recherche = count_price(False);
            break;
        }
        case (preg_match("#^conférence|conference$#i", $recherche) ?true:false):
        {
            $recherche_bdd =$bd->prepare('SELECT * FROM guests WHERE buffet =1 LIMIT :rang,25');
            $recherche_bdd -> bindParam('rang', $rang, PDO::PARAM_INT);
            $count_recherche = count_conference();
            break;
        }
        case (preg_match("#^dîner|diner$#i", $recherche) ?true:false):
        {
            $recherche_bdd =$bd->prepare('SELECT * FROM guests WHERE repas =1 LIMIT :rang,25');
            $recherche_bdd -> bindParam('rang', $rang, PDO::PARAM_INT);
            $count_recherche = count_diner();
            break;
        }
        case (preg_match("#^PayIcam|gratuit|Pumpkin|cb|cash$#", $recherche) ? true:false):
        {
            $recherche_bdd = $bd -> prepare('SELECT * FROM guests WHERE paiement=:paiement LIMIT :rang,25');
            $recherche_bdd -> bindParam('rang', $rang, PDO::PARAM_INT);
            $recherche_bdd -> bindParam('paiement', $recherche, PDO::PARAM_STR);
            $count_recherche = count_payement($recherche);
            break;
        }
        case (preg_match("#^[a-zéèçôîûâ]{1}+[a-zçôîûâ]{1}$#i", $recherche) ? true:false):
        {
            $recherche_bdd = $bd-> prepare('SELECT * FROM guests WHERE nom REGEXP :nom AND prenom REGEXP :prenom LIMIT :rang,25');
            $prenom = '^'.$recherche[0];
            $nom = '^'.$recherche[1];
            $recherche_bdd -> bindParam('rang', $rang, PDO::PARAM_INT);
            $recherche_bdd -> bindParam('prenom', $prenom, PDO::PARAM_STR);
            $recherche_bdd -> bindParam('nom', $nom, PDO::PARAM_STR);
            $count_recherche =$bd->prepare('SELECT count(*) FROM guests WHERE nom REGEXP :nom AND prenom REGEXP :prenom');
            $count_recherche -> execute(array('prenom' => $prenom, 'nom' => $nom));
            $count_recherche = $count_recherche->fetch()['count(*)'];
            break;
        }
        case (preg_match("#^[a-zéèçôîûâ]+ [a-zçôîûâ]+$#i", $recherche) ? true:false):
        {
            $recherche_bdd = $bd-> prepare('SELECT * FROM guests WHERE nom REGEXP :nom AND prenom REGEXP :prenom LIMIT :rang,25');
            $recherche = explode(" " , $recherche);
            $prenom = '^'.$recherche[0];
            $nom = '^'.$recherche[1];
            $recherche_bdd -> bindParam('rang', $rang, PDO::PARAM_INT);
            $recherche_bdd -> bindParam('prenom', $prenom, PDO::PARAM_STR);
            $recherche_bdd -> bindParam('nom', $nom, PDO::PARAM_STR);
            $count_recherche = $bd->prepare('SELECT count(*) FROM guests WHERE nom REGEXP :nom AND prenom REGEXP :prenom ');
            $count_recherche -> execute(array('prenom' => $prenom, 'nom' => $nom));
            $count_recherche = $count_recherche->fetch()['count(*)'];
            break;
        }
        default:
        {
            // echo 'default';
            $recherche_bdd =$bd-> prepare('SELECT * FROM guests WHERE nom REGEXP :recherche OR prenom REGEXP :recherche LIMIT :rang,25');
            $recherche_bdd -> bindParam('rang', $rang, PDO::PARAM_INT);
            $recherche_bdd -> bindParam('recherche', $recherche, PDO::PARAM_STR);
            $count_recherche =$bd->prepare('SELECT count(*) FROM guests WHERE nom REGEXP :recherche OR prenom REGEXP :recherche');
            $count_recherche -> execute(array('recherche' => $recherche));
            $count_recherche = $count_recherche->fetch()['count(*)'];
            break;
        }
    }
    $recherche_bdd -> execute();
    if (!$recherche_bdd)
    {
        print_r($bd->errorInfo());
    }
    $recherche_bdd = $recherche_bdd->fetchall();
    $_SESSION['count_recherche'] = $count_recherche;
    $_SESSION['search_match'] = $count_recherche .' entrées correspondent à la recherche';
    return $recherche_bdd;
}

function set_quotas()
{
    function set_parametres()
    {
        global $bd;
        $parametre=$bd->prepare('SELECT * FROM configs');
        $parametre->execute();
        $valeurs=$parametre->fetchAll();
        for($i=4; $i<=9; $i++)
        {
            $quota = $valeurs[$i];
            $quotas[] = $quota;
        }
        return $quotas;
    }
    function set_current_status($quotas)
    {
        // var_dump($quotas);
        foreach($quotas as $quota)
        {
            switch($quota['name'])
            {
                case 'quota_conferences':
                {
                    $current = count_conference();
                    $quota['current'] = $current;
                    $quota['name'] = 'Conférence';
                    $status[]=$quota;
                    break;
                }
                case 'quota_entree_21h45_22h30':
                {
                    $horaire='21h45-22h30';
                    $current = count_creneau($horaire);
                    $quota['current'] = $current;
                    $quota['name'] = 'Deuxième Créneau';
                    $status[]=$quota;
                    break;
                }
                case 'quota_entree_21h_21h45':
                {
                    $horaire='21h-21h45';
                    $current = count_creneau($horaire);
                    $quota['current'] = $current;
                    $quota['name'] = 'Premier Créneau';
                    $status[]=$quota;
                    break;
                }
                case 'quota_entree_22h30_23h':
                {
                    $horaire='22h30-23h';
                    $current = count_creneau($horaire);
                    $quota['current'] = $current;
                    $quota['name'] = 'Troisième Créneau';
                    $status[]=$quota;
                    break;
                }
                case 'quota_repas':
                {
                    $current = count_diner();
                    $quota['current'] = $current;
                    $quota['name'] = 'Dîner';
                    $status[]=$quota;
                    break;
                }
                case 'quota_soirees':
                {
                    global $nb_total;
                    $nb_total = $quota['value'];
                    $current = nb_participants();
                    $quota['current'] = $current;
                    $quota['name'] = 'Total';
                    $status[]=$quota;
                    break;
                }
            }
        }
        return $status;
    }
    global $bd;
    global $nb_total;

    $nb_inscris = nb_participants();
    $nb_icam = count_icam(true);
    $nb_invite = count_icam(false);
    $nb_bracelets = count_bracelet(true);
    $nb_no_bracelets = count_bracelet(false);
    $nb_telephone = count_telephone(true);

    $quotas = set_parametres();
    $status = set_current_status($quotas);

    $status[]=array('name' => 'bracelets/max', 'name1' => 'nombre de bracelets distribués', 'value1' => $nb_bracelets, 'name2' => 'total de bracelets', 'value2' => 3300);
    $status[]=array('name' => 'bracelets/inscris', 'name1' => 'nombre de bracelets distribués', 'value1' => $nb_bracelets, 'name2' => 'nombre d\'inscris', 'value2' => $nb_inscris);
    $status[]=array('name' => 'telephone/icam', 'name1' => 'nombre de numéros de téléphone renseignés', 'value1' => $nb_telephone, 'name2' => 'nombre d\'Icams', 'value2' => $nb_icam);
    $status[]=array('name' => 'icam/invité', 'name1' => 'nombre d\'Icams', 'value1' => $nb_icam, 'name2' => 'nombre d\'invités', 'value2' => $nb_invite);

    // $status[]=array('name' => 'telephone/icam', 'nombre de numéros de téléphone renseignés' => $nb_telephone, 'nombre d\'Icams' => $nb_icam);
    // $status[]=array('name' => 'icam/invité', 'nombre d\'Icams' => $nb_icam, 'nombre d\'invités' => $nb_invite);

    return $status;
}
function has_arrived($id)
{
    global $bd;
    $arrival = $bd->prepare('INSERT INTO entrees VALUES (:id, 1, :arrival_time)');
    date_default_timezone_set('Europe/Belgrade');
    $arrival_time = date('Y-m-d H:i:s', time());
    $arrival -> execute(array('id' => $id, 'arrival_time' => $arrival_time));
}
function set_id_inviteur($id)
{
    global $bd;
    $inviteur = $bd->prepare('SELECT icam_id FROM icam_has_guest WHERE guest_id =:id');
    $inviteur -> execute(array('id' => $id));
    $invite_id = $inviteur->fetch()['icam_id'];
    return $invite_id;
}
