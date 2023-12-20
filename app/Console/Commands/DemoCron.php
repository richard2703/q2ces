<?php

namespace App\Console\Commands;

use App\Models\calendarioPrincipal;
use App\Models\eventosCalendarioTipos;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class DemoCron extends Command
{
    protected $signature = 'demo:cron';
    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Obtener el año actual
        $anoActual = date('Y');

        // URL de la API
        $url = 'https://api.generadordni.es/v2/holidays/holidays?country=MX&year=' . $anoActual;

        // Crear instancia de cliente Guzzle
        $client = new Client();

        try {
            // Realizar petición GET a la URL
            $response = $client->get($url);

            // Obtener el cuerpo de la respuesta
            $data = $response->getBody()->getContents();

            // Enviar datos al controlador (simulación)
            $this->enviarDatosAlControlador(json_decode($data, true));

            // Manejar la respuesta del controlador (simulación)
            $this->info('Datos enviados al controlador');
        } catch (\Exception $e) {
            // Manejar errores
            $this->error($e->getMessage());
        }

        return 0;
    }

    private function enviarDatosAlControlador($data)
    {
        foreach ($data as $dia) {
            $eventosCalendarioTipos = eventosCalendarioTipos::where('tipoEvento', 'DiaFeriado')->first();
            $eventoCalendario = new calendarioPrincipal();
            $eventoCalendario->title = 'Feriado: ' . $dia['name']; // Accede a 'name' dentro de cada día
            $eventoCalendario->start = strtoupper($dia['date']); // Accede a 'date' dentro de cada día
            $eventoCalendario->descripcion = 'Este día es festivo porque es: ' . $dia['name']; // Accede a 'name' dentro de cada día
            $eventoCalendario->color = $eventosCalendarioTipos['color'];
            $eventoCalendario->tipoEvento = 'DiaFeriado';
            $eventoCalendario->estadoId = 3;
            $eventoCalendario->userId = 1;
            $eventoCalendario->save();
        }
    }
}
