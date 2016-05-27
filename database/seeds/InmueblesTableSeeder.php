<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class InmueblesTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        DB::table('inmueble_tipos')->insert([
            ['id' => '1', 'titulo' => 'Casa'],
            ['id' => '2', 'titulo' => 'Terreno Industrial'],
            ['id' => '3', 'titulo' => 'Terreno Comercial'],
            ['id' => '4', 'titulo' => 'Oficina']
        ]);

        for($i=1; $i<=30; $i++)
        {
            $titulo = $faker->sentence($nbWords = 8);
            $slug_url = Str::slug($titulo);

            $fecha = $faker->date($format = 'Y-m-d', $max = 'now');
            $hora = $faker->time($format = 'H:i:s', $max = 'now');

            \Amersur\Entities\Amersur\Inmueble::create([
                'titulo'    => $titulo,
                'slug_url'  => $slug_url,
                'descripcion' => $faker->text($maxNbChars = 200),
                'contenido' => $faker->text($maxNbChars = 400),
                'distrito_id' => \Amersur\Entities\Admin\Distrito::all()->random()->id,
                'inmueble_tipo_id' => \Amersur\Entities\Amersur\InmuebleTipo::all()->random()->id,
                'area_total' => $faker->numberBetween(100, 5000),
                'area_construida' => $faker->numberBetween(100, 2000),
                'precio_alquiler' => $faker->randomFloat(2, 1000, 5000),
                'precio_venta' => $faker->randomFloat(2, 1000, 5000),
                'publicar' => $faker->randomElement($array = ['0','1']),
                'published_at' => $fecha." ".$hora
            ]);
        }

        for($i=1; $i<=100; $i++)
        {
            \Amersur\Entities\Amersur\InmuebleImagen::create([
                'inmueble_id' => \Amersur\Entities\Amersur\Inmueble::all()->random()->id,
                'imagen' => $faker->randomElement($array = ['imagen-1.jpg','imagen-2.jpg','imagen-3.jpg','imagen-4.jpg','imagen-5.jpg']),
                'imagen_carpeta' => 'imagen/',
            ]);
        }

    }

}