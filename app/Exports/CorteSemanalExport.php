<?php

namespace App\Exports;

use App\Models\asistencia;
use Maatwebsite\Excel\Concerns\FromCollection;
namespace App\Exports;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
//Para que se acomoden las celdas al tamaño del texto
use Maatwebsite\Excel\Concerns\Exportable;
//Para modificar el formato en el que se exporta
use Maatwebsite\Excel\Concerns\FromCollection;
//Para poder utilizar una coleccion de datos ya hecha
use Maatwebsite\Excel\Concerns\WithTitle;
//Para ponerle un titulo a la pagina
use Maatwebsite\Excel\Concerns\WithHeadings;
//para ponerle encabezados a las columnas
use Illuminate\Support\Collection;
//para usar la collecion de datos
use Maatwebsite\Excel\Concerns\WithStyles;
//Para utilizar estilos
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
//Dependencia de estilos
use PhpOffice\PhpSpreadsheet\Style\Fill;
//Dependencia de estilos
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
//Dar formatos especificos a columnas ( numeros, fechas, etc... )
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
//Dar formatos especificos a columnas ( numeros, fechas, etc... )

use App\Models\asistencia;
use App\Models\personal;
use App\Helpers\Calendario;
use App\Http\Controllers\asistenciaController;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CorteSemanalExport implements   ShouldAutoSize, WithTitle, WithHeadings, WithStyles, WithColumnFormatting, FromView {

    use Exportable;
    protected $query;

    public function view(): View {
        $objCalendario = new Calendario();

        $data = request()->all();
        if ( is_array( $data ) == true && count( $data ) > 0 ) {
            $intMes = $data[ 'intMes' ];
            $intAnio = $data[ 'intAnio' ];
            $intDia = date( 'd' );
            //$data[ 'intDia' ];
        } else {
            $intMes = date( 'm' );
            $intAnio = date( 'Y' );
            $intDia = date( 'd' );
        }
        //  dd( $data );
        //return view( 'asistencias.corteSemanal',  compact( 'usuario', 'vctAsistencias',   'asistencias', 'listaAsistencia', 'intDia', 'intMes', 'intAnio', 'strFechaInicioPeriodo', 'strFechaFinPeriodo' ) );

        $strDate = $intAnio . '-' . $intMes . '-' . $intDia;
        $vctFechas =  $objCalendario->getSemanaTrabajo( date_create( $strDate ), 3 );
        $strFechaInicioPeriodo = $vctFechas[ 0 ]->format( 'Y-m-d' );
        $strFechaFinPeriodo = $vctFechas[ 1 ]->format( 'Y-m-d' );
        $strPeriodoCorte = 'PERIODO: ' . $vctFechas[ 0 ]->format( 'W' )  ;
        $strSemanaCorte = $objCalendario->getPeriodoFormateado ($vctFechas[ 0 ] ,$vctFechas[ 1 ],true);

        $usuario = personal::where( 'userId', auth()->user()->id )->first();
        // $personal = personal::where( 'id', $personalId )->first();

        $vctAsistencias =  asistenciaController::getCalculoCorteSemanal( $intAnio, $intMes, $intDia );

        // dd( $strPeriodoCorte, $strSemanaCorte,  $vctAsistencias );

        return view( 'asistencias.reporteCorteSemanal', compact( 'vctAsistencias', 'strPeriodoCorte', 'strSemanaCorte' ) );

    }

    // public function __construct( Collection $query ) {
    //     $this->query = $query;
    // }

    // public function collection() {
    //     return $this->query;
    // }

    //Personalisacion

    public function title(): string {
        return 'Corte Semanal';
    }

    public function headings(): array {
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

    public function styles( Worksheet $sheet ) {
        // Aplica estilos personalizados a los encabezados de columna.
        $sheet->getStyle( 'A1:' . $sheet->getHighestColumn() . '1' )->applyFromArray( [
            'font' => [
                'bold' => true, // Puedes hacer que los encabezados sean negritas.
                'color' => [ 'rgb' => '000000' ], // Cambia 'FF0000' al código de color que desees.
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [ 'rgb' => '198759' ], // Cambia 'FFFF00' al código de color de fondo que desees.
            ],
        ] );
    }

    public function columnFormats(): array {
        return [
            'A' => NumberFormat::FORMAT_GENERAL,
            'B' => NumberFormat::FORMAT_DATE_DMMINUS,
            'M' => NumberFormat::FORMAT_ACCOUNTING_USD,
            // 'C' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
        ];
    }
}
