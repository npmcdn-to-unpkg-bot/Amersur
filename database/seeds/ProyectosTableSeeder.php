<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProyectosTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        for($i=1; $i<=15; $i++)
        {
            $titulo = $faker->sentence($nbWords = 4);

            \Amersur\Entities\Amersur\Proyecto::create([
                'titulo'    => $titulo,
                'descripcion' => $faker->text($maxNbChars = 220),
                'imagen' => $faker->randomElement($array = ['imagen-6.jpg','imagen-7.jpg','imagen-8.jpg','imagen-9.jpg','imagen-10.jpg']),
                'imagen_carpeta' => 'imagen/'
            ]);
        }

    }

}