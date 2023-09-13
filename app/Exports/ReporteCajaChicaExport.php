<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\ShouldAutoSize; //Para que se acomoden las celdas al tamaño del texto
use Maatwebsite\Excel\Concerns\Exportable;  //Para modificar el formato en el que se exporta
use Maatwebsite\Excel\Concerns\FromCollection;  //Para poder utilizar una coleccion de datos ya hecha
use Maatwebsite\Excel\Concerns\WithTitle;   //Para ponerle un titulo a la pagina 
use Maatwebsite\Excel\Concerns\WithHeadings;    //para ponerle encabezados a las columnas
use Illuminate\Support\Collection;  //para usar la collecion de datos
use Maatwebsite\Excel\Concerns\WithStyles; //Para utilizar estilos
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;   //Dependencia de estilos
use PhpOffice\PhpSpreadsheet\Style\Fill;    //Dependencia de estilos
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;    //Dar formatos especificos a columnas (numeros, fechas, etc...)
use Maatwebsite\Excel\Concerns\WithColumnFormatting; //Dar formatos especificos a columnas (numeros, fechas, etc...)

class ReporteCajaChicaExport implements FromCollection, ShouldAutoSize, WithTitle, WithHeadings, WithStyles, WithColumnFormatting
{

    use Exportable;
    protected $query;

    public function __construct(Collection $query)
    {
        $this->query = $query;
    }

    public function collection()
    {
        return $this->query;
    }

    //Personalisacion 

    public function title(): string
    {
        return 'Caja Chica';
    }

    public function headings(): array
    {
        // Define los encabezados de columna como un array.
        return [
            'Id',
            'dia',
            'Codigo',
            'Concepto',
            'N. Comprobante',
            'comprobante',
            'Personal Nombre',
            'Personal Apellido',
            'cliente',
            'Obra',
            'Numero Economico',
            'Maquinaria',
            'Cantidad',
            'tipo',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Aplica estilos personalizados a los encabezados de columna.
        $sheet->getStyle('A1:' . $sheet->getHighestColumn() . '1')->applyFromArray([
            'font' => [
                'bold' => true, // Puedes hacer que los encabezados sean negritas.
                'color' => ['rgb' => '000000'], // Cambia 'FF0000' al código de color que desees.
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '198759'], // Cambia 'FFFF00' al código de color de fondo que desees.
            ],
        ]);
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_GENERAL,
            'B' => NumberFormat::FORMAT_DATE_DMMINUS,
            'M' => NumberFormat::FORMAT_ACCOUNTING_USD,
            // 'C' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
        ];
    }
}
