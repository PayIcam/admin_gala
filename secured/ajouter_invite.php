<?php

require '../include/display_functions.php';
require '../config.php';
require '../include/db_functions.php';
require '../include/html/display_html_functions.php';

$bd = connect_to_db($confSQL);

require'../include/html/display_add.php';
