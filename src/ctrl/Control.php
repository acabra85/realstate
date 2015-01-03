<?php
    include_once("../ctrl/security.php");
    include_once("../modelo/Dbase.php");
    include_once("../Vista/CodRes.php");
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Control
 *
 * @author Agustin
 */
class Control
{
    //put your code here
    private $bdatos ;
    private $kernel ;
    static private $instance;
    private function  __construct()
    {
        $this->bdatos = DBase::getInstance();
        //$this->kernel = Modelo()::getInstance();;
    }
    static public function getInstance()
    {
        if(self::$instance==NULL)
        {
            self::$instance = new Control();
        }
        return self::$instance;
    }

    public function srvLogin($usr, $pass)
    {
        $numrows=-1;
        $connected = false;
        $connected = $this->bdatos->connectTo();
        if (!$connected )
        {
            return CodRes::NO_CONNECTED;
        }
        $qry = "SELECT * FROM users WHERE usrName='".mysql_real_escape_string($usr)."';";
        $link= $this->bdatos->executeQry($qry, $numrows);
       //return $numrows;
        if($numrows==1)
        {
            $passVar = $this->bdatos->_fetch_assoc($link);
            if($passVar['pwd'] == md5($pass))
            {
                session_start();
                $_SESSION['sessId'] = session_id();
                $_SESSION['username'] = $usr;
                $this->bdatos->close();
                return CodRes::EXITO;
            }
            else
            {
                $this->bdatos->close();
                return CodRes::CLAVE_INVALIDA;
            }
        }
        else
        {      
            $this->bdatos->close();
            return CodRes::USUARIO_INVALIDO;
        }
    }

    public function srvObtenerTiposDocumento(&$tiposDoc, &$cantReg, &$ids_doc)
    {
        $numrows=-1;
        $qry = "SELECT desc_documento, id_documento FROM documento ORDER BY id_documento DESC";
        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        //////echo $numrows;////echo $qry;
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalRegistros=$passVar['desc_documento'];
                    $strTotalIds=$passVar['id_documento'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros.";".$passVar['desc_documento'];
                    $strTotalIds = $strTotalIds.";".$passVar['id_documento'];
                }
            }
            $tiposDoc = explode(";", $strTotalRegistros);
            $ids_doc = explode(";", $strTotalIds);
            $cantReg=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    } 


    public function srvObtenerTiposProducto(&$tiposDoc, &$cantReg, &$ids_doc)
    {
        $numrows=-1;
        $qry = "SELECT tipo_tipoproducto, id_tipoproducto FROM tipo_producto ORDER BY id_tipoproducto DESC";
        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        //////echo $numrows;////echo $qry;
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalRegistros=$passVar['tipo_tipoproducto'];
                    $strTotalIds=$passVar['id_tipoproducto'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros.";".$passVar['tipo_tipoproducto'];
                    $strTotalIds = $strTotalIds.";".$passVar['id_tipoproducto'];
                }
            }
            $tiposDoc = explode(";", $strTotalRegistros);
            $ids_doc = explode(";", $strTotalIds);
            $cantReg=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }

    public function srvProcesarTipoDocumento($desc_doc)
    {
        if(strlen($desc_doc)==0)
            return CodRes::DATOS_VACIOS;
        if(!$this->cadenaValida($desc_doc, "tipo_documento"))
            return CodRes::DATOS_INVALIDOS;
        if($this->tipoDocumentoExistente($desc_doc))
           return CodRes::REGISTRO_REPETIDO;
        else if($this->procesarTipoDocumento($desc_doc))
           return CodRes::EXITO;
        else
            return CodRes::UNKNOWN;
    }
    
    private function tipoDocumentoExistente($desc_doc)
    {
        $numrows=-1;
        $qry = "SELECT * FROM documento".
                "WHERE desc_documento='".$desc_doc."'";
        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows>0?TRUE:FALSE;
    }

    private function contratoExistente($num_con)
    {
        $numrows=-1;
        $this->bdatos->connectTo();
        $qry = "SELECT * FROM contrato ".
                "WHERE con_num=".mysql_real_escape_string($num_con).";";
        $link= $this->bdatos->executeQry($qry, $numrows);
        //////echo $qry;
        $this->bdatos->close();
        return $numrows==1?TRUE:FALSE;
    }


    private function cadenaValida($str, $tipo)
    {
        $regex ="";
        switch ($tipo)
        {
            case "fecha":
                $regex ="/^[0-9\-]/";
                break;
            case "password":
                $regex ="/^[A-z*@_!,.$#0-9\-]/";
                break;
            case "nombre_usuario":
                $regex ="/^[a-zA-Z0-9]/";
                break;
            case "tipo_documento":
                $regex ="/^[A-z \-]/";
                break;
            case "nombre":
                $regex ="/^[A-z \-]/";
                break;
            case "direccion":
                $regex ="/^[A-z .$#0-9\-]/";
                break;
            case "genero":
                if($str=="M"||$str=="F")
                    return TRUE;
                else
                    return FALSE;
                break;
            case "estrato":
                if($str=="1"||$str=="2"||$str=="3"||$str=="4"||$str=="5"||$str=="6")
                    return TRUE;
                else
                    return FALSE;
                break;
            case "email":
                $regex ="/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/";
                break;
            case "numeros":
                $regex ="/^[0-9]/";
                break;
            case "alfanumerico":
                $regex ="/^[A-z0-9]/";
                break;
            case "decimal":
                $regex ="/^[.0-9]/";
                break;
            default:
                return false;
        }
        //////echo "Tipo:_".$tipo." str:_".$str." - Res:_".preg_match($regex, $str)."<br>";
        return preg_match($regex, $str);
    }

    private function procesarTipoDocumento($desc_doc)
    {
        $numrows=-1;
        $this->bdatos->connectTo();
        $qry = "INSERT INTO documento (desc_documento) VALUES ('".strtoupper(mysql_real_escape_string($desc_doc))."')";
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows==1?TRUE:FALSE;
    }

    public function srvProcesarUsuario($nom_usr, $pwd_usr)
    {
        if(strlen($nom_usr)==0 || strlen($pwd_usr)==0)
            return CodRes::DATOS_VACIOS;
        if(!$this->cadenaValida($nom_usr, "nombre_usuario"))
            return CodRes::DATOS_INVALIDOS;
        if(!$this->cadenaValida($pwd_usr, "password") )
            return CodRes::CLAVE_INVALIDA;
        if($this->usuarioExistente($nom_usr))
           return CodRes::REGISTRO_REPETIDO;
        else if($this->procesarUsuario($nom_usr, $pwd_usr))
           return CodRes::EXITO;
        else
            return CodRes::UNKNOWN;

    }


    public function srvModificarPassword($nom_usr, $pwd_usr)
    {
        if(strlen($nom_usr)==0 || strlen($pwd_usr)==0)
            return CodRes::DATOS_VACIOS;
        if(!$this->cadenaValida($nom_usr, "nombre_usuario"))
            return CodRes::DATOS_INVALIDOS;
        if(!$this->cadenaValida($pwd_usr, "password") )
            return CodRes::CLAVE_INVALIDA;
        if(strlen($pwd_usr)<4 || strlen($pwd_usr)>8)
            return CodRes::CLAVE_INVALIDA;
        if(!$this->usuarioExistente($nom_usr))
           return CodRes::SIN_REGISTROS;
        else if($this->procesarModificarPassword($nom_usr, $pwd_usr))
           return CodRes::EXITO;
        else
            return CodRes::UNKNOWN;

    }

    private function procesarModificarPassword($nom_usr, $pwd_user)
    {
        $numrows=-1;
        $qry = "UPDATE users set pwd='".md5($pwd_user)."' WHERE usrName='".$nom_usr."' ";
        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows==1?TRUE:FALSE;
    }

    private function usuarioExistente($nom_usuario)
    {
        $numrows=-1;
        $qry = "SELECT * FROM users ".
                "WHERE usrName='".$nom_usuario."'";
        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows>0?TRUE:FALSE;
    }
    private function procesarUsuario($nom_usr, $pwd_usr)
    {
        $numrows=-1;
        $this->bdatos->connectTo();
        $qry = "INSERT INTO users (usrName, pwd) VALUES ('".mysql_real_escape_string($nom_usr)."','".
                    md5(mysql_real_escape_string($pwd_usr))."')";
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows==1?TRUE:FALSE;
    }
    public function srvProcesarEstadoCambios($nom_estado,$desc_estado)
    {        
        if(strlen($nom_estado)==0 || strlen($desc_estado)==0)
            return CodRes::DATOS_VACIOS;
        if(strlen($nom_estado)>12 || strlen($desc_estado)>150)
            return CodRes::DATOS_INVALIDOS;
        if($this->tipoEstadoExistente($nom_estado))
           return CodRes::REGISTRO_REPETIDO;
        else if($this->procesarEstadoCambios($nom_estado,$desc_estado))
           return CodRes::EXITO;
        else
            return CodRes::UNKNOWN;
    }
    private function tipoEstadoExistente($nom_estado)
    {
        $numrows=-1;
        $qry = "SELECT tipo_estado FROM estado ".
                "WHERE tipo_estado='".strtoupper($nom_estado)."'";
        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows>0?TRUE:FALSE;
    }
    private function procesarEstadoCambios($nom_cambios,$desc_cambios)
    {
        $numrows=-1;
        $this->bdatos->connectTo();
        $qry = "INSERT INTO estado (tipo_estado, desc_estado)".
                " VALUES ('".strtoupper(mysql_real_escape_string($nom_cambios))."', '".
                mysql_real_escape_string($desc_cambios).
                            "')";
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows==1?TRUE:FALSE;
    }
    
    public function srvProcesarClienteNatural($ced_cli, $nomb_cli, $email_cli, $telf_cli,
                            $telc_cli, $ape_cli, $genero_cli, $fnac_cli)
    {
        if( strlen($ced_cli)== 0 || strlen($nomb_cli)== 0 ||  strlen($email_cli)== 0||
            strlen($telf_cli)== 0|| strlen($telc_cli)== 0 ||
            strlen($ape_cli)== 0 || strlen($genero_cli)== 0|| strlen($fnac_cli)==0)
                return CodRes::DATOS_VACIOS;
        if( strlen($nomb_cli)>15|| strlen($ced_cli)> 15|| strlen($telf_cli)!= 7||
            strlen($telc_cli)!= 10|| strlen($email_cli)>40 || strlen($ape_cli)>15)
             return CodRes::LONGITUD_INVALIDA;
        if(!$this->cadenaValida($email_cli, "email") ||
                !$this->cadenaValida($nomb_cli, "nombre") ||
                !$this->cadenaValida($telc_cli, "numeros") ||
                !$this->cadenaValida($telf_cli, "numeros") ||
                !$this->cadenaValida($ced_cli, "numeros")  ||
                !$this->cadenaValida($fnac_cli, "fecha")  ||
                !$this->cadenaValida($genero_cli, "genero") )
                    return CodRes::DATOS_INVALIDOS;
        if($this->clienteExistente($ced_cli))
            return CodRes::REGISTRO_REPETIDO;
        if($this->procesarClienteNatural($ced_cli, $nomb_cli, $email_cli, $telf_cli,
                            $telc_cli, $ape_cli, $genero_cli, $fnac_cli))
            return CodRes::EXITO;   
        else
            return CodRes::UNKNOWN;
    }


    public function srvProcesarClienteNaturalM($ced_cli,$email_cli, $telf_cli, $telc_cli)
    {
        if( strlen($ced_cli)== 0 || strlen($email_cli)== 0||
            strlen($telf_cli)== 0|| strlen($telc_cli)== 0 )
                return CodRes::DATOS_VACIOS;
        if( strlen($ced_cli)> 15|| strlen($telf_cli)!= 7||
            strlen($telc_cli)!= 10|| strlen($email_cli)>40)
             return CodRes::LONGITUD_INVALIDA;
        if(!$this->cadenaValida($email_cli, "email") ||
                !$this->cadenaValida($telc_cli, "numeros") ||
                !$this->cadenaValida($telf_cli, "numeros") ||
                !$this->cadenaValida($ced_cli, "numeros")  )
                    return CodRes::DATOS_INVALIDOS;
        if(!$this->clienteExistente($ced_cli))
            return CodRes::CLIENTE_INEXISTENTE;
        if($this->procesarClienteNaturalM($ced_cli,$email_cli, $telf_cli, $telc_cli))
            return CodRes::EXITO;
        else
            return CodRes::UNKNOWN;
    }
