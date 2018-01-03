<?php echo realpath('mdr.php');

echo '<br/>';
echo crypt('5admin1gala', password_hash('#admin-gala', PASSWORD_DEFAULT));