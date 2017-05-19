<?php
    include_once("../ctrl/security.php");
    include_once("CodRes.php");
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HtmlGenerator
 *
 * @author Agustin
 */
class HtmlGenerator 
{
    //put your code here
    static private $instance;
    private function  __construct() 
    {        
    }
    static public function getInstance()
    {
        if(self::$instance==NULL)
            self::$instance= new HtmlGenerator();
        return self::$instance;           
    }
    public function imprimirEncabezado($title)
    {
            print "<table class='basic_header' id='basic_header1' >".
            	 "<tr>".
            	 "<th class='field_logo' rowspan='3'>".
            	 "<a href='../pages/home.php'> <img src='../files/inmosys_60x120.png' width='150' height='60' alt='SoporteOnline' longdesc='../index.php' /></a>".
            	 "</th>".
            	 "<th class='titulo' rowspan='3'>".
            	 "Inmosys::".$title.
            	 "</th>".
            	 "<th class='field_user' >Usuario: ".
            	 "</th>".
            	 "<th class='field_user' ><div align='center'>".$_SESSION['username']."-".$_SESSION['sessId']."</div>".
            	 "</th>".
            	 "</tr>".           
            	 "</td>".
            	 "<tr class='alt'>".
            	 //"<td class='icons' colspan='2'><input type='text' readonly='readonly' value='".date("m.d.y - g:i:s")."' size='20'>".
                    "<td class='icons' colspan='2'><input type='text' readonly='readonly' value='".date("y-m-d")."' size='20'>".
            	 "</td>".
            	 "</tr>".
            	 "<tr class='alt'> ".
            	 "<td class='date_field' colspan= '2'>".
            	 "<div align='right'>".
                    "<table>".
                        "<tr>".
                            "<td>".
                                "<a href='../forms/pass_reset.php'> <img src='../files/images/pass.gif' width='20' height='20' alt='cambiar contraseña' class='image'/> </a>".
                            "</td>".
                            "<td>".
                                "<a href='../pages/home.php'> <img src='../files/images/home.PNG' width='20' height='20' alt='home' class='image'/> </a>".
                            "</td>".
                            "<td>".
                                "<a href='../pages/logout.php'> <img src='../files/images/logout.png' width='20' height='20' alt='logout' class='image'/></a></td></tr></table></div>".
                            "</td>".
            	 "</tr>".
            	 "</table></table>";
    }

