
function validar_cliente()
{
    //nombre cliente
    if(document.crear_cliente.nombre_cliente.value.length==0)
            alert('Error: Favor complete el nombre del cliente');
    else if(document.crear_cliente.tipo_doc_cliente.selectedIndex==0)
            alert('Error: Favor Seleccione el tipo de documento');
    else if(document.crear_cliente.cedula_cliente.value.length==0)
            alert('Error: Favor complete la cedula del cliente');
    else if(document.crear_cliente.telf_cliente.value.length==0)
            alert('Error: Favor complete el telefono fijo del cliente');
    else if(document.crear_cliente.telf_cliente.value.length!=7)
            alert('Error: El numero telefonico fijo debe tener 7 digitos');
    else if(document.crear_cliente.telc_cliente.value.length==0)
            alert('Error: Favor complete el telefono celular del cliente');
    else if(document.crear_cliente.telc_cliente.value.length!=10)
            alert('Error: El numero telefonico celular debe tener 10 digitos');
    else if(document.crear_cliente.email_cliente.value.length==0)
            alert('Error: Favor complete el email del cliente');
    else if(document.crear_cliente.dir_cliente.value.length==0)
            alert('Error: Favor complete la direccion del cliente');
    else if(!validarRadio(document.crear_cliente.sexo_cliente))
            alert('Error: Favor complete el genero del cliente');    
    else if (!validarEmail(document.crear_cliente.email_cliente))
            alert('Error: La direccion email es invalida');
    else
    {
        copiarValorCampo(document.crear_cliente.tipo_doc_cliente,document.crear_cliente.id_tipo_doc);
        document.crear_cliente.submit();            
    }
}

function soloNumerosTelefonicos(evt)
{
   var charCode = ( evt.which ) ? evt.which : evt.keyCode;
   return ( (charCode >= 48 && charCode <= 57) || (charCode>=8 && charCode<=11) || 
       charCode==14 || charCode==15);
}

function generar_matriz_actualizacion()
{
    var rta = document.vista_clientes.info_actualizar;
    rta.value="";
    var str ="";
    var sel =0;
    for(var i=0; i<document.vista_clientes.cant_regs.value; i++)
    {
        str = "erase_"+i;
        var chk = document.getElementById(str);
        if(chk.checked)
        {
            if(rta.value.length==0)
                rta.value = document.getElementById("ced_"+i).value+";"+document.getElementById("tel_"+i).value+";"+document.getElementById("cel_"+i).value+";"+document.getElementById("email_"+i).value+";"+document.getElementById("dir_"+i).value;
            else
                rta.value = rta.value+"%%"+document.getElementById("ced_"+i).value+";"+document.getElementById("tel_"+i).value+";"+document.getElementById("cel_"+i).value+";"+document.getElementById("email_"+i).value+";"+document.getElementById("dir_"+i).value;
            sel=sel+1;
        }
    }
    document.vista_clientes.cant_modif.value = sel;
    document.vista_clientes.act_type.value = '0';
    if (sel>0)
        {
           // document.vista_clientes.send_form.click();
        }
    else
        alert("Favor seleccione los usuarios modificados");
}

function generar_matriz_borrado()
{
    var rta = document.vista_clientes.info_actualizar;
    rta.value="";
    var str ="";
    var sel =0;
    for(var i=0; i<document.vista_clientes.cant_regs.value; i++)
    {
        str = "erase_"+i;
        var chk = document.getElementById(str);
        if(chk.checked)
        {
            if(rta.value.length==0)
                rta.value = document.getElementById("ced_"+i).value+";";
            else
                rta.value = rta.value+document.getElementById("ced_"+i).value+";";
            sel=sel+1;
        }
    }
    document.vista_clientes.cant_modif.value = sel;
    document.vista_clientes.act_type.value = '1';
    if (sel>0)
    {
        //document.vista_clientes.send_form.click();
    }
    else
        alert("Favor seleccione los usuarios modificados");
}
