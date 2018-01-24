<tr>
    <td><?php echo htmlspecialchars($guest['id']) ?></td>
    <td><?php echo htmlspecialchars($guest['nom']) ?></td>
    <td><?php echo htmlspecialchars($guest['prenom']) ?></td>
    <td><?php if ($guest['promo']!=''){echo htmlspecialchars($guest['promo']);}else{echo htmlspecialchars('Invité');} ?></td>
    <td><?php echo four_chars_bracelet_id($guest['bracelet_id']) ?></td>
    <td><?php ajustement_creneau($guest['plage_horaire_entrees']) ?></td>
    <td><span class="badge badge-pill badge-info"><?php echo htmlspecialchars($guest['tickets_boisson']) ?></span></td>
    <td><?php echo htmlspecialchars($guest['email']) ?></td>
    <td><?php echo htmlspecialchars($guest['telephone']) ?></td>
    <td><?php echo htmlspecialchars($guest['inscription']) ?></td>
    <td><?php echo htmlspecialchars($message_invite); ?></td>
    <td><a data-container="body" data-toggle="popover" data-placement="top" data-content="<?php diner_conference($guest); ?>"><i class="fas fa-info-circle fa-lg"></i></a></td>
    <td> <form method=post action='edit.php'> <input type="hidden" value="<?php echo htmlspecialchars($guest['id']); ?>" name=edit_id> <input type="hidden" name="message_invite" value="<?php echo htmlspecialchars($message_invite); ?>"> <button class="btn btn-primary" type="submit" title="Editer l'invité <?php echo htmlspecialchars($guest['prenom'].' '.$guest['nom'])?>"> Editer </button> </form> </td>
    <td> <?php if ($guest['is_icam']==1 and ($message_invite[0]<$message_invite[2])){?> <form method=post action='secured/ajouter_invite.php'> <input type="hidden" name="add_to_icam" value=1> <input type="hidden" value="<?php echo htmlspecialchars($guest['id']); ?>" name=add_id> <input type="hidden" name="add_invite" value=1 /> <input type="hidden" name="message_invite" value="<?php echo htmlspecialchars($message_invite); ?>"> <button type="submit" class="btn btn-primary" title="Ajouter un invité à <?php echo htmlspecialchars($guest['prenom'].' '.$guest['nom'])?>">Nouvel invité</button> </form> <?php } ?> </td>
</tr>