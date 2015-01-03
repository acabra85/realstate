<?php

	if (isset($_GET['msg']))
	{
		if(($_GET['msg'])== 'wrong_pass')
			echo("Error: clave invalida");
		else if(($_GET['msg'])== 'wrong_username')
			echo("Error: usuario invalido");
		else if(($_GET['msg'])== 'login')
			echo("Error: por favor inicie session");
		else if(($_GET['msg'])== 'err_con')
			echo("Error: error al conectar a la bd");
		else if(($_GET['msg'])== 'unknown')
                {
                    session_start();
                    $var="";
                    if(isset ($_SESSION['username']))
                    {
                        session_unset();
                        session_destroy();
                        $var = "loggedout";
                    }
                    echo("Error: manejo de sesion desconocido");
                }
		else if(($_GET['msg'])== 'security_closed')
			echo("Error: No hay sesión registrada");
		else if(($_GET['msg'])== 'loggedout')
			echo("Error: Sesion finalizada exitosamente");
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Inmosys</title>

</head>

<body bgcolor="#F0F0F0">

<div align='center'>



<form name="frm_login" method="post" action="pages/start.php">

    <table border="0" width="341" height="311" background="files/login.png">

        <tbody >

            <tr>

                <td>

                    <div align="center">

                        <table>

                            <tr>

                                <td><span style='color:white'><b>Usuario:</b></span></td>

                                <td>

                                    <input type="text" id="username" name="username" size="20"></input>

                                </td>

                            </tr>

                            <tr>

                                <td><span style='color:white'><b>Contraseña:</b></span></td>

                                <td>

                                    <input type="password" id="password" name="password" size="20"></input>

                                </td>

                            </tr>

                            <tr>

                                <td colspan="2">

                                    <div align="right"><input  type="submit" value="Login"></input></div>

                                </td>

                            </tr>

                        </table>

                    </div>

                </td>

            </tr>

        </tbody>

    </table>

</form>

</div>

</body>

</html>