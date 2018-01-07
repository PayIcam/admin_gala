<h1 class="title_edit"> Editer <?php echo $edit_data['prenom']. ' '.  $edit_data['nom'] ?> </h1>

<?php
if (isset($_SESSION['erreur_bracelet']))
{
    echo '<em style="font-size:2em; text-align:center;">'. $_SESSION['erreur_bracelet'] .'</em>';
    unset($_SESSION['erreur_bracelet']);
}