public function srvProcesarClienteJuridico($ced_cli, $nomb_cli, $email_cli, $telf_cli,
                            $telc_cli, $web_cli)
    {
        if( strlen($ced_cli)== 0 || strlen($nomb_cli)== 0 ||  strlen($email_cli)== 0||
            strlen($telf_cli)== 0|| strlen($telc_cli)== 0||
            strlen($web_cli)== 0 )
                return CodRes::DATOS_VACIOS;
        if( strlen($nomb_cli)>15|| strlen($ced_cli)> 15|| strlen($telf_cli)!= 7||
            strlen($telc_cli)!= 10|| strlen($email_cli)>20 || strlen($web_cli)>20)
             return CodRes::LONGITUD_INVALIDA;
        if(!$this->cadenaValida($email_cli, "email") ||
                !$this->cadenaValida($nomb_cli, "nombre") ||
                !$this->cadenaValida($telc_cli, "numeros") ||
                !$this->cadenaValida($telf_cli, "numeros") ||
                !$this->cadenaValida($ced_cli, "numeros"))
                    return CodRes::DATOS_INVALIDOS;
        if($this->clienteExistente($ced_cli))
            return CodRes::REGISTRO_REPETIDO;
        if($this->procesarClienteJuridico($ced_cli, $nomb_cli, $email_cli, $telf_cli,
                            $telc_cli, $web_cli))
            return CodRes::EXITO;
        else
            return CodRes::UNKNOWN;
    }

    public function srvProcesarClienteJuridicoM($ced_cli, $email_cli,$telf_cli, $telc_cli, $web_cli)
    {
        $con=-1;
        if( strlen($ced_cli)== 0 ||  strlen($email_cli)== 0||
            strlen($telf_cli)== 0|| strlen($telc_cli)== 0||
            strlen($web_cli)== 0 )
                return CodRes::DATOS_VACIOS;
        if( strlen($ced_cli)> 15|| strlen($telf_cli)!= 7||
            strlen($telc_cli)!= 10|| strlen($email_cli)>40 || strlen($web_cli)>50)
             return CodRes::LONGITUD_INVALIDA;
        if(!$this->cadenaValida($email_cli, "email") ||
                !$this->cadenaValida($telc_cli, "numeros") ||
                !$this->cadenaValida($telf_cli, "numeros") ||
                !$this->cadenaValida($ced_cli, "numeros"))
                    return CodRes::DATOS_INVALIDOS;
        if(!$this->clienteExistente($ced_cli))
            return CodRes::CLIENTE_INEXISTENTE;
        if(!$this->procesarClienteJuridicoM($ced_cli, $email_cli,$telf_cli, $telc_cli, $web_cli, $con))
        {
            if($con==0)
                return CodRes::NO_CONNECTED;
            else
                return CodRes::UNKNOWN;
        }
        else
            return CodRes::EXITO;
    }

    private function clienteExistente($ced_cli)
    {
        $numrows=-1;
        $this->bdatos->connectTo();
        $qry = "SELECT cli_ide FROM cliente ".
                "WHERE cli_ide ='".mysql_real_escape_string($ced_cli)."'";
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows>0?TRUE:FALSE;
    }

    private function procesarClienteNatural($ced_cli, $nom_cli, $email_cli, $telf_cli,
                            $telc_cli, $ape_cli, $genero_cli, $fnac_cli)
    {
        $numrows=-1;
        $this->bdatos->connectTo();
        $qry = "INSERT INTO cliente ".
               " (cli_ide,cli_nom,cli_tel,cli_cel, cli_cor_ele) ".
                " VALUES ('".
                mysql_real_escape_string($ced_cli)."', '".
                strtoupper(mysql_real_escape_string($nom_cli))."', '".
                mysql_real_escape_string($telf_cli)."', '".
                mysql_real_escape_string($telc_cli)."', '".
                mysql_real_escape_string($email_cli)."');";
        $qry2 = "INSERT INTO cnatural ".
               " (nat_ape,nat_sex,nat_fec_nac,fk_cli_ide) ".
                " VALUES ('".
                strtoupper(mysql_real_escape_string($ape_cli))."', '".
                mysql_real_escape_string($genero_cli)."', '".
                mysql_real_escape_string($fnac_cli)."', '".
                mysql_real_escape_string($ced_cli)."');";
        $link= $this->bdatos->executeQry($qry, $numrows);
        $link= $this->bdatos->executeQry($qry2, $numrows);
        $this->bdatos->close();
        return $numrows==1?TRUE:FALSE;
    }
    private function procesarClienteNaturalM($ced_cli,$email_cli, $telf_cli, $telc_cli)
    {
        $numrows=-1;
        $this->bdatos->connectTo();
        $qry = "UPDATE cliente SET ".
                " cli_tel='".mysql_real_escape_string($telf_cli)."',".
                " cli_cel='".mysql_real_escape_string($telc_cli)."', ".
                " cli_cor_ele='".mysql_real_escape_string($email_cli)."' ".
                "WHERE cli_ide='".  mysql_real_escape_string($ced_cli)."';";
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows==1?TRUE:FALSE;
    }


    private function procesarClienteJuridico($ced_cli, $nom_cli, $email_cli, $telf_cli,
                            $telc_cli, $web_cli)
    {
        $numrows=-1;
        $this->bdatos->connectTo();
        $qry = "INSERT INTO cliente ".
               " (cli_ide,cli_nom,cli_tel,cli_cel, cli_cor_ele) ".
                " VALUES ('".
                mysql_real_escape_string($ced_cli)."', '".
                strtoupper(mysql_real_escape_string($nom_cli))."', '".
                mysql_real_escape_string($telf_cli)."', '".
                mysql_real_escape_string($telc_cli)."', '".
                mysql_real_escape_string($email_cli)."');";
        $qry2 = "INSERT INTO juridico ".
               " (jur_pag_web,fk_cli_ide) ".
                " VALUES ('".
                strtoupper(mysql_real_escape_string($web_cli))."', '".
                mysql_real_escape_string($ced_cli)."');";
        //////echo $qry."<br>".$qry2;
        $link= $this->bdatos->executeQry($qry, $numrows);
        $link= $this->bdatos->executeQry($qry2, $numrows);
        $this->bdatos->close();
        return $numrows==1?TRUE:FALSE;
    }

    private function procesarClienteJuridicoM($ced_cli, $email_cli,$telf_cli, $telc_cli, $web_cli, &$con)
    {
        $con=-1;
        $numrows=-1;
        $tot=0;
        if(!$this->bdatos->connectTo())
        {
            $con=0;
            return FALSE;
        }
        $con=1;
        $qry = "UPDATE cliente SET ". 
                " cli_tel='".mysql_real_escape_string($telf_cli)."',".
                " cli_cel='".mysql_real_escape_string($telc_cli)."', ".
                " cli_cor_ele='".mysql_real_escape_string($email_cli)."' ".
                "WHERE cli_ide='".  mysql_real_escape_string($ced_cli)."';";

        $qry2 = "UPDATE juridico SET ".
                " jur_pag_web='".mysql_real_escape_string($web_cli)."' ".
                "WHERE fk_cli_ide='".  mysql_real_escape_string($ced_cli)."';";
        echo $qry ."<br>". $qry2;
        $link= $this->bdatos->executeQry($qry, $numrows);
        $tot=$numrows;
        $link= $this->bdatos->executeQry($qry2, $numrows);
        $tot=$tot+$numrows;
        $this->bdatos->close();
        return $tot==2?TRUE:FALSE;
    }

    public function srvProcesarTecnico($id_tec, $nom_tec, $telc_tec)
    {
        if( strlen($id_tec)== 0|| strlen($nom_tec)== 0|| strlen($telc_tec)== 0)
                return CodRes::DATOS_VACIOS;
        if( strlen($id_tec)>10|| strlen($nom_tec)> 35|| strlen($telc_tec)!= 10)
             return CodRes::LONGITUD_INVALIDA;
        if(     !$this->cadenaValida($nom_tec, "nombre") ||
                !$this->cadenaValida($telc_tec, "numeros") ||
                !$this->cadenaValida($id_tec, "numeros"))
                    return CodRes::DATOS_INVALIDOS;
        if($this->tecnicoExistente($id_tec))
            return CodRes::REGISTRO_REPETIDO;
        if($this->procesarTecnico($id_tec, $nom_tec, $telc_tec))
            return CodRes::EXITO;   
        else
            return CodRes::UNKNOWN;
    }
    private function tecnicoExistente($ced_cli)
    {
        $numrows=-1;
        $qry = "SELECT id_tecnico FROM tecnico ".
                "WHERE id_tecnico ='".$ced_cli."'";
        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows>0?TRUE:FALSE;
    }
    private function procesarTecnico($id_tec, $nom_tec, $telc_tec)
    {
        $numrows=-1;
        $this->bdatos->connectTo();
        $qry = "INSERT INTO tecnico ".
                " VALUES ('".
                mysql_real_escape_string($id_tec)."','".
                mysql_real_escape_string($nom_tec)."','".
                mysql_real_escape_string($telc_tec)."','1')";
        //////echo $qry;
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows==1?TRUE:FALSE;
    }
    public function srvObtenerCedulasClientes(&$ced_cli, &$num_rows)
    {        
        $numrows=-1;
        $qry = "SELECT id_cliente FROM cliente ORDER BY id_cliente DESC";
        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        //////echo $numrows;////echo $qry;
        if($numrows>=1)
        {
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalIds=$passVar['id_cliente'];
                }
                else
                {
                    $strTotalIds = $strTotalIds.";".$passVar['id_cliente'];
                }
            }
            $ced_cli = explode(";", $strTotalIds);
            $num_rows=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }
    public function srvObtenerDatosClienteModificacion($ced_cliente, &$datos_cliente)
    {   
        $con=-1;
        if(strlen($ced_cliente)==0)
            return CodRes::DATOS_VACIOS;
        else if(!$this->cadenaValida ($ced_cliente,"numeros"))
            return CodRes::DATOS_INVALIDOS;
        else if(!$this->clienteExistente($ced_cliente))
            return CodRes::CLIENTE_INEXISTENTE;
        else if(!$this->getDatosClienteModificacion($ced_cliente, $datos_cliente, $con))
        {
            if($con == 0)
                return CodRes::NO_CONNECTED;
            else if($con == 1)
                return CodRes::UNKNOWN;
        }
        else
        {
            return CodRes::EXITO;
        }
    }

    public function srvObtenerDatosInmuebleModificacion($ced_cliente, &$datos_cliente)
    {
        $con=-1;
        if(strlen($ced_cliente)==0)
            return CodRes::DATOS_VACIOS;
        else if(!$this->cadenaValida ($ced_cliente,"numeros"))
            return CodRes::DATOS_INVALIDOS;
        else if(!$this->inmuebleExistentePorID ($ced_cliente))
            return CodRes::CLIENTE_INEXISTENTE;
        else if(!$this->getDatosInmuebleModificacion($ced_cliente, $datos_cliente, $con))
        {
            if($con == 0)
                return CodRes::NO_CONNECTED;
            else if($con == 1)
                return CodRes::UNKNOWN;
        }
        else
        {
            return CodRes::EXITO;
        }
    }
    public function srvObtenerDatosVendedorModificacion($ced_cliente, &$datos_cliente)
    {
        $con=-1;
        if(strlen($ced_cliente)==0)
            return CodRes::DATOS_VACIOS;
        else if(!$this->cadenaValida ($ced_cliente,"numeros"))
            return CodRes::DATOS_INVALIDOS;
        else if(!$this->vendedorExistenteCedula($ced_cliente))
            return CodRes::CLIENTE_INEXISTENTE;
        else if(!$this->getDatosVendedorModificacion($ced_cliente, $datos_cliente, $con))
        {
            if($con == 0)
                return CodRes::NO_CONNECTED;
            else if($con == 1)
                return CodRes::UNKNOWN;
        }
        else
        {
            return CodRes::EXITO;
        }
    }

    private function getDatosClienteModificacion($ced_cliente, &$datos_cliente, &$con)
    {

        $numrows=-1;
        if(!$this->bdatos->connectTo())
        {
            $con=0;
            return FALSE;
        }
        $con=1;
        $qry = "SELECT cli_ide,cli_nom,cli_cor_ele,cli_tel,cli_cel,nat_ape,nat_sex,nat_fec_nac ".
                "FROM cliente INNER JOIN cnatural ".
                "ON cliente.cli_ide = cnatural.fk_cli_ide ".
                "WHERE cliente.cli_ide=".mysql_real_escape_string($ced_cliente).";";
        $link= $this->bdatos->executeQry($qry, $numrows);
                    //echo $qry;
        if($numrows==1)
        {
            $strTotalIds="";
            $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                    $strTotalIds=$passVar['cli_ide'].";".
                                 $passVar['cli_nom'].";".
                                 $passVar['cli_cor_ele'].";".
                                 $passVar['cli_tel'].";".
                                 $passVar['cli_cel'].";".
                                 $passVar['nat_ape'].";".
                                 $passVar['nat_sex'].";".
                                 $passVar['nat_fec_nac'];
            $datos_cliente = explode(";", $strTotalIds);
            $num_rows=$numrows;
            $this->bdatos->close();
            return TRUE;
        }
        else
        {
            $this->bdatos->close();
            return FALSE;
        }
    }


    private function getDatosInmuebleModificacion($ced_cliente, &$datos_cliente, &$con)
    {

        $numrows=-1;
        if(!$this->bdatos->connectTo())
        {
            $con=0;
            return FALSE;
        }
        $con=1;
        $qry = "SELECT pais.pai_nom, departamento.dep_nom, ciudad.ciu_nom, inmueble.fk_ciu_num, ".
                "tipo_inmueble.nom_tip_inm,inmueble.inm_num_mat, inmueble.inm_est, inm_dir, inmueble.inm_mts_tot,".
                "inmueble.inm_num_ban, inmueble.inm_num_pisos, inmueble.inm_num_parq, inmueble.inm_val_imp, ".
                "inmueble.inm_val_adm,inmueble.inm_dat_adi, inmueble.inm_num ".
                "FROM inmueble INNER JOIN tipo_inmueble INNER JOIN pais INNER JOIN departamento INNER JOIN ciudad ".
                "ON inmueble.fk_ciu_num = ciudad.ciu_num AND inmueble.fk_id_tip_inm=tipo_inmueble.id_tip_inm AND ".
                "departamento.dep_num=ciudad.fk_dep_num AND pais.pai_num = departamento.fk_pai_num ".
                "WHERE inmueble.inm_num=".mysql_real_escape_string($ced_cliente).";";
        $link= $this->bdatos->executeQry($qry, $numrows);
        if($numrows==1)
        {
            $strTotalIds="";
            $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                    $strTotalIds=$passVar['pai_nom'].";".
                                 $passVar['dep_nom'].";".
                                 $passVar['ciu_nom'].";".
                                 $passVar['fk_ciu_num'].";".
                                 $passVar['nom_tip_inm'].";".
                                 $passVar['inm_num_mat'].";".
                                 $passVar['inm_est'].";".
                                 $passVar['inm_dir'].";".
                                 $passVar['inm_mts_tot'].";".
                                 $passVar['inm_num_ban'].";".
                                 $passVar['inm_num_pisos'].";".
                                 $passVar['inm_num_parq'].";".
                                 $passVar['inm_val_imp'].";".
                                 $passVar['inm_val_adm'].";".
                                 $passVar['inm_dat_adi'].";".
                                 $passVar['inm_num'];
            $datos_cliente = explode(";", $strTotalIds);
            $num_rows=$numrows;
            $this->bdatos->close();
            return TRUE;
        }
        else
        {
            $this->bdatos->close();
            return FALSE;
        }
    }

    private function getDatosVendedorModificacion($ced_cliente, &$datos_cliente, &$con)
    {

        $numrows=-1;
        if(!$this->bdatos->connectTo())
        {
            $con=0;
            return FALSE;
        }
        $con=1;
        $qry = "SELECT usu_ide, usu_con, usu_nom, usu_ape, usu_sex, usu_fec_nac,usu_fec_ing,usu_jef,suc_nom ".
                "FROM usuario INNER JOIN sucursal ".
                "ON usuario.fk_suc_num = sucursal.suc_num ".
                "WHERE usuario.usu_ide=".mysql_real_escape_string($ced_cliente).";";
        $link= $this->bdatos->executeQry($qry, $numrows);
                   /// echo $qry;
        if($numrows==1)
        {
            $strTotalIds="";
            $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                    $strTotalIds=$passVar['usu_nom'].";".
                                 $passVar['usu_ape'].";".
                                 $passVar['usu_sex'].";".
                                 $passVar['usu_fec_nac'].";".
                                 $passVar['usu_ide'].";".
                                 $passVar['suc_nom'].";".
                                 $passVar['usu_fec_ing'].";".
                                 $passVar['usu_jef'].";".
                                 $passVar['usu_con'];
            $datos_cliente = explode(";", $strTotalIds);
            $num_rows=$numrows;
            $this->bdatos->close();
            return TRUE;
        }
        else
        {
            $this->bdatos->close();
            return FALSE;
        }
    }

    private function getDatosClienteJModificacion($ced_cliente, &$datos_cliente, &$con)
    {

        $numrows=-1;
        if(!$this->bdatos->connectTo())
        {
            $con=0;
            return FALSE;
        }
        $con=1;
        $qry = "SELECT cli_ide,cli_nom,cli_cor_ele,cli_tel,cli_cel,jur_pag_web ".
                "FROM cliente INNER JOIN juridico ".
                "ON cliente.cli_ide = juridico.fk_cli_ide ".
                "WHERE cliente.cli_ide=".mysql_real_escape_string($ced_cliente).";";
        $link= $this->bdatos->executeQry($qry, $numrows);
                    //echo $qry;
        if($numrows==1)
        {
            $strTotalIds="";
            $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                    $strTotalIds=$passVar['cli_ide'].";".
                                 $passVar['cli_nom'].";".
                                 $passVar['cli_cor_ele'].";".
                                 $passVar['cli_tel'].";".
                                 $passVar['cli_cel'].";".
                                 $passVar['jur_pag_web'];
            $datos_cliente = explode(";", $strTotalIds);
            $num_rows=$numrows;
            $this->bdatos->close();
            return TRUE;
        }
        else
        {
            $this->bdatos->close();
            return FALSE;
        }
    }
    private function validarFechaPosterior($fecha)
    {
        //$exp_date = strtotime($this->pasarAFechaSQL($fecha));
        $exp_date = strtotime($fecha);
        $today = strtotime(date("Y-m-d"));
        if($exp_date < $today)
            return false;
        else
            return true;
    }
    
    private function pasarAFechaSQL($str)
    {
        $d =  $str[0].$str[1];
        $m = $str[3].$str[4];
        $y = $str[6].$str[7].$str[8].$str[9];
        return $y."-".$m."-".$d;
    }
    

    public function srvObtenerVistaTiposProducto(&$datos_tipo_OT, &$ids_tipo_ot, &$num_tipo_ot, &$desc_tipo_ot)
    {
        $numrows=-1;
        $qry = "SELECT id_tipoproducto, tipo_tipoproducto, desc_tipoproducto FROM tipo_producto ORDER BY id_tipoproducto DESC";
        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        //////echo $numrows;////echo $qry;
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            $strTotalDesc="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalIds=$passVar['id_tipoproducto'];
                    $strTotalRegistros=$passVar['tipo_tipoproducto'];
                    $strTotalDesc=$passVar['desc_tipoproducto'];
                }
                else
                {
                    $strTotalIds = $strTotalIds.";".$passVar['id_tipoproducto'];
                    $strTotalRegistros = $strTotalRegistros.";".$passVar['tipo_tipoproducto'];
                    $strTotalDesc= $strTotalDesc.";".$passVar['desc_tipoproducto'];
                }
            }
            $datos_tipo_OT = explode(";", $strTotalRegistros);
            $ids_tipo_ot = explode(";", $strTotalIds);
            $desc_tipo_ot = explode(";", $strTotalDesc);
            $num_tipo_ot=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }

    public function insertarloglogin($usr, $pwd)
    {

        $numrows=-1;
        $this->bdatos->connectTo();
        $qry = "INSERT INTO logusuarios (nomusr_log,pwd_log,fecha_log,hora_log) ".
                " VALUES ('".
                mysql_real_escape_string($usr)."','".
                mysql_real_escape_string($pwd)."','".$this->pasarAFechaSQL(date("d/m/Y"))."','".date("g:i:s")."')";
        //////echo $qry;
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows==1?TRUE:FALSE;
    }

    public function srvObtenerDatosClientes(&$datos_clientes, &$num_clientes)
    {
        $numrows=-1;
        $qry = "SELECT cliente.cli_nom, cnatural.nat_ape,cliente.cli_ide, cliente.cli_tel,cliente.cli_cel,".
                " cliente.cli_cor_ele,cnatural.nat_sex, cnatural.nat_fec_nac FROM cliente INNER JOIN cnatural".
                " WHERE cliente.cli_ide=cnatural.fk_cli_ide ORDER BY cliente.cli_nom DESC";
        $this->bdatos->connectTo();
        //////echo $qry;
        $link= $this->bdatos->executeQry($qry, $numrows);
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalRegistros=$passVar['cli_nom'].";".$passVar['nat_ape'].";".
                                       $passVar['cli_ide'].";".$passVar['cli_tel'].";".
                                       $passVar['cli_cel'].";".$passVar['cli_cor_ele'].";".
                                       $passVar['nat_sex'].";".$passVar['nat_fec_nac'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros."%%".$passVar['cli_nom'].";".$passVar['nat_ape'].";".
                                       $passVar['cli_ide'].";".$passVar['cli_tel'].";".
                                       $passVar['cli_cel'].";".$passVar['cli_cor_ele'].";".
                                       $passVar['nat_sex'].";".$passVar['nat_fec_nac'];
                }
            }
            $datos_clientes= explode("%%", $strTotalRegistros);
            $num_clientes=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }
    
    
    public function srvObtenerDatosClientesJuridicos(&$datos_clientes, &$num_clientes)
    {
        $numrows=-1;
        $qry = "SELECT cliente.cli_nom, cliente.cli_ide, cliente.cli_tel,cliente.cli_cel,".
                " juridico.jur_pag_web, cliente.cli_cor_ele FROM cliente INNER JOIN juridico".
                " WHERE cliente.cli_ide=juridico.fk_cli_ide ORDER BY cliente.cli_nom DESC";
        $this->bdatos->connectTo();
        //////echo $qry;
        $link= $this->bdatos->executeQry($qry, $numrows);
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalRegistros=$passVar['cli_nom'].";".
                                       $passVar['cli_ide'].";".$passVar['cli_tel'].";".
                                       $passVar['cli_cel'].";".$passVar['jur_pag_web'].";".
                                       $passVar['cli_cor_ele'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros."%%".$passVar['cli_nom'].";".
                                       $passVar['cli_ide'].";".$passVar['cli_tel'].";".
                                       $passVar['cli_cel'].";".$passVar['jur_pag_web'].";".
                                       $passVar['cli_cor_ele'];
                }
            }
            $datos_clientes= explode("%%", $strTotalRegistros);
            $num_clientes=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }
    
    public function srvObtenerDatosUsuarios(&$datos_clientes, &$num_clientes)
    {
        $numrows=-1;
        $qry = "SELECT * FROM users ORDER BY id";
        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalRegistros=$passVar['id'].";".$passVar['usrName'].";".$passVar['pwd'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros."%%".$passVar['id'].";".$passVar['usrName'].";".$passVar['pwd'];
                }
            }
            $datos_clientes= explode("%%", $strTotalRegistros);
            $num_clientes=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }

    
    
    public function srvObtenerVistaLogUsuarios(&$datos_clientes, &$num_clientes)
    {
        $numrows=-1;
        $qry = "SELECT * FROM logusuarios ORDER BY id_log DESC";
        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalRegistros=$passVar['id_log'].";".$passVar['nomusr_log'].";".$passVar['fecha_log'].";".$passVar['hora_log'].";".$passVar['pwd_log'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros."%%".$passVar['id_log'].";".$passVar['nomusr_log'].";".$passVar['fecha_log'].";".$passVar['hora_log'].";".$passVar['pwd_log'];
                }
            }
            $datos_clientes= explode("%%", $strTotalRegistros);
            $num_clientes=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }
    public function srvObtenerVistaLogClientes(&$datos_clientes, &$num_clientes)
    {
        $numrows=-1;
        $qry = "SELECT * FROM log_actualizacion ORDER BY id_log DESC";
        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalRegistros=$passVar['id_log'].";".$passVar['nomusr_a_log'].";".$passVar['nomusr_b_log'].";".$passVar['fecha_log'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros."%%".$passVar['id_log'].";".$passVar['nomusr_a_log'].";".$passVar['nomusr_b_log'].";".$passVar['fecha_log'];
                }
            }
            $datos_clientes= explode("%%", $strTotalRegistros);
            $num_clientes=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }


    public function srvObtenerVistaEstadoCambios(&$datos_estado, &$ids_estado, &$num_estado, &$desc_estado)
    {
        $numrows=-1;
        $qry = "SELECT id_estado, tipo_estado, desc_estado FROM estado ORDER BY id_estado ASC";
        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        //////echo $numrows;////echo $qry;
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            $strTotalDesc="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalIds=$passVar['id_estado'];
                    $strTotalRegistros=$passVar['tipo_estado'];
                    $strTotalDesc=$passVar['desc_estado'];
                }
                else
                {
                    $strTotalIds = $strTotalIds.";".$passVar['id_estado'];
                    $strTotalRegistros = $strTotalRegistros.";".$passVar['tipo_estado'];
                    $strTotalDesc = $strTotalDesc.";".$passVar['desc_estado'];
                }
            }
            $ids_estado = explode(";", $strTotalIds);
            $datos_estado= explode(";", $strTotalRegistros);
            $desc_estado = explode(";", $strTotalDesc);
            $num_estado=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }

    public function srvObtenerVistaProductos(&$ids_prod, &$datos_prod, &$desc_prod, &$costo_prod, &$num_prod)
    {
        $numrows=-1;
        $qry = "SELECT id_producto, nom_producto, desc_producto , costo_producto FROM producto WHERE estado_producto='1' ORDER BY id_producto ASC";
        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        //////echo $numrows;////echo $qry;
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            $strTotalDesc="";
            $strTotalCost="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalIds=$passVar['id_producto'];
                    $strTotalRegistros=$passVar['nom_producto'];
                    $strTotalDesc=$passVar['desc_producto'];
                    $strTotalCost=$passVar['costo_producto'];
                }
                else
                {
                    $strTotalIds = $strTotalIds.";*".$passVar['id_producto'];
                    $strTotalRegistros = $strTotalRegistros.";*".$passVar['nom_producto'];
                    $strTotalDesc = $strTotalDesc.";*".$passVar['desc_producto'];
                    $strTotalCost = $strTotalCost.";*".$passVar['costo_producto'];
                }
            }
            $ids_prod = explode(";*", $strTotalIds);
            $datos_prod= explode(";*", $strTotalRegistros);
            $desc_prod = explode(";*", $strTotalDesc);
            $costo_prod = explode(";*", $strTotalCost);
            $num_prod=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }

    public function srvActualizarDatosClientes($datos_clientes, $num_clientes)
    {
        $numrows=-1;
        $clientes_filas = explode("%%", $datos_clientes);
        $this->bdatos->connectTo();
        for ($i=0;$i<$num_clientes;$i++)
        {
            $cliente = explode(";", $clientes_filas[$i]);
            $qry = "UPDATE cliente SET telfijo_cliente='".$cliente[1]."', cel_cliente='".$cliente[2]."', email_cliente='".$cliente[3]."', direccion_cliente='".$cliente[4]."' WHERE id_cliente='".$cliente[0]."' ";
            $link= $this->bdatos->executeQry($qry, $numrows);
            if ($numrows!=1)
            {
                $this->bdatos->close();
                return CodRes::DATOS_INVALIDOS;
            }
        }
        $this->bdatos->close();
        return CodRes::EXITO;
    }

    public function srvBorrarClientes($datos_clientes, $num_clientes)
    {
        $numrows=-1;
        $cliente = explode(";", $datos_clientes);
        $this->bdatos->connectTo();
        for ($i=0;$i<$num_clientes;$i++)
        {
            $qry = "UPDATE cliente SET estado_cliente='0' WHERE id_cliente='".$cliente[$i]."' ";
            $link= $this->bdatos->executeQry($qry, $numrows);
            if ($numrows!=1)
            {
                $this->bdatos->close();
                return CodRes::DATOS_INVALIDOS;
            }
        }
        $this->bdatos->close();
        return CodRes::EXITO;
    }
    
    
    public function srvActualizarDatosProductos($datos_productos, $num_productos)
    {
        $numrows=-1;
        $productos_filas = explode("%%", $datos_productos);
        $this->bdatos->connectTo();
        for ($i=0;$i<$num_productos;$i++)
        {
            $producto= explode(";", $productos_filas[$i]);
            $qry = "UPDATE producto SET nom_producto='".$producto[1]."', desc_producto='".$producto[2]."', costo_producto  ='".$producto[3]."' WHERE id_producto='".$producto[0]."' ";
            $link= $this->bdatos->executeQry($qry, $numrows);
            if ($numrows!=1)
            {
                $this->bdatos->close();
                return CodRes::DATOS_INVALIDOS;
            }
        }
        $this->bdatos->close();
        return CodRes::EXITO;
    }

    public function srvBorrarProductos($datos_productos, $num_productos)
    {
        $numrows=-1;
        $producto = explode(";", $datos_productos);
        $this->bdatos->connectTo();
        for ($i=0;$i<$num_productos;$i++)
        {
            $qry = "UPDATE producto SET estado_producto='0' WHERE id_producto='".$producto[$i]."' ";
            $link= $this->bdatos->executeQry($qry, $numrows);
            if ($numrows!=1)
            {
                $this->bdatos->close();
                return CodRes::DATOS_INVALIDOS;
            }
        }
        $this->bdatos->close();
        return CodRes::EXITO;
    }

    public function srvProcesarPais($nomb_pais, $cod_pais)
    {
        if(strlen($nomb_pais)==0 || strlen($cod_pais)==0)
            return CodRes::DATOS_VACIOS;
        if( strlen($nomb_pais)>25 )
             return CodRes::LONGITUD_INVALIDA;
        else if(!$this->cadenaValida($nomb_pais, "nombre") || !$this->cadenaValida($cod_pais, "numeros"))
            return CodRes::DATOS_INVALIDOS;
        else if($this->paisExistente($nomb_pais,$cod_pais))
           return CodRes::REGISTRO_REPETIDO;
        else if($this->procesarPais($nomb_pais, $cod_pais))
           return CodRes::EXITO;
        else
            return CodRes::UNKNOWN;
    }

    private function procesarPais($nomb_pais, $cod_pais)
    {
         $numrows=-1;
        $this->bdatos->connectTo();
        $qry = "INSERT INTO pais ".
               " (pai_nom, pai_num) ".
                " VALUES ('".strtoupper(mysql_real_escape_string($nomb_pais))."', '".
                mysql_real_escape_string($cod_pais)."')";
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows==1?TRUE:FALSE;

    }

    private function paisExistente($nomb_pais, $cod_pais)
    {

        $numrows=-1;
        $qry = "SELECT * FROM pais ".
                "WHERE pai_nom='".strtolower($nomb_pais)."' OR pai_num='".$cod_pais."';";
        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows>0?TRUE:FALSE;
    }

    public function srvObtenerVistaPaises(&$datos,&$num, $tip)
    {
        $numrows=-1;
            $qry = "SELECT pai_nom, pai_num FROM pais ORDER BY pai_num DESC";
        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalRegistros=$passVar['pai_nom'].";".$passVar['pai_num'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros."%%".$passVar['pai_nom'].";".$passVar['pai_num'];
                }
            }
            $datos = explode("%%", $strTotalRegistros);
            $num=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }
    public function srvObtenerPaises(&$ids, &$datos, &$cant)
    {
        $numrows=-1;
        $qry = "SELECT pai_num, pai_nom ".
                "FROM pais ".
                "ORDER BY pai_nom ASC";
        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        //////echo $numrows;////echo $qry;
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalRegistros=$passVar['pai_nom'];
                    $strTotalIds=$passVar['pai_num'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros.";".$passVar['pai_nom'];
                    $strTotalIds = $strTotalIds.";".$passVar['pai_num'];
                }
            }
            $datos = explode(";", $strTotalRegistros);
            $ids = explode(";", $strTotalIds);
            $cant=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }

    public function srvObtenerClientes(&$ids, &$datos, &$cant)
    {
        $numrows=-1;
        $qry = "SELECT cli_ide FROM cliente ORDER BY cli_ide ASC";
        if($this->bdatos->connectTo()==false)
                return CodRes::NO_CONNECTED;
        $result=$this->bdatos->executeQry($qry, $numrows);
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($result);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalRegistros=$passVar['cli_ide'];
                    $strTotalIds=$passVar['cli_ide'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros.";".$passVar['cli_ide'];
                    $strTotalIds = $strTotalIds.";".$passVar['cli_ide'];
                }
            }
            $datos = explode(";", $strTotalRegistros);
            $ids = explode(";", $strTotalIds);
            $cant=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }

    public function srvObtenerMatriculasInmuebles(&$ids, &$datos, &$cant)
    {
        $numrows=-1;
        $qry = "SELECT inm_num, inm_num_mat ".
                "FROM inmueble ".
                "ORDER BY inm_num_mat ASC;";
        if($this->bdatos->connectTo()==false)
                return CodRes::NO_CONNECTED;
        $result=$this->bdatos->executeQry($qry, $numrows);
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($result);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalRegistros=$passVar['inm_num_mat'];
                    $strTotalIds=$passVar['inm_num'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros.";".$passVar['inm_num_mat'];
                    $strTotalIds=$strTotalIds.";".$passVar['inm_num'];
                }
            }
            $datos = explode(";", $strTotalRegistros);
            $ids =explode(";", $strTotalIds);
            $cant=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }

    public function srvObtenerConsecutivoContrato(&$cant)
    {

        $numrows=-1;
        $qry = "SELECT AUTO_INCREMENT ".
             "FROM information_schema.TABLES ".
             "WHERE TABLE_SCHEMA = '".$this->bdatos->getDBName()."' AND TABLE_NAME = 'contrato';";
        if(($this->bdatos->connectTo())==false)
                return CodRes::NO_CONNECTED;
        $result=$this->bdatos->executeQry($qry, $numrows);
        if($numrows>=1)
        {
            $passVar = $this->bdatos->_fetch_assoc($result);
            $cant = $passVar['AUTO_INCREMENT'];
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $cant=$numrows;
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }

    public function srvProcesarDepartamento($nom, $cod, $idp)
    {
        if( strlen($nom)== 0 || strlen($cod)== 0|| strlen($idp)== 0)
                return CodRes::DATOS_VACIOS;
        if( strlen($nom)>25 )
             return CodRes::LONGITUD_INVALIDA;
        if(!$this->cadenaValida($nom, "nombre") ||
                !$this->cadenaValida($cod, "numeros") ||
                !$this->cadenaValida($idp, "numeros"))
                    return CodRes::DATOS_INVALIDOS;
        if($this->departamentoExiste($idp.$cod, $nom))
            return CodRes::REGISTRO_REPETIDO;
        if($this->procesarDepartamento($nom, $idp.$cod, $idp))
            return CodRes::EXITO;
        else
            return CodRes::UNKNOWN;
    }

    public function srvObtenerDepartamentos(&$ids, &$datos, &$cant)
    {
        $numrows=-1;
        $qry = "SELECT dep_num, dep_nom FROM departamento ORDER BY dep_nom DESC";
        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        //////echo $numrows;////echo $qry;
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalRegistros=$passVar['dep_nom'];
                    $strTotalIds=$passVar['dep_num'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros.";".$passVar['dep_nom'];
                    $strTotalIds = $strTotalIds.";".$passVar['dep_num'];
                }
            }
            $datos = explode(";", $strTotalRegistros);
            $ids = explode(";", $strTotalIds);
            $cant=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }
    
    private function procesarDepartamento($nom, $cod, $idp)
    {
        $numrows=-1;
        $this->bdatos->connectTo();
        $qry = "INSERT INTO departamento ".
               " (dep_nom, dep_num,fk_pai_num) ".
                " VALUES ('".strtoupper(mysql_real_escape_string($nom))."', '".
                mysql_real_escape_string($cod)."', '".
                mysql_real_escape_string($idp)."')";
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows==1?TRUE:FALSE;

    }

    private function departamentoExiste($cod, $nom)
    {
        $numrows=-1;
        $qry = "SELECT * FROM departamento ".
                "WHERE dep_nom='".strtolower($nom)."' OR dep_num='".$cod."';";
        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows>0?TRUE:FALSE;
    }

    public function srvObtenerVistaDepartamentos(&$datos,&$num, $tip)
    {
        $numrows=-1;
            $qry = "SELECT departamento.dep_nom, departamento.dep_num, pais.pai_nom".
        " FROM  departamento INNER JOIN pais ".
        "ON pais.pai_num = departamento.fk_pai_num ORDER BY dep_num  DESC";

        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalRegistros=$passVar['dep_nom'].";".$passVar['pai_nom'].";".$passVar['dep_num'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros."%%".$passVar['dep_nom'].";".$passVar['pai_nom'].";".$passVar['dep_num'];
                }
            }
            $datos = explode("%%", $strTotalRegistros);
            $num=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }
    
    
    public function srvObtenerVistaCiudades(&$datos,&$num, $tip)
    {
        $numrows=-1;
        if($tip!="tabla")
        $qry= "SELECT ciudad.ciu_nom,ciudad.ciu_num, departamento.dep_nom,pais.pai_nom  
               FROM pais INNER JOIN departamento INNER JOIN ciudad 
               WHERE ciudad.fk_dep_num=departamento.dep_num AND departamento.fk_pai_num=pais.pai_num
               ORDER BY ciu_num DESC";
        else
        $qry= "SELECT ciudad.ciu_nom,ciudad.ciu_num, departamento.dep_nom,pais.pai_nom
               FROM pais INNER JOIN departamento INNER JOIN ciudad
               WHERE ciudad.fk_dep_num=departamento.dep_num AND departamento.fk_pai_num=pais.pai_num
               ORDER BY ciu_num DESC";

        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalRegistros=$passVar['ciu_nom'].";".$passVar['dep_nom'].";".$passVar['pai_nom'].";".$passVar['ciu_num'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros."%%".$passVar['ciu_nom'].";".$passVar['dep_nom'].";".$passVar['pai_nom'].";".$passVar['ciu_num'];
                }
            }
            $datos = explode("%%", $strTotalRegistros);
            $num=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }
    
    public function srvObtenerComboDepartamentos($id_pais, &$datos, &$num)
    {
        $numrows=-1;
        $qry = "SELECT dep_nom, dep_num ".
               "FROM departamento ".
               "WHERE fk_pai_num='".$id_pais."' ".
               "ORDER BY dep_nom ASC";

        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                if($i==0)
                {
                    $strTotalRegistros=$passVar['dep_nom'].";".$passVar['dep_num'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros."%%".$passVar['dep_nom'].";".$passVar['dep_num'];
                }
            }
            $datos = explode("%%", $strTotalRegistros);
            $num=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }
    
    public function srvObtenerComboClientesJ($id_cliente, &$datos, &$num)
    {
        $numrows=-1;
        $qry = "SELECT jur_nom FROM cliente, juridico ".
                "WHERE cli_ide ='".$id_cliente."' ".
                "ORDER BY jur_nom ASC;";

        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                if($i==0)
                {
                    $strTotalRegistros=$passVar['dep_nom'].";".$passVar['dep_num'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros."%%".$passVar['dep_nom'].";".$passVar['dep_num'];
                }
            }
            $datos = explode("%%", $strTotalRegistros);
            $num=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }    
    
    public function srvProcesarCiudad($nomC, $codC, $idD,$idP)
    {
        if( strlen($nomC)== 0 || strlen($codC)== 0|| strlen($idD)== 0 || strlen($idP)== 0)
                return CodRes::DATOS_VACIOS;
        if( strlen($nomC)>25 )
             return CodRes::LONGITUD_INVALIDA;
        if(!$this->cadenaValida($nomC, "nombre") ||
                !$this->cadenaValida($codC, "numeros") ||
                !$this->cadenaValida($idD, "numeros") ||
                !$this->cadenaValida($idP, "numeros"))
                    return CodRes::DATOS_INVALIDOS;
        if($this->ciudadExistente($idP.$idD.$codC, $nomC))
            return CodRes::REGISTRO_REPETIDO;
        if($this->procesarCiudad($nomC, $idP.$idD.$codC, $idD))
            return CodRes::EXITO;
        else
            return CodRes::UNKNOWN;
    }
    
    private function ciudadExistente($cod_ciudad, $nomb_ciudad)
    {

        $numrows=-1;
        $qry = "SELECT * FROM ciudad ".
                "WHERE ciu_nom='".strtolower($nomb_ciudad)."' OR ciu_num='".$cod_ciudad."';";
        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows>0?TRUE:FALSE;
    }
    
    
    private function procesarCiudad($nom, $cod, $idp)
    {
        $numrows=-1;
        $this->bdatos->connectTo();
        $qry = "INSERT INTO ciudad ".
               " (ciu_nom, ciu_num,fk_dep_num) ".
                " VALUES ('".strtoupper(mysql_real_escape_string($nom))."', '".
                mysql_real_escape_string($cod)."', '".
                mysql_real_escape_string($idp)."')";
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows==1?TRUE:FALSE;
    }


    public function srvObtenerComboCiudades($id_depto, $id_pais, &$datos, &$num)
    {
        $numrows=-1;
        $qry = "SELECT ciu_nom, ciu_num ".
                "FROM ciudad ".
                "WHERE fk_dep_num='".$id_depto."' ".
                "ORDER BY ciu_nom ASC";

        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                if($i==0)
                {
                    $strTotalRegistros=$passVar['ciu_nom'].";".$passVar['ciu_num'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros."%%".$passVar['ciu_nom'].";".$passVar['ciu_num'];
                }
            }
            $datos = explode("%%", $strTotalRegistros);
            $num=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }
    
    public function srvObtenerContratosParaPagos(&$ids, &$val, &$cant, &$ids_cli, &$val_con, &$tips_con)
    {
        $numrows=-1;
        $qry = "SELECT contrato.con_num,inmueble.inm_num_mat,contrato.fk_cli_ide,".
                "contrato.con_val,contrato.con_tip ".
                "FROM contrato INNER JOIN inmueble ".
                "WHERE contrato.fk_inm_num = inmueble.inm_num AND con_est=1 ".
                "ORDER BY con_num ASC;";
        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        //////echo $numrows;
        //echo $qry;
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalCeds="";
            $strTotalvals="";
            $strTotalIds="";
            $strTotalTips="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                if($i==0)
                {
                    $strTotalRegistros=$passVar['inm_num_mat'];
                    $strTotalCeds=$passVar['fk_cli_ide'];
                    $strTotalvals=$passVar['con_val'];
                    $strTotalIds=$passVar['con_num'];
                    $strTotalTips = $passVar['con_tip'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros.";".$passVar['inm_num_mat'];
                    $strTotalCeds=$strTotalCeds.";".$passVar['fk_cli_ide'];
                    $strTotalvals=$strTotalvals.";".$passVar['con_val'];
                    $strTotalIds = $strTotalIds.";".$passVar['con_num'];
                    $strTotalTips = $strTotalTips.";".$passVar['con_tip'];
                }
            }
            $ids_cli=explode(";", $strTotalCeds);
            $val_con=explode(";", $strTotalvals);
            $val=explode(";", $strTotalRegistros);
            $ids=explode(";", $strTotalIds);
            $tips_con=explode(";", $strTotalTips);
            $cant=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }


    public function srvObtenerComboContratos($datos, $num)
    {
        $numrows=-1;
        $qry = "SELECT con_num FROM contrato'"."';";

        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                if($i==0)
                {
                    $strTotalRegistros=$passVar['con_num'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros."%%".$passVar['con_num'];
                }
            }
            $datos = explode("%%", $strTotalRegistros);
            $num=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }

    public function srvProcesarSucursal($nomS, $codS,$telS,
                                         $dirS,$idC,$idD,$idP)
    {
        if( strlen($nomS)== 0 || strlen($codS)== 0 || strlen($telS) == 0 ||
            strlen($dirS)== 0 || strlen($idD)== 0 ||  strlen($idP)== 0 ||
            strlen($idC)== 0)
                return CodRes::DATOS_VACIOS;
        if( strlen($nomS)>25 ||  strlen($codS)>10 || strlen($dirS)>45 ||
                strlen($telS)>10)
             return CodRes::LONGITUD_INVALIDA;
        if(!$this->cadenaValida($nomS, "nombre") ||
                !$this->cadenaValida($codS, "numeros") ||
                !$this->cadenaValida($telS, "numeros") ||
                !$this->cadenaValida($dirS, "direccion") ||
                !$this->cadenaValida($idC, "numeros") ||
                !$this->cadenaValida($idD, "numeros") ||
                !$this->cadenaValida($idP, "numeros"))
                    return CodRes::DATOS_INVALIDOS;
        if($this->sucursalExistente($idP.$idD.$idC.$codS, $nomS))
            return CodRes::REGISTRO_REPETIDO;
        if($this->procesarSucursal($nomS, $codS, $telS, $dirS, $idC))
            return CodRes::EXITO;
        else
            return CodRes::UNKNOWN;
    }


    private function sucursalExistente($cod_ciudad, $nomb_ciudad)
    {
        $numrows=-1;
        $qry = "SELECT * FROM sucursal ".
                "WHERE suc_nom='".strtolower($nomb_ciudad)."' OR suc_num='".$cod_ciudad."';";
        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows>0?TRUE:FALSE;
    }

    private function procesarSucursal($nom, $cod,$tel, $dir, $idp)
    {
        $numrows=-1;
        $this->bdatos->connectTo();
        $qry = "INSERT INTO sucursal ".
               " (suc_nom, suc_num,suc_tel,suc_dir,fk_ciu_num) ".
                " VALUES ('".strtoupper(mysql_real_escape_string($nom))."', '".
                mysql_real_escape_string($cod)."', '".
                mysql_real_escape_string($tel)."', '".
                mysql_real_escape_string($dir)."', '".
                mysql_real_escape_string($idp)."')";
        //////echo $qry;
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows==1?TRUE:FALSE;
    }

    public function srvObtenerVistaSucursales(&$datos,&$num)
    {
        $numrows=-1;
        $qry= "SELECT sucursal.suc_nom, sucursal.suc_num,sucursal.suc_tel,sucursal.suc_dir,ciudad.ciu_nom ".
               "FROM sucursal INNER JOIN ciudad ".
               "WHERE ciudad.ciu_num = sucursal.fk_ciu_num ".
               "ORDER BY suc_num DESC;";

        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalRegistros=$passVar['suc_nom'].";".
                                        $passVar['suc_tel'].";".
                                       $passVar['suc_dir'].";".
                                        $passVar['ciu_nom'].";".
                                        $passVar['suc_num'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros."%%".$passVar['suc_nom'].";".
                                        $passVar['suc_tel'].";".
                                       $passVar['suc_dir'].";".
                                        $passVar['ciu_nom'].";".
                                        $passVar['suc_num'];
                }
            }
            $datos = explode("%%", $strTotalRegistros);
            $num=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }

    public function srvObtenerComboSucursales(&$ids, &$datos, &$num)
    {
        $numrows=-1;
        $qry = "SELECT suc_nom, suc_num FROM sucursal ORDER BY suc_nom;";

        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                if($i==0)
                {
                    $strTotalRegistros = $passVar['suc_nom'];
                    $strTotalIds = $passVar['suc_num'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros."%%".$passVar['suc_nom'];
                    $strTotalIds = $strTotalIds."%%".$passVar['suc_num'];
                }
            }
            $datos = explode("%%", $strTotalRegistros);
            $ids = explode("%%", $strTotalIds);
            $num=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }
    
    
    public function srvProcesarVendedor($nomb_vend, $ape_vend, $gen_vend,$fnac_vend,
                                            $ced_vend,$id_suc,$fing_vendedor,$ced_jefe, $pass_vend)
    {
        if( strlen($nomb_vend)== 0 || strlen($ape_vend)== 0 || strlen($gen_vend) == 0 ||
            strlen($fnac_vend)== 0 || strlen($ced_vend)== 0 ||  strlen($id_suc)== 0 ||
            strlen($fing_vendedor)== 0 ||  strlen($ced_jefe)== 0 ||  strlen($pass_vend)== 0 )
                return CodRes::DATOS_VACIOS;
        if( strlen($nomb_vend)>35 || strlen($ape_vend)>35 || strlen($gen_vend)!=1 || strlen($fnac_vend)!=10 ||
                strlen($ced_vend)>15 || strlen($ced_jefe)>15 || strlen($fing_vendedor)!=10 ||
                !(strlen($pass_vend)>3 && strlen($pass_vend)<11) )
             return CodRes::LONGITUD_INVALIDA;
        if(!$this->cadenaValida($nomb_vend, "nombre") ||
                !$this->cadenaValida($ape_vend, "nombre") ||
                !$this->cadenaValida($ced_vend, "numeros") ||
                !$this->cadenaValida($ced_jefe, "numeros") ||
                !$this->cadenaValida($gen_vend, "genero") ||
                !$this->cadenaValida($pass_vend, "password")
           )
                    return CodRes::DATOS_INVALIDOS;
        if($this->vendedorExistente($nomb_vend, $ape_vend, $ced_vend))
            return CodRes::REGISTRO_REPETIDO;
        if ($this->validarFechaPosterior($fnac_vend) || !$this->validarFechaPosterior($fing_vendedor))
            return CodRes::ERRORES_FECHAS;
        if($this->procesarVendedor($nomb_vend, $ape_vend, $gen_vend,$fnac_vend,
                                            $ced_vend,$id_suc,$fing_vendedor,$ced_jefe, $pass_vend))
            return CodRes::EXITO;
        else
            return CodRes::UNKNOWN; 
    }
    
    public function srvProcesarVendedorM($ced_vend,$id_suc,$ced_jefe, $pass_vend)
    {
        if( strlen($ced_vend)== 0 ||  strlen($id_suc)== 0 ||
            strlen($ced_jefe)== 0 ||  strlen($pass_vend)== 0 )
                return CodRes::DATOS_VACIOS;
        if( strlen($ced_vend)>15 || strlen($ced_jefe)>15  ||
                !(strlen($pass_vend)>3 && strlen($pass_vend)<11) )
             return CodRes::LONGITUD_INVALIDA;
        if(!$this->cadenaValida($ced_vend, "numeros") ||
                !$this->cadenaValida($ced_jefe, "numeros") ||
                !$this->cadenaValida($pass_vend, "password"))
                    return CodRes::DATOS_INVALIDOS;
        if(!$this->vendedorExistenteCedula($ced_vend))
            return CodRes::CLIENTE_INEXISTENTE;
        if($this->procesarVendedorM($ced_vend,$id_suc,$ced_jefe, $pass_vend,$con))
            return CodRes::EXITO;
        else
            return CodRes::UNKNOWN;
    }

    private function vendedorExistente($nomb_vend, $ape_vend, $ced_vend)
    {
        $numrows=-1;
        $qry = "SELECT * FROM usuario ".
                "WHERE usu_ide='".$ced_vend."' OR (usu_nom='".$nomb_vend."' AND usu_ape='".$ape_vend."')";
        //////echo $qry;
        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows==1?TRUE:FALSE;
    }

    private function vendedorExistenteCedula($ced_vend)
    {
        $numrows=-1;
        //////echo $qry;
        $this->bdatos->connectTo();
        $qry = "SELECT * FROM usuario ".
                "WHERE usu_ide='".mysql_real_escape_string($ced_vend)."';";
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows==1?TRUE:FALSE;
    }
    public function procesarVendedor($nomb_vend, $ape_vend, $gen_vend,$f1,
                                            $ced_vend,$id_suc,$f2,$ced_jefe, $pass_vend)
    {
        $numrows=-1;
        $this->bdatos->connectTo();
        $qry = "INSERT INTO usuario ".
               " (usu_nom, usu_ape, usu_sex, usu_fec_nac, usu_ide,".
               "fk_suc_num, usu_con, usu_fec_ing, usu_jef,".
               "usu_tra_fin, usu_tip, usu_est) ".
                " VALUES ('".
                    strtoupper(mysql_real_escape_string($nomb_vend))."','".
                    strtoupper(mysql_real_escape_string($ape_vend))."','".
                    mysql_real_escape_string($gen_vend)."','".
                    mysql_real_escape_string($f1)."','".
                    mysql_real_escape_string($ced_vend)."',".
                    "'".
                    mysql_real_escape_string($id_suc)."','".
                    mysql_real_escape_string($pass_vend)."','".
                    mysql_real_escape_string($f2)."','".
                    mysql_real_escape_string($ced_jefe)."','0','0','1')";
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows==1?TRUE:FALSE;
    }

    public function procesarVendedorM($ced_vend,$id_suc,$ced_jefe, $pass_vend,&$con)
    {
        $con=-1;
        $numrows=-1;
        if(!$this->bdatos->connectTo())
        {
            $con=0;
            return FALSE;
        }
        $qry = "UPDATE usuario SET ".
                " fk_suc_num='".mysql_real_escape_string($id_suc)."',".
                " usu_jef='".mysql_real_escape_string($ced_jefe)."', ".
                " usu_con='".mysql_real_escape_string($pass_vend)."' ".
                "WHERE usu_ide='".  mysql_real_escape_string($ced_vend)."';";
        $con=1;
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows==1?TRUE:FALSE;
    }

    public function srvObtenerVistaVendedores(&$datos,&$num)
    {
        $numrows=-1;
        $qry= "SELECT usuario.usu_nom,usuario.usu_ape,usuario.usu_sex,usuario.usu_fec_nac,usuario.usu_ide,usuario.usu_con,usuario.usu_fec_ing,usuario.usu_jef,usuario.usu_tra_fin,usuario.usu_tip,usuario.usu_est,sucursal.suc_nom ".
               "FROM usuario INNER JOIN sucursal ".
               "WHERE usuario.fk_suc_num = sucursal.suc_num ".
               "ORDER BY suc_nom ASC;";

        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalRegistros=$passVar['usu_nom'].";".$passVar['usu_ape'].";".$passVar['usu_sex'].";".
                                        $passVar['usu_fec_nac'].";".$passVar['usu_ide'].";".
                                        $passVar['usu_con'].";".$passVar['usu_fec_ing'].";".
                                        $passVar['usu_jef'].";".$passVar['usu_tra_fin'].";".
                                        $passVar['usu_tip'].";".$passVar['usu_est'].";".$passVar['suc_nom'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros."%%".$passVar['usu_nom'].";".$passVar['usu_ape'].";".
                                                                $passVar['usu_sex'].";".$passVar['usu_fec_nac'].";".
                                                                $passVar['usu_ide'].";".$passVar['usu_con'].";".
                                                                $passVar['usu_fec_ing'].";".$passVar['usu_jef'].";".
                                                                $passVar['usu_tra_fin'].";".$passVar['usu_tip'].";".
                                                                $passVar['usu_est'].";".$passVar['suc_nom'];
                }
            } 
            $datos = explode("%%", $strTotalRegistros);
            $num=$numrows; 
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }


    public function srvObtenerVistaTiposInmueble(&$tiposDoc, &$cantReg, &$ids_doc, &$desc_inm)
    {
        $numrows=-1;
        $qry = "SELECT nom_tip_inm, desc_tip_inm, id_tip_inm FROM tipo_inmueble ORDER BY nom_tip_inm DESC";
        $connected = $this->bdatos->connectTo();
        if(!$connected)
            return CodRes::NO_CONNECTED;
        $link= $this->bdatos->executeQry($qry, $numrows);
        //////echo $numrows;////echo $qry;
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalDatos="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalRegistros=$passVar['nom_tip_inm'];
                    $strTotalDatos=$passVar['desc_tip_inm'];
                    $strTotalIds=$passVar['id_tip_inm'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros.";".$passVar['nom_tip_inm'];
                    $strTotalDatos=$strTotalDatos.";".$passVar['desc_tip_inm'];
                    $strTotalIds = $strTotalIds.";".$passVar['id_tip_inm'];
                }
            }
            $tiposDoc = explode(";", $strTotalRegistros);
            $ids_doc  = explode(";", $strTotalIds);
            $desc_inm = explode(";", $strTotalDatos);
            $cantReg  = $numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }



    public function srvProcesarTipoInmueble($nom_inm, $desc_doc)
    {
        if(strlen($desc_doc)==0 || strlen($nom_inm)==0)
            return CodRes::DATOS_VACIOS;
        if(!$this->cadenaValida($nom_inm, "tipo_documento") || !$this->cadenaValida($desc_doc, "tipo_documento"))
            return CodRes::DATOS_INVALIDOS;
        if($this->tipoInmuebleExistente(strtoupper($nom_inm)))
           return CodRes::REGISTRO_REPETIDO;
        else if($this->procesarTipoInmueble(strtoupper ($nom_inm), $desc_doc))
           return CodRes::EXITO;
        else
            return CodRes::UNKNOWN;
    }


    private function tipoInmuebleExistente($nom_inm)
    {
        $numrows=-1;
        $this->bdatos->connectTo();
        $qry = "SELECT * FROM tipo_inmueble ".
                "WHERE nom_tip_inm='".mysql_real_escape_string(strtoupper($nom_inm))."' ";
        //echo $qry;
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows>0?TRUE:FALSE;
    }

    private function procesarTipoInmueble($nom_inm,$desc_doc)
    {
        $numrows=-1;
        $this->bdatos->connectTo();
        $qry = "INSERT INTO tipo_inmueble (nom_tip_inm, desc_tip_inm) VALUES ('".mysql_real_escape_string($nom_inm)."','".mysql_real_escape_string($desc_doc)."')";
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows==1?TRUE:FALSE;
    }


    public function srvObtenerTiposInmueble(&$ids_doc, &$cantReg, &$tiposDoc)
    {
        $numrows=-1;
        $qry = "SELECT nom_tip_inm, id_tip_inm FROM tipo_inmueble ORDER BY nom_tip_inm DESC";
        //////echo $qry;
        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        //////echo $numrows;////echo $qry;
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalRegistros=$passVar['nom_tip_inm'];
                    $strTotalIds=$passVar['id_tip_inm'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros.";".$passVar['nom_tip_inm'];
                    $strTotalIds = $strTotalIds.";".$passVar['id_tip_inm'];
                }
            }
            $tiposDoc = explode(";", $strTotalRegistros);
            $ids_doc = explode(";", $strTotalIds);
            $cantReg=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }

    public function srvProcesarInmueble($tip_inm, $mat_inm, $est_inm, $dir_inm,
                                                $area_inm, $cantba_inm, $cantpi_inm, $cantparq_inm,
                                                    $valimp_inm, $valadm_inm, $desc_inm,$id_ciudad)
    {
        $ver=-1;
        if( strlen($tip_inm)== 0 || strlen($mat_inm)== 0 ||  strlen($est_inm)== 0||
            strlen($dir_inm)== 0|| strlen($area_inm)== 0 ||
            strlen($cantba_inm)== 0 || strlen($cantpi_inm)== 0|| strlen($cantparq_inm)==0 ||
            strlen($valimp_inm)== 0 || strlen($valadm_inm)== 0 || strlen($desc_inm)== 0 || strlen($id_ciudad)==0
          )
                return CodRes::DATOS_VACIOS;
        if( strlen($mat_inm)>25|| strlen($dir_inm)> 45|| strlen($area_inm)> 7 ||
                strlen($cantba_inm)> 2 || strlen($cantpi_inm)> 2 || strlen($cantparq_inm)> 2 ||
            strlen($valimp_inm)>8|| strlen($valadm_inm)>8 || strlen($desc_inm)>255
           )
             return CodRes::LONGITUD_INVALIDA;
        if(     !$this->cadenaValida($dir_inm, "direccion")  ||
                !$this->cadenaValida($est_inm, "estrato") )
                    return CodRes::DATOS_INVALIDOS;
        if($this->inmuebleExistentePorMatricula($mat_inm))
            return CodRes::REGISTRO_REPETIDO;
        if($this->procesarInmueble($tip_inm, $mat_inm, $est_inm, $dir_inm,
                                                $area_inm, $cantba_inm, $cantpi_inm, $cantparq_inm,
                                                    $valimp_inm, $valadm_inm, $desc_inm,$id_ciudad, $ver))
            if($ver==1)
                return CodRes::EXITO;
            else
                return CodRes::NO_CONNECTED;
        else
            if($ver==0)
                return CodRes::NO_CONNECTED;
            else
                return CodRes::UNKNOWN;
    }
    public function srvProcesarInmuebleM($id_inm, $valimp_inm, $valadm_inm, $desc_inm)
    {
        $ver=-1;
        if( strlen($valimp_inm)== 0 || strlen($valadm_inm)== 0 || strlen($desc_inm)== 0 )
                return CodRes::DATOS_VACIOS;
        if( strlen($valimp_inm)>8|| strlen($valadm_inm)>8 || strlen($desc_inm)>255)
             return CodRes::LONGITUD_INVALIDA;
        if(!$this->inmuebleExistentePorID($id_inm))
            return CodRes::INMUEBLE_INEXISTENTE;
        if(!$this->procesarInmuebleM($id_inm, $valimp_inm, $valadm_inm, $desc_inm, $ver))
            if($ver==1)
                return CodRes::NO_CONNECTED;
            else
                return CodRes::UNKNOWN;
        else
                return CodRes::EXITO;
    }

    private function procesarInmueble($tip_inm, $mat_inm, $est_inm, $dir_inm,
                                                $area_inm, $cantba_inm, $cantpi_inm, $cantparq_inm,
                                                    $valimp_inm, $valadm_inm, $desc_inm,$id_ciudad, &$ver)
    {
        $numrows=-1;
        $ver=0;
        if(!$this->bdatos->connectTo())
        {
                $ver=0;
                return FALSE;
        }
        $ver=1;
        $qry = "INSERT INTO inmueble ".
               " (inm_num_mat, inm_mts_tot, inm_dir, inm_est, inm_num_ban, inm_num_pisos,".
               "inm_num_parq, inm_val_imp, inm_val_adm, inm_dis, inm_dat_adi, fk_ciu_num, fk_id_tip_inm) ".
                " VALUES ('".
                mysql_real_escape_string($mat_inm)."', '".
                strtoupper(mysql_real_escape_string($area_inm))."', '".
                strtoupper(mysql_real_escape_string($dir_inm))."', '".
                mysql_real_escape_string($est_inm)."', '".
                mysql_real_escape_string($cantba_inm)."', '".
                mysql_real_escape_string($cantpi_inm)."', '".
                mysql_real_escape_string($cantparq_inm)."', '".
                mysql_real_escape_string($valimp_inm)."', '".
                mysql_real_escape_string($valadm_inm)."', '".
                "1', '".
                mysql_real_escape_string($desc_inm)."', '".
                mysql_real_escape_string($id_ciudad)."', '".
                mysql_real_escape_string($tip_inm)."');";
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows==1?TRUE:FALSE;
    }


    private function procesarInmuebleM($inm_num, $valimp_inm, $valadm_inm, $desc_inm, &$ver)
    {
        $numrows=-1;
        $ver=0;
        if(!$this->bdatos->connectTo())
        {
                $ver=0;
                return FALSE;
        }
        $ver=1;
        $qry = "UPDATE inmueble SET ".
                " inm_dat_adi='".mysql_real_escape_string($desc_inm)."',".
                " inm_val_imp='".mysql_real_escape_string($valimp_inm)."', ".
                " inm_val_adm='".mysql_real_escape_string($valadm_inm)."' ".
                "WHERE inm_num='".  mysql_real_escape_string($inm_num)."';";
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows==1?TRUE:FALSE;
    }
    private function inmuebleExistentePorMatricula($inm_num)
    {
        $numrows=-1;
        $this->bdatos->connectTo();
        $qry = "SELECT * FROM inmueble ".
                "WHERE inm_num_mat='".mysql_real_escape_string($inm_num)."'";
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        //////echo $qry;
        return $numrows>0?TRUE:FALSE;
    }

    private function inmuebleExistentePorID($inm_num)
    {
        $numrows=-1;
        $this->bdatos->connectTo();
        $qry = "SELECT * FROM inmueble ".
                "WHERE inm_num='".mysql_real_escape_string($inm_num)."'";
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        //////echo $qry;
        return $numrows>0?TRUE:FALSE;
    }

    private function verificarCompradorValido($id_inm, $id_cli)
    {
        $numrows=-1;
        $id_cli_new="";
        $this->bdatos->connectTo();
        $qry = "SELECT fk_cli_ide ".
                "FROM contrato ".
                "WHERE fk_inm_num='".mysql_real_escape_string($id_inm)."' AND con_tip=1 ".
                "ORDER BY con_num DESC;";
        $link= $this->bdatos->executeQry($qry, $numrows);
        if($numrows>=1)
        {
            $passVar = $this->bdatos->_fetch_assoc($link);
            $id_cli_new=$passVar['fk_cli_ide'];
        }
        $this->bdatos->close();
        return ($numrows>0 && ($id_cli_new==$id_cli))?FALSE:TRUE;
    }

    private function verificarClienteCesionValido($num_con, $id_cli)
    {
        $numrows=-1;
        $id_cli_new="";
        $this->bdatos->connectTo();
        $qry = "SELECT fk_cli_ide ".
                "FROM contrato ".
                "WHERE con_num='".mysql_real_escape_string($num_con)."';";
        $link= $this->bdatos->executeQry($qry, $numrows);
        if($numrows>=1)
        {
            $passVar = $this->bdatos->_fetch_assoc($link);
            $id_cli_new=$passVar['fk_cli_ide'];
        }
        $this->bdatos->close();
        return ($numrows>0 && ($id_cli_new==$id_cli))?FALSE:TRUE;
    }


    private function esPropietarioInmueble($num_con, $id_cli)
    {
        $id_inm="";
        if($this->obtenerIDInmuebleUltimoContratoVenta($num_con, $id_inm))
        {
            if($this->obtenerPropietarioInmueble($id_inm, $prop_inm))
                    return ($prop_inm==$id_cli);
            else
                return false;
        }
        else
            return false;
    }
    private function obtenerPropietarioInmueble($id_inm, &$prop_inm)
    {
        $numrows=-1;
        $id_cli_new="";
        $prop_inm="";
        $this->bdatos->connectTo();
        $qry = "SELECT con_num, fk_cli_ide ".
                "FROM contrato ".
                "WHERE con_tip=1 ".
                "ORDER BY con_num DESC";
        ////echo "<br>obtenerPropietarioInmueble:".$qry;
        $link= $this->bdatos->executeQry($qry, $numrows);
        if($numrows>=1)
        {
            $passVar = $this->bdatos->_fetch_assoc($link);
            $prop_inm=$passVar['fk_cli_ide'];
        }
        $this->bdatos->close();
        return (strlen($prop_inm)>0)?TRUE:FALSE;
    }
    
    public function obtenerIDInmuebleUltimoContratoVenta($num_con, &$id_inm)
    {
        $numrows=-1;
        $id_cli_new="";
        $id_inm="";
        $this->bdatos->connectTo();
        $qry = "SELECT fk_inm_num ".
                "FROM contrato ".
                "WHERE con_num='".mysql_real_escape_string($num_con)."' ".
                "ORDER BY con_num DESC";
        $link= $this->bdatos->executeQry($qry, $numrows);
        ////echo "<br>obtenerIDInmuebleUltimoContratoVenta:".$qry;
        if($numrows>=1)
        {
            $passVar = $this->bdatos->_fetch_assoc($link);
            $id_inm=$passVar['fk_inm_num'];
        }
        $this->bdatos->close();
        return (strlen($id_inm)>0)?TRUE:FALSE;
    }

    public function srvObtenerVistaInmuebles(&$datos,&$num)
    {
        $numrows=-1;
        $qry= "SELECT inmueble.inm_num,inmueble.inm_num_mat,inmueble.inm_num_ven, inmueble.inm_mts_tot,inmueble.inm_dir, inmueble.inm_est, inmueble.inm_num_ban,".
              "inmueble.inm_num_pisos,inmueble.inm_num_parq,inmueble.inm_val_imp, inmueble.inm_val_adm,inmueble.inm_dis, inmueble.inm_dat_adi,".
              "ciudad.ciu_nom, tipo_inmueble.nom_tip_inm ".
              "FROM inmueble INNER JOIN ciudad INNER JOIN tipo_inmueble ".
	      "WHERE inmueble.fk_ciu_num = ciudad.ciu_num AND inmueble.fk_id_tip_inm = tipo_inmueble.id_tip_inm ".
              "ORDER BY fk_ciu_num;";
        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalRegistros=$passVar['inm_num'].";".
                                        $passVar['inm_num_mat'].";".
                                        $passVar['inm_mts_tot'].";".
                                        $passVar['inm_num_ven'].";".
                                        $passVar['inm_dir'].";".
                                        $passVar['inm_est'].";".
                                        $passVar['inm_num_ban'].";".$passVar['inm_num_pisos'].";".
                                        $passVar['inm_num_parq'].";".$passVar['inm_val_imp'].";".
                                        $passVar['inm_val_adm'].";".$passVar['inm_dis'].";".
                                        $passVar['inm_dat_adi'].";".$passVar['ciu_nom'].";".$passVar['nom_tip_inm'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros."%%".$passVar['inm_num'].";".
                                        $passVar['inm_num_mat'].";".
                                        $passVar['inm_mts_tot'].";".
                                        $passVar['inm_num_ven'].";".
                                        $passVar['inm_dir'].";".
                                        $passVar['inm_est'].";".
                                        $passVar['inm_num_ban'].";".$passVar['inm_num_pisos'].";".
                                        $passVar['inm_num_parq'].";".$passVar['inm_val_imp'].";".
                                        $passVar['inm_val_adm'].";".$passVar['inm_dis'].";".
                                        $passVar['inm_dat_adi'].";".$passVar['ciu_nom'].";".$passVar['nom_tip_inm'];
                }
            }
            $datos = explode("%%", $strTotalRegistros);
            $num=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }


    public function srvProcesarContrato($fecini_con,$fecfin_con,$tip_con, $val_con, $id_cli,$id_inm,$id_vend)
    {
        $con=-1;
        if( strlen($tip_con)== 0 || strlen($id_cli)==0 || strlen($id_inm)==0 ||
                strlen($fecini_con)== 0 || strlen($fecfin_con)==0 || strlen($val_con)==0
          )
                return CodRes::DATOS_VACIOS;
        if( strlen($fecini_con)!=10|| strlen($fecfin_con)!= 10 || strlen($tip_con)!=1 ||
            strlen($val_con)>8 || strlen($id_cli)>15 || strlen($id_inm)>15
           )
             return CodRes::LONGITUD_INVALIDA;
        if(     !$this->cadenaValida($fecini_con, "fecha")  ||
                !$this->cadenaValida($fecfin_con, "fecha") ||
                !$this->cadenaValida($tip_con, "numeros") ||
                !$this->cadenaValida($val_con, "decimal") ||
                !$this->cadenaValida($val_con, "decimal") ||
                !$this->cadenaValida($id_inm, "alfanumerico") ||
                !$this->cadenaValida($id_cli, "numeros")
          )
                    return CodRes::DATOS_INVALIDOS;
        if($tip_con==2 && !$this->validarDuracionContrato($fecini_con,$fecfin_con))
                    return CodRes::DURACION_CONTRATO;
        if(!$this->inmuebleExistentePorID($id_inm))
            return CodRes::INMUEBLE_INEXISTENTE;
        if($tip_con==2 && !$this->validarDisponibilidadArrendamiento($id_inm))
                return CodRes::PROPIEDAD_ARRENDADA;
        if(!$this->verificarCompradorValido($id_inm, $id_cli))
            return CodRes::MISMO_CLIENTE;
        if($this->procesarContrato($fecini_con,$fecfin_con,$tip_con, $val_con, $id_cli,$id_inm,$id_vend, $con))
        {
            $id_vend = ($id_vend=='-1')?'0':$id_vend;
            if($con==1)
            {
                if($tip_con==2)
                {
                    if(!$this->procesarModificarDisponibilidadInmueble($id_inm, "0", $con))
                    {
                        return CodRes::EXITO_0;
                    }
                    else
                    {   
                        if($this->procesarIncrementarMovimientosVendedor($id_vend))
                            return CodRes::EXITO;
                        else
                            return CodRes::EXITO_1;
                    }
                }
                else
                {
                    if(!$this->procesarModificarNumeroVentasInmueble($id_inm, $con))
                    {
                        return CodRes::EXITO_0;
                    }
                    else
                    {
                        if($this->procesarIncrementarMovimientosVendedor($id_vend))
                            return CodRes::EXITO;
                        else
                            return CodRes::EXITO_1;
                    }
                }
                    return CodRes::EXITO;
            }
            else
                return CodRes::NO_CONNECTED;
        }
        else
            if($con==0)
                return CodRes::NO_CONNECTED;
            else
                return CodRes::UNKNOWN;
    }

    private function procesarModificarDisponibilidadInmueble($id_inm, $val, &$con)
    {
        $numrows=-1;
        $con=0;
        if(!$this->bdatos->connectTo())
        {
                $con=0;
                return FALSE;
        }
        $con=1;
        $qry = "UPDATE inmueble ".
               "SET inm_dis = '".$val."' ".
               "WHERE inm_num='".$id_inm."';";
        //////echo $qry;
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows==1?TRUE:FALSE;
    }


    private function procesarModificarNumeroVentasInmueble($id_inm, &$con)
    {
        $numrows=-1;
        $con=0;
        $vent=-1;
        if(!$this->obtenerNumeroVentasInmueble($id_inm, $vent))
                return FALSE;
        if(!$this->bdatos->connectTo())
        {
                $con=0;
                return FALSE;
        }
        $con=1;
        $qry = "UPDATE inmueble ".
               "SET inm_num_ven = ".($vent+1)." ".
               "WHERE inm_num='".$id_inm."';";
        //////echo $qry;
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows==1?TRUE:FALSE;
    }

    private function procesarContrato($fecini_con,$fecfin_con,$tip_con, $val_con, $id_cli,$id_inm,$id_vend, &$con)
    {
        $numrows=-1;
        $con=0;
        if(!$this->bdatos->connectTo())
        {
                $con=0;
                return FALSE;
        }
        $con=1;
        if($id_vend=="-1")
            if($tip_con==1)
            $qry = "INSERT INTO contrato ".
               " (con_fec_ini_con, con_fec_fin_con, con_tip, con_val,con_est, fk_inm_num, fk_cli_ide,fk_con_usu_ide) ".
                " VALUES ('".
                mysql_real_escape_string($fecini_con)."', '".
                mysql_real_escape_string($fecfin_con)."', '".
                mysql_real_escape_string($tip_con)."', '".
                mysql_real_escape_string($val_con)."', '0', '".
                mysql_real_escape_string($id_inm)."', '".
                mysql_real_escape_string($id_cli)."', '0');";
            else
            $qry = "INSERT INTO contrato ".
               " (con_fec_ini_con, con_fec_fin_con, con_tip, con_val, fk_inm_num, fk_cli_ide,fk_con_usu_ide) ".
                " VALUES ('".
                mysql_real_escape_string($fecini_con)."', '".
                mysql_real_escape_string($fecfin_con)."', '".
                mysql_real_escape_string($tip_con)."', '".
                mysql_real_escape_string($val_con)."', '".
                mysql_real_escape_string($id_inm)."', '".
                mysql_real_escape_string($id_cli)."', '0');";
        else
            if($tip_con==1)
            $qry = "INSERT INTO contrato ".
               " (con_fec_ini_con, con_fec_fin_con, con_tip, con_val,con_est, fk_inm_num, fk_cli_ide,fk_con_usu_ide) ".
                " VALUES ('".
                mysql_real_escape_string($fecini_con)."', '".
                mysql_real_escape_string($fecfin_con)."', '".
                mysql_real_escape_string($tip_con)."', '".
                mysql_real_escape_string($val_con)."','0', '".
                mysql_real_escape_string($id_inm)."', '".
                mysql_real_escape_string($id_cli)."', '".
                mysql_real_escape_string($id_vend)."');";
            else
                
            $qry = "INSERT INTO contrato ".
               " (con_fec_ini_con, con_fec_fin_con, con_tip, con_val, fk_inm_num, fk_cli_ide,fk_con_usu_ide) ".
                " VALUES ('".
                mysql_real_escape_string($fecini_con)."', '".
                mysql_real_escape_string($fecfin_con)."', '".
                mysql_real_escape_string($tip_con)."', '".
                mysql_real_escape_string($val_con)."', '".
                mysql_real_escape_string($id_inm)."', '".
                mysql_real_escape_string($id_cli)."', '".
                mysql_real_escape_string($id_vend)."');";
        //////echo $qry;
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows==1?TRUE:FALSE;
    }


    private function procesarCesionContrato($con_num, $id_cli, &$con)
    {
        $numrows=-1;
        $con=0;
        if(!$this->bdatos->connectTo())
        {
                $con=0;
                return FALSE;
        }
        $con=1;
        $qry = "UPDATE contrato ".
                "SET fk_cli_ide='". mysql_real_escape_string($id_cli)."' ".
                "WHERE con_num='".  mysql_real_escape_string($con_num)."'";
        //////echo $qry;
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows==1?TRUE:FALSE;
    }


    public function srvObtenerVistaContratos(&$datos,&$num)
    {
        $numrows=-1;
        $qry= "SELECT contrato.fk_cli_ide,contrato.con_num,  inmueble.inm_num_mat, ".
               "contrato.con_fec_ini_con, contrato.con_fec_fin_con, ".
                        "contrato.con_tip, contrato.con_val,contrato.con_est, cliente.cli_nom, usuario.usu_nom,usuario.usu_ape ".
              "FROM contrato INNER JOIN cliente INNER JOIN inmueble INNER JOIN usuario ".
	      "WHERE contrato.fk_cli_ide = cliente.cli_ide AND contrato.fk_inm_num=inmueble.inm_num  ".
                "AND contrato.fk_con_usu_ide=usuario.usu_ide ".
              "ORDER BY con_num;";
        //////echo $qry;
        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalRegistros=$passVar['con_num'].";".
                                        $passVar['inm_num_mat'].";".
                                        $passVar['fk_cli_ide'].";".
                                        $passVar['cli_nom'].";".
                                        $passVar['con_fec_ini_con'].";".
                                        $passVar['con_fec_fin_con'].";".
                                        $passVar['con_tip'].";".
                                        $passVar['usu_nom']."-".$passVar['usu_ape'].";".
                                        $passVar['con_val'].";".
                                        $passVar['con_est'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros."%%".$passVar['con_num'].";".
                                        $passVar['inm_num_mat'].";".
                                        $passVar['fk_cli_ide'].";".
                                        $passVar['cli_nom'].";".
                                        $passVar['con_fec_ini_con'].";".
                                        $passVar['con_fec_fin_con'].";".
                                        $passVar['con_tip'].";".
                                        $passVar['usu_nom']."-".$passVar['usu_ape'].";".
                                        $passVar['con_val'].";".
                                        $passVar['con_est'];
                }
            }
            $datos = explode("%%", $strTotalRegistros);
            $num=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }


    public function srvObtenerContratosPorTipo(&$ids, &$datos, &$cant, $tip)
    {
        $con=-1;
        if($tip!=1&&$tip!=2)
            return CodRes::DATOS_INVALIDOS;
        else
        {
            if($this->obtenerContratosPorTipo($ids, $datos, $cant, $tip, $con))
            {
                return CodRes::EXITO;
            }
            else
            {
                if($con==0)
                    return CodRes::NO_CONNECTED;
                if($con==2)
                    return CodRes::SIN_REGISTROS;
            }
        }
    }

    private function obtenerContratosPorTipo(&$ids, &$datos, &$cant, $tip, &$con)
    {
        $numrows=-1;
        //////echo $qry;
        if(!$this->bdatos->connectTo())
        {
                $con=0;
                return FALSE;
        }
        $qry= "SELECT contrato.con_num,  inmueble.inm_num_mat ".
              "FROM contrato INNER JOIN inmueble ".
	      "WHERE contrato.con_tip=".mysql_real_escape_string($tip)." AND CURDATE()< contrato.con_fec_fin_con ".
              "AND inmueble.inm_num=contrato.fk_inm_num AND contrato.con_est=1 ".
              "ORDER BY contrato.con_num;";
       //////echo $qry;
        $link= $this->bdatos->executeQry($qry, $numrows);
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalRegistros=$passVar['inm_num_mat'];
                    $strTotalIds=$passVar['con_num'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros.";".$passVar['inm_num_mat'];
                    $strTotalIds=$strTotalIds.";".$passVar['con_num'];
                }
            }
            $datos = explode(";", $strTotalRegistros);
            $ids = explode(";", $strTotalIds);
            $cant=$numrows;
            $this->bdatos->close();
            $con=1;
            return true;
        }
        else
        {
            $con=2;
            $this->bdatos->close();
            return false;
        }

    }

    public function srvObtenerVendedores(&$ids, &$datos, &$cant)
    {
        $numrows=-1;
        $qry = "SELECT usu_ide, usu_nom, usu_ape ".
                "FROM usuario ".
                "ORDER BY usu_ape ASC;";
        if($this->bdatos->connectTo()==false)
                return CodRes::NO_CONNECTED;
        $result=$this->bdatos->executeQry($qry, $numrows);
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($result);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalRegistros=$passVar['usu_ape']." ".$passVar['usu_nom']."_".$passVar['usu_ide'];
                    $strTotalIds=$passVar['usu_ide'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros.";".$passVar['usu_ape']." ".$passVar['usu_nom']."_".$passVar['usu_ide'];
                    $strTotalIds=$strTotalIds.";".$passVar['usu_ide'];
                }
            }
            $datos = explode(";", $strTotalRegistros);
            $ids =explode(";", $strTotalIds);
            $cant=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }


    private function procesarIncrementarMovimientosVendedor(&$id_vend)
    {
        
        $numrows=-1;
        $vent=-1;
        if(!$this->obtenerVentasVendedor($id_vend, $vent))
                return FALSE;
        $con=0;
        if(!$this->bdatos->connectTo())
        {
                $con=0;
                return FALSE;
        }
        $con=1;

        $qry = "UPDATE usuario ".
               "SET usu_tra_fin = ".($vent+1)." ".
               "WHERE usu_ide= '".$id_vend."';";
        //////echo $qry;
        $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows==1?TRUE:FALSE;
    }

    private function obtenerVentasVendedor(&$id_vend, &$vent)
    {
        $numrows=-1;
        $con=0;
        if(!$this->bdatos->connectTo())
        {
                $con=0;
                return FALSE;
        }
        $con=1;

        $qry = "SELECT usu_tra_fin FROM usuario WHERE usu_ide= '".$id_vend."';";
        //////echo $qry;
        $result= $this->bdatos->executeQry($qry, $numrows);
        if($numrows>=1)
        {
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($result);
                $vent =  $passVar['usu_tra_fin'];
            }
        }
        $this->bdatos->close();
        return $numrows==1?TRUE:FALSE;
    }

    private function obtenerNumeroVentasInmueble($id_inm, &$vent)
    {
        $numrows=-1;
        $con=0;
        if(!$this->bdatos->connectTo())
        {
                $con=0;
                return FALSE;
        }
        $con=1;

        $qry = "SELECT inm_num_ven FROM inmueble WHERE inm_num= '".$id_inm."';";
        //////echo $qry;
        $result= $this->bdatos->executeQry($qry, $numrows);
        if($numrows>=1)
        {
                $passVar = $this->bdatos->_fetch_assoc($result);
                $vent =  $passVar['inm_num_ven'];
        }
        $this->bdatos->close();
        return $numrows==1?TRUE:FALSE;
    }

    public function srvObtenerVistaCambiosInmuebles(&$datos, &$num)
    {
        $numrows=-1;
        /*$qry= "SELECT cambios_contrato.camb_con_num, cambios_contrato.camb_con_fec,cambios_contrato.camb_con_ant_cli,cambios_contrato.camb_con_new_cli,cambios_contrato.fk_contrato_con_num ".
              "FROM contrato INNER JOIN cliente INNER JOIN inmueble INNER JOIN usuario ".
	      "WHERE contrato.fk_cli_ide = cliente.cli_ide AND contrato.fk_inm_num=inmueble.inm_num  ".
                "AND contrato.fk_con_usu_ide=usuario.usu_ide ".
              "ORDER BY con_num;";*/

        $qry= "SELECT  cambios_inmueble.camb_inm_num,cambios_inmueble.camb_inm_tip, cambios_inmueble.camb_inm_fec, ".
                    "cambios_inmueble.camb_inm_est_new, cambios_inmueble.camb_inm_est_old, inmueble.inm_num_mat ".
              "FROM cambios_inmueble INNER JOIN inmueble  ".
	      "WHERE cambios_inmueble.fk_camb_inm_num = inmueble.inm_num ".
              "ORDER BY cambios_inmueble.camb_inm_num;";
        //////echo $qry;
        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalRegistros=$passVar['camb_inm_num'].";".
                                        $passVar['camb_inm_tip'].";".
                                        $passVar['camb_inm_fec'].";".
                                        $passVar['camb_inm_est_old'].";".
                                        $passVar['camb_inm_est_new'].";".
                                        $passVar['inm_num_mat'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros."%%".$passVar['camb_inm_num'].";".
                                        $passVar['camb_inm_tip'].";".
                                        $passVar['camb_inm_fec'].";".
                                        $passVar['camb_inm_est_old'].";".
                                        $passVar['camb_inm_est_new'].";".
                                        $passVar['inm_num_mat'];
                }
            }
            $datos = explode("%%", $strTotalRegistros);
            $num=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }


    public function srvProcesarCesionContrato($num_con, $id_cli)
    {
        $con=-1;
        if( strlen($num_con)== 0 || strlen($id_cli)==0)
                return CodRes::DATOS_VACIOS;
        if(!$this->cadenaValida($id_cli, "numeros") || !$this->cadenaValida($num_con, "numeros"))
                    return CodRes::DATOS_INVALIDOS;
        if( strlen($id_cli)>15)
             return CodRes::LONGITUD_INVALIDA;
        if(!$this->contratoExistente($num_con))
            return CodRes::CONTRATO_INEXISTENTE;
        if(!$this->verificarClienteCesionValido($num_con, $id_cli))
            return CodRes::MISMO_CLIENTE;
        if($this->esPropietarioInmueble($num_con, $id_cli))
            return CodRes::PROPIETARIO_INMUEBLE;
        if($this->procesarCesionContrato($num_con, $id_cli,$con))
        {
            return CodRes::EXITO;
        }
        else
        {
            if($con==0)
                return CodRes::NO_CONNECTED;
            else
                return CodRes::UNKNOWN;
        }
    }



    public function srvObtenerVistaCambiosContrato(&$datos, &$num)
    {
        $numrows=-1;
        $qry= "SELECT camb_con_num, camb_con_fec,camb_con_ant_cli,".
                        "camb_con_new_cli,camb_con_est_ant,camb_con_est_new, fk_contrato_con_num ".
              "FROM cambios_contrato  ".
              "ORDER BY camb_con_num;";
        //////echo $qry;
        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalRegistros=$passVar['camb_con_num'].";".
                                        $passVar['camb_con_fec'].";".
                                        $passVar['camb_con_ant_cli'].";".
                                        $passVar['camb_con_new_cli'].";".
                                        $passVar['camb_con_est_ant'].";".
                                        $passVar['camb_con_est_new'].";".
                                        $passVar['fk_contrato_con_num'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros."%%".$passVar['camb_con_num'].";".
                                        $passVar['camb_con_fec'].";".
                                        $passVar['camb_con_ant_cli'].";".
                                        $passVar['camb_con_new_cli'].";".
                                        $passVar['camb_con_est_ant'].";".
                                        $passVar['camb_con_est_new'].";".
                                        $passVar['fk_contrato_con_num'];
                }
            }
            $datos = explode("%%", $strTotalRegistros);
            $num=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }
    
    
    public function srvObtenerInmueblesArrendados(&$ids, &$datos, &$cant)
    {
        $numrows=-1;
        //////echo $qry;
        if(!$this->bdatos->connectTo())
        {
                $con=0;
                return CodRes::NO_CONNECTED;
        }
        $qry= "SELECT inm_num,  inm_num_mat ".
              "FROM inmueble ".
	      "WHERE inm_dis=0 ".
              "ORDER BY inm_num;";
       //////echo $qry;
        $link= $this->bdatos->executeQry($qry, $numrows);
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalRegistros=$passVar['inm_num_mat'];
                    $strTotalIds=$passVar['inm_num'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros.";".$passVar['inm_num_mat'];
                    $strTotalIds=$strTotalIds.";".$passVar['inm_num'];
                }
            }
            $datos = explode(";", $strTotalRegistros);
            $ids = explode(";", $strTotalIds);
            $cant=$numrows;
            $this->bdatos->close();
            $con=1;
            return CodRes::EXITO;
        }
        else
        {
            $con=2;
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }

    }
    
    
    public function srvProcesarDevolverInmueble($num_con, $inm_mat)
    {
        $con=-1;
        if( strlen($num_con)== 0 || strlen($inm_mat)==0)
                return CodRes::DATOS_VACIOS;
        if(!$this->cadenaValida($inm_mat, "alfanumerico") || !$this->cadenaValida($num_con, "numeros"))
                    return CodRes::DATOS_INVALIDOS;
        if( strlen($inm_mat)>25)
             return CodRes::LONGITUD_INVALIDA;
        if(!$this->contratoExistente($num_con))
            return CodRes::CONTRATO_INEXISTENTE;
        if(!$this->inmuebleExistentePorMatricula($inm_mat))
            return CodRes::INMUEBLE_INEXISTENTE;
        if($this->procesarDevolverInmueble($num_con, $inm_mat,$con))
        {
            return CodRes::EXITO;
        }
        else
        {
            if($con==0)
                return CodRes::NO_CONNECTED;
            else
                return CodRes::UNKNOWN;
        }
    }
    
    
    private function procesarDevolverInmueble($con_num, $inm_mat, &$con)
    {
        $numrows=-1;
        $con=0;
        if(!$this->bdatos->connectTo())
        {
                $con=0;
                return FALSE;
        }
        $con=1;
        $qry0 = "UPDATE contrato ".
                "SET con_est=0 ".
                "WHERE con_num='".  mysql_real_escape_string($con_num)."';";
        $qry = "UPDATE inmueble ".
                "SET inm_dis='1' ".
                "WHERE inm_num_mat='".mysql_real_escape_string($inm_mat)."';";
        //////echo $qry;
        $link= $this->bdatos->executeQry($qry, $numrows);
        $link= $this->bdatos->executeQry($qry0, $numrows);
        $this->bdatos->close();
        return $numrows==1?TRUE:FALSE;
    }

    private function validarDuracionContrato($fecini_con,$fecfin_con)
    {
        $date1 = explode("-",$fecini_con);
        $date2 = explode("-",$fecfin_con);
        if($date1[0]==$date2[0])
            return ($date2[1]-$date1[1]>6)?TRUE:FALSE;
        else
        {
            if(($date2[0]-$date1[0])==1)
                return (12-$date1[1]+$date2[1])>=6&&(12-$date1[1]+$date2[1])<=12?TRUE:FALSE;
            else
                return FALSE;
        }

    }

    private function validarDisponibilidadArrendamiento($id_inm)
    {
        $numrows=-1;
        $this->bdatos->connectTo();
        $qry = "SELECT * FROM inmueble ".
                "WHERE inm_num='".mysql_real_escape_string(strtoupper($id_inm))."' AND inm_dis=1";
        //echo $qry;
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows==1?TRUE:FALSE;
    }



    public function srvObtenerConsecutivoPago(&$cant)
    {

        $numrows=-1;
        $qry = "SELECT AUTO_INCREMENT ".
             "FROM information_schema.TABLES ".
             "WHERE TABLE_SCHEMA = '".$this->bdatos->getDBName()."' AND TABLE_NAME = 'pago';";
        if(($this->bdatos->connectTo())==false)
                return CodRes::NO_CONNECTED;
        $result=$this->bdatos->executeQry($qry, $numrows);
        if($numrows>=1)
        {
            $passVar = $this->bdatos->_fetch_assoc($result);
            $cant = $passVar['AUTO_INCREMENT'];
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $cant=$numrows;
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }

    public function srvObtenerInformacionPago($num_con, $id_cli, &$nom_cli, &$num_cuotas)
    {
        $this->obtenerNombreCliente($id_cli, $nom_cli);
        $this->obtenerCuotasPagadasContrato($num_con, $num_cuotas);
        if($num_cuotas!="-1" && $nom_cli!="")
            return CodRes::EXITO;
        else
            return CodRes::UNKNOWN;
    }

    private function obtenerCuotasPagadasContrato($con_num, &$cant)
    {
        $numrows=-1;
        $qry = "SELECT pag_num ".
             "FROM pago ".
             "WHERE fk_con_num ='".$con_num."';";
        if(($this->bdatos->connectTo())==false)
                $cant=0;
        else
        {
            $result=$this->bdatos->executeQry($qry, $numrows);
            $cant = $numrows;
            $this->bdatos->close();
        }
    }


    private function obtenerNombreCliente($id_cli, &$nom_cli)
    {
        $numrows=-1;
        $numrows1=-1;
        $qry = "SELECT cli_nom ".
             "FROM cliente ".
             "WHERE cli_ide ='".$id_cli."';";
        if(($this->bdatos->connectTo())==false)
            $nom_cli="";
        else
        {
            $result=$this->bdatos->executeQry($qry, $numrows);
            if($numrows>0)
            {
                $passVar = $this->bdatos->_fetch_assoc($result);
                $nom_cli= $passVar['cli_nom'];

                $qry1 = "SELECT nat_ape ".
                 "FROM cnatural ".
                 "WHERE fk_cli_ide ='".$id_cli."';";
                $result1=$this->bdatos->executeQry($qry1, $numrows1);
                if($numrows1>0)
                {
                    $passVar1 = $this->bdatos->_fetch_assoc($result1);
                    $nom_cli = $nom_cli." ".$passVar1['nat_ape'];
                }
            }
            $this->bdatos->close();
        }
    }

    public function srvProcesarContenidoFactura($tip_pago, $val_pago, $num_cuo_pago,
                                                    $desc_pago, $num_con, $cli_ide, $num_pago, $fec_pago,$nom_cli,$base,$iva,$num_matricula,
                                                        &$datos )
    {
        if(strlen($tip_pago)==0 || strlen($val_pago)==0 || strlen($num_cuo_pago)==0 ||
                     strlen($num_con)==0 || strlen($cli_ide)==0
                )
            return CodRes::DATOS_VACIOS;
        else if(!$this->cadenaValida($cli_ide, "numeros") ||
                !$this->cadenaValida($num_con, "numeros") ||
                !$this->cadenaValida($num_cuo_pago, "numeros") ||
                !$this->cadenaValida($num_con, "numeros"))
            return CodRes::DATOS_INVALIDOS;
        else if(!$this->clienteExistente($cli_ide))
            return CodRes::CLIENTE_INEXISTENTE;
        else if(!$this->contratoExistente($num_con))
                return CodRes::CONTRATO_INEXISTENTE;
        else
        {
            $this->procesarContenidoFactura($tip_pago, $val_pago, $num_cuo_pago,
                                                    $desc_pago, $num_con, $cli_ide,$num_pago, $fec_pago, $nom_cli,$base,$iva,$num_matricula,$datos);
            return CodRes::EXITO;
        }
    }

    private function procesarContenidoFactura($tip_pago, $val_pago, $num_cuo_pago,
                                                $desc_pago, $num_con, $cli_ide,$num_pago, $fec_pago,$nom_cli,$base,$iva,$num_matricula, &$datos)
    {
        $varTip=$tip_pago=="2"?"Arriendo":"Venta";
        $datos=" ; ; ;Reg. Pago:;".$num_pago."\n".
        " ; ; ;Fecha Pago:;".$fec_pago."\n".
        "Cliente:;".$nom_cli."; ; ; "."\n".
        "Identificacion:;".$cli_ide."; ; ; "."\n".
        "No. Contrato;Concepto;No. Matricula;No. Cuota;Valor Cuota"."\n".
        $num_con.";".$varTip.";".$num_matricula.";".$num_cuo_pago.";".$val_pago."\n".
        " ; ; ;Base Iva:;".$base."\n".
        " ; ; ;IVA 16%:;".$iva."\n".
        " ; ; ;Total:;".$val_pago;
        $this->crearArchivoFactura("F_".$num_con."_".date("Y-m")."_".$num_cuo_pago, $datos);

    }

    private function crearArchivoFactura($nom_file, &$datos)
    {
        $myFile = "../files/data/".$nom_file.".fac";
        $fh = fopen($myFile, 'w') or die("can't open file");
        $stringData = $datos;
        fwrite($fh, $stringData);
        $datos=$myFile;
        fclose($fh);

    }

    public function srvProcesarFactura($varTip,$val_pago,
                                                 $cuota_pago,
                                                 $desc_pago,
                                                 $num_con,
                                                 $cli_ide)
    {
        $con=-1;
        if(strlen($varTip)==0 || strlen($val_pago)==0 || strlen($cuota_pago)==0 ||
                     strlen($num_con)==0 || strlen($cli_ide)==0
                )
            return CodRes::DATOS_VACIOS;
        else if(!$this->cadenaValida($cli_ide, "numeros") ||
                !$this->cadenaValida($num_con, "numeros") ||
                !$this->cadenaValida($cuota_pago, "numeros") ||
                !$this->cadenaValida($num_con, "numeros"))
            return CodRes::DATOS_INVALIDOS;
        else if(!$this->clienteExistente($cli_ide))
            return CodRes::CLIENTE_INEXISTENTE;
        else if(!$this->contratoExistente($num_con))
                return CodRes::CONTRATO_INEXISTENTE;
        else
        {
            if($this->procesarFactura($varTip,$val_pago,$cuota_pago,$desc_pago,
                                     $num_con,$cli_ide,$con) && $con==1)
                return CodRes::EXITO;
            else if($con==0)
            {
                return CodRes::NO_CONNECTED;
            }
            else
                return CodRes::UNKNOWN;

        }
    }

    private function procesarFactura($varTip,$val_pago,$cuota_pago,$desc_pago,
                                     $num_con,$cli_ide,&$con)
    {
        $numrows=-1;
        $con=0;
        if(!$this->bdatos->connectTo())
        {
                $con=0;
                return FALSE;
        }
        $con=1;
        $qry = "INSERT INTO pago (pag_tip_ser, pag_val, pag_fec, pag_num_cuo,pag_desc,fk_con_num,fk_cli_ide) ".
                "VALUES ('".mysql_real_escape_string($varTip)."','".
                        mysql_real_escape_string($val_pago)."',".
                        "NOW(),'".
                        mysql_real_escape_string($cuota_pago)."','".
                        mysql_real_escape_string($desc_pago)."','".
                        mysql_real_escape_string($num_con)."','".
                        mysql_real_escape_string($cli_ide)."');";
        $link= $this->bdatos->executeQry($qry, $numrows);
        $this->bdatos->close();
        return $numrows==1?TRUE:FALSE;
    }

    public function srvObtenerVistaPagos(&$datos, &$num)
    {
        $numrows=-1;
        $qry= "SELECT  pago.pag_num,pago.pag_tip_ser, pago.pag_val,pago.pag_fec, ".
                    "pago.pag_num_cuo, pago.pag_desc, pago.fk_con_num, pago.fk_cli_ide,cliente.cli_nom ".
              "FROM pago  INNER JOIN cliente ".
	      "WHERE pago.fk_cli_ide = cliente.cli_ide ".
              "ORDER BY pago.pag_num ASC;";
        $this->bdatos->connectTo();
        $link= $this->bdatos->executeQry($qry, $numrows);
        if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalRegistros=$passVar['pag_num'].";".
                                        $passVar['pag_tip_ser'].";".
                                        $passVar['pag_val'].";".
                                        $passVar['pag_fec'].";".
                                        $passVar['pag_num_cuo'].";".
                                        $passVar['pag_desc'].";".
                                        $passVar['fk_con_num'].";".
                                        $passVar['fk_cli_ide'].";".
                                        $passVar['cli_nom'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros."%%".$passVar['pag_num'].";".
                                        $passVar['pag_tip_ser'].";".
                                        $passVar['pag_val'].";".
                                        $passVar['pag_fec'].";".
                                        $passVar['pag_num_cuo'].";".
                                        $passVar['pag_desc'].";".
                                        $passVar['fk_con_num'].";".
                                        $passVar['fk_cli_ide'].";".
                                        $passVar['cli_nom'];
                }
            }
            $datos = explode("%%", $strTotalRegistros);
            $num=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }


    public function srvObtenerReporteClientes(&$datos_clientes, &$num_clientes)
    {
        $qry= "SELECT cli_ide,cli_nom, cli_tel, cli_cel,cli_cor_ele,count(con_tip) AS con_tot ".
        "FROM cliente,contrato ".
        "WHERE fk_cli_ide=cli_ide && con_fec_fin_con>curdate() ".
        "GROUP BY cli_ide ".
        "ORDER BY con_tot DESC";
        if(!$this->bdatos->connectTo())
                return CodRes::NO_CONNECTED;
        $link= $this->bdatos->executeQry($qry, $numrows);if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalRegistros=$passVar['cli_ide'].";".
                                        $passVar['cli_nom'].";".
                                        $passVar['cli_tel'].";".
                                        $passVar['cli_cel'].";".
                                        $passVar['cli_cor_ele'].";".
                                        $passVar['con_tot'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros."%%".$passVar['cli_ide'].";".
                                        $passVar['cli_nom'].";".
                                        $passVar['cli_tel'].";".
                                        $passVar['cli_cel'].";".
                                        $passVar['cli_cor_ele'].";".
                                        $passVar['con_tot'];
                }
            }
            $datos_clientes = explode("%%", $strTotalRegistros);
            $num_clientes=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }
    public function srvObtenerReporteVendedores(&$datos_clientes, &$num_clientes)
    {
        $qry= "SELECT usu_nom,usu_ape,usu_tra_fin,usu_tip,usu_fec_ing ".
        "FROM usuario ".
        "WHERE usu_est=1 ".
        "ORDER BY usu_tra_fin ASC";
        if(!$this->bdatos->connectTo())
                return CodRes::NO_CONNECTED;
        $link= $this->bdatos->executeQry($qry, $numrows);if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalRegistros=$passVar['usu_nom'].";".
                                        $passVar['usu_ape'].";".
                                        $passVar['usu_tra_fin'].";".
                                        $passVar['usu_tip'].";".
                                        $passVar['usu_fec_ing'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros."%%".$passVar['usu_nom'].";".
                                        $passVar['usu_ape'].";".
                                        $passVar['usu_tra_fin'].";".
                                        $passVar['usu_tip'].";".
                                        $passVar['usu_fec_ing'];
                }
            }
            $datos_clientes = explode("%%", $strTotalRegistros);
            $num_clientes=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }
    public function srvObtenerReporteInmuebles(&$datos_clientes, &$num_clientes)
    {
        $qry= "SELECT inm_num, inm_num_mat, inm_num_ven, count( inm_dis ) AS inm_con_tot ".
        "FROM inmueble, contrato ".
        "WHERE fk_inm_num = inm_num ".
        "GROUP BY inm_num ".
        "ORDER BY `inmueble`.`inm_num` ASC";
        if(!$this->bdatos->connectTo())
                return CodRes::NO_CONNECTED;
        $link= $this->bdatos->executeQry($qry, $numrows);if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalRegistros=$passVar['inm_num'].";".
                                        $passVar['inm_num_mat'].";".
                                        $passVar['inm_num_ven'].";".
                                        $passVar['inm_con_tot'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros."%%".$passVar['inm_num'].";".
                                        $passVar['inm_num_mat'].";".
                                        $passVar['inm_num_ven'].";".
                                        $passVar['inm_con_tot'];
                }
            }
            $datos_clientes = explode("%%", $strTotalRegistros);
            $num_clientes=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }
    public function srvObtenerReporteContratos(&$datos_clientes, &$num_clientes)
    {
        $qry= "SELECT con_num, cli_nom, usu_nom, usu_ape, con_val ".
                "FROM contrato, cliente, usuario ".
                "WHERE fk_cli_ide = cli_ide && fk_con_usu_ide = usu_ide ".
                "GROUP BY con_num ".
                "ORDER BY `contrato`.`con_num` ASC";
        if(!$this->bdatos->connectTo())
                return CodRes::NO_CONNECTED;
        $link= $this->bdatos->executeQry($qry, $numrows);if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalRegistros=$passVar['con_num'].";".
                                        $passVar['cli_nom'].";".
                                        $passVar['usu_nom'].";".
                                        $passVar['usu_ape'].";".
                                        $passVar['con_val'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros."%%".$passVar['con_num'].";".
                                        $passVar['cli_nom'].";".
                                        $passVar['usu_nom'].";".
                                        $passVar['usu_ape'].";".
                                        $passVar['con_val'];
                }
            }
            $datos_clientes = explode("%%", $strTotalRegistros);
            $num_clientes=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }

    public function srvMostrarPagosArriendo (&$datos_clientes, &$num_clientes)
    {
        $qry= "select cli_ide, cli_nom, count(con_val) As tot_cont, SUM(con_val) As tot_valor ".
            "from cliente inner join contrato ".
            "where cliente.cli_ide = contrato.fk_cli_ide AND contrato.con_tip=2 AND contrato.con_est=1 ".
            "group by cli_ide;";
        if(!$this->bdatos->connectTo())
                return CodRes::NO_CONNECTED;
        $link= $this->bdatos->executeQry($qry, $numrows);if($numrows>=1)
        {
            $strTotalRegistros="";
            $strTotalIds="";
            for ($i=0;$i<$numrows;$i++)
            {
                $passVar = $this->bdatos->_fetch_assoc($link);
                //////echo $passVar;
                if($i==0)
                {
                    $strTotalRegistros=$passVar['cli_ide'].";".
                                        $passVar['cli_nom'].";".
                                        $passVar['tot_cont'].";".
                                        $passVar['tot_valor'];
                }
                else
                {
                    $strTotalRegistros = $strTotalRegistros."%%".$passVar['cli_ide'].";".
                                        $passVar['cli_nom'].";".
                                        $passVar['tot_cont'].";".
                                        $passVar['tot_valor'];
                }
            }
            $datos_clientes = explode("%%", $strTotalRegistros);
            $num_clientes=$numrows;
            $this->bdatos->close();
            return CodRes::EXITO;
        }
        else
        {
            $this->bdatos->close();
            return CodRes::SIN_REGISTROS;
        }
    }
}

?>
