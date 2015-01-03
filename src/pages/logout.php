<?php
        session_start();
        $var="";
	if(isset ($_SESSION['username']))
        {
            session_unset();
            session_destroy();
            $var = "loggedout";
        }
        header('Location: ../index.php?msg='.$var);
?>