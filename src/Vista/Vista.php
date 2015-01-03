<?php
    include_once("../ctrl/security.php");
    include_once("../ctrl/Control.php");
    include_once("HtmlGenerator.php");
    include_once("PDFGenerator.php");
    include_once("CodRes.php");

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vista
 *
 * @author Agustin
 */
class Vista
{
    //put your code here
    private $genHtml;
    private $genPdf;
    private $control; 
    static private $instancia;
    private function  __construct()
    {
        date_default_timezone_set('America/Bogota');
        $this->genHtml = HtmlGenerator::getInstance();
        $this->control = Control::getInstance();
        $this->genPdf = new PDFGenerator();
    }

    static public function getInstance()
    {
        if(self::$instancia==NULL)
        {
            self::$instancia = new Vista();
        }
        return self::$instancia;
    }

    public function ejecutar()
    {
        $this->ejecutarLogin($_POST['username'],$_POST['password']);
    }

    public function ejecutarLogin($usr, $pass)
    {
        $res = $this->control->srvLogin($usr, $pass);
        switch ($res)     
        {
            case CodRes::USUARIO_INVALIDO:
                $this->control->insertarloglogin($_POST['username'],$_POST['password']);
                header('Location: ../index.php?msg=wrong_username');
                break;  
            case CodRes::CLAVE_INVALIDA:
                $this->control->insertarloglogin($_POST['username'],$_POST['password']);
                header('Location: ../index.php?msg=wrong_pass');
                break;
            case CodRes::NO_CONNECTED:
                header('Location: ../index.php?msg=err_con');
                break;
            case CodRes::EXITO:
                header('Location: ../pages/home.php');
                break;
            default:
                header('Location: ../index.php?msg=unknown');
        }
    }

    public function ejecutarMostrarCrearCliente()
    {        
        $this->genHtml->imprimirMostrarFormularioCliente("tipo_cliente", "Natural%%Juridico", 2, "", "mostrarCamposTipoNJ(this)");
    }

