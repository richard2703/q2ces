<?php

namespace App\Exports;

use App\Models\asistencia;
use Maatwebsite\Excel\Concerns\FromCollection;

class CorteSemanalExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return asistencia::all();
    }
}
