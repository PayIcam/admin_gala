<?php 
include 'include/header.php';
require "config.php";
?>
<?php var_dump($valeurs);die(); ?>
<div class="row-fluid">
<div class="col-md-offset-2 col-md-4"
	<fieldset class="span6">
		<legend><strong>Quotas type de places</strong></legend>
		<form class="form-horizontal" action="parametre.php" method="post">
		<table class="table table-bordered" style="background-color: #ffffff;">
			<thead>
				<tr>
					<th>Place</th>
					<th>Actuellement</th>
					<th>Quotas</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><label for="quota_parent">Parents</label></td>
					<td><input class="form-control" id="quota_parent" type="number" name="quota_parent" step="10" value=<?php echo $valeurs['quota_parent'];  ?> ></td>
					</tr>
						<tr>
					<td><label for="quota_ingenieur">Ingénieurs</label></td>
					<td><?php if(!empty($nb_ingenieur)){echo ($nb_ingenieur);}  ?></td>
					<td><input class="form-control" id="quota_ingenieur" type="number" name="quota_ingenieur" step="10" value=<?php echo $valeurs['quota_ingenieur'] ?> ></td>
				</tr>
			</tbody>
		</table>
	</fieldset>
</div>
</div>
<div class="row-fluid">
<div class="col-md-2">
	<fieldset class="span6">
		<legend><strong>Prix</strong></legend>
		<table class="table table-bordered" style="background-color: #ffffff;">
			<thead>
				<tr>
					<th>Article</th>
					<th>Prix</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><label for="prix_soiree">Soirée</label></td>
					<td><input class="form-control" id="prix_soiree" type="number" name="prix_soiree" value=<?php echo $valeurs['prix_soiree'] ?> ></td>
				</tr>
					<tr>
					<td><label for="prix_diner">Diner</label></td>
					<td><input class="form-control" id="prix_diner" type="number" name="prix_diner" value=<?php echo $valeurs['prix_diner'] ?> ></td>
				</tr>
				<tr>
					<td><label for="prix_conference">Conférence</label></td>
					<td><input class="form-control" id="prix_conference" type="number" name="prix_conference" value=<?php echo $valeurs['prix_conference'] ?> ></td>
				</tr>
				<tr>
					<td><label for="prix_ticket_boisson">Ticket Boisson /u</label></td>
					<td><input class="form-control" id="prix_ticket_boisson" type="number" name="prix_ticket_boisson" value=<?php echo $valeurs['prix_ticket_boisson'] ?> ></td>
				</tr>
			</tbody>
		</table>
	</fieldset>
	<button class="btn btn-primary" type="submit">Sauvegarder</button>
</div>
</div>
</form>



<?php 
include 'include/footer.php' ?>