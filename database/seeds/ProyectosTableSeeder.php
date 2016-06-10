<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class ProyectosTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        for($i=1; $i<=25; $i++)
        {
            $titulo = $faker->sentence($nbWords = 3);
            $slug_url = Str::slug($titulo);

            $fecha = $faker->date($format = 'Y-m-d', $max = 'now');
            $hora = $faker->time($format = 'H:i:s', $max = 'now');

            \Amersur\Entities\Amersur\Proyecto::create([
                'titulo'    => $titulo,
                'slug_url'  => $slug_url,
                'descripcion' => $faker->text($maxNbChars = 200),
                'contenido' => $faker->paragraph(20),
                'publicar' => $faker->randomElement($array = ['0','1']),
                'published_at' => $fecha." ".$hora
            ]);
        }

        for($i=1; $i<=100; $i++)
        {
            \Amersur\Entities\Amersur\ProyectoImagen::create([
                'proyecto_id' => \Amersur\Entities\Amersur\Proyecto::all()->random()->id,
                'imagen' => $faker->randomElement($array = ['imagen-6.jpg','imagen-7.jpg','imagen-8.jpg','imagen-9.jpg','imagen-10.jpg']),
                'imagen_carpeta' => 'imagen/',
            ]);
        }

    }

}