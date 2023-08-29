<?php

namespace App\Models;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\maquinaria;

class MaquinariaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // dd('$row', $row);
        return new maquinaria([
            'identificador' => $row['n'],
            'nombre' => $row['vehiculo'],
            'marcaId' => $row['marca'],
            'modelo' => $row['modelo'],
            'nummotor' => $row['n_de_motor'],
            'numserie' => $row['n_de_serie'],
            'placas' => $row['placas'],
            'compania' => 'mtq',
            'estatusId' => 1,
        ]);
    }
}
