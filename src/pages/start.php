<?php
        session_start();
        include_once ("../Vista/Vista.php");
        include_once("../phpjobscheduler/firepjs.php");
        $vista = Vista::getInstance();
        $vista->ejecutar();
?>