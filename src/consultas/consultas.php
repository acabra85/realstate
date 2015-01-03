<?php
    /*
     * Agustin Cabra . 2011
     * Pagina encargada de recibir las consultas Ajax para obtener combos
     */
    include_once("../ctrl/security.php");
    include_once("../Vista/Vista.php");
    $vista= Vista::getInstance();
    if(isset ($_POST['origin']))
    {
        $ori=$_POST['origin'];
        switch ($ori)
        {
            case "ciudad":                
                if(isset ($_POST['cod_pais']))
                    $vista->ejecutarObtenerComboDepartamentos($_POST['cod_pais']);            
                break;
            case "sucursal":
                if(isset ($_POST['cod_pais']) && !isset ($_POST['cod_depto']))
                    $vista->ejecutarObtenerComboDepartamentosSucursal($_POST['cod_pais']);
                if(isset ($_POST['cod_depto']) && isset ($_POST['cod_pais']))
                    $vista->ejecutarObtenerComboCiudades($_POST['cod_depto'], $_POST['cod_pais']);
                break;
            case "pago":
                if(isset ($_POST['con_num']) && isset ($_POST['id_cliente']))
                {
                    //echo "".$_POST['id_cliente']."-".$_POST['con_num'];
                    $vista->ejecutarObtenerInformacionPago($_POST['con_num'], $_POST['id_cliente']);
                }
                break;
            default:
                header('Location: ../index.php?msg=security_closed');
        }
    }
    else
        header('Location: ../index.php?msg=security_closed');
?>