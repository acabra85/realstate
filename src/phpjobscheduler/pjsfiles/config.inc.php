<?php
// ---------------------------------------------------------
 $app_name = "phpJobScheduler";
 $phpJobScheduler_version = "3.7";
// ---------------------------------------------------------

include_once("../../modelo/Dbase.php");

$bd = DBase::getInstance();
$conf = $bd->getConf();

define('DBHOST', $conf[0]);
define('DBNAME', $conf[1]);
define('DBUSER', $conf[2]);
define('DBPASS', $conf[3]);

define('DEBUG', true);// set to false when done testing

?>