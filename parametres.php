<?php
require 'config.php';
require 'include/html/header.php';
require 'include/db_functions.php';
require 'include/display_functions.php';

$bd = connect_to_db($confSQL);

$status = set_quotas();
$daily_stats = set_creneaux_date();

require 'include/html/parametres/quotas.php';
require 'include/html/parametres/comparaisons.php';
require 'include/html/parametres/promos.php';
require 'include/html/parametres/day.php';
include 'include/html/footer.php'; ?>