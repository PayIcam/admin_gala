<?php

function next_page()
{
?>
<div class="next_page">
    <span class="next_page_text">
        <form method="post" action="index.php">
            <input type="hidden" name="page" value="<?php if (isset($_POST['page'])) { echo $_POST['page']+1;} else{echo 2;}?>">
            <?php if (isset($_POST['recherche'])) {echo '<input type="hidden" name="recherche" value="'. $_POST['recherche']. '" /> ';} ?>
            <input type="submit" value=">" />
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
        <td><?php echo($edit_data['id']) ?></td>
        <td><?php echo($edit_data['nom']) ?></td>
        <td><?php echo($edit_data['prenom']) ?></td>
        <td><?php if ($edit_data['promo']!=''){echo($edit_data['promo']);}else{echo('Invité');} ?></td>
        <td><?php echo($edit_data['bracelet_id']) ?></td>
        <td><?php ajustement_creneau($edit_data['plage_horaire_entrees']) ?></td>
        <td><span class="badge badge-pill badge-info"><?php echo $edit_data['tickets_boisson'] ?></span></td>
        <td><?php echo($edit_data['inscription']) ?></td>
        <td><a data-container="body" data-toggle="popover" data-placement="top" data-content="<?php diner_conference($edit_data); ?>"><i class="fas fa-info-circle fa-lg"></i></a></td>
        <td> <form method=post action='edit.php'> <input type="hidden" value="<?php echo $edit_data['id']; ?>" name=edit_id /> <input type="hidden" name="message_invite" value="<?php echo $message_invite; ?>" /> <input type="submit" value = Editer title="Editer l'invité <?php echo($edit_data['prenom'].' '.$edit_data['nom'])?>" /> </form> </td>
    </tr>
    <?php
}

