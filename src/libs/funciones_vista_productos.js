
function generar_matriz_actualizacion()
{
    var rta = document.vista_productos.info_actualizar;
    rta.value="";
    var str ="";
    var sel =0;
    for(var i=0; i<document.vista_productos.cant_regs.value; i++)
    {
        str = "erase_"+i;
        var chk = document.getElementById(str);
        if(chk.checked)
        {
            if(rta.value.length==0)
                rta.value = document.getElementById("id_"+i).value+";"+document.getElementById("tip_"+i).value+";"+document.getElementById("desc_"+i).value+";"+document.getElementById("cost_"+i).value;
            else
                rta.value = rta.value+"%%"+document.getElementById("id_"+i).value+";"+document.getElementById("tip_"+i).value+";"+document.getElementById("desc_"+i).value+";"+document.getElementById("cost_"+i).value;
            sel=sel+1;
        }
    }
    document.vista_productos.cant_modif.value = sel;
    document.vista_productos.act_type.value = '0';
    if (sel>0)
        document.vista_productos.send_form.click();
    else
        alert("Favor seleccione los productos modificados");
}

function generar_matriz_borrado()
{
    var rta = document.vista_productos.info_actualizar;
    rta.value="";
    var str ="";
    var sel =0;
    for(var i=0; i<document.vista_productos.cant_regs.value; i++)
    {
        str = "erase_"+i;
        var chk = document.getElementById(str);
        if(chk.checked)
        {
            if(rta.value.length==0)
                rta.value = document.getElementById("id_"+i).value;
            else
                rta.value = rta.value+";"+document.getElementById("id_"+i).value;
            sel=sel+1;
        }
    }
    document.vista_productos.cant_modif.value = sel;
    document.vista_productos.act_type.value = '1';
    if (sel>0)
        document.vista_productos.send_form.click();
    else
        alert("Favor seleccione los productos modificados");
}
