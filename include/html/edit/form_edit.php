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
                <option value="21h-21h45" <?php if($edit_data['plage_horaire_entrees']=='21h-21h45') { echo htmlspecialchars(' selected'); }?> > 21h-21h35 </option>
                <option value="21h45-22h30" <?php if($edit_data['plage_horaire_entrees']=='21h45-22h30') { echo htmlspecialchars(' selected'); }?> > 21h50-22h25 </option>
                <option value="22h30-23h" <?php if($edit_data['plage_horaire_entrees']=='22h30-23h') { echo htmlspecialchars(' selected'); }?> > 22h40-23h10 </option>
            </select>
        </div>
        <br>
        <div class="col-md-5">
           <a href="gestion_db/verif_enreg_parent.php"><?php if(isset($_POST['fromicam'])){echo '<input type="hidden" name="fromicam" value=1 />';}?> <input type="submit" class="btn btn-primary" value="Enregistrer"></a>
        </div>
    </form>
</div>