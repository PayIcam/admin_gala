<?php 
include 'include/header.php';
require "config.php";

// $id = $_GET['id']);
?>
<br>
<div class="container">
	<form>
		<div class="input-group col-md-6" id="nom">
			<span class="input-group-addon" id="sizing-addon2">Nom</span>
			<input type="text" class="form-control" aria-describedby="sizing-addon2" name="nom"
			<?php if (isset($_SESSION['nom']))
			{?> 
				value=<?php echo($_SESSION['nom']->get_value());
			}?> >
		</div>
		<br>
		<div class="input-group col-md-6" id='prenom'>
			<span class="input-group-addon" id="sizing-addon2">Prénom</span>
			<input type="text" class="form-control" aria-describedby="sizing-addon2" name="prenom"
			<?php if (isset($_SESSION['prenom']))
			{?> 
				value=<?php echo($_SESSION['prenom']->get_value());
			}?> >
		</div>
		
		<br>
		<div class="input-group col-md-6" id="mail">
			<span class="input-group-addon" id="sizing-addon2">@</span>
			<input type="text" class="form-control" placeholder="Adresse email" aria-describedby="sizing-addon2" name="email"
			<?php if (isset($_SESSION['email']))
			{?> 
				value=<?php echo($_SESSION['email']->get_value());
			}?> >
		</div>
		<br>
		<div class="input-group col-md-6" id='telephone'>
			<span class="input-group-addon" id="sizing-addon2"><i class="fas fa-phone"></i></span>
			<input type="text" class="form-control" placeholder="Telephone" aria-describedby="sizing-addon2" name="tel"
			<?php if (isset($_SESSION['tel']))
			{?> 
				value=<?php echo($_SESSION['tel']->get_value());
			}?> >
		</div>
		<br>
		<div class="input-group col-md-6" id='bracelet'>
			<span class="input-group-addon" id="sizing-addon2">N° de bracelet</span>
			<input type="number" class="form-control" aria-describedby="sizing-addon2" name="bracelet"
			<?php if (isset($_SESSION['bracelet']))
			{?> 
				value=<?php echo($_SESSION['bracelet']->get_value());
			}?> >
		</div>
		<br>
		<div class='col-md-3'>
			<label for="promo">Promo:</label><br />
				<select class="form-control" name="promo">
					<?php for ($i = 0; $i< 51; $i = $i+10){ ?>
					<option value=<?php $i ?> <?php if (isset($_SESSION['promo']))
					{
						if ($_SESSION['promo']->get_value()== '<?php echo $i ?>') //VERIFIER SI CA MARCHE
						{?>
							selected
							<?php }
						}?> ><?php echo $i ?>

					</option>
					<?php } ?>
				</select>
		</div>
		<br>
		<div class="form-check col-md-4">
			<label class="form-check-label"><input type="checkbox" class="form-check-input" name="check_diner"
				<?php if (isset($_SESSION['check_diner']))
				{?>
					checked
					<?php } ?> >Participation au diner <span class="badge badge-info">+5€</span></label>
				</div>
				<br>
				<div class="form-check col-md-4">
					<label class="form-check-label"><input type="checkbox" class="form-check-input" name="check_conference"
						.<?php if (isset($_SESSION['check_conference']))
						{?>
							checked
							<?php } ?> >Participation à la conférence <span class="badge badge-info">+3€</span></label>
						</div>
						<br>
				<div class='col-md-3'>
					<label for="creneaux">Créneaux d'entrée :</label><br />

					<select class="form-control" name="creneaux">
						<?php for ($i = 0; $i< 51; $i = $i+10){ ?>
						<option value=<?php $i ?> <?php if (isset($_SESSION['creneaux']))
						{
							if ($_SESSION['creneaux']->get_value()== '<?php echo $i ?>') //VERIFIER SI CA MARCHE
							{?>
								selected
								<?php }
							}?> ><?php echo $i ?>

						</option>
						<?php } ?>
					</select>
				</div>
				<br>

				<div class='col-md-4'>
					<label for="nb_ticket">Nombre de tickets boisson <span class="badge badge-info">+10€/carnet</span></label><br />
				</div>
				<div class="col-md-3">
					<select class="form-control" name="nb_ticket">
						<?php for ($i = 0; $i< 51; $i = $i+10){ ?>
						<option value=<?php $i ?> <?php if (isset($_SESSION['nb_ticket']))
						{
							if ($_SESSION['nb_ticket']->get_value()== '<?php echo $i ?>') //VERIFIER SI CA MARCHE
							{?>
								selected
								<?php }
							}?> ><?php echo $i ?>

						</option>
						<?php } ?>
					</select>
				</div>
						<br>
						<div class="col-md-5">
						<a href="gestion_db/verif_enreg_parent.php"><input type="submit" class="btn btn-primary" value="Enregistrer"></a>
						</div>
      						</form>
      						<br>
      						<?php 
      						include 'include/footer.php' ?>