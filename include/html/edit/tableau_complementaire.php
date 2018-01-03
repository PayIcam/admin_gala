<?php
if ($edit_data['is_icam'] ==1)
{
    if ($nb_invites >0)
    { ?>
    <p class="titre_invite"> Ses invités </p>
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
                        <th scope= "col">Date Inscription</th>
                        <th scope= "col">Infos</th> <!-- invité, conférence, diner -->
                        <th scope= "col">Editer</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach($invites_data as $invite_data)
                {
                    display_invite($invite_data);
                }
                ?>
                </tbody>
            </table>
        </section>
    </div>
    <?php
    }
}
else
{
    $id_inviteur = set_id_inviteur($_POST['edit_id']);
    $edit_data_inviteur = select_single_lign($id_inviteur);
    ?>
    <p class="titre_invite"> L'Icam qui a invité </p>
    <?php
    display_edit_tab($edit_data_inviteur);
}