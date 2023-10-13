<table>
    <thead>
        <tr>
            <td colspan="9"><h1>REPORTE RELACION DE PERSONAL DE NOMINA </h1></td>
        </tr>
        <tr>
            <td>{{ $strPeriodoCorte }}</td>
            <td>SEMANA: </td>
            <td colspan="3">{{ $strSemanaCorte }}</td>
        </tr>
        <tr>
            <th>CÓDIGO</th>
            <th>EMPLEADO</th>
            <th>PUESTO</th>
            <th>DÍAS</th>
            <th>SALARIO POR DÍA</th>
            <th>IMPORTE SEMANAL</th>
            <th>TIEMPO EXTRA ACUMULADO</th>
            <th>HORAS EXTRA</th>
            <th>COSTO POR HORAS EXTRA (BASE)</th>
            <th>TOTAL HORAS EXTRA</th>
            <th>PAGO SEMANAL</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $decTotalExtras = 0;
        $decTotalGeneral = 0;
        ?>
        @foreach ($vctAsistencias as $item)
            <tr>
                <td>{{ $item->numEmpleado }}</td>
                <td>{{ $item->empleado }}</td>
                <td>{{ $item->puesto }}</td>
                <td>{{ $item->nominaDias }}</td>
                <td>$ {{ number_format($item->sueldo, 2) }}</td>
                <td>$ {{ number_format($item->nominaImporte, 2) }}</td>
                <td>{{ $item->nominaTiempoExtra }}</td>
                <td>{{ $item->nominaHorasExtras }}</td>
                <td>{{ $item->costoHoraExtra }}</td>
                <td>$ {{ number_format($item->nominaImporteHorasExtras, 2) }}</td>
                <td>$ {{ number_format($item->nominaPagoSemanal, 2) }}</td>
                <?php
                $decTotalExtras += $item->nominaImporteHorasExtras;
                $decTotalGeneral += $item->nominaPagoSemanal;
                ?>
            </tr>
        @endforeach

        <tr>
            <td colspan="9">TOTALES GENERALES</td>
            <td>$ {{ number_format($decTotalExtras, 2) }}</td>
            <td>$ {{ number_format($decTotalGeneral, 2) }}</td>
        </tr>
    </tbody>
</table>
