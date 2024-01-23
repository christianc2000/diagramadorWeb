<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name'=>'Christian',
                'lastname'=>'Mamani',
                'username'=>'chris04',
                'foto'=>'https://rekognitions3-bucket.s3.amazonaws.com/fotografia_app/perfil/Christian.jpeg',
                'fecha_nacimiento'=>'2000-01-04',
                'genero'=>'M',
                'tipo'=>User::ADMINISTRADOR,
                'email'=>'christiancelsomamanisoliz0@gmail.com',
                'password'=>bcrypt("12345678"),
            ],
            [
                'name'=>'Karen',
                'lastname'=>'Miranda',
                'username'=>'karen12',
                'foto'=>'https://rekognitions3-bucket.s3.amazonaws.com/fotografia_app/perfil/Karen.jpg',
                'fecha_nacimiento'=>'2000-01-12',
                'genero'=>'F',
                'tipo'=>User::INVITADO,
                'email'=>'chrstncelso@gmail.com',
                'password'=>bcrypt("12345678"),
            ],
            [
                'name'=>'Johan',
                'lastname'=>'Quispe',
                'username'=>'johan11',
                'foto'=>'https://rekognitions3-bucket.s3.amazonaws.com/fotografia_app/perfil/JohanQuispe.jpg',
                'fecha_nacimiento'=>'1998-09-12',
                'genero'=>'M',
                'tipo'=>User::INVITADO,
                'email'=>'chriscelso773@gmail.com',
                'password'=>bcrypt("12345678"),
            ],
            [
                'name'=>'Sabrina',
                'lastname'=>'Guzman',
                'username'=>'sabriviolin12',
                'foto'=>'https://rekognitions3-bucket.s3.amazonaws.com/fotografia_app/perfil/Sabrina.jpg',
                'fecha_nacimiento'=>'2000-07-31',
                'genero'=>'F',
                'tipo'=>User::INVITADO,
                'email'=>'sabrina@gmail.com',
                'password'=>bcrypt("12345678"),
            ],
            [
                'name'=>'Ruben',
                'lastname'=>'Suarez',
                'username'=>'ruben78',
                'foto'=>'https://rekognitions3-bucket.s3.amazonaws.com/fotografia_app/perfil/Ruben.jpg',
                'fecha_nacimiento'=>'1992-09-12',
                'genero'=>'M',
                'tipo'=>User::INVITADO,
                'email'=>'ruben@gmail.com',
                'password'=>bcrypt("12345678"),
            ],
            [
                'name'=>'Marco',
                'lastname'=>'Padilla',
                'username'=>'marco293',
                'foto'=>'https://rekognitions3-bucket.s3.amazonaws.com/fotografia_app/perfil/Marco.jpg',
                'fecha_nacimiento'=>'1992-04-19',
                'genero'=>'M',
                'tipo'=>User::INVITADO,
                'email'=>'marco@gmail.com',
                'password'=>bcrypt("12345678"),
            ],
            [
                'name'=>'Pedro',
                'lastname'=>'Sarabia',
                'username'=>'pedriño',
                'foto'=>'https://rekognitions3-bucket.s3.amazonaws.com/fotografia_app/perfil/Pedro.jpg',
                'fecha_nacimiento'=>'2001-04-19',
                'genero'=>'M',
                'tipo'=>User::INVITADO,
                'email'=>'pedro@gmail.com',
                'password'=>bcrypt("12345678"),
            ],
            [
                'name'=>'Naida',
                'lastname'=>'Vera',
                'username'=>'naida3298',
                'foto'=>'https://rekognitions3-bucket.s3.amazonaws.com/fotografia_app/perfil/Naida.jpg',
                'fecha_nacimiento'=>'1994-04-19',
                'genero'=>'F',
                'tipo'=>User::INVITADO,
                'email'=>'naida@gmail.com',
                'password'=>bcrypt("12345678"),
            ]
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
