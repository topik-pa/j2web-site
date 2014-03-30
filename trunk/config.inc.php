<?php
define("DB_HOST", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "nektasoft_auto");

$connect = mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD) or die("Database Connection Error");

mysql_select_db(DB_DATABASE) or ("Database Selection Error");

$emailagenzia="n.morsillo@nektasoft.it";

$nomeagenzia="Auto Nuove e Usate";

?>