    public function imprimirModuloEncabezado($title)
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_cliente.js");
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("Nuevo Cliente");
        print "</head><body>";
        print "<table class='basic_header' id='basic_header1' >".
            	 "<tr>".
            	 "<th class='field_logo' rowspan='3'>".
            	 "<a href='../pages/modulo_home.php'  target ='fr_ppal'> <img src='../files/inmosys_60x120.png' width='120' height='60' alt='Inmosys'  /></a>".
            	 "</th>".
            	 "<th class='titulo' rowspan='3'>".
            	 "Inmosys".
            	 "</th>".
            	 "<th class='field_user' >Usuario: ".
            	 "</th>".
            	 "<th class='field_user' ><div align='center'>".$_SESSION['username']."</div>".
            	 "</th>".
            	 "</tr>".
            	 "</td>".
            	 "<tr class='alt'>".
            	 "<td class='icons' colspan='2'><input type='text' readonly='readonly' value='".date("m.d.y - g:i:s")."' size='20'>".
                //"<td class='icons' colspan='2'><input type='text' readonly='readonly' value='".date("Y-m")."' size='20'>".
            	 "</td>".
            	 "</tr>".
            	 "<tr class='alt'> ".
            	 "<td class='date_field' colspan= '2'>".
            	 "<div align='right'>".
                    "<table>".
                        "<tr>".
                            "<td>".
                                "<a href='../forms/pass_reset.php' target ='fr_ppal' > <img src='../files/images/pass.gif' width='20' height='20' alt='cambiar contraseña' class='image'/> </a>".
                            "</td>".
                            "<td>".
                                "<a href='../pages/modulo_home.php' target ='fr_ppal' > <img src='../files/images/home.PNG' width='20' height='20' alt='home' class='image'/> </a>".
                            "</td>".
                            "<td>".
                                "<a href='../pages/logout.php' target ='_top' > <img src='../files/images/logout.png' width='20' height='20' alt='logout' class='image'/></a></td></tr></table></div>".
                            "</td>".
            	 "</tr>".
            	 "</table>".
        "</table></html>";
    }
    private function obtenerComboF($id, $tiposDoc, $cantTipos, $ids_doc,$fonchange)
    {
        $combo="";
        $combo= "<select id='".$id."' name='".$id."' onchange=\"".$fonchange."\">";    
        if($cantTipos==0)
        {
            $combo=$combo."<option value='-1'>-Sin Registros-</option>";
        }
        else
        {
            for($i=0;$i<$cantTipos;$i++)
            {
                if($i==0)
                {
                    $combo=$combo."<option value='-1'>-Seleccione-</option>";
                }
                $combo=$combo."<option value='".$ids_doc[$i]."'>".$tiposDoc[$i]."</option>";
            }
        }
        $combo=$combo."</select>";
        return $combo;
    }
 private function obtenerComboF1($id, $tiposDoc, $cantTipos, $ids_doc,$fonchange, $size)
    {
        $combo="";
        $combo= "<select id='".$id."' name='".$id."' onchange=\"".$fonchange."\" size=\"".$size."\">";
        if($cantTipos==0)
        {
            $combo=$combo."<option value='-1'>-Sin Registros-</option>";
        }
        else
        {
            for($i=0;$i<$cantTipos;$i++)
            {
                if($i==0)
                {
                    $combo=$combo."<option value='-1'>---</option>";
                }
                $combo=$combo."<option value='".$ids_doc[$i]."'>".$tiposDoc[$i]."</option>";
            }
        }
        $combo=$combo."</select>";
        return $combo;
    }
    private function obtenerCombo($id, $tiposDoc, $cantTipos, $ids_doc)
    {
        $combo="";
        $combo= "<select id='".$id."' name='".$id."' onchange=''>";    
        if($cantTipos==0)
        {
            $combo=$combo."<option value='-1'>-Sin Registros-</option>";
        }
        else
        {
            for($i=0;$i<$cantTipos;$i++)
            {
                if($i==0)
                {
                    $combo=$combo."<option value='-1'>-Seleccione-</option>";
                }
                $combo=$combo."<option value='".$ids_doc[$i]."'>".$tiposDoc[$i]."</option>";
            }
        }
        $combo=$combo."</select>";
        return $combo;
    }
    
    private function obtenerComboClientes($id, $tiposDoc, $cantTipos)
    {
        $combo="";
        $combo= "<select id='".$id."' name='".$id."'>";    
        if($cantTipos==0)
        {
            $combo=$combo."<option value='-1'>-Sin Registros-</option>";
        }
        else
        {
            for($i=0;$i<$cantTipos;$i++)
            {
                if($i==0)
                {
                    $combo=$combo."<option value='-1'>-Seleccione-</option>";
                }
                $combo=$combo."<option value='".$tiposDoc[$i]."'>".$tiposDoc[$i]."</option>";
            }
        }
        $combo=$combo."</select>";
        return $combo;
    }

    public function imprimirMostrarFormularioCliente($id_r, $datos_r, $cant_r, $fonblur, $fonchange)
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_cliente.js");
        $this->imprimirLinkJavascript("../libs/jquery.js");
        $this->imprimirLinkJavascript("../libs/dhtmlgoodies_calendar.js");
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/dhtmlgoodies_calendar.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("Nuevo Cliente");
        print "</head><body onload=apagarJuri()>";
        print "<table class='basic_header' id='basic_header1' >"
            ."<div aling='center'id='marco'>"
            ."<form name='crear_cliente' method='POST' action='../Vista/form_processor.php'>".
            "<table class='ppal' align='center'>".
            "<tr>".
            "</tr>".
            "<tr>".
            "<td>".
            "<table class='tabla_cliente' id='tabla_cliente' summary='Nuevo Cliente'>".
            "  <caption> ".
            "    Nuevo Cliente".
            "  </caption>".
            "      <tr class='r2'>".
            "        <td>Tipo Cliente:</td>".
            "        <td>".$this->obtenerRadio($id_r, $datos_r, $cant_r, $fonblur, $fonchange)."</td>".
            "        <td>No. Doc:</td>".
            "        <td><input type='text' id='cedula_cliente' name='cedula_cliente' onkeypress='return soloNumerosTelefonicos(event)' maxlength='15'></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td >Nombre:</td>".
            "        <td ><input type='text'  id='nombre_cliente' name='nombre_cliente' onkeypress='return soloLetrasNombre(event)' maxlength='15'></td>".
            "           <td>E-mail:</td>".
            "           <td><input type='text' id='email_cliente' name='email_cliente' maxlength='40'></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td>No. Telefono:</td>".
            "        <td><input type='text' id='telf_cliente' name='telf_cliente' onkeypress='return soloNumerosTelefonicos(event)' maxlength='7'></td>".
            "        <td>No. Celular:</td>".
            "        <td><input type='text' id='telc_cliente' name='telc_cliente' onkeypress='return soloNumerosTelefonicos(event)' maxlength='10'></td>".
            "      </tr>".
                "<tr class='r2'>".
                    "<td colspan='4'>".
                        "<div id='div_nat'>".
                            "<table class='tabla_cliente1' id='tabla_cliente1' >".
                                    "<tr class='r2'>".
                                        "<td>".
                                            "Apellido:".
                                        "</td>".
                                        "<td>".
                                            "<input type='text'  id='apellido_cliente' name='apellido_cliente' onkeypress='return soloLetrasNombre(event)' maxlength='15'>".
                                        "</td>".
                                        "<td>".
                                            "Genero:".
                                        "</td>".
                                        "<td>".
                                            "<input type='radio' id='sexo_f' name='sexo_cliente' value='F' onchange='actualizarGenero(this,document.crear_cliente.genero_cliente)' onblur='actualizarGenero(this,document.crear_cliente.genero_cliente)'>F".
                                            "<input type='radio' id='sexo_m' name='sexo_cliente' value='M' onchange='actualizarGenero(this,document.crear_cliente.genero_cliente)' onblur='actualizarGenero(this,document.crear_cliente.genero_cliente)'>M".
                                        "</td>".
                                    "</tr>".
                                    "<tr class='r2'>".
                                        "<td>".
                                            "FECHA NACIMIENTO:".
                                        "</td>".
                                        "<td>".
                                            "<input type='text'  id='fnac_cliente' name='fnac_cliente' readonly='readonly' value='".date("Y-m-d")."'>".
                                            "<a href=\"javascript:displayCalendar(document.getElementById('fnac_cliente'),'yyyy-mm-dd',document.getElementById('img_calendar'))\"> <img  id='img_calendar' src='../files/images/calendar.png' width='20' height='20' class='image'/></a>".
                                        "</td>".
                                    "</tr>".
                            "</table>".
                        "</div>".
                        "<div id='div_juri'  style='visibility:hidden'>".
                            "<table class='tabla_cliente1' id='tabla_cliente2'>".
                                "<tr class='r2'>".
                                    "<td>".
                                        "Página WEB:".
                                    "</td>".
                                    "<td>".
                                        "<input type='text' id='dirweb_cliente' name='dirweb_cliente' size='50' maxlength='50'>".
                                    "</td>".
                                "</tr>".
                            "</table>".
                        "</div>".
                    "</td>".
                "</tr>".
            "      <tr class='raction'>".
            "        <td colspan='2'><input  class='but2' type='reset' value='Borrar'></td>".
            "        <td colspan='2'><input  class='but' type='button' onclick='validar_cliente()' value='Crear'></td>".
            "      </tr>".
            "</table>".
            "  </td>".
            "  </tr>".
            "</table>".
            "<table class='hidden_items'> ".
            "<tr>".
            "	<td>    ".                
            "        <td colspan='2'><input  type='text' id='form_type' name='form_type' value='cliente' readonly='readonly'></td>".
            "        <td colspan='2'><input  type='text' id='genero_cliente' name='genero_cliente' value='' readonly='readonly'></td>".
            "        <td colspan='2'><input  type='text' id='tipo_persona' name='tipo_persona' value='' readonly='readonly'></td>".
            "        <td colspan='2'><input  class='but' type='submit' id='send_form' value='Submit'></td>".
            "    </td>".
            "</tr>".
            "</table>".
            "</form>".
            "</div>".
            "</body></html>";
    }

    public function imprimirMostrarFormularioClienteJM($datos_r)
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_cliente.js");
        $this->imprimirLinkJavascript("../libs/jquery.js");
        $this->imprimirLinkJavascript("../libs/dhtmlgoodies_calendar.js");
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/dhtmlgoodies_calendar.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("Nuevo Cliente");
        print "</head><body onload=apagarJuri()>";
        print "<table class='basic_header' id='basic_header1' >"."<div aling='center'id='marco'>"."<form name='modif_clienteJ' method='POST' action='../Vista/form_processor.php'>".
            "<table class='ppal' align='center'>".
            "<tr>".
            "</tr>".
            "<tr>".
            "<td>".
            "<table class='tabla_cliente' id='tabla_cliente' summary='Nuevo Cliente'>".
            "  <caption> ".
            "    MODIFICAR CLIENTE - EMPRESA".
            "  </caption>".
            "      <tr class='r2'>".
            "        <td>Tipo Cliente:</td>".
            "        <td>JURIDICO</td>".
            "        <td>No. NIT:</td>".
            "        <td>".$datos_r[0]."</td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td >Nombre:</td><td >".$datos_r[1]."</td>".
            "           <td>E-mail:</td>".
            "           <td><input type='text' id='email_cliente' name='email_cliente' value='".$datos_r[2]."' maxlength='40'></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td>No. Telefono:</td>".
            "        <td><input type='text' id='telf_cliente' name='telf_cliente' value='".$datos_r[3]."' onkeypress='return soloNumerosTelefonicos(event)' maxlength='7'></td>".
            "        <td>No. Celular:</td>".
            "        <td><input type='text' id='telc_cliente' name='telc_cliente' value='".$datos_r[4]."' onkeypress='return soloNumerosTelefonicos(event)' maxlength='10'></td>".
            "      </tr>".
                "<tr class='r2'>".
                       
                                "<tr class='r2'>".
                                    "<td>".
                                        "Página WEB:".
                                    "</td>".
                                    "<td colspan='3'>".
                                        "<input type='text' id='dirweb_cliente' name='dirweb_cliente' value='".$datos_r[5]."' maxlength='50' size='50'>".
                                    "</td>".
                                "</tr>".
                "</tr>".
            "      <tr class='raction'>".
            "        <td colspan='2'><input  class='but2' type='reset' value='Borrar'></td>".
            "        <td colspan='2'><input  class='but' type='button' onclick='validar_clienteJ()' value='Actualizar'></td>".
            "      </tr>".
            "</table>".
            "  </td>".
            "  </tr>".
            "</table>".
            "<table class='hidden_items'> ".
            "<tr>".
            "	<td>    ".
            "        <td colspan='2'><input  type='text' id='form_type' name='form_type' value='modif_clienteJ' readonly='readonly'></td>".
                    "<td><input type='text' id='ced_cliente' name='ced_cliente'  value='".$datos_r[0]."' ></td>".
            "        <td colspan='2'><input  class='but' type='submit' id='send_form' value='Submit'></td>".
            "    </td>".
            "</tr>".
            "</table>".
            "</form>".
            "</div>".
            "</body></html>";
    }
    public function imprimirMostrarFormularioClienteM($datos_r)
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_cliente.js");
        $this->imprimirLinkJavascript("../libs/jquery.js");
        $this->imprimirLinkJavascript("../libs/dhtmlgoodies_calendar.js");
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/dhtmlgoodies_calendar.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("Modificar Cliente");
        print "</head><body onload=apagarJuri()>";
        print "<table class='basic_header' id='basic_header1' >"."<div aling='center'id='marco'>"."<form name='modif_cliente' method='POST' action='../Vista/form_processor.php'>".
            "<table class='ppal' align='center'>".
            "<tr>".
            "</tr>".
            "<tr>".
            "<td>".
            "<table class='tabla_cliente' id='tabla_cliente' summary='Nuevo Cliente'>".
            "  <caption> ".
            "    Modificar Cliente".
            "  </caption>".
            "      <tr class='r2'>".
            "        <td>Tipo Cliente:</td>".
            "        <td>Natural</td>".
            "        <td>No. Doc:</td>".
            "        <td>".$datos_r[0]."</td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td >Nombre:</td>".
            "        <td >".$datos_r[1]."</td>".
                    "<td>".
                        "Apellido:".
                    "</td>".
                    "<td>".$datos_r[5]."</td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td>No. Telefono:</td>".
            "        <td><input type='text' id='telf_cliente' name='telf_cliente' value='".$datos_r[3]."' onkeypress='return soloNumerosTelefonicos(event)' maxlength='7'></td>".
            "        <td>No. Celular:</td>".
            "        <td><input type='text' id='telc_cliente' name='telc_cliente' value='".$datos_r[4]."' onkeypress='return soloNumerosTelefonicos(event)' maxlength='10'></td>".
            "      </tr>".
                "<tr class='r2'>".
            "           <td>E-mail:</td>".
            "           <td><input type='text' id='email_cliente' name='email_cliente' value='".$datos_r[2]."' maxlength='40'></td>".
                    "<td>".
                        "Genero:".
                    "</td>".
                    "<td>".$datos_r[6]."</td>".
                "</tr>".
                "<tr class='r2'>".
                    "<td>"."FECHA NACIMIENTO:</td>".
                    "<td colspan='3'>".$datos_r[7]."</td>".
                "</tr>".
            "      <tr class='raction'>".
            "        <td colspan='2'><input  class='but2' type='reset' value='Borrar'></td>".
            "        <td colspan='2'><input  class='but' type='button' onclick='validar_clienteM()' value='Actualizar'></td>".
            "      </tr>".
            "</table>".
            "  </td>".
            "  </tr>".
            "</table>".
            "<table class='hidden_items'> ".
            "<tr>".
            "	<td>    ".
            "        <td colspan='2'><input  type='text' id='form_type' name='form_type' value='modif_cliente' readonly='readonly'></td>".
            "        <td colspan='2'><input  type='text' id='ced_cliente' name='ced_cliente' value='".$datos_r[0]."' readonly='readonly'></td>".
            "        <td colspan='2'><input  class='but' type='submit' id='send_form' value='Submit'></td>".
            "    </td>".
            "</tr>".
            "</table>".
            "</form>".
            "</div>".
            "</body></html>";
    }
    public function imprimirMostrarFormularioContrato($idsP, $nomP, $cantP, $idsI, $nomI, $cantI, $idsV, $nomV, $cantV, $numCon)
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_contrato.js");
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        $this->imprimirLinkJavascript("../libs/dhtmlgoodies_calendar.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/dhtmlgoodies_calendar.css");
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("Nuevo Contrato");
        $nomTipoA=explode("%%", "Venta%%Arrendamiento");
        $idTipoA=explode("%%", "1%%2");
        print "</head><body>";
        print "<table class='basic_header' id='basic_header1' >"."<div aling='center'id='marco'>"."<form name='crear_contrato' method='POST' action='../Vista/form_processor.php' >".
            "<table class='ppal' align='center'>".
            "<tr>".
            "</tr>".
            "<tr>".
            "<td>".
            "<table class='tabla_cliente' id='tabla_cliente' summary='Nuevo Usuario'>".
            "  <caption> ".
            "    Nuevo Contrato".
            "  </caption>".
            "      <tr class='r2'>".
            "        <td >Tipo Contrato:</td>".
            "        <td >".$this->obtenerComboF("tipo_contrato", $nomTipoA, 2, $idTipoA,"cambiarTextoArrendamiento(this)")."</td>".
            "        <td >No. Contrato:</td>".
            "        <td ><input type='text'  value ='0000".($numCon)."' id='num_con' name='num_con' readonly='readonly'></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td >No. Matricula Inmueble:</td>".
            "        <td >".$this->obtenerComboF("id_inmueble", $nomI, $cantI, $idsI,"copiarValorCampo(this,id_inm)")."</td>".
            "        <td >No. Documento Cliente:</td>".
            "        <td >".$this->obtenerComboF("id_cliente", $nomP, $cantP, $idsP,"copiarValorCampo(this,id_cli)")."</td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td>Fecha Inicio Contrato:</td>".
                "        <td><input type='text' id='fechaini_contrato' name='fechaini_contrato'   value='---'  readonly='readonly'>".
                            "<a href=\"javascript:displayCalendar(document.getElementById('fechaini_contrato'),'yyyy-mm-dd',document.getElementById('img_calendar1'))\"> <img id='img_calendar1' src='../files/images/calendar.png' width='20' height='20' class='image'/></a>"."</td>".
            "        <td>Fecha Fin Contrato:</td>".
                "        <td><input type='text' id='fechafin_contrato' name='fechafin_contrato'   value='---'  readonly='readonly'>".
                            "<a href=\"javascript:displayCalendar(document.getElementById('fechafin_contrato'),'yyyy-mm-dd',document.getElementById('img_calendar2'))\"> <img id='img_calendar2' src='../files/images/calendar.png' width='20' height='20' class='image'/></a>"."</td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td ><div id='txt_arr'>Valor Contrato:</div></td>".
            "        <td ><input type='text'  id='val_cont' name='val_cont' maxlength='8' onkeypress='return soloNumerosArea(event)' onblur='corregirCampo(this)'></td>".
            "        <td >Vendedor:</td>".
            "        <td >".$this->obtenerComboF("id_vendedor", $nomV, $cantV, $idsV,"copiarValorCampo(this,id_vend)")."</td>".
            "      </tr>".
            "      <tr class='raction'>".
            "        <td colspan='2'><input  id='borrar_campos' class='but2' type='reset' value='Borrar' name='borrar_campos'></td>".
            "        <td colspan='2'><input  class='but' type='button' onclick='validar_contrato()' value='Crear'></td>".
            "      </tr>".
            "</table>".
            "  </td>".
            "  </tr>".
            "</table>".
            "<table class='hidden_items'> ".
            "<tr>".
            "	<td>    ".
            "        <td colspan='2'><input  type='text' id='form_type' name='form_type' value='crear_contrato' readonly='readonly'></td>".
            "        <td colspan='2'><input  type='text' id='id_cli' name='id_cli' value='' readonly='readonly'></td>".
            "        <td colspan='2'><input  type='text' id='id_inm' name='id_inm' value='' readonly='readonly'></td>".
            "        <td colspan='2'><input  type='text' id='id_vend' name='id_vend' value='-1' readonly='readonly'></td>".
            "        <td colspan='2'><input  type='text' id='tipo_cont' name='tipo_cont' value='' readonly='readonly'></td>".
            "        <td colspan='2'><input  class='but' type='submit' id='send_form' value='Submit'></td>".
            "    </td>".
            "</tr>".
            "</table>".
            "</form></div>".
            "</body></html>";
    }
    
    public function imprimirMostrarFormularioCesionContrato($idsP, $nomP, $cantP, $idsI, $nomI, $cantI)
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_contrato.js");
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        $this->imprimirLinkJavascript("../libs/dhtmlgoodies_calendar.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/dhtmlgoodies_calendar.css");
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("Nuevo Contrato");
        $nomTipoA=explode("%%", "Venta%%Arrendamiento");
        $idTipoA=explode("%%", "1%%2");
        print "</head><body>";
        print "<table class='basic_header' id='basic_header1' >"."<div aling='center'id='marco'>"."<form name='crear_cesion_contrato' method='POST' action='../Vista/form_processor.php' >".
            "<table class='ppal' align='center'>".
            "<tr>".
            "</tr>".
            "<tr>".
            "<td>".
            "<table class='tabla_cliente' id='tabla_cliente' summary='Nuevo Usuario'>".
            "  <caption> ".
            "    Cesion de Contrato".
            "  </caption>".
            "      <tr class='r2'>".
            "        <td >Tipo Contrato:</td>".
            "        <td >ARRENDAMIENTO</td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td >No. Contrato:</td>".
            "        <td ><input type='text'  value ='0000' id='num_con' name='num_con' readonly='readonly'></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td >No. Matricula Inmueble:</td>".
            "        <td >".$this->obtenerComboF("id_inmueble", $nomI, $cantI, $idsI,"copiarValorCampo(this,id_inm);copiarValorCampo(this, document.getElementById('num_con'))")."</td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td >No. Documento Cliente:</td>".
            "        <td >".$this->obtenerComboF("id_cliente", $nomP, $cantP, $idsP,"copiarValorCampo(this,id_cli)")."</td>".
            "      </tr>".
            "      <tr class='raction'>".
            "        <td ><input  id='borrar_campos' class='but2' type='reset' value='Borrar' name='borrar_campos'></td>".
            "        <td ><input  class='but' type='button' onclick='validar_cesion_contrato()' value='Crear'></td>".
            "      </tr>".
            "</table>".
            "  </td>".
            "  </tr>".
            "</table>".
            "<table class='hidden_items'> ".
            "<tr>".
            "	<td>    ".
            "        <td colspan='2'><input  type='text' id='form_type' name='form_type' value='crear_cesion_contrato' readonly='readonly'></td>".
            "        <td colspan='2'><input  type='text' id='id_cli' name='id_cli' value='' readonly='readonly'></td>".
            "        <td colspan='2'><input  type='text' id='id_inm' name='id_inm' value='' readonly='readonly'></td>".
            "        <td colspan='2'><input  class='but' type='submit' id='send_form' value='Submit'></td>".
            "    </td>".
            "</tr>".
            "</table>".
            "</form></div>".
            "</body></html>";
    }

    public function imprimirMostrarFormularioUsuario()
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_usuario.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("Nuevo Usuario");
        print "</head><body onload=limpiar_campos()>";
        print "<table class='basic_header' id='basic_header1' >"."<div aling='center'id='marco'>"."<form name='crear_usuario' method='POST' action='../Vista/form_processor.php' >".
            "<table class='ppal' align='center'>".
            "<tr>".
            "</tr>".
            "<tr>".
            "<td>".
            "<table class='tabla_cliente' id='tabla_cliente' summary='Nuevo Usuario'>".
            "  <caption> ".
            "    Nuevo Usuario".
            "  </caption>".
            "      <tr class='r2'>".
            "        <td >Nombre Usuario:</td>".
            "        <td colspan='3'><input type='text'  id='nombre_usuario' name='nombre_usuario' ></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td>Clave:</td>".
            "        <td colspan='3'><input type='password' id='password_usuario' name='password_usuario'></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td>Confirmación:</td>".
            "        <td colspan='3'><input type='password' id='password_usuario_1' name='password_usuario_1'></td>".
            "      </tr>".
            "      <tr class='raction'>".
            "        <td colspan='2'><input  id='borrar_campos' class='but2' type='reset' value='Borrar' name='borrar_campos'></td>".
            "        <td colspan='2'><input  class='but' type='button' onclick='validar_usuario()' value='Crear'></td>".
            "      </tr>".
            "</table>".
            "  </td>".
            "  </tr>".
            "</table>".
            "<table class='hidden_items'> ".
            "<tr>".
            "	<td>    ".
            "        <td colspan='2'><input  type='text' id='form_type' name='form_type' value='crear_usuario'></td>".
            "        <td colspan='2'><input  class='but' type='submit' id='send_form' value='Submit'></td>".
            "    </td>".
            "</tr>".
            "</table>".
            "</form></div>".
            "</body></html>";
    }


    public function imprimirMostrarFormularioModificarPassword()
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_usuario.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("Nuevo Usuario");
        print "</head><body onload=limpiar_campos()>";
        print "<table class='basic_header' id='basic_header1' >"."<div aling='center'id='marco'>"."<form name='crear_usuario' method='POST' action='../Vista/form_processor.php' >".
            "<table class='ppal' align='center'>".
            "<tr>".
            "</tr>".
            "<tr>".
            "<td>".
            "<table class='tabla_cliente' id='tabla_cliente' summary='Modificar Password'>".
            "  <caption> ".
            "    Modificar Password".
            "  </caption>".
            "      <tr class='r2'>".
            "        <td >Nombre Usuario:</td>".
            "        <td colspan='3'><input type='text'  id='nombre_usuario' name='nombre_usuario' value='".$_SESSION['username']."' readonly='readonly'></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td>Clave:</td>".
            "        <td colspan='3'><input type='password' id='password_usuario' name='password_usuario'></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td>Confirmación:</td>".
            "        <td colspan='3'><input type='password' id='password_usuario_1' name='password_usuario_1'></td>".
            "      </tr>".
            "      <tr class='raction'>".
            "        <td colspan='2'><input  id='borrar_campos' class='but2' type='reset' value='Borrar' name='borrar_campos'></td>".
            "        <td colspan='2'><input  class='but' type='button' onclick='validar_usuario()' value='Modificar'></td>".
            "      </tr>".
            "</table>".
            "  </td>".
            "  </tr>".
            "</table>".
            "<table class='hidden_items'> ".
            "<tr>".
            "	<td>    ".
            "        <td colspan='2'><input  type='text' id='form_type' name='form_type' value='modificar_password'></td>".
            "        <td colspan='2'><input  class='but' type='submit' id='send_form' value='Submit'></td>".
            "    </td>".
            "</tr>".
            "</table>".
            "</form></div>".
            "</body></html>";
    }

    public function imprimirMostrarFormularioEstadoCambios()
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_estado_cambios.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("Nuevo Estado Cambios");
        print "</head><body onload=limpiar_campos()>";
        print "<table class='basic_header' id='basic_header1' >"."<div aling='center'id='marco'>".
            "<form name='crear_estado_cambios' method='POST' action='../Vista/form_processor.php' >".
            "<table class='ppal' align='center'>".
            "<tr>".
            "</tr>".
            "<tr>".
            "<td>".
            "<table class='tabla_cliente' id='tabla_cliente' summary='Nuevo Usuario'>".
            "  <caption> ".
            "    Nuevo Estado Cambios".
            "  </caption>".
            "      <tr class='r2'>".
            "        <td >Nombre Estado:</td>".
            "        <td colspan='3'><input type='text'  id='nombre_estado' name='nombre_estado' ></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td>Descripcion:</td>".
            "        <td colspan='3'><textarea id='desc_estado' name='desc_estado' rows='2' cols='60'></textarea></td>".
            "      </tr>".
            "      <tr class='raction'>".
            "        <td colspan='2'><input  id='borrar_campos' class='but2' type='reset' value='Borrar' name='borrar_campos'></td>".
            "        <td colspan='2'><input  class='but' type='button' onclick='validar_estado_cambios()' value='Crear'></td>".
            "      </tr>".
            "</table>".
            "  </td>".
            "  </tr>".
            "</table>".
            "<table class='hidden_items'> ".
            "<tr>".
            "	<td>    ".
            "        <td colspan='2'><input  type='text' id='form_type' name='form_type' value='estado_cambios'></td>".
            "        <td colspan='2'><input  class='but' type='submit' id='send_form' value='Submit'></td>".
            "    </td>".
            "</tr>".
            "</table>".
            "</form>".
            "</div>".
            "</body></html>";
    }
    
    public function imprimirMostrarFormularioProducto($nom_tipoprod, $cant_tipoprod, $ids_tipoprod)
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_producto.js");
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        $this->imprimirLinkJavascript("../libs/jquery.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("Nuevo Producto");
        print "</head><body onload=limpiar_campos()>";
        print "<table class='basic_header' id='basic_header1' >"."<div aling='center'id='marco'>"."<form name='crear_producto' method='POST' action='../Vista/form_processor.php' >".
            "<table class='ppal' align='center'>".
            "<tr>".
            "</tr>".
            "<tr>".
            "<td>".
            "<table class='tabla_cliente' id='tabla_cliente' summary='Nuevo Usuario'>".
            "  <caption> ".
            "    Nuevo Producto".
            "  </caption>".
            "      <tr class='r2'>".
            "        <td >Nombre Producto:</td>".
            "        <td colspan='3'><input type='text'  id='nombre_producto' name='nombre_producto'></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td >Tipo Producto:</td>".
            "        <td colspan='3'>".$this->obtenerCombo("tipo_producto", $nom_tipoprod, $cant_tipoprod, $ids_tipoprod)."</td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td>Descripcion:</td>".
            "        <td colspan='3'><textarea id='desc_producto' name='desc_producto' rows='2' cols='60'></textarea></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td>Costo:</td>".
            "        <td colspan='3'><input type='text'  id='costo_producto' name='costo_producto' onkeypress='return soloNumeros(event)' onblur='corregirCampo(this)'></td>".
            "      </tr>".
            "      <tr class='raction'>".
            "        <td colspan='2'><input  id='borrar_campos' class='but2' type='reset' value='Borrar' name='borrar_campos'></td>".
            "        <td colspan='2'><input  class='but' type='button' onclick='validar_producto()' value='Crear'></td>".
            "      </tr>".
            "</table>".
            "  </td>".
            "  </tr>".
            "</table>".
            "<table class='hidden_items'> ".
            "<tr>".
            "	<td>    ".
            "        <td colspan='2'><input  type='text' id='form_type' name='form_type' value='producto'></td>".
            "        <td colspan='2'><input  type='text' id='id_tipoproducto' name='id_tipoproducto' value=''></td>".
            "        <td colspan='2'><input  class='but' type='submit' id='send_form' value='Submit'></td>".
            "    </td>".
            "</tr>".
            "</table>".
            "</form></div>".
            "</body></html>";
    }



    public function imprimirDoctype()
    {
        print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">".
                "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
    }
    public function tituloPagina($titleP)
    {
        print "<title>".$titleP."</title>";
    }
    public function imprimirLinkJavascript($linkJ)
    {
        print "<script type=\"text/javascript\" src='".$linkJ."'></script>";      
    }
    public function imprimirLinkCss($linkCss)
    {
        print "<link rel=\"stylesheet\" type=\"text/css\" href=\"".$linkCss."\" />";    
    }
    public function imprimirMenuHomeModulos()
    {
        print   "<html>";
        $this->tituloPagina("::INMOSYS::");
        print
                "<frameset rows='115,*'>".
                    "<frame src='../pages/encabezado.php' name='fr_encabezado' noresize='noresize'/>".
                    "<frameset cols='150,*'>".
                        "<frame src='../pages/menu_lateral.php'  name='fr_menu' noresize='noresize'/>".
                        "<frame src='../pages/modulo_home.php' name='fr_ppal' name='fr_ppal' noresize='noresize' />".
                    "</frameset>".
                "</frameset>".
                "</html>";
    }

    public function imprimirMenuDesplegable()
    {

        $this->imprimirDoctype();
        print "<head>";
        print 	"<SCRIPT type='text/javascript'>".
			"var myMenu;".
			"window.onload = function() {".
			" myMenu = new SDMenu('my_menu');".
			" myMenu.init();};".
		"</SCRIPT>";
        $this->imprimirLinkCss("../CSS/sdmenu.css");
        $this->imprimirLinkJavascript("../libs/sdmenu.js");
        print "</head>";
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        print "<body>".
                "<table><tr><td>".
                "<div style='float: left' id='my_menu' class='sdmenu'>".
                    "<div class='img'>".
                        "<span><a href=../pages/modulo_home.php target='fr_ppal' class=''>".
                        "<center>".
                            "<img src='../files/images/home.PNG' width='15' height='15'  border='0'>".
                        "</center>"."</a></span>".
                    "</div>".
                    "<div class='collapsed'>".
                            "<span>Inmuebles</span>".
                            "<a target='fr_ppal' href=../forms/tipo_inmueble.php>"."Crear Tipo Inmueble"."</a>".
                            "<a target='fr_ppal' href=../forms/inmueble.php>"."Crear Inmueble"."</a>".
                            "<a target='fr_ppal' href=../views/inmuebles.php>"."Inmuebles"."</a>".
                            "<a target='fr_ppal' href=../views/tipos_inmueble.php>"."Tipos Inmueble"."</a>".
                            "<a target='fr_ppal' href=../forms/devolver_inmueble.php>"."Devolver Inmueble"."</a>".
                            "<a target='fr_ppal' href=../views/estado_inmuebles.php>"."Movimientos Inmuebles"."</a>".
                    "</div>".
                    "<div class='img'>".
                        "<span><a href=../pages/administracion.php target='fr_ppal' >".
                          "<center><img src='../files/images/settings.jpg' width='15' height='15'  border='0'></center></a></span>".
                    "</div>".
                    "<div class='collapsed'>".
                            "<span>Usuarios</span>".
                            "<a target='fr_ppal' href=../forms/usuario.php>Crear Usuario</a>".
                            "<a target='fr_ppal' href=../views/usuarios.php>"."Usuarios"."</a>".
                    "</div>".
                    "<div class='collapsed'>".
                            "<span>Ubicacion</span>".
                            "<a target='fr_ppal' href=../forms/pais.php>"."Crear Pais"."</a>".
                            "<a target='fr_ppal' href=../forms/departamento.php>"."Crear Departamento"."</a>".
                            "<a target='fr_ppal' href=../forms/ciudad.php>"."Crear Ciudad"."</a>".
                            "<a target='fr_ppal' href=../forms/sucursal.php>"."Crear Sucursal"."</a>".
                            "<a target='fr_ppal' href=../views/paises.php>"."Paises"."</a>".
                            "<a target='fr_ppal' href=../views/departamentos.php>"."Departamentos"."</a>".
                            "<a target='fr_ppal' href=../views/ciudades.php>"."Ciudades"."</a>".
                            "<a target='fr_ppal' href=../views/sucursales.php>"."Sucursales"."</a>".
                    "</div>".
                    "<div class='collapsed'>".
                            "<span>Vendedores</span>".
                            "<a target='fr_ppal' href=../forms/vendedor.php>"."Crear Vendedor"."</a>".
                            "<a target='fr_ppal' href=../views/vendedores.php>"."Vendedores"."</a>".
                    "</div>".
                    "<div class='img'>".
                        "<span><a href=../views/contratos.php target='fr_ppal' class=''>".
                        "<center>".
                            "<img src='../files/images/reportes.jpeg' width='15' height='15'  border='0'>".
                        "</center>"."</a></span>".
                    "</div>".
                    "<div class='collapsed'>".
                            "<span>Reportes</span>".
                            "<a target='fr_ppal' href=../views/reportes_usuarios.php>"."Reportes de Vendedores"."</a>".
                            "<a target='fr_ppal' href=../views/reportes_clientes.php>"."Reportes de clientes"."</a>".
                            "<a target='fr_ppal' href=../views/reportes_inmuebles.php>"."Reportes de inmuebles"."</a>".
                            "<a target='fr_ppal' href=../views/reportes_contratos.php>"."Reportes de contratos"."</a>".
                    "</div>".
                    "<div class='img'>".
                        "<span><a href=../views/pagos.php target='fr_ppal' class=''>".
                        "<center>".
                            "<img src='../files/images/pagos.jpg' width='15' height='15'  border='0'>".
                        "</center>"."</a></span>".
                    "</div>".
                    "<div class='collapsed'>".
                        "<span>Contratos</span>".
                        "<a target='fr_ppal' href=../forms/contrato.php>"."Crear Contrato"."</a>".
                        "<a target='fr_ppal' href=../forms/cesion_contrato.php>"."Cesión Contrato"."</a>".
                        "<a target='fr_ppal' href=../views/cambios_contrato.php>"."Cambios Contrato"."</a>".
                        "<a target='fr_ppal' href=../views/contratos.php>"."Contratos"."</a>".
                    "</div>".
                    "<div class='collapsed'>".
                        "<span>Control Pagos</span>".
                        "<a target='fr_ppal' href=../forms/pago.php>"."Recibir Arriendo"."</a>".
                        "<a target='fr_ppal' href=../forms/pago_arriendo.php>"."Pagar Arriendo"."</a>".
                        "<a target='fr_ppal' href=../views/pagos.php>"."Pagos"."</a>".
                            "<a target='fr_ppal' href=../forms/factura.php>"."Generar Factura Arriendo"."</a>".
                    "</div>".
                    "<div class='img'>".
                        "<span><a href=../phpjobscheduler/pjsfiles/ target='fr_ppal' >".
                          "<center><img src='../files/images/clock.jpg' width='15' height='15'  border='0'></center></a></span>".
                    "</div>".
                    "<div class='collapsed'>".
                            "<span>Calendarizacion</span>".
                            "<a target='fr_ppal' href=../phpjobscheduler/pjsfiles/?add=1>"."Crear Tarea"."</a>".
                            "<a target='fr_ppal' href=../phpjobscheduler/pjsfiles/>"."Tareas"."</a>".
                            "<a target='fr_ppal' href=../phpjobscheduler/pjsfiles/error-logs.php>"."Errores"."</a>".
                    "</div>".
                    "<div class='img'>".
                        "<span><a href=../views/clientes.php target='fr_ppal' >".
                          "<center><img src='../files/images/clientes.gif' width='15' height='15'  border='0'></center></a></span>".
                    "</div>".
                    "<div class='collapsed'>".
                            "<span>Clientes</span>".
                            "<a target='fr_ppal' href=../forms/cliente.php>"."Crear Cliente"."</a>".
                            "<a target='fr_ppal' href=../views/clientes.php>"."Clientes"."</a>".
                            "<a target='fr_ppal' href=../views/juridicos.php>"."Empresas"."</a>".
                    "</div>".
                "</div>".
                "</td></tr>".
                "<tr><td>".
                "</td></tr></table>".
                    
        "</body>".
        "</html>";
    }
    public function imprimirModuloHome()
    { 

        $this->imprimirDoctype(); print "<head>";
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        print "</head>";
         print "<body>".
                "<br><div align='center'><table id=menu>".
                "<tr>".
                    "<td>".
                        "<p><a href='../forms/cliente.php'>Nuevo Cliente</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/clientes.php'>Clientes</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/clientes.php'><img src='../files/images/clientes.gif' width='25' height='25' alt='clientes' class='image'/></a></p>".
                    "</td>".
                "</tr>".
                "<tr class='alt'>".
                    "<td>".
                         "<p><a href='../forms/vendedor.php'>Nuevo Vendedor</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/vendedores.php'>Vendedores</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/vendedores.php'><img src='../files/images/tecnicos.gif' width='25' height='25' alt='tecnicos' class='image'/></a></p>".
                    "</td>".
                "</tr>".
                "<tr>".
                    "<td>".
                         "<p><a href='../forms/contrato.php'>Nuevo Contrato</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/contratos.php'>Contratos</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/contratos.php'><img src='../files/images/solicitudes.gif' width='25' height='25' alt='solicitudes' class='image'/></a></p>".
                    "</td>".
                "</tr>".
                "<tr class='alt'>".
                    "<td>".
                        "<p><a href='../forms/inmueble.php'>Nuevo Inmuebles</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/inmuebles.php'>Inmuebles</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/inmuebles.php'><img src='../files/images/orden_trabajo.gif' width='25' height='25' alt='orden de Trabajo' class='image'/></a></p>".
                    "</td>".
                "</tr>".
                "<tr>".
                    "<td>".
                        "<p><a href='../forms/cesion_contrato.php'>Nueva Cesion de contrato</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/cambios_contrato.php'>Cambios Contrato</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/cambios_contrato.php'><img src='../files/images/evaluaciones.gif' width='25' height='25' alt='evaluaciones' class='image'/></a></p>".
                    "</td>".
                "</tr>".
                "<tr class='alt'>".
                    "<td>"."<p><a href='../forms/pago.php'>Recibir Arriendo</a></p>"."</td>".
                    "<td>".
                        "<p><a href='../views/pagos.php'>Pagos</a></p>".
                    "</td>".
                    "<td>"."<p><a href='../views/reclamos.php'><img src='../files/images/reclamos.gif' width='25' height='25' alt='reclamos' class='image'/></a></p>"."</td>".
                "</tr>".
                "<tr>".
                    "<td>".
                        "<p><a href='../forms/pago_arriendo.php'>Pagar Arriendo Propietarios</a></p>".
                    "</td>".
                    "<td>"."<a href='../forms/factura.php'>Generar Factura Arriendo</a></p>"."</td>".
                    "<td>".
                        "<p><a href='../views/pagos.php'><img src='../files/images/facturas.gif' width='25' height='25' alt='orden de Trabajo' class='image'/></a></p>".
                    "</td>".
                "</tr>".
                "<tr class='alt'>".
                    "<td>&nbsp".
                        
                    "</td>".
                    "<td>".
                        "<p><a href='../pages/administracion.php'>Administracion</p>".
                    "</td>".
                    "<td>".
                        "<p><a target='_top' href='logout.php'>Cerrar Sesion</a></p>".
                    "</td>".
                "</tr>".
            "</table></div>".
        "</body>".
        "<html>";
    }
    public function imprimirMenuHome()
    {     
        $this->imprimirDoctype();
        print "<head>";
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("Home::INMMOSYS");
        print "</head><body>";
        $this->imprimirEncabezado("Home");
        print "<br><div align='center'><table id=menu>".
                "<tr>".
                    "<td>".
                        "<p><a href='../forms/cliente.php'>Nuevo Cliente</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/clientes.php'>Clientes</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/clientes.php'><img src='../files/images/clientes.gif' width='25' height='25' alt='clientes' class='image'/></a></p>".
                    "</td>".
                "</tr>".
                "<tr class='alt'>".
                    "<td>".
                         "<p><a href='../forms/vendedor.php'>Nuevo Vendedor</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/vendedor.php'>Vendedores</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/vendedores.php'><img src='../files/images/tecnicos.gif' width='25' height='25' alt='tecnicos' class='image'/></a></p>".
                    "</td>".
                "</tr>".
                "<tr>".
                    "<td>".
                         "<p><a href='../forms/solicitud_ini.php'>Nueva Solicitud</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/solicitudes.php'>Solicitudes</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/solicitudes.php'><img src='../files/images/solicitudes.gif' width='25' height='25' alt='solicitudes' class='image'/></a></p>".
                    "</td>".
                "</tr>".
                "<tr class='alt'>".
                    "<td>".
                        "<p><a href='../forms/orden_trabajo_ini.php'>Crear Orden de Trabajo</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/ordenes_t.php'>Ordenes de Trabajo</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/ordenes_t.php'><img src='../files/images/orden_trabajo.gif' width='25' height='25' alt='orden de Trabajo' class='image'/></a></p>".
                    "</td>".
                "</tr>".
                "<tr>".
                    "<td>".
                        "<p><a href='../forms/evaluacion.php'>Nueva Evaluacion</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/evaluaciones.php'>Evaluaciones</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/evaluaciones.php'><img src='../files/images/evaluaciones.gif' width='25' height='25' alt='evaluaciones' class='image'/></a></p>".
                    "</td>".
                "</tr>".
                "<tr class='alt'>".
                    "<td>".
                        "<p><a href='../forms/reclamo.php'>Nuevo Reclamo</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/reclamos.php'>Reclamos</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/reclamos.php'><img src='../files/images/reclamos.gif' width='25' height='25' alt='reclamos' class='image'/></a></p>".
                    "</td>".
                "</tr>".
                "<tr>".
                    "<td>".
                        "<a href='../forms/factura.php'>Generar Factura</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/facturas.php'>Facturas</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/facturas.php'><img src='../files/images/facturas.gif' width='25' height='25' alt='orden de Trabajo' class='image'/></a></p>".
                    "</td>".
                "</tr>".
                "<tr class='alt'>".
                    "<td>".
                        "<p><a href='../views/cotizacion.php'>Cotización Rápida</p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../pages/administracion.php'>Administracion</p>".
                    "</td>".
                    "<td>".
                        "<p><a href='logout.php'>Cerrar Sesion</a></p>".  
                    "</td>".
                "</tr>".
            "</table></div>".
        "</body></html>";
    }

    public function imprimirMenuAdministracion()
    {        
        $this->imprimirDoctype(); 
        print "<head>";
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        print "</head>";
        print "<body>".
        print "<br><div align='center'><table id=menu>".
                "<tr>".
                    "<td>". 
                         "<p><p><a href='../forms/tipo_documento.php'>Nuevo Tipo Documento</a></p>".
                    "</td>".
                    "<td>".
                        "<p><p><a href='../views/tipos_documentos.php'>Tipos Documentos</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/tipos_documentos.php'><img src='../files/images/documento.gif' width='25' height='25' alt='Tipos Documentos' class='image'/></a></p>".
                    "</td>".
                "</tr>".
                "<tr class='alt'>".
                    "<td>".
                        "<p><a href='../forms/pais.php'>Crear País</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/paises.php'>Paises</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/paises.php'><img src='../files/images/location.gif' width='25' height='25' alt='orden de Trabajo' class='image'/></a></p>".
                    "</td>".
                "</tr>".
                "<tr>".
                    "<td>".
                        "<p><a href='../forms/departamento.php'>Crear Departamento</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/departamentos.php'>Departamentos</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/departamentos.php'><img src='../files/images/location.gif' width='25' height='25' alt='orden de Trabajo' class='image'/></a></p>".
                    "</td>". 
                "</tr>".
                "<tr class='alt'>".
                    "<td>".
                        "<p><a href='../forms/ciudad.php'>Crear Ciudad</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/ciudades.php'>Ciudades</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/ciudades.php'><img src='../files/images/location.gif' width='25' height='25' alt='orden de Trabajo' class='image'/></a></p>".
                    "</td>".
                "</tr>".
                "<tr>".
                    "<td>".
                        "<p><p><a href='../forms/sucursal.php'>Crear Sucursal</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/sucursales.php'>Sucursales</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/sucursales.php'><img src='../files/images/office.jpeg' width='25' height='25' alt='evaluaciones' class='image'/></a></p>".
                    "</td>".
                "</tr>".
                "<tr class='alt'>".
                    "<td>".
                        "<p><a href='../forms/usuario.php'>Crear Usuario</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/usuarios.php'>Usuarios</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/usuarios.php'><img src='../files/images/usuarios.gif' width='25' height='25' alt='usuarios' class='image'/></a></p>".
                    "</td>".
                "</tr>".
                "<tr>".
                    "<td>".
                        "<p><a href='../forms/vendedor.php'>Crear Vendedor</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/vendedores.php'>Vendedores</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/vendedores.php'><img src='../files/images/usuarios.gif' width='25' height='25' alt='usuarios' class='image'/></a></p>".
                    "</td>".
                "</tr>".
                "<tr class='alt'>".
                    "<td>".
                        "<p><a href='../forms/tipo_inmueble.php'>Nuevo Tipo Inmueble</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/tipos_inmueble.php'>Tipos Inmueble</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/tipos_inmueble.php'><img src='../files/images/productos.gif' width='25' height='25' alt='orden de Trabajo' class='image'/></a></p>".
                    "</td>".
                "</tr>".
                "<tr>".
                    "<td>".
                        "<p><a href='../views/logusuarios.php'>Log Usuarios</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/logclientes.php'>Log Actualizacion Clientes</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/logclientes.php'><img src='../files/images/productos.gif' width='25' height='25' alt='orden de Trabajo' class='image'/></a></p>".
                    "</td>".
                "</tr>".
                "<tr class='alt'>".
                    "<td>".
                        "<p>&nbsp;</p>".
                    "</td>".
                    "<td>".
                        "<p><p><a href='../pages/modulo_home.php'>Volver Home</p>".
                    "</td>".
                    "<td>".
                        "<p><a target='_top' href='logout.php'>Cerrar Sesion</a></p>".
                    "</td>".
                "</tr>".
            "</table></div>".
        "</body></html>";
    }
    
    public function imprimirMenuContratos()
    {     
        $this->imprimirDoctype(); print "<head>";
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        print "</head>";
         print "<body>".
        print "<br><div align='center'><table id=menu>".
                "<tr>".
                    "<td>".
                        "<p><a href='../forms/cliente.php'>Crear Pagos</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/clientes.php'>Pagos</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/clientes.php'><img src='../files/images/pagos.jpg' width='25' height='25' alt='clientes' class='image'/></a></p>".
                    "</td>".
                "</tr>".
                "<tr class='alt'>".
                    "<td>".
                         "<p><a href='../forms/tecnico.php'>Nuevo</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/tecnicos.php'>Tecnicos</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/tecnicos.php'><img src='../files/images/tecnicos.gif' width='25' height='25' alt='tecnicos' class='image'/></a></p>".
                    "</td>".
                "</tr>".
                "<tr>".
                    "<td>".
                         "<p><a href='../forms/solicitud_ini.php'>Nueva Solicitud</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/solicitudes.php'>Solicitudes</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/solicitudes.php'><img src='../files/images/solicitudes.gif' width='25' height='25' alt='solicitudes' class='image'/></a></p>".
                    "</td>".
                "</tr>".
                "<tr class='alt'>".
                    "<td>".
                        "<p><a href='../forms/orden_trabajo_ini.php'>Crear Orden de Trabajo</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/ordenes_t.php'>Ordenes de Trabajo</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/ordenes_t.php'><img src='../files/images/orden_trabajo.gif' width='25' height='25' alt='orden de Trabajo' class='image'/></a></p>".
                    "</td>".
                "</tr>".
                "<tr>".
                    "<td>".
                        "<p><a href='../forms/evaluacion.php'>Nueva Evaluacion</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/evaluaciones.php'>Evaluaciones</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/evaluaciones.php'><img src='../files/images/evaluaciones.gif' width='25' height='25' alt='evaluaciones' class='image'/></a></p>".
                    "</td>".
                "</tr>".
                "<tr class='alt'>".
                    "<td>".
                        "<p><a href='../forms/reclamo.php'>Nuevo Reclamo</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/reclamos.php'>Reclamos</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/reclamos.php'><img src='../files/images/reclamos.gif' width='25' height='25' alt='reclamos' class='image'/></a></p>".
                    "</td>".
                "</tr>".
                "<tr>".
                    "<td>".
                        "<a href='../forms/factura.php'>Generar Factura</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/facturas.php'>Facturas</a></p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../views/facturas.php'><img src='../files/images/facturas.gif' width='25' height='25' alt='orden de Trabajo' class='image'/></a></p>".
                    "</td>".
                "</tr>".
                "<tr class='alt'>".
                    "<td>".
                        "<p><a href='../views/cotizacion.php'>Cotización Rápida</p>".
                    "</td>".
                    "<td>".
                        "<p><a href='../pages/administracion.php'>Administracion</p>".
                    "</td>".
                    "<td>".
                        "<p><a href='logout.php'>Cerrar Sesion</a></p>".  
                    "</td>".
                "</tr>".
            "</table></div>".
        "</body></html>";
    }
    
    public function imprimirResultado($res,$msg)
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("Resultado Operacion");
        print "</head><body>";
        print "<table class='basic_header' id='basic_header1' >"."<table class='ppal' align='center'>".
            "<tr>".
            "<td>".
            "<table class='tabla_cliente' id='tabla_cliente' summary='Nuevo Usuario'>".
            "  <caption> ".
            "    RESULTADO OPERACION".
            "  </caption>".
            "      <tr class='r2'>".
            "        <td colspan='2'>".$res."</td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td colspan='2'>".$msg."</td>".
            "      </tr>".
            "       <tabla>".
            "           <tr>".
            "               <td><a href='javascript:window.history.back()'>Volver</a>".
            "               <a href='../pages/modulo_home.php'>Ir al Home</a></td>".
            "           </tr>".
                    "</tabla>".
            "</table>".
            "  </td>".
            "  </tr>".
            "</table>".
            "</table>".
            "</body></html>";
    }
    
    public function imprimirVistaClientes($datos_clientes, $num_clientes)
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("CLIENTES");
        print "</head><body>".
               "<form name='vista_clientes' method='POST' action='../Vista/form_processor.php'>";
        print "<table>"."<div align='center' >".
                "<table align='center' id='menu'>".
            "  <caption> <h2>".
            "    CLIENTES".
            "  </h2></caption>".
                    "<thead>".
                    "<tr><td colspan ='9'><a href='../pages/modulo_home.php'>Volver</a></td></tr>".
                    "<th>Nombre</th>".
                    "<th>Apellido</th>".
                    "<th>No. Identificación</th>".
                    "<th>Telefono</th>".
                    "<th>Celular</th>".
                    "<th>Correo</th>".
                    "<th>Género</th>".
                    "<th>F. Nacimiento</th>".
                "</thead><tbody>";
        for($i=0;$i<$num_clientes;$i++)
        {
            $cliente = explode(";", $datos_clientes[$i]);
            print "<tr>";
            for($j=0;$j<sizeof($cliente);$j++)
            {
                if($j==2)
                    print "<td><a href='javascript:abrirCliente(".$cliente[2].")'>".$cliente[$j]."</a></td>";
                else
                    print "<td>".$cliente[$j]."</td>";

            }
            print "</tr>";
        }         
        print 
            "</tbody></table>".
            "<table class='hidden_items'>".
            "<tr>".
                "<td><input type='text' id='form_type' name='form_type' value='vista_clientes' size='100' readonly='readonly'></td>".
                "<td><input type='text' id='id_cliente' name='id_cliente' value='' size='10' ></td>".
                "<td><input  class='but' type='submit' id='send_form' value='Submit'></td>".
            "</tr>".
            "</table>".
            "</div>".
            "</form></body></html>";
    }

    
    public function imprimirVistaClientesJuridicos($datos_clientes, $num_clientes)
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_ot.js");
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        $this->imprimirLinkJavascript("../libs/funciones_vistas_clientes.js");
        $this->imprimirLinkJavascript("../libs/dhtmlgoodies_calendar.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/dhtmlgoodies_calendar.css");
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("EMPRESAS");
        print "</head><body>".
               "<form name='vista_clientesJ' method='POST' action='../Vista/form_processor.php'>";
        print "<table>"."<div align='center' >".
                "<table align='center' id='menu'>".
            "  <caption> <h2>".
            "    EMPRESAS".
            "  </h2></caption>".
                    "<thead>".
                    "<tr><td colspan ='7'><a href='../pages/modulo_home.php'>Volver</a></td></tr>".
                    "<th>Nombre</th>".
                    "<th>NIT</th>".
                    "<th>Telefono</th>".
                    "<th>Celular</th>".
                    "<th>Pagina WEB</th>".
                    "<th>Correo</th>".
                "</thead><tbody>";
        for($i=0;$i<$num_clientes;$i++)
        {
            $cliente = explode(";", $datos_clientes[$i]);
            print "<tr>";
            for($j=0;$j<sizeof($cliente);$j++)
            {
                if($j==1)
                    print "<td><a href='javascript:abrirClienteJ(".$cliente[$j].")'>".$cliente[$j]."</a></td>";
                else
                    print "<td>".$cliente[$j]."</td>";
            }
            print 
            "</tr>";
        }         
        print 
            "</tbody></table>".
            "<table class='hidden_items'>".
            "<tr>".
                "<td>".
                     "<input type='text' id='info_actualizar' name='info_actualizar' size='100' height='20'>".
                "</td>".
            "</tr>".
            "<tr>".
                "<td><input type='text' id='form_type' name='form_type' value='vista_clientesJ' size='100' readonly='readonly'></td>".
                "<td><input  name='id_cliente' type='text' id='id_cliente' value=''></td>".
                "<td><input  class='but' type='submit' id='send_form' value='Submit'></td>".
            "</tr>".
            "</table>".
            "</div>".
            "</form></body></html>";
    }
    
    public function imprimirVistaUsuarios($datos_clientes, $num_clientes)
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_ot.js");
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        $this->imprimirLinkJavascript("../libs/dhtmlgoodies_calendar.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/dhtmlgoodies_calendar.css");
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("CLIENTES");
        print "</head><body>";
        print "<table>"."<div align='center' ><div align='center' id='menu'>".
                "<table align='center' id='menu'>".
            "  <caption><h2> ".
            "    USUARIOS".
            "  </h2></caption>".
                "<thead>".
                "<tr><td colspan ='3'><a href='javascript:window.history.back()'>Volver</a></td></tr>".
                "<th>id</th>".
                "<th>usuario</th>".
                "<th>clave</th></thead><tbody>";
        for($i=0;$i<$num_clientes;$i++)
        {
            $cliente = explode(";", $datos_clientes[$i]);
            print "<tr>";
            for($j=0;$j<3;$j++)
            {
                print "<td>".$cliente[$j]."</td>";
            }
            print "</tr>";
        }
        print "</tbody></table></table></div></div>".
            "</body></html>";

    }

    public function imprimirVistaLogUsuarios($datos_clientes, $num_clientes)
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_ot.js");
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        $this->imprimirLinkJavascript("../libs/dhtmlgoodies_calendar.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/dhtmlgoodies_calendar.css");
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("Log Usuarios");
        
        print "</head><body>";
        print "<table>"."<div align='center'><div align='center' id='menu'>".
                "<table align='center' id='menu'>".
                "<thead>".
                "<tr><td colspan ='5'><a href='javascript:window.history.back()'>Volver</a></td></tr>".
                "<th>id_log</th>".
                "<th>username</th>".
                "<th>fecha</th>".
                "<th>hora</th>".
                "<th>clave</th></thead><tbody>";
        for($i=0;$i<$num_clientes;$i++)
        {
            $cliente = explode(";", $datos_clientes[$i]);
            print "<tr>";
            for($j=0;$j<5;$j++)
            {
                print "<td>".$cliente[$j]."</td>";
            }
            print "</tr>";
        }
        print "</tbody></table></div></div>".
            "</body></html>";

    }
    public function imprimirVistaLogClientes($datos_clientes, $num_clientes)
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_ot.js");
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        $this->imprimirLinkJavascript("../libs/dhtmlgoodies_calendar.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/dhtmlgoodies_calendar.css");
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("CLIENTES");
        print "</head><body>";
        print "<table>"."<div align='center'><div align='center' id='menu'>".
                "<table align='center'>".
                "<thead>".
                "<tr><td colspan ='4'><a href='javascript:window.history.back()'>Volver</a></td></tr>".
                "<th>id_log</th>".
                "<th>nombre_anterior</th>".
                "<th>nombre_nuevo</th>".
                "<th>fecha</th></thead><tbody>";
        for($i=0;$i<$num_clientes;$i++)
        {
            $cliente = explode(";", $datos_clientes[$i]);
            print "<tr>";
            for($j=0;$j<4;$j++)
            {
                print "<td>".$cliente[$j]."</td>";
            }
            print "</tr>";
        }
        print "</tbody></table></div></div>".
            "</body></html>";

    }

    public function imprimirVistaTiposDocumentos($datos, $num, $ids)
    {
        $this->imprimirDoctype();
        //$this->imprimirLinkJavascript("../libs/funciones_ot.js");
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        //$this->imprimirLinkJavascript("../libs/dhtmlgoodies_calendar.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/dhtmlgoodies_calendar.css");
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("TIPOS DOCUMENTOS");
        print "</head><body>";
        print "<table>"."<div align='center'><div align='center' id='menu'>".
                "<table align='center'><thead>".
                "<tr><td colspan ='2'><a href='javascript:window.history.back()'>Volver</a></td></tr>".
                "<th>Id</th>".
                "<th>Tipo</th></thead><tbody>";
        for($i=$num-1;$i>=0;$i--)
        {
            print "<tr>";
            print "<td>".$ids[$i]."</td>";
            print "<td>".$datos[$i]."</td>";
            print "</tr>";
        }
        print "</tbody></table></div></div>".
            "</body></html>";

    }


    
    public function imprimirVistaTiposProducto($datos, $num, $ids, $desc)
    {
        $this->imprimirDoctype();
        //$this->imprimirLinkJavascript("../libs/funciones_ot.js");
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        //$this->imprimirLinkJavascript("../libs/dhtmlgoodies_calendar.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/dhtmlgoodies_calendar.css");
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("TIPOS PRODUCTO");
        print "</head><body>";
        print "<table>"."<div align='center'><div align='center' id='menu'>".
                "<table align='center'><thead>".
                "<tr><td colspan ='3'><a href='javascript:window.history.back()'>Volver</a></td></tr>".
                "<th>Id</th>".
                "<th>Tipo</th>".
                "<th>Descripcion</th>".
                "</thead><tbody>";
        for($i=$num-1;$i>=0;$i--)
        {
            print "<tr>";
            print "<td>".$ids[$i]."</td>";
            print "<td>".$datos[$i]."</td>";
            print "<td>".$desc[$i]."</td>";
            print "</tr>";
        }
        print "</tbody></table></div></div>".
            "</body></html>";

    }

    public function imprimirVistaEstadoCambios($datos, $ids, $num, $desc)
    {
        $this->imprimirDoctype();
        //$this->imprimirLinkJavascript("../libs/funciones_ot.js");
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        //$this->imprimirLinkJavascript("../libs/dhtmlgoodies_calendar.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/dhtmlgoodies_calendar.css");
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("ESTADO CAMBIOS");
        print "</head><body>";
        print "<table>"."<div align='center'><div align='center' id='menu'>".
                "<table align='center'><thead>".
                "<tr><td colspan ='3'><a href='javascript:window.history.back()'>Volver</a></td></tr>".
                "<th>Id</th>".
                "<th>Tipo</th>".
                "<th>Descripcion</th>".
                "</thead><tbody>";
        for($i=0;$i<$num;$i++)
        {
            print "<tr>";
            print "<td>".$ids[$i]."</td>";
            print "<td>".$datos[$i]."</td>";
            print "<td>".$desc[$i]."</td>";
            print "</tr>";
        }
        print "</tbody></table></div></div>".
            "</body></html>";

    }


    public function imprimirVistaProductos($ids, $datos, $desc, $cost, $num)
    {
        $this->imprimirDoctype();
        //$this->imprimirLinkJavascript("../libs/funciones_ot.js");
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        $this->imprimirLinkJavascript("../libs/funciones_vista_productos.js");
        //$this->imprimirLinkJavascript("../libs/dhtmlgoodies_calendar.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/dhtmlgoodies_calendar.css");
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("PRODUCTOS");
        print "</head><body>".
               "<form name='vista_productos' method='POST' action='../Vista/form_processor.php'>";
        print "<table>"."<div align='center'><div align='center' id='menu'>".
                "<table align='center'><thead>".
                "<tr><td colspan ='5'><a href='javascript:window.history.back()'>Volver</a></td></tr>".
                "<th>Id</th>".
                "<th>Tipo</th>".
                "<th>Descripcion</th>".
                "<th>Costo</th>".
                "<th>Modif</th>".
                "</thead><tbody>";
        for($i=0;$i<$num;$i++)
        {
            print "<tr>".
                    "<td><input type='text' id='id_".$i."' name='id_".$i."' value='".$ids[$i]."' size='1' readonly='readonly'></td>".
                    "<td><input type='text' id='tip_".$i."' name='tip_".$i."' value='".$datos[$i]."' ></td>".
                    "<td><input type='text' id='desc_".$i."' name='desc_".$i."' value='".$desc[$i]."' size ='30'></td>".
                    "<td><input type='text' id='cost_".$i."' name='cost_".$i."' value='".$cost[$i]."'></td>".
                    "<td><input type='checkbox' name='erase_".$i."' id='erase_".$i."'></td>".
                    "</tr>";
        }
        print "<tr>".
                    "<td colspan = 3'>".
                        "<input type = 'button' onclick='generar_matriz_actualizacion()' value='Actualizar Seleccionados'>".
                    "</td>".
                    "<td colspan = '2'>".
                        "<input type = 'button' onclick='generar_matriz_borrado()' value='Borrar Seleccionados'>".
                    "</td>".
                "</tr>".
            "</tbody></table>".
            "<table class='hidden_items'>".
            "<tr>".
                "<td>".
                     "<input type='text' id='info_actualizar' name='info_actualizar' size='100' height='20'>".
                "</td>".
            "</tr>".
                "<tr>".
                    "<td><input type='text' id='form_type' name='form_type' value='vista_productos' size='100' readonly='readonly'></td>".
                    "<td><input type='text' id='cant_regs' name='cant_regs' value='".$num."' size='10' readonly='readonly'></td>".
                    "<td><input type='text' id='cant_modif' name='cant_modif' value='0' size='10' readonly='readonly'></td>".
                    "<td><input type='text' id='act_type' name='act_type' value='' size='10' ></td>".
                    "<td><input  class='but' type='submit' id='send_form' value='Submit'></td>".
                "</tr>".
            "</table>".
            "</div></div>".
            "</body></html>";

    }


    public function imprimirVistaCotizacion($ids, $datos, $desc, $cost, $num)
    {
        $this->imprimirDoctype();
        //$this->imprimirLinkJavascript("../libs/funciones_ot.js");
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        $this->imprimirLinkJavascript("../libs/funciones_vista_cotizacion.js");
        //$this->imprimirLinkJavascript("../libs/dhtmlgoodies_calendar.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/dhtmlgoodies_calendar.css");
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("COTIZACION RAPIDA");
        print "</head><body><form name='vista_cotizacion'>";
        print "<table>"."<div align='center'><div align='center' id='menu'>".
                "<table align='center'>".
                   "<tr><td colspan ='5'><a href='javascript:window.history.back()'>Volver</a></td></tr>".
                    "<tr>".
                        "<td>".
                            "<table align='center'>".
                                "<th>Id</th>".
                                "<th>Tipo</th>".
                                "<th>Descripcion</th>".
                                "<th>Costo".
                                "</th>".
                                "<th>Cant".
                                "</th>".
                                "<th>X".
                                "</th>".
                                "</thead>".
                                "<tbody>";                                
                            for($i=0;$i<$num;$i++)
                            {
                                print
                                    "<tr>".
                                        "<td>".$ids[$i]."</td>".
                                        "<td>".$datos[$i]."</td>".
                                        "<td>".$desc[$i]."</td>".
                                        "<td><input type='text' id='cost_".$i."' name='cost_".$i."' value='".$cost[$i]."' readonly='readonly' ></td>".
                                        "<td><input type='text' value='1' id='cant_".$i."' name='cant_".$i."' size='1' onkeypress='return soloNumeros(event)' onchange='calcularTotal()' ></td>".
                                        "<td><input type='checkbox' name='chck_".$i."' id='chck_".$i."' onchange='calcularTotal()'></td>".
                                    "</tr>";
                            }
        print                   "</tbody>".
                            "</table>".
                     "</td>".
                     "<td>".
                        "<table>".
                            "<tr>".
                                "<th colspan='2'>COTIZACION".
                                "</th>".
                            "</tr>".
                            "<tr>".
                                "<td>Total:".
                                "</td>".
                                "<td>".
                                    "<input type='text' readonly='readonly' id='total_cotizacion' name='total_cotizacion' value='0'>".
                                "</td>".
                            "</tr>".
                        "</table>".
                    "</td>".
                "</tr>".
                "<tr>".
                    "<td><div align='right'><input type='reset' value='Borrar' ><input type='button' value='Calcular' onclick='calcularTotal()'></div>".
                    "</td>".
                    "<td>&nbsp".
                    "</td>".
                "</tr>".
            "</table>".
          "</div></div>".
          "<table class='hidden_items'>".
                "<tr>".
                    "<td><input type='text' id='total_items' value='".$num."'>".
                    "</td>".
                "</tr>".
          "</table>".
          "</form></body></html>";
    }

    public function imprimirMostrarFormularioPais($paises, $num)
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_ubicacion.js");
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        $this->imprimirLinkJavascript("../libs/jquery.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("Nuevo Usuario");
        print "</head><body onload=limpiar_campos()>";
        print "<table class='basic_header' id='basic_header1' >"."<div aling='center'id='marco'>"."<form name='crear_pais' method='POST' action='../Vista/form_processor.php' >".
            "<table class='ppal' align='center'>".
            "<tr>".
            "</tr>".
            "<tr>".
            "<td>".
            "<table class='tabla_cliente' id='tabla_cliente' summary='Nuevo Usuario'>".
            "  <caption> ".
            "    Nuevo País".
            "  </caption>".
            "      <tr class='r2'>".
            "        <td >Nombre País:</td>".
            "        <td colspan='3'><input type='text'  id='nombre_pais' name='nombre_pais' onkeypress='return soloLetrasNombre(event)' maxlength='10'></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td>Código País:</td>".
            "        <td colspan='3'><input type='text' id='codigo_pais' name='codigo_pais' onkeypress='return soloNums(event)' maxlength='10'></td>".
            "      </tr>".
            "      <tr class='raction'>".
                "      <td><a href='javascript:mostrarVistaOculta()'>Ver Paises</a></td>".
            "        <td colspan='1'><input  id='borrar_campos' class='but2' type='reset' value='Borrar' name='borrar_campos'></td>".
            "        <td colspan='2'><input  class='but' type='button' onclick='validar_pais()' value='Crear'></td>".
            "      </tr>".
            "</table>".
            "  </td>".
            "  </tr>".
            "</table>".
            "</table>".
            "  <div align='center' id='div_vis_oculta' style='display:none'>".
            "<iframe src='../views/paises.php' width='1000' height='200'>".
              "<p>Your browser does not support iframes.</p>".
              "</iframe> ".
            "  </div>".
            "<table class='hidden_items'> ".
            "<tr>".
            "	<td>    ".
            "        <td colspan='2'><input  type='text' id='form_type' name='form_type' value='crear_pais'></td>".
            "        <td colspan='2'><input  class='but' type='submit' id='send_form' value='Submit'></td>".
            "    </td>".
            "</tr>".
            "</table>".
            "</form></div>".
            "</body></html>";
    }    
     
    public function imprimirMostrarFormularioCiudad($idsP, $nomP, $cantP, $datos, $num)
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_ubicacion.js");
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        $this->imprimirLinkJavascript("../libs/jquery.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("Nueva Ciudad");
        print "</head><body onload=habilitarDepartamento('')>";

        print "<table class='basic_header' id='basic_header1' >"."<div aling='center'id='marco'>"."<form name='crear_ciudad' method='POST' action='../Vista/form_processor.php' >".
            "<table class='ppal' align='center'>".
            "<tr>".
            "</tr>".
            "<tr>".
            "<td>".
            "<table class='tabla_cliente' id='tabla_cliente' summary='Nuevo Usuario'>".
            "  <caption> ".
            "    Nueva Ciudad".
            "  </caption>".
            "      <tr class='r2'>".
            "        <td >Pais:</td>".
            "        <td colspan='3'>".$this->obtenerComboF("nom_pais", $nomP, $cantP, $idsP,"habilitarDepartamento('../consultas/consultas.php')")."</td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td >Departamento:</td>". 
            "        <td colspan='3'><div id='div_depto'>".$this->obtenerComboF("nom_depto", "", 0, "","copiarValorCombo(this,document.getElementById('id_depto'))")."</div></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td>Nombre Ciudad:</td>".
            "        <td colspan='3'><input type='text' id='nombre_ciudad' name='nombre_ciudad' onkeypress='return soloLetrasNombre(event)' maxlength='25'></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td>Código Ciudad:</td>".
            "        <td colspan='3'><input type='text' id='codigo_ciudad' name='codigo_ciudad' onkeypress='return soloNums(event)' maxlength='10'></td>".
            "      </tr>".
            "      <tr class='raction'>".
                "      <td><a href='javascript:mostrarVistaOculta()'>Ver Ciudades</a>".
                "      </td>".
            "        <td colspan='1'><input  id='borrar_campos' class='but2' type='reset' value='Borrar' name='borrar_campos'></td>".
            "        <td colspan='2'><input  class='but' type='button' onclick='validar_ciudad()' value='Crear'></td>".
            "      </tr>".
            "</table>".
            "  </td>".
            "  </tr>".
            "</table>".
            "  <div align='center' id='div_vis_oculta' style='display:none'>".
            "<iframe src='../views/ciudades.php' width='1000' height='200'>".
              "<p>Your browser does not support iframes.</p>".
              "</iframe> ".
            "  </div>".
            "<table class='hidden_items'> ".
            "<tr>".
            "	<td>    ".
            "        <td colspan='2'><input  type='text' id='form_type' name='form_type' value='crear_ciudad' readonly='readonly'></td>".
            "        <td colspan='2'><input  type='text' id='id_pais' name='id_pais' value='' readonly='readonly'></td>".
            "        <td colspan='2'><input  type='text' id='id_depto' name='id_depto' value='' readonly='readonly'></td>".
            "        <td colspan='2'><input  class='but' type='submit' id='send_form' value='Submit'></td>".
            "    </td>".
            "</tr>".
            "</table>".
            "</form></div>".
            "</body></html>";
    }

    public function imprimirMostrarFormularioSucursal($idsP, $nomP, $cantP)
    { 
        $this->imprimirDoctype();  
        $this->imprimirLinkJavascript("../libs/funciones_ubicacion.js");
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        $this->imprimirLinkJavascript("../libs/funciones_direccion.js");
        $this->imprimirLinkJavascript("../libs/jquery.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("Nueva Sucursal");
        print "</head><body onload=habilitarDepartamentoSucursal('')>";
        print "<table class='basic_header' id='basic_header1' >"."<div aling='center'id='marco'>"."<form name='crear_sucursal' method='POST' action='../Vista/form_processor.php' >".
            "<table class='ppal' align='center'>".
            "<tr>".
            "</tr>".
            "<tr>".
            "<td>".
            "<table class='tabla_cliente' id='tabla_cliente' summary='Nuevo Usuario'>".
            "  <caption> ".
            "    Nueva Sucursal". 
            "  </caption>".
            "      <tr class='r2'>".
            "        <td colspan='2'>Pais:</td>".
            "        <td colspan='2'>Departamento:</td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td colspan='2'>".$this->obtenerComboF("nom_pais", $nomP, $cantP, $idsP,"habilitarDepartamentoSucursal('../consultas/consultas.php')")."</td>".
            "        <td colspan='2'><div id='div_depto'>".$this->obtenerComboF("nom_depto", "", 0, "","habilitarCiudadSucursal('../consultas/consultas.php')")."</div></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td colspan='2'>Ciudad:</td>".
            "        <td colspan='2'>Código Ciudad:</td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td colspan='2'><div id='div_ciudad'>".$this->obtenerComboF("nom_ciudad", "", 0, "","copiarValorCombo(this,document.getElementById('id_ciudad'))")."</div></td>".
            "        <td colspan='2'><input  type='text' id='id_ciudad' name='id_ciudad' value='-1' readonly='readonly'></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td>Nombre Sucursal:</td>".
            "        <td><input type='text' id='nombre_sucursal' name='nombre_sucursal' onkeypress='return soloLetrasNombre(event)' maxlength='25'></td>".
            "        <td>Código Sucursal:</td>".
            "        <td><input type='text' id='codigo_sucursal' name='codigo_sucursal' onkeypress='return soloNums(event)' maxlength='10'></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td>Telefono Sucursal:</td>".
            "        <td colspan='3'><input type='text' id='telefono_sucursal' name='telefono_sucursal' onkeypress='return soloNums(event)' maxlength='10'></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td rowspan='2' ><a href=javascript:mostrarDireccion()>Direccion:</a></td>".
            "        <td colspan='3'>".$this->imprimirSeccionDireccion().$this->imprimirSeccionDireccionComplementaria()."</td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td colspan='3'><div id='div_res_dir'></div></td>".
            "      </tr>".
            "      <tr class='raction'>".
                "      <td><a href='javascript:mostrarVistaOculta()'>Ver Sucursales</a>".
                "      </td>".
            "        <td colspan='2'><input  id='borrar_campos' class='but2' type='reset' value='Borrar' name='borrar_campos'></td>".
            "        <td colspan='2'><input  class='but' type='button' onclick='validar_sucursal()' value='Crear'></td>".
            "      </tr>".
            "</table>".
            "  </td>".
            "  </tr>".
            "</table>".
            "</table>".
            "  <div align='center' id='div_vis_oculta' style='display:none'>".
                "<iframe src='../views/sucursales.php' width='1000' height='250'>".
              "<p>Your browser does not support iframes.</p>".
              "</iframe> ".
            "  </td></tr></table>".
            "<table class='hidden_items'> ".
            "<tr>".
            "       <td>Submit_Form</td>".
            "       <td>CodigoPais</td>".
            "       <td>CodigoDepto</td>".
            "       <td>CodigoCiudad</td>".
            "       <td>Boton</td>".
            "</tr>".
            "<tr>".
            "        <td><input  type='text' id='form_type' name='form_type' value='crear_sucursal' readonly='readonly'></td>".
            "        <td><input  type='text' id='id_pais' name='id_pais' value='-1' readonly='readonly'></td>".
            "  <td>      <input type='text' id='direccion_inm' name='direccion_inm' onkeypress='return soloLetrasNum(event)' maxlength='45' size='100'></td>".
            "        <td><input  type='text' id='id_depto' name='id_depto' value='-1' readonly='readonly'></td>".
            "        <td><input  class='but' type='submit' id='send_form' value='Submit'></td>".
            "</tr>". 
            "</table>".
            "</form></div>".
            "</body></html>";
    }

    public function imprimirVistaPaises($datos, $num)
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_ot.js");
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        $this->imprimirLinkJavascript("../libs/dhtmlgoodies_calendar.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/dhtmlgoodies_calendar.css");
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("PAISES");
        print "</head><body>";
        print "<table>"."<div align='center' ><div align='center' id='menu'>".
                "<table align='center' id='menu'>".
            "  <caption><h2> ".
            "    PAISES".
            "  </h2></caption>".
                "<thead>".
                "<tr><td colspan ='3'><a href='javascript:window.history.back()'>Volver</a></td></tr>".
                "<th>nombre</th>".
                "<th>id</th></thead><tbody>";
        for($i=0;$i<$num;$i++)
        {
            $cliente = explode(";", $datos[$i]);
            print "<tr>";
            for($j=0;$j<2;$j++)
            {
                print "<td>".$cliente[$j]."</td>";
            }
            print "</tr>";
        }
        print "</tbody></table></table></div></div>".
            "</body></html>";
    }
    
    public function imprimirMostrarFormularioDepartamento($ids,$nom, $cant, $datos, $num)
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_ubicacion.js");
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        $this->imprimirLinkJavascript("../libs/jquery.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("Nuevo Departamento");
        print "</head><body onload=limpiar_campos()>";
        print "<table class='basic_header' id='basic_header1' >"."<div aling='center'id='marco'>"."<form name='crear_depto' method='POST' action='../Vista/form_processor.php' >".
            "<table class='ppal' align='center'>".
                "<tr>".
                "<td>".
                "<table class='tabla_cliente' id='tabla_cliente' summary='Nuevo Usuario'>".
                "  <caption> ".
                "    Nuevo Departamento".
                "  </caption>".
                "      <tr class='r2'>".
                "        <td >Pais:</td>".
                "        <td colspan='3'>".$this->obtenerCombo("nom_pais", $nom, $cant, $ids)."</td>".
                "      </tr>".
                "      <tr class='r2'>".
                "        <td >Nombre Departamento:</td>".
                "        <td colspan='3'><input type='text'  id='nombre_depto' name='nombre_depto' onkeypress='return soloLetrasNombre(event)' maxlength='25'></td>".
                "      </tr>".
                "      <tr class='r2'>".
                "        <td>Código Departamento:</td>".
                "        <td colspan='3'><input type='text' id='codigo_depto' name='codigo_depto' onkeypress='return soloNums(event)' maxlength='10'></td>".
                "      </tr>".
                "      <tr class='raction'>".
                "      <td><a href='javascript:mostrarVistaOculta()'>Ver Departamentos</a>".
                "      </td>".
                "        <td colspan='1'><input  id='borrar_campos' class='but2' type='reset' value='Borrar' name='borrar_campos'></td>".
                "        <td colspan='2'><input  class='but' type='button' onclick='validar_depto()' value='Crear'></td>".
                "      </tr>".
                "</table>".
                "</td>".
                "</tr>".
            "</table>".
            "</table>".
            "  <div align='center' id='div_vis_oculta' style='display:none'>".
                "<iframe src='../views/departamentos.php' width='1000' height='200'>".
              "<p>Your browser does not support iframes.</p>".
              "</iframe> </div>".

            "<table class='hidden_items'> ".
            "<tr>".
            "	<td>    ".
            "        <td colspan='2'><input  type='text' id='form_type' name='form_type' value='crear_depto'></td>".
            "        <td colspan='2'><input  type='text' id='id_pais' name='id_pais' value=''></td>".
            "        <td colspan='2'><input  class='but' type='submit' id='send_form' value='Submit'></td>".
            "    </td>".
            "</tr>".
            "</table>".
            "</form></div>".
            "</body></html>";
    }


    public function imprimirVistaDepartamentos($datos, $num)
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_ot.js");
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        $this->imprimirLinkJavascript("../libs/dhtmlgoodies_calendar.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/dhtmlgoodies_calendar.css");
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("PAISES");
        print "</head><body>";
        print "<table>"."<div align='center' ><div align='center' id='menu'>".
                "<table align='center' id='menu'>".
            "  <caption><h2> ".
            "    DEPARTAMENTOS".
            "  </h2></caption>".
                "<thead>".
                "<tr><td colspan ='3'><a href='javascript:window.history.back()'>Volver</a></td></tr>".
                "<th>Nombre</th>".
                "<th>Pais</th>".
                "<th>Código</th></thead><tbody>";
        for($i=0;$i<$num;$i++)
        {
            $cliente = explode(";", $datos[$i]);
            print "<tr>";
            for($j=0;$j<3;$j++)
            {
                print "<td>".$cliente[$j]."</td>";
            }
            print "</tr>";
        }
        print "</tbody></table></table></div></div>".
            "</body></html>";
    }
    
    
    public function imprimirVistaCiudades($datos, $num)
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_ot.js");
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        $this->imprimirLinkJavascript("../libs/dhtmlgoodies_calendar.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/dhtmlgoodies_calendar.css");
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("CIUDADES");
        print "</head><body>";
        print "<table>"."<div align='center' ><div align='center' id='menu'>".
                "<table align='center' id='menu'>".
            "  <caption><h2> ".
            "    CIUDADES".
            "  </h2></caption>".
                "<thead>".
                "<tr><td colspan ='4'><a href='javascript:window.history.back()'>Volver</a></td></tr>".
                "<th>Nombre</th>".
                "<th>Departamento</th>".
                "<th>País</th>".
                "<th>Código</th>".
                "</thead><tbody>";
        for($i=0;$i<$num;$i++)
        {
            $cliente = explode(";", $datos[$i]);
            print "<tr>";
            for($j=0;$j<4;$j++)
            {
                print "<td>".$cliente[$j]."</td>";
            }
            print "</tr>";
        }
        print "</tbody></table></table></div></div>".
            "</body></html>";
    }
    
    
    public function imprimirComboDepartamentos($id, $datos, $num)
    {
        $combo="";
        $combo= "<select id='".$id."' name='".$id."' onchange=copiarValorCampo(this,document.getElementById('id_depto'))>";
        if($num==0)
        {
            $combo=$combo."<option value='-1'>-Sin Registros-</option>";
        }
        else
        {
            for($i=0;$i<$num;$i++)
            {
                if($i==0)
                {
                    $combo=$combo."<option value='-1'>-Seleccione-</option>";
                }
                $val = explode(";",$datos[$i]);
                $combo=$combo."<option value='".$val[1]."'>".$val[0]."</option>";
            }
        }
        $combo=$combo."</select>";
        echo $combo;
    }

    public function imprimirComboCiudades($id, $datos, $num)
    {
        $combo=""; 
        $combo= "<select id='".$id."' name='".$id."' onchange=onchange=copiarValorCampo(this,document.getElementById('id_ciudad'))>";
        if($num==0)
        {
            $combo=$combo."<option value='-1'>-Sin Registros-</option>";
        }
        else
        {
            for($i=0;$i<$num;$i++)
            {
                if($i==0)
                {
                    $combo=$combo."<option value='-1'>-Seleccione-</option>";
                }
                $val = explode(";",$datos[$i]);
                $combo=$combo."<option value='".$val[1]."'>".$val[0]."</option>";
            }
        }
        $combo=$combo."</select>";
        echo $combo;
    }
    
    public function imprimirComboContratos($id, $datos, $num)
    {
        $combo=""; 
        $combo= "<select id='".$id."' name='".$id."' onchange=onchange=copiarValorCampo(this,document.getElementById('con_num'))>";
        if($num==0)
        {
            $combo=$combo."<option value='-1'>-Sin Registros-</option>";
        }
        else
        {
            for($i=0;$i<$num;$i++)
            {
                if($i==0)
                {
                    $combo=$combo."<option value='-1'>-Seleccione-</option>";
                }
                $val = explode(";",$datos[$i]);
                $combo=$combo."<option value='".$val[1]."'>".$val[0]."</option>";
            }
        }
        $combo=$combo."</select>";
        echo $combo;
    }
    
    public function imprimirComboDepartamentosSucursal($id, $datos, $num)
    {
        $combo="";
        $combo= "<select id='".$id."' name='".$id."' onchange=habilitarCiudadSucursal('../consultas/consultas.php')>";
        if($num==0)
        {
            $combo=$combo."<option value='-1'>-Sin Registros-</option>";
        }
        else
        {
            for($i=0;$i<$num;$i++)
            {
                if($i==0)
                {
                    $combo=$combo."<option value='-1'>-Seleccione-</option>";
                }
                $val = explode(";",$datos[$i]);
                $combo=$combo."<option value='".$val[1]."'>".$val[0]."</option>";
            }
        }
        $combo=$combo."</select>";
        echo $combo;
    }

    public function imprimirVistaSucursales($datos, $num)
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        $this->imprimirLinkJavascript("../libs/dhtmlgoodies_calendar.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/dhtmlgoodies_calendar.css");
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("CIUDADES");
        print "</head><body>";
        print "<table>"."<div align='center' ><div align='center' id='menu'>".
                "<table align='center' id='menu'>".
            "  <caption> <h2>".
            "    SUCURSALES".
            "  </h2></caption>".
                "<thead>".
                "<tr><td colspan ='5'><a href='javascript:window.history.back()'>Volver</a></td></tr>".
                "<th>Nombre</th>".
                "<th>Teléfono</th>".
                "<th>Dirección</th>".
                "<th>Ciudad</th>".
                "<th>Código</th>".
                "</thead><tbody>";
        for($i=0;$i<$num;$i++)
        {
            $cliente = explode(";", $datos[$i]);
            print "<tr>";
            for($j=0;$j<5;$j++)
            {
                print "<td>".$cliente[$j]."</td>";
            }
            print "</tr>";
        }
        print "</tbody></table></table></div></div>".
            "</body></html>";
    }


    public function imprimirMostrarFormularioVendedor($idsP, $nomP, $cantP)
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_vendedor.js");
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        $this->imprimirLinkJavascript("../libs/dhtmlgoodies_calendar.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/dhtmlgoodies_calendar.css");
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("Nuevo Vendedor");
        print "</head><body onload=\"document.getElementById('borrar_campos').click();\" >";
        print "<table class='basic_header' id='basic_header1' >"."<div aling='center'id='marco'>"."<form name='crear_vendedor' method='POST' action='../Vista/form_processor.php' >".
            "<table class='ppal' align='center'>".
            "<tr>".
            "</tr>".
            "<tr>".
            "<td>".
            "<table class='tabla_cliente' id='tabla_cliente' summary='Nuevo Vendedor'>".
            "  <caption> ".
            "    Nuevo Vendedor".
            "  </caption>".
            "<tr class='r2'>". 
            "        <td >Nombre:</td>".
            "        <td ><input type='text'  id='nombre_vendedor' name='nombre_vendedor' onkeypress='return soloLetrasNombre(event)' maxlength='45'></td>".
            "        <td >Apellido:</td>".
            "        <td ><input type='text'  id='apellido_vendedor' name='apellido_vendedor' onkeypress='return soloLetrasNombre(event)' maxlength='45'></td>".
            "      </tr>".
            "<tr class='r2'>".
            "           <td>Género:</td>".
            "           <td >".
            "                   <input type='radio' id='sexo_f' name='sexo_cliente' value='F' onchange=actualizarGenero(this,document.getElementById('genero_vendedor')) onblur=actualizarGenero(this,document.getElementById('genero_vendedor'))>F".
            "                   <input type='radio' id='sexo_m' name='sexo_cliente' value='M' onchange=actualizarGenero(this,document.getElementById('genero_vendedor')) onblur=actualizarGenero(this,document.getElementById('genero_vendedor'))>M".
            "           </td>".
            "        <td>Fecha Nacimiento:</td>".
                "        <td><input type='text' id='fechanac_vendedor' name='fechanac_vendedor'   value='---'  readonly='readonly'>".
                            "<a href=\"javascript:displayCalendar(document.getElementById('fechanac_vendedor'),'yyyy-mm-dd',document.getElementById('img_calendar'))\"> <img id='img_calendar' src='../files/images/calendar.png' width='20' height='20' class='image'/></a>"."</td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td>No. Doc:</td>".
            "        <td colspan='3'><input type='text' id='cedula_vendedor' name='cedula_vendedor' onkeypress='return soloNumerosTelefonicos(event)' maxlength='15'></td>".
            "      </tr>".
            "      <tr rowspan='2' class='raction'>".
            "      <td colspan='4'>".
            "      </td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td>Sucursal:</td>".
            "        <td>".$this->obtenerComboF("nom_sucursal", $nomP, $cantP, $idsP, "actualizarCodigoSucursal()")."</td>".
             "        <td>Fecha Ingreso:</td>".
                "        <td><input type='text' id='fechaing_vendedor' name='fechaing_vendedor'   value='---'  readonly='readonly'>".
                            "<a href=\"javascript:displayCalendar(document.getElementById('fechaing_vendedor'),'yyyy-mm-dd',document.getElementById('img_calendar'))\"> <img id='img_calendar' src='../files/images/calendar.png' width='20' height='20' class='image'/></a>"."</td>".
            "      </tr>".
            "      <tr class='r2'>".
             "        <td>No. Doc Jefe:</td>".
            "        <td><input type='text' id='cedula_jefe' name='cedula_jefe' onkeypress='return soloNumerosTelefonicos(event)' maxlength='15'></td>".
           "        <td >Contraseña:</td>".
            "        <td><input type='password'  id='password_usuario' name='password_usuario' onkeypress='' maxlength='10'></td>".
            "      </tr>".
            "      <tr class='raction'>".
            "        <td colspan='2'><input  id='borrar_campos' class='but2' type='reset' value='Borrar' name='borrar_campos'></td>".
            "        <td colspan='2'><input  class='but' type='button' onclick='validar_vendedor()' value='Crear'></td>".
            "      </tr>".
            "</table>".
            "  </td>".
            "  </tr>".
            "</table>".
            "<table class='hidden_items'> ".
            "<tr>". 
            "       <td>Submit_Form</td>".
            "       <td>Genero</td>".
            "       <td>CodigoSucursal</td>".
            "       <td>Boton</td>".
            "</tr>".
            "<tr>".
            "        <td><input  type='text' id='form_type' name='form_type' value='crear_vendedor' readonly='readonly'></td>".
            "        <td><input  type='text' id='genero_vendedor' name='genero_vendedor' value='' readonly='readonly'></td>".
            "        <td><input  type='text' id='id_sucursal' name='id_sucursal' value='-1' readonly='readonly'></td>".
            "        <td><input  class='but' type='submit' id='send_form' value='Submit'></td>".
            "</tr>".
            "</table>".
            "</form></div>".
            "</body></html>";
    }


    public function imprimirMostrarFormularioVendedorM($idsP, $nomP, $cantP,$datos)
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_vendedor.js");
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        $this->imprimirLinkJavascript("../libs/dhtmlgoodies_calendar.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/dhtmlgoodies_calendar.css");
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("Modificar Vendedor");
        print "</head><body onload=\"document.getElementById('borrar_campos').click();\" >";
        print "<table class='basic_header' id='basic_header1' >"."<div aling='center'id='marco'>"."<form name='modif_vendedor' method='POST' action='../Vista/form_processor.php' >".
            "<table class='ppal' align='center'>".
            "<tr>".
            "</tr>".
            "<tr>".
            "<td>".
            "<table class='tabla_cliente' id='tabla_cliente' summary='Nuevo Vendedor'>".
            "  <caption> ".
            "    MODIFICAR Vendedor".
            "  </caption>".
            "<tr class='r2'>".
            "        <td >Nombre:</td><td>".$datos[0]."</td>".
            "        <td >Apellido:</td><td>".$datos[1]."</td>".
            "      </tr>".
            "<tr class='r2'>".
            "           <td>Género:</td>".
            "           <td >".$datos[2]."</td>".
            "        <td>Fecha Nacimiento:</td>".
            "           <td >".$datos[3]."</td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td>No. Doc:</td>".
            "        <td colspan='3'>".$datos[4]."</td>".
            "      </tr>".
            "      <tr rowspan='2' class='raction'>".
            "      <td colspan='4'>".
            "      </td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td>Sucursal Actual:</td><td colspan='3'>".$datos[5]."</td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td>Sucursal Nueva:</td>".
            "        <td>".$this->obtenerComboF("nom_sucursal", $nomP, $cantP, $idsP, "actualizarCodigoSucursal()")."</td>".
             "        <td>Fecha Ingreso:</td><td>".$datos[6]."</td>".
            "      </tr>".
            "      <tr class='r2'>".
             "        <td>No. Doc Jefe:</td>".
            "        <td><input type='text' id='cedula_jefe' name='cedula_jefe' value='".$datos[7]."'onkeypress='return soloNumerosTelefonicos(event)' maxlength='15'></td>".
           "        <td >Contraseña:</td>".
            "        <td><input type='password'  id='password_usuario' name='password_usuario' value='".$datos[8]."' onkeypress='' maxlength='10'></td>".
            "      </tr>".
            "      <tr class='raction'>".
            "        <td colspan='2'><input  id='borrar_campos' class='but2' type='reset' value='Borrar' name='borrar_campos'></td>".
            "        <td colspan='2'><input  class='but' type='button' onclick='validar_vendedorM()' value='Actualizar'></td>".
            "      </tr>".
            "</table>".
            "  </td>".
            "  </tr>".
            "</table>".
            "<table class='hidden_items'> ".
            "<tr>".
            "       <td>Submit_Form</td>".
            "       <td>Genero</td>".
            "       <td>CodigoSucursal</td>".
            "       <td>Boton</td>".
            "</tr>".
            "<tr>".
            "        <td><input  type='text' id='form_type' name='form_type' value='modif_vendedor' readonly='readonly'></td>".
            "        <td><input  type='text' id='id_sucursal' name='id_sucursal' value='-1' readonly='readonly'></td>".
            "        <td><input  type='text' id='cedula_vendedor' name='cedula_vendedor' value='".$datos[4]."' readonly='readonly'></td>".
            "        <td><input  class='but' type='submit' id='send_form' value='Submit'></td>".
            "</tr>".
            "</table>".
            "</form></div>".
            "</body></html>";
    }

    public function imprimirVistaVendedores($datos, $num)
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("VENDEDORES");
        print "</head><body><form name='vista_vendedores' method='POST' action='../Vista/form_processor.php' >";
        print "<table>"."<div align='center' ><div align='center' id='menu'>".
                "<table align='center' id='menu'>".
            "  <caption> <h2>".
            "    VENDEDORES".
            "  </h2></caption>".
                "<thead>".
                "<tr><td colspan ='11'><a href='javascript:window.history.back()'>Volver</a></td></tr>".
                "<th>Nombre  Apellido</th>".
                "<th>Género</th>".
                "<th>Fecha Nacimiento</th>".
                "<th>Cedula Vendedor</th>".
                "<th>Contraseña</th>".
                "<th>Fecha Ingreso</th>".
                "<th>Cedula Jefe</th>".
                "<th>No. Transacciones</th>".
                "<th>Tipo</th>".
                "<th>Estado</th>".
                "<th>Sucursal</th>".
                "</thead><tbody>";
        for($i=0;$i<$num;$i++)
        {
            $cliente = explode(";", $datos[$i]);
            print "<tr>";
            for($j=1;$j<12;$j++) 
            {
                if($j==1)
                    print "<td>".$cliente[$j-1]." ".$cliente[$j]."</td>";
                else if($j==4)
                    print "<td><a href='javascript:abrirVendedor(".$cliente[4].")'>".$cliente[$j]."</a></td>";
                else if($j==0)
                    print "";
                else
                    print "<td>".$cliente[$j]."</td>";
            }
            print "</tr>";
        }
        print "</tbody></table></table></div></div>".
            "<table class='hidden_items'>".
            "<tr>".
                "<td><input type='text' id='form_type' name='form_type' value='vista_vendedores' size='100' readonly='readonly'></td>".
                "<td><input type='text' id='id_vendedor' name='id_vendedor' value='' size='10' ></td>".
                "<td><input  class='but' type='submit' id='send_form' value='Submit'></td>".
            "</tr>".
            "</table>".
            "</body></html>";
    }

    private function obtenerRadio($id, $data, $cant, $fblur, $fchange)
    {
        $vals = explode("%%", $data);
        $radio="";
        for($i=0;$i<$cant;$i++)
        {
            $radio=$radio."<input type=\"radio\" name=\"".$id."\" id=\"".$id.$i."\" value=\"".$vals[$i]."\" onchange=\"".$fchange."\" onblur=\"".$fblur."\"/>".$vals[$i];
        }
        return $radio;
    }


    public function imprimirMostrarFormularioTipoInmueble()
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_tipo_inmueble.js");
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        $this->imprimirLinkJavascript("../libs/jquery.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("Nuevo Tipo Inmueble");
        print "</head><body>";
        print "<table class='basic_header' id='basic_header1' >"."<div aling='center'id='marco'>"."<form name='crear_tipo_inmueble' method='POST' action='../Vista/form_processor.php'>".
            "<table class='ppal' align='center'>".
            "<tr>".
            "<td>".
            "<table class='tabla_cliente' id='tabla_cliente' summary='Nuevo Tipo Documento'>".
            "  <caption> ".
            " Nuevo Tipo Inmueble".
            "  </caption>".
            "      <tr class='r2'>".
            "        <td >Tipo Inmueble:</td>".
            "        <td colspan='3'><input type='text'  id='nom_inmueble' name='nom_inmueble' maxlength='15' onkeypress='return soloLetrasNombre(event)'></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td >Descripcion Inmueble:</td>".
            "        <td colspan='3'><input type='text'  id='desc_inmueble' name='desc_inmueble' maxlength='45' size='50' onkeypress='return soloLetrasNombre(event)'></td>".
            "      </tr>".
            "      </tr>".
            "      <tr class='raction'>".
                "      <td><a href='javascript:mostrarVistaOculta()'>Ver Tipos Inmueble</a></td>".
            "        <td colspan=''><input  class='but2' type='reset' value='Borrar'></td>".
            "        <td colspan='2'><input  class='but' type='button' onclick='validar_tipo_inmueble()' value='Crear'></td>".
            "      </tr>".
            "</table>".
            "  </td>".
            "  </tr>".
            "</table>".
            "</table>".
            "  <div align='center' id='div_vis_oculta' style='display:none'>".
            "<iframe src='../views/tipos_inmueble.php' width='1000' height='200'>".
              "<p>Your browser does not support iframes.</p>".
              "</iframe> ".
            "  </div>".
            "<table class='hidden_items'> ".
            "<tr>".
            "	<td>    ".
            "        <td colspan='2'><input  type='text' id='form_type' name='form_type' value='tipo_inmueble'></td>".
            "        <td colspan='2'><input  class='but' type='submit' id='send_form' value='Submit'></td>".
            "    </td>".
            "</tr>".
            "</table>".
            "</form></div>".
            "</body></html>";
    }


    public function imprimirVistaTiposInmueble($datos, $num, $ids, $desc)
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/dhtmlgoodies_calendar.css");
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("TIPOS INMUEBLE");
        print "</head><body>";
        print "<table>"."<div align='center'><div align='center'>".
                "<table align='center' id='menu'><thead>".
                "<tr><td colspan ='3'><a href='javascript:window.history.back()'>Volver</a></td></tr>".
                "<th>Id</th>".
                "<th>Tipo</th>".
                "<th>Descripcion</th></thead><tbody>";
        for($i=$num-1;$i>=0;$i--)
        {
            print "<tr>";
            print "<td>".$ids[$i]."</td>";
            print "<td>".$datos[$i]."</td>";
            print "<td>".$desc[$i]."</td>";
            print "</tr>";
        }
        print "</tbody></table></div></div>".
            "</body></html>";

    }

    public function imprimirMostrarFormularioInmuebleM($datos)
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_tipo_inmueble.js");
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        $this->imprimirLinkJavascript("../libs/funciones_ubicacion.js");
        $this->imprimirLinkJavascript("../libs/funciones_direccion.js");
        $this->imprimirLinkJavascript("../libs/jquery.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("Nuevo Departamento");
        print "</head><body >";
        print "<table class='basic_header' id='basic_header1' >"."<div aling='center'id='marco'>"."<form name='modif_inmueble' method='POST' action='../Vista/form_processor.php' >".
            "<table class='ppal' align='center'>".
            "<tr>".
            "</tr>".
            "<tr>".
            "<td>".
            "<table class='tabla_cliente' id='tabla_cliente' summary='Modificar Inmueble'>".
            "  <caption> ".
            "    Modificar Inmueble".
            "  </caption>".
            "      <tr class='r2'>".
            "           <td colspan='4'><div align='center'><i>Ubicación</i></div>".
            "           </td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td >Pais:</td>".
            "        <td >Departamento:</td>".
            "        <td >Ciudad:</td>".
            "        <td >Código Ciudad:</td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td >".$datos[0]."</td>".
            "        <td >".$datos[1]."</td>".
            "        <td >".$datos[2]."</td>".
            "        <td>".$datos[3]."</td>".
            "      </tr>".
            "      <tr class='r2'>".
            "           <td colspan='4'><div align='center'><i>Datos Inmueble</i></div>".
            "           </td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td >Tipo Inmueble:</td>".
            "        <td colspan='3' >".$datos[4]."</td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td >No. Matricula:</td>".
            "        <td >".$datos[5]."</td>".
            "        <td >Estrato:</td>".
            "        <td >".$datos[6]."</td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td >Direccion:</td>".
            "        <td colspan='3'>".$datos[7]."</td>".
            "      </tr>".
            "      <tr class='r2'>".
            "           <td colspan='4'><div align='center'><i>Caracteristicas</i></div>".
            "           </td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td >Area Total(mts2):</td>".
            "        <td >".$datos[8]."</td>".
            "        <td >Cant. Baños:</td>".
            "        <td >".$datos[9]."</td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td >Cant. Pisos:</td>".
            "        <td >".$datos[10]."</td>".
            "        <td >Cant. Parqueaderos:</td>".
            "        <td >".$datos[11]."</td>".
            "      </tr>".
            "      <tr class='r2'>".
            "           <td colspan='4'><div align='center'><i>Impuestos & Valores</i></div>".
            "           </td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td >Valor Impuestos:</td>".
            "        <td ><input type='text'  id='valimp_inm' name='valimp_inm' value='".$datos[12]."' maxlength='8' onkeypress='return soloNumerosArea(event)' onblur='corregirCampo(this)'></td>".
            "        <td >Valor Administración:</td>".
            "        <td ><input type='text'  id='valadm_inm' name='valadm_inm' value='".$datos[13]."' maxlength='8' onkeypress='return soloNumerosArea(event)' onblur='corregirCampo(this)'></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "           <td colspan='4'><div align='center'><i>Descripción</i></div>".
            "           </td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td>Datos Adicionales:</td>".
            "        <td colspan='3'><textarea id='desc_inm' name='desc_inm'  rows='2' cols='60' maxlength='255'>".$datos[14]."</textarea></td>".
            "      </tr>".
            "      <tr class='raction'>".
            "        <td colspan='2'><input  id='borrar_campos' class='but2' type='reset' value='Borrar' name='borrar_campos'></td>".
            "        <td colspan='2'><input  class='but' type='button' onclick='validar_inmuebleM()' value='Actualizar'></td>".
            "      </tr>".
            "</table>".
            "  </td>".
            "  </tr>".
            "</table>".
            "<table class='hidden_items'> ".
            "<tr>".
            "	<td>    ".
            "        <td colspan='2'><input  type='text' id='form_type' name='form_type' value='modif_inmueble'></td>".
            "        <td><input  type='text' id='id_inm' name='id_inm' value='".$datos[15]."' readonly='readonly'></td>".
            "        <td colspan='2'><input  class='but' type='submit' id='send_form' value='Submit'></td>".
            "    </td>".
            "</tr>".
            "</table>".
            "</form></div>".
            "</body></html>";
    }
    public function imprimirMostrarFormularioInmueble($ids,$nom, $cant, $nomP, $cantP, $idsP)
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_tipo_inmueble.js");
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        $this->imprimirLinkJavascript("../libs/funciones_ubicacion.js");
        $this->imprimirLinkJavascript("../libs/funciones_direccion.js");
        $this->imprimirLinkJavascript("../libs/jquery.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("Nuevo Departamento");
        print "</head><body >";
        print "<table class='basic_header' id='basic_header1' >"."<div aling='center'id='marco'>"."<form name='crear_inmueble' method='POST' action='../Vista/form_processor.php' >".
            "<table class='ppal' align='center'>".
            "<tr>".
            "</tr>".
            "<tr>".
            "<td>".
            "<table class='tabla_cliente' id='tabla_cliente' summary='Nuevo Inmueble'>".
            "  <caption> ".
            "    Nuevo Inmueble".
            "  </caption>".
            "      <tr class='r2'>".
            "           <td colspan='4'><div align='center'><i>Ubicación</i></div>".
            "           </td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td >Pais:</td>".
            "        <td >Departamento:</td>".
            "        <td >Ciudad:</td>".
            "        <td >Código Ciudad:</td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td >".$this->obtenerComboF("nom_pais", $nomP, $cantP, $idsP,"habilitarDepartamentoSucursal('../consultas/consultas.php')")."</td>".
            "        <td ><div id='div_depto'>".$this->obtenerComboF("nom_depto", "", 0, "","habilitarCiudadSucursal('../consultas/consultas.php')")."</div></td>".
            "        <td ><div id='div_ciudad'>".$this->obtenerComboF("nom_ciudad", "", 0, "","copiarValorCombo(this,document.getElementById('id_ciudad'))")."</div></td>".
            "        <td><input  type='text' id='id_ciudad' name='id_ciudad' value='-1' readonly='readonly'></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "           <td colspan='4'><div align='center'><i>Datos Inmueble</i></div>".
            "           </td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td >Tipo Inmueble:</td>".
            "        <td colspan='3'>".$this->obtenerComboF("tipo_inmueble", $nom, $cant, $ids, "copiarValorCampo(this,tipo_inm)")."</td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td >No. Matricula:</td>".
            "        <td ><input type='text'  id='matricula_inm' name='matricula_inm' maxlength='25' size='35'></td>".
            "        <td >Estrato:</td>".
            "        <td >".$this->obtenerRadio("est_inmueble", "1%%2%%3%%4%%5%%6", 6, "", "copiarValorCampo(this,est_inm)")."</td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td rowspan='2' ><a href=javascript:mostrarDireccion()>Direccion:</a></td>".
            "        <td colspan='3'>".$this->imprimirSeccionDireccion().$this->imprimirSeccionDireccionComplementaria()."</td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td colspan='3'><div id='div_res_dir'></div></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "           <td colspan='4'><div align='center'><i>Caracteristicas</i></div>".
            "           </td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td >Area Total(mts2):</td>".
            "        <td ><input type='text'  id='area_inm' name='area_inm' maxlength='6' onkeypress='return soloNumerosArea(event)' onblur='corregirCampo(this)'></td>".
            "        <td >Cant. Baños:</td>".
            "        <td ><input type='text'  id='cantba_inm' name='cantba_inm' maxlength='2' onkeypress='return soloNumerosArea(event)'></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td >Cant. Pisos:</td>".
            "        <td ><input type='text'  id='cantpi_inm' name='cantpi_inm' maxlength='2' onkeypress='return soloNumerosArea(event)' onblur='corregirCampo(this)'></td>".
            "        <td >Cant. Parqueaderos:</td>".
            "        <td ><input type='text'  id='cantparq_inm' name='cantparq_inm' maxlength='2' onkeypress='return soloNumerosArea(event)' onblur='corregirCampo(this)'></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "           <td colspan='4'><div align='center'><i>Impuestos & Valores</i></div>".
            "           </td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td >Valor Impuestos:</td>".
            "        <td ><input type='text'  id='valimp_inm' name='valimp_inm' maxlength='8' onkeypress='return soloNumerosArea(event)' onblur='corregirCampo(this)'></td>".
            "        <td >Valor Administración:</td>".
            "        <td ><input type='text'  id='valadm_inm' name='valadm_inm' maxlength='8' onkeypress='return soloNumerosArea(event)' onblur='corregirCampo(this)'></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "           <td colspan='4'><div align='center'><i>Descripción</i></div>".
            "           </td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td>Datos Adicionales:</td>".
            "        <td colspan='3'><textarea id='desc_inm' name='desc_inm' rows='2' cols='60' maxlength='255'></textarea></td>".
            "      </tr>".
            "      <tr class='raction'>".
            "        <td colspan='2'><input  id='borrar_campos' class='but2' type='reset' value='Borrar' name='borrar_campos'></td>".
            "        <td colspan='2'><input  class='but' type='button' onclick='validar_inmueble()' value='Crear'></td>".
            "      </tr>".
            "</table>".
            "  </td>".
            "  </tr>".
            "</table>".
            "<table class='hidden_items'> ".
            "<tr>".
            "	<td>    ".
            "        <td colspan='2'><input  type='text' id='form_type' name='form_type' value='crear_inmueble'></td>".
            "        <td><input  type='text' id='id_pais' name='id_pais' value='-1' readonly='readonly'></td>".
            "        <td><input  type='text' id='id_depto' name='id_depto' value='-1' readonly='readonly'></td>".
            "  <td>      <input type='text' id='direccion_inm' name='direccion_inm' onkeypress='return soloLetrasNum(event)' maxlength='45' size='100'></td>".
            "        <td colspan='2'><input  type='text' id='est_inm' name='est_inm' value=''></td>".
            "        <td colspan='2'><input  type='text' id='tipo_inm' name='tipo_inm' value=''></td>".
            "        <td colspan='2'><input  class='but' type='submit' id='send_form' value='Submit'></td>".
            "    </td>".
            "</tr>".
            "</table>".
            "</form></div>".
            "</body></html>";
    }    
    
    public function imprimirVistaInmuebles($datos, $num)
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        $this->imprimirLinkJavascript("../libs/dhtmlgoodies_calendar.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/dhtmlgoodies_calendar.css");
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("INMUEBLES");
        print "</head><body>";
        print "<form name='vista_inmuebles' method='POST' action='../Vista/form_processor.php'><table>"."<div align='center' ><div align='center' id='menu'>".
                "<table align='center' id='menu'>".
            "  <caption> <h2>".
            "    INMUEBLES".
            "  </h2></caption>".
                "<thead>".
                "<tr><td colspan ='15'><a href='javascript:window.history.back()'>Volver</a></td></tr>".
                "<th>ID</th>".
                "<th>No. Matricula</th>".
                "<th>Area Total</th>".
                "<th>No. Ventas</th>".
                "<th>Dirección</th>".
                "<th>Estrato</th>".
                "<th>Baños</th>".
                "<th>Pisos</th>".
                "<th>Parqueaderos</th>".
                "<th>$ Impuestos</th>".
                "<th>$ Administración</th>".
                "<th>Disponible?</th>".
                "<th>Descripción</th>".
                "<th>Ciudad</th>".
                "<th>Tipo</th>".
                "</thead><tbody>";
        for($i=0;$i<$num;$i++)
        {
            $inmueble = explode(";", $datos[$i]);
            print "<tr>";
            for($j=0;$j<  sizeof($inmueble);$j++)
            {         
                if($j==11)
                    print "<td>".($inmueble[$j]==0?"NO":"SI")."</td>";
                else if($j==1)
                    print "<td><a href='javascript:abrirInmueble(".$inmueble[0].")'>".$inmueble[$j]."</a></td>";
                else
                    print "<td>".$inmueble[$j]."</td>";
            }
            print "</tr>";
        }
        print "</tbody></table></table>".
            "<table class='hidden_items'> ".
            "<tr>".
            "	<td>    ".
            "        <td colspan='2'><input  type='text' id='form_type' name='form_type' value='vista_inmuebles'></td>".
            "        <td colspan='2'><input  type='text' id='id_inmueble' name='id_inmueble' value=''></td>".
            "        <td colspan='2'><input  class='but' type='submit' id='send_form' value='Submit'></td>".
            "    </td>".
            "</tr>".
            "</table>".
        "</div></div>".
            "</body></form></html>";
    }


    public function imprimirVistaContratos($datos, $num)
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        $this->imprimirLinkJavascript("../libs/dhtmlgoodies_calendar.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/dhtmlgoodies_calendar.css");
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("CONTRATOS");
        print "</head><body>";
        print "<table>"."<div align='center' ><div align='center' id='menu'>".
                "<table align='center' id='menu'>".
            "  <caption> <h2>".
            "    CONTRATOS".
            "  </h2></caption>".
                "<thead>".
                "<tr><td colspan ='15'><a href='javascript:window.history.back()'>Volver</a></td></tr>".
                "<th>No. Contrato</th>".
                "<th>No. Matricula Inmueble</th>".
                "<th>No. Identificacion Cliente</th>".
                "<th>Nombre Cliente</th>".
                "<th>Fecha Inicio Contrato</th>".
                "<th>Fecha Fin Contrato</th>".
                "<th>Vigencia Contrato</th>".
                "<th>Tipo de Contrato</th>".
                "<th>Nombre Vendedor</th>".
                "<th>Valor Contrato</th>".
                "<th>Estado Contrato</th>".
                "</thead><tbody>";
        for($i=0;$i<$num;$i++)
        {
            $contratos = explode(";", $datos[$i]);
            print "<tr>";
            for($j=0;$j<sizeof($contratos);$j++)
            {
                    if($j==6)
                    {
                        print "<td>".((strtotime($contratos[5])>strtotime(date("Y-m-d")))?"Vigente":"Vencido")."</td>".
                                "<td>".($contratos[$j]==1?"Venta":"Arriendamiento")."</td>";
                        
                    }
                    else if($j==9)
                        print "<td>".($contratos[$j]==1?"En Curso":"Finalizado")."</td>";
                    else
                        print "<td>".$contratos[$j]."</td>";
            }
            print "</tr>";
        }
        print "</tbody></table></table></div></div>".
            "</body></html>";
    }



    public function imprimirVistaEstadoInmuebles($datos, $num)
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        $this->imprimirLinkJavascript("../libs/dhtmlgoodies_calendar.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/dhtmlgoodies_calendar.css");
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("MOVIMIENTOS DE INMUEBLES");
        print "</head><body>";
        print "<table>"."<div align='center' ><div align='center' id='menu'>".
                "<table align='center' id='menu'>".
            "  <caption> <h2>".
            "    MOVIMIENTOS DE INMUEBLES".
            "  </h2></caption>".
                "<thead>".
                "<tr><td colspan ='14'><a href='javascript:window.history.back()'>Volver</a></td></tr>".
                "<th>No. Cambio</th>".
                "<th>Movimiento</th>".
                "<th>Tipo Contrato</th>".
                "<th>Fecha Cambio</th>".
                "<th>Antiguo Estado</th>".
                "<th>Nuevo Estado</th>".
                "<th>Matricula Inmueble</th>".
                "</thead><tbody>";
        for($i=0;$i<$num;$i++)
        {
            $contratos = explode(";", $datos[$i]);
            print "<tr>";
            $cad = $this->obtenerCadenaMovimientosInmuebles($contratos[3],$contratos[4]);
            for($j=0;$j<sizeof($contratos);$j++)
            {
                if($j==1)
                    print "<td>".($cad)."</td>"."<td>".($contratos[$j]==0?"Venta":"Arrendamiento")."</td>";
                else if($j==3 || $j==4)
                    print "<td>".($contratos[$j]==0?"Arrendado":"Disponible")."</td>";
                else
                    print "<td>".$contratos[$j]."</td>";
            }
            print "</tr>";
        }
        print "</tbody></table></table></div></div>".
            "</body></html>";
    }


    public function imprimirVistaCambiosContrato($datos, $num)
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        $this->imprimirLinkJavascript("../libs/dhtmlgoodies_calendar.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/dhtmlgoodies_calendar.css");
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("CAMBIOS EN CONTRATOS");
        print "</head><body>";
        print "<table>"."<div align='center' ><div align='center' id='menu'>".
                "<table align='center' id='menu'>".
            "  <caption> <h2>".
            "    CAMBIOS EN CONTRATOS".
            "  </h2></caption>".
                "<thead>".
                "<tr><td colspan ='8'><a href='javascript:window.history.back()'>Volver</a></td></tr>".
                "<th>No. Cambio</th>".
                "<th>Tipo</th>".
                "<th>Fecha Cambio</th>".
                "<th>Antiguo Cliente</th>".
                "<th>Nuevo Cliente</th>".
                "<th>Anterior Estado</th>".
                "<th>Nuevo Estado</th>".
                "<th>No. Contrato</th>".
                "</thead><tbody>";
        for($i=0;$i<$num;$i++)
        {
            $contratos = explode(";", $datos[$i]);
            print "<tr>";
            for($j=0;$j<sizeof($contratos);$j++)
            {
                if($j==0)
                    print "<td>".$contratos[$j]."</td>"."<td>".($contratos[2]!=$contratos[3]?"Cesion":"Finalizacion")."</td>";
                else if($j==4 ||$j==5)
                    print "<td>".($contratos[$j]==1?"En Curso":"Finalizado")."</td>";
                else
                    print "<td>".$contratos[$j]."</td>";
            }
            print "</tr>";
        }
        print "</tbody></table></table></div></div>".
            "</body></html>";
    }
    
    
    public function imprimirMostrarFormularioDevolverInmueble($idsI, $nomI, $cantI)
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_contrato.js");
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        $this->imprimirLinkJavascript("../libs/dhtmlgoodies_calendar.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/dhtmlgoodies_calendar.css");
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("DEVOLVER INMUEBLE ARRENDADO");
        print "</head><body>";
        print "<table class='basic_header' id='basic_header1' >"."<div aling='center'id='marco'>"."<form name='devolver_inmueble' method='POST' action='../Vista/form_processor.php' >".
            "<table class='ppal' align='center'>".
            "<tr>".
            "</tr>".
            "<tr>".
            "<td>".
            "<table class='tabla_cliente' id='tabla_cliente' summary='Nuevo Usuario'>".
            "  <caption> ".
            "    DEVOLVER INMUEBLE ARRENDADO".
            "  </caption>".
            "      <tr class='r2'>".
            "        <td >Tipo Contrato:</td>".
            "        <td >ARRENDAMIENTO</td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td >No. Contrato:</td>".
            "        <td ><input type='text'  value ='0000' id='num_con' name='num_con' readonly='readonly'></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td >No. Matricula Inmueble:</td>".
            "        <td >".$this->obtenerComboF("id_inmueble", $nomI, $cantI, $idsI,"copiarTextoCombo(this,inm_mat);copiarValorCampo(this, document.getElementById('num_con'))")."</td>".
            "      </tr>".
            "      <tr class='raction'>".
            "        <td ><input  id='borrar_campos' class='but2' type='reset' value='Borrar' name='borrar_campos'></td>".
            "        <td ><input  class='but' type='button' onclick='validar_devolver_inmueble()' value='Crear'></td>".
            "      </tr>".
            "</table>".
            "  </td>".
            "  </tr>".
            "</table>".
            "<table class='hidden_items'> ".
            "<tr>".
            "	<td>    ".
            "        <td colspan='2'><input  type='text' id='form_type' name='form_type' value='devolver_inmueble' readonly='readonly'></td>".
            "        <td colspan='2'><input  type='text' id='inm_mat' name='inm_mat' value='' readonly='readonly'></td>".
            "        <td colspan='2'><input  class='but' type='submit' id='send_form' value='Submit'></td>".
            "    </td>".
            "</tr>".
            "</table>".
            "</form></div>".
            "</body></html>";
    }

    private function obtenerCadenaMovimientosInmuebles($var1, $var2)
    {
        if($var1==$var2)
            return "Venta";
        else if ($var1==1)
            return "Entrega";
        else
            return "Devolucion";
    }


    public function imprimirMostrarFormularioPago($idsP, $nomP, $cantP, $numConP, $ids_cli, $vals_con,$tips_con)
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_pago_factura.js");
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        $this->imprimirLinkJavascript("../libs/dhtmlgoodies_calendar.js");
        $this->imprimirLinkJavascript("../libs/lock.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/dhtmlgoodies_calendar.css");
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/global.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("NUEVO PAGO");
        $nomTipoA=explode("%%", "Venta%%Arrendamiento");
        $idTipoA=explode("%%", "1%%2");
        print "</head><body onmousemove='conteoRegresivo()'>";
        print "<table class='basic_header' id='basic_header1' >"."<div aling='center'id='marco'>"."<form name='crear_pago' method='POST' action='../Vista/form_processor.php' >".
           "<table bgcolor='lightgrey' class='ppal' align='center'>".
            "<tr>".
            "<td>".
            "<table class='tabla_cliente' id='tabla_cliente' summary='nuevo pago'>".
            "  <caption> ".
            "    PAGO FACTURA CONTRATO".
            "  </caption>".
            "      <tr>".
                     "<th  class='field_logo' rowspan='3'>".
                        "<img src='../files/inmosys_60x120.png' width='120' height='60' alt='Inmosys'  />".
                     "</th>".
                     "<th rowspan='3' colspan='2'>&nbsp".
                     "</th>".
                    "<th>".
			"<table align='right'>".
                            "<tr>".
				"<th align='right'>Reg. Pago:</th>".
				"<th align='center'><input type='text'  value ='0000".($numConP)."' id='num_pago' name='num_pago' size='10' readonly='readonly'></th>".
                            "</tr>".
                            "<tr>".
                                "<th rowspan='2' align='right'>Fecha. Pago:</th>".
                                "<th align='center'><input type='text'  value ='".date('Y-m-d')."' id='fec_pago' name='fec_pago' size='10'  readonly='readonly'></th>".
                            "</tr>".
			"</table>".
                     "</th>".
            "      </tr><tbody>".
            "      <tr class='r2'>".
            "        <td >Señor(es):</td>".
            "        <td colspan='4'><input type='text'  value ='' id='nom_cliente' name='nom_cliente' size='35'  readonly='readonly'></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td >No. Identificacion:</td>".
            "        <td colspan='4'><input type='text'  value ='' id='ced_cliente' name='ced_cliente' size='35' readonly='readonly'></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td colspan='6'><div align='center'>Descripcion</div></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td align='center'>No. Contrato</td>".
            "        <td align='center'>Concepto</td>".
            "        <td align='center'>Matricula Inmueble</td>".
            "        <td align='center'>No. Cuota</td>".
            "        <td align='center'>Valor. Cuota</td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td >".$this->obtenerComboF("id_contrato", $idsP, $cantP, $idsP,"calcularCamposPago(this,'../consultas/consultas.php')")."</td>".
            "        <td align='center'><input type='text'  value ='' id='tip_contrato' name='tip_contrato' size='8'  readonly='readonly'></td>".
            "        <td ><input type='text'  value ='' id='num_matricula' name='num_matricula' size='35'  readonly='readonly'></td>".
            "        <td align='center'><div id='div_cuota'><input type='text'  value ='' id='num_cuota' name='num_cuota'  size='8'  readonly='readonly'></div></td>".
            "        <td align='center'><div id='div__val_cuota'><input type='text'  value ='' id='val_cuota' name='val_cuota' size='8'  readonly='readonly'></div></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td colspan='4' align='right'>Base sin IVA:</td>".
            "        <td align='center'><div id='div_cuota'><input type='text'  value ='' id='base_cuota' name='base_cuota'  size='8' readonly='readonly'></td></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td colspan='4' align='right'>IVA 16%:</td>".
            "        <td align='center'><div id='div_cuota'><input type='text'  value ='' id='iva_cuota' name='iva_cuota' size='8'  readonly='readonly'></td></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td colspan='4' align='right'>Total:</td>".
            "        <td align='center'><div id='div_cuota'><input type='text'  value ='' id='total_cuota' name='total_cuota'  size='8' readonly='readonly'></td></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td>Descripcion:</td>".
            "        <td colspan='5'><textarea id='desc_estado' name='desc_estado' rows='2' cols='60'></textarea></td>".
            "      </tr>".
            "      <td colspan='5'>".
            "<div align='center'>".
            "<h5>Inmosys-Nit:830945930-1<br>".
            "Politecnico Grancolombiano CL 57 No. 3-00E<br>".
            "Bogota D.C<br>".
            "Tels:3468800 -3468801<br>".
            "Ventas Regimen Simplificado<br>".
            "E-mail:info@inmosys.com<br>".
            "</h5></div>".
            "      </td>".
            "      </tr>".
            "      <tr class='raction'>".
            "        <td colspan='2'><input  id='borrar_campos' class='but2' type='reset' value='Borrar' name='borrar_campos'></td>".
            "        <td colspan='2'><input  class='but' type='button' onclick='validar_pago_factura()' value='Realizar Pago'></td>".
            "        <td colspan='2'>&nbsp</td>".
            "      </tr></tbody>".
            "</table>".
            "  </td>".
            "  </tr>".
            "</table>".
            "<div id='LockScreen' class='LockOff'>".
                "<table id='customers'>".
                    "<caption>Calculando...</caption>".
                    "<tr>".
                            "<td>".
                                    "<br><img src='../files/images/loading.gif' alt=''/>".
                            "</td>".
                    "</tr>".
                "</table>".
            "</div>".
            "<table class='hidden_items'> ".
            "<tr>".
            "	<td>    ".
            "        <td >".$this->obtenerComboF("id_matricula", $nomP, $cantP, $idsP,"")."</td>".
            "        <td >".$this->obtenerComboF("id_cedulas", $ids_cli, $cantP, $ids_cli,"")."</td>".
            "        <td >".$this->obtenerComboF("id_valores", $vals_con, $cantP, $vals_con,"")."</td>".
            "        <td >".$this->obtenerComboF("id_tip_cons", $tips_con, $cantP, $tips_con,"")."</td>".
            "        <td colspan='2'><input  type='text' id='form_type' name='form_type' value='crear_pago' readonly='readonly'></td>".
                    "<td><input type='text' id='mouse' value='0'/></td>".
            "        <td colspan='2'><input  type='text' id='con_num' name='con_num' value='' readonly='readonly'></td>".
            "        <td colspan='2'><input  class='but' type='submit' id='send_form' value='Submit'></td>".
            "    </td>".
            "</tr>".
            "<tr>".
            "        <td colspan='5'><div id='div_res_query'></div></td>".
            "</tr>".
            "</table>".
            "</form></div>".
            "</body></html>";
    }

    public function imprimirTablaConsultaPagos($nom_cli, $num_cuotas,$val)
    {
        if($val==0)
            echo "".$nom_cli."-".$num_cuotas;
        else
        echo "<table > ".
                "<tr>".
                "	<td>    ".
                "        <td colspan='2'><input  type='text' id='res_nom_cli' name='res_nom_cliv' value='".$nom_cli."' readonly='readonly'></td>".
                "    </td>".
                "</tr>".
                "<tr>".
                "	<td>    ".
                "        <td colspan='2'><input  type='text' id='res_num_cuotas' name='res_num_cuotas' value='".($num_cuotas+1)."' readonly='readonly'></td>".
                "    </td>".
                "</tr>".
                "</table>";
    }

    public function imprimirMostrarFacturaHTML($idsP, $nomP, $cantP, $numConP, $ids_cli, $vals_con, $tips_con)
    {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_pago_factura.js");
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        $this->imprimirLinkJavascript("../libs/dhtmlgoodies_calendar.js");
        $this->imprimirLinkJavascript("../libs/lock.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/dhtmlgoodies_calendar.css");
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/global.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("PAGO FACTURA CONTRATO");
        print "</head><body onmousemove='conteoRegresivo()'>";
        print "<table class='basic_header' id='basic_header1' >"."<div aling='center'id='marco'>"."<form name='crear_factura' method='POST' action='../Vista/form_processor.php' >".
            "<table bgcolor='lightgrey' class='ppal' align='center'>".
            "<tr>".
            "<td>".
            "<table class='tabla_cliente' id='tabla_cliente' summary='nuevo pago'>".
            "  <caption> ".
            "    PAGO FACTURA CONTRATO".
            "  </caption>".
            "      <tr>".
                     "<th  class='field_logo' rowspan='3'>".
                        "<img src='../files/inmosys_60x120.png' width='120' height='60' alt='Inmosys'  />".
                     "</th>".
                     "<th rowspan='3' colspan='2'>&nbsp".
                     "</th>".
                    "<th>".
			"<table align='right'>".
                            "<tr>".
				"<th align='right'>Reg. Pago:</th>".
				"<th align='center'><input type='text'  value ='0000".($numConP)."' id='num_pago' name='num_pago' size='10' readonly='readonly'></th>".
                            "</tr>".
                            "<tr>".
                                "<th align='right'>Fecha. Pago:</th>".
                                "<th align='center'><input type='text'  value ='".date('Y-m-d')."' id='fec_pago' name='fec_pago' size='10'  readonly='readonly'></th>".
                            "</tr>".
			"</table>".
                     "</th>".
            "      </tr><tbody>".
            "      <tr class='r2'>".
            "        <td >Señor(es):</td>".
            "        <td colspan='4'><input type='text'  value ='' id='nom_cliente' name='nom_cliente' size='35'  readonly='readonly'></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td >No. Identificacion:</td>".
            "        <td colspan='4'><input type='text'  value ='' id='ced_cliente' name='ced_cliente' size='35' readonly='readonly'></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td colspan='6'><div align='center'>Descripcion</div></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td align='center'>No. Contrato</td>".
            "        <td align='center'>Concepto</td>".
            "        <td align='center'>Matricula Inmueble</td>".
            "        <td align='center'>No. Cuota</td>".
            "        <td align='center'>Valor. Cuota</td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td >".$this->obtenerComboF("id_contrato", $idsP, $cantP, $idsP,"calcularCamposPago(this,'../consultas/consultas.php')")."</td>".
            "        <td align='center'><input type='text'  value ='' id='tip_contrato' name='tip_contrato' size='8'  readonly='readonly'></td>".
            "        <td ><input type='text'  value ='' id='num_matricula' name='num_matricula' size='35'  readonly='readonly'></td>".
            "        <td align='center'><div id='div_cuota'><input type='text'  value ='' id='num_cuota' name='num_cuota'  size='8'  readonly='readonly'></div></td>".
            "        <td align='center'><div id='div__val_cuota'><input type='text'  value ='' id='val_cuota' name='val_cuota' size='8'  readonly='readonly'></div></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td colspan='4' align='right'>Base sin IVA:</td>".
            "        <td align='center'><div id='div_cuota'><input type='text'  value ='' id='base_cuota' name='base_cuota'  size='8' readonly='readonly'></td></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td colspan='4' align='right'>IVA 16%:</td>".
            "        <td align='center'><div id='div_cuota'><input type='text'  value ='' id='iva_cuota' name='iva_cuota' size='8'  readonly='readonly'></td></td>".
            "      </tr>".
            "      <tr class='r2'>".
            "        <td colspan='4' align='right'>Total:</td>".
            "        <td align='center'><div id='div_cuota'><input type='text'  value ='' id='total_cuota' name='total_cuota'  size='8' readonly='readonly'></td></td>".
            "      </tr>".
            "      <tr>".
            "      <td colspan='5'>".
            "<div align='center'>".
            "<h5>Inmosys-Nit:830945930-1<br>".
            "Politecnico Grancolombiano CL 57 No. 3-00E<br>".
            "Bogota D.C<br>".
            "Tels:3468800 -3468801<br>".
            "Ventas Regimen Simplificado<br>".
            "E-mail:info@inmosys.com<br>".
            "</h5></div>".
            "      </td>".
            "      </tr>".
            "      <tr class='raction'>".
            "        <td colspan='2'><input  id='borrar_campos' class='but2' type='reset' value='Borrar' name='borrar_campos'></td>".
            "        <td colspan='2'><input  class='but' type='button' onclick='validar_generar_factura()' value='Descargar PDF'></td>".
            "      </tr>".
            "</table>".
            "  </td>".
            "  </tr>".
            "</table>".
            "<div id='LockScreen' class='LockOff'>".
                "<table id='customers'>".
                    "<caption>Calculando...</caption>".
                    "<tr>".
                            "<td>".
                                    "<br><img src='../files/images/loading.gif' alt=''/>".
                            "</td>".
                    "</tr>".
                "</table>".
            "</div>".
            "<table class='hidden_items'> ".
            "<tr>".
            "	<td>    ".
            "        <td >".$this->obtenerComboF("id_matricula", $nomP, $cantP, $idsP,"")."</td>".
            "        <td >".$this->obtenerComboF("id_cedulas", $ids_cli, $cantP, $ids_cli,"")."</td>".
            "        <td >".$this->obtenerComboF("id_valores", $vals_con, $cantP, $vals_con,"")."</td>".
            "        <td >".$this->obtenerComboF("id_tip_cons", $tips_con, $cantP, $tips_con,"")."</td>".
            "        <td colspan='2'><input  type='text' id='form_type' name='form_type' value='crear_factura' readonly='readonly'></td>".
                    "<td><input type='text' id='mouse' value='0'/></td>".
            "        <td colspan='2'><input  type='text' id='con_num' name='con_num' value='' readonly='readonly'></td>".
            "        <td colspan='2'><input  class='but' type='submit' id='send_form' value='Submit'></td>".
            "    </td>".
            "</tr>".
            "<tr>".
            "        <td colspan='5'><div id='div_res_query'></div></td>".
            "</tr>".
            "</table>".
            "</form></div>".
            "</body></html>";
    }

    public function imprimirVistaPagos($datos, $num)
    {
        $this->imprimirDoctype();
        print "<head>";
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("PAGOS");

        print "</head><body>";
        print "<table>"."<div align='center' ><div align='center' id='menu'>".
                "<table align='center' id='menu'>".
            "  <caption> <h2>".
            "    PAGOS".
            "  </h2></caption>".
                "<thead>".
                "<tr><td colspan ='9'><a href='javascript:window.history.back()'>Volver</a></td></tr>".
                "<th>Reg. Pago</th>".
                "<th>Tipo</th>".
                "<th>Valor Pago</th>".
                "<th>Fecha Pago</th>".
                "<th>No. Cuota</th>".
                "<th>Descripcion Pago</th>".
                "<th>No. Contrato</th>".
                "<th>Identificacion Cliente</th>".
                "<th>Nombre Cliente</th>".
                "</thead><tbody>";
        for($i=0;$i<$num;$i++)
        {
            $contratos = explode(";", $datos[$i]);
            print "<tr>";
            for($j=0;$j<sizeof($contratos);$j++)
            {
                if($j==1)
                    print "<td>".($contratos[$j]==1?"Venta":"Arriendo")."</td>";
                else
                    print "<td>".$contratos[$j]."</td>";
            }
            print "</tr>";
        }
        print "</tbody></table></table></div></div>".
            "</body></html>";
    }


    public function imprimirSeccionDireccion()
    {
        $tiposTVP = explode("%%","AC%%AK%%AU%%AV%%CC%%CL%%DG%%KR%%TV");
        $tiposNVP = explode("%%","A%%B%%C%%D%%E%%F%%G%%H%%I%%J%%K%%L%%M%%N%%O%%P%%Q%%R%%S%%T%%U%%V%%W%%X%%Y%%Z%%AA%%BB%%CC%%DD%%EE%%FF%%GG%%HH%%II%%JJ%%KK%%LL%%MM%%NN%%OO%%PP%%QQ%%RR%%SS%%TT%%UU%%VV%%WW%%XX%%YY%%ZZ");
        $tiposC01 = explode("%%","NORTE%%SUR%%ESTE%%OESTE");


        $res ="";
        $res = $res.
        "<div id='div_tab_dir' style=\"display:none\"><table id='menu'>".
        "<tr>".
        "<th>".   "Tipo Via". "</th>".
        "<th colspan='3'>".   "No. Via". "</th>".
        "<th colspan='3'>".   "Generadora". "</th>".
        "<th>".   "Placa". "</th>".
        "<th >".   "Cuadrante". "</th>".
        "</tr>".
        "<tr><td>".$this->obtenerComboF1("dir_TVP", $tiposTVP, 9, $tiposTVP, "completarCampoDireccion()",1)."</td>".
        "<td>"."<input onblur='completarCampoDireccion()' type='text'  id='dir_TVP0' name='dir_TVP0' maxlength='3' size ='4' onkeypress='return soloNumerosArea(event)'>"."</td>".
        "<td>"."<input onchange='completarCampoDireccion()' type=\"checkbox\" name=\"dir_bis\" id=\"dis_bis\" value=\"dir_bis\" /> Bis<br />"."</td>".
        "<td>".$this->obtenerComboF1("dir_NVP", $tiposNVP, 52, $tiposNVP, "completarCampoDireccion()",1)."</td>".
        "<td>No."."<input onblur='completarCampoDireccion()' type='text'  id='dir_C010' name='dir_C010' size ='4' maxlength='3' onkeypress='return soloNumerosArea(event)'>"."</td>".
        "<td>".$this->obtenerComboF1("dir_gen", $tiposNVP, 52, $tiposNVP, "completarCampoDireccion()",1)."</td>".
        "<td>-</td><td>"."<input onblur='completarCampoDireccion()' type='text'  id='dir_C0102' name='dir_C0102' size ='4' maxlength='3' onkeypress='return soloNumerosArea(event)'>"."</td>".
        "<td>".$this->obtenerComboF1("dir_C02", $tiposC01, 4, $tiposC01, "completarCampoDireccion()",1)."</td></tr>";
        return $res;
    }

    public function imprimirSeccionDireccionComplementaria()
    {
        $tiposComp01 = explode("%%","CONJ%%EDIF%%URB%%C.C.");
        $tiposComp02 = explode("%%","INT%%BL");
        $tiposComp03 = explode("%%","APTO%%CAS%%LOC");


        $res ="";
        $res = $res.
        "<tr>".
        "<th colspan='2'>".   "Nombre". "</th>".
        "<th colspan='2'>".   "Agrupación". "</th>".
        "<th colspan='2'>".   "Número". "</th>".
        "<th colspan='3'>".   "Enviar". "</th>".
        "</tr>".

        "<tr><td>".$this->obtenerComboF1("dir_Comp01", $tiposComp01, 4, $tiposComp01, "completarCampoDireccion()",1)."</td>".
        "<td >"."<input onblur='completarCampoDireccion()' type='text' id='dir_Comp011' name='dir_Comp011' maxlength='20' size ='20' onkeypress='return soloLetrasNum(event)' >"."</td>".
        "<td>".$this->obtenerComboF1("dir_Comp02", $tiposComp02, 2, $tiposComp02, "completarCampoDireccion()",1)."</td>".
        "<td>"."<input onblur='completarCampoDireccion()' type='text'  id='dir_Comp021' name='dir_Comp010' maxlength='3' size ='4' onkeypress='return soloLetrasNum(event)'>"."</td>".
        "<td>".$this->obtenerComboF1("dir_Comp03", $tiposComp03, 3, $tiposComp03, "completarCampoDireccion()",1)."</td>".
        "<td>"."<input onblur='completarCampoDireccion()' type='text'  id='dir_Comp031' name='dir_Comp031' maxlength='6' size ='6' onkeypress='return soloLetrasNum(event)'><td>".
        "<td colspan='2'><input type=button text='ok' value='ok' onclick='rellenarDivDireccion()' />".
        "</td></tr></table></div>";
        return $res;
    }

   public function imprimirVistaReporteVendedores($datos, $num)
   {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        $this->imprimirLinkJavascript("../libs/dhtmlgoodies_calendar.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/dhtmlgoodies_calendar.css");
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("INMUEBLES");
        print "</head><body>";
        print "<form name='vista_inmuebles' method='POST' action='../Vista/form_processor.php'><table>"."<div align='center' ><div align='center' id='menu'>".
                "<table align='center' id='menu'>".
            "  <caption> <h2>".
            "    REPORTE VENDEDORES".
            "  </h2></caption>".
                "<thead>".
                "<tr><td colspan ='15'><a href='javascript:window.history.back()'>Volver</a></td></tr>".
                "<th>Nombre</th>".
                "<th>Apellido</th>".
                "<th>No. Transacciones</th>".
                "<th>Tipo</th>".
                "<th>Fecha Ingreso</th>".
                "</thead><tbody>";
        for($i=0;$i<$num;$i++)
        {
            $inmueble = explode(";", $datos[$i]);
            print "<tr>";
            for($j=0;$j<  sizeof($inmueble);$j++)
            {
                print "<td>".$inmueble[$j]."</td>";
            }
            print "</tr>";
        }
        print "</tbody></table></table>".
            "<table class='hidden_items'> ".
            "<tr>".
            "	<td>    ".
            "        <td colspan='2'><input  type='text' id='form_type' name='form_type' value='vista_inmuebles'></td>".
            "        <td colspan='2'><input  type='text' id='id_inmueble' name='id_inmueble' value=''></td>".
            "        <td colspan='2'><input  class='but' type='submit' id='send_form' value='Submit'></td>".
            "    </td>".
            "</tr>".
            "</table>".
        "</div></div>".
            "</body></form></html>";
   }


   public function imprimirVistaReporteClientes($datos, $num)
   {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        $this->imprimirLinkJavascript("../libs/dhtmlgoodies_calendar.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/dhtmlgoodies_calendar.css");
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("REPORTE CLIENTES");
        print "</head><body>";
        print "<form name='vista_inmuebles' method='POST' action='../Vista/form_processor.php'><table>"."<div align='center' ><div align='center' id='menu'>".
                "<table align='center' id='menu'>".
            "  <caption> <h2>".
            "    REPORTE CLIENTES".
            "  </h2></caption>".
                "<thead>".
                "<tr><td colspan ='15'><a href='javascript:window.history.back()'>Volver</a></td></tr>".
                "<th>No. Cedula</th>".
                "<th>Nombre</th>".
                "<th>Telefono</th>".
                "<th>Celular</th>".
                "<th>E-Mail</th>".
                "<th>Total Contratos</th>".
                "</thead><tbody>";
        for($i=0;$i<$num;$i++)
        {
            $inmueble = explode(";", $datos[$i]);
            print "<tr>";
            for($j=0;$j<  sizeof($inmueble);$j++)
            {
                print "<td>".$inmueble[$j]."</td>";
            }
            print "</tr>";
        }
        print "</tbody></table></table>".
            "<table class='hidden_items'> ".
            "<tr>".
            "	<td>    ".
            "        <td colspan='2'><input  type='text' id='form_type' name='form_type' value='vista_inmuebles'></td>".
            "        <td colspan='2'><input  type='text' id='id_inmueble' name='id_inmueble' value=''></td>".
            "        <td colspan='2'><input  class='but' type='submit' id='send_form' value='Submit'></td>".
            "    </td>".
            "</tr>".
            "</table>".
        "</div></div>".
            "</body></form></html>";
   }

   public function imprimirVistaReporteContratos($datos, $num)
   {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        $this->imprimirLinkJavascript("../libs/dhtmlgoodies_calendar.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/dhtmlgoodies_calendar.css");
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("REPORTES CONTRATOS");
        print "</head><body>";
        print "<form name='vista_inmuebles' method='POST' action='../Vista/form_processor.php'><table>"."<div align='center' ><div align='center' id='menu'>".
                "<table align='center' id='menu'>".
            "  <caption> <h2>".
            "    REPORTES CONTRATOS".
            "  </h2></caption>".
                "<thead>".
                "<tr><td colspan ='15'><a href='javascript:window.history.back()'>Volver</a></td></tr>".
                "<th>No. Contrato</th>".
                "<th>Nombre Cliente</th>".
                "<th>Nombre Vendedor</th>".
                "<th>Apellido Vendedor</th>".
                "<th>Valor Contrato</th>".
                "</thead><tbody>";
        for($i=0;$i<$num;$i++)
        {
            $inmueble = explode(";", $datos[$i]);
            print "<tr>";
            for($j=0;$j<  sizeof($inmueble);$j++)
            {
                print "<td>".$inmueble[$j]."</td>";
            }
            print "</tr>";
        }
        print "</tbody></table></table>".
            "<table class='hidden_items'> ".
            "<tr>".
            "	<td>    ".
            "        <td colspan='2'><input  type='text' id='form_type' name='form_type' value='vista_inmuebles'></td>".
            "        <td colspan='2'><input  type='text' id='id_inmueble' name='id_inmueble' value=''></td>".
            "        <td colspan='2'><input  class='but' type='submit' id='send_form' value='Submit'></td>".
            "    </td>".
            "</tr>".
            "</table>".
        "</div></div>".
            "</body></form></html>";
   }


   public function imprimirVistaReporteInmuebles($datos, $num)
   {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        $this->imprimirLinkJavascript("../libs/dhtmlgoodies_calendar.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/dhtmlgoodies_calendar.css");
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("REPORTES INMUEBLES");
        print "</head><body>";
        print "<form name='vista_inmuebles' method='POST' action='../Vista/form_processor.php'><table>"."<div align='center' ><div align='center' id='menu'>".
                "<table align='center' id='menu'>".
            "  <caption> <h2>".
            "    REPORTE INMUEBLES".
            "  </h2></caption>".
                "<thead>".
                "<tr><td colspan ='15'><a href='javascript:window.history.back()'>Volver</a></td></tr>".
                "<th>ID Inmueble</th>".
                "<th>No. Matricula</th>".
                "<th>No. Ventas</th>".
                "<th>Total Disponibilidad</th>".
                "</thead><tbody>";
        for($i=0;$i<$num;$i++)
        {
            $inmueble = explode(";", $datos[$i]);
            print "<tr>";
            for($j=0;$j<  sizeof($inmueble);$j++)
            {
                print "<td>".$inmueble[$j]."</td>";
            }
            print "</tr>";
        }
        print "</tbody></table></table>".
            "<table class='hidden_items'> ".
            "<tr>".
            "	<td>    ".
            "        <td colspan='2'><input  type='text' id='form_type' name='form_type' value='vista_inmuebles'></td>".
            "        <td colspan='2'><input  type='text' id='id_inmueble' name='id_inmueble' value=''></td>".
            "        <td colspan='2'><input  class='but' type='submit' id='send_form' value='Submit'></td>".
            "    </td>".
            "</tr>".
            "</table>".
        "</div></div>".
            "</body></form></html>";
   }

   public function imprimirVistaReportePagosArriendo($datos, $num)
   {
        $this->imprimirDoctype();
        $this->imprimirLinkJavascript("../libs/funciones_generales.js");
        $this->imprimirLinkJavascript("../libs/dhtmlgoodies_calendar.js");
        print "<head>";
        $this->imprimirLinkCss("../CSS/dhtmlgoodies_calendar.css");
        $this->imprimirLinkCss("../CSS/tablas.css");
        $this->imprimirLinkCss("../CSS/basic_header.css");
        print "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        $this->tituloPagina("INMUEBLES");
        print "</head><body>";
        print "<form name='vista_inmuebles' method='POST' action='../Vista/form_processor.php'><table>"."<div align='center' ><div align='center' id='menu'>".
                "<table align='center' id='menu'>".
            "  <caption> <h2>".
            "    REPORTE PAGOS CLIENTES".
            "  </h2></caption>".
                "<thead>".
                "<tr><td colspan ='15'><a href='javascript:window.history.back()'>Volver</a></td></tr>".
                "<th>Cedula Cliente</th>".
                "<th>Nombre Cliente</th>".
                "<th>No. Contratos</th>".
                "<th>Total a Pagar</th>".
                "<th>Fecha Pago</th>".
                "</thead><tbody>";
        for($i=0;$i<$num;$i++)
        {
            $inmueble = explode(";", $datos[$i]);
            print "<tr>";
            for($j=0;$j<  sizeof($inmueble);$j++)
            {
                print "<td>".$inmueble[$j]."</td>";
            }
                print "<td>".date("Y-m-d")."</td>";
            print "</tr>";
        }
            print "<tr><td colspan='5'>Reporte informativo de pago a clientes referentes a contratos de arrendamiento vigentes".
                    "</td></tr>";
        print "</tbody></table></table>".
            "<table class='hidden_items'> ".
            "<tr>".
            "	<td>    ".
            "        <td colspan='2'><input  type='text' id='form_type' name='form_type' value='vista_inmuebles'></td>".
            "        <td colspan='2'><input  type='text' id='id_inmueble' name='id_inmueble' value=''></td>".
            "        <td colspan='2'><input  class='but' type='submit' id='send_form' value='Submit'></td>".
            "    </td>".
            "</tr>".
            "</table>".
        "</div></div>".
            "</body></form></html>";
   }
}
?>