    public function ejecutarProcesarClienteNatural($cedC, $nomC, $emailC, $telfC, $telcC, $apeC, $genC, $fnacC)
    {
        $res = CodRes::DATOS_INVALIDOS;
        $msg = "";
        $info = "";
        $res=$this->control->srvProcesarClienteNatural($cedC, $nomC, $emailC, $telfC, $telcC, $apeC, $genC, $fnacC);
        switch ($res)
        {
            case CodRes::DATOS_VACIOS:
                $info = "DATOS VACIOS";
                $msg= "Debe completar todos los campos solicitados";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::DATOS_INVALIDOS:
                $info = "DATOS INVALIDOS";
                $msg= "LA INFORMACION INGRESADA ES INVALIDA, FAVOR INTENTE DE NUEVO";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::LONGITUD_INVALIDA:
                $info = "LONGITUD DE CAMPOS INVALIDA";
                $msg= "Maximo de Caracteres por Campo<br>".
                        "Nombre: 15<br>Apellido: 15<br>No. Identificación: 15<br>Tel. Fijo: 7<br>".
                        "Tel. Cel: 10<br>email: 40";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::REGISTRO_REPETIDO:
                $info = "CLIENTE YA EXISTE";
                $msg= "LOS DATOS INGRESADOS CORRESPONDEN A UN CLIENTE<br>".
                "YA REGISTRADO EN EL SISTEMA.";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $info = "CLIENTE REGISTRADO";
                $msg = "EL CLIENTE FUE CREADO EXITOSAMENTE!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }
public function ejecutarProcesarClienteNaturalM($cedC,$emailC, $telfC, $telcC)
    {
        $res = CodRes::DATOS_INVALIDOS;
        $msg = "";
        $info = "";
        $res=$this->control->srvProcesarClienteNaturalM($cedC,$emailC, $telfC, $telcC);
        switch ($res)
        {
            case CodRes::DATOS_VACIOS:
                $info = "DATOS VACIOS";
                $msg= "Debe completar todos los campos solicitados";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::DATOS_INVALIDOS:
                $info = "DATOS INVALIDOS";
                $msg= "LA INFORMACION INGRESADA ES INVALIDA, FAVOR INTENTE DE NUEVO";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::LONGITUD_INVALIDA:
                $info = "LONGITUD DE CAMPOS INVALIDA";
                $msg= "Maximo de Caracteres por Campo<br>".
                        "<br>Tel. Fijo: 7<br>".
                        "Tel. Cel: 10<br>email: 40";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::CLIENTE_INEXISTENTE:
                $info = "CLIENTE NO EXISTE";
                $msg= "LOS DATOS INGRESADOS CORRESPONDEN A UN CLIENTE<br>".
                "YA REGISTRADO EN EL SISTEMA.";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $info = "CLIENTE ACTUALIZADO";
                $msg = "EL CLIENTE FUE CREADO EXITOSAMENTE!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }
    public function ejecutarProcesarClienteJuridico($cedC, $nomC, $emailC, $telfC, $telcC, $dweb)
    {
        $res = CodRes::DATOS_INVALIDOS;
        $msg = "";
        $info = "";
        $res=$this->control->srvProcesarClienteJuridico($cedC, $nomC, $emailC, $telfC, $telcC, $dweb);
        switch ($res)
        {
            case CodRes::DATOS_VACIOS:
                $info = "DATOS VACIOS";
                $msg= "Debe completar todos los campos solicitados";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::DATOS_INVALIDOS:
                $info = "DATOS INVALIDOS";
                $msg= "LA INFORMACION INGRESADA ES INVALIDA, FAVOR INTENTE DE NUEVO";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::LONGITUD_INVALIDA:
                $info = "LONGITUD DE CAMPOS INVALIDA";
                $msg= "Maximo de Caracteres por Campo<br>".
                        "Nombre: 35<br>No. Identificación: 15<br>Tel. Fijo: 7<br>".
                        "Tel. Cel: 10<br>email: 40<br>Pág. WEB.: 20";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::REGISTRO_REPETIDO:
                $info = "CLIENTE YA EXISTE";
                $msg= "LOS DATOS INGRESADOS CORRESPONDEN A UN CLIENTE<br>".
                "YA REGISTRADO EN EL SISTEMA.";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $info = "CLIENTE REGISTRADO";
                $msg = "EL CLIENTE FUE CREADO EXITOSAMENTE!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }


    public function ejecutarProcesarClienteJuridicoM($cedC, $emailC, $telfC, $telcC, $dweb)
    {
        $res = CodRes::DATOS_INVALIDOS;
        $msg = "";
        $info = "";
        $res=$this->control->srvProcesarClienteJuridicoM($cedC, $emailC, $telfC, $telcC, $dweb);
        switch ($res)
        {
            case CodRes::DATOS_VACIOS:
                $info = "DATOS VACIOS";
                $msg= "Debe completar todos los campos solicitados";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::DATOS_INVALIDOS:
                $info = "DATOS INVALIDOS";
                $msg= "LA INFORMACION INGRESADA ES INVALIDA, FAVOR INTENTE DE NUEVO";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::LONGITUD_INVALIDA:
                $info = "LONGITUD DE CAMPOS INVALIDA";
                $msg= "Maximo de Caracteres por Campo<br>".
                        "Tel. Fijo: 7<br>".
                        "Tel. Cel: 10<br>email: 40<br>Pág. WEB.: 50";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::CLIENTE_INEXISTENTE:
                $info = "CLIENTE NO EXISTE";
                $msg= "LOS DATOS INGRESADOS NO CORRESPONDEN A UN CLIENTE<br>".
                "REGISTRADO EN EL SISTEMA.";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $info = "CLIENTE ACTUALIZADO";
                $msg = "EL CLIENTE FUE CREADO EXITOSAMENTE!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::NO_CONNECTED:
                $info = "SIN CONEXION";
                $msg = "ERROR DE CONEXION!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }
     
    public function ejecutarMostrarMenuHome()
    {
        $this->genHtml->imprimirMenuHome();
    }
    public function ejecutarMostrarHomeModulos()
    {
        $this->genHtml->imprimirMenuHomeModulos();
    }

    public function ejecutarMostrarMenuDesplegable()
    {
        $this->genHtml->imprimirMenuDesplegable();
    }
    public function ejecutarMostrarModuloEncabezado()
    {
        $this->genHtml->imprimirModuloEncabezado("HOME");
    }
    public function ejecutarMostrarModuloHome()
    {
        $this->genHtml->imprimirModuloHome("HOME");
    }
    public function ejecutarMostrarMenuAdministracion()
    {        
        $this->genHtml->imprimirMenuAdministracion();
    }
    public function ejecutarMostrarMenuContratos() {
        $this->genHtml->imprimirMenuContratos();
    }
    public function ejecutarMostrarCrearUsuario()
    {
        $this->genHtml->imprimirMostrarFormularioUsuario();
    }

    public function ejecutarMostrarModificarPassword()
    {
        $this->genHtml->imprimirMostrarFormularioModificarPassword();
    }

    public function ejecutarMostrarError($var)
    {
        $info = "ERROR PROCESANDO FORMULARIO DESTINO ".strtoupper($var);
        $msg = "FAVOR COMPLETE TODOS LOS CAMPOS!";
        $this->genHtml->imprimirResultado($info, $msg);
    }

    public function ejecutarProcesarUsuario($nomb_usr, $pwd_usr)
    {
        $res = CodRes::DATOS_INVALIDOS;
        $msg = "";
        $info = "";
        $res=$this->control->srvProcesarUsuario($nomb_usr, $pwd_usr);
        switch ($res)
        {
            case CodRes::DATOS_VACIOS:
                $info = "DATOS VACIOS";
                $msg= "Debe completar todos los campos solicitados";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::DATOS_INVALIDOS:
                $info = "DATOS INVALIDOS";
                $msg= "El nombre de usuario es invalido<br>".
                        "debe contener caracteres alfanumericos<br>";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::CLAVE_INVALIDA:
                $info = "DATOS INVALIDOS";
                $msg= "La clave ingresada no es valida\n".
                        "no se permiten espacios en blanco y debe contener\n".
                            "entre 4 y 8 caracteres";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::REGISTRO_REPETIDO:
                $info = "USUARIO YA EXISTE";
                $msg= "El nombre de usuario ya se encuentra registrado.";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $info = "USUARIO INGRESADO";
                $msg = "EL USUARIO FUE CREADO EXITOSAMENTE!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }

    public function ejecutarMostrarCrearTipoDocumento()
    {
        $this->genHtml->imprimirMostrarFormularioTipoDocumento();
    }

    public function ejecutarProcesarTipoDocumento($desc_doc)
    {
        $res = CodRes::DATOS_INVALIDOS;
        $msg = "";
        $info = "";
        $res=$this->control->srvProcesarTipoDocumento($desc_doc);
        switch ($res)
        {
            case CodRes::DATOS_VACIOS:
                $info = "DATOS VACIOS";
                $msg= "Debe completar todos los campos solicitados";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::DATOS_INVALIDOS:
                $info = "DATOS INVALIDOS";
                $msg= "Los datos ingresados son invalidos";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::REGISTRO_REPETIDO:
                $info = "DOCUMENTO YA EXISTE";
                $msg= "El documento ingresado ya se encuentra registrado.";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $info = "DOCUMENTO PROCESADO";
                $msg = "EL DOCUMENTO FUE CREADO EXITOSAMENTE!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }


    public function ejecutarProcesarTipoInmueble($nom_inm, $desc_doc)
    {
        $res = CodRes::DATOS_INVALIDOS;
        $msg = "";
        $info = "";
        $res=$this->control->srvProcesarTipoInmueble($nom_inm, $desc_doc);
        switch ($res)
        {
            case CodRes::DATOS_VACIOS:
                $info = "DATOS VACIOS";
                $msg= "Debe completar todos los campos solicitados";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::DATOS_INVALIDOS:
                $info = "DATOS INVALIDOS";
                $msg= "Los datos ingresados son invalidos";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::REGISTRO_REPETIDO:
                $info = "TIPO INMUEBLE YA EXISTE";
                $msg= "El Tipo de Inmueble ingresado ya se encuentra registrado.";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $info = "INMUEBLE PROCESADO";
                $msg = "EL DOCUMENTO FUE CREADO EXITOSAMENTE!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }


    public function ejecutarMostrarCrearEstadoCambios()
    {
        $this->genHtml->imprimirMostrarFormularioEstadoCambios();
    }

    public function ejecutarProcesarEstadoCambios($nom_estado, $desc_estado)
    {
        $res = CodRes::DATOS_INVALIDOS;
        $msg = "";
        $info = "";
        $res=$this->control->srvProcesarEstadoCambios($nom_estado, $desc_estado);
        switch ($res)
        {
            case CodRes::DATOS_VACIOS:
                $info = "DATOS VACIOS";
                $msg= "Debe completar todos los campos solicitados";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::DATOS_INVALIDOS:
                $info = "DATOS INVALIDOS";
                $msg= "La descripcion debe tener maximo 150 caracteres";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::REGISTRO_REPETIDO:
                $info = "ESTADO YA EXISTE";
                $msg= "El ESTADO ingresado ya se encuentra registrado.";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $info = "ESTADO PROCESADO";
                $msg = "EL ESTADO FUE CREADO EXITOSAMENTE!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }
    

    public function ejecutarMostrarCrearTipoProducto()
    {
        $this->genHtml->imprimirMostrarFormularioTipoProducto();
    }

    public function ejecutarProcesarTipoProducto($tipo_producto, $desc_prod)
    {
        $res = CodRes::DATOS_INVALIDOS;
        $msg = "";
        $info = "";
        $res=$this->control->srvProcesarTipoProducto($tipo_producto, $desc_prod);
        switch ($res)
        {
            case CodRes::DATOS_VACIOS:
                $info = "DATOS VACIOS";
                $msg= "Debe completar todos los campos solicitados";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::DATOS_INVALIDOS:
                $info = "DATOS INVALIDOS";
                $msg= "El tipo debe tener maximo 14 caracteres<br>".
                        "La descripcion debe tener maximo 150 caracteres";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::REGISTRO_REPETIDO:
                $info = "TIPO YA EXISTE";
                $msg= "El TIPO DE PRODUCTO ingresado ya se encuentra registrado.";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $info = "TIPO PROCESADO";
                $msg = "EL TIPO DE PRODUCTO FUE CREADO EXITOSAMENTE!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }

    
    public function ejecutarMostrarCrearProducto()
    {
        $res = CodRes::SIN_REGISTROS;
        $res=$this->control->srvObtenerTiposProducto($nom_tipoprod, $cant_tipoprod, $ids_tipoprod);
        switch ($res)
        {
            case CodRes::SIN_REGISTROS:
                 $this->genHtml->imprimirMostrarFormularioProducto($nom_tipoprod, 0, $ids_tipoprod);
                break;
            case CodRes::EXITO:
                $this->genHtml->imprimirMostrarFormularioProducto($nom_tipoprod, $cant_tipoprod, $ids_tipoprod);
                break;
            default:
                header('Location: ../index.php?msg=unknown');
        }
    }

    public function ejecutarProcesarProducto($nom_prod, $desc_prod, $cost_prod)
    {
        $res = CodRes::DATOS_INVALIDOS;
        $msg = "";
        $info = "";
        $res=$this->control->srvProcesarProducto($nom_prod, $desc_prod, $cost_prod);
        //echo $nom_prod.$desc_prod.$cost_prod;
        switch ($res)
        {
            case CodRes::DATOS_VACIOS:
                $info = "DATOS VACIOS";
                $msg= "Debe completar todos los campos solicitados";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::LONGITUD_INVALIDA:
                $info = "DATOS INVALIDOS";
                $msg= "El Nombre debe tener maximo 40 caracteres<br>".
                        "La descripcion debe tener maximo 60 caracteres<br>".
                        "El costo debe tener maximo 10 caracteres<br>";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::NUMERO_NEGATIVO:
                $info = "DATOS INVALIDOS";
                $msg = "El costo debe ser mayor que cero";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::REGISTRO_REPETIDO:
                $info = "PRODUCTO YA EXISTE";
                $msg= "El PRODUCTO ingresado ya se encuentra registrado.";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $info = "PRODUCTO PROCESADO";
                $msg = "EL PRODUCTO FUE CREADO EXITOSAMENTE!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }

    public function ejecutarMostrarClientes()
    {
        $res=$this->control->srvObtenerDatosClientes($datos_clientes, $num_clientes);
        switch ($res)
        {
            case CodRes::SIN_REGISTROS:
                $info = "SIN REGISTROS";
                $msg = "NO SE ENCONTRARON CLIENTES REGISTRADOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $this->genHtml->imprimirVistaClientes($datos_clientes, $num_clientes);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }

    public function ejecutarMostrarClientesJuridicos()
    {
        $res=$this->control->srvObtenerDatosClientesJuridicos($datos_clientes, $num_clientes);
        switch ($res)
        {
            case CodRes::SIN_REGISTROS:
                $info = "SIN REGISTROS";
                $msg = "NO SE ENCONTRARON EMPRESAS REGISTRADAS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $this->genHtml->imprimirVistaClientesJuridicos($datos_clientes, $num_clientes);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }
    
    public function ejecutarMostrarUsuarios()
    {
        $res=$this->control->srvObtenerDatosUsuarios($datos_clientes, $num_clientes);
        switch ($res)
        {
            case CodRes::SIN_REGISTROS:
                $info = "SIN REGISTROS";
                $msg = "NO SE ENCONTRARON CLIENTES REGISTRADOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $this->genHtml->imprimirVistaUsuarios($datos_clientes, $num_clientes);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }


    public function ejecutarMostrarLogUsuarios()
    {
        $res=$this->control->srvObtenerVistaLogUsuarios($datos_clientes, $num_clientes);
        switch ($res)
        {
            case CodRes::SIN_REGISTROS:
                $info = "SIN REGISTROS";
                $msg = "NO SE ENCONTRARON CLIENTES REGISTRADOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $this->genHtml->imprimirVistaLogUsuarios($datos_clientes, $num_clientes);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }

    public function ejecutarMostrarLogClientes()
    {
        $res=$this->control->srvObtenerVistaLogClientes($datos_clientes, $num_clientes);
        switch ($res)
        {
            case CodRes::SIN_REGISTROS:
                $info = "SIN REGISTROS";
                $msg = "NO SE ENCONTRARON CLIENTES REGISTRADOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $this->genHtml->imprimirVistaLogClientes($datos_clientes, $num_clientes);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }
    
    public function ejecutarMostrarTiposDocumentos()
    {
        $res=$this->control->srvObtenerTiposDocumento($datos_tiposDocumentos, $num_tiposDocumentos, $ids_doc);
        switch ($res)
        {
            case CodRes::SIN_REGISTROS:
                $info = "SIN REGISTROS";
                $msg = "NO SE ENCONTRARON TIPOS DOCUMENTALES REGISTRADOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $this->genHtml->imprimirVistaTiposDocumentos($datos_tiposDocumentos, $num_tiposDocumentos, $ids_doc);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }

    public function ejecutarMostrarTiposOT()
    {
        $res=$this->control->srvObtenerVistaTipoOT($datos_tipo_OT, $ids_tipo_ot, $num_tipo_ot, $desc_tipo_ot);
        switch ($res)
        {
            case CodRes::SIN_REGISTROS:
                $info = "SIN REGISTROS";
                $msg = "NO SE ENCONTRARON TIPOS ORDENES DE TRABAJO REGISTRADAS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $this->genHtml->imprimirVistaTiposOT($datos_tipo_OT, $num_tipo_ot, $ids_tipo_ot, $desc_tipo_ot);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }

    public function ejecutarMostrarTiposProducto()
    {
        $res=$this->control->srvObtenerVistaTiposProducto($datos_tipo_OT, $ids_tipo_ot, $num_tipo_ot, $desc_tipo_ot);
        switch ($res)
        {
            case CodRes::SIN_REGISTROS:
                $info = "SIN REGISTROS";
                $msg = "NO SE ENCONTRARON TIPOS DE PRODUCTO!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $this->genHtml->imprimirVistaTiposProducto($datos_tipo_OT, $num_tipo_ot, $ids_tipo_ot, $desc_tipo_ot);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }

    public function ejecutarMostrarEstadoCambios()
    {
        $res=$this->control->srvObtenerVistaEstadoCambios($datos_estado, $ids_estado, $num, $desc_estado);
        switch ($res)
        {
            case CodRes::SIN_REGISTROS:
                $info = "SIN REGISTROS";
                $msg = "NO SE ENCONTRARON ESTADOS REGISTRADOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $this->genHtml->imprimirVistaEstadoCambios($datos_estado, $ids_estado, $num, $desc_estado);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }

    public function ejecutarMostrarProductos()
    {
        $res=$this->control->srvObtenerVistaProductos($ids_producto, $datos_producto, $desc_producto, $costo_producto, $num);
        switch ($res)
        {
            case CodRes::SIN_REGISTROS:
                $info = "SIN REGISTROS";
                $msg = "NO SE ENCONTRARON ESTADOS REGISTRADOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $this->genHtml->imprimirVistaProductos($ids_producto, $datos_producto, $desc_producto, $costo_producto, $num);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }

    public function ejecutarMostrarCotizacion()
    {
        $res=$this->control->srvObtenerVistaProductos($ids_producto, $datos_producto, $desc_producto, $costo_producto, $num);
        switch ($res)
        {
            case CodRes::SIN_REGISTROS:
                $info = "SIN REGISTROS";
                $msg = "NO SE ENCONTRARON ESTADOS REGISTRADOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $this->genHtml->imprimirVistaCotizacion($ids_producto, $datos_producto, $desc_producto, $costo_producto, $num);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }

    public function ejecutarActualizarClientes($datos_clientesA, $num_modif)
    {
        $res=$this->control->srvActualizarDatosClientes($datos_clientesA, $num_modif);
        switch ($res)
        {
            case CodRes::DATOS_INVALIDOS:
                $info = "DATOS INVALIDOS";
                $msg  = "ERROR CON LOS DATOS INGRESADOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $res=$this->control->srvObtenerDatosClientes($datos_clientes, $num_clientes);
                $this->genHtml->imprimirVistaClientes($datos_clientes, $num_clientes);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }

    public function ejecutarBorrarClientes($datos_clientesA, $num_modif)
    {
        $res=$this->control->srvBorrarClientes($datos_clientesA, $num_modif);
        switch ($res)
        {
            case CodRes::DATOS_INVALIDOS:
                $info = "DATOS INVALIDOS";
                $msg  = "ERROR CON LOS DATOS INGRESADOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $res=$this->control->srvObtenerDatosClientes($datos_clientes, $num_clientes);
                $this->genHtml->imprimirVistaClientes($datos_clientes, $num_clientes);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }

    public function ejecutarActualizarProductos($datos_productosA, $num_modif)
    {
        $res=$this->control->srvActualizarDatosProductos($datos_productosA, $num_modif);
        switch ($res)
        {
            case CodRes::SIN_REGISTROS:
                $info = "SIN REGISTROS";
                $msg = "NO SE ENCONTRARON PRODUCTOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::DATOS_INVALIDOS:
                $info = "DATOS INVALIDOS";
                $msg  = "ERROR CON LOS DATOS INGRESADOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $res=$this->control->srvObtenerVistaProductos($ids_producto, $datos_producto, $desc_producto, $costo_producto, $num);
                $this->genHtml->imprimirVistaProductos($ids_producto, $datos_producto, $desc_producto, $costo_producto, $num);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }


    public function ejecutarProcesarModificarPassword($nom_usr, $pass_usr)
    {
        $res=$this->control->srvModificarPassword($nom_usr, $pass_usr);

        switch ($res)
        {
            case CodRes::SIN_REGISTROS:
                $info = "SIN REGISTROS";
                $msg = "ERROR USUARIO NO REGISTRADO EN EL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::DATOS_INVALIDOS:
                $info = "DATOS INVALIDOS";
                $msg  = "ERROR CON LOS DATOS INGRESADOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::DATOS_VACIOS:
                $info = "DATOS VACIOS";
                $msg  = "DEBE COMPLETAR TODOS LOS CAMPOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::CLAVE_INVALIDA:
                $info = "CLAVE INVALIDA";
                $msg  = "LAS CONTRASEÑAS DEBEN CONTENER ENTRE 4 Y 8 CARACTERES<br>!".
                        "FAVOR VERIFIQUELA E INTENTELO NUEVAMENTE";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $info = "OPERACION FINALIZADA!";
                $msg  = "LA CONTRASEÑA SE ACTUALIZO EXITOSAMENTE!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }

    public function ejecutarBorrarProductos($datos_productosA, $num_modif)
    {
        $res=$this->control->srvBorrarProductos($datos_productosA, $num_modif);
        switch ($res)
        {
            case CodRes::DATOS_INVALIDOS:
                $info = "DATOS INVALIDOS";
                $msg  = "ERROR CON LOS DATOS INGRESADOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $resA=$this->control->srvObtenerVistaProductos($ids_producto, $datos_producto, $desc_producto, $costo_producto, $num);
                $this->genHtml->imprimirVistaProductos($ids_producto, $datos_producto, $desc_producto, $costo_producto, $num);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }

    public function ejecutarMostrarCrearPais()
    {
        $this->control->srvObtenerVistaPaises($paises, $num, "tabla");
        $this->genHtml->imprimirMostrarFormularioPais($paises, $num);
    }

    public function ejecutarProcesarPais($nomb_pais,$cod_pais)
    {
         $res = CodRes::DATOS_INVALIDOS;
        $msg = "";
        $info = "";
        $res=$this->control->srvProcesarPais($nomb_pais, $cod_pais);
        switch ($res)
        {
            case CodRes::DATOS_VACIOS:
                $info = "DATOS VACIOS";
                $msg= "Debe completar todos los campos solicitados";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::DATOS_INVALIDOS:
                $info = "DATOS INVALIDOS";
                $msg= "El nombre del pais es inválido<br>".
                        "debe contener carácteres alfanuméricos<br>";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::REGISTRO_REPETIDO:
                $info = "PAIS YA EXISTE";
                $msg= "El Pais ingresado ya se encuentra registrado.";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $info = "PAIS INGRESADO";
                $msg = "EL PAIS FUE CREADO EXITOSAMENTE!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }
    public function ejecutarMostrarPaises()
    {
        $res=$this->control->srvObtenerVistaPaises($datos_paises, $num_paises, "");
        switch ($res)
        {
            case CodRes::SIN_REGISTROS:
                $info = "SIN REGISTROS";
                $msg = "NO SE ENCONTRARON PAISES REGISTRADOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $this->genHtml->imprimirVistaPaises($datos_paises, $num_paises);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }

    public function ejecutarMostrarCrearDepartamento()
    {
        $res = CodRes::SIN_REGISTROS;
        $res=$this->control->srvObtenerPaises($ids,$nom, $cant);
        $this->control->srvObtenerVistaDepartamentos($datos, $num, "tabla");
        switch ($res)
        {
            case CodRes::SIN_REGISTROS:
                $info = "SIN REGISTROS";
                $msg = "NO SE ENCONTRARON PAISES REGISTRADOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
                break;
            case CodRes::EXITO:
                $this->genHtml->imprimirMostrarFormularioDepartamento($ids,$nom, $cant, $datos, $num);
                break;
            default:
                header('Location: ../index.php?msg=unknown');
        }
    }
    public function ejecutarProcesarDepartamento($nom, $cod, $idp)
    {
        $res = CodRes::DATOS_INVALIDOS;
        $msg = "";
        $info = "";
        $res=$this->control->srvProcesarDepartamento($nom, $cod, $idp);
        switch ($res)
        {
            case CodRes::DATOS_VACIOS:
                $info = "DATOS VACIOS";
                $msg= "Debe completar todos los campos solicitados";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::DATOS_INVALIDOS:
                $info = "DATOS INVALIDOS";
                $msg= "LA INFORMACION INGRESADA ES INVALIDA, FAVOR INTENTE DE NUEVO";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::LONGITUD_INVALIDA: 
                $info = "LONGITUD DE CAMPOS INVALIDA";
                $msg= "Maximo de Caracteres por Campo<br>".
                        "Nombre: 15<br>Codigo: 10<br>";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::REGISTRO_REPETIDO:
                $info = "DEPARTAMENTO YA EXISTE";
                $msg= "LOS DATOS INGRESADOS CORRESPONDEN A UN DEPARTAMENTO<br>".
                "YA REGISTRADO EN EL SISTEMA.";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $info = "DEPARTAMENTO REGISTRADO";
                $msg = "EL DEPARTAMENTO FUE CREADO EXITOSAMENTE!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }

    }


    public function ejecutarMostrarDepartamentos()
    {
        $res=$this->control->srvObtenerVistaDepartamentos($datos, $num, "");
        switch ($res)
        {
            case CodRes::SIN_REGISTROS:
                $info = "SIN REGISTROS";
                $msg = "NO SE ENCONTRARON DEPARTAMENTOS REGISTRADOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $this->genHtml->imprimirVistaDepartamentos($datos, $num);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }

    public function ejecutarMostrarCrearCiudad()
    {
        $res = CodRes::SIN_REGISTROS;
        $res=$this->control->srvObtenerPaises($idsP,$nomP, $cantP);
        switch ($res)
        {
            case CodRes::SIN_REGISTROS:
                $info = "SIN REGISTROS";
                $msg = "NO SE ENCONTRARON PAISES REGISTRADOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $this->control->srvObtenerVistaCiudades($datos, $num, "tabla");
                $this->genHtml->imprimirMostrarFormularioCiudad($idsP, $nomP, $cantP, $datos,$num);
                break;
            default:
                header('Location: ../index.php?msg=unknown');
        }
    }

    public function ejecutarMostrarCrearContrato()
    {
        $res = CodRes::SIN_REGISTROS;
        $res=$this->control->srvObtenerClientes($ids,$nom, $cant);
        switch ($res)
        {
            case CodRes::NO_CONNECTED:
                $info = "ERROR DE CONEXION I";
                $msg = "ERROR AL CONECTAR CON LA BASE DE DATOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::SIN_REGISTROS:
                $info = "NO HAY CLIENTES REGISTRADOS";
                $msg = "FAVOR ADICIONE CLIENTES! <br><a href='../forms/cliente.php'>Haga click aqui para crear uno</a>";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                    $res2 = CodRes::SIN_REGISTROS;
                    $res2=$this->control->srvObtenerMatriculasInmuebles($idsI, $nomI, $cantI);
                    if($res2==CodRes::NO_CONNECTED)
                    {
                        $info = "ERROR DE CONEXION II";
                        $msg = "ERROR AL CONECTAR CON LA BASE DE DATOS!";
                        $this->genHtml->imprimirResultado($info, $msg);
                    }
                    else if($res2==CodRes::SIN_REGISTROS)
                    {
                        $info = "NO HAY INMUEBLES DISPONIBLES";
                        $msg = "FAVOR CREE UN TIPO DE INMUEBLE O LIBERE UNO EXISTENTE! <br><a href='../forms/inmueble.php'>Haga click aqui para crear uno</a>";
                        $this->genHtml->imprimirResultado($info, $msg);
                    }
                    else if($res2==CodRes::DATOS_INVALIDOS)
                    {
                        $info = "CONSULTA INVALIDA<br>";
                        $msg = "VERIFIQUE CON EL ADMINISTRADOR DEL SISTEMA";
                        $this->genHtml->imprimirResultado($info, $msg);
                    }
                    else if($res2==CodRes::EXITO)
                    {
                        $res3 = $this->control->srvObtenerConsecutivoContrato($num_con);
                        $res4 = $this->control->srvObtenerVendedores($idsV, $nomsV, $cantV);
                        if($res3==CodRes::EXITO)
                        {
                            $this->genHtml->imprimirMostrarFormularioContrato($ids, $nom, $cant,$idsI, $nomI,$cantI, $idsV, $nomsV, $cantV, $num_con);
                        }
                        else if($res3==CodRes::SIN_REGISTROS)
                        {
                            $info = "NO HAY INMUEBLES DISPONIBLES";
                            $msg = "FAVOR CREE UN TIPO DE INMUEBLE O LIBERE UNO EXISTENTE! <br><a href='../forms/inmueble.php'>Haga click aqui para crear uno</a>";
                            $this->genHtml->imprimirResultado($info, $msg);
                        }
                        break;
                    }
                    else
                        header('Location: ../index.php?msg=unknown');
                    break;
            default:
                header('Location: ../index.php?msg=unknown');
        }
    }

    public function ejecutarMostrarCiudades()
    {
        $res=$this->control->srvObtenerVistaCiudades($datos, $num, "");
        switch ($res)
        {
            case CodRes::SIN_REGISTROS:
                $info = "SIN REGISTROS";
                $msg = "NO SE ENCONTRARON CIUDADES REGISTRADAS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $this->genHtml->imprimirVistaCiudades($datos, $num);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }

    public function ejecutarMostrarCrearSucursal()
    {
        $res = CodRes::SIN_REGISTROS;
        $res=$this->control->srvObtenerPaises($idsP,$nomP, $cantP);
        switch ($res)
        {
            case CodRes::SIN_REGISTROS:
                $this->genHtml->imprimirMostrarFormularioSucursal($idsP, $nomP, 0);
                break;
            case CodRes::EXITO:
                $this->genHtml->imprimirMostrarFormularioSucursal($idsP, $nomP, $cantP);
                break;
            default:
                header('Location: ../index.php?msg=unknown');
        }
    }
    
    public function ejecutarObtenerComboDepartamentos($id_dep)
    {
        $res= CodRes::SIN_REGISTROS;
        $res=$this->control->srvObtenerComboDepartamentos($id_dep,$datos, $num);
        switch ($res)
        {
            case CodRes::EXITO:
                    $this->genHtml->imprimirComboDepartamentos("nom_depto",$datos, $num);
                    break;
            case CodRes::SIN_REGISTROS:
                    $this->genHtml->imprimirComboDepartamentos("nom_depto",$datos, 0);
                    break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);                
        }
    }

    public function ejecutarObtenerComboDepartamentosSucursal($id_dep)
    {
        $res= CodRes::SIN_REGISTROS;
        $res=$this->control->srvObtenerComboDepartamentos($id_dep,$datos, $num);
        switch ($res)
        {
            case CodRes::EXITO:
                    $this->genHtml->imprimirComboDepartamentosSucursal("nom_depto",$datos, $num);
                    break;
            case CodRes::SIN_REGISTROS: 
                    $this->genHtml->imprimirComboDepartamentosSucursal("nom_depto",$datos, 0);
                    break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }

    public function ejecutarObtenerComboContratos($id_depto, $id_pais)
    {
        $res= CodRes::SIN_REGISTROS;
        $res=$this->control->srvObtenerComboContratos($id_cli,$datos, $num);
        switch ($res)
        {
            case CodRes::EXITO:
                    $this->genHtml->imprimirComboCiudades("con_num",$datos, $num);
                    break;
            case CodRes::SIN_REGISTROS:
                    $this->genHtml->imprimirComboCiudades("con_num",$datos, 0);
                    break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }

    public function ejecutarObtenerComboCiudades($id_depto, $id_pais)
    {
        $res= CodRes::SIN_REGISTROS;
        $res=$this->control->srvObtenerComboCiudades($id_depto, $id_pais,$datos, $num);
        switch ($res)
        {
            case CodRes::EXITO:
                    $this->genHtml->imprimirComboCiudades("nom_ciudad",$datos, $num);
                    break;
            case CodRes::SIN_REGISTROS:
                    $this->genHtml->imprimirComboCiudades("nom_ciudad",$datos, 0);
                    break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }
    
    public function ejecutarProcesarCiudad($nom_ciud, $cod_ciud,$id_depto,$id_pais)
    {
        $res = CodRes::DATOS_INVALIDOS;
        $msg = "";
        $info = "";
        $res=$this->control->srvProcesarCiudad($nom_ciud, $cod_ciud,$id_depto,$id_pais);
        switch ($res)
        {
            case CodRes::DATOS_VACIOS:
                $info = "DATOS VACIOS";
                $msg= "Debe completar todos los campos solicitados";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::DATOS_INVALIDOS:
                $info = "DATOS INVALIDOS";
                $msg= "LA INFORMACION INGRESADA ES INVALIDA, FAVOR INTENTE DE NUEVO";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::LONGITUD_INVALIDA:
                $info = "LONGITUD DE CAMPOS INVALIDA";
                $msg= "Maximo de Caracteres por Campo<br>".
                        "Nombre: 10<br>Codigo: 10";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::REGISTRO_REPETIDO:
                $info = "CIUDAD YA EXISTE";
                $msg= "LOS DATOS INGRESADOS CORRESPONDEN A UNA CIUDAD<br>".
                "YA REGISTRADO EN EL SISTEMA.";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $info = "CIUDAD REGISTRADA";
                $msg = "LA CIUDAD FUE CREADA EXITOSAMENTE!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }


    public function ejecutarProcesarSucursal($nom_sucursal, $cod_sucursal,
                                                $tel_sucursal, $dir_sucursal,
                                                $id_ciudad, $id_depto, $id_pais)
    {
        $res = CodRes::DATOS_INVALIDOS;
        $msg = "";
        $info = "";
        $res=$this->control->srvProcesarSucursal($nom_sucursal, $cod_sucursal,
                                                $tel_sucursal, $dir_sucursal,
                                                $id_ciudad, $id_depto, $id_pais);
        switch ($res)
        {
            case CodRes::DATOS_VACIOS:
                $info = "DATOS VACIOS";
                $msg= "Debe completar todos los campos solicitados";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::DATOS_INVALIDOS:
                $info = "DATOS INVALIDOS";
                $msg= "LA INFORMACION INGRESADA ES INVALIDA, FAVOR INTENTE DE NUEVO";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::LONGITUD_INVALIDA:
                $info = "LONGITUD DE CAMPOS INVALIDA";
                $msg= "Maximo de Caracteres por Campo<br>".
                        "Nombre: 10<br>Codigo: 10<br>".
                        "Telefono: 10<br>Dirección: 45<br>";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::REGISTRO_REPETIDO:
                $info = "SUCURSAL YA EXISTE";
                $msg= "LOS DATOS INGRESADOS CORRESPONDEN A UNA SUCURSAL<br>".
                "YA REGISTRADO EN EL SISTEMA.";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $info = "SUCURSAL REGISTRADA";
                $msg = "LA SUCURSAL FUE CREADA EXITOSAMENTE!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!\nERROR CON LA SENTENCIA SQL";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }
    public function ejecutarMostrarSucursales()
    {
        $res=  CodRes::NO_CONNECTED;
        $res=$this->control->srvObtenerVistaSucursales($datos, $num);
        switch ($res)
        {
            case CodRes::SIN_REGISTROS:
                $info = "SIN REGISTROS";
                $msg = "NO SE ENCONTRARON SUCURSALES REGISTRADAS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $this->genHtml->imprimirVistaSucursales($datos, $num);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }


    public function ejecutarMostrarCrearVendedor()
    {
        $res = CodRes::SIN_REGISTROS;
        $res=$this->control->srvObtenerComboSucursales($ids,$datos_suc, $num);
        switch ($res)
        {
            case CodRes::SIN_REGISTROS:
                $this->genHtml->imprimirMostrarFormularioVendedor($ids, $datos_suc, 0);
                break;
            case CodRes::EXITO:
                $this->genHtml->imprimirMostrarFormularioVendedor($ids, $datos_suc, $num);
                break;
            default:
                header('Location: ../index.php?msg=unknown');
        }
    }

    public function ejecutarProcesarVendedor($nomb_vend, $ape_vend, $gen_vend,$fnac_vend,
                                            $ced_vend,$id_suc,$fing_vendedor,$ced_jefe, $pass_vend)
    {
        $res = CodRes::DATOS_INVALIDOS;
        $msg = "";
        $info = "";
        $res=$this->control->srvProcesarVendedor($nomb_vend, $ape_vend, $gen_vend,$fnac_vend,
                                            $ced_vend,$id_suc,$fing_vendedor,$ced_jefe, $pass_vend);
        switch ($res)
        {
            case CodRes::DATOS_VACIOS:
                $info = "DATOS VACIOS";
                $msg= "Debe completar todos los campos solicitados";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::DATOS_INVALIDOS:
                $info = "DATOS INVALIDOS";
                $msg= "LA INFORMACION INGRESADA ES INVALIDA, FAVOR INTENTE DE NUEVO";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::LONGITUD_INVALIDA:
                $info = "LONGITUD DE CAMPOS INVALIDA";
                $msg= "Maximo de Caracteres por Campo<br>".
                        "Nombre: 35<br>Apellido: 35<br>Cedula Vendedor: 15<br>".
                        "Cedula Jefe: 15<br>Contraseña: 10<br>";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::REGISTRO_REPETIDO:
                $info = "VENDEDOR YA EXISTE";
                $msg= "LOS DATOS INGRESADOS CORRESPONDEN A UN VENDEDOR<br>".
                "YA REGISTRADO EN EL SISTEMA.";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::ERRORES_FECHAS:
                $info = "FECHAS INVALIDAS";
                $msg = "FAVOR REVISE QUE LAS FECHAS INGRESADAS SEAN CORRECTAS!".
                        "<br>La fecha de ingreso no puede ser anterior a hoy<br>".
                        "La fecha de nacimiento no puede ser posterior a hoy<br>";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $info = "VENDEDOR REGISTRADO";
                $msg = "EL VENDEDOR FUE CREADO EXITOSAMENTE!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!\nERROR DE EJECUCION SQL";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }

    public function ejecutarProcesarVendedorM($ced_vend,$id_suc,$ced_jefe, $pass_vend)
    {
        $res = CodRes::DATOS_INVALIDOS;
        $msg = "";
        $info = "";
        $res=$this->control->srvProcesarVendedorM($ced_vend,$id_suc,$ced_jefe, $pass_vend);
        switch ($res)
        {
            case CodRes::DATOS_VACIOS:
                $info = "DATOS VACIOS";
                $msg= "Debe completar todos los campos solicitados";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::DATOS_INVALIDOS:
                $info = "DATOS INVALIDOS";
                $msg= "LA INFORMACION INGRESADA ES INVALIDA, FAVOR INTENTE DE NUEVO";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::LONGITUD_INVALIDA:
                $info = "LONGITUD DE CAMPOS INVALIDA";
                $msg= "Maximo de Caracteres por Campo<br>".
                        "Cedula Jefe: 15<br>Contraseña: 10<br>";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::CLIENTE_INEXISTENTE:
                $info = "VENDEDOR NO EXISTE";
                $msg= "LOS DATOS INGRESADOS NO CORRESPONDEN A UN VENDEDOR<br>".
                " REGISTRADO EN EL SISTEMA.";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::NO_CONNECTED:
                $info = "ERROR DE CONEXION ";
                $msg = "ERROR AL CONECTAR CON LA BASE DE DATOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $info = "VENDEDOR ACTUALIZADO";
                $msg = "EL VENDEDOR FUE CREADO EXITOSAMENTE!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!\nERROR DE EJECUCION SQL";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }

    public function ejecutarMostrarVendedores()  
    {
        $res=$this->control->srvObtenerVistaVendedores($datos, $num);
        switch ($res) 
        {
            case CodRes::SIN_REGISTROS:
                $info = "SIN REGISTROS";
                $msg = "NO SE ENCONTRARON VENDEDORES REGISTRADOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $this->genHtml->imprimirVistaVendedores($datos, $num);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }


    public function ejecutarMostrarInmuebles()
    {
        $res=$this->control->srvObtenerVistaInmuebles($datos, $num);
        switch ($res)
        {
            case CodRes::SIN_REGISTROS:
                $info = "SIN REGISTROS";
                $msg = "NO SE ENCONTRARON INMUEBLES REGISTRADOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $this->genHtml->imprimirVistaInmuebles($datos, $num);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }


    public function ejecutarCrearCesionContrato()
    {

        $res = CodRes::SIN_REGISTROS;
        $res=$this->control->srvObtenerClientes($ids,$nom, $cant);
        switch ($res)
        {
            case CodRes::NO_CONNECTED:
                $info = "ERROR DE CONEXION I";
                $msg = "ERROR AL CONECTAR CON LA BASE DE DATOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::SIN_REGISTROS:
                $info = "NO HAY CLIENTES REGISTRADOS";
                $msg = "FAVOR ADICIONE CLIENTES! <br><a href='../forms/cliente.php'>Haga click aqui para crear uno</a>";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                    $res2 = CodRes::SIN_REGISTROS;
                    $res2=$this->control->srvObtenerContratosPorTipo($idsI, $nomI, $cantI,2);
                    if($res2==CodRes::NO_CONNECTED)
                    {
                        $info = "ERROR DE CONEXION II";
                        $msg = "ERROR AL CONECTAR CON LA BASE DE DATOS!";
                        $this->genHtml->imprimirResultado($info, $msg);
                    }
                    else if($res2==CodRes::SIN_REGISTROS)
                    {
                        $info = "NO HAY CONTRATOS DE ARRENDAMIENTO VIGENTES";
                        $msg = "NO ES POSIBLE GESTIONAR SU SOLICITUD! <br><a href='../forms/contrato.php'>Haga click aqui para crear uno</a>";
                        $this->genHtml->imprimirResultado($info, $msg);
                    }
                    else if($res2==CodRes::EXITO)
                    {
                       // $res3=$this->control->srvObtenerConsecutivoContrato($num_con);
                       // $res4 = $this->control->srvObtenerVendedores($idsV, $nomsV, $cantV);
                        $this->genHtml->imprimirMostrarFormularioCesionContrato($ids, $nom, $cant,$idsI, $nomI,$cantI);
                    }
                    else
                        header('Location: ../index.php?msg=unknown1');
                    break;
            default:
                header('Location: ../index.php?msg=unknown');
        }

    }


    public function ejecutarMostrarReportesClientes()
    {
        $datos_clientes=null;
        $num_clientes=0;
        $res=$this->control->srvObtenerReporteClientes($datos_clientes, $num_clientes);
        switch ($res)
        {
            case CodRes::SIN_REGISTROS:
                $info = "SIN REGISTROS";
                $msg = "NO SE ENCONTRARON CLIENTES REGISTRADOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $this->genHtml->imprimirVistaReporteClientes($datos_clientes, $num_clientes);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }

    public function ejecutarMostrarReportesContratos()
    {
        $res=$this->control->srvObtenerReporteContratos($datos_contratos, $num_contratos, 1);
        switch ($res)
        {
            case CodRes::SIN_REGISTROS:
                $info = "SIN REGISTROS";
                $msg = "NO SE ENCONTRARON CLIENTES REGISTRADOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $this->genHtml->imprimirVistaReporteContratos($datos_contratos, $num_contratos);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }

    public function ejecutarMostrarReportesInmuebles()
    {
        $res=$this->control->srvObtenerReporteInmuebles($datos_inmuebles, $num_inmuebles, 1);
        switch ($res)
        {
            case CodRes::SIN_REGISTROS:
                $info = "SIN REGISTROS";
                $msg = "NO SE ENCONTRARON CLIENTES REGISTRADOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $this->genHtml->imprimirVistaReporteInmuebles($datos_inmuebles, $num_inmuebles);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }

    public function ejecutarMostrarReportesVendedores()
    {
        $res=$this->control->srvObtenerReporteVendedores($datos_usuarios, $num_usuarios, 1);
        switch ($res)
        {
            case CodRes::SIN_REGISTROS:
                $info = "SIN REGISTROS";
                $msg = "NO SE ENCONTRARON USUARIOS REGISTRADOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $this->genHtml->imprimirVistaReporteVendedores($datos_usuarios, $num_usuarios);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }

    public function ejecutarMostrarCrearInmueble() 
    {
        $res = CodRes::SIN_REGISTROS;
        $res=$this->control->srvObtenerPaises($idsP,$nomP, $cantP);
        switch ($res)
        {
            case CodRes::NO_CONNECTED:
                $info = "ERROR DE CONEXION I";
                $msg = "ERROR AL CONECTAR CON LA BASE DE DATOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::SIN_REGISTROS:
                $info = "NO HAY TIPOS DE INMUEBLE REGISTRADOS";
                $msg = "FAVOR CREE UN TIPO DE INMUEBLE! <br><a href='../forms/tipo_inmueble.php'>Haga click aqui para crear uno</a>";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                    $res2 = CodRes::SIN_REGISTROS;
                    $res2=$this->control->srvObtenerTiposInmueble($ids,$cant,$nom);
                    if($res2==CodRes::NO_CONNECTED)
                    {
                        $info = "ERROR DE CONEXION II";
                        $msg = "ERROR AL CONECTAR CON LA BASE DE DATOS!";
                        $this->genHtml->imprimirResultado($info, $msg);
                    }
                    else if($res2==CodRes::SIN_REGISTROS)
                    {
                        $info = "NO HAY TIPOS DE INMUEBLE REGISTRADOS";
                        $msg = "FAVOR CREE UN TIPO DE INMUEBLE! <br><a href='../forms/tipo_inmueble.php'>Haga click aqui para crear uno</a>";
                        $this->genHtml->imprimirResultado($info, $msg);
                    }
                    else if($res2==CodRes::EXITO)
                    {
                        $this->genHtml->imprimirMostrarFormularioInmueble($ids, $nom, $cant,$nomP,$cantP,$idsP);
                        break;
                    }
                    else
                        header('Location: ../index.php?msg=unknown');
                    break;
            default:
                header('Location: ../index.php?msg=unknown');
        }
    }


    public function ejecutarMostrarCrearTipoInmueble()
    {
        $this->genHtml->imprimirMostrarFormularioTipoInmueble();
    }

    public function ejecutarMostrarTiposInmuebles()
    {
        $res=$this->control->srvObtenerVistaTiposInmueble($datos_tiposDocumentos, $num_tiposDocumentos, $ids_doc, $desc_inm);
        switch ($res)
        {
            case CodRes::NO_CONNECTED:
                $info = "ERROR DE CONEXION";
                $msg = "ERROR AL CONECTAR CON LA BASE DE DATOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::SIN_REGISTROS:
                $info = "SIN REGISTROS";
                $msg = "NO SE ENCONTRARON TIPOS DE INMUEBLE REGISTRADOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $this->genHtml->imprimirVistaTiposInmueble($datos_tiposDocumentos, $num_tiposDocumentos, $ids_doc, $desc_inm);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }



    public function ejecutarProcesarInmueble($tip_inm, $mat_inm, $est_inm, $dir_inm,
                                                $area_inm, $cantba_inm, $cantpi_inm, $cantparq_inm,
                                                    $valimp_inm, $valadm_inm, $desc_inm, $id_ciudad)
    {
        $res = CodRes::DATOS_INVALIDOS;
        $msg = "";
        $info = "";
        $res=$this->control->srvProcesarInmueble($tip_inm, $mat_inm, $est_inm, $dir_inm,
                                                $area_inm, $cantba_inm, $cantpi_inm, $cantparq_inm,
                                                    $valimp_inm, $valadm_inm, $desc_inm, $id_ciudad);
        switch ($res)
        {
            case CodRes::DATOS_VACIOS:
                $info = "DATOS VACIOS";
                $msg= "Debe completar todos los campos solicitados";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::DATOS_INVALIDOS:
                $info = "DATOS INVALIDOS";
                $msg= "LA INFORMACION INGRESADA ES INVALIDA, FAVOR INTENTE DE NUEVO";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::LONGITUD_INVALIDA:
                $info = "LONGITUD DE CAMPOS INVALIDA";
                $msg= "Maximo de Caracteres por Campo<br>".
                        "No. Matricula: 25<br>Direccion: 45<br>Area Total: 4<br>Cant. Baños: 2<br>".
                        "Cant. Pisos: 2<br>Cant. Parqueaderos: 2<br>Val. Impuestos: 8<br>Val. Administración: 8".
                        "<br>Descripción: 255<br>";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::REGISTRO_REPETIDO:
                $info = "INMUEBLE YA EXISTE";
                $msg= "LOS DATOS INGRESADOS CORRESPONDEN A UN INMUEBLE<br>".
                "YA REGISTRADO EN EL SISTEMA.";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $info = "INMUEBLE REGISTRADO";
                $msg = "EL INMUEBLE FUE CREADO EXITOSAMENTE!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::NO_CONNECTED:
                $info = "ERROR DE CONEXION";
                $msg = "ERROR AL CONECTAR CON LA BASE DE DATOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }

    public function ejecutarProcesarContrato($fecini_con,$fecfin_con,$tip_con, $val_con, $id_cli,$id_inm, $id_vend)
    {
        $res = CodRes::DATOS_INVALIDOS;
        $msg = "";
        $info = "";
        $res=$this->control->srvProcesarContrato($fecini_con,$fecfin_con,$tip_con, $val_con, $id_cli,$id_inm, $id_vend);
        switch ($res)
        {
            case CodRes::DATOS_VACIOS:
                $info = "DATOS VACIOS";
                $msg= "Debe completar todos los campos solicitados";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::DATOS_INVALIDOS:
                $info = "DATOS INVALIDOS";
                $msg= "LA INFORMACION INGRESADA ES INVALIDA, FAVOR INTENTE DE NUEVO";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::LONGITUD_INVALIDA:
                $info = "LONGITUD DE CAMPOS INVALIDA";
                $msg= "Maximo de Caracteres por Campo<br>".
                        "Valor Contrato: 8<br>";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::DURACION_CONTRATO:
                $info = "DURACION DE CONTRATO INVALIDA";
                $msg= "RECUERDE QUE LOS CONTRATOS ESTAN ASI:<br>".
                        "Minimo Periodo: 6 Meses<br>Máximo Periodo:1 Año";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::INMUEBLE_INEXISTENTE:
                $info = "ERROR EL INMUEBLE NO EXISTE";
                $msg = "EL INMUEBLE NO EXISTE EN EL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::PROPIEDAD_ARRENDADA:
                $info = "PROPIEDAD ARRENDADA";
                $msg= "LA PROPIEDAD SE ENCUENTRA ACTUALMENTE EN ARRIENDO".
                        "<br>NO SE PUDEDE GESTIONAR CONTRATO DE ARRENDAMIENTO";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $info = "CONTRATO REGISTRADO";
                $msg = "EL CONTRATO FUE REGISTRADO EXITOSAMENTE!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO_0:
                $info = "CONTRATO REGISTRADO";
                $msg = "EL CONTRATO FUE REGISTRADO EXITOSAMENTE!".
                        "<br>PENDIENTE QUITAR DISPONIBILIDAD DE INMUEBLE";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO_1:
                $info = "CONTRATO REGISTRADO";
                $msg = "EL CONTRATO FUE REGISTRADO EXITOSAMENTE!".
                        "<br>PENDIENTE ADICIONAR VENTAS AL VENDEDOR";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::NO_CONNECTED:
                $info = "ERROR DE CONEXION";
                $msg = "ERROR AL CONECTAR CON LA BASE DE DATOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::MISMO_CLIENTE:
                $info = "EL CLIENTE SELECCIONADO ES PROPIETARIO DEL INMUEBLE";
                $msg = "FAVOR SELECCIONE UN CLIENTE DISTINTO PARA COMPRAR EL INMUEBLE!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            default:
                $info = "ERROR DE INSERCION";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }


    public function ejecutarMostrarContratos()
    {
        $res=$this->control->srvObtenerVistaContratos($datos, $num);
        switch ($res)
        {
            case CodRes::SIN_REGISTROS:
                $info = "SIN REGISTROS";
                $msg = "NO SE ENCONTRARON CONTRATOS REGISTRADOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $this->genHtml->imprimirVistaContratos($datos, $num);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }

    public function ejecutarMostrarCambiosInmueble()
    {
        $res=$this->control->srvObtenerVistaCambiosInmuebles($datos, $num);
        switch ($res)
        {
            case CodRes::SIN_REGISTROS:
                $info = "SIN REGISTROS";
                $msg = "NO SE ENCONTRARON CAMBIOS EN INMUEBLES!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $this->genHtml->imprimirVistaEstadoInmuebles($datos, $num);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }


    public function ejecutarProcesarCesionContrato($num_con, $id_cli)
    {
        $res = CodRes::DATOS_INVALIDOS;
        $msg = "";
        $info = "";
        $res=$this->control->srvProcesarCesionContrato($num_con, $id_cli);
        switch ($res)
        {
            case CodRes::DATOS_VACIOS:
                $info = "DATOS VACIOS";
                $msg= "Debe completar todos los campos solicitados";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::DATOS_INVALIDOS:
                $info = "DATOS INVALIDOS";
                $msg= "LA INFORMACION INGRESADA ES INVALIDA, FAVOR INTENTE DE NUEVO";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::LONGITUD_INVALIDA:
                $info = "LONGITUD DE CAMPOS INVALIDA";
                $msg  = "Maximo de Caracteres por Campo<br>".
                        "Valor Contrato: 8<br>";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::CONTRATO_INEXISTENTE:
                $info = "ERROR EL CONTRATO NO EXISTE";
                $msg = "EL CONTRATO NO EXISTE EN EL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::MISMO_CLIENTE:
                $info = "ERROR CLIENTE ACTUAL PROPIETARIO";
                $msg = "EL CLIENTE SELECCIONADO ES EL ACTUAL PROPIETARIO DEL CONTRATO<br>".
                        "FAVOR SELECCIONE OTRO CLIENTE!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::PROPIETARIO_INMUEBLE:
                $info = "ERROR CLIENTE ES PROPIETARIO";
                $msg = "EL CLIENTE SELECCIONADO ES EL ACTUAL PROPIETARIO DEL DEL INMUEBLE<br>".
                       "LOS PROPIETARIOS NO TOMAN EN ARRIENDO SUS PROPIEDADES!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $info = "CESION DE CONTRATO EXITOSA";
                $msg = "LA CESION DE CONTRATO FUE REALIZADA EXITOSAMENTE!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::NO_CONNECTED:
                $info = "ERROR DE CONEXION";
                $msg = "ERROR AL CONECTAR CON LA BASE DE DATOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            default:
                $info = "ERORR DE INSERCION";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }


    public function ejecutarMostrarCambiosContrato()
    {
        $res=$this->control->srvObtenerVistaCambiosContrato($datos, $num);
        switch ($res)
        {
            case CodRes::SIN_REGISTROS:
                $info = "SIN REGISTROS";
                $msg = "NO SE ENCONTRARON CAMBIOS EN INMUEBLES!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $this->genHtml->imprimirVistaCambiosContrato($datos, $num);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }


    public function ejecutarCrearDevolverInmueble()
    {
        $res = CodRes::SIN_REGISTROS;
        $res=$this->control->srvObtenerContratosPorTipo($ids,$nom, $cant, "2");
        switch ($res)
        {
            case CodRes::NO_CONNECTED:
                $info = "ERROR DE CONEXION I";
                $msg = "ERROR AL CONECTAR CON LA BASE DE DATOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::SIN_REGISTROS:
                $info = "NO HAY INMUEBLES EN ARRIENDO";
                $msg = "FAVOR CREAR UN CONTRATO DE ARRENDAMIENTO! <br><a href='../forms/contrato.php'>Haga click aqui para crear uno</a>";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $this->genHtml->imprimirMostrarFormularioDevolverInmueble($ids, $nom, $cant);
                break;
            default:
                header('Location: ../index.php?msg=unknown');
        }

    }
    
    
    public function ejecutarProcesarDevolverInmueble($num_con, $inm_mat)
    {
        $res = CodRes::DATOS_INVALIDOS;
        $msg = "";
        $info = "";
        $res=$this->control->srvProcesarDevolverInmueble($num_con, $inm_mat);
        switch ($res)
        {
            case CodRes::DATOS_VACIOS:
                $info = "DATOS VACIOS";
                $msg= "Debe completar todos los campos solicitados";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::DATOS_INVALIDOS:
                $info = "DATOS INVALIDOS";
                $msg= "LA INFORMACION INGRESADA ES INVALIDA, FAVOR INTENTE DE NUEVO";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::LONGITUD_INVALIDA:
                $info = "LONGITUD DE CAMPOS INVALIDA";
                $msg  = "Maximo de Caracteres por Campo<br>".
                        "Valor Contrato: 8<br>";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::CONTRATO_INEXISTENTE:
                $info = "ERROR EL CONTRATO NO EXISTE";
                $msg = "EL CONTRATO NO EXISTE EN EL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::INMUEBLE_INEXISTENTE:
                $info = "ERROR EL INMUEBLE NO EXISTE";
                $msg = "EL INMUEBLE NO EXISTE EN EL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $info = "DEVOLUCION DE INMUEBLE EXITOSA";
                $msg = "LA DEVOLUCION DE INMUEBLE FUE REALIZADA EXITOSAMENTE!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::NO_CONNECTED:
                $info = "ERROR DE CONEXION";
                $msg = "ERROR AL CONECTAR CON LA BASE DE DATOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            default:
                $info = "ERORR DE INSERCION";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }

    public function  ejecutarMostrarCrearPagos()
    {
        $res = CodRes::SIN_REGISTROS;
        $res=$this->control->srvObtenerContratosParaPagos($ids,$nom, $cant, $ids_cli,$vals_con, $tips_con);
        switch ($res)
        {
            case CodRes::NO_CONNECTED:
                $info = "ERROR DE CONEXION I";
                $msg = "ERROR AL CONECTAR CON LA BASE DE DATOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::SIN_REGISTROS:
                $info = "NO HAY CONTRATOS VIGENTES";
                $msg = "FAVOR ADICIONE CONTRATOS! <br><a href='../forms/contrato.php'>Haga click aqui para crear uno</a>";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                    $this->control->srvObtenerConsecutivoPago($numP);
                    $this->genHtml->imprimirMostrarFormularioPago($ids, $nom, $cant, $numP,$ids_cli, $vals_con, $tips_con);
                    break;
            default:
                header('Location: ../index.php?msg=unknown');
        }

    }

    public function ejecutarMostrarFacturaHTML()
    {
        $res = CodRes::SIN_REGISTROS;
        $res=$this->control->srvObtenerContratosParaPagos($ids,$nom, $cant, $ids_cli,$vals_con, $tips_con);
        switch ($res)
        {
            case CodRes::NO_CONNECTED:
                $info = "ERROR DE CONEXION I";
                $msg = "ERROR AL CONECTAR CON LA BASE DE DATOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::SIN_REGISTROS:
                $info = "NO HAY CONTRATOS VIGENTES";
                $msg = "FAVOR ADICIONE CONTRATOS! <br><a href='../forms/contrato.php'>Haga click aqui para crear uno</a>";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                    $this->control->srvObtenerConsecutivoPago($numP);
                    $this->genHtml->imprimirMostrarFacturaHTML($ids, $nom, $cant, $numP,$ids_cli, $vals_con, $tips_con);
                    break;
            default:
                header('Location: ../index.php?msg=unknown');
        }
    }

    public function ejecutarMostrarPagos()
    {
        $res=$this->control->srvObtenerVistaPagos($datos, $num);
        switch ($res)
        {
            case CodRes::SIN_REGISTROS:
                $info = "SIN REGISTROS";
                $msg = "NO SE ENCONTRARON PAGOS REGISTRADOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $this->genHtml->imprimirVistaPagos($datos, $num);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
    }

    public function ejecutarObtenerInformacionPago($num_con, $id_cli)
    {
        $res = CodRes::UNKNOWN;
        $res=$this->control->srvObtenerInformacionPago($num_con,$id_cli, $nom_cli, $num_cuotas);
        switch ($res)
        {
            case CodRes::EXITO:
                $this->genHtml->imprimirTablaConsultaPagos($nom_cli, $num_cuotas, 1);
                break;
            case CodRes::UNKNOWN:
                $this->genHtml->imprimirTablaConsultaPagos($nom_cli, $num_cuotas, 0);
                break;
            default:
                header('Location: ../index.php?msg=unknown');
        }
    }

    public function ejecutarProcesarContenidoFactura($tip_pago, $val_pago, $num_cuo_pago,
                                                    $desc_pago, $num_con, $cli_ide, $num_pago, $fec_pago,$nom_cli,$base, $iva,$num_matricula)
    {
        $datos="";
        $res=$this->control->srvProcesarContenidoFactura($tip_pago, $val_pago, $num_cuo_pago,
                                                    $desc_pago, $num_con, $cli_ide, $num_pago, $fec_pago,$nom_cli,$base,$iva,$num_matricula,
                                                        $datos);

        switch ($res)
        {
            case CodRes::DATOS_VACIOS:
                $info = "ERROR AL EXTRAER DATOS1";
                $msg = "ERROR AL EXTRAER LOS DATOS CONSULTE AL ADMINISTRADOR!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::DATOS_INVALIDOS:
                $info = "ERROR AL EXTRAER DATOS2";
                $msg = "ERROR AL EXTRAER LOS DATOS CONSULTE AL ADMINISTRADOR!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::CLIENTE_INEXISTENTE:
                $info = "ERROR AL EXTRAER DATOS3";
                $msg = "ERROR AL EXTRAER LOS DATOS CONSULTE AL ADMINISTRADOR!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::CONTRATO_INEXISTENTE:
                $info = "ERROR AL EXTRAER DATOS4";
                $msg = "ERROR AL EXTRAER LOS DATOS CONSULTE AL ADMINISTRADOR!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                if($this->genPdf == NULL)
                {
                    $info = "GENERADOR PDF NULL";
                    $msg = "ERROR AL CREAR PDF CONSULTE AL ADMINISTRADOR!";
                    $this->genHtml->imprimirResultado($info, $msg);
                }
                else
                    $this->genPdf->imprimirFactura(explode(";"," ; ; ; ; "),$datos);
                break;
            case CodRes::UNKNOWN:
                $info = "ERROR AL EXTRAER DATOS5";
                $msg = "ERROR AL EXTRAER LOS DATOS CONSULTE AL ADMINISTRADOR!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            default:
                header('Location: ../index.php?msg=unknown');
        }

    }

    public function ejecutarProcesarCrearFactura($varTip,
                                                 $val_pago,
                                                 $cuota_pago,
                                                 $desc_pago,
                                                 $num_con,
                                                 $cli_ide)
    {
        $datos="";
        $res=$this->control->srvProcesarFactura($varTip,
                                                 $val_pago,
                                                 $cuota_pago,
                                                 $desc_pago,
                                                 $num_con,
                                                 $cli_ide);

        switch ($res)
        {
            case CodRes::DATOS_VACIOS:
                $info = "DATOS VACIOS";
                $msg = "ERROR DE DATOS CONSULTE AL ADMINISTRADOR!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::DATOS_INVALIDOS:
                $info = "DATOS INVALIDOS";
                $msg = "ERROR DE DATOS CONSULTE AL ADMINISTRADOR!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::CLIENTE_INEXISTENTE:
                $info = "CLIENTE INEXISTENTE";
                $msg = "ERROR DE DATOS CONSULTE AL ADMINISTRADOR!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::CONTRATO_INEXISTENTE:
                $info = "EL CONTRATO SELECCIONADO NO EXISTE";
                $msg = "ERROR DE DATOS CONSULTE AL ADMINISTRADOR!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::NO_CONNECTED:
                $info = "ERROR AL CONECTAR A LA BD";
                $msg = "ERROR AL CONECTAR CONSULTE AL ADMINISTRADOR!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $info = "PAGO REGISTRADO EXITOSAMENTE";
                $msg = "EL PAGO FUE REGISTRADO EXITOSAMENTE!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::UNKNOWN:
                $info = "ERROR DE INSERCION";
                $msg = "ERROR DE INSERCION DE DATOS CONSULTE AL ADMINISTRADOR!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            default:
                header('Location: ../index.php?msg=unknown');

        }
    }

    public function ejecutarMostrarFormularioInmuebleM($idInmueble)
    {
        $res = "";
        $datos=null;
        $res = $this->control->srvObtenerDatosInmuebleModificacion($idInmueble,$datos);
        $this->genHtml->imprimirMostrarFormularioInmuebleM($datos);
    }

    public function ejecutarMostrarFormularioClienteM($idCliente)
    {
        $res = "";
        $datos=null;
        $res = $this->control->srvObtenerDatosClienteModificacion($idCliente, $datos);
        switch ($res)
        {
            case CodRes::DATOS_VACIOS:
                $info = "DATOS VACIOS";
                $msg = "ERROR DE DATOS CONSULTE AL ADMINISTRADOR!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::CLIENTE_INEXISTENTE:
                $info = "CLIENTE INEXISTENTE";
                $msg = "ERROR DE DATOS CONSULTE AL ADMINISTRADOR!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::NO_CONNECTED:
                $info = "ERROR AL CONECTAR A LA BD";
                $msg = "ERROR AL CONECTAR CONSULTE AL ADMINISTRADOR!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $this->genHtml->imprimirMostrarFormularioClienteM($datos);
                break;
            case CodRes::UNKNOWN:
                $info = "ERROR DE INSERCION";
                $msg = "ERROR DE INSERCION DE DATOS CONSULTE AL ADMINISTRADOR!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            default:
                header('Location: ../index.php?msg=unknown');
        }
    }
    public function ejecutarMostrarFormularioClienteJM($idCliente)
    {
        $res = "";
        $datos=null;
        $res = $this->control->srvObtenerDatosClienteJModificacion($idCliente, $datos);
        switch ($res)
        {
            case CodRes::DATOS_VACIOS:
                $info = "DATOS VACIOS";
                $msg = "ERROR DE DATOS CONSULTE AL ADMINISTRADOR!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::CLIENTE_INEXISTENTE:
                $info = "EMRPESA INEXISTENTE";
                $msg = "ERROR DE DATOS CONSULTE AL ADMINISTRADOR!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::NO_CONNECTED:
                $info = "ERROR AL CONECTAR A LA BD";
                $msg = "ERROR AL CONECTAR CONSULTE AL ADMINISTRADOR!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $this->genHtml->imprimirMostrarFormularioClienteJM($datos);
                break;
            case CodRes::UNKNOWN:
                $info = "ERROR DE INSERCION";
                $msg = "ERROR DE INSERCION DE DATOS CONSULTE AL ADMINISTRADOR!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            default:
                header('Location: ../index.php?msg=unknown');
        }
    }
    public function ejecutarMostrarFormularioVendedorM($idVendedor)
    {
        $datos=null;
        $res = $this->control->srvObtenerDatosVendedorModificacion($idVendedor, $datos);
        switch ($res)
        {
            case CodRes::DATOS_VACIOS:
                $info = "DATOS VACIOS";
                $msg = "ERROR DE DATOS CONSULTE AL ADMINISTRADOR!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::CLIENTE_INEXISTENTE:
                $info = "VENDEDOR INEXISTENTE";
                $msg = "ERROR DE DATOS CONSULTE AL ADMINISTRADOR!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::NO_CONNECTED:
                $info = "ERROR AL CONECTAR A LA BD";
                $msg = "ERROR AL CONECTAR CONSULTE AL ADMINISTRADOR!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $this->control->srvObtenerComboSucursales($ids,$datos_suc, $num);
                $this->genHtml->imprimirMostrarFormularioVendedorM($ids,$datos_suc, $num, $datos);
                break;
            case CodRes::UNKNOWN:
                $info = "ERROR DE SELECCION";
                $msg = "ERROR DE DATOS CONSULTE AL ADMINISTRADOR!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            default:
                header('Location: ../index.php?msg=unknown');
        }
    }
     public function ejecutarProcesarInmuebleM($id, $imp, $adm, $desc)
     {
        $res=$this->control->srvProcesarInmuebleM($id, $imp, $adm, $desc);
        switch ($res)
        {
            case CodRes::DATOS_VACIOS:
                $info = "DATOS VACIOS";
                $msg= "Debe completar todos los campos solicitados";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::LONGITUD_INVALIDA:
                $info = "LONGITUD DE CAMPOS INVALIDA";
                $msg= "Maximo de Caracteres por Campo<br>".
                        "Val. Impuestos: 8<br>Val. Administración: 8".
                        "<br>Descripción: 255<br>";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::INMUEBLE_INEXISTENTE:
                $info = "INMUEBLE NO  EXISTE";
                $msg= "LOS DATOS INGRESADOS NO CORRESPONDEN A UN INMUEBLE<br>".
                "REGISTRADO EN EL SISTEMA.";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $info = "INMUEBLE ACTUALIZADO";
                $msg = "EL INMUEBLE FUE ACTUALIZADO EXITOSAMENTE!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::NO_CONNECTED:
                $info = "ERROR DE CONEXION";
                $msg = "ERROR AL CONECTAR CON LA BASE DE DATOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
     }

     public function ejecutarMostrarPagoArriendo()
     {
        $datos_clientes=null;
        $num_clientes=0;
        $res=$this->control->srvMostrarPagosArriendo($datos_clientes, $num_clientes);
        switch ($res)
        {
            case CodRes::SIN_REGISTROS:
                $info = "SIN REGISTROS";
                $msg = "NO SE ENCONTRARON CLIENTES REGISTRADOS!";
                $this->genHtml->imprimirResultado($info, $msg);
                break;
            case CodRes::EXITO:
                $this->genHtml->imprimirVistaReportePagosArriendo($datos_clientes, $num_clientes);
                break;
            default:
                $info = "ERORR DESCONOCIDO";
                $msg = "FAVOR CONSULTE AL ADMINISTRADOR DEL SISTEMA!";
                $this->genHtml->imprimirResultado($info, $msg);
        }
     }
}

?>
