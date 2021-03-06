<?php

function next_page()
{
?>
<div class="next_page">
    <span class="next_page_text">
        <form method="post" action="index.php">
            <input type="hidden" name="page" value="<?php if (isset($_POST['page'])) { echo htmlspecialchars($_POST['page']+1);} else{echo htmlspecialchars(2);}?>" />
            <?php if (isset($_POST['recherche'])) {echo ('<input type="hidden" name="recherche" value="'). $_POST['recherche']. '" /> ';} ?>
            <input type="submit" value=">" />
        </form>
    </span>
</div>
<?php
}

function prev_page()
{
?>
<div class="prev_page">
    <span class="prev_page_text">
        <form method="post" action="index.php">
            <input type="hidden" name="page" value="<?php if (isset($_POST['page']) and $_POST['page']>1) { echo htmlspecialchars($_POST['page']-1);}?>" />
            <?php if (isset($_POST['recherche'])) {echo ('<input type="hidden" name="recherche" value="'). $_POST['recherche']. '" /> ';} ?>
            <input type="submit" value="<" />
        </form>
    </span>
</div>
<?php
}

function last_page($nb_pages_max)
{
?>
<div class="prev_page">
    <span class="prev_page_text">
        <form method="post" action="index.php">
            <input type="hidden" name="page" value="<?php echo htmlspecialchars($nb_pages_max);?>" />
            <?php if (isset($_POST['recherche'])) {echo ('<input type="hidden" name="recherche" value="'). $_POST['recherche']. '" /> ';} ?>
            <input type="submit" value=">>>" />
        </form>
    </span>
</div>
<?php
}

function first_page()
{
?>
<div class="prev_page">
    <span class="prev_page_text">
        <form method="post" action="index.php">
            <input type="hidden" name="page" value="<?php if (isset($_POST['page']) and $_POST['page']>1) { echo htmlspecialchars(1);}?>" />
            <?php if (isset($_POST['recherche'])) {echo ('<input type="hidden" name="recherche" value="'). $_POST['recherche']. '" /> ';} ?>
            <input type="submit" value="<<<" />
        </form>
    </span>
</div>
<?php
}

function display_invite($edit_data)
{
    $message_invite = nombre_invites($edit_data);
    ?>
    <tr>
        <td><?php echo htmlspecialchars($edit_data['id']) ?></td>
        <td><?php echo htmlspecialchars($edit_data['nom']) ?></td>
        <td><?php echo htmlspecialchars($edit_data['prenom']) ?></td>
        <td><?php if ($edit_data['promo']!=''){echo htmlspecialchars($edit_data['promo']);}else{echo htmlspecialchars('Invité');} ?></td>
        <td><?php echo four_chars_bracelet_id($edit_data['bracelet_id']) ?></td>
        <td><?php ajustement_creneau($edit_data['plage_horaire_entrees']) ?></td>
        <td><span class="badge badge-pill badge-info"><?php echo htmlspecialchars($edit_data['tickets_boisson']) ?></span></td>
        <td><?php echo htmlspecialchars($edit_data['inscription']); ?></td>
        <td><a data-container="body" data-toggle="popover" data-placement="top" data-content="<?php diner_conference($edit_data); ?>"><i class="fas fa-info-circle fa-lg"></i></a></td>
        <td> <form method=post action='edit.php'> <input type="hidden" name ="fromicam" value=1 /> <input type="hidden" value="<?php echo htmlspecialchars($edit_data['id']); ?>" name=edit_id /> <input type="hidden" name="message_invite" value="<?php echo htmlspecialchars($message_invite); ?>" /> <button class="btn btn-primary" type="submit" title="Editer l'invité <?php echo htmlspecialchars($edit_data['prenom'].' '.$edit_data['nom'])?>"> Editer </button> </form> </td>
    </tr>
    <?php
}
function display_edit_tab($edit_data)
{
    $message_invite = nombre_invites($edit_data);
    ?>
    <div class="container">
        <section class="row" id="tableau">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope= "col">ID</th>
                        <th scope= "col">Nom</th>
                        <th scope= "col">Prénom</th>
                        <th scope= "col">Promo</th>
                        <th scope= "col">Bracelet</th>
                        <th scope= "col">Créneau</th>
                        <th scope= "col">Tickets Boissons</th>
                        <th scope= "col">Email</th>
                        <th scope= "col">Telephone</th>
                        <th scope= "col">Date Inscription</th>
                        <th scope= "col">Nombre d'invités</th>
                        <th scope= "col">Infos</th> <!-- invité, conférence, diner -->
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo htmlspecialchars($edit_data['id']) ?></td>
                        <td><?php echo htmlspecialchars($edit_data['nom']) ?></td>
                        <td><?php echo htmlspecialchars($edit_data['prenom']) ?></td>
                        <td><?php if ($edit_data['promo']!=''){echo htmlspecialchars($edit_data['promo']);}else{echo htmlspecialchars('Invité');} ?></td>
                        <td><?php echo four_chars_bracelet_id($edit_data['bracelet_id']) ?></td>
                        <td><?php ajustement_creneau($edit_data['plage_horaire_entrees']) ?></td>
                        <td><span class="badge badge-pill badge-info"><?php echo htmlspecialchars($edit_data['tickets_boisson']) ?></span></td>
                        <td><?php echo htmlspecialchars($edit_data['email']) ?></td>
                        <td><?php echo htmlspecialchars($edit_data['telephone']) ?></td>
                        <td><?php echo htmlspecialchars($edit_data['inscription']) ?></td>
                        <td><?php echo htmlspecialchars($message_invite)?></td>
                        <td><a data-container="body" data-toggle="popover" data-placement="top" data-content="<?php diner_conference($edit_data); ?>"><i class="fas fa-info-circle fa-lg"></i></a></td>
                        <td> <form method=post action='edit.php'> <input type="hidden" value="<?php echo htmlspecialchars($edit_data['id']); ?>" name=edit_id> <input type="hidden" name="gotoicam" value=1><input type="hidden" name="message_invite" value="<?php echo htmlspecialchars($message_invite); ?>"> <button class="btn btn-primary" type="submit" title="Editer l'invité <?php echo htmlspecialchars($edit_data['prenom'].' '.$edit_data['nom'])?>"> Editer </button> </form> </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>
    <?php
}
function previous_page()
{
    if(isset($_SERVER['HTTP_REFERER']) and !isset($noreturn))
    {
    ?>
    <form method=post action="<?php echo $_SERVER['HTTP_REFERER']?>">
        <input type ="hidden" name="retour_page_precedente" value=<?php echo 1;?> />
        <input type="submit" value="Retour à la page précédente"/>
    </form>
    <?php
    }
}
