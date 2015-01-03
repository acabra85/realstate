<?php

    include_once("../ctrl/security.php");
    include_once("Vista.php");
    $vista = Vista::getInstance();
    if(isset($_POST['form_type']))
    {
        $ft=$_POST['form_type'];
        switch ($ft)
        {
            case "tipo_documento":
                $vista->ejecutarProcesarTipoDocumento($_POST['descripcion_documento']);
                break;
            case "tipo_inmueble":
                if(isset ($_POST['nom_inmueble']) && isset ($_POST['desc_inmueble']))
                    $vista->ejecutarProcesarTipoInmueble($_POST['nom_inmueble'],$_POST['desc_inmueble']);
                else
                    $vista->ejecutarmostrarError($ft);
                break;
            case "estado_cambios":
                if(isset($_POST['nombre_estado']) && isset($_POST['desc_estado']))
                {
                    $vista->ejecutarProcesarEstadoCambios($_POST['nombre_estado'], 
                                                            $_POST['desc_estado']);
                }
                else
                {
                    $vista->ejecutarmostrarError($ft);
                }
                break;
            case "producto":
                if(isset($_POST['nombre_producto']) && 
                   isset($_POST['desc_producto']) &&
                   isset($_POST['costo_producto']))
                {
                    $vista->ejecutarProcesarProducto($_POST['nombre_producto'], 
                                                     $_POST['desc_producto'],
                                                     $_POST['costo_producto']);
                }
                else
                {
                    $vista->ejecutarmostrarError($ft);
                }
                break;
            case "crear_cesion_contrato":
                if(isset($_POST['num_con']) &&
                   isset($_POST['id_cli']))
                {
                    $vista->ejecutarProcesarCesionContrato($_POST['num_con'],
                                                     $_POST['id_cli']);
                }
                else
                {
                    $vista->ejecutarmostrarError($ft);
                }
                break;
            case "devolver_inmueble":
                if(isset($_POST['num_con']) &&
                   isset($_POST['inm_mat']))
                {
                    $vista->ejecutarProcesarDevolverInmueble($_POST['num_con'],
                                                     $_POST['inm_mat']);
                }
                else
                {
                    $vista->ejecutarmostrarError($ft);
                }
                break;
            case "modif_cliente":
                if(isset($_POST['email_cliente']) &&
                            isset($_POST['ced_cliente']) &&
                            isset($_POST['telf_cliente']) &&
                            isset($_POST['telc_cliente']))
                    {
                        
                                $vista->ejecutarProcesarClienteNaturalM($_POST['ced_cliente'],
                                                             $_POST['email_cliente'],
                                                             $_POST['telf_cliente'],
                                                             $_POST['telc_cliente']);
                    }
                else
                {
                    $vista->ejecutarMostrarError($ft);
                }
                break;
            case "modif_clienteJ":
                if(isset($_POST['email_cliente']) &&
                            isset($_POST['ced_cliente']) &&
                            isset($_POST['telf_cliente']) &&
                            isset($_POST['dirweb_cliente']) &&
                            isset($_POST['telc_cliente']))
                    {

                                $vista->ejecutarProcesarClienteJuridicoM($_POST['ced_cliente'],
                                                             $_POST['email_cliente'],
                                                             $_POST['telf_cliente'],
                                                             $_POST['telc_cliente'],$_POST['dirweb_cliente']);
                    }
                else
                {
                    $vista->ejecutarMostrarError($ft);
                }
                break;
            case "cliente":
                if(isset($_POST['tipo_persona']))
                {

                    if( isset($_POST['nombre_cliente']) &&
                            isset($_POST['cedula_cliente']) &&
                            isset($_POST['email_cliente']) &&
                            isset($_POST['telf_cliente']) &&
                            isset($_POST['telc_cliente']))
                    {
                        if($_POST['tipo_persona']=='natural')
                        {
                            if( isset($_POST['apellido_cliente']) &&
                                    isset($_POST['fnac_cliente']) &&
                                    isset($_POST['genero_cliente']))
                            {
                                $vista->ejecutarProcesarClienteNatural($_POST['cedula_cliente'],
                                                             $_POST['nombre_cliente'],
                                                             $_POST['email_cliente'],
                                                             $_POST['telf_cliente'],
                                                             $_POST['telc_cliente'],
                                                             $_POST['apellido_cliente'],
                                                             $_POST['genero_cliente'],
                                                             $_POST['fnac_cliente']);
                            }
                            else
                                $vista->ejecutarMostrarError($ft);
                        }
                        else
                        {
                            if( isset($_POST['dirweb_cliente']))
                            {
                                $vista->ejecutarProcesarClienteJuridico($_POST['cedula_cliente'],
                                                             $_POST['nombre_cliente'],
                                                             $_POST['email_cliente'],
                                                             $_POST['telf_cliente'],
                                                             $_POST['telc_cliente'],
                                                             $_POST['dirweb_cliente']);
                            }
                            else
                                $vista->ejecutarMostrarError($ft);
                        }
                    }
                    else
                        $vista->ejecutarMostrarError($ft);
                }
                else
                {
                    $vista->ejecutarMostrarError($ft);
                }
                break;
            case "vista_productos":
                if (isset($_POST['info_actualizar']) && strlen($_POST['info_actualizar'])>0 && 
                            isset($_POST['cant_modif']) && strlen($_POST['cant_modif'])>0 &&
                        isset($_POST['act_type']) && strlen($_POST['act_type'])>0 )
                {
                    if($_POST['act_type']=="0")
                        $vista->ejecutarActualizarProductos($_POST['info_actualizar'], $_POST['cant_modif']);
                    else if($_POST['act_type']=="1")
                        $vista->ejecutarBorrarProductos($_POST['info_actualizar'], $_POST['cant_modif']);
                    else
                        $vista->ejecutarMostrarError($ft);
                }
                else
                {
                    $vista->ejecutarMostrarError($ft);
                }
                break;
            case "crear_tipo_producto":
                if(isset($_POST['nombre_tipo_producto']) && isset($_POST['desc_tipo_producto']))
                {
                    $vista->ejecutarProcesarTipoProducto($_POST['nombre_tipo_producto'],
                                                            $_POST['desc_tipo_producto']);
                }
                else
                {
                    $vista->ejecutarmostrarError($ft);
                }
                break;
            case "crear_usuario":
                if(isset($_POST['nombre_usuario']) && isset($_POST['password_usuario']) &&
                        strlen($_POST['nombre_usuario'])>0 && strlen($_POST['password_usuario'])>0 )
                {
                    $vista->ejecutarProcesarUsuario($_POST['nombre_usuario'],
                                                            $_POST['password_usuario']);
                }
                else
                {
                    $vista->ejecutarmostrarError($ft);
                }
                break;
            case "crear_pais":
                if(isset($_POST['nombre_pais']) && isset($_POST['codigo_pais']) &&
                        strlen($_POST['nombre_pais'])>0 && strlen($_POST['codigo_pais'])>0 )
                {
                    $vista->ejecutarProcesarPais($_POST['nombre_pais'],
                                                            $_POST['codigo_pais']);
                }
                else
                {
                    $vista->ejecutarmostrarError($ft);
                }
                break;
            case "modificar_password":
                if(isset($_POST['nombre_usuario']) && isset($_POST['password_usuario']))
                {
                    $vista->ejecutarProcesarModificarPassword($_POST['nombre_usuario'],
                                                            $_POST['password_usuario']);
                }
                else
                {
                    $vista->ejecutarmostrarError($ft);
                }
                break;

            case "crear_depto":
                if(isset($_POST['nombre_depto']) &&
                   isset($_POST['codigo_depto']) &&
                   isset($_POST['id_pais'])
                        )
                {
                    $vista->ejecutarProcesarDepartamento($_POST['nombre_depto'],
                                                     $_POST['codigo_depto'],
                                                     $_POST['id_pais']);
                }
                else
                {
                    //$vista->ejecutarMostrarError($ft);
                }
                break;
            case "crear_ciudad":
                if(isset($_POST['nombre_ciudad']) &&
                   isset($_POST['codigo_ciudad']) &&
                   isset($_POST['id_depto']) &&
                   isset($_POST['id_pais'])
                        )
                {
                    $vista->ejecutarProcesarCiudad($_POST['nombre_ciudad'],
                                                     $_POST['codigo_ciudad'],
                                                     $_POST['id_depto'],
                                                     $_POST['id_pais']);
                }
                else
                {
                    $vista->ejecutarMostrarError($ft);
                }
                break;
            case "crear_sucursal":
                if(isset($_POST['nombre_sucursal']) &&
                   isset($_POST['codigo_sucursal']) &&
                   isset($_POST['telefono_sucursal']) &&
                   isset($_POST['direccion_inm']) &&
                   isset($_POST['id_ciudad']) &&
                   isset($_POST['id_depto']) &&
                   isset($_POST['id_pais'])  
                        )
                {
                    $vista->ejecutarProcesarSucursal($_POST['nombre_sucursal'],
                                                     $_POST['codigo_sucursal'],
                                                     $_POST['telefono_sucursal'],
                                                     $_POST['direccion_inm'],
                                                     $_POST['id_ciudad'],
                                                     $_POST['id_depto'],
                                                     $_POST['id_pais']);
                }
                else
                {
                    $vista->ejecutarMostrarError($ft);
                }
                break;
            case "crear_vendedor":
                if(isset($_POST['nombre_vendedor']) &&
                    isset($_POST['apellido_vendedor']) &&
                    isset($_POST['genero_vendedor']) &&
                    isset($_POST['fechanac_vendedor']) &&
                    isset($_POST['cedula_vendedor']) &&
                    isset($_POST['id_sucursal']) &&
                    isset($_POST['fechaing_vendedor']) &&
                    isset($_POST['cedula_jefe']) &&
                    isset($_POST['password_usuario'])
                        )
                {
                    $vista->ejecutarProcesarVendedor($_POST['nombre_vendedor'],
                                                    $_POST['apellido_vendedor'],
                                                    $_POST['genero_vendedor'],
                                                    $_POST['fechanac_vendedor'],
                                                    $_POST['cedula_vendedor'],
                                                    $_POST['id_sucursal'],
                                                    $_POST['fechaing_vendedor'],
                                                    $_POST['cedula_jefe'],
                                                    $_POST['password_usuario']);
                }
                else
                {
                    $vista->ejecutarMostrarError($ft);
                }
                break;
            case "modif_vendedor":
                if(
                    isset($_POST['cedula_vendedor']) &&
                    isset($_POST['id_sucursal']) &&
                    isset($_POST['cedula_jefe']) &&
                    isset($_POST['password_usuario'])
                        )
                {
                    $vista->ejecutarProcesarVendedorM(
                                                    $_POST['cedula_vendedor'],
                                                    $_POST['id_sucursal'],
                                                    $_POST['cedula_jefe'],
                                                    $_POST['password_usuario']);
                }
                else
                {
                    $vista->ejecutarMostrarError($ft);
                }
                break;
            case "crear_inmueble":
                if(isset($_POST['tipo_inm']) &&
                    isset($_POST['matricula_inm']) &&
                    isset($_POST['est_inm']) &&
                    isset($_POST['direccion_inm']) &&
                    isset($_POST['area_inm']) &&
                    isset($_POST['cantba_inm']) &&
                    isset($_POST['cantpi_inm']) &&
                    isset($_POST['cantparq_inm']) &&
                    isset($_POST['valimp_inm']) &&
                    isset($_POST['valadm_inm']) &&
                    isset($_POST['id_ciudad']) &&
                    isset($_POST['desc_inm'])
                        )
                {
                    $vista->ejecutarProcesarInmueble($_POST['tipo_inm'],
                                                    $_POST['matricula_inm'],
                                                    $_POST['est_inm'],
                                                    $_POST['direccion_inm'],
                                                    $_POST['area_inm'],
                                                    $_POST['cantba_inm'],
                                                    $_POST['cantpi_inm'],
                                                    $_POST['cantparq_inm'],
                                                    $_POST['valimp_inm'],
                                                    $_POST['valadm_inm'],
                                                    $_POST['desc_inm'],
                                                    $_POST['id_ciudad']);
                }
                else
                {
                    $vista->ejecutarMostrarError($ft);
                }
                break;
            case "modif_inmueble":
                if(isset($_POST['id_inm']) &&
                    isset($_POST['valimp_inm']) &&
                    isset($_POST['valadm_inm']) &&
                    isset($_POST['desc_inm'])
                        )
                {
                    $vista->ejecutarProcesarInmuebleM($_POST['id_inm'],
                                                    $_POST['valimp_inm'],
                                                    $_POST['valadm_inm'],
                                                    $_POST['desc_inm']);
                }
                else
                {
                    $vista->ejecutarMostrarError($ft);
                }
                break;
            case "crear_contrato":
                if(isset($_POST['id_cli']) &&
                    isset($_POST['id_inm']) &&
                    isset($_POST['tipo_cont']) &&
                    isset($_POST['fechafin_contrato']) &&
                    isset($_POST['fechaini_contrato']) &&
                    isset($_POST['id_vend']) &&
                    isset($_POST['val_cont'])
                        )
                {
                    $vista->ejecutarProcesarContrato($_POST['fechaini_contrato'],
                                                    $_POST['fechafin_contrato'],
                                                    $_POST['tipo_cont'],
                                                    $_POST['val_cont'],
                                                    $_POST['id_cli'],
                                                    $_POST['id_inm'],
                                                    $_POST['id_vend']);
                }
                else
                {
                    $vista->ejecutarMostrarError($ft);
                }
                break;
            case "crear_pago":
                if(isset($_POST['tip_contrato']) &&
                   isset($_POST['total_cuota']) &&
                   isset($_POST['num_cuota']) &&
                   isset($_POST['con_num']) &&
                   isset($_POST['ced_cliente'])
                        )
                {

                    $varTip=$_POST['tip_contrato']=="Arriendo"?"2":"1";
                    if( isset($_POST['desc_estado']))
                    $vista->ejecutarProcesarCrearFactura($varTip,
                                                     $_POST['total_cuota'],
                                                     $_POST['num_cuota'],
                                                     $_POST['desc_estado'],
                                                     $_POST['con_num'],
                                                     $_POST['ced_cliente']);
                    else
                    $vista->ejecutarProcesarCrearFactura($varTip,
                                                     $_POST['total_cuota'],
                                                     $_POST['num_cuota'],
                                                     "",
                                                     $_POST['con_num'],
                                                     $_POST['ced_cliente']);
                }
                else
                {
                    $vista->ejecutarMostrarError($ft);
                }
                break;
            case "crear_factura":
                if(isset($_POST['tip_contrato']) &&
                   isset($_POST['total_cuota']) &&
                   isset($_POST['num_cuota']) &&
                   isset($_POST['con_num']) &&
                   isset($_POST['num_pago']) &&
                   isset($_POST['fec_pago']) &&
                   isset($_POST['ced_cliente'])
                        )
                {

                    $varTip=$_POST['tip_contrato']=="Arriendo"?"2":"1";
                    $vista->ejecutarProcesarContenidoFactura($varTip,
                                                     $_POST['total_cuota'],
                                                     $_POST['num_cuota'],
                                                     "",
                                                     $_POST['con_num'],
                                                     $_POST['ced_cliente'],
                                                     $_POST['num_pago'],
                                                     $_POST['fec_pago'],
                                                     $_POST['nom_cliente'],
                                                     $_POST['base_cuota'],
                                                     $_POST['iva_cuota'],
                                                     $_POST['num_matricula']);
                }
                else
                {
                    $vista->ejecutarMostrarError($ft);
                }
                break;
            case "vista_inmuebles":
                if(isset ($_POST['id_inmueble']))
                    $vista->ejecutarMostrarFormularioInmuebleM($_POST['id_inmueble']);
                else
                    $vista->ejecutarmostrarError($ft);
                break;
            case "vista_clientes":
                if(isset ($_POST['id_cliente']))
                    $vista->ejecutarMostrarFormularioClienteM($_POST['id_cliente']);
                else
                    $vista->ejecutarmostrarError($ft);
                break;
            case "vista_clientesJ":
                if(isset ($_POST['id_cliente']))
                    $vista->ejecutarMostrarFormularioClienteJM($_POST['id_cliente']);
                else
                    $vista->ejecutarmostrarError($ft);
                break;
            case "vista_vendedores":
                if(isset ($_POST['id_vendedor']))
                    $vista->ejecutarMostrarFormularioVendedorM($_POST['id_vendedor']);
                else
                    $vista->ejecutarmostrarError($ft);
                break;
            default:
                header('Location: ../index.php?msg=unknown');
        }
    }
    else
        header('Location: ../index.php?msg=unknown');
    
?>
