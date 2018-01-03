<tr>
    <td><?php echo($guest['id']) ?></td>
    <td><?php echo($guest['nom']) ?></td>
    <td><?php echo($guest['prenom']) ?></td>
    <td><?php if ($guest['promo']!=''){echo($guest['promo']);}else{echo('Invité');} ?></td>
    <td><?php echo($guest['bracelet_id']) ?></td>
    <td><?php ajustement_creneau($guest['plage_horaire_entrees']) ?></td>
    <td><span class="badge badge-pill badge-info"><?php echo $guest['tickets_boisson'] ?></span></td>
    <td><?php echo($guest['email']) ?></td>
    <td><?php echo($guest['telephone']) ?></td>
    <td><?php echo($guest['inscription']) ?></td>
    <td><?php echo $message_invite;?></td>
    <td><a data-container="body" data-toggle="popover" data-placement="top" data-content="<?php diner_conference($guest); ?>"><i class="fas fa-info-circle fa-lg"></i></a></td>
    <td> <form method=post action='edit.php'> <input type="hidden" value="<?php echo $guest['id']; ?>" name=edit_id> <input type="hidden" name="message_invite" value="<?php echo $message_invite; ?>"> <input type="submit" value = Editer title="Editer l'invité <?php echo($guest['prenom'].' '.$guest['nom'])?>"> </form> </td>
</tr>