<?php
    include_once('../ctrl/security.php');
    include_once('../Vista/Vista.php');
    $vista = Vista::getInstance();
    $vista->ejecutarMostrarContratos();
?>
