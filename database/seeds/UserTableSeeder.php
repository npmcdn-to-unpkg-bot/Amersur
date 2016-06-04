<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->insert([
            [
                'id'       => 1,
                'email'    => 'admin@amersursac.com',
                'password' => \Hash::make('admin'),
                'active'   => 1
            ]

        ]);

        DB::table('user_profiles')->insert([
            [
                'id'		=> 1,
                'nombres'	=> 'Admin',
                'apellidos'	=> 'AmersurSAC',
                'user_id'   => 1
            ]
        ]);

        \DB::table('configurations')->insert([
            'id' 			=> 1,
            'titulo'		=> 'Administrador de Contenido',
            'dominio'		=> 'http://cms.dev/',
            'keywords'		=> 'administrador, cms',
            'description'	=> 'Administrador de contenido en L5',
            'email'         => 'web@dominio.com'
        ]);

        \DB::table('social_media')->insert([
            'id'    => 1,
            'facebook'  => '',
            'google'    => '',
            'pinterest' => '',
            'instagram' => '',
            'tumblr'    => '',
            'twitter'   => '',
            'youtube'   => ''
        ]);

        \DB::table('contacto_infos')->insert([
            'id' 		=> 1,
            'mapa'		=> '-12.077700, -76.979684'
        ]);

        \DB::table('empresas')->insert([
            'id' 		=> 1,
            'contenido'	=> ''
        ]);
    }

}