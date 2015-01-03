

function completarCampoDireccion()
{
    var a=document.getElementById('dir_TVP');//combo
    var b=document.getElementById('dir_TVP0');//text
    var c=document.getElementsByName("dir_bis");//check
    var d=document.getElementById('dir_NVP');//combo
    var e=document.getElementById('dir_C010');//text
    var f=document.getElementById('dir_gen');//combo
    var g=document.getElementById('dir_C0102');//text
    var h=document.getElementById('dir_C02');//comb
    var i=document.getElementById('dir_Comp01');//combo/
    var j=document.getElementById('dir_Comp011');//text
    var k=document.getElementById('dir_Comp02');//comb
    var l=document.getElementById('dir_Comp021');//text
    var m=document.getElementById('dir_Comp03');//comb
    var n=document.getElementById('dir_Comp031');//text

    var a1 = a.options[a.selectedIndex].text+" "+b.value;
    var b1 = c[0].checked?"bis ":" ";
    var d1 = (d.selectedIndex!=0?d.options[d.selectedIndex].text:"")+" No. "+e.value+(f.selectedIndex!=0?f.options[f.selectedIndex].text+"":"");
    var e1 = g.value;
    
    var i1=(i.selectedIndex!=0?i.options[i.selectedIndex].text+" "+j.value:"");
    var k1 =(k.selectedIndex!=0?k.options[k.selectedIndex].text+" "+l.value:"");
    var l1 =(m.selectedIndex!=0?m.options[m.selectedIndex].text+" "+n.value:"");
    var h1 =(h.selectedIndex!=0?h.options[h.selectedIndex].text+" ":" ");
    var tmp = a1+b1+d1+"-"+e1+" "+h1+i1+" "+k1+" "+l1;
    document.getElementById('direccion_inm').value=tmp;
}

function validarDireccion()
{
    var a=document.getElementById('dir_TVP');//combo
    var b=document.getElementById('dir_TVP0');//text
    var c=document.getElementsByName("dir_bis");//check
    var d=document.getElementById('dir_NVP');//combo
    var e=document.getElementById('dir_C010');//text
    var f=document.getElementById('dir_gen');//combo
    var g=document.getElementById('dir_C0102');//text
    var h=document.getElementById('dir_C02');//comb
    var i=document.getElementById('dir_Comp01');//combo/
    var j=document.getElementById('dir_Comp011');//text
    var k=document.getElementById('dir_Comp02');//comb
    var l=document.getElementById('dir_Comp021');//text
    var m=document.getElementById('dir_Comp03');//comb
    var n=document.getElementById('dir_Comp031');//text
    if(a.selectedIndex==0 || b.value.length==0)
        alert('Error: Favor Complete tipo y número de via principal');
    else if(e.value.lenght==0)
        alert('Error: Favor Complete el número de la Generadora');
    else if(g.value.lenght==0)
        alert('Error: Favor Complete el número de la placa');
    else if(i.selectedIndex!=0 && j.value.lenght==0)
        alert('Error: Favor Indique el nombre del tipo de agrupación del inmueble');
    else if(k.selectedIndex!=0 && l.value.lenght==0)
        alert('Error: Favor Indique el nombre del tipo de agrupación del inmueble');
    else if(m.selectedIndex!=0 && n.value.lenght==0)
        alert('Error: Favor Indique el nombre del tipo de agrupación del inmueble');
    else
        return true;
    return false;
}

function rellenarDivDireccion()
{
    if(validarDireccion())
    {
        document.getElementById('div_res_dir').innerHTML=document.getElementById('direccion_inm').value;
        mostrarDireccion();
    }
}


function soloNumerosArea(evt)
{
     var charCode = ( evt.which ) ? evt.which : evt.keyCode;
   return ( (charCode >= 48 && charCode <= 57) || (charCode>=8 && charCode<=11) ||
       charCode==14 || charCode==15 || charCode==46);
}

function mostrarDireccion()
{
    var obj=document.getElementById('div_tab_dir');
    if(obj.style.display=='none')
    {
               $(document).ready(function(){
                   $("#div_tab_dir").show(500);
               });
    }
    else
    {
               $(document).ready(function(){
                   $("#div_tab_dir").hide(500);
               });
    }
}