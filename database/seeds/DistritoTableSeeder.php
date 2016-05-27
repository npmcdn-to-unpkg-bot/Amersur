<?php
/**
 * Created by PhpStorm.
 * User: Marco Lopez
 * Date: 26/05/2016
 * Time: 21:00
 */
use Illuminate\Database\Seeder;

class DistritoTableSeeder extends Seeder {

    public function run()
    {

        DB::table('distritos')->insert([
            ['titulo' => 'Ancon' ],
            ['titulo' => 'Ate' ],
            ['titulo' => 'Barranco' ],
            ['titulo' => 'Breña' ],
            ['titulo' => 'Carabayllo' ],
            ['titulo' => 'Cercado' ],
            ['titulo' => 'Chaclacayo' ],
            ['titulo' => 'Chorrillos' ],
            ['titulo' => 'Cieneguilla' ],
            ['titulo' => 'Comas' ],
            ['titulo' => 'El Agustino' ],
            ['titulo' => 'Independencia' ],
            ['titulo' => 'Jesus Maria' ],
            ['titulo' => 'La Molina' ],
            ['titulo' => 'La Victoria' ],
            ['titulo' => 'Lince' ],
            ['titulo' => 'Los Olivos' ],
            ['titulo' => 'Lurigancho' ],
            ['titulo' => 'Lurin' ],
            ['titulo' => 'Magdalena' ],
            ['titulo' => 'Miraflores' ],
            ['titulo' => 'Pachacamac' ],
            ['titulo' => 'Pucusana' ],
            ['titulo' => 'Pueblo Libre' ],
            ['titulo' => 'Puente Piedra' ],
            ['titulo' => 'Punta Hermosa' ],
            ['titulo' => 'Punta Negra' ],
            ['titulo' => 'Rimac' ],
            ['titulo' => 'San Bartolo' ],
            ['titulo' => 'San Borja' ],
            ['titulo' => 'San Isidro' ],
            ['titulo' => 'San Juan De Lurigancho' ],
            ['titulo' => 'San Juan De Miraflores' ],
            ['titulo' => 'San Luis' ],
            ['titulo' => 'San Martin De Porres' ],
            ['titulo' => 'San Miguel' ],
            ['titulo' => 'Santa Anita' ],
            ['titulo' => 'Santa Maria Del Mar' ],
            ['titulo' => 'Santa Rosa' ],
            ['titulo' => 'Santiago De Surco' ],
            ['titulo' => 'Surquillo' ],
            ['titulo' => 'Villa El Salvador' ],
            ['titulo' => 'Villa Maria Del Triunfo' ]
        ]);

    }

}