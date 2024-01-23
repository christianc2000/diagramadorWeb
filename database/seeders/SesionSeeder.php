<?php

namespace Database\Seeders;

use App\Models\Sesion;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SesionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('tipo', User::ADMINISTRADOR)->first();
        $invitados = User::where('tipo', User::INVITADO)->get();
        $sesions = [
            [
                'titulo' => 'Secuenciando diagrama del hospital San Santiago',
                'estado' => Sesion::ACTIVO,
                'link' => route('sesion.index'),
                'user_id' => $admin->id
            ],
            [
                'titulo' => 'Proyecto Colegio',
                'estado' =>  Sesion::ACTIVO,
                'link' => route('sesion.index'),
                'user_id' => $admin->id
            ]
        ];
        foreach ($sesions as $sesion) {
            $sesion=Sesion::create($sesion);
            $sesion->link=route('sesion.show',$sesion->id);
            $sesion->save();
        }

        $sesiones = Sesion::where('user_id', $admin->id)->get();
        foreach ($invitados as $invitado) {
            foreach ($sesiones as $sesion) {
                $sesion->sesionUser()->attach($invitado->id, [
                    'fecha_invitacion' => '2024-01-15 19:00',
                    'fecha_respuesta' => '2024-01-15 19:20',
                    'estado' => Sesion::ACEPTADO
                ]);
            }
        }
    }
}
