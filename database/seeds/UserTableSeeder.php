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
    }

}