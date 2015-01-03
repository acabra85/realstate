function OnLockScreen(str) 
{ 
	document.getElementById('mouse').value="1"
	var lock = document.getElementById('LockScreen'); 
	if (lock) 
		lock.className = 'LockOn'; 

	//lock.innerHTML = str+ lock.innerHTML; 	
} 

function OffLockScreen() 
{ 
	document.getElementById('mouse').value="0"
	var lock = document.getElementById('LockScreen'); 
	if (lock) 
		lock.className = 'LockOff'; 
	//document.getElementById('digitoV').value = calcularDigito(document.getElementById('nit').value);
} 
function conteoRegresivo()
{
	 if(document.getElementById('mouse').value!="0")
            setTimeout("OffLockScreen()", 1500);
}

function calcularDigito(a)
{
	if (a.length==0 || isNaN(a)) return -1;
	var pesos = new Array();
	var acumulado = 0;
	var aux_nit = 0;
	var i = 0;
	var digito_v = -1;
	var aux = 0;
	
    pesos[0] = 3;
    pesos[1] = 7;
    pesos[2] = 13;
    pesos[3] = 17;
    pesos[4] = 19;
    pesos[5] = 23;
    pesos[6] = 29;
    pesos[7] = 37;
    pesos[8] = 41;
    pesos[9] = 43;
    pesos[10] = 47;
    pesos[11] = 53;
    pesos[12] = 59;	
    pesos[13] = 67;
    pesos[14] = 71;
	
	if (a.length > 15 ) return -1;
	aux_nit = parseInt(a);
	while (aux_nit != 0 )
	{
		aux = aux_nit - ( Math.floor( aux_nit / 10 ) * 10 );
        acumulado = acumulado + ( aux * pesos[i] );
        aux_nit = Math.floor(aux_nit / 10);
        i = i + 1;
	}
    acumulado = acumulado - Math.floor( acumulado / 11 ) * 11;
    if (acumulado == 0 || acumulado == 1)
        digito_v = acumulado;
    else
        digito_v = 11 - acumulado;
	
	return digito_v;
}