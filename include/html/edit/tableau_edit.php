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
                    <td><?php echo htmlspecialchars($edit_data['bracelet_id']) ?></td>
                    <td><?php ajustement_creneau($edit_data['plage_horaire_entrees']) ?></td>
                    <td><span class="badge badge-pill badge-info"><?php echo htmlspecialchars($edit_data['tickets_boisson']) ?></span></td>
                    <td><?php echo htmlspecialchars($edit_data['email']) ?></td>
                    <td><?php echo htmlspecialchars($edit_data['telephone']) ?></td>
                    <td><?php echo htmlspecialchars($edit_data['inscription']) ?></td>
                    <td><?php echo htmlspecialchars($_POST['message_invite'])?></td>
                    <td><a data-container="body" data-toggle="popover" data-placement="top" data-content="<?php diner_conference($edit_data); ?>"><i class="fas fa-info-circle fa-lg"></i></a></td>
                </tr>
            </tbody>
        </table>
    </section>
</div>