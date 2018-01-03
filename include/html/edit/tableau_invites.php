<?php
if ($nb_invites >0)
{ ?>
<p class="titre_invite"> Vos invités </p>
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