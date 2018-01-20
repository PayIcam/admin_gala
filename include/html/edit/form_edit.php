<div class="container">
    <form action ="edit_db.php" method="post">
        <input type="hidden" value="<?php echo htmlspecialchars($edit_id); ?>" name="edit_id" />
        <input type="hidden" value="<?php echo htmlspecialchars($edit_data['is_icam']); ?>" name="is_icam" />
        <input type="hidden" value="<?php echo htmlspecialchars($_POST['message_invite']); ?>" name="message_invite" />

        <?php if($edit_data['is_icam'] ==0)
        { ?>
            <div class="input-group col-md-6" id="nom">
                <span class="input-group-addon" id="sizing-addon2">Nom</span>
                <input type="text" class="form-control" aria-describedby="sizing-addon2" name="nom"
                <?php
                if (isset($edit_data['nom'])) { echo htmlspecialchars('value='. $edit_data['nom'].''); } ?>
                >
            </div>
            <br>
            <div class="input-group col-md-6" id='prenom'>
                <span class="input-group-addon" id="sizing-addon2">Prénom</span>
                <input type="text" class="form-control" aria-describedby="sizing-addon2" name="prenom"
                <?php
                if (isset($edit_data['prenom'])) { echo htmlspecialchars('value='. $edit_data['prenom'].''); } ?>
                >
            </div>
        <?php } ?>
        <?php if($edit_data['is_icam'] ==1)
        { ?>
        <!-- <div class="input-group col-md-6" id='telephone'>
            <span class="input-group-addon" id="sizing-addon2"><i class="fas fa-phone"></i></span>
            <input type="text" class="form-control" placeholder="Telephone" aria-describedby="sizing-addon2" name="telephone"
            <?php
            if (isset($edit_data['telephone'])) { echo htmlspecialchars('value='. $edit_data['telephone'].''); } ?>
            >
        </div> -->
        <?php } ?>
        <br>
        <div class="input-group col-md-6" id='bracelet'>
            <span class="input-group-addon" id="sizing-addon2">N° de bracelet</span>
            <input type="text" class="form-control" aria-describedby="sizing-addon2" name="bracelet_id"
            <?php
            if (isset($edit_data['bracelet_id'])) { echo htmlspecialchars('value='. $edit_data['bracelet_id'] .''); } ?>
            >
        </div>
        <br>
        <div class='col-md-3'>
            <label for="creneau">Créneaux d'entrée :</label><br />
            <select class="form-control" name="creneau" id="creneau">
                <?php
                $selected=0;
                foreach($current_creneaux_quotas as $current_creneau_quota)
                {
                    if($edit_data['plage_horaire_entrees']==$current_creneau_quota['creneau'])
                    {
                        $selected=1;
                        echo '<option selected value="'.$current_creneau_quota['creneau'].'">'.$current_creneau_quota['vrai_creneau'].'</option>';
                    }
                    elseif($current_creneau_quota['actuellement'] < $current_creneau_quota['quota'])
                    {
                        echo '<option value="'.$current_creneau_quota['creneau'].'">'.$current_creneau_quota['vrai_creneau'].'</option>';
                    }
                }
                if($selected==0)
                {
                    echo '<option selected>'.$edit_data['plage_horaire_entrees'].'</option>';
                }
                ?>
            </select>
        </div>
        <br>
        <div class="col-md-5">
           <?php if(isset($_POST['fromicam'])){echo '<input type="hidden" name="fromicam" value=1 />';}?> <input type="submit" class="btn btn-primary" value="Enregistrer"/>
        </div>
    </form>
</div>