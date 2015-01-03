<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Enum
 *
 * @author Agustin
 */
final class CodRes {
    const USUARIO_INVALIDO  = 0;
    const EXITO   = 1;
    const CLAVE_INVALIDA= 2;
    const SIN_REGISTROS = 3;
    const DATOS_INVALIDOS= 4;
    const REGISTRO_REPETIDO= 5;
    const DATOS_VACIOS= 6;
    const UNKNOWN = 7;
    const LONGITUD_INVALIDA = 8;
    const NUMERO_NEGATIVO = 9;
    const ERRORES_FECHAS= 10;
    const NO_CONNECTED= 11;
    const EXITO_0   = 12;
    const EXITO_1   = 13;
    const MISMO_CLIENTE = 14;
    const CONTRATO_INEXISTENTE = 15;
    const INMUEBLE_INEXISTENTE = 16;
    const PROPIETARIO_INMUEBLE =17;
    const DURACION_CONTRATO = 18;
    const PROPIEDAD_ARRENDADA = 19;
    const CLIENTE_INEXISTENTE =20;
    

    // ensures that this class acts like an enum
    // and that it cannot be instantiated
    private function __construct(){}
}
?>
