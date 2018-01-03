<div class="row">
    <div class="col-md-5">
        <p><h3>Liste des participants au Gala</h3><p>Actuellement <?php echo $nb_participants['COUNT(*)'] ?> invités</p>
    </div>
</div>
<form action="index.php" method="post">
    <div class="row">
        <div class= "col-md-3">
            <input type="input-medium search-query" class="form-control" name ="recherche" id="recherche" placeholder="Nom, prenom..."
            value="<?php if(isset($_POST['recherche'])){echo $_POST['recherche'];} ?>">
            <script>
                var liste = [
                "Draggable",
                "Droppable",
                "Resizable",
                "Selectable",
                "Sortable"
                ];

            $('#recherche').autocomplete({
                source : liste, //liste des suggestions
                minLength : 3 //nb de caractère mini avant de lancer une recherche
            });
        </script>
        </div>
        <button class="btn btn-primary" type="submit">Rechercher</button>

        <div class="col-md-3">
            <a href="secured/ajouter_invite.php" class="btn btn-primary">Ajouter un invité</a>
        </div>
    </div>
</form>