<?php

namespace App\Helpers;


class Validaciones
{
    /*     public function validaFecha($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
 */
    public function validaNumero($strValor)
    {
        $intValor = trim($strValor);
        if (is_numeric(trim($intValor)) == true) {
            return $intValor;
        } else {
            return null;
        }
    }

    public function validaTexto($strValor, $intMaxLen = 250)
    {
        $strCadena = trim($strValor);
        if (strlen($strCadena) >= $intMaxLen) {
            $strCadena =  substr($strCadena, 0, $intMaxLen);
        } else {
            return $strCadena;
        }
        // echo "Regresamos: " . substr($strCadena, 0, $intMaxLen) . " Size: " . strlen($strCadena) . "<br>";
        return  $strCadena;
    }

    public function validaTelefono($strValor, $intMaxLen = 16)
    {
        $strCadena = preg_replace("/^[0-9]{3}\-[0-9]{3}\-[0-9]{3}$/", '', trim($strValor));
        if (strlen($strCadena) >= $intMaxLen) {
            $strCadena =  substr($strCadena, 0, $intMaxLen);
        } else {
            return $strCadena;
        }
        return $strCadena;
    }


    public function validaEmail($strValor, $intMaxLen = 200)
    {
        $strCadena = preg_replace("#^(((( [a-z\d]  [\.\-\+_] ?)*) [a-z0-9] )+)\@(((( [a-z\d]  [\.\-_] ?){0,62}) [a-z\d] )+)\.( [a-z\d] {2,6})$#i", '', trim($strValor));
        if (filter_var($strCadena, FILTER_VALIDATE_EMAIL)) {
            return $strCadena;
        }

        /*   if (strlen($strCadena) >= $intMaxLen) {
            return  substr($strCadena, 0, $intMaxLen);
        } else {
            echo "Regresamos: " . substr($strCadena, 0, $intMaxLen) . " Size: " . strlen($strCadena) . "<br>";
            return $strCadena;
        } */
    }

    /**
     * Convierte los elementos del array de string a entero para realizar comparacion
     *
     * @param [array] $arreglo El arreglo de valores a convertir
     * @return void Un arreglo con los valores convertidos a enteros
     */
    public function preparaArreglo($arreglo)
    {
        if (is_array($arreglo) == true) {
            $vctArreglo = null;
            for ($i = 0; $i < count($arreglo); $i++) {
                $vctArreglo[] = (int)$arreglo[$i];
            }

            return  $vctArreglo;
        } else {
            return false;
        }
    }

    /**
     * Valida que sea un arreglo y que tenga elementos
     *
     * @param array $vctArreglo el arreglo a validar
     * @return boolean True si es arreglo y tiene datos, False en caso contrario
     */
    public function validaArreglo($vctArreglo)
    {
        if (collect($vctArreglo)->isEmpty() == false) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Convierte la primer letra de cada palabra a mayuscula
     *
     * @param string $string
     * @return void
     */
   public function ucwords_accent($string)
    {
        if (mb_detect_encoding($string) != 'UTF-8') {
            $string = mb_convert_case(utf8_encode($string), MB_CASE_TITLE, 'UTF-8');
        } else {
            $string = mb_convert_case($string, MB_CASE_TITLE, 'UTF-8');
        }
        return $string;
    }


}
