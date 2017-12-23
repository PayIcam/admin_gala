<?php 
include 'include/header.php';
require "config.php";
?>
<div class = 'container'>
	<div class="row">
		<div class="col-md-5">
			<p><h3>Liste des participants au Gala</h3><p>Actuellement <?php echo $nb_participants['COUNT(*)'] ?> invités</p>
		</div>
	</div>
	<form action="liste_invite.php" method="post">
		<div class="row">
			<div class= "col-md-3">
				<input type="input-medium search-query" class="form-control" id="recherche" placeholder="Nom, prenom..."
				value="">
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
				<a href="edit.php" class="btn btn-primary">Ajouter un invité</a>
			</div>
		</div>
	</form>
	<br>
	<section class="row" id="tableau">
		<table class="table table-striped">
			<thead>	
				<tr>
					<th scope= "col">ID</th>
					<th scope= "col">Nom</th>
					<th scope= "col">Prénom</th>
					<th scope= "col">Email</th>
					<th scope= "col">Telephone</th>
					<th scope= "col">Tickets Boissons</th>
					<th scope= "col">Promo</th>
					<th scope= "col">Date Inscription</th>
					<th scope= "col">Infos</th> <!-- invité, conférence, diner -->
					<th scope= "col">Editer</th>
					<th scope= "col">Supprimer</th>
				</thead>
			</tr>
			<?php foreach ($invite as $guest){ ?>
			<tr>
				<td><?php echo($guest['id']) ?></td>
				<td><?php echo($guest['nom']) ?></td>
				<td><?php echo($guest['prenom']) ?></td>
				<td><?php echo($guest['email']) ?></td>
				<td><?php echo($guest['telephone']) ?></td>
				<td><span class="badge badge-pill badge-info"><?php echo $guest['tickets_boisson'] ?></span></td>
				<td><?php if ($guest['promo']!=''){echo($guest['promo']);}else{echo('Invité');} ?></td>
				<td><?php echo($guest['inscription']) ?></td>
				<td><a data-container="body" data-toggle="popover" data-placement="top" data-content="bidule"><i class="fas fa-info-circle fa-lg"></i></a></td>
				<td><a href ="edit.php" title="Editer l'invité #<?php echo($guest['id'])?>"><i aria-hidden class="far fa-edit fa-lg"></i></a></td>

				<td><a href ="#" title="Supprimer l'invité #<?php echo($guest['id'])?>" onclick="return confirm('Voulez-vous vraiment supprimer cet invité et ses invités ?');"><i aria-hidden class="far fa-trash-alt fa-lg" color = 'red'></i></a></td>
			</tr>
			<?php } ?>
		</table>
	</section>
</div>

<?php 
include 'include/footer.php' ?>