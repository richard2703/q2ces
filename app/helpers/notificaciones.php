<?php

namespace App\Helpers;

class Notificaciones
 {

    public function registrar( $strValor ) {
        $intValor = trim( $strValor );
        if ( is_numeric( trim( $intValor ) ) == true ) {
            return $intValor;
        } else {
            return null;
        }
    }

}
