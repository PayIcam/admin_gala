<?php echo realpath('mdr.php');

echo '<br/>';
echo crypt('#admin-gala', password_hash('#admin-gala', PASSWORD_DEFAULT));
echo '<br/>';
echo crypt('nimda', password_hash('#admin-gala', PASSWORD_DEFAULT));