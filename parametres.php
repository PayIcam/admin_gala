<?php
require 'config.php';
require 'include/html/header.php';
require 'include/db_functions.php';

$bd = connect_to_db($confSQL);

$status = set_quotas();

require 'include/html/parametres/quotas.php';
require 'include/html/parametres/comparaisons.php';
include 'include/html/footer.php'; ?>