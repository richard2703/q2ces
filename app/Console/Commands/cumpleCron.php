<?php

namespace App\Console\Commands;

use App\Models\calendarioPrincipal;
use App\Models\eventosCalendarioTipos;
use App\Models\personal;
use Carbon\Carbon;
use Illuminate\Console\Command;

class cumpleCron extends Command
{
    protected $signature = 'cumple:cron';
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $mesActual = Carbon::now()->addMonth()->month;

        $personales = Personal::select(
            'personal.*',
            'puesto.nombre as puesto',
            'userEstatus.nombre AS estatus'
        )
            ->join('nomina', 'nomina.personalId', '=', 'personal.id')
            ->join('userEstatus', 'userEstatus.id', '=', 'personal.estatusId')
            ->leftJoin('puesto', 'puesto.id', '=', 'nomina.puestoId')
            ->whereRaw('MONTH(personal.fechaNacimiento) = ?', [$mesActual])->where('personal.estatusId', 1)->get();

        $eventosCalendarioTipos = eventosCalendarioTipos::where('tipoEvento', 'cumple')->first();

        foreach ($personales as $dia) {
            $fechaNacimiento = Carbon::parse($dia['fechaNacimiento']);

            // Verifica si el mes actual es enero
            if (Carbon::now()->month === 12) {
                $fechaNacimiento->year(Carbon::now()->year + 1);
            } else {
                $fechaNacimiento->year(Carbon::now()->year);
            }

            $eventoCalendario = new calendarioPrincipal();
            $eventoCalendario->title = 'Cumpleaños: ' . $dia['nombres'];
            $eventoCalendario->start = strtoupper($fechaNacimiento->toDateString());
            $eventoCalendario->descripcion = 'Este Día Cumple Años: ' . $dia['apellidoP'] . ', ' . $dia['apellidoM'] . ', ' . $dia['nombres'] . ', ¡Felicitaciones!';
            $eventoCalendario->color = $eventosCalendarioTipos['color'];
            $eventoCalendario->tipoEvento = 'cumple';
            $eventoCalendario->estadoId = 3;
            $eventoCalendario->userId = $dia['userId'];
            $eventoCalendario->save();
        }
    }
}
