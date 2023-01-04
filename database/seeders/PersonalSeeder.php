<?php

namespace Database\Seeders;

use App\Models\personal;
use App\Models\nomina;
use App\Models\userdocs;
use App\Models\beneficiario;
use App\Models\contactos;
use App\Models\equipo;
use App\Models\fiscal;
use Illuminate\Database\Seeder;

class PersonalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** Cuenta de administrador */
        $user = personal::create([
            'nombres' => 'Administrador',
            'apellidoP' => 'Proyecto',
            'apellidoM' => 'Q2ces',
            'mailEmpresarial' => 'a@a.com',
            'userId' => '1'
        ]);

        $user = nomina::create([
            'diario' => '0',
            'jefeId' => '1',
            'personalId' => '1'
        ]);

        $user = userdocs::create([
            'personalId' => '1'
        ]);

        $user = equipo::create([
            'personalId' => '1'
        ]);

        $user = beneficiario::create([
            'personalId' => '1'
        ]);

        $user = contactos::create([
            'personalId' => '1'
        ]);

        $user = fiscal::create([
            'personalId' => '1'
        ]);

        /** Cuenta de programador */
        $user = personal::create([
            'nombres' => 'Programador',
            'apellidoP' => 'Proyecto',
            'apellidoM' => 'Q2ces',
            'mailEmpresarial' => 'programador@bconfig.com',
            'userId' => '2'
        ]);

        $user = nomina::create([
            'diario' => '0',
            'jefeId' => '1',
            'personalId' => '2'
        ]);

        $user = userdocs::create([
            'personalId' => '2'
        ]);

        $user = equipo::create([
            'personalId' => '2'
        ]);

        $user = beneficiario::create([
            'personalId' => '2'
        ]);

        $user = contactos::create([
            'personalId' => '2'
        ]);

        $user = fiscal::create([
            'personalId' => '2'
        ]);

        /** Cuenta de demo */
        $user = personal::create([
            'nombres' => 'Demostenes',
            'apellidoP' => 'Proyecto',
            'apellidoM' => 'Q2ces',
            'mailEmpresarial' => 'usuario@a.com',
            'userId' => '3'
        ]);

        $user = nomina::create([
            'diario' => '0',
            'jefeId' => '1',
            'personalId' => '3'
        ]);

        $user = userdocs::create([
            'personalId' => '3'
        ]);

        $user = equipo::create([
            'personalId' => '3'
        ]);

        $user = beneficiario::create([
            'personalId' => '3'
        ]);

        $user = contactos::create([
            'personalId' => '3'
        ]);

        $user = fiscal::create([
            'personalId' => '3'
        ]);

    }
}
